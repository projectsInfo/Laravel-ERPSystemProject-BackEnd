   @php $User_warehouse = Auth::user()->Warehouse; @endphp
                   <ul class="list-unstyled nice">
                    <!-- 1 Home Dashboard -->
                    <li>
                        <a class="sidebar-link  dashboard collapsed {{active_link('',false)}}" href=" {{ route('home') }}">
                            <div>
                            <i class="fa fa-home fa-w-20"></i> <span class="link-text">{{trans('sideBar.dashboard')}}</span>
                            </div>
                        </a>
                    </li>
                    <!-- 2 HR Menu : New Clients - All Clients -->
                    <li>
                        <a class="sidebar-link  {{active_links(['manage_users','department'])}}" href="#hrSubMenu" role="button" id="sidebarLink" data-toggle="collapse" aria-haspopup="true"
                            aria-expanded="false">
                            <div>
                                <i class="fa fa-users"></i> <span class="link-text">{{trans('sideBar.hr')}}</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="hrSubMenu" class="collapse list-unstyled link-submenu {{show_ul(['manage_users','department'])}}" aria-labelledby="sidebarLink">
                            <li>
                                <a class="submenu-link {{active_link('manage_users')}}" href="{{ route('manage_users.index') }}">{{trans('sideBar.manageUser')}}</a>
                            </li>
                            <li>
                                <a class="submenu-link {{active_link('department')}}" href="{{ route('department.index') }}">{{trans('sideBar.department')}}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- 3 CRM Menu : New Clients - All Clients -->
                    <li>
                        <a class="sidebar-link collapsed {{active_links(['client'])}}" href="#crmSubMenu" role="button" id="sidebarLink" data-toggle="collapse" aria-haspopup="true"
                            aria-expanded="false">
                            <div>
                                <i class="fas fa-chart-pie"></i> <span class="link-text">{{trans('sideBar.crm')}}</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="crmSubMenu" class="collapse list-unstyled link-submenu {{show_ul(['client'])}}" aria-labelledby="sidebarLink">
                            <li>
                                <a class="submenu-link" href="{{ route('client.create') }}">{{trans('sideBar.newClient')}}</a>
                            </li>
                            <li>
                                <a class="submenu-link {{active_link('client')}}" href="{{ route('client.index') }}">{{trans('sideBar.allClients')}}</a>
                            </li>
                        </ul>
                    </li>



                    <!-- 4 Orders Menu : New Orders - All Orders -->
                    <li>
                        <a class="sidebar-link collapsed {{active_links(['clientorder','supplerorder'])}}" href="#ordersSubMenu" role="button" id="sidebarLink" data-toggle="collapse" aria-haspopup="true"
                            aria-expanded="false">
                            <div>
                                <i class="fa fa-list-alt"></i> <span class="link-text">{{trans('sideBar.orders')}}</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>
                        <ul id="ordersSubMenu" class="collapse list-unstyled link-submenu {{show_ul(['clientorder','supplerorder'])}}" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="{{ route('clientorder.create') }}">{{trans('sideBar.newOrder')}}</a></li>
                            <li><a class="submenu-link {{active_link('clientorder')}}" href="{{ route('clientorder.index') }}">{{trans('sideBar.allOrders')}}</a></li>
                            <li><a class="submenu-link {{active_link('supplerorder')}}" href="{{ route('supplerorder.index') }}">{{trans('sideBar.supplierOrder')}}</a></li>
                        </ul>
                    </li>


                    <!-- 4 Orders Menu : New Orders - All Orders -->
                    @foreach ($User_warehouse as $warehouse_user)
                        <li>
                            <a class="sidebar-link collapsed" href="#warehouse_user{{$warehouse_user->id}}" role="button" id="sidebarLink" data-toggle="collapse" aria-haspopup="true"
                                aria-expanded="false">
                                <div>
                                    <i class="fa fa-list-alt"></i> <span class="link-text">{{ $warehouse_user->name}}</span>
                                </div>
                                <i class="angle-icon fa fa-angle-down"></i>
                            </a>
                            <ul id="warehouse_user{{$warehouse_user->id}}" class="collapse list-unstyled link-submenu" aria-labelledby="sidebarLink">
                                <li><a class="submenu-link" href="{{ route('clientorder.index') }}?warehouse={{$warehouse_user->id}}">{{trans('sideBar.clientOrder')}}</a></li>
                                <li><a class="submenu-link" href="{{ route('supplerorder.index') }}?warehouse={{$warehouse_user->id}}">{{trans('sideBar.supplierOrder')}}</a></li>
                                <li><a class="submenu-link" href="{{ route('warehouse.index') }}/{{$warehouse_user->name}}">{{trans('sideBar.inventory')}}</a></li>
                            </ul>
                        </li>
                    @endforeach

                    <!-- 5 Outsourcing Menu : Suppliers - Delivery Company -->
                    <li>

                        <a class="sidebar-link collapsed {{active_links(['suppler' , 'delivarycompany','delivaryprice','governorate','city'])}}" href="#outsourcingSubMenu" role="button" id="sidebarLink" data-toggle="collapse" aria-haspopup="true"
                            aria-expanded="false">
                            <div>
                                <i class="far fa-handshake "></i> <span class="link-text">{{trans('sideBar.outsourcing')}}</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="outsourcingSubMenu" class="collapse list-unstyled link-submenu {{show_ul(['suppler','delivarycompany','delivaryprice','governorate','city'])}}" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link {{active_link('suppler')}}" href="{{ route('suppler.index') }}">{{trans('sideBar.suppliers')}}</a></li>
                            <li><a class="submenu-link {{active_link('delivarycompany')}}" href="{{ route('delivarycompany.index') }}">{{trans('sideBar.delivaryCompany')}}</a></li>
                            <li><a class="submenu-link {{active_link('delivaryprice')}}" href="{{ route('delivaryprice.index') }}">{{trans('sideBar.delivaryprice')}}</a></li>
                            <li><a class="submenu-link {{active_link('governorate')}}" href="{{ route('governorate.index') }}">{{trans('sideBar.governorates')}}</a></li>
                            <li><a class="submenu-link {{active_link('city')}}" href="{{ route('city.index') }}">{{trans('sideBar.city')}}</a></li>
                        </ul>

                    </li>
                    <!--  6 Warehouse Menu : Warehouses - Suppliers Orders - Products - Reports -->
                    <li>

                        <a class="sidebar-link collapsed {{active_links(['warehouse' , 'product','report'])}}" href="#warehouseSubMenu" role="button" id="sidebarLink" data-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false">
                            <div>
                                <i class="fa fa-warehouse"></i> <span class="link-text">{{trans('sideBar.warehouse')}}</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="warehouseSubMenu" class="collapse list-unstyled link-submenu {{show_ul(['warehouse','product','report'])}}" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="{{ route('warehouse.index') }}">{{trans('sideBar.warehousePlaces')}}</a></li>
                            <li><a class="submenu-link" href="{{ route('product.index') }}">{{trans('sideBar.products')}}</a></li>
                            <li><a class="submenu-link" href="{{ route('report') }}">{{trans('sideBar.reports')}}</a></li>
                        </ul>



                    </li>

                                        <!--  7 Accounting Menu : Discounts - Chipping Fees - Invoices -->
                    <li>

                        <a class="sidebar-link collapsed" href="#accountingSubMenu" role="button" id="sidebarLink" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                            <div>
                                <i class="fas fa-chart-line"></i> <span class="link-text">Accounting</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="accountingSubMenu" class="collapse list-unstyled link-submenu" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="{{ url('accounting/revenue_bill') }}">Revenue Bill</a></li>
                            <li><a class="submenu-link" href="{{ url('accounting/revenue_customer_orders') }}">Revenue shipping </a></li>
                            <li><a class="submenu-link" href="{{ url('accounting/revenue_shipping_company') }}">shipping company</a></li>
                        </ul>

                        <ul id="accountingSubMenu" class="collapse list-unstyled link-submenu" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="{{ url('accounting/expenses_bill') }}">Expenses Bill</a></li>
                            <li><a class="submenu-link" href="{{ url('accounting/expenses_customer_orders') }}">Expenses shipping </a></li>
                            <li><a class="submenu-link" href="{{ url('accounting/expenses_shipping_company') }}">Expenses company</a></li>
                        </ul>

                        <ul id="accountingSubMenu" class="collapse list-unstyled link-submenu" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="{{ url('accounting/tree') }}">Accounting Tree</a></li>
                        </ul>

                    </li>

                    <!--  7 Accounting Menu : Discounts - Chipping Fees - Invoices -->
                   <li>

                        <a class="sidebar-link collapsed" href="#returned" role="button" id="sidebarLink" data-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false">
                            <div>
                                <i class="fas fa-chart-line"></i> <span class="link-text">Company Budget</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="returned" class="collapse list-unstyled link-submenu" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="{{ url('americanJournal') }}">American Journal</a></li>
                            <li><a class="submenu-link" href="{{ url('trialBalance') }}">trial Balance</a></li>
                        </ul>

                    </li>
                    <!--  8 Returned Menu : Reasons - Products Returned -->
                    <!-- <li>

                        <a class="sidebar-link collapsed" href="#returnedsSubMenu" role="button" id="sidebarLink" data-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false">
                            <div>
                                <i class="fas fa-undo"></i> <span class="link-text">Returneds</span>
                            </div>
                            <i class="angle-icon fa fa-angle-down"></i>
                        </a>

                        <ul id="returnedsSubMenu" class="collapse list-unstyled link-submenu" aria-labelledby="sidebarLink">
                            <li><a class="submenu-link" href="#">Reasons</a></li>
                            <li><a class="submenu-link" href="#">Returned Products</a></li>
                        </ul>

                    </li> -->

                </ul>
   <!-- Links -->
    </nav>

