@extends('layouts.app')

@section('content')
<!-- Start Add New Order -->
<section class="add-new-order widget">
    <div class="container-fluid">
        <h1 class="widget-title">Add Client Order</h1>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item left">
                <a class="nav-link nav-link-first active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Add New Client</a>
            </li>
            <li class="nav-item right">
                <a class="nav-link nav-link-last" id="prevClients-tab" data-toggle="pill" href="#prevClients" role="tab" aria-controls="prevClients" aria-selected="false">All clients</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <!-- Start Add New Client Tab -->

            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form  method="POST" action="{{ route('client.store') }}"  class="general-form crm-add-new-order form-client">
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
                                <label>Contact way</label>
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
                        <!-- Add client Address -->
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

            <!-- End Add New Client Tab -->

            <!-- Start Previous client tab -->

            <div class="tab-pane fade prev-clients" id="prevClients" role="tabpanel" aria-labelledby="prevClients-tab">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form class="general-search">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-5">
                                        <div class="form-group">
                                            <label>Search</label>
                                            <input type="search" class="form-control input-search" placeholder="Client Name">
                                        </div>
                            
                                    </div>
                            
                                    <div class="col-7 col-sm-3 col-lg-4">
                                        <div class="form-group">
                                            <label>Filter By</label>
                                            <select class="form-control general-search-select filter">
                                                <option class="form-control" value="Client Name">Client Name</option>
                                                <option class="form-control" value="Client Phone(s)">Client Phone(s)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- All users table -->
                        <div class="col-12">
                            <form class="general-form">
                                <div class="general-table">
                                    <table id="generalTable" class="text-center table-edit table">
                                        <thead>
                                            <tr class="row-edit">
                                                <th width="7%"><span>ID</span></th>
                                                <th class="21%"><span class="white-space-nowrap">Client Name</span></th>
                                                <th class="21%"><span class="white-space-nowrap">Client Phone(s)</span></th>
                                                <th class="22%"><span class="white-space-nowrap">Client Address(s)</span></th>
                                                <th class="21%"><span class="white-space-nowrap">Contact Way</span></th>
                                                <th class="8%"><span>Action</span></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- End Previous client tab -->
        </div>
        <!-- Start section Status -->
        <form enctype="multipart/form-data" autocomplete="off"  method="POST" action="{{ route('clientorder.store') }}"  class="client_order general-form form-create">
        @csrf
            <div class="row">
                <!-- Status dropdown -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departments">Status</label>
                        <select name="status" class="status-dropdown form-control">
                            <option selected value="2">Normal</option>
                            <option value="3" class="delay-option">Delay</option>
                            <option value="1" class="urgent-option">Urgent</option>
                        </select>
                    </div>
                </div>
                <!-- Date picker -->
                <div class="col-md-6">
                    <div class="form-group input-due-date d-none">
                        <label for="departments">Due Date</label>
                        <input type="text" name="date_to_delivery" id="datepicker" class="form-control" autocomplete="off">
                    </div>
                </div>
                
                <!-- End section Status -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                        <select name="city" city="{{ url('') }}/delivaryprices" id="city" class="form-control ">
                            <option value="">{{trans('Forms.selectCity')}}</option>
                            @foreach ($City as $Cities)
                            <option value="{{$Cities->id}}">{{$Cities->City->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="w-100" for="city">{{trans('Forms.price')}}</label>
                        <input type="text" name="Price" class="form-control" disabled id="City-Price">
                    </div>
                </div>

                
                <div class="col-12 col-md-4 col-lg-5 col-xl-6">
                    <!-- Order barcode form group -->
                    <div class="form-group">
                        <label for="barcode">Order Barcode</label>
                        <input type="text" id="barcode" class="form-control" placeholder="Order Barcode">
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-7 col-xl-6 d-flex align-items-end flex-nowrap">
                    <div class="form-group">
                        <button type="button" class="general-btn show-product" Url="{{ url('') }}/supplerorders/product">
                            Show Product
                        </button>
                        <button type="button" class="general-btn show-current-product pl-3 " Url="{{ url('') }}/supplerorders/product">
                            Show Current Product
                        </button>
                    </div>
                </div>
            
                <!-- Start Table Of This Wedger -->
                <div class="col-12">
                    <div id="productTable" class="general-table supplier-table">
                        <table id="generalTable" class="text-center table-edit table">
                            <thead>
                                <tr class="row-edit">
                                    <div class="row">
                                        <div class="col">
                                            <th >ID</th>
                                        </div>
                                        <div class="col">
                                            <th>Barcode</th>
                                        </div>
                                        <th><span>Name</span></th>
                                        <th><span>Material</span></th>
                                        <th><span>Style</span></th>
                                        <th><span>Size</span></th>
                                        <th><span>Colors</span></th>
                                        <th><span>Quantity</span></th>
                                        <th><span>Price</span></th>
                                        <th><span>Status</span></th>
                                        <th><span>Action</span></th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="control">
                        <div class="total">
                            <p><span>Total Quntity:</span><span class="total-quan">0</span></p>
                            <p><span>Total Price:</span><span class="total-price">0</span>&nbsp;EGP</p>
                        </div>
                    </div>
                </div>

                <!-- Start SubmitForm -->
                <div class="col-lg-12">
                    <div class="row btns">
                        <button class="btn mt-4  save-btn" type="submit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn mt-4 reset-btn"><i class="fa fa-times-circle"></i> Reset</button>
                    </div>
                </div>
                <!-- End SubmitForm -->
                
                <!-- End Table Of This Wedget -->
            </div>
        </form>
    </div>
</section>
<!-- End -->

<div class="modal fade bd-example-modal-lg" id="showProductModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content widget">
            <div class="container-fluid">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p id="productStyle" class="h2">Style</p>
                <p id="productMaterial" class="h2">Material</p>
                <h1 class="widget-title mb-0">Product Name</h1>
                <div class="mt-3">
                    <div class="control-modal">
                        <div class="total">
                            <p><span>Total Quntity:</span><span class="total-quan">0</span></p>
                            <p><span>Total Price:</span><span class="total-price">0</span>&nbsp;EGP</p>
                        </div>
                        <button id="confirmProduct" type="button" class="btn general-btn">Confirm Products</button>
                    </div>
                    <form class="general-search">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-5">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="search" class="form-control input-search" placeholder="Barcode">
                                </div>
                            </div>
                    
                            <div class="col-7 col-sm-3 col-lg-4">
                                <div class="form-group">
                                    <label>Filter By</label>
                                    <select class="form-control general-search-select filter">
                                        <option class="form-control" value="Barcode">Barcode</option>
                                        <option class="form-control" value="Color">Color</option>
                                        <option class="form-control" value="Size">Size</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <form class="general-table table-responsive-md supplier-table sub-product">
                        <table id="generalTable" class="text-center data-table table-edit table">
                            <thead>
                                <tr class="row-edit">
                                    <th><span>ID</span></th>
                                    <th><span>Barcode</span></th>
                                    <th><span>Color</span></th>
                                    <th><span>Size</span></th>
                                    <th><span>Quantity</span></th>
                                    <th><span>Price</span></th>
                                    <th><span>Action</span></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="moreProducts" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content widget">
            <div class="container-fluid">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h1 class="widget-title mb-0">Choose one product only</h1>
                <div id="productsCont" class="mt-3 d-flex justify-content-center"></div>
            </div>
        </div>
    </div>
</div> 
@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/vendor/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/scripts/additional-clients-order-functions.js')}}"></script>
<script src="{{ asset('assets/scripts/additional-clients-functions.js') }}"></script>
<script src="{{ asset('assets/scripts/search-in-modal.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/client-orders/add-cllient-order/add-client-order.js') }}"></script>
{{-- <script src="{{ asset('assets/scripts/modules/crm/add_new_clients_ajax.js')}}"></script> --}}

@endsection



@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/vendor/jquery-ui.min.css') }}">

@endsection