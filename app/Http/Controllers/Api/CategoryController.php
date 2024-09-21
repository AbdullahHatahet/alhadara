<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        return response()->json([
            "status" => 'success',
            "data" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "name"=> "required",
            "image"=> "required|image",
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>'error',
                'message'=>$validate->messages()
            ]);
        }
        try{
            DB::beginTransaction();
            $category = new Category;
            $category->name = $request->name;
            $imageName = Storage::disk('public')->put('' ,$request->image);
            $category->image = 'images/'.$imageName;
            $category->save();
            DB::commit();
            return response()->json([
                'status'=>'success',
                'message'=>'created successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return response()->json([
            'status'=>'error',
                 'message'=>'Please Try Again!!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('products')->find($id);
        return response()->json([
            'status'=>'success',
            'data'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try{
            DB::beginTransaction();
            if($request->has('name')){
                $category->name = $request->name;
            }

            if($request->has('image')){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);

                $category->image = 'images/'.$imageName;
            }

            $category->save();
            DB::commit();
            return response()->json([
                'status'=>'success',
                'message'=>'Updated successfully',
                'data'=>$category
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return response()->json([
                'status'=>'error',
                     'message'=>'Please Try Again!!'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'Deleted successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return response()->json([
                'status'=>'error',
                'message'=>'Please Try Again!!'
            ]);
        }
    }
}
