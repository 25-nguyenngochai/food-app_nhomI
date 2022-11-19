<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Payment;
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

        // Edit Product:
        function getEditProduct($id){
            $allProduct = Product::find($id);
            $allCategory = Category::orderBy('id', 'desc')->get();
            
            if ($allProduct == null) {
                return redirect('table-product')->with('success', 'Product has been deleted or does not exist.');
            } else {
                return view('admin.product.edit-product', compact('allProduct', 'allCategory'));
            }
        }

        function postEditProduct(Request $request, $id)
        {
            $data = $request->validate([
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
            ]);
            $product = Product::find($id);
            
            $product->name = $data['name'];
            $product->price = $data['price'];
            if ($request->hasFile('upload_image')) {
                //
                $delImage = 'images/'.$product->image;
                if (file_exists($delImage)) {
                    unlink($delImage);
                }
                //
                $file = $request->upload_image;
                $file_name = $file->getClientOriginalName();
                $file-> move(public_path('images'), $file_name);
                $request->merge(['image' => $file_name]);
                $product->image = $file_name;   
            }   else {
                $product->image = $request->value_image;
            }         
            $product->category_id = $request->category_id;
            $product->description = $data['description'];
            $product->date_added = $request->date_added;
            $product->expiration_date = $request->expiration_date;
            $product->save();

            return redirect('table-product')->with('success', 'Product edit successfully.');
        }

        // Delete Product:
        function getDelProduct($id)
        {
            $checkProduct = Product::find($id);

            if ($checkProduct == null) {
                return redirect()->back()->with('success', 'Product has been deleted or does not exist.');
            } else {
                $delImage = 'images/'.$checkProduct->image;
                if (file_exists($delImage)) {
                    unlink($delImage);
                }
                $checkProduct->delete();
                return redirect()->back()->with('success', 'Product delete successfully.');
            }
        }

    // Table Category:
    function tableCategory(){
        $table_category = Category::orderBy('id', 'desc')->paginate(10);        
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

            if ($allCategory == null) {
                return redirect('table-category')->with('success', 'Category has been deleted or does not exist.');
            } else {
                return view('admin.category.edit-category', compact('allCategory'));
            }
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
                    $checkCategory->delete();
                    return redirect()->back()->with('success', 'Category delete successfully.');
                }
            }
        }
    
    // Table Payment:
    function tablePayment(){
        $table_payment = Payment::orderBy('id', 'desc')->paginate(10);        
        return view('admin.payment.table-payment', [
            'table_payment' => $table_payment,
        ]);
    }

        // Add Payment:
        function getAddPayment(){
            return view('admin.payment.add-payment');
        }

        function postAddPayment(Request $request)
        {
            $request->validate([
                'name' => 'required'
            ]);
            $add_payment = $request->all();
            Payment::create($add_payment);
            return redirect('table-payment')->with('success', 'Payment created successfully.');
        }

        // Edit Payment:
        function getEditPayment($id)
        {
            $allPayment = Payment::find($id);

            if ($allPayment == null) {
                return redirect('table-payment')->with('success', 'Payment has been deleted or does not exist.');
            } else {
                return view('admin.payment.edit-payment', compact('allPayment'));
            }
        }

        function postEditPayment(Request $request, $id)
        {
            $data = $request->validate([
                'name' => 'required',
            ]);
            $payment = Payment::find($id);
            $payment->name = $data['name'];
            $payment->save();
            return redirect('table-payment')->with('success', 'Payment edit successfully.');
        }
}