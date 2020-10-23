@extends('layouts.app')

@section('content')
<section id="tableSection" class="widget all-users">
    <div class="container-fluid">
    <h1 class="widget-title mb-0">{{trans('crmClients.allClients')}}</h1>

        <div class="widget-content mt-5">
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
                            <th><span>No.</span></th>
                            <th><span>{{trans('Forms.name')}}</span></th>
                            <th><span>{{trans('Forms.phone')}}</span></th>
                            <th><span>{{trans('Forms.address')}}</span></th>
                            <th><span class="white-space-nowrap">{{trans('Forms.SocialAccounts')}}</span></th>
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
                url: '{{ route('client.data') }}',
                data: function (d) {
                    d.input = $('input[name=input]').val();
                    d.option = $('#option').val();
                }
            },
            columns: [
                {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                {data: 'name', name: 'name'},
                {data: 'mobile' , name : 'mobile'},
                {data: 'address' , name : 'address'},
                {data: 'social_accounts' , name : 'social_accounts'},
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
                    .attr('data-label', '{{trans('Forms.address')}}');
                $( row ).find('td:eq(4)')
                    .attr('data-label', '{{trans('Forms.SocialAccounts')}}');   
                $( row ).find('td:eq(5)')
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
<script src="{{ asset('assets/scripts/modules/crm/crm_all_clients.js')}}"></script>

@endsection
