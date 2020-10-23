@extends('layouts.app')

@section('content')
<section class="widget add-warehouse-place">
    <div class="container-fluid">


            <h1 class="widget-title mb-0">ORDER TO SUPPLIER</h1>

            <div class="widget-content mt-5">
                    <form  method="POST" action="{{ route('warehouse.store') }}"  class="general-form form-create">
                            @csrf
                        <div class="row">
                            <!-- Form inputs -->
                            <div class="col-6">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="warehouseName">{{trans('Forms.name')}}</label>
                                            <input id="warehouseName" type="text" class="form-control" name="name" aria-describedby="warehouse address"
                                                placeholder="{{trans('Forms.PlaceholderWarehouseName')}}">
                                        </div>
                                    </div>
                                    <!-- Address -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="warehouseAddress">{{trans('Forms.address')}}</label>
                                            <textarea id="warehouseAddress" class="form-control textAreaHeight" name="address" aria-describedby="warehouse Address" placeholder="{{trans('Forms.PlaceholderWarehouseAddress')}}"></textarea>
                                        </div>
                                    </div>



                                    <!-- StockMan -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="d-block" for="stockman">{{trans('Forms.stockman')}}</label>
                                            <div class="row">
                                                <div class="col-9">
                                                    <select id="stockman" class="form-control" name="stockman[]" title="Please Select a stockman">
                                                        <option value="">Select Stockman</option>
                                                        @forelse ($Users as $User)
                                                        <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                        @empty
                                                        <option class="form-control" value="">Not funid</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="general-btn d-inline-block text-center create-stockman">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="create-stockman-info" data-select-stockman='
                                            <div class="row">
                                                <div class="col-9">
                                                    <select id="stockman" class="mt-2 form-control" name="stockman[]" title="Please Select a stockman">
                                                        <option value="">Select Stockman</option>
                                                        @forelse ($Users as $User)
                                                        <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                        @empty
                                                        <option class="form-control" value="">Not funid</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="d-inline-block mt-2 danger general-btn text-center delete-stockman">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            '>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row btns">
                                            <button class="btn responsive-btn mt-4 save-btn" type="submit"><i class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                                            <button type="reset" class="btn responsive-btn mt-4 btn-reset reset-btn"><i class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 bg-warehouse">

                            </div>
                        </div>
                        
                    </form>
                    <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit d-none">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="warehouse_name" name="warehouse_name">
                        <input type="hidden" id="warehouse_id" name="warehouse_id">
                        <div class="row">
                            <!-- Form inputs -->
                            <div class="col-12">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-12 col-lg-6">
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
                                            <select  class="form-control" id="stockman-edit" name="stockman[]" title="Please Select a stockman">
                                                <option value="">Select Stockman</option>
                                                @forelse ($Users as $User)
                                                <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                @empty
                                                <option class="form-control" value="">Not funid</option>
                                                @endforelse
                                            </select>
                                            <button type="button" class="d-inline-block general-btn create-stockman edit">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <div class="create-stockman-info" data-select-stockman='
                                                <div class="row">
                                                    <div class="col-9">
                                                            <select id="stockman" class="mt-2 form-control" name="stockman[]" title="Please Select a stockman">
                                                                <option value="">Select Stockman</option>
                                                                @forelse ($Users as $User)
                                                                <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                                @empty
                                                                <option class="form-control" value="">Not funid</option>
                                                                @endforelse
                                                            </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <button type="button" class="mt-2 d-inline-block general-btn delete-stockman">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            '>
                                                
                                            </div>
                                        </div>
                                    </div>
        
        
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
        {{-- <div class="row">
            <div class="col-6">
                <div class="widget-container">
                <h1 class="widget-title mb-0">{{trans('warehousePlaces.addWarehousePlace')}}</h1>
                <div class="widget-content mt-5">
                    <form  method="POST" action="{{ route('warehouse.store') }}"  class="general-form form-create">
                            @csrf
                        <div class="row">
                            <!-- Form inputs -->
                            <div class="col-12">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="warehouseName">{{trans('Forms.name')}}</label>
                                            <input id="warehouseName" type="text" class="form-control" name="name" aria-describedby="warehouse address"
                                                placeholder="{{trans('Forms.PlaceholderWarehouseName')}}">
                                        </div>
                                    </div>
                                    <!-- Address -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="warehouseAddress">{{trans('Forms.address')}}</label>
                                            <textarea id="warehouseAddress" class="form-control textAreaHeight" name="address" aria-describedby="warehouse Address" placeholder="{{trans('Forms.PlaceholderWarehouseAddress')}}"></textarea>
                                        </div>
                                    </div>



                                    <!-- StockMan -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="d-block" for="stockman">{{trans('Forms.stockman')}}</label>
                                            <div class="row">
                                                <div class="col-9">
                                                    <select id="stockman" class="form-control" name="stockman[]" title="Please Select a stockman">
                                                        <option value="">Select Stockman</option>
                                                        @forelse ($Users as $User)
                                                        <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                        @empty
                                                        <option class="form-control" value="">Not funid</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="general-btn d-inline-block text-center create-stockman">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="create-stockman-info" data-select-stockman='
                                            <div class="row">
                                                <div class="col-9">
                                                    <select id="stockman" class="mt-2 form-control" name="stockman[]" title="Please Select a stockman">
                                                        <option value="">Select Stockman</option>
                                                        @forelse ($Users as $User)
                                                        <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                        @empty
                                                        <option class="form-control" value="">Not funid</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="d-inline-block mt-2 danger general-btn text-center delete-stockman">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            '>
                                                
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row btns">
                                    <button class="btn responsive-btn mt-4 save-btn" type="submit"><i class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                                    <button type="reset" class="btn responsive-btn mt-4 btn-reset reset-btn"><i class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit d-none">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="warehouse_name" name="warehouse_name">
                        <input type="hidden" id="warehouse_id" name="warehouse_id">
                        <div class="row">
                            <!-- Form inputs -->
                            <div class="col-12">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-12 col-lg-6">
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
                                            <select  class="form-control" id="stockman-edit" name="stockman[]" title="Please Select a stockman">
                                                <option value="">Select Stockman</option>
                                                @forelse ($Users as $User)
                                                <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                @empty
                                                <option class="form-control" value="">Not funid</option>
                                                @endforelse
                                            </select>
                                            <button type="button" class="d-inline-block general-btn create-stockman edit">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <div class="create-stockman-info" data-select-stockman='
                                                <div class="row">
                                                    <div class="col-9">
                                                            <select id="stockman" class="mt-2 form-control" name="stockman[]" title="Please Select a stockman">
                                                                <option value="">Select Stockman</option>
                                                                @forelse ($Users as $User)
                                                                <option class="form-control" value="{{$User->id}}">{{$User->name}}</option>
                                                                @empty
                                                                <option class="form-control" value="">Not funid</option>
                                                                @endforelse
                                                            </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <button type="button" class="mt-2 d-inline-block general-btn delete-stockman">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            '>
                                                
                                            </div>
                                        </div>
                                    </div>
        
        
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
            </div>
            <div class="d-none d-lg-block col-6 bg-warehouse"></div>
        </div> --}}
    </div>
