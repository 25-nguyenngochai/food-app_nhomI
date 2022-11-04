<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;


class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // Page
    function index(){
        $allCategory = Category::all();
        $allProduct = Product::all();
        return view('home.index',[ 
            'allCategory' => $allCategory,
            'allProduct' => $allProduct,
        ]);
    }
    function shopGrid()
    {
        $allCategory = Category::all();
        //code
        return view('home.shop-grid',[
            'allCategory' => $allCategory,
        ]);
    }
}
