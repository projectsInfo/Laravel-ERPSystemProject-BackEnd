@extends('layouts.app')
@section('content')
<div>
    <section class="widget delivary-company">
        <div class="container-fluid">
        <h1 class="widget-title mb-0">{{trans('delivaryCompany.delivaryCompany')}}</h1>
            <div class="widget-content mt-5">
                <form  method="POST" action="{{ route('delivarycompany.update',) }}"  class="general-form form-create">
                    @csrf
                    @method('PUT')

                    <!-- Form inputs -->
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}}</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            aria-describedby="name" placeholder="{{trans('Forms.name')}}">
                                    </div>
                                </div>
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{trans('Forms.phone')}}</label>
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                            placeholder="{{trans('Forms.phone')}}">
                                    </div>
                                </div>


                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{trans('Forms.address')}}</label>
                                        <textarea name="address" id="address" class="form-control textAreaHeight"
                                            aria-describedby="address" placeholder="{{trans('Forms.address')}}"></textarea>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{trans('Forms.email')}}</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            aria-describedby="email" placeholder="{{trans('Forms.email')}}">
                                    </div>
                                </div>

                                <!-- City Fees -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                                                <select name="city[]" class="form-control city"
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
                                                        <input type="number" step="0.01" min="0.01" name="price[]" id="price" class="form-control w-100 d-inline" aria-describedby="price" value="" >
                                                    </div>
                                                    <div class="col-3">
                                                        <button type="button" class="d-block general-btn create-delivary-city"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="create-delivary-city-info col-12" data-select-delivary-city='
                                        <div class="row">
                                            <div class="col-md-6">
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
                                                                <button type="button" class="d-block general-btn delete-delivary-city"><i class="fas fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        '>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 order-3">
                                    <div class="row btns">
                                        <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>
                                        {{trans('Forms.save')}}</button>
                                        <button type="reset" class="exit-btn reset-btn btn mt-4"><i
                                                class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6 d-none d-lg-block">
                            <div class="bg-delivary-company"></div>
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
<script src="{{ asset('assist/scripts/modules/Company/delivary-company.js')}}"></script>

@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" />
@endsection