</section>
<!-- End Add Warehose places wedget -->
<!-- Start Table Widget -->
<section id="tableSection" class="all-warehouse-places widget">
    <div class="container-fluid">
    <h1 class="widget-title mb-0">{{trans('warehousePlaces.allWarehousePlace')}}</h1>
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
                                <option class="form-control" value="Name">{{trans('Forms.stockman')}}</option>
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
      

            <!-- All Warehose places table -->

            <div class="general-table">
                <table id="generalTable" class="text-center table-edit table">
                    <thead>
                        <tr class="row-edit">
                            <th><span>No.</span></th>
                            <th><span>{{trans('Forms.name')}}</span></th>
                            <th><span>{{trans('Forms.address')}}</span></th>
                            <th><span>{{trans('Forms.stockman')}}</span></th>
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
            serverSide: true,
            searching : false,
            ordering: false,
            pageLength: 10,
            autoWidth: false,
            pagingType : "full_numbers",
            ajax: {
                url: '{{ route('warehouse.data') }}',
                data: function (d) {
                    d.input = $('input[name=input]').val();
                    d.option = $('#option').val();
                }
            },
            columns: [
                {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                {data: 'name', name: 'name'},
                {data: 'address' , name : 'address'},
                {data: 'Users' , name : 'Users'},
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
                    .attr('data-label', '{{trans('Forms.address')}}');
                $( row ).find('td:eq(3)')
                    .attr('data-label', '{{trans('Forms.stockman')}}');
                $( row ).find('td:eq(4)')
                    .attr('data-label', 'action');
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

@endsection

@section('scripts')
<script src="{{ asset('assist/scripts/modules/ware-house/warehose-places/warehose-places.js') }}"></script>
<script>


</script>
@endsection
