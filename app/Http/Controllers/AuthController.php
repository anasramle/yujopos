<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

        $user = Auth::user();

        if ($user->is_deleted == 1) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'This account has been deleted.'
            ])->withInput();
        }

        // CHECK FIRST LOGIN FOR ALL ROLES EXCEPT ADMIN
        if ($user->is_first_login) {
            if ($user->role_id == 1) {
                return redirect()->route('onboarding');
            }

            if ($user->role_id == 2) {
                session(['branch_id' => $user->branch_id]);
                return redirect()->route('dashboard')->with('force_password', true);
            }

            if ($user->role_id == 3) {
                session(['branch_id' => $user->branch_id]);
                return redirect()->route('sales.index')->with('force_password', true);
            }
        }

        if ($user->role_id == 1) {
            session()->forget('branch_id');
            return redirect()->route('dashboard');
        }

        if ($user->role_id == 2) {
            session(['branch_id' => $user->branch_id]);
            return redirect()->route('dashboard')
                ->with('clear_all_cart', true);
        }

        if ($user->role_id == 3) {
            session(['branch_id' => $user->branch_id]);
            return redirect()->route('sales.index')
                ->with('clear_all_cart', true)
                ->with('force_reload', true);
        }
    }
    return back()->withErrors([
        'email' => 'Invalid email or password'
    ])->withInput();
}
    public function showRegister()
    {
        return view('auth.login', ['show' => 'register']);
    }


    // REGISTER PROCESS
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'company_name' => 'required'
        ]);


        DB::beginTransaction();

        try {

            // CREATE COMPANY
            $companyId = DB::table('company')->insertGetId([
                'company_name' => $request->company_name,
                'created_at' => now(),
                'updated_at' => now()
            ]);


            // CREATE ADMIN USER
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1,
                'company_id' => $companyId,
                'is_first_login' => true
            ]);


            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors($e->getMessage());
        }


        return redirect()->route('login')
            ->with('status', 'Account created! Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout', true);
    }

    public function forceChangePassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $user = Auth::user();

    $user->password = Hash::make($request->password);
    $user->is_first_login = false;
    $user->save();

    // Refresh session
    Auth::login($user);

    // Role-based redirect
    if ($user->role_id == 3) {
        return redirect()->route('sales.index')
            ->with('success', 'Password updated successfully')
            ->with('clear_all_cart', true)
            ->with('force_reload', true);
    }

    if ($user->role_id == 2) {
        return redirect()->route('dashboard')
            ->with('success', 'Password updated successfully');
    }

    if ($user->role_id == 1) {
        return redirect()->route('dashboard.global')
            ->with('success', 'Password updated successfully');
    }

    return redirect()->route('dashboard')->with('success', 'Password updated');
}

protected function authenticated(Request $request, $user)
{
    if ($user->is_deleted == 1) {
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('login')
            ->withErrors(['email' => 'This account has been deleted.']);
    }
}
}
