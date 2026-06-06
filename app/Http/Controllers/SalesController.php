<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{

    protected function getBranchId()
    {
        $user = Auth::user();

        return $user->role_id == 1
            ? session('branch_id', $user->branch_id)
            : $user->branch_id;
    }
    public function index(Request $request)
    {
        $branchId = $this->getBranchId();
        $companyId = Auth::user()->company_id;

        // Fetch categories
        $categories = DB::table('category')
            ->where('is_deleted', 0)
            ->where('company_id', $companyId)
            ->select('id', 'name')
            ->get();

        // Current category
        $currentCategoryName = 'Category';
        $categoryId = $request->query('category_id');

        if ($categoryId) {
            $cat = $categories->firstWhere('id', (int)$categoryId);
            if ($cat) {
                $currentCategoryName = $cat->name;
            }
        }

        // Fetch menus 
        $menusQuery = DB::table('inventory')
            ->join('products', 'inventory.product_id', '=', 'products.id')
            ->where('inventory.branch_id', $branchId)
            ->where('inventory.company_id', $companyId)
            ->where('products.is_deleted', 0);

        if ($categoryId) {
            $menusQuery->where('products.category_id', $categoryId);
        }

        $menus = $menusQuery->select(
            'inventory.id',
            'products.item_name',
            'products.price',
            'products.img',
            'inventory.qty'
        )->get();

        return view('sales.index', compact(
            'categories',
            'menus',
            'currentCategoryName'
        ));
    }
}
