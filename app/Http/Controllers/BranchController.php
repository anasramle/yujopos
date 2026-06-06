<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Inventory;


class BranchController extends Controller
{
    public function index()
    {
        $branch = Branch::where('company_id', Auth::user()->company_id)
            ->where('is_deleted', 0)
            ->get();

        return view('branch.index', compact('branch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'phone' => 'nullable|string|max:20',
        ]);

        //  AUTO GENERATE BRANCH CODE
        $lastNumber = Branch::where('company_id', Auth::user()->company_id)
            ->where('code', 'like', 'BR%')
            ->selectRaw("MAX(CAST(SUBSTRING(code, 3) AS UNSIGNED)) as max_no")
            ->value('max_no');

        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

        $branchCode = 'BR' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // CREATE BRANCH
        $branch = Branch::create([
            'company_id' => Auth::user()->company_id,
            'branch_name' => $request->branch_name,
            'code' => $branchCode,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'is_active' => $request->status ?? 1
        ]);

        // CREATE INVENTORY
        $products = Product::where('company_id', Auth::user()->company_id)->get();

        foreach ($products as $product) {
            Inventory::create([
                'product_id' => $product->id,
                'branch_id' => $branch->id,
                'company_id' => Auth::user()->company_id,
                'qty' => 0
            ]);
        }

        return redirect()->route('branch.index')->with('success', 'Branch added successfully!');
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update([
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'is_active' => $request->status == 1 ? 1 : 0
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch updated successfully!');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update([
            'is_deleted' => 1
        ]);

        return redirect()->route('branch.index')->with('success', 'Branch deleted successfully!');
    }

    public function switch(Request $request)
    {
        $branch = Branch::where('id', $request->branch_id)
            ->where('company_id', Auth::user()->company_id)
            ->where('is_active', 1)
            ->firstOrFail();

        session(['branch_id' => $branch->id]);

        return redirect()->route('sales.index')->with('clear_cart', true);
    }
}
