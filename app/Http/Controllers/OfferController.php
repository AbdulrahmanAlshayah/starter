<?php

namespace App\Http\Controllers;

use App\Models\ofer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;


class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        //view from to add this offer
        return view('ajaxoffer.create');
    }

    public function store(Request $request){
        //view from to add this offer
        //$file_name = $this->saveImage($request -> photo,'images/offers');

        //insert table offers in database
        ofer::create([
            //'photo' => $file_name,
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en,
        ]);
    }
}
