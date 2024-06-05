<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        $currency = Currency::latest()->first()->rate;
        $product = Product::latest()->get();
        return view('admin.product.index', compact('category', 'product', 'currency'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->category_id = $request->category_id;
            $product->save();

            Toastr::success('Product Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        try {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->category_id = $request->category_id;
            $product->status = $request->status;
            $product->save();

            Toastr::success('Product Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            Toastr::success('Product Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
