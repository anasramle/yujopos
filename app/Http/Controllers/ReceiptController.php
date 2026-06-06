<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReceiptController extends Controller
{
    protected function getBranchId()
    {
        $user = Auth::user();
        return $user->role_id == 1 ? session('branch_id', $user->branch_id) : $user->branch_id;
    }
    public function history()
    {
        $branchId = $this->getBranchId();
        $sales = DB::table('sales')->join('users', 'users.id', '=', 'sales.user_id')->where('sales.company_id', Auth::user()->company_id)->where('sales.branch_id', $branchId)->select('sales.*', 'users.name as cashier')->orderBy('sales.created_at', 'desc')->get();
        return view('sales.receipt_history', compact('sales'));
    }
    public function show($id)
    {
        $branchId = $this->getBranchId();
        $sale = DB::table('sales')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->join('company', 'company.id', '=', 'sales.company_id')
            ->join('branches', 'branches.id', '=', 'sales.branch_id')
            ->where('sales.id', $id)
            ->where('sales.company_id', Auth::user()->company_id)
            ->where('sales.branch_id', $branchId)
            ->select('sales.*', 'users.name as cashier', 'company.company_name', 'branches.branch_name')
            ->first();

        $items = DB::table('sales_items')
            ->join('inventory', 'inventory.id', '=', 'sales_items.inventory_id')
            ->join('products', 'products.id', '=', 'inventory.product_id')
            ->where('sale_id', $id)
            ->select(
                'products.item_name as item_name',
                'sales_items.qty',
                'sales_items.price'
            )
            ->get();
        return response()->json(['sale' => $sale, 'items' => $items]);
    }
    public function send(Request $request)
    {
        $email = $request->email;
        $saleId = $request->saleId;

        \Log::info('Receipt requested - Email: ' . $email . ', Sale ID: ' . $saleId);

        $sale = DB::table('sales')
            ->join('branches', 'branches.id', '=', 'sales.branch_id')
            ->where('sales.id', $saleId)
            ->select('sales.*', 'branches.branch_name')
            ->first();

        $items = DB::table('sales_items')
            ->join('inventory', 'inventory.id', '=', 'sales_items.inventory_id')
            ->join('products', 'products.id', '=', 'inventory.product_id')
            ->where('sale_id', $saleId)
            ->select(
                'products.item_name as item_name',
                'sales_items.qty',
                'sales_items.price'
            )
            ->get();

        $company = DB::table('company')->where('id', Auth::user()->company_id)->first();
        Mail::send('emails.receipt', [
            'sale' => $sale,
            'items' => $items,
            'total' => $sale->total,
            'paid' => $sale->cash,
            'card' => $sale->card,
            'change' => $sale->change_amount,
            'saleId' => 'INV-' . date('Y') . '-' . str_pad($sale->id, 6, '0', STR_PAD_LEFT),
            'company' => $company,
            'branch_name' => $sale->branch_name ?? 'Main Branch'
        ], function ($message) use ($email) {
            $message->to($email)->subject('Your Receipt');
        });

         \Log::info('Receipt email sent successfully to: ' . $email);

        return response()->json(['status' => 'sent']);
    }
}
