<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['images' => function ($query) {
            $query->limit(1); // Chỉ lấy một ảnh
        }])->get();
        $categories = Category::all();
        $latestProducts = Product::with(['images' => function ($query) {
            $query->limit(1); // Chỉ lấy một ảnh
        }])->where('created_at', '>=', Carbon::now()->subDays(7))->get();

        return view('welcome', compact('products','categories','latestProducts'));
    }
}
