<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\bill_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Wishlist;
use Mailer;

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

    function thanks()
    {
        $allCategory = Category::all();
        return view('home.thanks', [
            'allCategory' => $allCategory,
        ]);
    }
    
    // Page Shop-Details:
    function shopDetails(Request $request)
    {
        //Category:
        $allCategory = Category::all();
        //Product:
        $productId = Product::where('id',$request->product_id)->get();
        foreach ($productId as $key => $value) {
            $category_id = $value->category_id;
            $price = $value->price;
        }
        $productRelated = Product::where('category_id', $category_id)->where('price', $price)->get();
        $countRelated = Product::where('category_id', $category_id)->where('price', $price)->count();
        $product_Category = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.id', $request->product_id)->first();
        return view('home.shop-details',[
            'allCategory' => $allCategory,
            'productId' => $productId,
            'productRelated' => $productRelated,
            'countRelated' => $countRelated,
            'product_Category' => $product_Category,
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
        $Payments = Payment::all();
        //
        return view('home.checkout', [
            'allCategory' => $allCategory,
            'Payments' => $Payments,
        ]);
    }
    function PostCheckout(Request $request)
    {
        require '../resources/mail/sendMail.php';

        if (Auth::check()) {
            $user = Auth::user()->id;
        }
        $KhachHang = Auth::user()->name;
        $cart = Session::get('cart');

        $bill = new Bill;
        $bill->data_order = date('Y-m-d');
        $bill->totalQty = $cart->totalQty;
        $bill->totalPrice = $cart->totalPrice;
        $bill->payment_id = $request->pay;
        $bill->user_id = $user;
        $bill->save();
        foreach ($cart->items as $key => $value) {
            $bill_detail = new bill_detail;
            $bill_detail->bill_id = $bill->id;
            $bill_detail->product_id = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->price = $value['price'] / $value['qty'];
            $bill_detail->save();
        }

        $tenshop = 'Website OGANI';
        $tieude = "<p style='font-size: 20px;font-weight: bold;text-align: center;'>Cảm ơn <span style='color:red'>" . $KhachHang . "</span> đã mua hàng bên mình</p>";
        $noidung = "";
        foreach ($cart->items as $key => $value) {
            $noidung .=
                "<tr>
            <td>" . $key . "</td>
            <td>" . $value['item']['name'] . "</td>
            <td>" . $value['qty'] . "</td>
            <td>" . number_format($value['price'] / $value['qty']) . " VND</td>
        </tr>";
        }

        $titleShop = '
         <div style="background-color: rgb(135,206,235);">
            <h1 style="font-family: auto;text-align: center;height: 30px;padding: 10px">Website OGANI</h1>
        </div>';
        $foodterShop = '<div style="background-color: rgb(135,206,235);height: 30px;padding: 10px;margin-top: 20px;"></div>';
        $total = $cart->totalPrice;
        $maildathang = Auth::user()->email;
        $tenKhachHang = Auth::user()->name;
        $mail = new Mailer();
        $mail->dathangmail($tenshop, $tieude, $noidung, $total, $maildathang, $tenKhachHang, $titleShop, $foodterShop);

        Session::forget('cart');
        return redirect('thanks')->with('thongbao', 'Đặt hàng thành công');
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