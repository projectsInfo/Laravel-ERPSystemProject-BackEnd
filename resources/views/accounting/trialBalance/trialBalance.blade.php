@extends('layouts.app')

@section('content')

    <section class="widget trialBalance">
        <div class="container-fluid">
            <h1 class="widget-title">{{trans('pages.trialBalance')}}</h1>
            <form class="general-search" id="search-form">
                <div class="row no-gutters">
                    <div class="col-12 col-md-1">
                        <label class="match-height" for="due__date">{{trans('Forms.duration')}}</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" name="due_date" id="due__date" class="datepicker text-center form-control"
                            aria-describedby="due__date" placeholder="">
                    </div>
                </div>
            </form>
            <div class="general-table">
                <table id="generalTable" class="text-center table-edit table">
                    <thead>
                        <tr class="row-edit">
                            <th class="white-space-nowrap" width="2%"><span>م</span></th>
                            <th class="white-space-nowrap" width="10%"><span>كود الحساب</span></th>
                            <th class="white-space-nowrap" width="10%"><span>اسم الحساب</span></th>
                            <th colspan="2" width="20%" class="td-trial-balance p-0">
                                <div class="w-75 m-auto">رصيد أول المده</div>
                                <span class="d-inline-block w-48">مدين</span> <span class="d-inline-block w-48">دائن</span>
                            </th>
                            <th colspan="2" width="20%" class="td-trial-balance p-0">
                                <div class="w-75 m-auto">الحركة</div>
                                <span class="d-inline-block w-48">مدين</span> <span class="d-inline-block w-48">دائن</span>
                            </th>
                            <th colspan="2" width="20%" class="td-trial-balance p-0">
                                <div class="w-75 m-auto">الرصيد</div>
                                <span class="d-inline-block w-48">مدين</span> <span class="d-inline-block w-48">دائن</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-edit ">
                            <td data-label="1">1</td>
                            <td data-label="كود الحساب">2685d4</td>
                            <td data-label="اسم الحساب">محمد مشهور محمد</td>
                            <td data-label="رصيد اول المده">200</td>
                            <td data-label="رصيد اول المده">250</td>
                            <td data-label="المدة">2</td>
                            <td data-label="المدة">2</td>
                            <td data-label="الرصيد">200</td>
                            <td data-label="الرصيد">250</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->

                <div class="mt-4 pagination d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&lsaquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="PaginationActive page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                            <li class="page-item"><a class="page-link" href="#">8</a></li>
                            <li class="page-item"><a class="page-link" href="#">9</a></li>
                            <li class="page-item"><a class="page-link" href="#">10</a></li>
                            <li class="page-item"><a class="page-link" href="#">11</a></li>
                            <li class="page-item"><a class="page-link" href="#">12</a></li>
                            <li class="page-item"><a class="page-link" href="#">13</a></li>
                            <li class="page-item"><a class="page-link" href="#">14</a></li>
                            <li class="page-item"><a class="page-link" href="#">15</a></li>
                            <li class="page-item"><a class="page-link" href="#">16</a></li>
                            <li class="page-item"><a class="page-link" href="#">14</a></li>
                            <li class="page-item"><a class="page-link" href="#">18</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&rsaquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row btns">
                <button class="general-btn btn excelfile-btn" type="button">استخراج ملف إكسيل <i class="fas fa-fw fa-file-excel"></i></button>
                <button class="general-btn btn print-btn" type="button">طباعة <i class="fas fa-fw fa-print"></i></button> 
            </div>
        </div>
        
    </section>

@endsection

@section('scripts')

    <script src="{{ asset('assets/scripts/vendor/jquery-ui.js')}}"></script>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/vendor/jquery-ui.min.css') }}">

@endsection