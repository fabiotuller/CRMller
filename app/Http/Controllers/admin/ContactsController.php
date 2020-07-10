<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\LeadsImportRule;
use App\Imports\LeadsImport;
use App\Contact;
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
        $leads = Contact::where('stage','LIKE','1%')->paginate(15);
        return view('admin.leads.index',compact('leads'));
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
        return view('admin.leads.edit',[
            'lead' => $lead
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
    public function update(Contact $lead, Request $request)
    {
        if (isset($request->firstname)){

            $lead->firstname = $request->firstname;
            $lead->lastname = $request->lastname;
            $lead->document = $request->document;
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                $lead->email = $request->email;
            }
            $lead->phone1 = $request->phone1;
            $lead->save();

            return redirect()->route('lead.index')->with('message', 'Lead Atualizado!');

        }elseif (isset($request->emails_extra) || isset($request->phone2) || isset($request->phone3) || isset($request->phones_extra)){

            if (filter_var($request->emails_extra, FILTER_VALIDATE_EMAIL)){
                $lead->emails_extra = $request->emails_extra;
            }
            $lead->phone2 = $request->phone2;
            $lead->phone3 = $request->phone3;
            $lead->phones_extra = $request->phones_extra;
            $lead->save();

            return redirect()->route('lead.index')->with('message', 'Lead Atualizado!');

        }

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
        //Excel::import(new LeadsImport(), $request->file('file'));

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
