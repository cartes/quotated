<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Helper;
use App\Image;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        if (\request()->ajax()) {
            DB::transaction(function () use ($request) {
                $user = auth()->user();
                $seller = Seller::firstOrCreate(['user_id' => $user->id],
                    ["user_id" => $user->id]
                );

                $title = $request->title;
                $category_id = $request->catId;
                $condition = $request->condition;
                $price = $request->price;
                $description = $request->description;
                $images = $request->picture;

                $rnd = rand(1000, 9999);
                $slug = Str::slug($title . '-' . $rnd);

                $product = Product::create([
                    'seller_id' => $seller->id,
                    'title' => $title,
                    'slug' => $slug,
                    'category_id' => $category_id,
                    'condition' => $condition,
                    'price' => $price,
                    'description' => $description
                ]);

                foreach ($images as $image) {
                    $imgPath = Storage::disk('public')->put('products/' . $product->id, $image);
                    $image = new Image();
                    $image->picture = $title;
                    $image->path = $imgPath;

                    $product->images()->save($image);
                }
            });
            return response()->json($request);
        }

        return abort(401, "No puedes estar en esta zona");
    }

    public function detail($category, $slug)
    {
        $product = Product::whereSlug($slug)->with('seller', 'category', 'reviews', 'images', 'status')->first();
        $categories = Category::where('cat_parent', '=', null)->get();

        return view("products.detail")->with(["product" => $product, "categories" => $categories]);

    }
}
