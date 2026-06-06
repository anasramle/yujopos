<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\SaleItem;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $companyId = $user->company_id;
        $branchId = session('branch_id');

        if ($branchId) {
            $activeBranch = DB::table('branches')
                ->where('id', $branchId)
                ->where('is_active', 1)
                ->where('is_deleted', 0)
                ->first();

            if (!$activeBranch) {
                session()->forget('branch_id');
                $branchId = null;
            }
        }

        // Get all branches for dropdown
        $branches = DB::table('branches')
            ->where('company_id', $companyId)
            ->where('is_active', 1)
            ->get();

        // Default filter
        $filter = 'month';

        if ($branchId) {
            $currentBranch = DB::table('branches')
                ->where('id', $branchId)
                ->where('is_active', 1)
                ->first();

            // INVENTORY
            $total_items = DB::table('inventory')->where('branch_id', $branchId)->distinct('product_id')->count('product_id');
            $total_stock = DB::table('inventory')->where('branch_id', $branchId)->sum('qty');

            // STOCK MOVEMENT
            $total_stock_in = DB::table('stock_movement')
                ->where('branch_id', $branchId)->where('company_id', $companyId)->where('type', 'Stock In')->sum('qty');
            $total_stock_out = DB::table('stock_movement')
                ->where('branch_id', $branchId)->where('company_id', $companyId)->where('type', 'Stock Out')->sum('qty');

            // SALES
            $daily_sales = DB::table('sales')->where('branch_id', $branchId)->where('company_id', $companyId)
                ->whereDate('created_at', Carbon::today())->sum('total');
            $monthly_sales = DB::table('sales')->where('branch_id', $branchId)->where('company_id', $companyId)
                ->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total');
            $yesterday_sales = DB::table('sales')->where('branch_id', $branchId)->where('company_id', $companyId)
                ->whereDate('created_at', Carbon::yesterday())->sum('total');
            $total_orders_today = DB::table('sales')->where('branch_id', $branchId)->where('company_id', $companyId)
                ->whereDate('created_at', Carbon::today())->count();

            $growth = $yesterday_sales > 0 ? (($daily_sales - $yesterday_sales) / $yesterday_sales) * 100 : 0;

            // ITEMS SOLD
            $items_sold = DB::table('sales_items')
                ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
                ->where('sales.branch_id', $branchId)
                ->where('sales.company_id', $companyId)
                ->whereDate('sales.created_at', Carbon::today())
                ->sum('sales_items.qty');

            $items_sold_yesterday = DB::table('sales_items')
                ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
                ->where('sales.branch_id', $branchId)
                ->where('sales.company_id', $companyId)
                ->whereDate('sales.created_at', Carbon::yesterday())
                ->sum('sales_items.qty');

            $items_growth = $items_sold_yesterday > 0 ? (($items_sold - $items_sold_yesterday) / $items_sold_yesterday) * 100 : 0;

            // LOW STOCK
            $low_stock = DB::table('inventory')
                ->join('products', 'inventory.product_id', '=', 'products.id')
                ->where('inventory.branch_id', $branchId)
                ->where('inventory.qty', '<=', 5)
                ->orderBy('inventory.qty', 'asc')
                ->select('products.item_name', 'inventory.qty')
                ->get();

            // TOP ITEMS
            $top_items = $this->getTopItemsQuery($branchId, $companyId, $filter)->get();

            // SALES TREND
            $sales_7_days = DB::table('sales')
                ->where('branch_id', $branchId)
                ->where('company_id', $companyId)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->map(fn($row) => (object)['date' => Carbon::parse($row->date)->format('d M'), 'total' => $row->total]);

            $isGlobal = false;
        } else {
            // GLOBAL DASHBOARD
            $currentBranch = null;
            $branchId = null;

            $total_items = DB::table('inventory')->where('company_id', $companyId)->distinct('product_id')->count('product_id');
            $total_stock = DB::table('inventory')->where('company_id', $companyId)->sum('qty');

            $total_stock_in = DB::table('stock_movement')->where('company_id', $companyId)->where('type', 'Stock In')->sum('qty');
            $total_stock_out = DB::table('stock_movement')->where('company_id', $companyId)->where('type', 'Stock Out')->sum('qty');

            $daily_sales = DB::table('sales')->where('company_id', $companyId)
                ->whereDate('created_at', Carbon::today())->sum('total');
            $monthly_sales = DB::table('sales')->where('company_id', $companyId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)->sum('total');
            $yesterday_sales = DB::table('sales')->where('company_id', $companyId)
                ->whereDate('created_at', Carbon::yesterday())->sum('total');
            $total_orders_today = DB::table('sales')->where('company_id', $companyId)
                ->whereDate('created_at', Carbon::today())->count();

            $growth = $yesterday_sales > 0 ? (($daily_sales - $yesterday_sales) / $yesterday_sales) * 100 : 0;

            $items_sold = DB::table('sales_items')
                ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
                ->where('sales.company_id', $companyId)
                ->whereDate('sales.created_at', Carbon::today())
                ->sum('sales_items.qty');

            $items_sold_yesterday = DB::table('sales_items')
                ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
                ->where('sales.company_id', $companyId)
                ->whereDate('sales.created_at', Carbon::yesterday())
                ->sum('sales_items.qty');

            $items_growth = $items_sold_yesterday > 0 ? (($items_sold - $items_sold_yesterday) / $items_sold_yesterday) * 100 : 0;

            $low_stock = DB::table('inventory')
                ->join('products', 'inventory.product_id', '=', 'products.id')
                ->join('branches', 'inventory.branch_id', '=', 'branches.id')
                ->where('inventory.company_id', $companyId)
                ->where('inventory.qty', '<=', 5)
                ->orderBy('inventory.qty', 'asc')
                ->select(
                    'products.item_name',
                    'inventory.qty',
                    'branches.branch_name'
                )
                ->get();

            // TOP ITEMS
            $top_items = $this->getTopItemsQuery(null, $companyId, $filter)->get();

            $sales_7_days = DB::table('sales')
                ->where('company_id', $companyId)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->map(fn($row) => (object)['date' => Carbon::parse($row->date)->format('d M'), 'total' => $row->total]);

            $isGlobal = true;
        }

        return view('dashboard', compact(
            'total_items',
            'total_stock',
            'total_stock_in',
            'total_stock_out',
            'daily_sales',
            'monthly_sales',
            'yesterday_sales',
            'total_orders_today',
            'growth',
            'low_stock',
            'top_items',
            'sales_7_days',
            'items_sold',
            'items_growth',
            'branches',
            'currentBranch',
            'isGlobal'
        ));
    }

    private function getTopItemsQuery($branchId, $companyId, $filter)
    {
        $query = DB::table('sales_items')
            ->join('inventory', 'sales_items.inventory_id', '=', 'inventory.id')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
            ->where('sales.company_id', $companyId)
            ->select('products.item_name', DB::raw('SUM(sales_items.qty) as total_qty'))
            ->groupBy('products.item_name');

        if ($branchId) {
            $query->where('sales.branch_id', $branchId);
        }

        // Apply filter
        if ($filter == 'today') {
            $query->whereDate('sales.created_at', Carbon::today());
        } elseif ($filter == 'week') {
            $query->whereBetween('sales.created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } else {
            $query->whereMonth('sales.created_at', Carbon::now()->month)
                  ->whereYear('sales.created_at', Carbon::now()->year);
        }

        return $query->orderByDesc('total_qty')->limit(6);
    }

    // AJAX FILTER
    public function getTopItems(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $branchId = session('branch_id');
        $filter = $request->filter ?? 'month';

        $query = DB::table('sales_items')
            ->join('inventory', 'sales_items.inventory_id', '=', 'inventory.id')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
            ->where('sales.company_id', $companyId)
            ->select(
                'products.item_name',
                DB::raw('SUM(sales_items.qty) as total_qty')
            )
            ->groupBy('products.item_name');

        if ($branchId) {
            $query->where('sales.branch_id', $branchId);
        }

        // FILTER
        if ($filter == 'today') {
            $query->whereDate('sales.created_at', Carbon::today());
        } elseif ($filter == 'week') {
            $query->whereBetween('sales.created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } elseif ($filter == 'month') {
            $query->whereMonth('sales.created_at', Carbon::now()->month)
                  ->whereYear('sales.created_at', Carbon::now()->year);
        }

        $results = $query->orderByDesc('total_qty')->limit(6)->get();

        if ($results->isEmpty()) {
            return response()->json([
                ['item_name' => 'No Data Available', 'total_qty' => 1]
            ]);
        }

        return response()->json($results);
    }

    // Global Dashboard
    public function globalDashboard()
    {
        $user = Auth::user();
        $companyId = $user->company_id;

        $branches = DB::table('branches')
            ->where('company_id', $companyId)
            ->where('is_active', 1)
            ->get();

        return view('dashboard.global', compact('branches'));
    }

    public function selectBranch($id)
    {
        session(['branch_id' => $id]);
        return redirect()->route('dashboard');
    }

    public function report()
    {
        $companyId = Auth::user()->company_id;
        $branchId = session('branch_id');

        if ($branchId) {
            $branch = DB::table('branches')->where('id', $branchId)->first();
            $branchName = $branch->branch_name;
        } else {
            $branchName = 'All Branches';
        }

        $companyName = DB::table('company')
            ->where('id', Auth::user()->company_id)
            ->value('company_name');

        $reportDate = now()->format('d M Y');

        $daily_sales = DB::table('sales')
            ->where('company_id', $companyId)
            ->whereDate('created_at', today())
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->sum('total');

        $monthly_sales = DB::table('sales')
            ->where('company_id', $companyId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->sum('total');

        $total_orders_today = DB::table('sales')
            ->where('company_id', $companyId)
            ->whereDate('created_at', today())
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->count();

        $items_sold = DB::table('sales_items')
            ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
            ->where('sales.company_id', $companyId)
            ->whereDate('sales.created_at', today())
            ->when($branchId, fn($q) => $q->where('sales.branch_id', $branchId))
            ->sum('sales_items.qty');

        $sales_7_days = DB::table('sales')
            ->where('company_id', $companyId)
            ->where('created_at', '>=', now()->subDays(7))
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $top_items = DB::table('sales_items')
            ->join('inventory', 'sales_items.inventory_id', '=', 'inventory.id')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->join('sales', 'sales_items.sale_id', '=', 'sales.id')
            ->where('sales.company_id', $companyId)
            ->when($branchId, fn($q) => $q->where('sales.branch_id', $branchId))
            ->whereMonth('sales.created_at', now()->month)
            ->whereYear('sales.created_at', now()->year)
            ->select('products.item_name', DB::raw('SUM(sales_items.qty) as total_qty'))
            ->groupBy('products.item_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return view('report.index', compact(
            'daily_sales',
            'monthly_sales',
            'total_orders_today',
            'items_sold',
            'sales_7_days',
            'top_items',
            'branchName',
            'companyName',
            'reportDate'
        ));
    }
}
