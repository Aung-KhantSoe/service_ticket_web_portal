<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Price;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['products'] = Product::all();
        return view('product_views.showproducts',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product_views.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation rules
        $rules = [
            'name' => 'required',
            'service_ticket_price' => 'required',
            'change_request_price' => 'required',
        ];

        // Validation messages
        $messages = [
            'name.required' => 'Name is required.',
            'service_ticket_price.required' => 'Service Ticket Price is required.',
            'change_request_price.required' => 'Change Request Price is required.',
        ];

        $product = new Product();
        $product->name = $request->name;
        $product->save();

        $price = new Price();
        $price->product_id = $product->id;
        $price->service_ticket_price = $request->service_ticket_price;
        $price->change_request_price = $request->change_request_price;
        $price->save();
        return redirect()->back()->with(['success'=>'Product data is inserted!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['product'] = Product::findorfail($id);
        return view('product_views.editproduct',$data);

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
        //
        $product = Product::findorfail($id);
        $product->name = $request->name;
        $product->save();

        $price = $product->price;
        $price->product_id = $product->id;
        $price->service_ticket_price = $request->service_ticket_price;
        $price->change_request_price = $request->change_request_price;
        $price->save();
        return redirect()->back()->with(['success'=>'Product data is updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findorfail($id);
        $product->delete();
        return redirect()->back()->with(['success'=>'Product data is deleted!']);
    }
}
