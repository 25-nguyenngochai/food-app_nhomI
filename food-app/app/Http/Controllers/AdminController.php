<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        // Edit Category:
        function getEditCategory($id)
        {
            $allCategory = Category::find($id);
            return view('admin.category.edit-category', compact('allCategory'));
        }

        function postEditCategory(Request $request, $id)
        {
            $data = $request->validate([
                'name' => 'required',
            ]);
            $category = Category::find($id);
            $category->name = $data['name'];
            $category->save();
            return redirect('table-category')->with('success', 'Category edit successfully.');
        }

        // Delete Category:
        function getDelCategory($id)
        {
            $category = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
                                               ->where('categories.id', $id)
                                               ->count();
            if ($category){
                return redirect()->back()->with('success', 'Cannot delete because this category contains product.');
            } else {
                Category::find($id)->delete();
                return redirect()->back()->with('success', 'Category delete successfully.');
            }
        }
}