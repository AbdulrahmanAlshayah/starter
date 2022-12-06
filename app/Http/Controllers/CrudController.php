<?php

namespace App\Http\Controllers;

use App\Models\ofer;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function getOffers(){
        //return ofer::select('id','name')->get();
        return ofer::get();
    }

    public function store(){
        ofer::create([
            'name' => 'offer',
            'price' => '5000',
            'details' => 'offer details'
        ]);
    }
}
