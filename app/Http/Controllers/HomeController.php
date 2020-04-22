<?php

namespace App\Http\Controllers;

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
        $products = Product::where('status', Product::PUBLISHED)
            ->with('seller', 'category', "reviews", 'images')
            ->latest()
            ->paginate(15);

        return view('home')->with('products', $products);
    }
}
