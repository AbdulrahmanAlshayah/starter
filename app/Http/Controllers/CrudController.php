<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\ofer;
use App\Models\video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;


    public function getOffers(){
        //return ofer::select('id','name')->get();
        return ofer::get();
    }

//    public function create(){
////        ofer::create([
////            'name' => 'offer',
////            'price' => '5000',
////            'details' => 'offer details'
////        ]);
//    }

    public function create(){
//
        return view('offer.create');
    }

    public function store(OfferRequest $request){
//
//        $rules = $this -> getRules();
//        $messages = $this -> getMessages();
//        $validator = validator::make($request->all(),$rules,$messages);
//        if ($validator->fails()) {
//            //return $validator->errors();
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }

        $file_name = $this->saveImage($request -> photo,'images/offers');

        ofer::create([
            'photo' => $file_name,
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en,
        ]);
        //return redirect()->to('');
        return redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);
    }



//    protected function getRules(){
//        return $rules = [
//            'name' => 'required|max:100|unique:ofers,name',
//            'price' => 'required|numeric',
//            'details' => 'required'
//        ];
//    }

//    protected function getMessages(){
//        return $messages = [
//            //'name.required' => trans('offernamerequired') or trans('offer name required'),
//            'name.required' => __('messages.offer name required'),
//            'name.unique' => __('messages.offer name must be unique'),
//            'price.numeric' => 'سعر العرض يجب أن يكون أرقام',
//            'price.required' => trans('messages.pricerequired'),
//            'details.required' => 'التفاصيل مطلوبة',
//        ];
//    }

    public function getAllOffers(){
        $offers = ofer::select('id',
            'price',
            'name_'.LaravelLocalization::getCurrentLocale(). ' as name',
            'details_'.LaravelLocalization::getCurrentLocale(). ' as details')->get();
        return view('offer.all',compact('offers'));
    }

    public function editOffer($offer_id){
//        $data = ofer::findOrFail($offer_id)->get();
//        return $data;

        $offer = ofer::find($offer_id); //search in given table id only

        if (!$offer)
            return redirect()->back();

        $offer = ofer::select('id','name_ar','name_en','details_ar','details_en','price')->find($offer_id);
        return view('offer.edit',compact('offer'));
    }

    public function updateOffer(OfferRequest $request,$offer_id){

        //validation

        //check if offer exists
        $offer = ofer::find($offer_id);

        if (!$offer)
            return redirect()->back();

        //update data


        $offer->update($request->all());

        return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);
//        $offer -> update([
//            'name_ar' => $request->name_ar,
//            'name_en' => $request->name_en,
//            'price' => $request->price,
//        ]);

    }

    public function getVideo(){
        $video = video::first();
        event(new VideoViewer($video));//fire event
        return view('video1')->with('video',$video);
    }

}
