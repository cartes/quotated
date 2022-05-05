<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('cat_parent', '=', null)->get();
        $products = Product::with('seller', 'category', "reviews", 'images', 'status')
            ->whereHas('status', function ($query) {
                $query->where('status', '=', '1');
            })
            ->latest()
            ->paginate(15);

        return view('home')->with([
            'message' => null,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function stored() {
        $categories = Category::where('cat_parent', '=', null)->get();
        $products = Product::with('seller', 'category', "reviews", 'images', 'status')
            ->whereHas('status', function ($query) {
                $query->where('status', '=', '1');
            })
            ->latest()
            ->paginate(15);

        return view('Home')->with([
            'message' => ['type' => 'success', 'text' => 'Su aviso será publicado, una vez revisado'],
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function search(Request $request) {
        $products = Product::where('title', 'like',  '%' . $request->input('search') . '%')
            ->latest()
            ->paginate(15);
        $categories = Category::where('cat_parent', '=', null)->get();

        return view('home')->with([
            'message' => null,
            'products' => $products,
            'categories' => $categories
        ]);

    }

}
