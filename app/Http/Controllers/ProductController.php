<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->join('category', 'products.category_id', '=', 'category.id')
            ->where('products.company_id', Auth::user()->company_id)
            ->where('products.is_deleted', 0)
            ->select('products.*', 'category.name as category_name')
            ->get();

        $categories = DB::table('category')
            ->where('company_id', Auth::user()->company_id)
            ->where('is_deleted', 0)
            ->get();

        return view('product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = DB::table('category')
            ->where('company_id', Auth::user()->company_id)
            ->where('is_deleted', 0)
            ->get();

        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'img' => 'nullable|image'
        ]);

        // AUTO SN
        $last = DB::table('products')->orderBy('id', 'desc')->first();
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

        // Insert product
        $productId = DB::table('products')->insertGetId([
            'sn_no' => $sn,
            'item_name' => $request->item_name,
            'item_desc' => $request->item_desc,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'img' => $imgPath,
            'company_id' => Auth::user()->company_id,
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Auto insert into inventory with qty = 0
        $branches = DB::table('branches')
            ->where('company_id', Auth::user()->company_id)
            ->get();

        foreach ($branches as $branch) {
            DB::table('inventory')->insert([
                'product_id' => $productId,
                'branch_id' => $branch->id,
                'qty' => 0,
                'company_id' => Auth::user()->company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Product created and added to inventory for all branches!');
    }

    public function edit($id)
    {
        $product = DB::table('products')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->first();

        $categories = DB::table('category')
            ->where('company_id', Auth::user()->company_id)
            ->where('is_deleted', 0)
            ->get();

        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'img' => 'nullable|image'
        ]);

        $product = DB::table('products')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->first();

        $imgPath = $product->img;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $name, 'public');
            $imgPath = 'storage/uploads/' . $name;
        }

        DB::table('products')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->update([
                'item_name' => $request->item_name,
                'item_desc' => $request->item_desc,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'img' => $imgPath,
                'updated_at' => now()
            ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('products')
            ->where('id', $id)
            ->where('company_id', Auth::user()->company_id)
            ->where('is_deleted', 0)
            ->update(['is_deleted' => 1]);

        DB::table('inventory')
            ->where('product_id', $id)
            ->where('company_id', Auth::user()->company_id)
            ->update(['is_deleted' => 1]);



        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
