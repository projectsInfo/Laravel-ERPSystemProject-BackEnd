@extends('layouts.app')

@section('content')
<section class="widget suppliers-order">
    <div class="container-fluid">
        <p id="productMaterial" class="h2">Supplier : {{$SupplyOrder->Suppler}}</p>
        <h1 class="widget-title mb-0">Warehouse : {{$SupplyOrder->Warehouse}}</h1>
        <div class="mt-3">
            <div class="control">
                <div class="total">
                    <p><span>Total Quntity:</span><span id="totalQuan">{{$SupplyOrder->Quantity}}</span></p>
                    <p><span>Total Price:</span><span id="totalPrice">{{$SupplyOrder->TotalPrice}}</span>&nbsp;EGP</p>
                </div>
            </div>
          
        
            <div class="general-table table-responsive-md supplier-table">
                <table id="generalTable" class="text-center table-edit table">
                    <thead>
                        <tr class="row-edit">
                            <div class="row">
                                {{-- <div class="col">
                                    <th>ID</th>
                                </div> --}}
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
                                {{-- <th><span>Status</span></th> --}}
                                <th><span>Print BarCode</span></th>
            
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($SupplyOrder->SupplyOrderData as $item)
                            <tr class="row-edit">
                                    
                                    
                                <td data-label="Barcode" ><span>{{$item->SubProducts->parcode_pre_all}}</span></td>
                                <td data-label="Name" ><span>{{$item->SubProducts->product->name}}</span></td>
                                <td data-label="Material" ><span>{{$item->SubProducts->product->material}}</span></td>
                                <td data-label="Style" ><span>{{$item->SubProducts->product->Style->name}}</span></td>
                                <td data-label="size" ><span>{{$item->SubProducts->size}}</span></td>
                                <td data-label="Colors" >
                                        <span style="background: {{$item->SubProducts->color}}"></span>
                                </td>
                                <td data-label="Quantity" ><span>{{$item->Quantity}}</span></td>
                                <td data-label="Price" ><span>{{$item->Purchasing_price}}</span></td>
                                <td data-label="Action" class="d-flex justify-content-center" >
                                    <a href="{{ url('supplerorders/barcodes').'/'.$item->id.'/'.$item->SubProducts->id}}">
                                        <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="mr-2 list-b btn">
                                            <span><i class="fas fa-list fa-fw"></i></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
            </div>
        <button type="button" Url="{{ url('')}}/supplerorders/Receipt" class="btn general-btn btn-Receipt">{{trans('glopal.recive')}}</button>
        </div>
    </div>
</section>


  
@endsection

@section('scripts')

<script>
        $('.btn-Receipt').on('click',function (e) {
            var $this = $(this)
            Swal.fire({
                title: "استلام المنتج",
                input: "text",
                showCancelButton: true,
                confirmButtonColor: "#21AD64",
                confirmButtonText: "حفظ",
                cancelButtonText: "الغاء",
                buttonsStyling: true
                }).then(function (result) {
                    // console.log(result.value);
                    var barcode = result.value;
                    e.preventDefault();
                    Url = $this.attr("Url");
                    console.log(Url+'/'+barcode);
                    
                    $.ajax({
                        url: Url+'/'+barcode,
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
                                    "Your note has been saved!"+result.value,
                                    "success"
                                )
                                $('.btn-Receipt').click();
                            } else{
                                Swal.fire(
                                "Cancelled",
                                data.message,
                                "error"
                                )
                                console.log('تم استلامها من قبل');
                            }
                        },
                        beforeSend: function () {
                            console.log('test');
                        },
                    });
                //     Swal.fire(
                //     "Sccess!",
                //     "Your note has been saved!"+result.value,
                //     "success"
                //   )
                }, function (dismiss) {
                if (dismiss === "cancel") {
                    Swal.fire(
                    "Cancelled",
                    "Canceled Note",
                    "error"
                    )
                }
            })
        

    });
    //   Swal.fire({
    //   title: "Authenicating for continuation",
    //   text: "Test",
    // //   type: "input",
    //   input: "text",
    
    //   showCancelButton: true,
    //   closeOnConfirm: false,
    //   animation: "slide-from-top",
    //   inputPlaceholder: "Write something"
    // }, function(inputValue) {
    //   if (inputValue === false) return false;
    //   if (inputValue === "") {
    //      Swal.fire.showInputError("You need to write something!");
    //     return false
    //   }
    //   // swal("Nice!", "You wrote: " + inputValue, "success");
    // });
     
     
    // Swal.mixin({
    //   input: 'text',
    //   confirmButtonText: 'Next &rarr;',
    //   showCancelButton: true,
    //   progressSteps: ['1', '2', '3','4']
    // }).queue([
    //   {
    //     title: 'Question 1',
    //     text: 'Chaining swal2 modals is easy'
    //   },
    //   'Question 2',
    //   'Question 2',
    //   'Question 3'
    // ]).then((result) => {
    //     console.log(result);
    //   if (result.value) {
    //     Swal.fire({
    //       title: 'All done!',
    //       html:
    //         'Your answers: <pre><code>' +
    //           JSON.stringify(result.value) +
    //         '</code></pre>',
    //       confirmButtonText: 'Lovely!'
    //     })
    //   }
    // })
    
    

    </script>
@endsection
