<?php

namespace App\Http\Controllers;

use App\Models\ofer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
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

    public function store(Request $request){
//
        $rules = $this -> getRules();
        $messages = $this -> getMessages();
        $validator = validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            //return $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        ofer::create([
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
        ]);
        //return redirect()->to('');
        return redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);
    }

    protected function getRules(){
        return $rules = [
            'name' => 'required|max:100|unique:ofers,name',
            'price' => 'required|numeric',
            'details' => 'required'
        ];
    }

    protected function getMessages(){
        return $messages = [
            //'name.required' => trans('offernamerequired') or trans('offer name required'),
            'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer name must be unique'),
            'price.numeric' => 'سعر العرض يجب أن يكون أرقام',
            'price.required' => trans('messages.pricerequired'),
            'details.required' => 'التفاصيل مطلوبة',
        ];
    }
}
