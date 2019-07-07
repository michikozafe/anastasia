<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Size;
use App\Product;
use Session;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.add_product',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        // dd($request);
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;

        if($request->file('image') != null) {
            $image = $request->file('image');
            $image_name =time(). "." .$image->getClientOriginalExtension();
            // dd($image_name);
            $destination = "images/";
            $image->move($destination, $image_name);
            $product->img_path =$destination.$image_name;
            // dd($product->img_path);
        }
        $product->save();

        Session::flash('success', "$product->name successfully added");
        return  redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $sizes = $product->sizes();
        // dd($sizes);
        $allSizes = Size::all();
        // dd($allSizes);

        $product = Product::with('sizes')->find($id);
        $sizeNames = collect($product->sizes)->pluck('name');
        $allSizes = Size::all();
        $allSizeNames = collect($allSizes)->pluck('name');
        foreach ($allSizeNames as $key => $size) {
            {
                foreach ($sizeNames as $productSize) {
                    if ($size === $productSize) {
                        $allSizeNames->forget($key);
                    }
                }
            }
        }
        // dd($allSizeNames);

        return view('pages.admin.product_item', compact('product', 'sizes', 'allSizes', 'allSizeNames'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $sizes = Size::all();
        $categories = Category::all();

        return view('pages.admin.edit_product', compact('product', 'sizes', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        // dd($item);
        // dd($request);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id= $request->category;

        if($request->file('image') != null) {
            $image = $request->file('image');
            $image_name =time(). "." .$image->getClientOriginalExtension();
            // dd($image_name);
            $destination = "images/";
            $image->move($destination, $image_name);
            $product->img_path =$destination.$image_name;
            // dd($product->img_path);
        }
        $product->save();
        Session::flash('success', "$product->name successfully edited");
        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Session::flash('success', "$product->name successfully deleted");
        return redirect('/admin/products');
    }

    public function updateStock($id, Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required',
        ]);

        $product = Product::find($id);
        $size = Size::find($request->sizeId);
        $product->sizes()->updateExistingPivot($request->sizeId, ['quantity'=>$request->quantity]);
        $product->save();

        Session::flash('success', "You now have $request->quantity $size->name $product->name" );
        return back();
    }

    public function addSize($id, Request $request) {

        $this->validate($request, [
            'size' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::find($id);
        $size_id = Size::where('name', $request->size)->value('id');
        $size_name = Size::where('id', $size_id)->value('name');

        // dd($size_id);
        $product->sizes()->attach($size_id, ['quantity'=>$request->quantity]);
        $product->save();

        Session::flash('success', "You now have $request->quantity $size_name for $product->name" );
        return back();
    }
}
