<?php

namespace App\Http\Controllers\admin;

use App\ContactPhone;
use App\Helpers\Strings;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Http\Requests\ContactsRequest;
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
        $customers = Contact::where('stage','NOT LIKE','1%')->with(['relContactPhone' => function($query){
            $query->orderBy('rating','DESC');
        }])->paginate(15);

        return view('admin.customers.index',[
            'customers'         => $customers
        ]);
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
        $contactPhone = $customer->relContactPhone()->orderBy('rating','DESC')->get();

        return view('admin.customers.edit',[
            'customer'          => $customer,
            'receitaws'         => $receitaws,
            'contactPhone'      => $contactPhone
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
    public function update(Contact $customer, ContactsRequest $request)
    {
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->document = $request->document;
        $customer->email = $request->email;
        $customer->emails_extra = $request->emails_extra;

        $customer->save();

        $phones = $customer->relContactPhone()->get();

        if (count($phones) == 0){
            $newphone = new ContactPhone();
            $newphone->phone = $request['phoneid'];
            $newphone->rating = $request['ratingid'];
            $newphone->contact_id = $customer->id;
            $newphone->save();
        }

        foreach ($phones as $phone){
            ContactPhone::where('id',$phone->id)->update([
                'phone' => Strings::phone($request['phoneid'.$phone->id])
            ]);
            ContactPhone::where('id',$phone->id)->update([
                'rating' => $request['ratingid'.$phone->id]
            ]);
        }

        return redirect()->route('customer.index')->with('message', 'Customer Atualizado!');
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
