@extends('layouts.app')

@section('content')

<!-- Start Accounts Page -->
<section class="widget shipping-company">
    <div class="container-fluid">
        <h1 class="widget-title">{{trans('pages.shippingCompany')}}</h1>
        <form class="general-form">
            <!-- account name -->
            <div class="form-group">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-1">
                                <label>{{trans('Forms.accountName')}}</label>
                            </div>
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-1">
                                        <button type="button" class="general-btn btn-Add-Account-Info0">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-11">
                                        <div class="row no-gutters">
                                            <div class="col-4">
                                                <input type="text" name="name[]" id="name1" class="form-control" aria-describedby="name" placeholder="">
                                            </div>
                                            <div class="col-12">
                                                <div class="add-Account-Info1">
                                                    <div class="row no-gutters">
                                                        <div class="col-1 pt-2 pb-2">
                                                            <button type="button" class="general-btn btn-Add-Account-Info1">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- Start Function Here -->
                                                        <div class="col-11 pt-2 pb-2">
                                                            <div class="add-content1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-11 pt-4 pb-4">
                                        <div class="content0">

                                        </div>
                                    </div>


                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirm buttons of page -->
            <div class="col-12">
                <div class="row btns">
                    <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>{{trans('Forms.save')}}</button>
                    <button type="reset" class="reset-btn btn mt-4"><i class="fa fa-times-circle"></i>{{trans('Forms.reset')}}</button>
                </div>
            </div>
        </form>
    </div>
</section>
    <!-- End Accounts Page -->

<!-- End user wedget -->



@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/modules/Accounting/shipping-company.js')}}"></script>

@endsection
