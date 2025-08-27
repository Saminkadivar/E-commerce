<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        $latestProducts = Product::latest()->take(8)->get();
        $products = Product::latest()->take(8)->get();

        return view('user.index', compact('categories','latestProducts','products'));
    }


    public function userDashboard()
    {
        return view('user.dashboard');
    }

    public function vendorDashboard()
    {
        return view('vendor.dashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}

