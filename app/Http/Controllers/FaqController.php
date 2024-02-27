<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Faq;

class FaqController extends Controller
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
        $data['faqs'] = Faq::all();
        return view('faq_views.showfaqs',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['products'] = Product::all();
        // dd($data['products']);
        return view('faq_views.createfaq',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'question' => 'required',
            'product_id' => 'required',
        ];

        // Validation messages
        $messages = [
            'question.required' => 'Question is required.',
            'product_id.required' => 'Please select a product.',
        ];
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->product_id = $request->product_id;
        $faq->save();
        return redirect()->back()->with(['success'=>'Faq data is inserted!']);
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
        $data['products'] = Product::all();
        $data['faq'] = Faq::findorfail($id);
        return view('faq_views.editfaq',$data);
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
        $faq = Faq::findorfail($id);
        $faq->question = $request->question;
        $faq->product_id = $request->product_id;
        $faq->save();
        return redirect()->back()->with(['success'=>'Faq data is updated!']);
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
        $faq = Faq::findorfail($id);
        $faq->delete();
        return redirect()->back()->with(['success'=>'Faq is deleted!']);
    }
}
