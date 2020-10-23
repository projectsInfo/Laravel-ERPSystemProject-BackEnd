

<style>
    ul {
        list-style:none;
    }
    .container {page-break-after: always;}

    .invoice-content {
	 border-top: 20px solid #484848;
	 background: #fff;
	 border-top-left-radius: 10px;
	 border-top-right-radius: 10px;
    }
    .invoice-content h1.widget-title {
        float:left;
        padding-top: 25px;
        margin-bottom: 80px;
        color: #484848;
        text-transform: uppercase;
        font-size: 2rem;
    }
    .invoice-no {
        float:left;
    }
    .invoice-content h1.widget-title:after {
        content: "";
        border-radius: 10px;
        background-color: #f18c2f;
        width: 30%;
        height: 12px;
        margin-top: 15px;
        display: block;
    }
    .invoice-content .client-info {
        border-bottom: 1px solid #707070;
    }
    .invoice-content .client-info div {
        font-weight: 700;
        padding-bottom: 20px;
    }
    .invoice-content .client-info ul li {
        font-size: 1rem;
        padding: 5px 0;
        font-weight: 600;
    }
    .invoice-content .date div {
        padding:20px 0;
    }



    .table-edit tr {
	 font-size: 14px;
	 border-bottom: 1px solid #484848;
    }
    .table-edit tr th {
        background-color: #484848;
        color: #fff;
        border: none;
        padding: 0.75rem 0 0.75rem 0;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .table-edit tr td {
        color: #484848;
        border: none;
        vertical-align: middle;
        padding: 0.75rem 0.25rem 0.75rem 0.25rem;
    }
    .clearfix {
        clear: both;
    }
    .barcode{
        padding: 25px 0px 35px 0px;
    }
 
</style>

@foreach ($Orders as $Order)
<?php 
$Order = $Order->statistics();
?>

<div class="container">
    <div class="invoice-content p-5">
        <div class="row">
            <div class="barcode" style="width:33.33333333%;float:left">
                <?php 
                    if ($Order->id < 10) {
                        $Order->id = '00'.$Order->id;
                        # code...
                    }
                    // echo '<h1>'.DNS1D::getBarcodeSVG($Order->barcode, "C39",1,36).'</h1>';
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($Order->id, "C39" , 2.5 , 36 ) . '" alt="barcode"   />';
                ?>
                
                <h1 class="widget-title"> {{$Order->client->name}}</h1>
            </div>
            <div style="width:33.33333333%;float:left">
                <div class="text-center">
                    <h1 class="invoice-no">No.#00{{$Order->id}}</h1>
                    
                </div>
            </div>
            <div class="clearfix"></div>

            <div style="width:100%">
                <div class="client-info pb-5">
                    <div>{{$Order->client->name}}</div>
                    <ul>
                        <li>{{$Order->client->name}}</li>
                        <li>{{$Order->client->Address[0]->address}}</li>
                        <li>{{$Order->client->Mobiles[0]->mobile}}</li>
                    </ul>
                </div>
            </div>
            <div style="width:100%">
                <div style="padding-top:4px;padding-bottom:4px" class="date pt-4 pb-4">
                    <div><span style="padding-right:16px">Date</span>{{ $Order->created_at }}</div>
                    <div><span style="padding-right:16px" >Due</span>{{ $Order->date_to_delivery }}</div>
                </div>
            </div>

            <div class="col-12">
                <div class="general-table table-responsive-md">
                    <table id="generalTable"  style="width:100%; text-align:center" class="text-center table-edit table">
                        <thead>
                            <tr class="row-edit">
                                <th>Barcode</th>
                                <th><span>Name</span></th>
                                <th><span>Material</span></th>
                                <th><span>Style</span></th>
                                <th><span>Size</span></th>
                                <th><span>Colors</span></th>
                                <th><span>Quantity</span></th>
                                <th><span>Price</span></th>
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
                                    <span>{{$item->SubProducts->colorName}}</span>
                                </td>
                                <td data-label="Quantity" ><span>{{$item->quantity}}</span></td>
                                <td data-label="Price" ><span>{{$item->price}}</span></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <div style="width:100%; text-align:center" class="">
                thank you for choosing us
            </div>
          
        </div>
        
    </div>
</div>

<div class="container">
        <div class="invoice-content p-5">
            <div class="row">
                <div class="barcode" style="width:33.33333333%;float:left">
                    <?php 
    
                        // echo '<h1>'.DNS1D::getBarcodeSVG($Order->barcode, "C39",1,36).'</h1>';
                        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($Order->id, "C39" , 2.5 , 36 ) . '" alt="barcode"   />';
                    ?>
                    <h1 class="widget-title"> {{$Order->client->name}}</h1>
                </div>
                <div style="width:33.33333333%;float:left">
                    <div class="text-center">
                        <h1 class="invoice-no">No.#00{{$Order->id}}</h1>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
    
                <div style="width:100%">
                    <div class="client-info pb-5">
                        <div>{{$Order->client->name}}</div>
                        <ul>
                            <li>{{$Order->client->name}}</li>
                            <li>{{$Order->client->Address[0]->address}}</li>
                            <li>{{$Order->client->Mobiles[0]->mobile}}</li>
                        </ul>
                    </div>
                </div>
                <div style="width:100%">
                    <div style="padding-top:4px;padding-bottom:4px" class="date pt-4 pb-4">
                        <div><span style="padding-right:16px">Date</span>{{ $Order->created_at }}</div>
                        <div><span style="padding-right:16px" >Due</span>{{ $Order->date_to_delivery }}</div>
                    </div>
                </div>
    
                <div class="col-12">
                    <div class="general-table table-responsive-md">
                        <table id="generalTable"  style="width:100%; text-align:center" class="text-center table-edit table">
                            <thead>
                                <tr class="row-edit">
                                    <th>Barcode</th>
                                    <th><span>Name</span></th>
                                    <th><span>Material</span></th>
                                    <th><span>Style</span></th>
                                    <th><span>Size</span></th>
                                    <th><span>Colors</span></th>
                                    <th><span>Quantity</span></th>
                                    <th><span>Price</span></th>
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
                                        <span>{{$item->SubProducts->colorName}}</span>
                                    </td>
                                    <td data-label="Quantity" ><span>{{$item->quantity}}</span></td>
                                    <td data-label="Price" ><span>{{$item->price}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
    
                        </table>
                    </div>
                </div>
                <div style="width:100%; text-align:center" class="">
                    thank you for choosing us
                </div>
              
            </div>
            
        </div>
    </div>

    <div class="container">
            <div class="invoice-content p-5">
                <div class="row">
                    <div class="barcode" style="width:33.33333333%;float:left">
                        <?php 
              
                            // echo '<h1>'.DNS1D::getBarcodeSVG($Order->barcode, "C39",1,36).'</h1>';
                            echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($Order->id, "C39" ,2 , 36 ) . '" alt="barcode"   />';
                        ?>
                        <h1 class="widget-title"> {{$Order->client->name}}</h1>
                    </div>
                    <div style="width:33.33333333%;float:left">
                        <div class="text-center">
                            <h1 class="invoice-no">No.#00{{$Order->id}}</h1>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
        
                    <div style="width:100%">
                        <div class="client-info pb-5">
                            <div>{{$Order->client->name}}</div>
                            <ul>
                                <li>{{$Order->client->name}}</li>
                                <li>{{$Order->client->Address[0]->address}}</li>
                                <li>{{$Order->client->Mobiles[0]->mobile}}</li>
                            </ul>
                        </div>
                    </div>
                    <div style="width:100%">
                        <div style="padding-top:4px;padding-bottom:4px" class="date pt-4 pb-4">
                            <div><span style="padding-right:16px">Date</span>{{ $Order->created_at }}</div>
                            <div><span style="padding-right:16px" >Due</span>{{ $Order->date_to_delivery }}</div>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="general-table table-responsive-md">
                            <table id="generalTable"  style="width:100%; text-align:center" class="text-center table-edit table">
                                <thead>
                                    <tr class="row-edit">
                                        <th>Barcode</th>
                                        <th><span>Name</span></th>
                                        <th><span>Material</span></th>
                                        <th><span>Style</span></th>
                                        <th><span>Size</span></th>
                                        <th><span>Colors</span></th>
                                        <th><span>Quantity</span></th>
                                        <th><span>Price</span></th>
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
                                            <span>{{$item->SubProducts->colorName}}</span>
                                        </td>
                                        <td data-label="Quantity" ><span>{{$item->quantity}}</span></td>
                                        <td data-label="Price" ><span>{{$item->price}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
        
                            </table>
                        </div>
                    </div>
                    <div style="width:100%; text-align:center" class="">
                        thank you for choosing us
                    </div>
                  
                </div>
                
            </div>
        </div>

@endforeach



