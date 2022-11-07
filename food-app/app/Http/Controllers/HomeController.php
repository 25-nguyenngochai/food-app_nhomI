<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Cart;
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

    // Page Shoping-Cart:
    function shopingCart()
    {
        //Category:
        $allCategory = Category::all();
        //
        return view('home.shoping-cart',[
            'allCategory' => $allCategory,
        ]);
    }
        // Add Cart:
        function getAddCart(Request $request, $id)
        {
            $product = Product::find($id);
            $oldCart = Session('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->add($product, $id);
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('thongbao', 'Đặt hàng thành công');
        }
        // Delete cart:
        function getDelCart($id)
        {
            $oldCart = Session('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);
            session::put('cart', $cart);
            return redirect('shoping-cart');
        }
        function getDelCartOne($id)
        {
            $oldCart = Session('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->reduceByOne($id);
            session::put('cart', $cart);
            return redirect('shoping-cart');
        }
    
    // Page checkout:
    function checkout()
    {
        //Category:
        $allCategory = Category::all();
        //
        return view('home.checkout',[
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