<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        DB::enableQueryLog();
        $title = "Products";
        $products = Product::with('category')->get();
        return view("dashboard.product.index", [ 'title' => $title, 'products' => $products ]);
    }

    public function create()
    {
        $title = "Create Product";
        return view("dashboard.product.create", ["title" => $title]);
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;

            $imageName = time().'.'.$request->image->extension();
            //$request->image->move(public_path('images'), $imageName);
            Storage::move('images/'.$imageName, $request->image);
            $product->image = 'images/'.$imageName;
            $product->save();
            DB::commit();
            return redirect()->route('categories.index')->with(['success' => 'Created Successfully']);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return redirect()->back()->with(['error' => 'Please Try Again!!']);
        }
    }

    public function show($id)
    {
        dd('Show');
    }

    public function edit(Product $product)
    {
        $title = "Update Product";
        return view("dashboard.product.create", ["title" => $title, 'product' => $product]);
    }

    public function update(Request $request, Product $product)
    {

        try{
            DB::beginTransaction();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->price = $request->price;

            if($request->has('image')){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);

                $product->image = 'images/'.$imageName;
            }

            $product->save();
            DB::commit();
            return redirect()->route('categories.index')->with(['success' => 'Created Successfully']);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return redirect()->back()->with(['error' => 'Please Try Again!!']);
        }
    }

    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return redirect()->route('categories.index')->with(['success' => 'Deleted Successfully']);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return redirect()->back()->with(['error' => 'Please Try Again!!']);
        }
    }
}
