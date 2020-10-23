@extends('layouts.app')

@section('content')
<section class="widget">
        <div class="container-fluid">
            <h1 class="widget-title">Edit {{$Client->name}}</h1>
            <form  method="POST" action="{{ route('client.update',$Client->name) }}"  class="general-form crm-add-new-order form-edit">
                @csrf
                @method('PUT')
                <input type="hidden" name="client_id" value="{{$Client->id}}">
                <div class="row">
                    <!-- Client name form group -->
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="form-group">
                        <label for="name">{{trans('Forms.clientName')}}</label>
                            <input type="text" name="name" id="name" class="form-control w-100" value="{{$Client->name}}" aria-describedby="name"
                                placeholder="{{trans('Forms.PlaceholderClientName')}}">
                        </div>
                    </div>
                    <!-- Add client Address -->
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="form-group">
                            <label for="Address">{{trans('Forms.clientAddress')}}</label>
                            <div class="row">
                                <div class="col-9">
                                    <input type="hidden"  name="addressId[]" value="{{$Client->Address[0]->id}}">
                                    <textarea name="address[]" id="Address" value="{{$Client->Address[0]->address}}" class="form-control textAreaHeight client-address" aria-describedby="Address"
                                    placeholder="{{trans('Forms.PlaceholderClientAddress')}}"></textarea>
                                </div>
                                <div class="col-3">
                                    <span class="general-btn d-inline-block add-client-address-btn"><i class="fas fa-plus"></i></span> 
                                </div>
                            </div>
                            
                            <div class="add-client-address-info">
                                <?php unset($Client->Address[0]);?>
                                @foreach ($Client->Address as $Address)
                                    <div>
                                        <input type="hidden"  name="addressId[]" value="{{$Address->id}}">
                                        <input type='text' name='address[]' value="{{$Address->address}}"  class='form-control mt-2' placeholder='Client Address'>
                                        <span id_delete="{{$Address->id}}" class='general-btn'><i class='fas fa-times'></i></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Contatc us -->
                    <div class="col-12 col-md-3 col-lg-3">
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
                    <!-- Add client phone form group -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="phone">{{trans('Forms.clientPhone')}}</label>
                            <div class="row">
                                <div class="col-9">
                                    <input type="hidden"  name="mobileId[]" value="{{$Client->Mobiles[0]->id}}">
                                    <input type="text" name="mobile[]" id="phone" class="form-control phone-input" value="{{$Client->Mobiles[0]->mobile}}" aria-describedby="phone"
                                    placeholder="{{trans('Forms.PlaceholderClientPhone')}}">
                                </div>
                                <div class="col-3">
                                    <span class="general-btn d-inline-block add-client-phone-btn">
                                            <i class="fas fa-plus"></i>
                                </div>
                            </div>
                            </span>
                            <div class="add-client-phone-info">
                                <?php unset($Client->Mobiles[0]);?>
                                @foreach ($Client->Mobiles as $Mobiles)
                                    <div>
                                        <input type="hidden"  name="mobileId[]" value="{{$Mobiles->id}}">
                                        <input type='text' class='form-control mt-2' name='mobile[]' value="{{$Mobiles->mobile}}" placeholder='Client Phone'><span id_delete="{{$Mobiles->id}}" class='general-btn'><i class='fas fa-times'></i></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Client social accounts -->
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="form-group">
                            <label class="d-block" for="name">{{trans('Forms.clientSocialAccount')}}</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="facebook_account"  value="{{$Client->facebook_account}}" id="facebook-account" class="form-control" aria-describedby="facebook-account"
                                    placeholder="{{trans('Forms.PlaceholderFacebook')}}">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="Whats" id="tel" value="{{$Client->whats}}" class="form-control" aria-describedby="phone"
                                    placeholder="{{trans('Forms.PlaceholderwhatsOrPhone')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row btns">
                            <button class="add-client-btn mt-4 save-btn btn" type="submit"><i class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                            <button type="reset" class="btn mt-4 reset-btn btn-reset"><i class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                        </div>
                    </div>
                </div>
            </form> 
           
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/modules/crm/add_new_clients.js')}}"></script>
<script src="{{ asset('assets/scripts/additional-clients-order-functions.js')}}"></script>
{{-- <script src="{{ asset('assets/scripts/modules/crm/add_new_clients_ajax.js')}}"></script> --}}

@endsection
