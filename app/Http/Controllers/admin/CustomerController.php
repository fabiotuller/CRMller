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
        $receitaws = $customer->relReceitaws()->first();

        return view('admin.customers.edit',[
            'customer' => $customer,
            'receitaws' => $receitaws
        ]);
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
        if (isset($request->firstname)){

            $customer->firstname = $request->firstname;
            $customer->lastname = $request->lastname;
            $customer->document = $request->document;
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                $customer->email = $request->email;
            }
            $customer->phone1 = $request->phone1;
            $customer->save();

            return redirect()->route('customer.index')->with('message', 'Lead Atualizado!');

        }elseif (isset($request->emails_extra) || isset($request->phone2) || isset($request->phone3) || isset($request->phones_extra)){

            if (filter_var($request->emails_extra, FILTER_VALIDATE_EMAIL)){
                $customer->emails_extra = $request->emails_extra;
            }
            $customer->phone2 = $request->phone2;
            $customer->phone3 = $request->phone3;
            $customer->phones_extra = $request->phones_extra;
            $customer->save();

            return redirect()->route('customer.index')->with('message', 'Lead Atualizado!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('message', 'Cliente Apagado!');
    }
}
