@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">ویرایش فروش</h4>
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

        <div class="row"> 
            <div class="col-xl-12"> 
                <div class="card"> 
                    <div class="card-body"> 
                        <form action="{{ route('update.sales', $sale->id) }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data"> 
                            @csrf
                            @method('POST')

                            {{-- Category --}}
                            <div class="form-group col-md-4"> 
                                <label for="category_id" class="form-label"> نام دسته بندی:</label> 
                                <select name="category_id" id="categorySelect" class="form-control">
                                    <option value="">انتخاب دسته بندی </option> 
                                    @foreach($category as $categories)
                                        <option value="{{ $categories->id }}" @if($categories->id == $sale->category_id) selected @endif> 
                                            {{ $categories->name }} 
                                        </option>
                                    @endforeach 
                                </select> 
                            </div>

                            {{-- Product --}}
                            <div class="form-group col-md-4"> 
                                <label for="product_id" class="form-label">نام محصول  :</label> 
                                <select name="product_id" id="productSelect" class="form-control">
                                    <option value="">انتخاب محصول</option>
                                    @foreach($product as $items)
                                        @if($items->category_id == $sale->category_id)
                                            <option value="{{ $items->id }}" @if($items->id == $sale->product_id) selected @endif>
                                                {{ $items->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select> 
                            </div>

                            {{-- Employee --}}
                            <div class="form-group col-md-4"> 
                                <label for="employee_id" class="form-label">اسم کارمند :</label> 
                                <select name="employee_id" class="form-control"> 
                                    <option value="">انتخاب کارمند</option> 
                                    @foreach($employee as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $sale->employee_id) selected @endif> 
                                            {{ $item->name }} 
                                        </option>
                                    @endforeach 
                                </select> 
                            </div>

                            {{-- Quantity --}}
                            <div class="form-group col-md-4"> 
                                <label for="quantity" class="form-label">مقدار جنس :</label> 
                                <input type="number" class="form-control" name="quantity" min="1" value="{{ $sale->quantity }}" required> 
                            </div>

                            {{-- Sale Price --}}
                            <div class="col-md-4"> 
                                <label class="form-label" for="sale_price">قیمت فروش : </label> 
                                <input type="text" name="sale_price" class="form-control" value="{{ $sale->sale_price }}"> 
                            </div>

                            {{-- Charges --}}
                            <div class="col-md-4"> 
                                <label class="form-label" for="charges">مصارف و کرایه : </label> 
                                <input type="text" name="charges" class="form-control" value="{{ $sale->charges ?? 0 }}"> 
                            </div>

                            {{-- Province --}}
                            <div class="form-group col-md-4"> 
                                <label for="province" class="form-label">ولایت :</label> 
                                <input type="text" class="form-control" name="province" value="{{ $sale->province }}"> 
                            </div>

                            <div class="form-group col-md-4"> 
                                <label for="bill" class="form-label">نمبر بل :</label> 
                                <input type="text" class="form-control" name="bill" value="{{ $sale->bill }}"> 
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label">تاریخ:</label>
                                <input type="date" name="date" class="form-control" value="{{ $sale->date }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label">وضعیت فروش:</label>
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $sale->status == 'pending' ? 'selected' : '' }}>
                                        در انتظار
                                    </option>

                                    <option value="completed" {{ $sale->status == 'completed' ? 'selected' : '' }}>
                                        تکمیل شده
                                    </option>

                                    <option value="cancelled" {{ $sale->status == 'cancelled' ? 'selected' : '' }}>
                                        لغو شده
                                    </option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
                            </div> 
                        </form>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
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