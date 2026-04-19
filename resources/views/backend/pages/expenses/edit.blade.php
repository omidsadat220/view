@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">ویرایش مصرف</h4>
            </div> 
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show text-center">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row"> 
            <div class="col-xl-12"> 
                <div class="card"> 
                    <div class="card-body"> 

                        <form action="{{ route('update.expenses', $expense->id) }}" method="post" class="row g-3">
                            @csrf

                            <!-- نوع مصرف -->
                            <div class="form-group col-md-4">
                                <label class="form-label">نوع مصرف:</label>
                                <select name="type" id="typeSelect" class="form-control">
                                    <option value="">انتخاب نوع</option>
                                    <option value="employee" {{ $expense->type == 'employee' ? 'selected' : '' }}>کارمند</option>
                                    <option value="shop" {{ $expense->type == 'shop' ? 'selected' : '' }}>دکان</option>
                                    <option value="withdraw" {{ $expense->type == 'withdraw' ? 'selected' : '' }}>برداشت کارمند</option>
                                </select>
                            </div>

                            <!-- کارمند -->
                            <div class="form-group col-md-4" id="employeeDiv">
                                <label class="form-label">نام کارمند:</label>
                                <select name="employee_id" id="employeeSelect" class="form-control">
                                    <option value="">انتخاب کارمند</option>
                                    @foreach($employee as $item)
                                        <option value="{{ $item->id }}" {{ $expense->employee_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- عنوان مصرف -->
                            <div class="form-group col-md-4">
                                <label class="form-label">عنوان مصرف:</label>
                                <input type="text" name="title" class="form-control" value="{{ $expense->title }}">
                            </div>

                            <!-- مقدار -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مقدار:</label>
                                <input type="number" name="amount" class="form-control" value="{{ $expense->amount }}">
                            </div>

                            <!-- تاریخ -->
                            <div class="form-group col-md-4">
                                <label class="form-label">تاریخ:</label>
                                <input type="date" name="date" class="form-control" value="{{ $expense->date }}">
                            </div>

                            <!-- توضیحات -->
                            <div class="form-group col-md-4">
                                <label class="form-label">توضیحات:</label>
                                <input type="text" name="note" class="form-control" value="{{ $expense->note }}">
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
$(document).ready(function(){

    function toggleEmployee() {
        let type = $('#typeSelect').val();
        if(type === 'shop'){
            $('#employeeSelect').val('');
            $('#employeeSelect').prop('disabled', true);
            $('#employeeSelect').addClass('is-invalid');
            $('#employeeDiv').hide();
        } else if(type === 'employee' || type === 'withdraw'){
            $('#employeeSelect').prop('disabled', false);
            $('#employeeSelect').removeClass('is-invalid');
            $('#employeeDiv').show();
        }
    }

    toggleEmployee(); // حالت اولیه با مقدار قبلی

    $('#typeSelect').change(function(){
        toggleEmployee();
    });

});
</script>

@endsection