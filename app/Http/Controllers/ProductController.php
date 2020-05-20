<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::where('cat_parent', '=', null)->get();

        return view("products.form")->with('categories', $categories);
    }

    public function getCategoryName($id)
    {
        $catName = Category::whereId($id)->select('title')->first();

        return response()->json($catName);
    }

    public function getCategoryChildren($id)
    {
        if (\request()->ajax()) {
            $categories = Category::where('cat_parent', '=', $id)->get();

            return response()->json($categories);
        }

        return abort(401, 'No puedes estar  en esta zona');
    }
}
