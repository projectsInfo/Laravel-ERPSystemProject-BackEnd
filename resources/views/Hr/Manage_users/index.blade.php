@extends('layouts.app')

@section('content')

<section class="widget">
        <div class="container-fluid">
            <h1 class="widget-title mb-0">{{trans('mangeUser.create_user')}}</h1>
            <div class="widget-content mt-5">
                <form enctype="multipart/form-data" autocomplete="off"  method="POST" action="{{ route('manage_users.store') }}"  class="user general-form form-create">
                    @csrf
                    <div class="row">

                        <!-- Profile image -->
                        <label class="profileImgIn-error" ></label>

                        <div class="col-xl-5 col-sm-12 order-xl-1 d-flex justify-content-center">

                            <div
                                class="profile-img-wrapper ml-xl-auto">
                                <div
                                    class="img-text d-flex flex-wrap justify-content-center align-items-center flex-column">
                                    <i class="fa fa-images"></i>
                                    <h3 class="text-center d-none d-md-block">{{trans('mangeUser.Drag&drop')}} </h3>
                                </div>
                                <input name="avatar" type="file" accept="image/*" id="profileImgIn" class="file-upload">
                                <div class="img-preview">
                                    <img alt="profile-img">
                                </div>
                                <div class="img-overlay text-center justify-content-center flex-column">
                                    <h3 class="img-name"></h3>
                                    <h4 class="mt-5 d-none d-md-block">Drag & drop or click here to replace</h4>
                                </div>
                                <span class="remove-img btn"><i class="fa fa-times mr-1"></i> Remove
                                    image</span>
                            </div>

                        </div>

                        <!-- Form inputs -->

                        <div class="col-xl-7 col-sm-12 order-xl-0">

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}} </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            aria-describedby="name" placeholder="{{trans('Forms.PlaceholderName')}}">

                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{trans('Forms.address')}}</label>
                                        <textarea name="address" id="address" class="form-control textAreaHeight"
                                            aria-describedby="address" placeholder="{{trans('Forms.PlaceholderAddress')}}"></textarea>

                                    </div>
                                </div>
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{trans('Forms.phone')}}</label>
                                        <div class="select-phone">
                                            <input type="radio" name="landline" id="landline">
                                            <label class="radio-label" for="landline"><i class="fas fa-fw fa-phone-volume"></i></label>
                                            <input type="radio" name="landline" id="phone">
                                            <label for="phone"><i class="fas fa-fw fa-mobile-alt"></i></i></label>
                                        </div>
                                        
                                        <input type="tel" name="mobile" id="mobile" class="form-control"
                                            placeholder="{{trans('Forms.PlaceholderPhone')}}" disabled>

                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">{{trans('Forms.gender')}}</label>
                                        <select name="gender" id="gender" class="form-control"
                                            title="{{trans('Forms.PlaceholderGender')}}">
                                            <option class="form-control" value="">{{trans('Forms.PlaceholderGender')}}</option>
                                            <option class="form-control" value="Male">{{trans('Forms.Male')}}</option>
                                            <option class="form-control" value="Female">{{trans('Forms.Female')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Departments  -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departments">{{trans('Forms.departments')}}</label>
                                        <select name="departments" id="departments" class="form-control"
                                            title="{{trans('Forms.PlaceholderDepartments')}}">
                                            <option class="form-control" value="">{{trans('Forms.PlaceholderDepartments')}}
                                            </option>
                                            @forelse ($Roles as $Role)
                                            <option class="form-control" value="{{$Role}}">{{$Role}}</option>
                                            @empty
                                            <option class="form-control" value="">{{trans('Forms.PlaceholderNotFoined')}}</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <!-- Username -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{trans('Forms.UserName')}}</label>
                                        <input type="text" name="email" id="email"
                                            class="form-control" placeholder="{{trans('Forms.PlaceholderUserName')}}">
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{trans('Forms.password')}}</label>
                                        <input type="text" name="password" id="password"
                                        class="form-control" placeholder="{{trans('Forms.PlaceholderPassword')}}">
                                        <div class="copy">
                                            <button type="button" class="copy-pass" title="copy password"><i class="fas fa-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword">{{trans('Forms.ConfirmPassword')}}</label>
                                        <input type="text" name="password_confirmation" id="confirmPassword"
                                            class="form-control" placeholder="{{trans('Forms.PlaceholderConfirmPassword')}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="mt-5 mr-4 btn general-btn d-inline-block" id="generatePass" disabled>{{trans('Forms.GeneratePassword')}}</button>
                                </div>
                                <!-- Upload a file -->
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="file-upload">{{trans('Forms.UploadFile')}}</label>
                                        <input type="file"
                                            class="form-control uploaded-file" name="file" id="fileUpload" multiple>
                                        <input type="text" id="file" class="form-control"
                                            placeholder="{{trans('Forms.Placeholderfile')}}">
                                        <button type="button" class="mt-5 btn btn-safe upload-file general-btn">{{trans('Forms.cv')}}</button>
                                        <button type="button" class="mt-5 btn btn-safe upload-file general-btn">{{trans('Forms.contract')}}</button>
                                    </div>
                                    <a class="d-none mt-5 btn btn-safe general-btn download-file"
                                        href="#">Download</a>
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
                        <label class="profileImgIn-error" ></label>
                        <div class="col-xl-5 col-sm-12 order-xl-1 d-flex justify-content-center">
                            <div
                                class="profile-img-wrapper ml-xl-auto d-flex justify-content-center align-items-center">
                                <div
                                    class="img-text d-flex flex-wrap justify-content-center align-items-center flex-column">
                                    <i class="fa fa-images"></i>
                                    <h3 class="text-center d-none d-md-block">{{trans('mangeUser.Drag&drop')}} </h3>
                                </div>
                                <input name="avatar" type="file" id="profileImgIn"
                                    class="file-upload">
                                <div class="img-preview">
                                    <img alt="profile-img">
                                </div>
                                <div class="img-overlay text-center justify-content-center flex-column">
                                    <h3 class="img-name"></h3>
                                    <h4 class="mt-5">Drag & drop or click here to replace</h4>
                                </div>
                                <span class="remove-img btn"><i class="fa fa-times mr-1"></i> Remove
                                    image</span>
                            </div>
                        </div>
                        <!-- Form inputs -->
                        <div class="col-xl-7 col-sm-12 order-xl-0">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}} </label>
                                        <input type="text" name="name" id="name-edit" class="form-control"
                                            aria-describedby="name" placeholder="{{trans('Forms.PlaceholderName')}}">
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{trans('Forms.address')}}</label>
                                        <textarea name="address" id="address-edit" class="form-control textAreaHeight"
                                            aria-describedby="address" placeholder="{{trans('Forms.PlaceholderAddress')}}"></textarea>

                                    </div>
                                </div>
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{trans('Forms.phone')}}</label>
                                        <input type="tel" name="mobile" id="mobile-edit" class="form-control"
                                            placeholder="{{trans('Forms.PlaceholderPhone')}}">

                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">{{trans('Forms.gender')}}</label>
                                        <select name="gender" id="gender-edit" class="form-control"
                                            title="{{trans('Forms.PlaceholderGender')}}">
                                            <option class="form-control" value="">{{trans('Forms.PlaceholderGender')}}</option>
                                            <option class="form-control" value="Male">{{trans('Forms.Male')}}</option>
                                            <option class="form-control" value="Female">{{trans('Forms.Female')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Departments  -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departments">{{trans('Forms.departments')}}</label>
                                        <select name="departments" id="departments-edit" class="form-control"
                                            title="{{trans('Forms.PlaceholderDepartments')}}">
                                            <option class="form-control" value="">{{trans('Forms.PlaceholderDepartments')}}
                                            </option>
                                            @forelse ($Roles as $Role)
                                            <option class="form-control" value="{{$Role}}">{{$Role}}</option>
                                            @empty
                                            <option class="form-control" value="">{{trans('Forms.PlaceholderNotFoined')}}</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <!-- Username -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Email">{{trans('Forms.UserName')}}</label>
                                        <input type="text" name="email" id="email-edit"
                                            class="form-control" placeholder="{{trans('Forms.PlaceholderUserName')}}">
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{trans('Forms.password')}}</label>
                                        <input type="text" name="password" id="password-edit"
                                        class="form-control" placeholder="{{trans('Forms.PlaceholderPassword')}}">
                                        <div class="copy">
                                            <button type="button" class="copy-pass" title="copy password"><i class="fas fa-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword">{{trans('Forms.ConfirmPassword')}}</label>
                                        <input type="text" name="password_confirmation" id="confirmPassword-edit"
                                            class="form-control" placeholder="{{trans('Forms.PlaceholderConfirmPassword')}}">
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <button type="button" class="mt-5 mr-4 btn general-btn d-inline-block" id="generatePass-edit" disabled>{{trans('Forms.GeneratePassword')}}</button>
                                </div> --}}
                                <!-- Upload a file -->
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="file-upload">{{trans('Forms.UploadFile')}}</label>
                                        <input type="file"
                                            class="form-control uploaded-file" name="file" id="fileUpload">
                                        <input type="text" id="file-edit" class="form-control"
                                            placeholder="{{trans('Forms.Placeholderfile')}}">
                                        <span
                                            class="mt-5 btn btn-safe upload-file general-btn">{{trans('Forms.Upload')}}</span>
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
            <h1 class="widget-title mb-0">{{trans('mangeUser.AllUsers')}}</h1>
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
                                <th width="6%">No.</th>
                                <th width="20%">{{trans('Forms.name')}}</th>
                                <th width="10%">{{trans('Forms.phone')}}</th>
                                <th width="30%">{{trans('Forms.UserName')}}</th>
                                <th width="15%">{{trans('Forms.departments')}}</th>
                                <th width="12%">ACTION</th>
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
                        url: '{{ route('manage_users.data') }}',
                        data: function (d) {
                            d.input = $('input[name=input]').val();
                            d.option = $('#option').val();
                        }
                    },
                    columns: [
                        {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                        {data: 'name', name: 'name'},
                        {data: 'mobile', name: 'mobile'},
                        {data: 'email', name: 'email'},
                        {data: 'departments' , name : 'departments'},
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
                            .attr('data-label', 'Mobile');
                        $( row ).find('td:eq(3)')
                            .attr('data-label', 'User Name');
                        $( row ).find('td:eq(4)')
                            .attr('data-label', 'departments');
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('assist/scripts/modules/hr/manage-users.js')}}"></script>

@endsection
