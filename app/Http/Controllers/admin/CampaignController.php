<?php

namespace App\Http\Controllers\admin;

use App\Campaign;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    public $totalPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::query()->paginate($this->totalPage);
        $contacts = Contact::with(['relContactPhone' => function($query){
            $query->orderBy('rating','DESC');
        }])->paginate($this->totalPage);

        return view('admin.campaign.index',[
            'campaigns'         => $campaigns,
            'contacts'         => $contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
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
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }

    public function search(Request $request, Campaign $campaign, Contact $contact)
    {
        $dataForm = $request->except('_token');

        $campaigns = $campaign->search($dataForm)->paginate($this->totalPage)->appends($dataForm);

        //dd($dataForm)->all();
        return view('admin.campaign.index',[
            'campaigns'         => $campaigns,
            'dataForm'         => $dataForm
        ]);
    }
}
