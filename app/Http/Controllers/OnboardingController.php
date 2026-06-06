<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class OnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->is_first_login) {
            return redirect()->route('dashboard');
        }

        $step = session('onboarding_step', 1);

        $branchName = null;
        $branchId = session('temp_branch_id');
        if ($branchId) {
            $branch = Branch::where('id', $branchId)->where('company_id', $user->company_id)->first();
            $branchName = $branch ? $branch->branch_name : null;
        }

        return view('onboarding.index', compact('step', 'branchName'));
    }

    public function saveBranch(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
            'address' => 'required',
            'postcode' => 'required',
        ]);

        $companyId = Auth::user()->company_id;

        // Generate branch code
        $lastNumber = Branch::where('company_id', $companyId)
            ->where('code', 'like', 'BR%')
            ->selectRaw("MAX(CAST(SUBSTRING(code, 3) AS UNSIGNED)) as max_no")
            ->value('max_no');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
        $branchCode = 'BR' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Create branch
        $branch = Branch::create([
            'company_id' => $companyId,
            'branch_name' => $request->branch_name,
            'code' => $branchCode,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'phone' => $request->phone ?? '',
            'is_active' => 1
        ]);

        session(['onboarding_step' => 2, 'temp_branch_id' => $branch->id]);

        return redirect()->route('onboarding')->with('success', 'Branch added! Next: Add Category');
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'company_id' => Auth::user()->company_id,
            'created_at' => now()
        ]);

        session(['onboarding_step' => 3]);

        return redirect()->route('onboarding')->with('success', 'Category added! Next: Add Product');
    }

    public function saveProduct(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required'
        ]);

        $companyId = Auth::user()->company_id;

        // Generate SN
        $last = Product::orderBy('id', 'desc')->first();
        $num = $last ? intval(substr($last->sn_no, -4)) + 1 : 1;
        $sn = 'PRD-' . str_pad($num, 4, '0', STR_PAD_LEFT);

        // Upload image
        $imgPath = null;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $name = $file->getClientOriginalName();
            $file->storeAs('uploads', $name, 'public');
            $imgPath = 'storage/uploads/' . $name;
        }

        // Create product
        $product = Product::create([
            'sn_no' => $sn,
            'item_name' => $request->item_name,
            'item_desc' => $request->item_desc,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'img' => $imgPath,
            'company_id' => $companyId,
            'is_deleted' => 0
        ]);

        $productId = $product->id;
        $initialQuantity = $request->quantity;
        // Add to inventory for all branches
        $branches = Branch::where('company_id', $companyId)->get();
        foreach ($branches as $branch) {
            DB::table('inventory')->insert([
                'product_id' => $productId,
                'branch_id' => $branch->id,
                'company_id' => $companyId,
                'qty' => $initialQuantity,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if ($initialQuantity > 0) {
                DB::table('stock_movement')->insert([
                    'product_id' => $productId,
                    'company_id' => $companyId,
                    'branch_id' => $branch->id,
                    'type' => 'add',
                    'qty' => $initialQuantity,
                    'note' => 'Initial stock during onboarding',
                    'user_id' => Auth::id(),
                    'created_at' => now()
                ]);
            }
        }

        session(['onboarding_step' => 4]);

        return redirect()->route('onboarding')->with('success', 'Product added! Setup complete!');
    }

    public function complete(Request $request)
    {
        $user = Auth::user();
        $user->is_first_login = false;
        $user->save();

        // Set branch untuk admin
        session(['branch_id' => session('temp_branch_id')]);

        // Clean up session
        session()->forget(['onboarding_step', 'temp_branch_id']);

        return redirect()->route('dashboard')->with('success', '🎉 Setup complete! Welcome to Yujo POS!');
    }

    public function skip()
    {

    $user = Auth::user();
        $user->is_first_login = false;
        $user->save();
        // Set session flag untuk skip onboarding
        session(['skip_onboarding' => true]);

        // Redirect to dashboard
        return redirect()->route('dashboard');
    }
}
