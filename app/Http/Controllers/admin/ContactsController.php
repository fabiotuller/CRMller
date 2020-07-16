<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Strings;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactsRequest;
use App\Imports\LeadsImportRule;
use App\Contact;
use App\ContactPhone;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $leads = Contact::where('stage','LIKE','1%')->with(['relContactPhone' => function($query){
            $query->orderBy('rating','DESC');
        }])->paginate(15);

        return view('admin.leads.index',[
            'leads'         => $leads
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $lead)
    {
        $receitaws = $lead->relReceitaws()->first();
        $contactPhone = $lead->relContactPhone()->orderBy('rating','DESC')->get();

        return view('admin.leads.edit',[
            'lead'              => $lead,
            'receitaws'         => $receitaws,
            'contactPhone'      => $contactPhone
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $lead)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Contact $lead, ContactsRequest $request)
    {
        $lead->firstname = $request->firstname;
        $lead->lastname = $request->lastname;
        $lead->document = $request->document;
        $lead->email = $request->email;
        $lead->emails_extra = $request->emails_extra;

        $lead->save();

        $phones = $lead->relContactPhone()->get();

        if (count($phones) == 0){
            $newphone = new ContactPhone();
            $newphone->phone = $request['phoneid'];
            $newphone->rating = $request['ratingid'];
            $newphone->contact_id = $lead->id;
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

        return redirect()->route('lead.index')->with('message', 'Lead Atualizado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $lead)
    {
        $lead->delete();
        return redirect()->route('lead.index')->with('message', 'Lead Apagado!');
    }

    public function import(Request $request)
    {
        Excel::import(new LeadsImportRule(),$request->file('file'));

        return redirect()->back()->with('message', 'A importação foi realizada com sucesso!');
    }

    public function exportModel()
    {
        $file = public_path('storage').'/modelImportLeads.xlsx';
        $header = [
          'Content-Type: application/xslx'
        ];

        return response()->download($file,'Model Import Leads.xlsx',$header);
    }
}
