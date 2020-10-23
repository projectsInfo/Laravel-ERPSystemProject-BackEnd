@extends('layouts.app')

@section('content')
<section class="widget suppliers-order">
    <div class="container-fluid">
        {{-- <p id="productMaterial" class="h2">Client : {{$Order->client}}</p> --}}
        {{-- <h1 class="widget-title mb-0">Client : {{$Order->client->name}}</h1>
        <div class="mt-3">
            <div class="control">
                <div class="total">
                    <p><span>Total Quntity:</span><span id="totalQuan">{{$Order->Quantity}}</span></p>
                    <p><span>Total Price:</span><span id="totalPrice">{{$Order->TotalPrice}}</span>&nbsp;EGP</p>
                </div>
            </div> --}}
          
        
            <div class="general-table table-responsive-md supplier-table">
                <table id="generalTable" class="text-center table-edit table">
                    <thead>
                        <tr class="row-edit">
                            <div class="row">
                                <th><span>barcode</span></th>
                                <th><span>Name</span></th>
                                <th><span>Material</span></th>
                                <th><span>Style</span></th>
                                <th><span>Size</span></th>
                                <th><span>Colors</span></th>
                                <th><span>Quantity</span></th>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($ivntorys as $items)
                            <tr class="row-edit">
                                <td data-label="barcode" ><span>{{$items->parcode_pre_all}}</span></td>
                                <td data-label="Name" ><span>{{$items->product->name}}</span></td>
                                <td data-label="Material" ><span>{{$items->product->material}}</span></td>
                                <td data-label="Style" ><span>{{$items->product->Style->name}}</span></td>
                                <td data-label="Size" ><span>{{$items->size}}</span></td>
                                <td data-label="Colors" ><span>{{$items->colorName}}</span></td>
                                <td data-label="Quantity" ><span>{{$items->CountInWarehouse($Warehouse->id)}}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ivntorys->links() }}

            
            </div>
            {{-- <a class="btn btn-primary btn-Receipt" href="{{ url('')}}/clientorders/Approved/{{$Order->id}}">Approved</a> --}}
            
            {{-- <button type="button" Url="{{ url('')}}/clientorders/Approved/{{$Order->id}}" class="btn btn-primary btn-Receipt">تحويل</button> --}}

        </div>
    </div>
</section>


  
@endsection


@section('scripts')

@endsection