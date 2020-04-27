<?php

namespace App\Http\Controllers;

use App\Category;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function categories()
    {
        return view("admin.categories");
    }

    public function categoriesJSON()
    {
        if (request()->ajax()) {
            $vueTables = new EloquentVueTables();
            $data = $vueTables->get(new Category(), ['id', 'title', 'cat_parent', 'order']);

            return response()->json($data);
        }
        return abort(401);
    }

    public function category_edit($id)
    {
        $categories = Category::all();
        $category = $categories->where('id', $id)->first();

        return view("admin.edit.category")->with([
            'category' => $category,
            'categories' => $categories,
        ]);
    }
}
