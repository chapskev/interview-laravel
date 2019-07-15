<?php

namespace shopApp\Http\Controllers;

use Illuminate\Http\Request;
use shopApp\Http\Resources\OrderResource;
use shopApp\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Order::paginate(10);

        return OrderResource::collection($suppliers);

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
            'supplier_id'=> 'integer',
            'name'=>'required',
        ]);
        $supplier = Order::findOrFail($request->supplier_id) || new Order;

        $supplier->supplier_id = $request->input('supplier_id');
        $supplier->name = $request->input('name');

        if ($supplier->save()) {
            return new OrderResource($supplier);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function show($supplier_id)
    {
        $supplier = Order::findOrFail($supplier_id);

        return new OrderResource($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function edit($supplier_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplier_id)
    {
        $request->validate([
            'supplier_id'=> 'required|integer',
            'name'=>'required',
        ]);

        $supplier = Order::find($supplier_id);
        $supplier->name = $request->get('name');
        if ($supplier->save()) {
            return new OrderResource($supplier);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $supplier_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier_id)
    {
        $supplier = Order::findOrFail($supplier_id);

        if ($supplier->delete()) {
            return new OrderResource($supplier);
        }
    }
}
