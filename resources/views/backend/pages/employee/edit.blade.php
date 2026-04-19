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
                                    <div class="card-header">
                                    </div><!-- end card header -->
        
        <div class="card-body">
            <form action="{{ route('update.employee') }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-4">
                    <input type="hidden" name="id" value="{{ $employee->id }}">
                    <label for="name" class="form-label">نام کارمند</label>
                    <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="lname" class="form-label">تخلص </label>
                    <input type="text" class="form-control" name="lname" value="{{ $employee->lname }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="province" class="form-label">ولایت</label>
                    <input type="text" class="form-control" name="province" value="{{ $employee->province }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="email" class="form-label">ایمیل</label>
                    <input type="text" class="form-control" name="email" value="{{ $employee->email }}">
                </div>

                <div class="col-md-4">
                    <label for="phone" class="form-label">شماره تماس</label>
                    <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}">
                </div>

                <div class="col-md-4">
                    <label for="national_id" class="form-label">نمبر تذکره</label>
                    <input type="text" class="form-control" name="national_id" value="{{ $employee->national_id }}">
                </div>

                <div class="col-md-4">
                    <label for="photo" class="form-label">عکس</label>
                    <input type="file" class="form-control" name="photo">
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

                <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                email: {
                    required : true,
                },
                address: {
                    required : true,
                },
                
            },
            messages :{
                name: {
                    required : 'Please Enter Customer Name',
                }, 
                name: {
                    required : 'Please Enter Customer Email',
                },
                name: {
                    required : 'Please Enter Customer Address',
                },

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection