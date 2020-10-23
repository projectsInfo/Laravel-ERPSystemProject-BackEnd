@extends('layouts.app')

@section('content')
<div class="all-sections-supplier">
    <section class="widget add-supplier">
        <div class="container-fluid">
        <h1 class="widget-title mb-0">{{trans('suppliers.addSupplier')}}</h1>
            <div class="widget-content mt-5">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <form  method="POST" action="{{ route('suppler.store') }}"  class="general-form form-create">
                        @csrf
                            <div class="row">
                                <!-- Supplier name form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                    <label for="name">{{trans('Forms.name')}}</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control w-100" aria-describedby="name"
                                            placeholder="{{trans('Forms.PlaceholderSupplierName')}}">
                                    </div>
                                </div>

                                <!-- Supplier Phone Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">{{trans('Forms.phone')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" name="mobile[]" id="phone"
                                                class="form-control supplier-phone" aria-describedby="phone"
                                            placeholder="{{trans('Forms.PlaceholderSupplierPhone')}}">
                                            </div>
                                            <div class="col-3">
                                                <span class="general-btn d-block add-supplier-phone"><i
                                                    class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <div class="add-supplier-phone-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier Email Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">{{trans('Forms.email')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="email" name="email[]" id="email"
                                                class="form-control supplier-email" aria-describedby="email"
                                                placeholder="{{trans('Forms.PlaceholderSupplierEmail')}}">
                                            </div>
                                            <div class="col-3">
                                                <span class="general-btn d-block add-supplier-email"><i
                                                    class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <div class="add-supplier-email-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier address Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">{{trans('Forms.address')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <textarea name="address[]" id="address" class="form-control textAreaHeight supplier-address" aria-describedby="address"
                                                placeholder="{{trans('Forms.PlaceholderSupplierAddress')}}"></textarea>
                                            </div>
                                            <div class="col-3">
                                                <span class="general-btn d-block add-supplier-address"><i class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                       
                                        <div class="add-supplier-address-info">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row btns">
                                        <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>{{trans('Forms.save')}}</button>
                                        <button type="reset" class="exit-btn reset-btn btn-reset btn mt-4"><i class="fa fa-times-circle"></i>{{trans('Forms.reset')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit d-none">
                            @method('PUT')
                            @csrf
                            <input type="hidden" id="supplier_name" name="supplier_name">
                            <input type="hidden" id="supplier_id" name="supplier_id">


                            
                                <div class="row">
                                <!-- Supplier name form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                    <label for="name">{{trans('Forms.name')}}</label>
                                        <input type="text" name="name" id="name_edit"
                                            class="form-control w-100" aria-describedby="name"
                                            placeholder="{{trans('Forms.PlaceholderSupplierName')}}">
                                    </div>
                                </div>
                                <!-- Supplier Phone Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">{{trans('Forms.phone')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="hidden" id="phone_edit_id" name="mobileId[]" value="">
                                                <input type="text" name="mobile[]" id="phone_edit"
                                                class="form-control supplier-phone" aria-describedby="phone"
                                                placeholder="{{trans('Forms.PlaceholderSupplierPhone')}}">
                                            </div>
                                            <div class="col-3">
                                                <span class="general-btn d-block add-supplier-phone"><i
                                                    class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <div class="add-supplier-phone-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier Email Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">{{trans('Forms.email')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="hidden"  id="email_edit_id" name="emailId[]" value="">
                                                <input type="email" name="email[]" id="email_edit"
                                                    class="form-control supplier-email" aria-describedby="email"
                                                    placeholder="{{trans('Forms.PlaceholderSupplierEmail')}}">
                                            </div>
                                            <div class="col-3">
                                                <span class="general-btn d-block add-supplier-email"><i
                                                    class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <div class="add-supplier-email-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier address Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">{{trans('Forms.address')}}</label>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="hidden"  id="address_edit_id" name="addressId[]" value="">
                                                <textarea name="address[]" id="address_edit" class="form-control textAreaHeight supplier-address" aria-describedby="address"
                                                placeholder="{{trans('Forms.PlaceholderSupplierAddress')}}"></textarea>
                                            </div>
                                            <div class="col-3">
                                                <span class="general-btn d-block add-supplier-address"><i class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <div class="add-supplier-address-info">

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
                    <div class="d-none d-md-block col-md-5 bg-supplier"></div>
                </div>
            </div>


        </div>
    </section>


    <!-- Start all users section -->

    <section id="tableSection" class="widget all-users">
        <div class="container-fluid">
            <h1 class="widget-title mb-0">{{trans('suppliers.AllSuppliers')}}</h1>

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
                                    <th><span>{{trans('Forms.products')}}</span></th>
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
                url: '{{ route('suppler.data') }}',
                data: function (d) {
                    d.input = $('input[name=input]').val();
                    d.option = $('#option').val();
                }
            },
            columns: [
                {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                {data: 'name', name: 'name'},
                {data: 'mobile' , name : 'mobile'},
                {data: 'email' , name : 'email'},
                {data: 'address' , name : 'address'},
                {data: 'products' , name : 'products'},
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
                    .attr('data-label', '{{trans('Forms.products')}}');
                $( row ).find('td:eq(6)')
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
<script src="{{ asset('assist/scripts/modules/suppliers/suppliers/suppliers.js')}}"></script>

@endsection
