<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('category')
            ->where('is_deleted', 0)
            ->where('company_id', Auth::user()->company_id)
            ->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $exists = DB::table('category')
            ->where('company_id', Auth::user()->company_id)
            ->where('name', $request->name)
            ->where('is_deleted', 0)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Category already exists!');
        }

        Category::create([
            'name' => $request->name,
            'company_id' => Auth::user()->company_id,
            'created_at' => now()
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category added successfully');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            DB::table('category')
                ->where('id', $id)
                ->where('company_id', Auth::user()->company_id)
                ->update(['is_deleted' => 1]);

        });

        return back()->with('success', 'Category deleted successfully!');
    }
}
