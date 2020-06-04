<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index()
    {
        return view('drug.index');
    }
}
