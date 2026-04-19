@extends('backend.master')
@section('body')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="content">
        <!-- Start Content--> 
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">اضافه کردن فروشات</h4>
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
                            <form action="{{ route('store.sales') }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data"> 
                            @csrf
                                <div class="form-group col-md-4"> 
                                    <label for="category_id" class="form-label"> نام دسته بندی:</label> 
                                    <select name="category_id" id="categorySelect" class="form-control"> <option value="">انتخاب دسته بندی </option> 
                                        @foreach($category as $categories)
                                            <option value="{{ $categories->id }}"> 
                                                {{ $categories->name }} 
                                            </option>
                                        @endforeach 
                                    </select> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="product_id" class="form-label">نام محصول  :</label> 
                                    <select name="product_id" id="productSelect" class="form-control">
                                        <option value="">انتخاب محصول</option>
                                    </select> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="employee_id" class="form-label">اسم کارمند :</label> 
                                    <select name="employee_id" class="form-control"> <option value="">انتخاب کارمند</option> 
                                        @foreach($employee as $item)
                                            <option value="{{ $item->id }}"> 
                                                {{ $item->name }} 
                                            </option>
                                        @endforeach 
                                    </select> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="quantity" class="form-label">مقدار جنس :</label> 
                                    <input type="number" class="form-control" name="quantity" min="1" required> 
                                </div>

                                <div class="col-md-4"> 
                                    <label class="form-label" for="sale_price">قیمت فروش : </label> 
                                    <input type="text" name="sale_price" class="form-control"> 
                                </div>

                                <div class="col-md-4"> 
                                    <label class="form-label" for="charges">مصارف و کرایه : </label> 
                                    <input type="text" name="charges" class="form-control"> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="province" class="form-label">ولایت :</label> 
                                    <input type="text" class="form-control" name="province"> 
                                </div>

                                <div class="form-group col-md-4"> 
                                    <label for="bill" class="form-label">نمبر بل :</label> 
                                    <input type="text" class="form-control" name="bill"> 
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label">تاریخ:</label>
                                    <input type="date" name="date" class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label">وضعیت فروش:</label>
                                    <select name="status" class="form-control">
                                        <option value="pending">در انتظار</option>
                                        <option value="completed">تکمیل شده</option>
                                        <option value="cancelled">لغو شده</option>
                                    </select>
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
    <script>
$(document).ready(function () {

    $('#categorySelect').change(function () {

        let category_id = $(this).val();

        $.get('/get-products/' + category_id, function(products){

            let productSelect = $('#productSelect');
            productSelect.html('<option value="">انتخاب محصول</option>');

            products.forEach(function(product){
                productSelect.append(
                    `<option value="${product.id}">${product.name}</option>`
                );
            });

        });

    });

});
</script>
@endsection