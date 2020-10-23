@extends('layouts.app')

@section('content')
<section class="widget">
        <div class="container-fluid create">
        <h1 class="widget-title">{{trans('crmClients.addNewClient')}}</h1>
            <form  method="POST" action="{{ route('client.store') }}"  class="general-form crm-add-new-order form-create">
                @csrf
                <div class="row">
                    <!-- Client name form group -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                        <label for="name">{{trans('Forms.clientName')}}</label>
                            <input type="text" name="name" id="name" class="form-control w-100" aria-describedby="name"
                                placeholder="{{trans('Forms.clientName')}}">
                        </div>
                    </div>
                    <!-- Add client phone form group -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="phone">{{trans('Forms.clientPhone')}}</label>
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" name="mobile[]" id="phone" class="form-control phone-input" aria-describedby="phone"
                                    placeholder="{{trans('Forms.clientPhone')}}">
                                </div>
                                <div class="col-3">
                                    <button type="button" class="general-btn add-btn add-client-phone-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="add-client-phone-info">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contatc us -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>{{trans('Forms.contactWay')}}</label>
                            <div class="social">
                                <input id="facebook" name="facebook_label" type="checkbox">
                                <label for="facebook">
                                    <i class="fab fa-facebook-f fa-fw"></i>
                                </label>
                                <input id="whatApp" name="whatApp_label" type="checkbox">
                                <label for="whatApp">
                                        <i class="fab fa-whatsapp fa-fw"></i>
                                </label>
                                <input id="website" name="website_label" type="checkbox">
                                <label for="website">
                                        <i class="fas fa-globe fa-fw"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Client social accounts -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="d-block" for="name">{{trans('Forms.clientSocialAccount')}}</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" disabled name="facebook_account" id="facebook-account" class="form-control" aria-describedby="facebook-account"
                                    placeholder="{{trans('Forms.PlaceholderFacebook')}}">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="Whats"  id="whatsapp-account" id="tel" class="form-control" aria-describedby="phone"
                                    placeholder="{{trans('Forms.PlaceholderwhatsOrPhone')}}" disabled>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Add client city -->

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                            <select name="city[]" id="city-edit" class="form-control city"
                                title="Please select a City">
                                <option value="">{{trans('Forms.selectCity')}}</option>
                                <option value="1">test1</option>
                                <option value="2">test1</option>
                                <option value="3">test1</option>
                                <option value="4">test1</option>
                            </select>
                        </div>
                    </div>


                    <!-- Add client region -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="w-100" for="region">region</label>
                            <select name="region[]" id="region-edit" class="form-control region"
                                title="Please select a region">
                                <option value="">region</option>
                                <option value="1">test1</option>
                                <option value="2">test1</option>
                                <option value="3">test1</option>
                                <option value="4">test1</option>
                            </select>
                        </div>
                    </div>

                    <!-- Add client address -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Address" class="w-100">{{trans('Forms.clientAddress')}}</label>
                            <div class="row">
                                <div class="col-9">
                                    <textarea name="address[]" id="Address" class="form-control textAreaHeight client-address" aria-describedby="Address"
                                    placeholder="{{trans('Forms.clientAddress')}}"></textarea>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="general-btn add-btn add-client-address-btn"><i class="fas fa-plus"></i></button> 
                                </div>
                            </div>
                            
                            <div class="add-client-address-info">
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="row btns">
                            <button class="create-department mt-4 save-btn btn" type="submit"><i class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                            <button type="reset" class="btn mt-4 reset-btn btn-reset"><i class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/additional-clients-order-functions.js')}}"></script>
<script src="{{ asset('assets/scripts/vendor/additional-methods.min.js')}}"></script>
<script src="{{ asset('assets/scripts/modules/crm/add_new_clients.js')}}"></script>
{{-- <script src="{{ asset('assets/scripts/modules/crm/add_new_clients_ajax.js')}}"></script> --}}

@endsection
