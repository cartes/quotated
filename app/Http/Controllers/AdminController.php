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
        if (request()->ajax()) {
            $categories = Category::all();
            $category = $categories->where('id', $id)->first();

            $data = [
                "categories" => $categories,
                "category" => $category,
            ];

            return response()->json($data);
        }
        return abort(401, "No puedes ver este contenido");
    }

    public function categoryStore() {
        if (request()->ajax()) {
            $category = Category::find(\request('id'));
            $category->title = \request('title');
            $category->order = \request('order');
            $category->cat_parent = \request('cat_parent');

            $category->save();
            return response()->json(['msg' => 'ok']);
        }

        return abort(401, 'No puedes estar en esta zona');

    }
}
