@extends('layouts.app')

@section('content')
<!-- Add department Section -->
                <!-- Add department Section -->
                <section class="widget add-department">
                    <div class="container-fluid">
                        <h1 class="widget-title mb-0">{{trans('Department.add_department')}}</h1>
                        <div class="widget-content mt-5 department-page">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <form  method="POST" action="{{ route('department.store') }}"  class="general-form form-create">
                                        @csrf
                                        <!-- Form inputs -->
                                        <div class="row">
                                            <!-- Department name -->
                                            <div class="col-md-12">
                                                <div class="form-group has-danger">
                                                    <label class="input-name" for="name">{{trans('Forms.Add_department')}}</label>
                                                    <input type="text" name="name" id="name" class="form-control " aria-describedby="name"
                                                        placeholder="{{trans('Forms.PlaceholderAdd_department')}}">
                                                    <label class="name-error" ></label>
                                                </div>
                                            </div>

                                            <div class="mb-4 department-types col-12">
                                            <h3>{{trans('Forms.pagesAccess')}}</h3>
                                                <ul>

                                                        @forelse ($permissions as $permission)
                                                        <input type="checkbox" name="permissions[]" id="{{$permission}}" value="{{$permission}}" class="checkhour">
                                                        <label for="{{$permission}}" class="checkbox-label">{{$permission}} <span><i class="far fa-check-circle"></i></span></label>

                                                        @empty
                                                            
                                                        @endforelse
                                                    
                                                    
                                                </ul>
                                                <label class="permissions-error" ></label>
                                                <div class="check-all btns mt-5 d-flex justify-content-center" class="checkhour">
                                                    <button type="button" class="btn check-btn text-capitalize">{{trans('Forms.checkAll')}}</button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="row btns">
                                                    <button class="create-department responsive-btn mt-4 save-btn btn" type="submit"><i class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                                                    <button type="reset" class="btn responsive-btn mt-4 reset-btn btn-reset"><i class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit d-none">
                                        @method('PUT')
                                        @csrf
                    
                                        <div class="row">
                                            <!-- Department name -->
                                            <div class="col-md-12">
                                                <div class="form-group has-danger">
                                                    <label class="input-name" for="name">{{trans('Forms.Add_department')}}</label>
                                                    <input type="text" name="name" id="name-edit" class="form-control " aria-describedby="name"
                                                        placeholder="{{trans('Forms.PlaceholderAdd_department')}}">
                                                    <label class="name-error" ></label>
                                                </div>
                                            </div>

                                            <div class="mb-4 department-types col-12">
                                                <h3>{{trans('Forms.pagesAccess')}}</h3>
                                                <ul>
                                                    <li>
                                                        @forelse ($permissions as $permission)
                                                            <input type="checkbox" name="permissions[]" id="{{$permission}}-edit" value="{{$permission}}" class="checkhour">
                                                            <label for="{{$permission}}-edit" class="checkbox-label">{{$permission}} <span><i class="far fa-check-circle"></i></span></label>
                                                        @empty
                                                            
                                                        @endforelse
                                                    </li>
                                                </ul>
                                                <label class="permissions-error" ></label>
                                                <div class="check-all btns mt-5 d-flex justify-content-center" class="checkhour">
                                                    <span class="btn check-btn">{{trans('Forms.checkAll')}}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="row btns">
                                                    <button class="create-department responsive-btn mt-4 save-btn btn" type="submit"><i class="fa fa-save"></i> {{trans('Forms.save')}}</button>
                                                    <button type="reset" class="btn responsive-btn mt-4 btn-reset reset-btn form-reset-edit"><i class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="bg-department d-none d-lg-block col-6"></div>
                                
                            </div>
                        </div>
                    </div>
                </section>

                <section id="tableSection" class="widget">
                    <div class="container-fluid">
                    <h1 class="widget-title mb-0">{{trans('Department.all_Departments')}}</h1>
                        <div class="widget-content table mt-5">
                            <form class="general-search" id="search-form">
                                <div class="row">
                                    <div class="col-12 col-md-5 col-lg-5">
                                        <div class="form-group">
                                            <label for="username">{{trans('glopal.Search')}}</label>
                                            <input type="search" name="input" class="form-control" id="filter"
                                        placeholder="{{trans('glopal.typeToSearch')}}">
                                        </div>
            
                                    </div>
            
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="departments">{{trans('glopal.FilterBy')}}</label>
                                            <select id="option" name="option" class="form-control">
                                            <option class="form-control" value="name">{{trans('Forms.name')}}</option>
                                                <option class="form-control" value="pages">{{trans('Forms.pages')}}</option>
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
                                <table id="generalTable" class="text-center table-edit table">
                                    <thead>
                                        <tr class="row-edit">
                                            <th >No.</th>
                                            <th >{{trans('Forms.name')}}</th>
                                            <th >{{trans('Forms.pages')}}</th>
                                            <th >ACTION</th>
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
                                url: '{{ route('department.data') }}',
                                data: function (d) {
                                    d.input = $('input[name=input]').val();
                                    d.option = $('#option').val();
                                }
                            },
                            columns: [
                                {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                                {data: 'name', name: 'name'},
                                {data: 'permissions' , name : 'permissions'},
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
                                    .attr('data-label', 'Name');
                                $( row ).find('td:eq(2)')
                                    .attr('data-label', 'PAGES');
                                $( row ).find('td:eq(3)')
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
<script src="{{ asset('assist/scripts/modules/hr/department.js')}}"></script> 

<script>






</script>
@endsection
