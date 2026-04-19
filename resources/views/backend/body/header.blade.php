<div class="topbar-custom">
    <div class="container-xxl">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link ps-0">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <div class="position-relative topbar-search">
                        <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4" placeholder="Search...">
                        <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                    </div>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                    </button>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i data-feather="bell" class="noti-icon"></i>
                        <span class="badge bg-danger rounded-circle noti-icon-badge" id="pendingCount">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-end">
                                    <a href="" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar>
                            <!-- JS اینجا همه نوتیف‌ها رو اضافه می‌کنه -->
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

                        <script>
                        $(document).ready(function(){

                            loadPendingNotifications();

                            function loadPendingNotifications(){
                                $.get('/sales/pending-notifications', function(sales){

                                    // 🔴 آپدیت تعداد badge
                                    $('#pendingCount').text(sales.length);

                                    let container = $('.noti-scroll');
                                    container.html('');

                                    // اگر نوتیف نداشت
                                    if(sales.length === 0){
                                        container.append(`
                                            <div class="text-center text-muted p-3">
                                                نوتیف جدیدی وجود ندارد
                                            </div>
                                        `);
                                        return;
                                    }

                                    // ساخت نوتیف‌ها
                                    sales.forEach(sale => {
                                        container.append(`
                                            <div class="dropdown-item notify-item mb-2 p-2 border rounded bg-light">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>${sale.employee ? sale.employee.name : 'نامشخص'}</strong> 
                                                        -- ${sale.product ? sale.product.name : 'محصول نامشخص'}
                                                    </div>
                                                    <div class="d-flex">
                                                        <button class="btn btn-success btn-sm me-1 complete-btn" data-id="${sale.id}">تکمیل شد</button>
                                                        <button class="btn btn-danger btn-sm cancel-btn" data-id="${sale.id}">رد شد</button>
                                                    </div>
                                                </div>
                                                <div class="text-muted mt-1 small">
                                                    تعداد: ${sale.quantity ?? 0} | قیمت فروش: ${sale.sale_price ?? 0}
                                                </div>
                                            </div>
                                        `);
                                    });
                                });
                            }

                            // تغییر وضعیت به completed
                            $(document).on('click', '.complete-btn', function(){
                                let id = $(this).data('id');
                                updateSaleStatus(id, 'completed');
                            });

                            // تغییر وضعیت به cancelled
                            $(document).on('click', '.cancel-btn', function(){
                                let id = $(this).data('id');
                                updateSaleStatus(id, 'cancelled');
                            });

                            function updateSaleStatus(id,status){
                                $.post('/sales/change-status/' + id, {
                                    _token: '{{ csrf_token() }}',
                                    status: status
                                }, function(res){
                                    if(res.success){
                                        loadPendingNotifications(); // ریفرش لیست
                                    }
                                });
                            }

                        });
                        </script>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fe-arrow-right"></i>
                        </a>

                    </div>
                </li>

                @php
                    $id = Auth::user()->id;
                    $profileData = App\Models\User::find($id);
                @endphp

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ (!empty($profileData->photo)) ? url('upload/profile/'.$profileData->photo) : url('upload/no_image.png') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ $profileData->username }} <i class="mdi mdi-chevron-down"></i> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">خوش آمدید</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ route('admin.profile') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                            <span>پروفایل</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                            <span>خروج</span>
                        </a>

                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>