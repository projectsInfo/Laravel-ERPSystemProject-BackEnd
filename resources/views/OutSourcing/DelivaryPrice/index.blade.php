@extends('layouts.app')
@section('content')
<div>
    <section class="widget delivary-company">
        <div class="container-fluid">
        <h1 class="widget-title mb-0">{{trans('delivaryprice.store')}}</h1>
            <div class="widget-content mt-5">
                <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit">
                    @csrf
                    <div class="row">
                        <!-- Form inputs -->
                        <div class="col-12">
                            <div class="row">
                                <!-- City Fees -->
                                <div class="col-12">
                                    @forelse ($DelivaryPrice as $item)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                                                    <select name="city[]" id="city-edit" class="form-control city"
                                                        title="Please select a City">
                                                        <option value="">{{trans('Forms.selectCity')}}</option>
                                                        @foreach ($City as $Cities)
                                                        <option value="{{$Cities->id}}" @if ($item->city_id == $Cities->id)
                                                            selected
                                                        @endif>{{$Cities->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text" class="w-100">{{trans('Forms.price')}}</label>
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <input type="hidden" name="DelivaryCompanieDetailsId[]" id="DelivaryCompanieDetailsId-edit" value="{{$item->id}}">
                                                            <input type="number" step="0.01" min="0.01" name="price[]" id="price-edit" class="form-control w-100 d-inline" aria-describedby="price" value="{{$item->price}}" >
                                                        </div>
                                                        <div class="col-3">
                                                                @if ($loop->first)
                                                                <button type="button" class="d-block general-btn create-delivary-city"><i class="fas fa-plus"></i></button>
                                                                @else
                                                                <button type="button" id_delete="{{$item->id}}" class="d-block general-btn delete-delivary-city"><i class="fas fa-times"></i></button>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                                                    <select name="city[]" id="city-edit" class="form-control city"
                                                        title="Please select a City">
                                                        <option value="">{{trans('Forms.selectCity')}}</option>
                                                        @foreach ($City as $Cities)
                                                        <option value="{{$Cities->id}}">{{$Cities->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text" class="w-100">{{trans('Forms.price')}}</label>
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <input type="hidden" name="DelivaryCompanieDetailsId[]" id="DelivaryCompanieDetailsId-edit" value="0">
                                                            <input type="number" step="0.01" min="0.01" name="price[]" id="price-edit" class="form-control w-100 d-inline" aria-describedby="price" value="" >
                                                        </div>
                                                        <div class="col-3">
                                                            
                                                            <button type="button" class="d-block general-btn text-center create-delivary-city"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                   

                                        <div class="create-delivary-city-info col-12" data-select-delivary-city='
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <input type="hidden" name="DelivaryCompanieDetailsId[]" value="0">
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <select name="city[]"  class="form-control city"
                                                            title="Please select a City">
                                                            <option value="">Select a City</option>
                                                            @foreach ($City as $Cities)
                                                            <option value="{{$Cities->id}}">{{$Cities->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="text" class="w-100">price</label>
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <input type="number" step="0.01" min="0.01" name="price[]" id="price" class="form-control w-100 d-inline" aria-describedby="price" value="" >
                                                            </div>
                                                            <div class="col-3">
                                                                <button type="button" id_delete="0" class="d-block general-btn text-center danger delete-delivary-city"><i class="fas fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        '>
                                        </div>
                                    </div>
                                </div>
      
    
    
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row btns">
                                <button type="submit" class="btn save-btn mt-4"><i
                                        class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                                <button type="reset" class="exit-btn reset-btn btn btn-reset mt-4"><i
                                        class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Start all users section -->


</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{ asset('assist/scripts/modules/delivary/price.js')}}"></script>

@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" />
@endsection

