@extends('layouts.app')

@section('content')

            <!-- Start Accounts Page -->
            <section class="widget accounts-pages">
                <div class="container-fluid">
                    <h1 class="widget-title">{{trans('pages.revenueCustomerOrders')}}</h1>
                    <div class="general-table">
                        <table id="generalTable" class="text-center table-edit table">
                            <thead>
                                <tr class="row-edit">
                                    <th class="white-space-nowrap" width="7%"><span>رقم الطلب</span></th>
                                    <th class="white-space-nowrap" width="10%"><span>تاريخ الطلب</span></th>
                                    <th class="white-space-nowrap" width="20%"><span>إسم العميل</span></th>
                                    <th class="white-space-nowrap" width="15%"><span>رقم التليفون</span></th>
                                    <th class="white-space-nowrap" width="5%"><span>عدد القطع</span></th>
                                    <th class="white-space-nowrap" width="8%">سعر القطع</th>
                                    <th class="white-space-nowrap" width="8%">سعر التوصيل</th>
                                    <th class="white-space-nowrap" width="8%">اجمالي السعر</th>
                                    <th width="10%"><span>الإتزان</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row-edit ">
                                    <td data-label="1">56875</td>
                                    <td data-label="تاريخ الطلب">25/12/2019</td>
                                    <td data-label="اسم العميل">يوسف رأفت محمد ممدوح</td>
                                    <td data-label="رقم التليفون">0020115687654</td>
                                    <td data-label="عدد القطع">2</td>
                                    <td data-label="سعر القطع">500</td>
                                    <td data-label="سعر التوصيل">500</td>
                                    <td data-label="اجمالي السعر">500</td>
                                    <td data-label="الإتزان">
                                        <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="edit btn">
                                            تسويه
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Start Modal Of Page -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="container-fluid">


                                <form class="general-form" action="{{route('revenue_customer.store')}}" method="post">
                                    <div class="row">
                                        <!-- date -->
                                        @csrf
                                        <div class="col-12 col-md-6 col-xl-4">

                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12 col-md-3">
                                                        <label class="match-height" for="date">تاريخ العملة</label>
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
                                                <div class="row no-gutters">
                                                    <div class="col-12 col-md-3">

                                                        <label class="match-height" for="operation__number">رقم العملية</label>
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
                                                <div class="row no-gutters">
                                                    <div class="col-12 col-md-3">
                                                        <label class="match-height" for="currency__type">نوع العمله</label>

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

                                        <!-- Client Name -->
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12 col-md-3">

                                                        <label class="match-height" for="client__name">{{trans('Forms.clientName')}}</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" name="client__name" id="client__name" class="form-control"
                                                            aria-describedby="client__name" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Order Number -->
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12 col-md-3">

                                                        <label class="match-height" for="order__number">{{trans('Forms.orderNumber')}}</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" name="order__number" id="order__number" class="form-control"
                                                            aria-describedby="order__number" placeholder="">

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
                                                            <input type="radio" name="process" id="checks">
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
                                                                    <label class="match-height" for="amount__numbers">المبلغ بالارقام</label>
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
                                                                    <label class="match-height" for="amount__char">المبلغ بالحروف</label>
                                                                </div>
                                                                <div class="col-12 col-md-9">
                                                                    <input type="text" name="amount_char" id="amount__char" class="form-control"
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
                                                                    <label class="match-height" for="due__date">تاريخ الاستحقاق</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <input type="text" name="due_date" id="due__date" class="datepicker text-center form-control"
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
                                                                    <label class="match-height" for="charage__bank">البنك المنوط</label>
                                                                </div>
                                                                <div class="col-12 col-md-9">
                                                                    <input type="text" name="charage_bank" id="charage__bank" class="form-control"
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
                                                                    <label class="match-height" for="checks__number">رقم الشيك</label>
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
                                                            <div class="row no-gutters">
                                                                <div class="col-12 col-md-3">
                                                                    <label class="match-height" for="amount__numbers">المبلغ بالارقام</label>
                                                                </div>
                                                                <div class="col-12 col-md-9">
                                                                    <input type="text" name="amount_numbers" id="amount__numbers" class="form-control"
                                                                        aria-describedby="amount__numbers" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-xl-8">
                                                        <div class="form-group">
                                                            <div class="row no-gutters">
                                                                <div class="col-12 col-md-3">
                                                                    <label class="match-height" for="amount__char">المبلغ بالحروف</label>
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
                                                                <div class="col-12 col-md-3 col-lg-2">
                                                                    <label class="match-height" for="checks-file">صورة الشيك</label>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <input type="text" name="checks-file" id="checks-file-text" class="form-control"
                                                                    aria-describedby="checks-file" placeholder="">
                                                                    <input type="file" name="checks-file" id="checks-file" class="form-control"
                                                                    aria-describedby="checks-file" placeholder="">
                                                                </div>
                                                                <div class="col-12 col-md-3">
                                                                    <button type="button" id="checks-file-btn" class="mt-3 mt-md-auto general-btn">رفع ملف</button>
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
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Accounts Page -->

        @endsection

                @section('scripts')

                <script src="{{ asset('assets/scripts/vendor/jquery-ui.js')}}"></script>
                <script src="{{ asset('assets/scripts/modules/Accounting/accounts.js')}}"></script>

                @endsection
