@extends('layouts.app')
@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            {{__('messages.Add your offer')}}
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

         <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}

              <div class="form-group">
                <label for="exampleInputEmail1">أختر صوره العرض</label>
                <input type="file" class="form-control" name="photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.Offer Name ar')}}">
                @error('name_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
             <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.Offer Name en')}}">
                @error('name_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer price')}}</label>
                <input type="text" class="form-control" name="price" placeholder="{{__('messages.Offer price')}}">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control" name="details_ar" placeholder="{{__('messages.Offer details ar')}}">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
             <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.Offer details en')}}">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="save-offer" class="btn btn-primary">Save Offer</button>
        </form>
    </div>
</div>

    </div>

@stop

@section('scripts')
    <script>
        $(document).on('click','#save-offer',function (e){
            e.preventDefault();
            $.ajax({
           type:'post',
            url:"{{route('ajax.offers.store')}}",
            data:{
                '_token':"{{csrf_token()}}",//اذا ما حطيت token بيعطيك خطأ 419
                // 'photo': $("input[name='photo']").val(),
                'name_ar': $("input[name='name_ar']").val(),
                'name_en': $("input[name='name_en']").val(),
                'price': $("input[name='price']").val(),
                'details_ar': $("input[name='details_ar']").val(),
                'details_en': $("input[name='details_en']").val(),
            },
            success: function (data){
            },error:function (reject){

            }
        });
        });

    </script>
@stop
