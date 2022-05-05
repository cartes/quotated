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
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function list()
    {
        $user = auth()->user();
        $seller = Seller::whereUserId($user->id)->select(['id'])->first();
        $products = Product::whereSellerId($seller->id)->with(['status', 'images', 'category'])
            ->latest()
            ->get();

        return view('admin.posts')->with(["products" => $products]);
    }

    public function edit($id)
    {
        $user = auth()->user();
        $seller = Seller::whereUserId($user->id)->select('id')->first();

        $product = Product::whereId($id)->where('seller_id', '=', $seller->id)->select('id')->first();

        return view('admin.productEdit')->with(["idProduct" => $product->id]);

    }

    /* Respuestas API's */

    public function getProductoDetail($id)
    {
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

    public function updateProduct(Request $request)
    {
        if (\request()->ajax()) {
            $user = auth()->user();
            $seller = Seller::firstOrCreate(['user_id' => $user->id],
                ["user_id" => $user->id]
            );

            $product = Product::whereId(\request('id'))
                ->where('seller_id', '=', $seller->id)
                ->update([
                    'description' => \request('description'),
                    'price' => \request('price'),
                    'condition' => \request('condition'),
                ]);

            $images = \request('picture');
            if (!is_null($images)) {
                foreach ($images as $image) {
                    $imgPath = Storage::disk('public')->put('products/' . \request('id'), $image);
                    $image = new Image();
                    $image->picture = $request->title;
                    $image->path = $imgPath;
                    $image->imageable_type = 'App\\Product';
                    $image->imageable_id = \request('id');

                    $image->save();
                }
            }


            return response()->json([
                'code' => 200,
                'message' => 'updated'
            ]);
        }

        return abort(401, "No puedes estar en esta zona");

    }

    public function delete($id)
    {
        if (\request()->ajax()) {
            Product::whereId($id)->delete();

            return response()->json(['code' => 200, 'message' => 'Producto Borrado']);

        }
        return abort(401, "No puedes estar en esta zona");

    }

    public function deleteImage($id)
    {
        if (\request()->ajax()) {
            Image::whereId($id)->delete();

            return response()->json(['code' => 200, 'message' => 'Imagen Borrada']);
        }

        return abort(401, "No puedes estar en esta zona");
    }
}
