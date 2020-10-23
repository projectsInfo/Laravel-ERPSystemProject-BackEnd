@extends('layouts.app')

@section('content')

    <!-- Top Bar -->

    <!-- Start Accounts Page -->
    <section class="widget accounts-pages">
        <div class="container-fluid">
            <h1 class="widget-title">{{trans('pages.expensesBill')}}</h1>
            <form class="general-form" method="post" action="{{route("expenses_bill.store")}}">
                @csrf
                <div class="row">
                    <!-- date -->
                    <div class="col-12 col-md-6 col-xl-4">

                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">
                                    <label for="date">{{trans('Forms.operateDate')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="operation_date" id="date" class="text-center form-control" aria-describedby="date" placeholder="2019-11-24" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- operation-number -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-3">

                                    <label for="operation__number">{{trans('Forms.operateNumber')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="operation_number" id="operation__number" class="form-control"
                                           aria-describedby="operation__number" placeholder="">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- currency type -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label for="currency__type">{{trans('Forms.operateType')}}</label>

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

                    <!-- account number -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">

                                    <label class="match-height" for="account_number">{{trans('Forms.accountNumber')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="account_number" id="account_number" class="form-control"
                                           aria-describedby="account_number" placeholder="">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- account Name -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-3">

                                    <label class="match-height" for="account_name">{{trans('Forms.accountName')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="account_name" id="account_name" class="form-control"
                                           aria-describedby="account_name" placeholder="">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Start Data section -->
                    <div class="col-12 mt-3 mb-2">
                        <button class="btn general-btn show-data-table" type="button" data-toggle="collapse" data-target="#table-date" aria-expanded="false" aria-controls="table-date">{{trans('Forms.data')}} <span class="pr-2 pl-2"><i class="fas fa-angle-down"></i></span></button>
                        <div class="collapse" id="table-date">
                            <div class="general-table all-barcode-table table-responsive-md">
                                <table id="generalTable" class="text-center table-edit table">
                                    <thead>
                                    <tr class="row-edit">
                                        <th width="5%">م</th>
                                        <th width="15%">الصنف</th>
                                        <th width="8%">العدد</th>
                                        <th width="13%">سعر الوحدة</th>
                                        <th width="13%">الإجمالي</th>
                                        <th width="30%">الوصف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="row-edit ">
                                        <td>1</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>

                                    </tr>
                                    <tr class="row-edit ">
                                        <td>2</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="income-file" id="income-file-text" class="form-control"
                                                       aria-describedby="income-file" placeholder="">
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Choose a process -->
                    <div class="col-12">
                        <div class="choose-process">
                            <div class="form-group">
                                <div class="row no-gutters">
                                    <div class="col-3 col-md-2">
                                        <label for="monetary">نقدي</label>
                                        <input type="radio" name="cash" id="monetary">
                                    </div>
                                    <div class="col-3">
                                        <label for="checks">شيكات</label>
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
                                                <label for="amount__numbers">{{trans('Forms.amountNumber')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_numbers" id="amount__numbers" class="form-control"
                                                       aria-describedby="amount__numbers" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="amount_char">{{trans('Forms.amountChar')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount__char" id="amount__char" class="form-control"
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
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="due__date">{{trans('Forms.dueDate')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="due_date" id="due__date" class="datepicker text-center form-control"
                                                       aria-describedby="due__date" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- charage bank -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height" for="charage__bank">{{trans('Forms.charageBank')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="charage__bank" id="charage__bank" class="form-control"
                                                       aria-describedby="charage__bank" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- checks number -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label class="match-height" for="checks__number">{{trans('Forms.checkNumber')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="checks_number" id="checks__number" class="form-control"
                                                       aria-describedby="checks__number" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="amount__numbers">{{trans('Forms.amountNumber')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_numbers2" id="amount__numbers" class="form-control"
                                                       aria-describedby="amount__numbers" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-8">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="amount__char">{{trans('Forms.amountChar')}}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="amount_char" id="amount__char" class="form-control"
                                                       aria-describedby="amount__char" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- checks pic -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-3">
                                                <label for="checks-file">{{trans('Forms.checkimg')}}</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="checks-file" id="checks-file-text" class="form-control"
                                                       aria-describedby="checks-file" placeholder="">
                                                <input type="file" name="checks-file" id="checks-file" class="form-control"
                                                       aria-describedby="checks-file" placeholder="">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <button type="button" id="checks-file-btn" class="mt-3 mt-md-auto general-btn">{{trans('Forms.UploadFile')}}</button>
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
                                حفظ</button>
                            <button type="reset" class="reset-btn btn mt-4"><i
                                    class="fa fa-times-circle"></i> إستعادة</button>
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
