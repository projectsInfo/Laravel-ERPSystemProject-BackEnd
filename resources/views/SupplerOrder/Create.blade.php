@extends('layouts.app')

@section('content')
<section class="widget">
        <div class="container-fluid create">
            <h1 class="widget-title">ADD NEW CLIENT</h1>
            <form  method="POST" action="{{ route('client.store') }}"  class="general-form crm-add-new-order form-create">
                @csrf
                <div class="row">
                    <!-- Client name form group -->
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="name">Client Name</label>
                            <input type="text" name="name" id="name" class="form-control w-100" aria-describedby="name"
                                placeholder="Client Name">
                        </div>
                    </div>
                    <!-- Add client Address -->
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="form-group">
                            <label for="Address">Client Address</label>
                            <textarea name="address[]" id="Address" class="form-control textAreaHeight client-address" aria-describedby="Address"
                            placeholder="Client Address"></textarea>
                            <span class="general-btn add-client-address-btn"><i class="fas fa-plus"></i></span> 
                            <div class="add-client-address-info">
                                
                            </div>
                        </div>
                    </div>
                    <!-- Contatc us -->
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Contact way</label>
                            <div class="social">
                                <input id="facebook" name="facebook_label" type="checkbox">
                                <label for="facebook">
                                    <i class="fab fa-facebook-f fa-fw"></i>
                                </label>
                                <input id="whatsapp" name="whatsapp_label" type="checkbox">
                                <label for="whatsapp">
                                    <i class="fab fa-whatsapp fa-fw"></i>
                                </label>
                                <input id="mobile" name="mobile_label" type="checkbox">
                                <label for="mobile">
                                    <i class="fas fa-mobile-alt fa-fw"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Add client phone form group -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="phone">Client Phone</label>
                            <input type="text" name="mobile[]" id="phone" class="form-control phone-input" aria-describedby="phone"
                            placeholder="Client phone">
                            <span class="general-btn add-client-phone-btn">
                                <i class="fas fa-plus"></i>
                            </span>
                            <div class="add-client-phone-info">
                                
                            </div>
                        </div>
                    </div>
                    <!-- Client social accounts -->
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="form-group">
                            <label class="d-block" for="name">Client Social Accounts</label>
                            <input type="text" name="facebook_account" id="facebook-account" class="form-control" aria-describedby="facebook-account"
                                placeholder="Facebook Account">
                            <input type="text" name="Whats" id="tel" class="form-control" aria-describedby="phone"
                                placeholder="Whats or Phone">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="general-btn add-client-btn">Add Client</button>
                    </div>
                </div>
            </form> 
           
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('assist/scripts/modules/crm/add_new_clients.js')}}"></script>
{{-- <script src="{{ asset('assist/scripts/modules/crm/add_new_clients_ajax.js')}}"></script> --}}

@endsection
