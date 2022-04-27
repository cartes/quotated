<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Helper;
use App\Image;
use App\Product;
use App\Seller;
use App\Status;
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

    public function detail($category, $slug)
    {
        $product = Product::whereSlug($slug)->with('seller', 'category', 'reviews', 'images', 'status')->first();
        $categories = Category::where('cat_parent', '=', null)->get();

        return view("products.detail")->with(["product" => $product, "categories" => $categories]);

    }

    /* Publications CRUD methods */
    public function list() {
        $user = auth()->user();
        $seller = Seller::whereUserId($user->id)->select(['id'])->first();
        $products = Product::whereSellerId($seller->id)->with(['status', 'images', 'category'])
            ->latest()
            ->get();

        return view('admin.posts')->with(["products" => $products]);
    }

    /* Respuestas API's */

    public function getProductoDetail($id){
        if (request()->ajax()) {
            $product = Product::whereId($id)->select(['id', 'title', 'description', 'price', 'quantity', 'condition', 'created_at', 'category_id'])
                ->with(['status', 'images', 'category'])
                ->first();

            return response()->json($product);
        }
        return abort(401, 'No puedes estar en esta zona');
    }

    public function getCategoryChildren($id)
    {
        if (\request()->ajax()) {
            $categories = Category::where('cat_parent', '=', $id)->get();

            return response()->json($categories);
        }

        return abort(401, 'No puedes estar en esta zona');
    }

    public function getImages($id)
    {
        if (\request()->ajax()) {
            $images = Product::where('id', '=', $id)->with('images', 'seller')->get();

            return response()->json($images[0]);
        }
        return abort(401, 'No puedes estar en esta zona');

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
                $status = new Status();

                $status->status = 0;

                $product->status()->save($status);

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

}
