@extends('layouts.app')

@section('content')
            
<section id="tableSection" class="widget all-users">
    <div class="container-fluid">
        <h1 class="widget-title mb-0">All orders</h1>

        <div class="widget-content mt-5">
            <form class="general-search" id="search-form">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-5">
                        <div class="form-group">
                            <label for="username">Search</label>
                            <input type="search" class="form-control" id="filter" name="input" placeholder="Type to search...">
                        </div>

                    </div>

                    <div class="col-7 col-sm-3 col-lg-4">
                        <div class="form-group">
                            <label for="departments">Filter By</label>
                            <select id="option" name="option" class="form-control">
                                <option class="form-control" value="Name">Name</option>
                                <option class="form-control" value="Phone">Phone</option>
                                <option class="form-control" value="Address">Address</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-5 col-sm-3 col-lg-3">
                        <button type="submit" id="search_btn" class="general-btn search_btn"><i
                            class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
            <!-- All users table -->

            <div class="general-table">
                <table id="generalTable" class="text-center table-edit table">
                    <thead>
                        <tr class="row-edit">
                            <th><span>No.</span></th>
                            <th><span>Order id</span></th>
                            <th><span>Client name</span></th>
                            <th><span>Phone</span></th>
                            <th><span>Order Date</span></th>
                            <th><span>Order Out Date</span></th>
                            <th><span>Total</span></th>
                            <th><span>Type</span></th>
                            <th><span>Status</span></th>
                            <th><span>Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @push('js')
            <script>
            var oTable = $('#generalTable').DataTable({
            processing: true,
            dom: 'Bfrtip',
            serverSide: true,
            searching : false,
            ordering: false,
            pageLength: 10,
            autoWidth: false,
            pagingType : "full_numbers",
            ajax: {
                url: '{{ route('clientorder.data') }}?warehouse={{request('warehouse')}}',
                data: function (d) {
                    d.input = $('input[name=input]').val();
                    d.option = $('#option').val();
                }
            },
            columns: [
                {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                {data: 'id', name: 'id'},
                {data: 'client_name', name: 'client_name'},
                {data: 'client_phone' , name : 'client_phone'},
                {data: 'created_at' , name : 'created_at'},
                {data: 'date_to_delivery' , name : 'date_to_delivery'},
                {data: 'Totalprice' , name : 'Totalprice'},
                {data: 'type' , name : 'type'},
                {data: 'state' , name : 'state'},
                {data: 'action' , name : 'action'},
            ],
            buttons: [
                {
                    text: 'Assign To Delivary',
                    className: 'btn general-btn' ,
                    action: function ( e, dt, node, config ) {
                        console.log($('input[name="vehicle1[]"]:checked').length);
                        console.log($('input[name="vehicle1[]"]:checked').serialize());  
                        if ($('input[name="vehicle1[]"]:checked').length !== 0) {
                            $('#exampleModal').modal('show');
                            
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'يجيب اختيار فاتورة واحده علي الاقل',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }

                },
                {
                    text: 'Conferm',
                    className: 'btn general-btn Conferm'  ,
                    action: function ( e, dt, node, config ) {
                        console.log($('input[name="vehicle1[]"]:checked').length);
                        console.log($('input[name="vehicle1[]"]:checked').serialize());  
                        if ($('input[name="vehicle1[]"]:checked').length !== 0) {
                            var orders = new Array();
                            $("input[name='vehicle1[]']:checked").each(function() {
                                orders.push($(this).val());
                            });
                            e.preventDefault();
                            var $this = $(this),
                            Url = "{{route('clientorder.MltieApproved')}}";
                            $.ajax({
                                url:Url ,
                                dataType: "json",
                                cache: false,
                                data: { 
                                    orders : orders
                                },
                                type: "post",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                },
                                success: function(data) {
                                    backLoader.fadeOut(100,function() {
                                        loader.fadeOut(1000);
                                    });
                            
                                    oTable.ajax.reload();
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Your work has been saved',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                },
                                beforeSend: function() {
                                    backLoader.fadeIn(100,function() {
                                        loader.fadeIn(1000);
                                    });
                                }
                            });
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'يجيب اختيار فاتورة واحده علي الاقل',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }

                },
                {
                    text: 'Print',
                    className: 'btn general-btn Print'  ,
                    action: function ( e, dt, node, config ) {
                        console.log($('input[name="vehicle1[]"]:checked').length);
                        console.log($('input[name="vehicle1[]"]:checked').serialize());  
                        if ($('input[name="vehicle1[]"]:checked').length !== 0) {
                            var orders = new Array();
                            $("input[name='vehicle1[]']:checked").each(function() {
                                orders.push($(this).val());
                            });
                            e.preventDefault();
                            var $this = $(this),
                            Url = "{{route('clientorder.getPdf')}}";
                            $.ajax({
                                url:Url ,
                                dataType: "json",
                                cache: false,
                                data: { 
                                    orders : orders
                                },
                                type: "post",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                },
                                success: function(data) {
                                    backLoader.fadeOut(100,function() {
                                        loader.fadeOut(1000);
                                    });
                                    setTimeout(function() { 
                                        window.open("{{ url('/')}}/uploads/orders_filename.pdf" ,  '_blank');
                                    }, 3000);
                                    oTable.ajax.reload();
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Your work has been saved',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                },
                                beforeSend: function() {
                                    backLoader.fadeIn(100,function() {
                                        loader.fadeIn(1000);
                                    });
                                }
                            });
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'يجيب اختيار فاتورة واحده علي الاقل',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }

                }
            ],
            language: {
                "paginate": {
                    "first":      "<<",
                    "last":       ">>",
                    "next":       ">",
                    "previous":   "<"
                },
            },
      
            createdRow: function( row, data, dataIndex ) {
                // Set the data-status attribute, and add a class
                $( row ).find('td:eq(0)')
                    .attr('data-label', '#');
                $( row ).find('td:eq(1)')
                    .attr('data-label', 'Order id');
                $( row ).find('td:eq(2)')
                    .attr('data-label', 'Client name');
                $( row ).find('td:eq(3)')
                    .attr('data-label', 'Phone');
                $( row ).find('td:eq(4)')
                    .attr('data-label', 'Order Date');
                $( row ).find('td:eq(5)')
                    .attr('data-label', 'Order Out Date');
                $( row ).find('td:eq(6)')
                    .attr('data-label', 'Total');
                $( row ).find('td:eq(7)')
                    .attr('data-label', 'Type');
                $( row ).find('td:eq(8)')
                    .attr('data-label', 'Status');
                $( row ).find('td:eq(9)')
                    .attr('data-label', 'Action');
            }

            
            });
            $.fn.DataTable.ext.pager.numbers_length = 8;
            $('#search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            </script>
        @endpush   

        </div>

    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="DelivaryCompany">DelivaryCompany</label>
                        <select name="DelivaryCompany[]" id="DelivaryCompany"class="form-control DelivaryCompany"
                            title="Please select a DelivaryCompany">
                            <option value="">Select a DelivaryCompany</option>
                            @foreach ($DelivaryCompany as $DelivaryCompanys)
                            <option value="{{$DelivaryCompanys->id}}">{{$DelivaryCompanys->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" Url="{{route('clientorder.delivarycompany')}}" class="btn btn-primary add-order-to-company">Save changes</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade bd-example-modal-lg" id="ShowOrder"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content widget">
            <div class="container-fluid">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{-- <p id="productStyle" class="h2">Style</p>
                <p id="productMaterial" class="h2">Material</p> --}}
                <h1 class="widget-title mb-0"><span class="client-name"> </span></h1>
                <div class="mt-3">
                    <div class="control-modal">
                        <div class="total">
                            <p><span>Total Quntity:</span><span class="total-quan">0</span></p>
                            <p><span>Total Price:</span><span class="total-price">0</span>&nbsp;EGP</p>
                        </div>
                        <button id="btn-Receipt" Url="" type="button" class="btn general-btn">Confirm</button>
                    </div>
                    <form class="general-search">
                        <div class="row">
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
                                    <th><span>Barcode</span></th>
                                    <th><span>Name</span></th>
                                    <th><span>Material</span></th>
                                    <th><span>Style</span></th>
                                    <th><span>Size</span></th>
                                    <th><span>Colors</span></th>
                                    <th><span>Quantity</span></th>
                                    <th><span>Price</span></th>
                                    <th><span>Count In Warehouse</span></th>
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


@endsection

@section('scripts')

<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script>
        var loader = $('.spinner');
    var backLoader = $('.back-loader');
    $(".add-order-to-company").on("click", function(e) {
        var DelivaryCompany = $("#DelivaryCompany").val();
        // var  orders  = $('input[name="vehicle1[]"]:checked').serialize();
        console.log('testSending');
        var orders = new Array();
        $("input[name='vehicle1[]']:checked").each(function() {
            orders.push($(this).val());
        });
        e.preventDefault();
        var $this = $(this),
        Url = $this.attr("Url");
        $.ajax({
            url:Url ,
            dataType: "json",
            cache: false,
            data: { 
                DelivaryCompany : DelivaryCompany ,
                orders : orders
             },
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {
                 backLoader.fadeOut(100,function() {
                    loader.fadeOut(1000);
                });
                $('#exampleModal').modal('hide');
                oTable.ajax.reload();
                Swal.fire({
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            beforeSend: function() {
                backLoader.fadeIn(100,function() {
                    loader.fadeIn(1000);
                }  );
                console.log("test");
            }
        });
    });
    
    var ShowOrder = $('#ShowOrder');
    $(document).on("click", '.show-Btn' , function(e) {
        e.preventDefault();
        var $this = $(this),
           showUrl = $this.attr('show-url');
            Url = $this.attr("city");
        $.ajax({
            url: showUrl,
            dataType: "json",
            cache: false,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {
                const isProductFound = data.status;
                console.log(data);
                $('#ShowOrder').modal('show');
                $('.client-name').html(data.Order.client.name)
                ShowOrder.find('.total-quan').html(data.Order.Quantity);
                ShowOrder.find('.total-price').html(data.Order.TotalPrice);
                $("#ShowOrder tbody").html("");
                var url = `{{ url('')}}/clientorders/Approved/${data.Order.id}`;
                $('#btn-Receipt').attr('Url' , url);
                data.Order.Order_products.forEach(function(Order_products) {
                    var row = `<tr class="row-edit">
                    <td data-label="Barcode"><span>${Order_products.sub_products.parcode_pre_all}</span></td>
                    <td data-label="Name" ><span>${Order_products.Name}</span></td>
                    <td data-label="Material" ><span>${Order_products.Material}</span></td>
                    <td data-label="Style" ><span>${Order_products.Style}</span></td>
                    <td data-label="size"><span>${Order_products.sub_products.size}</span></td>
                    <td data-label="Colors" >
                            <span style="background: ${Order_products.sub_products.color}"></span>
                    </td>
                    <td data-label="Quantity" ><span>${Order_products.quantity}</span></td>
                    <td data-label="Price" ><span>${Order_products.price}</span></td>
                    <td data-label="Total Of Warehouse" ><span>${Order_products.CountInWarehouse}</span></td>

                    </tr>`;

                    $("#ShowOrder tbody").append(row);
                });


            },
            beforeSend: function() {
                console.log("test");
            }
        });
    });

    $('#btn-Receipt').on('click',function (e) {
        var $this = $(this)
        e.preventDefault();
        Url = $this.attr("Url");
        $.ajax({
            url: Url,
            dataType: "json",
            cache: false,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {
                if(data.status == true){
                    Swal.fire(
                        "Sccess!",
                        data.message,
                        "success"
                    ) 
                    $('#ShowOrder').modal('hide');
                     oTable.ajax.reload();
                }else{
                    Swal.fire(
                    "Cancelled",
                    data.message,
                    "error"
                    )
                }
            },
            beforeSend: function () {
                console.log('test');
            },
        });
    });
</script>
@endsection
{{-- https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css --}}
@section('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"> --}}
@endsection