<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Contact::where('stage','NOT LIKE','1%')->paginate(15);
        return view('admin.customers.index',compact('customers'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $customer)
    {
        //
    }
}
