<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceitawsController extends Controller
{
    public function index()
    {
        return view('admin.system.receitaws.index');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
