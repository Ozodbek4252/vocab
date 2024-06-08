<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->only('name'));

        toastr(trans('body.Created successfully'));

        return redirect()->route('categories.index');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));

        toastr(trans('body.Updated successfully'));

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        toastr(trans('body.Deleted successfully'));

        return redirect()->route('categories.index');
    }
}
