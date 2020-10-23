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
                                <th><span>Count In Warehouse</span></th>
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
                                <td data-label="Price" ><span>{{$item->SubProducts->CountInWarehouse(1)}}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
            </div>
            {{-- <a class="btn btn-primary btn-Receipt" href="{{ url('')}}/clientorders/Approved/{{$Order->id}}">Approved</a> --}}
            
            <button type="button" Url="{{ url('')}}/clientorders/Approved/{{$Order->id}}" class="btn btn-primary btn-Receipt">تحويل</button>

        </div>
    </div>
</section>


  
@endsection


@section('scripts')

<script>
    $('.btn-Receipt').on('click',function (e) {
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