@extends('layouts.app')

@section('content')
<div class="all-sections-supplier">
    <section class="widget add-supplier">
        <div class="container-fluid">
            <h1 class="widget-title mb-0">ADD A SUPPLIER</h1>
            <div class="widget-content mt-5">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <form  method="POST" action="{{ route('suppler.store') }}"  class="general-form form-create">
                        @csrf
                            <div class="row">
                                <!-- Supplier name form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control w-100" aria-describedby="name"
                                            placeholder="Supplier Name">
                                    </div>
                                </div>

                                <!-- Supplier Phone Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">Phone</label>
                                        <input type="text" name="mobile[]" id="phone"
                                            class="form-control supplier-phone" aria-describedby="phone"
                                            placeholder="Suppliers phone">
                                        <span class="general-btn add-supplier-phone"><i
                                                class="fas fa-plus"></i></span>
                                        <div class="add-supplier-phone-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier Email Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">Email</label>
                                        <input type="email" name="email[]" id="email"
                                            class="form-control supplier-email" aria-describedby="email"
                                            placeholder="Suppliers email">
                                        <span class="general-btn add-supplier-email"><i
                                                class="fas fa-plus"></i></span>
                                        <div class="add-supplier-email-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier address Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">Address</label>

                                        <textarea name="address[]" id="address" class="form-control supplier-address" aria-describedby="address"
                                        placeholder="Suppliers address"></textarea>
                                        <span class="general-btn add-supplier-address"><i class="fas fa-plus"></i></span>
                                        <div class="add-supplier-address-info">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row btns">
                                        <button type="submit" class="btn mt-4"><i
                                                class="fa fa-save"></i> Save</button>
                                        <button type="reset" class="exit-btn btn mt-4"><i
                                                class="fa fa-times-circle"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <form enctype="multipart/form-data"  method="POST" action=""  class="user general-form form-edit d-none">
                            @method('PUT')
                            @csrf
                                <div class="row">
                                <!-- Supplier name form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name_edit"
                                            class="form-control w-100" aria-describedby="name"
                                            placeholder="Supplier Name">
                                    </div>
                                </div>

                                <!-- Supplier Phone Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">Phone</label>
                                        <input type="text" name="mobile[]" id="phone_edit"
                                            class="form-control supplier-phone" aria-describedby="phone"
                                            placeholder="Suppliers phone">
                                        <span class="general-btn add-supplier-phone"><i
                                                class="fas fa-plus"></i></span>
                                        <div class="add-supplier-phone-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier Email Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">Email</label>
                                        <input type="email" name="email[]" id="email_edit"
                                            class="form-control supplier-email" aria-describedby="email"
                                            placeholder="Suppliers email">
                                        <span class="general-btn add-supplier-email"><i
                                                class="fas fa-plus"></i></span>
                                        <div class="add-supplier-email-info">

                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier address Form group -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="d-block" for="phone">Address</label>

                                        <textarea name="address[]" id="address_edit" class="form-control supplier-address" aria-describedby="address"
                                        placeholder="Suppliers address"></textarea>
                                        <span class="general-btn add-supplier-address"><i class="fas fa-plus"></i></span>
                                        <div class="add-supplier-address-info">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row btns">
                                        <button type="submit" class="btn mt-4"><i
                                                class="fa fa-save"></i> Save</button>
                                        <button type="reset" class="exit-btn btn mt-4"><i
                                                class="fa fa-times-circle"></i> Reset</button>
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
            <h1 class="widget-title mb-0">All Suppliers</h1>

            <div class="widget-content mt-5">
                <form class="general-form">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-5">
                            <div class="form-group">
                                <label for="username">Search</label>
                                <input type="search" class="form-control" id="filter"
                                    placeholder="Type to search...">
                            </div>

                        </div>

                        <div class="col-7 col-sm-3 col-lg-4">
                            <div class="form-group">
                                <label for="departments">Filter By</label>
                                <select id="filter" class="form-control">
                                    <option class="form-control">Name</option>
                                    <option class="form-control">Phone</option>
                                    <option class="form-control">Username</option>
                                    <option class="form-control">Department</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5 col-sm-3 col-lg-3">
                            <button type="button" id="search_btn" class="general-btn search_btn"><i
                                    class="fas fa-search"></i> Search</button>
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
                                    <th><span>Name</span></th>
                                    <th><span>Phone</span></th>
                                    <th><span>Email</span></th>
                                    <th><span>Address</span></th>
                                    <th><span>Products</span></th>
                                    <th><span>Action</span></th>
                                </div>
                            </tr>
                        </thead>

                                                <tbody>
                                <?php 
                                if($Supplers->currentPage() == 1){
    
                                    $num = 1  ; 
                                }else{
                                    $num = 10 * $Supplers->currentPage() +1 ; 
                                }
                            ?>
                            @forelse ($Supplers as $Suppler)
                                <tr class="row-edit ">
                                    <td data-label="No"><span>{{$num}}</span></td>
                                    <td data-label="Name"><span>{{$Suppler->name}}</span></td>
                                    <td data-label="Phone">
                                    @foreach ($Suppler->Mobiles as $Mobile)
                                        <span>{{$Mobile->mobile}}</span>,
                                    @endforeach
                                    </td>
                                    <td data-label="Email">
                                    @foreach ($Suppler->Emails as $Email)
                                        <span>{{$Email->email}}</span>,
                                    @endforeach
                                    </td>
                                    <td data-label="Address">
                                    @foreach ($Suppler->Address as $Address)
                                        <span>{{$Address->address}}</span>,
                                    @endforeach
                                    </td>
                                    <td data-label="Products">
                                        <span><i class="fas fa-box-open"></i></span>
                                    </td>
                                    <td data-label="Action">
                                        <button  type="button" edit-url="{{ route('suppler.edit',$Suppler->name) }}" data-toggle="modal"
                                                data-target=".bd-example-modal-sm" class="mr-2 edit btn edit-Btn">
                                            <span><i class="fas fa-edit fa-fw"></i></span>
                                        </button>
                                        <button type="button"  class="btn delBtns delet" del-url="{{ url('') }}/suppler/{{$Suppler->name}}">
                                                <span><i class="fas fa-times fa-fw"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <?php $num++ ?>
                            @empty
                                <tr class="row-edit ">
                                    <td colspan="7">No record</td>
                                </tr>
                            @endforelse
    
                        </tbody>
                 
                    </table>
                </div>

                <!-- Pagination -->
                @if ($Supplers->lastPage() > 1)

                <div class="mt-3 pagination d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        
                            <li class="page-item">
                                <a class="page-link" href="?page={{$Supplers->onFirstPage() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            {{ $Supplers->links() }}
                        
                            <li class="page-item">
                            <a class="page-link" href="?page={{$Supplers->lastPage() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li> 
                        </ul>
                    </nav>
                </div>
                @endif

            </div>

        </div>
    </section>

</div>

@endsection

@section('scripts')
<script src="{{ asset('assist/scripts/modules/suppliers/suppliers/suppliers.js')}}"></script>

@endsection
