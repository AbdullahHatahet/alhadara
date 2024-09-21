<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Categories";
        $categories = Category::all();
        return view("dashboard.category.index", ["title" => $title, "categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Category";
        return view("dashboard.category.create", ["title" => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $category = new Category;
            $category->name = $request->name;

            //$imageName = time().'.'.$request->image->extension();
            //$request->image->move(public_path('images'), $imageName);
            // $imageName = Storage::disk('images')->put('' ,$request->image);
            $imageName = Storage::disk('vip')->put('' ,$request->image);

            $category->image = 'images/'.$imageName;
            $category->save();
            DB::commit();
            return redirect()->route('categories.index')->with(['success' => 'Created Successfully']);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return redirect()->back()->with(['error' => 'Please Try Again!!']);
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
        dd('Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = "Update Category";
        return view("dashboard.category.create", ["title" => $title, 'category' => $category]);
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
            $category->name = $request->name;

            if($request->has('image')){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);

                $category->image = 'images/'.$imageName;
            }

            $category->save();
            DB::commit();
            return redirect()->route('categories.index')->with(['success' => 'Created Successfully']);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return redirect()->back()->with(['error' => 'Please Try Again!!']);
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
            return redirect()->route('categories.index')->with(['success' => 'Deleted Successfully']);
        }
        catch(\Exception $e){
            DB::rollback();
            \Log::debug($e->getMessage());
            return redirect()->back()->with(['error' => 'Please Try Again!!']);
        }
    }
}
