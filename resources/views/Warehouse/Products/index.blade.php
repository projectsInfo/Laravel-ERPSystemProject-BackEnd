@extends('layouts.app')
@section('content')
<div class="all-sections-supplier">
    <section class="widget create-procuts">
        <div class="container-fluid">
        <h1 class="widget-title mb-0">{{trans('product.createProduct')}}</h1>
            <div class="widget-content mt-5">
                <form  enctype="multipart/form-data" method="POST" action="{{ route('product.store') }}"  class="general-form form-create create-procuts-form">
                    @csrf
                    <div class="row">

                        <!-- Upload Images -->

                        <div class="form-group">
                            {!! Form::label('images', 'Product gallery') !!}
                            <div class="wrapper-all-images">
                                @for($i = 0; $i < 12; $i++)
                                    <div class="box-image">
                                        <label for="imgInp-{{$i}}"><span num="{{$i}}">X</span><img class="blah" id="blah-{{$i}}" src="https://screenshotlayer.com/images/assets/placeholder.png" num="{{$i}}" alt="your image" /></label>
                                        <input type='file'id="imgInp-{{$i}}"   name="images[]" class="imgInp" num="{{$i}}" />
                                        {{-- <input type='text'id="code-{{$i}}" placeholder="كود المنتج"   name="codes[]" class="code" num="{{$i}}" disabled /> --}}
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Form inputs -->
                        
                        <div class="col-xl-7 col-sm-12 order-xl-0">

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Forms.name')}}</label>
                                        <input id="name" type="text" class="form-control" name="name"
                                            aria-describedby="name" placeholder="{{trans('Forms.name')}}">
                                    </div>
                                </div>
                                <!-- Style -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="style">{{trans('Forms.style')}}</label>
                                        <input id="style" type="text" class="form-control" name="style"
                                            placeholder="{{trans('Forms.style')}}">
                                    </div>
                                </div>
                                <!-- Material -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="material">{{trans('Forms.material')}}</label>
                                        <input id="material" type="text" class="form-control"
                                            name="material" placeholder="{{trans('Forms.material')}}">
                                    </div>
                                </div>
                                <!-- Color pallete -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colorPickSelector">{{trans('Forms.colors')}}</label>

                                        <div class="color-pallete">
                                            <button id="colorDropdown"
                                                class="btn color-pallete-btn dropdown-toggle"
                                                type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="color-circle"></span>
                                        <span class="color-name">{{trans('Forms.selectColor')}}</span>
                                            </button>

                                            <div class="dropdown-menu color-menu"
                                                aria-labelledby="colorDropdown">
                                                <div>
                                                    <span>Colors</span>
                                                    <button type="button" class="btn general-btn add-color" data-toggle="modal" data-target="#allColors">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="colors"></div>
                                            </div>
                                            <div class="tags color-tags"></div>
                                            
                                            
                                        </div>

                                    </div>
                                </div>
                                <!-- Price  -->
                                <div class="col-md-6">
                                    <div class="form-group selling-price">
                                        <label class="w-100">{{trans('Forms.price')}}</label>
                                            <input id="sellingPrice" type="text" class="form-control w-75"
                                            name="sellingPrice" placeholder="{{trans('Forms.sellingPrice')}}">
                                        
                                    </div>
                                </div>
                                <!-- Size -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('Forms.size')}}</label>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <input id="sizeFrom" type="text" class="form-control"
                                                name="sizeFrom" placeholder="{{trans('Forms.sizeFrom')}}">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input id="sizeTo" type="text" class="form-control"
                                                name="sizeTo" placeholder="{{trans('Forms.sizeTo')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-horizontal">
                                <label class="control-label pt-2 pb-2 col-12">Upload Image</label>
                                <div id="demo"></div>
                                <label class="control-label"></label>
                            </div>
                            <div class="pt-2">
                                <button class="save-btn upload-file" type="button">Upload Img</button>
                            </div>
                        </div>
                        <div class="col-lg-12 order-3">
                            <div class="row btns">
                                <button class="btn save-btn mt-4" type="submit"><i class="fa fa-save"></i>
                                    {{trans('Forms.save')}}</button>
                                <button type="reset" class="exit-btn reset-btn btn mt-4"><i
                                        class="fa fa-times-circle"></i> {{trans('Forms.save')}}</button>
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
            <h1 class="widget-title mb-0">{{trans('product.allProduct')}}</h1>
            <div class="widget-content table mt-5">
                <form class="general-search" id="search-form">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-5">
                            <div class="form-group">
                                <label for="filter">{{trans('glopal.Search')}}</label>
                                <input type="search" name="input" class="form-control" id="filter"
                                    placeholder="Type to search...">
                            </div>

                        </div>

                        <div class="col-7 col-sm-3 col-lg-4">
                            <div class="form-group">
                                <label for="departments">{{trans('glopal.FilterBy')}}</label>
                                <select id="option" name="option" class="form-control">
                                    <option class="form-control" value="name">{{trans('Forms.name')}}</option>
                                    <option class="form-control" value="Phone">{{trans('Forms.barcode')}}</option>
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
                                    <th><span>{{trans('Forms.barcode')}}</span></th>
                                    <th><span>{{trans('Forms.name')}}</span></th>
                                    <th><span>{{trans('Forms.material')}}</span></th>
                                    <th><span>{{trans('Forms.style')}}</span></th>
                                    {{-- <th><span>Size</span></th> --}}
                                    {{-- <th><span>Colors</span></th> --}}
                                    {{-- <th><span>Price</span></th> --}}
                                    {{-- <th><span>Quantity</span></th> --}}
                                    {{-- <th><span>Status</span></th> --}}
                                    <th><span>Action</span></th>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                @push('js')
                <!-- Pagination -->
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
                            url: '{{ route('product.data') }}',
                            data: function (d) {
                                d.input = $('input[name=input]').val();
                                d.option = $('#option').val();
                            }
                        },
                        columns: [
                            {data: 'id' , data: null , render:  (data, type, row, meta) => meta.row + 1 * oTable.page.info().page * oTable.page.info().length + 1 },
                            {data: 'parcode_pre_all', name: 'parcode_pre_all'},
                            {data: 'name', name: 'name'},
                            {data: 'material', name: 'material'},
                            {data: 'style', name: 'style'},
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
                                .attr('data-label', '{{trans('Forms.barcode')}}');
                            $( row ).find('td:eq(2)')
                                .attr('data-label', '{{trans('Forms.name')}}');
                            $( row ).find('td:eq(3)')
                                .attr('data-label', '{{trans('Forms.material')}}');
                            $( row ).find('td:eq(4)')
                                .attr('data-label', '{{trans('Forms.style')}}');
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

        </div>
    </section>
</div>

    <!-- Modal -->
    <div class="modal fade" id="allColors" tabindex="-1" role="dialog" aria-labelledby="allColors"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allColors">Choose a color:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body color-model-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn general-btn select-color" disabled>Select</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<!-- Color picker script -->
<script src="{{ asset('assist/scripts/colorPaltte.js') }}"></script>
<!-- select multiple images -->
<script src="{{ asset('assist/scripts/vendor/spartan-multi-image-picker.js') }}"></script>
<!-- Products functionalities -->
<script src="{{ asset('assist/scripts/modules/ware-house/products/products.js') }}"></script>
<!-- End Custem Pages Script -->

<script>

function readURL(input,num) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        console.log(num);

        reader.onload = function(e) {
            $('#blah-'+num).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
    
$(".imgInp").change(function() {
    var num =$(this).attr('num');
    readURL(this,num);
});

$(document).on('click','.box-image label span',function(){
    // console.log($(this).attr('num'));
    var num = $(this).attr('num');
    var route   = $(this).data('route');
    console.log(route);
    var token   = $(this).data('token');
    $('#blah-'+num).attr('src', "https://screenshotlayer.com/images/assets/placeholder.png");
    $('#imgInp-'+num).val(''); 
});
       
</script>
@endsection



@section('styles')

<style>

.wrapper-all-images {
    display: flex;
    flex-wrap: wrap;
    border: 4px solid #ddd;
    padding: 15px;
}
.wrapper-all-images .box-image {
    flex: 25%;
    max-width: 25%;
    padding: 10px;
}

.wrapper-all-images .box-image label{
    position: relative;
}

.wrapper-all-images .box-image label span{
    position: absolute;
    right: 10px;
    font-size: 20px;
    color: #fff;
    background-color: rgba(0, 0, 0, .3);
    padding: 2px;
    cursor: pointer;
}

@media (max-width: 992px) {
    .wrapper-all-images .box-image {
        flex: 50%;
        max-width: 50%;
        height: 150px;
    }
}



</style>
@endsection