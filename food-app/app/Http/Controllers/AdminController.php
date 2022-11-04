<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;


class AdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // Page
    function index(){
        return view('admin.admin-index');
    }

    function tableProduct(){
        return view('admin.product.table-product');
    }

    function addProduct(){
        return view('admin.product.add-product');
    }

    function editProduct(){
        return view('admin.product.edit-product');
    }

    function tableCategory(){
        return view('admin.category.table-category');
    }

    // Add Category:
    function fileAddCategory(){
        return view('admin.category.add-category');
    }
    function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $input = $request->all();
        Category::create($input);
        return redirect('table-category')->with('success', 'Category created successfully.');
    }

    function editCategory(){
        return view('admin.category.edit-category');
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
