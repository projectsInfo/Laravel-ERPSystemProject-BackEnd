@extends('layouts.app')
@section('content')
<div>
    <section class="widget delivary-company">
        <div class="container-fluid">
        <h1 class="widget-title mb-0">{{trans('delivaryCompany.delivaryCompany')}}</h1>
            <div class="widget-content mt-5">
                <form  method="POST" action="{{ route('delivarycompany.store') }}"  class="general-form form-create">
                        @csrf
                    <!-- Form inputs -->
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{trans('Forms.name')}}</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    aria-describedby="name" placeholder="{{trans('Forms.name')}}">
                            </div>
                        </div>


                        <!-- Phone -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">{{trans('Forms.phone')}}</label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    placeholder="{{trans('Forms.phone')}}">
                            </div>
                        </div>


                        <!-- Address -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">{{trans('Forms.address')}}</label>
                                <textarea name="address" id="address" class="form-control textAreaHeight"
                                    aria-describedby="address" placeholder="{{trans('Forms.address')}}"></textarea>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{trans('Forms.email')}}</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    aria-describedby="email" placeholder="{{trans('Forms.email')}}">
                            </div>
                        </div>

                        <!-- City Fees -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                                        <select name="city[]" class="form-control city"
                                            title="Please select a City">
                                            <option value="">{{trans('Forms.selectCity')}}</option>
                                            @foreach ($City as $Cities)
                                            <option value="{{$Cities->id}}">{{$Cities->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text" class="w-100">{{trans('Forms.price')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="number" step="0.01" min="0.01" name="price[]" id="price" class="form-control w-100 d-inline" aria-describedby="price" value="" >
                                            </div>
                                            <div class="col-3">
                                                <button type="button" class="d-block general-btn text-center create-delivary-city"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="create-delivary-city-info col-12" data-select-delivary-city='
                                <div class="row">
                                    <div class="col-md-6">
                                            <input type="hidden" name="DelivaryCompanieDetailsId[]" value="0">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select name="city[]"  class="form-control city"
                                                    title="Please select a City">
                                                    <option value="">Select a City</option>
                                                    @foreach ($City as $Cities)
                                                    <option value="{{$Cities->id}}">{{$Cities->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text" class="w-100">price</label>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <input type="number" step="0.01" min="0.01" name="price[]" id="price" class="form-control w-100 d-inline" aria-describedby="price" value="" >
                                                    </div>
                                                    <div class="col-3">
                                                        <button type="button" id_delete="0" class="d-block general-btn text-center danger delete-delivary-city"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                '>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 order-3">
                            <div class="row btns">
                                <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>
                                {{trans('Forms.save')}}</button>
                                <button type="reset" class="exit-btn reset-btn btn mt-4"><i
                                        class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                            </div>
                        </div>

                    </div>
                </form>
                <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit d-none">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <!-- Form inputs -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}}</label>
                                        <input type="text" name="name" id="name-edit" class="form-control"
                                            aria-describedby="name" placeholder="{{trans('Forms.name')}}">
                                    </div>
                                </div>
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{trans('Forms.phone')}}</label>
                                        <input type="tel" name="phone" id="phone-edit" class="form-control"
                                            placeholder="{{trans('Forms.phone')}}">
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{trans('Forms.address')}}</label>
                                        <input type="text" name="address" id="address-edit" class="form-control"
                                            aria-describedby="address" placeholder="{{trans('Forms.address')}}">
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{trans('Forms.email')}}</label>
                                        <input type="email" name="email" id="email-edit" class="form-control"
                                            aria-describedby="email" placeholder="{{trans('Forms.email')}}">
                                    </div>
                                </div>
                                <!-- City Fees -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="w-100" for="city">{{trans('Forms.city')}}</label>
                                                <select name="city[]" id="city-edit" class="form-control city"
                                                    title="Please select a City">
                                                    <option value="">{{trans('Forms.selectCity')}}</option>
                                                    @foreach ($City as $Cities)
                                                    <option value="{{$Cities->id}}">{{$Cities->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text" class="w-100">{{trans('Forms.price')}}</label>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <input type="hidden" name="DelivaryCompanieDetailsId[]" id="DelivaryCompanieDetailsId-edit" value="0">
                                                        <input type="number" step="0.01" min="0.01" name="price[]" id="price-edit" class="form-control w-100 d-inline" aria-describedby="price" value="" >
                                                    </div>
                                                    <div class="col-3">
                                                        <button type="button" class="d-block general-btn text-center create-delivary-city"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="create-delivary-city-info col-12">
                                        </div>
                                    </div>
                                </div>
                                <!-- Name -->
                                {{-- <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="warehouseName">{{trans('Forms.name')}}</label>
                                        <input  type="text" class="form-control" id="name-edit" name="name" aria-describedby="warehouse address"
                                            placeholder="{{trans('Forms.PlaceholderWarehouseName')}}">
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="warehouseAddress">{{trans('Forms.address')}}</label>
                                        <input  type="text" class="form-control" id="address-edit" name="address" aria-describedby="warehouse Address" placeholder="{{trans('Forms.PlaceholderWarehouseAddress')}}">
                                    </div>
                                </div>
    
                                <!-- StockMan -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="d-block" for="stockman">{{trans('Forms.stockman')}}</label>
                                        <select  class="w-50 form-control" id="stockman-edit" name="stockman[]" title="Please Select a stockman">
                                            <option value="">Select Stockman</option>
                                            @forelse ($Users as $User)
                                            <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                            @empty
                                            <option class="form-control" value="">Not funid</option>
                                            @endforelse
                                        </select>
                                        <span class="general-btn create-stockman edit">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <div class="create-stockman-info" data-select-stockman='
                                            <div>
                                                <select id="stockman" class="mt-2 w-50 form-control" name="stockman[]" title="Please Select a stockman">
                                                <option value="">Select Stockman</option>
                                                @forelse ($Users as $User)
                                                <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                @empty
                                                <option class="form-control" value="">Not funid</option>
                                                @endforelse
                                                </select>
                                                <button type="button" class="mt-2 general-btn delete-stockman">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        '>
                                            
                                        </div>
                                    </div>
                                </div> --}}
    
    
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row btns">
                                <button type="submit" class="btn save-btn mt-4"><i
                                        class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                                <button type="reset" class="exit-btn reset-btn btn btn-reset mt-4"><i
                                        class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Start all users section -->

    <section id="tableSection" class="widget all-users">
        <div class="container-fluid">
        <h1 class="widget-title mb-0">{{trans('delivaryCompany.allDelivaryCompany')}}</h1>

            <div class="widget-content table mt-5">
                <form class="general-search" id="search-form">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-5">
                                <div class="form-group">
                                    <label for="username">{{trans('glopal.Search')}}</label>
                                    <input type="search" class="form-control" id="filter" name="input" placeholder="{{trans('glopal.typeToSearch')}}">
                                </div>
        
                            </div>
        
                            <div class="col-7 col-sm-3 col-lg-4">
                                <div class="form-group">
                                    <label for="departments">{{trans('glopal.FilterBy')}}</label>
                                    <select id="option" name="option" class="form-control">
                                        <option class="form-control" value="Name">{{trans('Forms.name')}}</option>
                                        <option class="form-control" value="Name">{{trans('Forms.email')}}</option>
                                        <option class="form-control" value="Phone">{{trans('Forms.phone')}}</option>
                                        <option class="form-control" value="Address">{{trans('Forms.address')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5 col-sm-3 col-lg-3">
                                <button type="submit" id="search_btn" class="general-btn search_btn"><i
                                    class="fas fa-search"></i> {{trans('glopal.Search')}}</button>
                            </div>
                        </div>
                    </form>
               
                <!-- All users table -->

                <div class="general-table">
                    <table id="generalTable" class="text-center table-edit table">
                        <thead>
                            <tr class="row-edit">
                                <div class="row">
                                    <th><span>No.</span></th>
                                    <th><span>{{trans('Forms.name')}}</span></th>
                                    <th><span>{{trans('Forms.phone')}}</span></th>
                                    <th><span>{{trans('Forms.email')}}</span></th>
                                    <th><span>{{trans('Forms.address')}}</span></th>
                                    <th><span>Action</span></th>
                                </div>
                            </tr>
                        </thead>

    
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
            </div>
            @push('js')
            <script>
            var oTable = $('#generalTable').DataTable({
            processing: true,
            serverSide: true,
            searching : false,
            ordering: false,
            pageLength: 10,
            autoWidth: false,
            pagingType : "full_numbers",
            ajax: {
                url: '{{ route('delivarycompany.data') }}',
                data: function (d) {
                    d.input = $('input[name=input]').val();
                    d.option = $('#option').val();
                }
            },
            columns: [
                {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                {data: 'Name', name: 'Name'},
                {data: 'Address' , name : 'Address'},
                {data: 'Phone' , name : 'Phone'},
                {data: 'Email' , name : 'Email'},
                {data: 'action' , name : 'action'},
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
                    .attr('data-label', '{{trans('Forms.name')}}');
                $( row ).find('td:eq(2)')
                    .attr('data-label', '{{trans('Forms.phone')}}');
                $( row ).find('td:eq(3)')
                    .attr('data-label', '{{trans('Forms.email')}}');
                $( row ).find('td:eq(4)')
                    .attr('data-label', '{{trans('Forms.address')}}');
                $( row ).find('td:eq(5)')
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
    </section>

</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{ asset('assist/scripts/modules/Company/delivary-company.js')}}"></script>

@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" />
@endsection

