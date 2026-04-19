@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">صفحه ویرایش محفل </h4>
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
                        <h5>ویرایش اطلاعات</h5>
                    </div><!-- end card header -->
    
                    <div class="card-body">
                        <form action="{{ route('update.products', $product->id) }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data">
                            @csrf
                            {{-- No need for @method('PUT') since route uses POST --}}

                            <input type="hidden" name="id" value="{{ $product->id }}">

                            <!-- Bell Number -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مسلسل بل <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="bellnumber" value="{{ $product->bellnumber }}" required>
                            </div>

                            <!-- First Name -->
                            <div class="form-group col-md-4">
                                <label class="form-label">اسم <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group col-md-4">
                                <label class="form-label">شماره تماس <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname" value="{{ $product->lastname }}" required>
                            </div>

                            <!-- Hall -->
                            <div class="form-group col-md-4">
                                <label class="form-label">هوتل <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="hall" value="{{ $product->hall }}" required>
                            </div>

                            <!-- Room -->
                            <div class="form-group col-md-4">
                                <label class="form-label">صالون <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="room" value="{{ $product->room }}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="date" class="form-label">تاریخ محفل <span class="text-danger">*</span></label>
                                <input type="text" id="persianDate" class="form-control" name="date" value="{{ $product->date }}">
                            </div>

                         <!-- Total Price -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مجموع مبلغ <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ $product->price ?? '' }}" required>
                            </div>

                            <!-- Paid Amount -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مبلغ پرداخت شده <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="paied" id="paied" value="{{ $product->paied ?? '' }}" required>
                            </div>

                            <!-- Remaining Amount -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مبلغ باقی مانده <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="remaining" id="remaining" value="{{ $product->remaining ?? '' }}" readonly style="background-color: #e9ecef;">
                            </div>

            <option value="45">سهم هوتل تاج %45 </option>


                            <div class="form-group col-md-4">
                                <label for="remaining" class="form-label">
                                    سهم هوتل یا سهم بیرونی<span class="text-danger">*</span>
                                </label>

                                <select name="tax" class="form-control">
                                    <option value="45" {{ ($product->tax == 45) ? 'selected' : '' }}>
                                       45% سهم هوتل تاج
                                    </option>
                                    <option value="35" {{ ($product->tax == 35) ? 'selected' : '' }}>
                                       35% سهم بیرونی
                                    </option>
                                </select>
                            </div>

                            <!-- Categories - Checkbox Version with preselected values -->
                            <div class="form-group col-md-12">
                                <label class="form-label">دسته بندی <span class="text-danger">*</span></label>
                                <div class="row" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
                                    @foreach($categories as $category)
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="category_ids[]" 
                                                       value="{{ $category->id }}" 
                                                       id="category_{{ $category->id }}"
                                                       {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="category_{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">می توانید چندین دسته بندی را انتخاب کنید</small>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">به روز رسانی</button>
                                <a href="{{ route('all.products') }}" class="btn btn-secondary">لغو</a>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>

    </div> <!-- container-fluid -->

</div>

<script>
    // Get the input elements
    const priceInput = document.getElementById('price');
    const paiedInput = document.getElementById('paied');
    const remainingInput = document.getElementById('remaining');

    // Function to calculate remaining amount
    function calculateRemaining() {
        let price = parseFloat(priceInput.value) || 0;
        let paied = parseFloat(paiedInput.value) || 0;
        let remaining = price - paied;
        
        // Set the remaining amount (if negative, set to 0)
        remainingInput.value = remaining >= 0 ? remaining.toFixed(2) : 0;
    }

    // Add event listeners
    priceInput.addEventListener('input', calculateRemaining);
    paiedInput.addEventListener('input', calculateRemaining);
    
    // Initial calculation when page loads
    calculateRemaining();
</script>

<script>
    // Auto-calculate remaining amount
    $(document).ready(function() {
        function calculateRemaining() {
            var price = parseFloat($('input[name="price"]').val()) || 0;
            var paied = parseFloat($('input[name="paied"]').val()) || 0;
            var remaining = price - paied;
            $('input[name="remaining"]').val(remaining);
        }
        
        $('input[name="price"], input[name="paied"]').on('keyup change', function() {
            calculateRemaining();
        });
    });
</script>

@endsection