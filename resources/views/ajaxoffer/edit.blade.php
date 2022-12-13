@extends('layouts.app')
@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم التحديث بنجاح
    </div>

        <br>
        <form method="POST" id="offerFormUpdate" action="" enctype="multipart/form-data">
            @csrf
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                <input type="text" style="display: none;" class="form-control" name="offer_id" value="{{$offer -> id}}">

            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{__('messages.Offer Name')}}">
                @error('name_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}" placeholder="{{__('messages.Offer Name')}}">
                @error('name_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.offer price')}}</label>
                <input type="text" class="form-control" name="price" value="{{$offer -> price}}" placeholder="{{__('messages.Offer Price')}}">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control" name="details_ar" value="{{$offer -> details_ar}}"
                       placeholder="{{__('messages.Offer details')}}">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}"
                       placeholder="{{__('messages.Offer details')}}">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="update_offer" class="btn btn-primary">Update</button>
        </form>


    </div>
</div>

    @stop

@section('scripts')
    <script>
        $(document).on('click','#update_offer',function (e){
            e.preventDefault();

            var formData = new FormData($('#offerFormUpdate')[0]);

            $.ajax({
                type:'post',
                enctype:'multipart/form-data',
                url:"{{route('ajax.offers.update')}}",
                //من شان ترفع اكتر من صورة في دالة اسمها drop zone tools
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data){
                    if (data.status == true){
                        $('#success_msg').show();
                    }
                },error:function (reject){

                }
        });
        });

    </script>
@stop
