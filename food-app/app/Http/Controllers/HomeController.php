<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;


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
    //
    function checkUserType()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        } elseif (Auth::user()->user_type === 'user') {
            return redirect('/');
        } elseif (Auth::user()->user_type === 'admin') {
            return redirect('home.shop-grid');
        }
    }
    // Page Register:

    // function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:users',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'password' => 'required',
    //         'confirm-password' => 'required|same:password',
	// 	]);
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->phone = $request->phone;
    //     $user->address = $request->address;
    //     $user->password = bcrypt($request->password);
    //     if ($request->hasFile('upload_image')) {
    //         $file = $request->upload_image;
    //         $file_name = $file->getClientOriginalName();
    //         $file-> move(public_path('images'), $file_name);
    //         $request->merge(['image' => $file_name]);
    //         $user->image = $file_name;
    //     } else {
    //         $user->image = $request->value_image;
    //     }
    //     $user->save();
    //     return redirect('home.login-register.login');
    // }
}
