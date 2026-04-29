@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">اضافه کردن کاربر</h4>
                            </div>
                        </div>

                         {{-- Server-side validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Validation -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                   <!-- <div class="card-header">
                                        
                                    </div> end card header -->
        
        <div class="card-body">
            <form action="{{ route('store.employee') }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-4">
                    <label for="name" class="form-label">نام کارمند</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="form-group col-md-4">
                    <label for="lname" class="form-label">تخلص </label>
                    <input type="text" class="form-control" name="lname">
                </div>

                <div class="form-group col-md-4">
                    <label for="province" class="form-label">معاش</label>
                    <input type="text" class="form-control" name="salary">
                </div>

                <div class="form-group col-md-4">
                    <label for="email" class="form-label">وظیفه</label>
                    <input type="text" class="form-control" name="position">
                </div>

                <div class="col-md-4">
                    <label for="phone" class="form-label">شماره تماس</label>
                    <input type="text" class="form-control" name="phone">
                </div>

           

              

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">ذخیره</button>
                </div>
            </form>
        </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                        </div>

                    </div> <!-- container-fluid -->

                </div>

@endsection