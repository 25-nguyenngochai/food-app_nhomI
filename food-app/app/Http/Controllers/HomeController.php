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
    
    // Page Index:
    function index(Request $request){
        //Category:
        $allCategory = Category::all();
        //Product:
        if(isset($request->category_id)){
            $allProduct = Product::where('category_id',$request->category_id)->orderBy('id', 'desc')
            ->paginate(16)->appends(['category_id' => $request->category_id]);
        }
        else{
            $allProduct = Product::orderBy('id', 'desc')->paginate(16);
        }
        //
        return view('home.index',[ 
            'allCategory' => $allCategory,
            'allProduct' => $allProduct,
        ]);
    }
    
    // Page Shop-Gird:
    function shopGrid()
    {
        //Category:
        $allCategory = Category::all();
        return view('home.shop-grid',[
            'allCategory' => $allCategory,
        ]);
    }

    // Page Shop-Details:
    function shopDetails()
    {
        //Category:
        $allCategory = Category::all();
        return view('home.shop-details',[
            'allCategory' => $allCategory,
        ]);
    }

    // Page Contact:
    function contact()
    {
        //Category:
        $allCategory = Category::all();
        return view('home.contact',[
            'allCategory' => $allCategory,
        ]);
    }
}