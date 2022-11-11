<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;


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
        // Category:
        $allCategory = Category::all();
        // Product:
        if(isset($request->category_id)){
            $allProduct = Product::where('category_id',$request->category_id)->orderBy('id', 'desc')
            ->paginate(16)->appends(['category_id' => $request->category_id]);
        }
        else{
            $allProduct = Product::orderBy('id', 'desc')->paginate(16);
        }

        return view('home.index',[ 
            'allCategory' => $allCategory,
            'allProduct' => $allProduct,
        ]);
    }

    // Page Seach:
    function my_seach()
    {
        // Category:
        $allCategory = Category::all();
        // Seach::
        if (isset($_GET['key'])) {
            $search_text = trim($_GET['key']);
            if (!empty($search_text)) {
                $seachAll = Product::where('name', 'like', '%' . $search_text . '%')
                ->orderBy('id', 'desc')->paginate(6)->appends(['key' => $search_text]);
                $countSeachAll = Product::where('name', 'like', '%' . $search_text . '%')->count();
                foreach($seachAll as &$row){
                    $row->name = preg_replace('/(' .$search_text. ')/i', '<b style="color:red">$1</b>', $row->name);   
                  }         
                return view('home.my-seach', [
                    'allCategory' => $allCategory,
                    'seachAll' => $seachAll,
                    'countSeachAll' => $countSeachAll,
                ]); 
            } 
        }
    }
    
    // Page Shop-Gird:
    function shopGrid(Request $request)
    {
        // Category:
        $allCategory = Category::all();
        // Product:
        $allProduct = Product::where('category_id',$request->category_id)->orderBy('id', 'desc')
            ->paginate(12)->appends(['category_id' => $request->category_id]);
        $countAllProduct = Product::where('category_id',$request->category_id)->count();
        return view('home.shop-grid',[
            'allCategory' => $allCategory,
            'allProduct' => $allProduct,
            'countAllProduct' => $countAllProduct,
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
            return redirect()->back();
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

    // Page Wishlist:
    function favourite()
    {
        //Category:
        $allCategory = Category::all();
        //Wishlist:
        if (Auth::check()){
            $user = Auth::user()->id;
        }
        
        $allWishlist = DB::table('wishlists')->join('products', 'wishlists.product_id', '=', 'products.id')
                                             ->where('wishlists.user_id', $user)
                                             ->orderBy('wishlists.id', 'desc')
                                             ->paginate(5);                              
        return view('home.favourite',[
            'allCategory' => $allCategory,
            'allWishlist' => $allWishlist,
        ]);
    }
        // Update Wishlist:
        function updateWishlist(Request $request)
        {
            if (Auth::check()){
                $user = Auth::user()->id;
            }
            
            if ($request->ajax()){
                $data = $request->all();
                $countWishlist = Wishlist::countWishlist($data['product_id']);
                $wishlist =  new Wishlist;
                if($countWishlist == 0) {
                    $wishlist->product_id = $data['product_id'];
                    $wishlist->user_id = $data['user_id'];
                    $wishlist->save();
                    return response()->json(['action' => 'add', 'message' => 'Added a product to favorites!']);
                } else {
                    Wishlist::where(['user_id' => $user, 'product_id' => $data['product_id']])->delete();
                    return response()->json(['action' => 'del', 'message' => 'Removed a product from favorites!']);
                }
            }
        }

    // Page checkout:
    function checkout()
    {
        //Category:
        $allCategory = Category::all();
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