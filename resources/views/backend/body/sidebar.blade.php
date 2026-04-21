<div class="app-sidebar-menu" style="background-color: #062A29;">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box d-flex justify-content-center align-items-center">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('upload/logo/logo-view.png') }}" alt="" height="55">
                    </span>
                </a>
            </div>
            <hr>

            <ul id="side-menu">

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span> صفحه اصلی </span>
                    </a>
                </li>

                <!-- <li>
                    <a href="landing.html" target="_blank">
                        <i data-feather="globe"></i>
                        <span> Landing </span>
                    </a>
                </li> -->

                <li>
                    <a href="#product" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> محافل </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.products') }}" class="tp-link">لیست محافل بوک شده </a>
                            </li>
                            <li>
                                <a href="{{ route('add.products') }}" class="tp-link">افزودن محفل جدید </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#outproduct" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span>محافل بیرونی </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="outproduct">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.out.products') }}" class="tp-link">لیست محافل بوک شده </a>
                            </li>
                            <li>
                                <a href="{{ route('add.products') }}" class="tp-link">افزودن محفل جدید </a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> خدمات محفل </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.category') }}" class="tp-link">لیست خدمات محفل</a>
                            </li>
                            <li>
                                <a href="{{ route('add.category') }}" class="tp-link">افزودن خدمات محفل </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li>
                    <a href="#sales" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> فروشات </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sales">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.sales') }}" class="tp-link">لیست فروشات</a>
                            </li>
                            <li>
                                <a href="{{ route('add.sales') }}" class="tp-link">افزودن فروشات</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li>
                    <a href="#charges" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> مصارف </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="charges">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.expenses') }}" class="tp-link">لیست مصارف</a>
                            </li>

                            <li>
                                <a href="{{ route('add.expenses') }}" class="tp-link">افزودن مصارف</a>
                            </li>

                            <li>
                                <a href="{{ route('all.debt') }}" class="tp-link">قرض ها</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> کارمندان </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.employee') }}" class="tp-link">لیست کارمندان </a>
                            </li>
                            <li>
                                <a href="{{ route('add.employee') }}" class="tp-link">افزودن کارمند</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- report --}}

                <li>
                    <a href="#reports" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> گزارش ها </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="reports">
                        <ul class="nav-second-level">
                            {{-- <li>
                                <a href="{{ route('all.expenses.report') }}" class="tp-link">گذارش مصارفات</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('all.report') }}" class="tp-link">گزارش عمومی</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('daily.report') }}" class="tp-link" >گزارش روزانه  </a>
                </li>



            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
