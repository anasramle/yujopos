<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Mail\StaffWelcomeMail;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $users = User::with(['role', 'branch'])
            ->where('is_deleted', 0)
            ->where('company_id', $user->company_id);

        if ($user->role_id == 2) {

            $users->where('branch_id', $user->branch_id)
                ->where('role_id', 3);
        } elseif ($user->role_id == 1) {


            if (session('branch_id')) {
                $users->where('branch_id', session('branch_id'));
            }

            $users->whereIn('role_id', [2, 3]);
        }

        $users = $users->get();

        $branches = collect();
        if ($user->role_id == 1) {
            $branchesIds = User::where('company_id', $user->company_id)
                ->select('branch_id')
                ->distinct()
                ->pluck('branch_id');
            $branches = \App\Models\Branch::where('company_id', $user->company_id)->get();
        }

        return view('users.index', compact('users', 'branches'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        //  Basic validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|in:2,3',
            ], [
            'email.unique' => 'The email has already been taken.',
        ]);

        //  MANAGER restriction
        if ($user->role_id == 2 && $request->role_id != 3) {
            abort(403, 'Manager can only create Staff');
        }

        // GET ROLE DATA (for modal display)
        $role = \App\Models\Role::find($request->role_id);

        //  SET BRANCH BASED ON ROLE
        if ($user->role_id == 2) {

            $branchId = $user->branch_id;
        } else {

            $request->validate([
                'branch_id' => 'required'
            ]);

            $branchId = $request->branch_id;
        }

        // GET BRANCH DATA (for modal display)
        $branch = \App\Models\Branch::find($branchId);

        // BLOCK duplicate manager (1 branch = 1 manager)
        if ($request->role_id == 2) {
            $existingManager = User::where('branch_id', $branchId)
                ->where('role_id', 2)
                ->where('is_deleted', 0)
                ->exists();

            if ($existingManager) {
                return back()->with('error', 'Branch already has a manager');
            }
        }

        // Create user
        $tempPassword = Str::random(8);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'role_id' => $request->role_id,
            'company_id' => $user->company_id,
            'branch_id' => $branchId,
            'is_first_login' => true
        ]);

        // Load relationships for email
        $newUser->load(['role', 'branch']);

        // Get company name
        $company = \App\Models\Company::find($user->company_id);
        $companyName = $company ? $company->company_name : 'Yujo POS';

        // Send email to new staff
        try {
            Mail::to($newUser->email)->send(new StaffWelcomeMail($newUser, $tempPassword, $companyName));
        } catch (\Exception $e) {
            // Log error but continue (email failed but user created)
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        return back()
            ->with('success', 'User added successfully. Welcome email sent!')
            ->with('new_user', [
                'name' => $newUser->name,
                'email' => $newUser->email,
                'password' => $tempPassword,
                'role' => $role->role ?? 'Unknown',
                'branch' => $branch->branch_name ?? 'N/A',
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ], [
            'email.unique' => 'The email has already been taken.',
        ]);

        $user = Auth::user();

        $query = DB::table('users')
            ->where('id', $id)
            ->where('company_id', $user->company_id);

        //  MANAGER
        if ($user->role_id == 2) {

            if ($request->role_id != 3) {
                abort(403, 'Manager can only assign Cashier role');
            }

            $query->where('branch_id', $user->branch_id);

            $query->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => 3,
                'branch_id' => $user->branch_id,
                'updated_at' => now()
            ]);
        }
        //  ADMIN
        else {

            $request->validate([
                'role_id' => 'required|in:2,3',
                'branch_id' => 'required'
            ]);

            //  BLOCK duplicate manager (exclude current user)
            if ($request->role_id == 2) {
                $existingManager = User::where('branch_id', $request->branch_id)
                    ->where('role_id', 2)
                    ->where('id', '!=', $id)
                    ->where('is_deleted', 0)
                    ->exists();

                if ($existingManager) {
                    return back()->with('error', 'Branch already has a manager');
                }
            }

            $query->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'branch_id' => $request->branch_id,
                'updated_at' => now()
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'Staff updated successfully!');
    }

    public function destroy($id)
    {
        $query = DB::table('users')
            ->where('id', $id)
            ->where('company_id', Auth::user()->company_id);

        if (Auth::user()->role_id == 2) {
            $query->where('branch_id', Auth::user()->branch_id);
        }

        $query->update(['is_deleted' => 1]);

        return redirect()->route('users.index')
            ->with('success', 'Staff deleted successfully!');
    }

    public function verifyAdmin(Request $request)
    {
        $request->validate([
            'security_code' => 'required'
        ]);

        if ($request->security_code !== '1234') {
            return back()->with('error', 'Incorrect security code.');
        }
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $targetRoleId = ($user->role_id == 1) ? 2 : 1;

        $user->role_id = $targetRoleId;
        $user->save();

        Auth::login($user);

        return back()->with('success', 'Role switched successfully!');
    }

    public function switchToAdmin(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $admin = User::where('company_id', Auth::user()->company_id)
            ->where('role_id', 1)
            ->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wrong admin password'
            ]);
        }

        Auth::login($admin);

        return response()->json([
            'status' => 'success',
            'redirect' => url('/dashboard')
        ]);
    }

    public function switchToCashier(Request $request)
    {
        $request->validate([
            'cashier_id' => 'required|integer'
        ]);

        $cashier = User::where('id', $request->cashier_id)
            ->where('company_id', Auth::user()->company_id)
            ->where('role_id', 3)
            ->where('is_deleted', 0)
            ->first();

        if (!$cashier) {
            return back()->with('error', 'Invalid cashier account.');
        }

        Auth::login($cashier);

        return redirect('/sales')->with('success', 'Switched to Cashier');
    }

    public function __construct()
    {
        $this->middleware('role:1,2');
    }
}
