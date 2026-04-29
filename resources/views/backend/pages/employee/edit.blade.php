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
                    <label for="province" class="form-label">معاش</label>
                    <input type="text" class="form-control" name="salary" value="{{ $employee->salary }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="position" class="form-label">وظیفه</label>
                    <input type="text" class="form-control" name="position" value="{{ $employee->position }}">
                </div>

                <div class="col-md-4">
                    <label for="phone" class="form-label">شماره تماس</label>
                    <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}">
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