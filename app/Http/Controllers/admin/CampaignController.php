<?php

namespace App\Http\Controllers\admin;

use App\Campaign;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        return view('admin.campaign.index',[
            'campaigns'         => $campaigns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaigns = Campaign::query()->paginate($this->totalPage);
        $contacts = Contact::with(['relContactPhone' => function($query){
            $query->orderBy('rating','DESC');
        }])->paginate($this->totalPage);

        $stages = DB::table('contact_stage_option')->get();
        $region = DB::table('receitaws')->select('uf')->distinct()
            ->where('uf','!=',NULL)->get();
        $city = DB::table('receitaws')->select('municipio')->distinct()
            ->where('municipio','!=',NULL)->get();

        return view('admin.campaign.create',[
            'campaigns'         => $campaigns,
            'contacts'          => $contacts,

            'stages'            => $stages,
            'region'            => $region,
            'city'              => $city
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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

    public function search(Request $request, Campaign $campaign)
    {
        $dataForm = $request->except('_token','_method');
        $campaigns = $campaign->search($dataForm)->paginate($this->totalPage)->appends($dataForm);

        return view('admin.campaign.index',[
            'campaigns'         => $campaigns,
            'dataForm'         => $dataForm
        ]);
    }

    public function searchCreate(Request $request, Campaign $campaign, Contact $contact)
    {
        $dataForm = $request->except('_token','_method');
        if (!is_null($dataForm['stage']))
            $request->session()->put('campaign_create_filter_stage',$dataForm['stage']);
        else
            $request->session()->put('campaign_create_filter_stage','');
        if (!is_null($dataForm['region']))
            $request->session()->put('campaign_create_filter_region',$dataForm['region']);
        else
            $request->session()->put('campaign_create_filter_region','');
        if (!is_null($dataForm['city']))
            $request->session()->put('campaign_create_filter_city',$dataForm['city']);
        else
            $request->session()->put('campaign_create_filter_city','');

        $contacts = $contact->searchCreate($dataForm)->paginate($this->totalPage)->appends($dataForm);

        $stages = DB::table('contact_stage_option')->get();
        $region = DB::table('receitaws')->select('uf')->distinct()
            ->where('uf','!=',NULL)->get();
        $city = DB::table('receitaws')->select('municipio')->distinct()
            ->where('municipio','!=',NULL)->get();

        return view('admin.campaign.create',[
            'contacts'         => $contacts,
            'dataForm'         => $dataForm,

            'stages'            => $stages,
            'region'            => $region,
            'city'              => $city
        ]);
    }
}
