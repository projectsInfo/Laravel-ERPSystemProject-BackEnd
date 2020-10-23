@extends('layouts.app')

@section('content')

<section id="tableSection" class="widget americanJournal">
    <div class="container-fluid">
        <h1 class="widget-title">{{trans('pages.americanJournal')}}</h1>
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
                            <option class="form-control">التاريخ</option>
                            <option class="form-control">نوع الحركة</option>
                            <option class="form-control">رقم القيد</option>
                            <option class="form-control">الحساب مدين</option>
                            <option class="form-control">الحساب دائن</option>
                            <option class="form-control">الإتزان</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <button type="submit" id="search_btn" class="general-btn search_btn"><i
                                class="fas fa-search"></i> {{trans('glopal.Search')}}</button>
                    </div>
                </div>
            </form>

            <div class="general-table">
                <table id="generalTable" class="text-center table-edit table">
                    <thead>
                        <tr class="row-edit">
                            <th class="white-space-nowrap" width="2%"><span>م</span></th>
                            <th class="white-space-nowrap" width="10%"><span>التاريخ</span></th>
                            <th class="white-space-nowrap" width="10%"><span>نوع الحركة</span></th>
                            <th class="white-space-nowrap" width="7%"><span>رقم القيد</span></th>
                            <th class="white-space-nowrap" width="5%"><span>البيان</span></th>
                            <th colspan="2" width="20%" class="td-americanJournal p-0">
                                <div class="w-75 m-auto">الحساب</div>
                                <span class="d-inline-block w-48">مدين</span> <span class="d-inline-block w-48">دائن</span>
                            </th>
                            <th colspan="2" width="20%" class="td-americanJournal p-0">
                                <div class="w-75 m-auto">المبلغ</div>
                                <span class="d-inline-block w-48">مدين</span> <span class="d-inline-block w-48">دائن</span>
                            </th>
                            <th width="10%"><span>الإتزان</span></th>
                            <th colspan="2" width="20%" class="td-americanJournal p-0">
                                <div class="w-75 m-auto">المبلغ</div>
                                <span class="d-inline-block w-48">مدين</span> <span class="d-inline-block w-48">دائن</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-edit ">
                            <td data-label="1">1</td>
                            <td data-label="تاريخ الطلب">25/12/2019</td>
                            <td data-label="نوع الحركة">وارد</td>
                            <td data-label="البيان">2</td>
                            <td data-label="البيان">2</td>
                            <td data-label="البيان">5</td>
                            <td data-label="البيان">5</td>
                            <td data-label="البيان">2</td>
                            <td data-label="البيان">2</td>
                            <td data-label="البيان">2</td>
                            <td data-label="البيان">2</td>
                            <td data-label="البيان">2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
<!-- <script src="{{ asset('assets/scripts/modules/Accounting/shipping-company.js')}}"></script> -->

@endsection