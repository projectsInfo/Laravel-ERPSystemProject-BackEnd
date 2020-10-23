@extends('layouts.app')

@section('content')

<section class="widget suppliers-order">
        <div class="container-fluid">
            <h1 class="widget-title mb-0">ORDER TO SUPPLIER</h1>
            
            <div class="widget-content mt-5">
                <form enctype="multipart/form-data" autocomplete="off"  method="POST" action="{{ route('supplerorder.store') }}"  class="user general-form form-create">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <!-- Suppliers list -->
                            <div class="form-group">
                                <label for="suppliers">Suppliers</label>
                                <select name="suppliers" id="suppliers" class="form-control" title="Please select a supplier">
                                    <option class="fomr-control" value="">Select a supplier</option>
                                    @forelse ($Supplers as $Suppler)
                                    <option class="form-control" @if($SupplyOrder->Suppler_id == $Suppler->id) selected @endif value="{{$Suppler->id}}">{{$Suppler->name}}</option>
                                    @empty
                                    <option class="form-control" value="">Not funid</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- warehouse list -->
                            <div class="form-group">
                                <label for="warehouses">Warehouse</label>
                                <select id="warehouses" name="warehouses" class="form-control select-warehouse"
                                    title="Please select a warehouse">
                                    <option class="form-control" value="">Select a warehouse</option>
                                    @forelse ($Warehouses as $Warehouse)
                                    <option class="form-control" @if($SupplyOrder->Warehouse_id == $Warehouse->id) selected @endif value="{{$Warehouse->id}}">{{$Warehouse->name}}</option>
                                    @empty
                                    <option class="form-control" value="">Not funid</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-5 col-xl-6">
                            <!-- Order barcode form group -->
                            <div class="form-group">
                                <label for="barcode">Order Barcode</label>
                                <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Order Barcode">
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
                        <div class="col-12">
                            <div class="general-table table-responsive-md supplier-table">
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
                                                <th><span>Action</span></th>
                                            </div>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($SupplyOrder->SupplyOrderData as $SupplyOrder)
                                        

                                            <tr class="row-edit ">
                                                <td data-label="ID"><span>{{$SupplyOrder->SubProducts->id}}</span></td>
                                                <td data-label="Barcode"><span>{{$SupplyOrder->SubProducts->parcode_pre_all}}</span></td>
                                                <td data-label="Name"><span>{{$SupplyOrder->SubProducts->product->name}}</span></td>
                                                <td data-label="Material"><span>{{$SupplyOrder->SubProducts->product->material}}</span></td>
                                                <td data-label="Style"><span>{{$SupplyOrder->SubProducts->product->Style->name}}</span></td>
                                                <td data-label="Size"><span>{{$SupplyOrder->SubProducts->size}}</span></td>
                                                <td data-label="Colors">
                                                    <span style="background: {{$SupplyOrder->SubProducts->color}}"></span>
                                                </td>
                                                <td data-label="Quantity"><span>{{$SupplyOrder->Quantity}}</span></td>
                                                <td data-label="Price"><span>{{$SupplyOrder->Purchasing_price}} EGP</span></td>
                                                <td data-label="Action">
                                                    <button type="button" class="btn delet">
                                                        <span><i class="fas fa-times fa-fw"></i></span>
                                                    </button>
                                                </td>
                                                <input type="hidden" name="price[]" class="price" value="{{$SupplyOrder->Purchasing_price}}">
                                                <input type="hidden" name="quantity[]" class="qny" value="{{$SupplyOrder->Quantity}}">
                                                <input type="hidden" name="subproduct_id[]" value="{{$SupplyOrder->SubProducts->id}}">
                                                <input type="hidden" name="SupplyOrderData_id[]" value="{{$SupplyOrder->id}}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-12">
                                <div class="control">
                                    <div class="total">
                                        <p><span>Total Quntity:</span><span id="totalQuan">0</span></p>
                                        <p><span>Total Price:</span><span id="totalPrice">0</span>&nbsp;EGP</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row btns">
                                    <button class="btn mt-4" type="submit"><i class="fa fa-save"></i> Save</button>
                                    <button type="reset" class="exit-btn btn mt-4"><i class="fa fa-times-circle"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div> 
        </div>
    </section>


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
                        <div class="control">
                            <div class="total">
                                <p><span>Total Quntity:</span><span class="totalQuan">0</span></p>
                                <p><span>Total Price:</span><span class="totalPrice">0</span>&nbsp;EGP</p>
                            </div>
                            <button id="confirmProduct" type="button" class="btn general-btn">Confirm Products</button>
                        </div>
                        <form class="general-search">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-5">
                                    <div class="form-group">
                                        <label for="username">Search</label>
                                        <input type="search" class="form-control" id="filter" placeholder="Type to search...">
                                    </div>
                                </div>
                        
                                <div class="col-7 col-sm-3 col-lg-4">
                                    <div class="form-group">
                                        <label for="departments">Filter By</label>
                                        <select id="filter" class="form-control">
                                            <option class="form-control">Barcode</option>
                                            <option class="form-control">Color</option>
                                            <option class="form-control">Size</option>
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

<script src="{{ asset('assist/scripts/modules/suppliers/suppliers-order/suppliers-order-edit.js') }}"></script>
<!-- End Custem Pages Script -->
<script>
    /*-----------------
    *   Add Btn
    ------------------*/


    var form = $('.form-create');
    var loader = $('.spinner');
    var backLoader = $('.back-loader');


    form.on('submit', function (e) {
    if( form.valid() ) {
        e.preventDefault();
        var dataForm = form.serialize(),
            url = form.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                // data: dataForm ,
                data:new FormData(this),
                processData: false,
                contentType: false,

                cache: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    backLoader.fadeOut(100,function() {
                        loader.fadeOut(1000);
                    });
                    var hasError = $('.has-error');
                    hasError.removeClass('has-error');
                    console.log(createUserForm);
                    createUserForm.resetForm();
                    $('.form-reset').click();
                    $('.remove-img').click();
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    
                },
                beforeSend: function () {
                    backLoader.fadeIn(100,function() {
                        loader.fadeIn(1000);
                    });
                },
                error: function (errors, exp) {
                    backLoader.fadeOut(100,function() {
                        loader.fadeOut(1000);
                    });
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    })
                    var error_array = errors.responseJSON.errors,
                        errors_print = '';
                    
                    console.log(error_array);
                    $.each(error_array, function (key, val) {
                        console.log(key);
                        
                        errors_print += val[0] + '<br>';
                
                        $('#'+key).val('');

                        var geterror = $('.'+key+'-error');
                        
                            geterror.html(val);
                            geterror.addClass('error');
                            geterror.slideDown(400);
                            geterror.parent().addClass('has-error');

                    });
                }
            };
            $.ajax(dataAjax);
        }
    });

</script>
@endsection
