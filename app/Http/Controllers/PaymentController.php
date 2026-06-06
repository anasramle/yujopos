<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{

    protected function getBranchId()
    {
        $user = Auth::user();

        return $user->role_id == 1
            ? session('branch_id', $user->branch_id)
            : $user->branch_id;
    }
    public function show(Request $request)
    {
        $items = json_decode($request->items, true);

        $total = collect($items)
            ->sum(fn($i) => $i['price'] * $i['qty']);

        return view('sales.payment', compact('items', 'total'));
    }


    public function process(Request $request)
    {

        $items = json_decode($request->items, true);
        $total = (float)$request->total;

        $cash = (float) preg_replace('/[^0-9.]/', '', $request->cash);
        $card = (float)($request->card ?? 0);

        $paid = $cash + $card;

        if ($paid < $total) {
            return response()->json([
                'error' => 'Payment not enough'
            ], 400);
        }

        $change = $paid - $total;
        $branchId = $this->getBranchId();
        DB::beginTransaction();

        try {

            $saleId = DB::table('sales')->insertGetId([

                'company_id' => Auth::user()->company_id,
                'branch_id' => $branchId,
                'user_id' => Auth::id(),
                'total' => $total,
                'cash' => $cash,
                'card' => $card,
                'change_amount' => $change,
                'payment_type' => $card > 0 ? 'card' : 'cash',
                'created_at' => now()

            ]);

            foreach ($items as $item) {

                // INSERT SALES ITEM
                DB::table('sales_items')->insert([
                    'sale_id' => $saleId,
                    'inventory_id' => $item['id'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'created_at' => now()
                ]);

                // GET INVENTORY DATA
                $inventory = DB::table('inventory')
                    ->where('id', $item['id'])
                    ->where('branch_id', $branchId)
                    ->first();

                //  CHECK STOCK CUKUP
                if (!$inventory || $inventory->qty < $item['qty']) {
                    throw new \Exception('Stock not enough');
                }

                //  DEDUCT STOCK
                DB::table('inventory')
                    ->where('id', $item['id'])
                    ->decrement('qty', $item['qty']);

                //  SAVE STOCK MOVEMENT
                DB::table('stock_movement')->insert([
                    'product_id' => $inventory->product_id,
                    'company_id' => Auth::user()->company_id,
                    'branch_id' => $branchId,
                    'type' => 'sale',
                    'qty' => $item['qty'],
                    'note' => 'Auto deduct (sale)',
                    'user_id' => Auth::id(),
                    'created_at' => now()
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'error' => 'Transaction failed'
            ], 500);
        }

        $receiptNumber = 'INV-' . date('Y') . '-' . str_pad($saleId, 6, '0', STR_PAD_LEFT);

        return response()->json([

            'saleId' => $saleId,
            'receiptNumber' => $receiptNumber,
            'total' => $total,
            'cash' => $cash,
            'card' => $card,
            'paid' => $paid,
            'change' => $change,
            'items' => $items

        ]);
    }
}
