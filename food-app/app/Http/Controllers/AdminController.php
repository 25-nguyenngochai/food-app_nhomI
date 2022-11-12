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
// Table Category:
    function tableCategory(){
        $table_category = Category::orderBy('id', 'desc')->paginate(10)->appends(['catalog'=>'catalog']);        
        return view('admin.category.table-category', [
            'table_category' => $table_category
        ]);
    }

        // Add Category:
        function getAddCategory(){
            return view('admin.category.add-category');
        }

        function postAddCategory(Request $request)
        {
            $request->validate([
                'name' => 'required'
            ]);
            $add_category = $request->all();
            Category::create($add_category);
            return redirect('table-category')->with('success', 'Category created successfully.');
        }

    function editCategory(){
        return view('admin.category.edit-category');
    }
}