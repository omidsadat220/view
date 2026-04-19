@extends('backend.master')
@section('body')

<style>
    .category-card {
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
    }
    .category-card:hover {
        background-color: #f8f9fa;
        border-color: #86b7fe;
    }
    .category-checkbox:checked + .form-check-label {
        color: #0d6efd;
        font-weight: bold;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0"> صفحه اضافه کردن محفل  جدید </h4>
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
         <form action="{{ route('store.products') }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data">
    @csrf

    <div class="form-group col-md-4">
        <label for="bellnumber" class="form-label">مسلسل بل <span class="text-danger">*</span></label>
        <input type="number" class="form-control" name="bellnumber" placeholder="Enter Bell Number">
    </div>

    <div class="form-group col-md-4">
        <label for="name" class="form-label">اسم <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" placeholder="Enter Name">
    </div>

    <div class="form-group col-md-4">
        <label for="lastname" class="form-label">شماره تماس <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name">
    </div>

    <div class="form-group col-md-4">
        <label for="hall" class="form-label">هوتل<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="hall" placeholder="Enter Hall">
    </div>

    <div class="form-group col-md-4">
        <label for="room" class="form-label">صالون<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="room" placeholder="Enter Room">
    </div>

    <div class="form-group col-md-4">
        <label for="date" class="form-label">تاریخ محفل <span class="text-danger">*</span></label>
        <input type="text" id="persianDate" class="form-control" name="date" value="1400/00/00">
    </div>

    <div class="form-group col-md-4">
    <label for="price" class="form-label">مجموع مبلغ<span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price">
    </div>

    <div class="form-group col-md-4">
        <label for="paied" class="form-label">مبلغ پرداخت شده<span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="paied" name="paied" placeholder="Enter Paid Amount">
    </div>

    <div class="form-group col-md-4">
        <label for="remaining" class="form-label">مبلغ باقی مانده<span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="remaining" name="remaining" placeholder="Enter Remaining Amount" readonly style="background-color: #e9ecef;">
    </div>

    <div class="form-group col-md-4">
           <label for="remaining" class="form-label">سهم هوتل یا سهم بیرونی<span class="text-danger">*</span></label>

        <select name="tax" id=""  class="form-control">
            <option value="45">سهم هوتل تاج %45 </option>
            <option value="35">سهم بیرونی %35 </option>
        </select>
     
    </div>

    <!-- Enhanced Checkbox Version with Cards -->
<div class="form-group col-md-12">
    <label class="form-label">خدمات و کرایه  <span class="text-danger">*</span></label>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-3 mb-3">
                <div class="card category-card" style="cursor: pointer;">
                    <div class="card-body py-2">
                        <div class="form-check">
                            <input class="form-check-input category-checkbox" 
                                   type="checkbox" 
                                   name="category_ids[]" 
                                   value="{{ $category->id }}" 
                                   id="category_{{ $category->id }}">
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <input type="submit" class="btn btn-primary" value="ذخیره">
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
        
        // If remaining is negative, set to 0
        if (remaining < 0) {
            remaining = 0;
            paiedInput.value = price; // Adjust paid amount to match price
        }
        
        remainingInput.value = remaining.toFixed(2);
    }

    // Add event listeners
    priceInput.addEventListener('input', calculateRemaining);
    paiedInput.addEventListener('input', calculateRemaining);
    
    // Initial calculation
    calculateRemaining();
</script>

                <script>
    // Optional: Make the whole card clickable
    document.querySelectorAll('.category-card').forEach(card => {
        card.addEventListener('click', function(e) {
            const checkbox = this.querySelector('.category-checkbox');
            if (e.target.tagName !== 'INPUT') {
                checkbox.checked = !checkbox.checked;
            }
        });
    });
</script>




@endsection