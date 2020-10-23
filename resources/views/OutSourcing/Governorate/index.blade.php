@extends('layouts.app')

@section('content')

<section class="widget">
        <div class="container-fluid">
            <h1 class="widget-title mb-0">{{trans('Governorate.create_Governorate')}}</h1>
            <div class="widget-content mt-5">
                <form enctype="multipart/form-data" autocomplete="off"  method="POST" action="{{ route('governorate.store') }}"  class="user general-form form-create">
                    @csrf
                    <div class="row">

                        <!-- Form inputs -->

                        <div class="col-xl-12 col-sm-12 order-xl-0">

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}} </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            aria-describedby="name" placeholder="{{trans('Forms.PlaceholderName')}}">

                                    </div>
                                </div>
                               
                            
                            </div>
                        </div>
                        <div class="col-lg-12 order-3">
                            <div class="row btns">
                                <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>
                                    {{trans('Forms.save')}}</button>
                                <button type="reset" class="exit-btn btn mt-4 reset-btn form-reset"><i
                                        class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form enctype="multipart/form-data" autocomplete="off"  method="POST" action=""  class="user general-form form-edit d-none">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <!-- Profile image -->
        
                        <!-- Form inputs -->
                        <div class="col-xl-12 col-sm-12 order-xl-0">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}} </label>
                                        <input type="hidden" name="governorate_id" id="governorate_id">
                                        <input type="text" name="name" id="name-edit" class="form-control"
                                            aria-describedby="name" placeholder="{{trans('Forms.PlaceholderName')}}">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-12 order-3">
                            <div class="row btns">
                                <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>
                                    {{trans('Forms.save')}}</button>
                                <button type="button" onclick="location.reload()" class="exit-btn reset-btn btn mt-4 form-reset"><i
                                        class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </section>
    
    <!-- End user wedget -->

    <!-- Start all users section -->

    <section id="tableSection" class="widget all-users">
        <div class="container-fluid">
            <h1 class="widget-title mb-0">{{trans('Governorate.AllGovernorate')}}</h1>
            <div class="widget-content table mt-5">
                <form class="general-search" id="search-form">
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label for="filter">{{trans('glopal.Search')}}</label>
                                <input type="search" name="input" class="form-control" id="filter"
                            placeholder="{{trans('glopal.typeToSearch')}}">
                            </div>

                        </div>

                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="departments">{{trans('glopal.FilterBy')}}</label>
                                <select id="option" name="option" class="form-control">
                                    <option class="form-control" value="name">{{trans('Forms.name')}}</option>
                                    <option class="form-control" value="Phone">{{trans('Forms.phone')}}</option>
                                    <option class="form-control" value="email">{{trans('Forms.UserName')}}</option>
                                    <option class="form-control" value="Department">{{trans('Forms.departments')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3">
                            <button type="submit" id="search_btn" class="general-btn search_btn"><i
                                    class="fas fa-search"></i> {{trans('glopal.Search')}}</button>
                        </div>
                    </div>
                </form>
                <!-- All users table -->

                <div class="general-table">
                    <table id="generalTable" class="text-center table-edit table" style="width:100%">
                        <thead>
                            <tr class="row-edit">
                                <th>No.</th>
                                <th>{{trans('Forms.name')}}</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                        </tbody>
                    </table>
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
                        url: '{{ route('governorate.data') }}',
                        data: function (d) {
                            d.input = $('input[name=input]').val();
                            d.option = $('#option').val();
                        }
                    },
                    columns: [
                        {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                        {data: 'name', name: 'name'},
                   
                        {data: 'action' , name : 'action'},
                    ],
                    language: {
                        "sDecimal": '{{trans('DataTables.decimal')}}',
                        "sEmptyTable": '{{trans('DataTables.emptyTable')}}',
                        "sInfo": '{{trans('DataTables.info')}}',
                        "sInfoEmpty": '{{trans('DataTables.infoEmpty')}}',
                        "sInfoFiltered": '{{trans('DataTables.infoFiltered')}}',
                        "sInfoPostFix": '{{trans('DataTables.infoPostFix')}}',
                        "sThousands": '{{trans('DataTables.thousands')}}',
                        "sLengthMenu": '{{trans('DataTables.lengthMenu')}}',
                        "sLoadingRecords": '{{trans('DataTables.loadingRecords')}}',
                        "sProcessing": '{{trans('DataTables.processing')}}',
                        "sSearch": '{{trans('DataTables.search')}}',
                        "sZeroRecords": '{{trans('DataTables.zeroRecords')}}',
                        "paginate": {
                                    "first":      "<<",
                                    "last":       ">>",
                                    "next":       ">",
                                    "previous":   "<"
                        },
                        "sAria": {
                            "sSortAscending": '{{trans('DataTables.sortAscending')}}',
                            "sSortDescending": '{{trans('DataTables.sortDescending')}}',
                        }
                    },
                    createdRow: function( row, data, dataIndex ) {
                        // Set the data-status attribute, and add a class
                        $( row ).find('td:eq(0)')
                            .attr('data-label', '#');
                        $( row ).find('td:eq(1)')
                            .attr('data-label', 'Name');
                        $( row ).find('td:eq(2)')
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('assist/scripts/modules/OutSourcing/governorate.js')}}"></script>

@endsection
