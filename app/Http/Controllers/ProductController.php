<?php

namespace shopApp\Http\Controllers;

use Illuminate\Http\Request;
use shopApp\Http\Resources\ProductResource;
use shopApp\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return ProductResource::collection($products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id'=> 'integer',
            'name'=>'required',
        ]);
        $product = Product::findOrFail($request->product_id) || new Product;

        $product->product_id = $request->input('product_id');
        $product->name = $request->input('name');

        if ($product->save()) {
            return new ProductResource($product);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);

        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $request->validate([
            'product_id'=> 'required|integer',
            'name'=>'required',
        ]);

        $product = Product::find($product_id);
        $product->name = $request->get('name');
        if ($product->save()) {
            return new ProductResource($product);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($product->delete()) {
            return new ProductResource($product);
        }
    }
}
