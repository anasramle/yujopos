<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    // GET BRANCH ID
    protected function getBranchId()
    {
        return session('branch_id') ?? Auth::user()->branch_id;
    }

    // LIST INVENTORY
    public function index()
    {
        $branchId = $this->getBranchId();

        $items = DB::table('inventory')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->where('inventory.branch_id', $branchId)
            ->where('inventory.is_deleted', 0)
            ->select(
                'inventory.id',
                'inventory.qty',
                'products.item_name',
                'products.price',
                'products.img'
            )
            ->get();

        return view('inventory.index', compact('items'));
    }

    // CREATE INVENTORY
    public function create()
    {
        $products = DB::table('products')
            ->where('company_id', Auth::user()->company_id)
            ->get();

        return view('inventory.create', compact('products'));
    }

    // STORE INVENTORY
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:0'
        ]);

        $exists = DB::table('inventory')
            ->where('product_id', $request->product_id)
            ->where('branch_id', $this->getBranchId())
            ->first();

        if ($exists) {
            return back()->with('error', 'Item already exists in inventory!');
        }

        DB::table('inventory')->insert([
            'product_id' => $request->product_id,
            'branch_id' => $this->getBranchId(),
            'qty' => $request->qty,
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Stock added!');
    }

    // EDIT INVENTORY
    public function edit($id)
    {
        $data = DB::table('inventory')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->select('inventory.*', 'products.item_name')
            ->where('inventory.id', $id)
            ->where('inventory.branch_id', $this->getBranchId())
            ->first();

        return view('inventory.edit', compact('data'));
    }

    // UPDATE INVENTORY
    public function update(Request $request, $id)
    {
        DB::table('inventory')
            ->where('id', $id)
            ->where('branch_id', $this->getBranchId())
            ->update([
                'qty' => $request->qty
            ]);

        return redirect()->back()->with('success', 'Updated successfully');
    }

    // SOFT DELETE
    public function destroy($id)
    {
        DB::table('inventory')
            ->where('id', $id)
            ->where('branch_id', $this->getBranchId())
            ->update(['is_deleted' => 1]);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory deleted successfully!');
    }

    // ADD STOCK
    public function addStock(Request $request, $id)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $inventory = DB::table('inventory')
            ->where('id', $id)
            ->where('branch_id', $this->getBranchId())
            ->first();

        DB::table('inventory')
            ->where('id', $id)
            ->update(['qty' => $inventory->qty + $request->qty]);

        DB::table('stock_movement')->insert([
            'product_id' => $inventory->product_id,
            'company_id' => Auth::user()->company_id,
            'branch_id' => $this->getBranchId(),
            'type' => 'add',
            'qty' => $request->qty,
            'note' => $request->note ?? 'Stock added manually',
            'user_id' => Auth::id(),
            'created_at' => now()
        ]);

        return back()->with('success', 'Stock added successfully!');
    }

    // DEDUCT STOCK
    public function deductStock(Request $request, $id)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $inventory = DB::table('inventory')
            ->where('id', $id)
            ->where('branch_id', $this->getBranchId())
            ->first();

        if ($inventory->qty < $request->qty) {
            return back()->with('error', 'Not enough stock!');
        }

        DB::table('inventory')
            ->where('id', $id)
            ->update(['qty' => $inventory->qty - $request->qty]);

        DB::table('stock_movement')->insert([
            'product_id' => $inventory->product_id,
            'company_id' => Auth::user()->company_id,
            'branch_id' => $this->getBranchId(),
            'type' => 'deduct',
            'qty' => $request->qty,
            'note' => $request->note ?? 'Stock deducted manually',
            'user_id' => Auth::id(),
            'created_at' => now()
        ]);

        return back()->with('success', 'Stock deducted successfully!');
    }

    // STOCK HISTORY
    public function history(Request $request)
    {
        $branchId = $this->getBranchId();

        $query = DB::table('stock_movement')
            ->join('products', 'stock_movement.product_id', '=', 'products.id')
            ->leftJoin('users', 'stock_movement.user_id', '=', 'users.id')
            ->where('stock_movement.branch_id', $branchId)
            ->select('stock_movement.*', 'products.item_name', 'users.name as user_name');

        if ($request->from && $request->to) {
            $query->whereBetween('stock_movement.created_at', [$request->from, $request->to]);
        }

        $data = $query->orderBy('stock_movement.created_at', 'desc')->get();

        return view('inventory.history', compact('data'));
    }
}
