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

    // Table Product:
    function tableProduct(Request $request){
        if(isset($request->key)){
            $table_product = Product::where('name', 'like', '%'.$request->key.'%')->orderBy('id', 'desc')
            ->paginate(10)->appends(['key' => $request->key]);
        } else{
            $table_product = Product::orderBy('id', 'desc')->paginate(20);
        }
        return view('admin.product.table-product', [
            'table_product' => $table_product,
        ]);
    }
        // Add Product:
        function getAddProduct(){
            $allCategory = Category::orderBy('id', 'desc')->get();
            return view('admin.product.add-product', [
                'allCategory' => $allCategory,
            ]);
        }

        function postAddProduct(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'upload_image' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'date_added' => 'required',
                'expiration_date' => 'required',
            ]);
    
           //Lưu hình thẻ khi có file hình
           if ($request->hasFile('upload_image')) {
                $request->validate( 
                    [
                        'upload_image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                    ],			
                    [
                        'upload_image.mimes' => 'Required image file extension .jpg .jpeg .png .gif',
                        'upload_image.max' => 'Image size limit no more than 2M',
                    ]
                );
        
                $file = $request->upload_image;
                $file_name = $file->getClientOriginalName();
                $file-> move(public_path('images'), $file_name);
                $request->merge(['image' => $file_name]);
            }
    
            $input = $request->all();
            Product::create($input);
            
            return redirect('table-product')->with('success', 'Product created successfully.');
        }

    function editProduct(){
        return view('admin.product.edit-product');
    }

    // Table Category:
    function tableCategory(){
        $table_category = Category::orderBy('id', 'desc')->paginate(10)->appends(['category'=>'category']);        
        return view('admin.category.table-category', [
            'table_category' => $table_category,
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
                $checkCategory = Category::find($id);
                if ($checkCategory == null) {
                    return redirect()->back()->with('success', 'Category has been deleted or does not exist.');
                } else {
                    Category::find($id)->delete();
                    return redirect()->back()->with('success', 'Category delete successfully.');
                }
            }
        }
}