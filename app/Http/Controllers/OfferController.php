<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\ofer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;
use LaravelLocalization;


class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        //view from to add this offer
        return view('ajaxoffer.create');
    }

    public function store(OfferRequest $request){
        //view from to add this offer
        $file_name = $this->saveImage($request -> photo,'images/offers');

        //insert table offers in database
        $offer = ofer::create([
            'photo' => $file_name,
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en,
        ]);
        if($offer)
        return response() -> json([
            //asisator array
            'status' => true,
            'msg' => 'تم الحفظ بنجاح'
        ]);
        else
        return response() -> json([
            //asisator array
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاولة مجددا'
        ]);
    }

    public function all(){
        $offers = ofer::select('id',
            'price',
            'photo',
            'name_'.LaravelLocalization::getCurrentLocale(). ' as name',
            'details_'.LaravelLocalization::getCurrentLocale(). ' as details')->limit(10)->get();
        return view('ajaxoffer.all',compact('offers'));
    }

    public function delete(Request $request){
        $offer = ofer::find($request->id);   //Offer::where('id',$offer_id)->first();

        if(!$offer)
            return redirect() -> back() -> with(['error'=>__('messages.offer not exist')]);
        $offer ->delete();
        return response() -> json([
            //asisator array
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' => $request->id
        ]);

    }

    public function editOffer(Request $request){
//        $data = ofer::findOrFail($offer_id)->get();
//        return $data;

        $offer = ofer::find($request->offer_id); //search in given table id only

        if (!$offer)
            return response() -> json([
            //asisator array
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاولة مجددا'
        ]);

        $offer = ofer::select('id','name_ar','name_en','details_ar','details_en','price','photo')->find($request->offer_id);
        return view('ajaxoffer.edit',compact('offer'));
    }

    public function updateOffer(Request $request){
         $offer = ofer::find($request->offer_id);

        if (!$offer)
            return response() -> json([
            'status' => false,
            'msg' => 'هذا العرض غير موجود'
        ]);

        //update data


        $offer->update($request->all());

        return response() -> json([
            'status' => true,
            'msg' => 'تم التحديث بنجاح'
        ]);
    }




}