<!-- Content -->

<div class="content">

    <!-- Top Bar -->

    <nav class="topbar navbar navbar-expand-lg navbar-light">
        <div class="container-fluid flex-nowrap">


            <button class="sidebar-collapse" type="button" id="sidebarCollapse">
                <span class="short-line"></span>
                <span class="long-line"></span>
                <span class="short-line"></span>
                <span class="long-line"></span>
            </button>

            <div class="user d-flex">
                <div class="bell">
                    <a href="#"><i class="fa fa-bell"></i></a>
                    </i>
                </div>

                <div class="lang">
                    @if (lang() == 'en')
                        <a href="{{ route('lang','ar') }}">ar</a>
                    @else
                        <a href="{{ route('lang','en') }}">en</a>
                    @endif
                </div>


                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="userDropdownBtn"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{trans('topBar.Username')}}
                    </button>
                    <div class="dropdown-menu" id="userDropdownMenu" aria-labelledby="topbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user"></i> <span>{{trans('topBar.profile')}}</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i><span>{{trans('topBar.logout')}}</span></a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>

                    </div>
                </div>

                <div class="user-img">
                    <img class="img-fluid" src="{{ asset('assets/imgs/unknown-user.png') }}" alt="user-img">
                </div>

            </div>

        </div>
    </nav>
</div>
