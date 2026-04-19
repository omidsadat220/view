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

                        <form action="{{ route('update.debt', $expense->id) }}" method="post" class="row g-3">
                            @csrf


                            <!-- کارمند -->
                            <div class="form-group col-md-4" id="employeeDiv">
                                <label class="form-label">نام :</label>
                                  <input type="text" name="name" value="{{ $expense->name }}" class="form-control">
                            </div>

                            <div class="form-group col-md-4" id="employeeDiv">
                                <label class="form-label">جزیات :</label>
                                  <input type="text" name="about"value="{{ $expense->about }}" class="form-control">
                            </div>
                          

                            <!-- مقدار -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مقدار:</label>
                                <input type="number" name="price" value="{{ $expense->price }}" class="form-control">
                            </div>

                            <!-- تاریخ -->
                            <div class="form-group col-md-4">
                                <label class="form-label">تاریخ:</label>
                                <input type="text" name="date" value="{{ $expense->date }}" class="form-control">
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