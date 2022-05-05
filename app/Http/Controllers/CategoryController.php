<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories');

    }

    public function getCategories($id = null)
    {
        if (!is_null($id)) {
            $categories = Category::whereId($id)->get();
        } else {
            $categories = Category::all();
        }

        return response()->json($categories);
    }

    public function create(Request $request)
    {
        if (request()->ajax()) {
            $producto = new Product;
            $image = new Image;
            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
            }

            $image->picture = $imageName;
            $image->path = '/storage/' . $path;
            $image->save();

            return response()->json(['code' => 200, 'message' => 'HA subido correctamente']);
        }
    }

    public function posts($slug) {
        $categories = Category::all();
        $cat = Category::where('slug', '=', $slug)->select('id', 'title')->first();
        $products = Product::whereCategoryId($cat->id)
            ->latest()
            ->paginate(20);

        //dd($products);

        return view('home')->with([
            'message' => null,
            'products' => $products,
            'category' => $cat->title,
            'categories' => $categories
        ]);
    }
}
