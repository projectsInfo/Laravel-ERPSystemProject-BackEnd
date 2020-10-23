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
                                <th><span>Order id</span></th>
                                <th><span>Client name</span></th>
                                <th><span>Phone</span></th>
                                <th><span>Order Date</span></th>
                                <th><span>Order Out Date</span></th>
                                <th><span>Total</span></th>
                                <th><span>Type</span></th>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($ivntorys as $items)
                            <tr class="row-edit">
                                <td data-label="barcode" colspan="7" ><span>{{$items->Name}}</span></td>
                                {{-- <td data-label="Name" ><span>{{$items->product->name}}</span></td>
                                <td data-label="Material" ><span>{{$items->product->material}}</span></td>
                                <td data-label="Style" ><span>{{$items->product->Style->name}}</span></td>
                                <td data-label="Size" ><span>{{$items->size}}</span></td>
                                <td data-label="Colors" ><span>{{$items->colorName}}</span></td>
                                <td data-label="Quantity" ><span>{{$items->CountInWarehouse($Warehouse->id)}}</span></td> --}}
                            </tr>
                            @foreach ($items->Orders as $Order)
                                <tr class="row-edit">
                                    <td data-label="barcode"  ><span>{{$Order->id}}</span></td>
                                    <td data-label="barcode"  ><span>{{$Order->Client->name}}</span></td>
                                    <td data-label="barcode"  >
                                    @foreach ($Order->Client->Mobiles as $Mobiles)
                                       <span>{{$Mobiles->mobile}}</span> 
                                    @endforeach
                                    </td>
                                    <td data-label="barcode"  ><span>{{$Order->created_at}}</span></td>
                                    <td data-label="barcode"  ><span>{{$Order->date_to_delivery}}</span></td>
                                    <td data-label="barcode"  ><span>{{$Order->totalPrice()->Price}}</span></td>
                                    <td data-label="barcode"  >
                                    @if ($Order->type == 1) 
                                        <span>Urgent</span>
                                    @elseif ($Order->type == 2) 
                                        <span>Normal</span>
                                    @elseif ($Order->type == 3) 
                                        <span>Hold</span>
                                    @endif
                                    </td>
                                    {{-- <td data-label="Name" ><span>{{$items->product->name}}</span></td>
                                    <td data-label="Material" ><span>{{$items->product->material}}</span></td>
                                    <td data-label="Style" ><span>{{$items->product->Style->name}}</span></td>
                                    <td data-label="Size" ><span>{{$items->size}}</span></td>
                                    <td data-label="Colors" ><span>{{$items->colorName}}</span></td>
                                    <td data-label="Quantity" ><span>{{$items->CountInWarehouse($Warehouse->id)}}</span></td> --}}
                                </tr>
                            @endforeach
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