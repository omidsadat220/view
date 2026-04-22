<!DOCTYPE html>
<html lang="fa">
    <head>

        <meta charset="utf-8" />
        <title>Tawana | Warehouse</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
        <meta name="author" content="Naweed"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('upload/logo/2.jpeg') }}">

        <!-- App css -->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


    <style>
/* ===== Reset & Base ===== */
body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    overflow-x: hidden;
}

/* ===== LEFT SIDE (LOGIN) ===== */
.col-xl-5 {
    background: linear-gradient(135deg, #062A29, #0b3d3b);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* CARD */
.col-xl-5 .border-0 {
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(14px);
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.5);
    border: 1px solid rgba(255,255,255,0.1);
}

/* LOGO CENTER */
.auth-logo img {
    display: block;
    margin: 0 auto;
}

/* LABEL */
.form-label {
    color: #e0f2f1;
    font-size: 14px;
}

/* INPUT */
.form-control {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    border-radius: 10px;
    padding: 10px;
    padding-right:40px !important;
}

.form-control::placeholder {
    color: #ccc;
    
}

.form-control:focus {
    border-color: #F5C542;
    box-shadow: 0 0 10px rgba(245, 197, 66, 0.6);
    background: rgba(255,255,255,0.12);
    color: #fff;
}

/* CHECKBOX */
.form-check-label {
    color: #c8e6e5;
    font-size: 13px;
}

/* BUTTON */
.btn-primary {
    background: #F5C542;
    border: none;
    color: #062A29;
    font-weight: bold;
    border-radius: 12px;
    padding: 10px;
    transition: 0.3s;
}

.btn-primary:hover {
    background: #ffd95e;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 197, 66, 0.4);
}

/* ERROR */
.alert-danger {
    background: rgba(255, 0, 0, 0.15);
    color: #ffb3b3;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
}

/* ===== RIGHT SIDE ===== */
.col-xl-7 {
    background: #f8f9fa;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.account-page-bg {
    width: 100%;
}

/* TOP CARD RIGHT */
.account-page-bg .rounded {
    border-radius: 15px !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* IMAGE */
.auth-image img {
    max-width: 80%;
}

/* TEXT */
.account-page-bg p {
    font-size: 14px;
    color: #555;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .col-xl-7 {
       /*-- display: none; --*/
    }
    
    .col-xl-5 {
        width: 100%;
    }
}
        


/* ===== FIX FOR TABLET (<=1024px) ===== */
@media (max-width: 1024px) {

    /* کل ردیف عمودی شود */
    .account-page .row {
        flex-direction: row;
    }

    /* ساید راست برود بالا */
    .col-xl-7 {
        
        width: 100%;
        min-height: auto;
        padding: 20px;
    }

    /* فرم کامل عرض بگیرد */
    .col-xl-5 {
        width: 100%;
        min-height: auto;
        padding: 30px 15px;
    }

    /* کارت فرم وسط و بزرگ‌تر */
    .col-md-7 {
        max-width: 500px;
    }

    /* تصویر کوچک‌تر شود */
    .auth-image img {
        max-width: 60%;
    }
}

/* ===== MOBILE FIX (<=768px) ===== *//* ===== MOBILE (<=768px) FIX REAL ===== */
@media (max-width: 768px) {

    /* حذف ساید راست 
    .col-xl-7 {
        display: none;
    }
    */

    /* والد */
    .account-page .row {
        flex-direction: column;
    }

    /* بخش فرم */
    .col-xl-5 {
        min-height: auto;
        display: block; /* ❗ مهم: flex حذف شود */
        padding: 20px 10px;
    }

    /* حذف فاصله اضافی */
    .col-xl-5 .row {
        margin: 0;
    }

    /* فرم بچسبد بالا */
    .col-md-7 {
        max-width: 100%;
        margin-top: 20px; /* فاصله کم و کنترل شده */
    }

    /* کارت */
    .col-xl-5 .border-0 {
        padding: 20px !important;
    }

    /* لوگو */
    .auth-logo img {
        height: 70px;
    }
    .account-page .account-page-bg {
    min-height: auto;
    }
}


/* ===== TABLET / iPad (769px - 1024px) ===== */
@media (min-width: 769px) and (max-width: 1024px) {

    .account-page .account-page-bg {
    min-height: auto;
    }

    .account-page {
    align-items: center;
    display: flex;
    min-height: auto !important;

    .account-page .row {
        flex-direction: column;
    }

    /* بالا (ساید راست) */
    .col-xl-7 {
        width: 100%;
        min-height: auto;
        padding: 30px;
    }

    /* پایین (فرم) */
    .col-xl-5 {
        width: 100%;
        min-height: auto;
        display: block; /* ❗ مهم */
        padding: 30px 15px;
    }

    /* فرم وسط */
    .col-md-7 {
        max-width: 500px;
        margin: 30px auto 0;
    }

    /* تصویر */
    .auth-image img {
        max-width: 50%;
    }
}
    </style>


    </head>

    <body class="bg-white"  dir="rtl">
        <!-- Begin page -->
        <div class="account-page">
            <div class="container-fluid p-0">
                <div class="row d-flex  align-items-center justify-content-center g-0">

                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col-md-7 mx-auto w-100">
                                <div class="mb-0 border-0 p-md-5 p-lg-0 p-4" style="padding:25px !important">
                                    <div class="mb-4 p-0">
                                        <a href="/" class="auth-logo">
                                            <img src="{{ asset('upload/logo/2.jpeg') }}" alt="view" class="mx-auto" height="100" />
                                        </a>
                                    </div>
    
                                    <div class="pt-0">
                                        <form action="{{ route('login') }}" method="POST" class="my-4">
                                            @csrf

                                            @if (session('error'))
                                                <div class="alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <div class="form-group mb-3">
                                                <label for="emailaddress" class="form-label">ایمیل</label>
                                                <input class="form-control" type="email" name="email" id="emailaddress" required value="admin@gmail.com">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                
                                            <div class="form-group mb-3">
                                                <label for="password" class="form-label">رمز عبور</label>
                                                <input class="form-control" type="password" name="password" id="password" required value="123123123">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                
                                            <div class="form-group d-flex mb-3">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                                                        <label class="form-check-label" for="checkbox-signin">مرا به خاطر بسپار</label>
                                                    </div>
                                                </div>
                                                <!--<div class="col-sm-6 text-end">-->
                                                <!--    <a class='text-muted fs-14' href="{{ route('password.request') }}">رمز عبور خود را فراموش کرده‌اید؟</a>                             -->
                                                <!--</div>-->
                                            </div>
                                            
                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary" type="submit"> ورود </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="account-page-bg ">
                            <div class="text-center">
                              <div class="text-center p-4 rounded" style="background: linear-gradient(135deg, #062A29, #062A29);">
                                <a href="https://tawanatechnology.com" target="_blank" class="text-white">
                                    <h2 class="mb-2 text-white">
                                        <i class="bi bi-shield-lock-fill text-success"></i>
                                        <span class="fw-bold">System Secured</span>
                                    </h2>

                                    <h5 class="text-white">
                                        <i class="bi bi-code-slash text-white"></i>
                                        by <strong>Tawana Technology</strong>
                                    </h5>

                                    </a>
                                </div>
                                <div class="auth-image">
                                    <img src="{{ asset('backend/assets/images/view.png') }}" class="mx-auto img-fluid" style="max-height: 300px; max-width: 100%;" alt="تصویر ورود">
                                </div>
                                <p class="text-success fw-bold mt-3">لطفاً ایمیل و رمز عبور خود را برای ورود به پنل وارد کنید.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Vendor -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset('backend/assets/js/app.js') }}"></script>
        
    </body>
</html>