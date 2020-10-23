@extends('layouts.app')

@section('content')

    <!-- Start Accounts Page -->
    <section class="widget accounts-pages">
        <div class="container-fluid">
            <h1 class="widget-title">{{trans('pages.revenueShippingCompany')}}</h1>
            <form class="general-form" action="{{route('revenue_shipping.store')}}" method="post">
                @csrf
                <div class="row">
                    <!-- date -->
                    <div class="col-12 col-md-6 col-xl-4">

                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">
                                    <label class="match-height" for="date">{{trans('Forms.operateDate')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="operation_date" id="date" class="text-center form-control"
                                           aria-describedby="date" placeholder="2019-11-24" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- operation-number -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">

                                    <label class="match-height"
                                           for="operation_number">{{trans('Forms.operateNumber')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="operation_number" id="operation__number"
                                           class="form-control"
                                           aria-describedby="operation__number" placeholder="">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- currency type -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">
                                    <label class="match-height"
                                           for="currency__type">{{trans('Forms.operateType')}}</label>

                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="currency_type" id="filter" class="form-control">
                                        <option value="1" class="form-control">جنية</option>
                                        <option value="2" class="form-control">دولار</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- company name -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">

                                    <label class="match-height"
                                           for="compane__name">{{trans('Forms.companyName')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="compane_name" id="filter" class="form-control">
                                        <option value="" class="form-control">اختر الشركة</option>
                                        <option value="1" class="form-control">فهيم</option>
                                        <option value="2" class="form-control">مشهور</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- income file -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">
                                    <label class="match-height" for="income-file">{{trans('Forms.ExportFile')}}</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="income-file" id="income-file-text" class="form-control"
                                           aria-describedby="income-file" placeholder="">
                                    <input type="file" name="income-file" id="income-file" class="form-control"
                                           aria-describedby="income-file" placeholder="">

                                </div>
                                <div class="col-12 col-md-3">
                                    <button type="button" id="income-file-btn"
                                            class="mt-3 mt-md-auto general-btn">{{trans('Forms.UploadFile')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Choose a process -->
                    <div class="col-12">
                        <div class="choose-process">
                            <div class="form-group mb-0">
                                <div class="row no-gutters">
                                    <div class="col-3 col-md-2">
                                        <label class="match-height" for="monetary">نقدي</label>
                                        <input type="radio" name="cash" id="monetary">
                                    </div>
                                    <div class="col-3">
                                        <label class="match-height" for="checks">شيكات</label>
                                        <input type="radio" name="checks" id="checks">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Monetary content -->
                    <div class="col-12">
                        <div class="monetary-content">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height"
                                                       for="amount__numbers">{{trans('Forms.amountNumber')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_numbers" id="amount__numbers"
                                                       class="form-control"
                                                       aria-describedby="amount__numbers" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height"
                                                       for="amount__char">{{trans('Forms.amountChar')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_char" id="amount__char"
                                                       class="form-control"
                                                       aria-describedby="amount__char" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- checks content -->
                    <div class="col-12">
                        <div class="checks-content">
                            <div class="row">
                                <!-- date -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-4">
                                                <label class="match-height"
                                                       for="due__date">{{trans('Forms.dueDate')}}</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" name="due_date" id="due__date"
                                                       class="datepicker text-center form-control"
                                                       aria-describedby="due__date" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- charage bank -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height"
                                                       for="charage__bank">{{trans('Forms.charageBank')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="charage_bank" id="charage__bank"
                                                       class="form-control"
                                                       aria-describedby="charage__bank" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- checks number -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height"
                                                       for="checks__number">{{trans('Forms.checkNumber')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="checks_number" id="checks__number"
                                                       class="form-control"
                                                       aria-describedby="checks__number" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height"
                                                       for="amount__numbers">{{trans('Forms.amountNumber')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_numbers" id="amount__numbers"
                                                       class="form-control"
                                                       aria-describedby="amount__numbers" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-8">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height"
                                                       for="amount__char">{{trans('Forms.amountChar')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_char" id="amount__char"
                                                       class="form-control"
                                                       aria-describedby="amount__char" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- checks pic -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-3 col-lg-2">
                                                <label class="match-height"
                                                       for="checks-file">{{trans('Forms.checkImg')}}</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="checks-file" id="checks-file-text"
                                                       class="form-control"
                                                       aria-describedby="checks-file" placeholder="">
                                                <input type="file" name="checks-file" id="checks-file"
                                                       class="form-control"
                                                       aria-describedby="checks-file" placeholder="">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <button type="button" id="checks-file-btn"
                                                        class="mt-3 mt-md-auto general-btn">{{trans('Forms.UploadFile')}}</button>
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
                            <button type="submit" class="btn save-btn mt-4"><i class="fa fa-save"></i>
                                {{trans('Forms.save')}}</button>
                            <button type="reset" class="reset-btn btn mt-4"><i
                                    class="fa fa-times-circle"></i> {{trans('Forms.reset')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Accounts Page -->


@endsection



@section('scripts')

    <script src="{{ asset('assets/scripts/vendor/jquery-ui.js')}}"></script>
    <script src="{{ asset('assets/scripts/modules/Accounting/accounts.js')}}"></script>

@endsection
