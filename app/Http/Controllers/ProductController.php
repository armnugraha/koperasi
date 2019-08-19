<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Session, Validator, DB, Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));
            $data = Product::select(DB::raw('@rownum  := @rownum  + 1 AS no'),'products.*');

            return Datatables::of($data)->make(true);
        }

        return view("products.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        
        $validator = Validator::make($requestData, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/products/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Product::create($requestData);

        Session::flash('flash_message', 'Product added!');

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        $getProduct = Product::findOrFail($product->id);

        return view("products.show", compact("getProduct"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/products/'.$product->id.'edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $getProduct = Product::findOrFail($product->id);
        $getProduct->update($requestData);

        Session::flash('flash_message', 'Product updated!');

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
