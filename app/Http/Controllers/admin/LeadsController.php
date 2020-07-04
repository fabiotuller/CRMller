<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\LeadsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new LeadsImport(), $request->file('file'));
        return $this->index();
    }

    public function index(){
        $leads = DB::select('select * from leads');
        return view('admin.leads.index',compact('leads'));
    }
}
