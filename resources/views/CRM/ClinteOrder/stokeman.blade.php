@extends('layouts.app')

@section('content')
<section class="widget suppliers-order">
    <div class="container-fluid">
        {{-- <p id="productMaterial" class="h2">Client : {{$Order->client}}</p> --}}
        <h1 class="widget-title mb-0">Client : {{$Order->client->name}}</h1>
        <div class="mt-3">
            <div class="control">
                <div class="total">
                    <p><span>Total Quntity:</span><span id="totalQuan">{{$Order->Quantity}}</span></p>
                    <p><span>Total Price:</span><span id="totalPrice">{{$Order->TotalPrice}}</span>&nbsp;EGP</p>
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
                                <th><span>Count</span></th>
                                {{-- <th><span>Print BarCode</span></th> --}}
            
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Order->Order_products as $item)
                            <tr class="row-edit">
                                <td data-label="Barcode" ><span>{{$item->SubProducts->parcode_pre_all}}</span></td>
                                <td data-label="Name" ><span>{{$item->SubProducts->product->name}}</span></td>
                                <td data-label="Material" ><span>{{$item->SubProducts->product->material}}</span></td>
                                <td data-label="Style" ><span>{{$item->SubProducts->product->Style->name}}</span></td>
                                <td data-label="size" ><span>{{$item->SubProducts->size}}</span></td>
                                <td data-label="Colors" >
                                        <span style="background: {{$item->SubProducts->color}}"></span>
                                </td>
                                <td data-label="Quantity" ><span>{{$item->quantity}}</span></td>
                                <td data-label="Price" ><span>{{$item->price}}</span></td>
                                {{-- @dd($item->SubProducts->id) --}}
                                    <td data-label="Price" ><span id="{{$item->SubProducts->parcode_pre_all}}">
                                    {{$item->ContOFscan($Order->id , $item->SubProducts->id)}}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
            </div>
            @if ($Order->state < 4 && $Order->state > 1)
                <button type="button" Url="{{ url('')}}/clientorders/cashing" order="{{$Order->id}}" class="btn general-btn btn-Receipt">Receive</button>
            @else
                {{-- <button type="button" Url="{{ url('')}}/clientorders/cashing" order="{{$Order->id}}" class="btn btn-primary btn-Receipt">استلام</button> --}}
            @endif
        </div>
    </div>
</section>


  
@endsection

@section('scripts')

<script>
        $('.btn-Receipt').on('click',function (e) {
            var $this = $(this)
            Swal.fire({
                title: "Add Note",
                input: "text",
                showCancelButton: true,
                confirmButtonColor: "#1FAB45",
                confirmButtonText: "Save",
                cancelButtonText: "Cancel",
                buttonsStyling: true
                }).then(function (result) {
                    // console.log(result.value);
                    var barcode = result.value;
                    e.preventDefault();
                    Url = $this.attr("Url");
                    order = $this.attr("order");
                    
                    $.ajax({
                        url: Url+'/'+barcode+'/'+order,
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
                                $('#'+data.parcode_pre_all).html(data.CountOfCashing)
                                $('.btn-Receipt').click();
                            }else if(data.status == "Done"){
                                Swal.fire(
                                "Sccess!",
                                data.message,
                                "success"
                                )
                                $('#'+data.parcode_pre_all).html(data.CountOfCashing)
                            }else{
                                Swal.fire(
                                "Cancelled",
                                data.message,
                                "error"
                                )
                                console.log('تم صرفها من قبل');
                            }
                            
                        },
                        beforeSend: function () {
                            console.log('test');
                        },
                    });
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


    </script>
@endsection