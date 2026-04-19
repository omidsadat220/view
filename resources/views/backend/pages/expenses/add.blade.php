@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">افزودن مصرف جدید</h4>
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

                        <form action="{{ route('store.expenses') }}" method="post" class="row g-3">
                            @csrf

                            <!-- نوع مصرف -->
                            <div class="form-group col-md-4">
                                <label class="form-label">نوع مصرف:</label>
                                <select name="type" id="typeSelect" class="form-control">
                                    <option value="employee">هزینه کارمند</option>
                                    <option value="shop">هزینه دفتر</option>
                                    {{-- <option value="withdraw">برداشت کارمند</option> --}}
                                </select>
                            </div>

                            <!-- کارمند -->
                            <div class="form-group col-md-4" id="employeeDiv">
                                <label class="form-label">نام کارمند:</label>
                                <select name="employee_id" id="employeeSelect" class="form-control">
                                    @foreach($employee as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                          

                            <!-- مقدار -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مقدار:</label>
                                <input type="number" name="amount" class="form-control">
                            </div>

                            <!-- تاریخ -->
                            <div class="form-group col-md-4">
                                <label class="form-label">تاریخ:</label>
                                <input type="date" name="date" class="form-control">
                            </div>

                            <!-- توضیحات -->
                            <div class="form-group col-md-4">
                                <label class="form-label">توضیحات:</label>
                                <input type="text" name="note" class="form-control">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">ذخیره</button>
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
                $('#employeeDiv').hide();
            } else if(type === 'employee' || type === 'withdraw'){
                $('#employeeSelect').prop('disabled', false);
                $('#employeeDiv').show();
            }
        }

        toggleEmployee(); // برای حالت اولیه

        $('#typeSelect').change(function(){
            toggleEmployee();
        });

    });
</script>

@endsection