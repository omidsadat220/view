@extends('backend.master')
@section('body')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="content">
        <!-- Start Content--> 
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">اضافه کردن اسپانسر</h4>
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
                            <form action="{{ route('store.sponser') }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data"> 
                            @csrf
                                <div class="form-group col-md-4"> 
                                    <label for="employee_id" class="form-label">اسم کارمند :</label> 
                                    <select name="employee_id" class="form-control"> <option value="">انتخاب کارمند</option> 
                                        @foreach($employees as $item)
                                            <option value="{{ $item->id }}"> 
                                                {{ $item->name }} 
                                            </option>
                                        @endforeach 
                                    </select> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="product_id" class="form-label">نام محصول  :</label> 
                                    <select name="product_id" class="form-control"> <option value="">انتخاب محصول</option> 
                                        @foreach($products as $item)
                                            <option value="{{ $item->id }}"> 
                                                {{ $item->name }} 
                                            </option>
                                        @endforeach 
                                    </select> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="amount" class="form-label">مقدار پول :</label> 
                                    <input type="number" class="form-control" name="amount" min="1" required> 
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label">تاریخ:</label>
                                    <input type="date" name="date" class="form-control">
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