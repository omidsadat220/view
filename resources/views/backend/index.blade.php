@extends('backend.master')
@section('body')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">صفحه اصلی</h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">آمد مکمل ماه </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalStock) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total totalPaied -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">پیش پرداخت ها </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">مصرف </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"> پول موجودی   </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalPaied - $totalExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                      <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">پول باقی مانده بالای مشتریان   </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalPaied - $totalExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1" style="color: white"> باقی مانده بالای مشتریان   </div>
                                <div class="fs-22 fw-semibold text-primary" style="color: white">
                                  
                                    <h5 style="color: white">
                                         {{ number_format($totalPaied - $totalExpenses) }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1" > عاید خالص   </div>
                                <div class="fs-22 fw-semibold text-primary" >
                                    {{ number_format($totalPaied - $totalExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end sales -->
        </div> <!-- end row -->

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">محافل بیرونی</h4>
            </div>
        </div>


             <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">آمد مکمل محافل بیرونی </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalOutStock) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Total totalPaied -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">پیش پرداخت محافل بیرونی </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalOutPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Total totalPaied -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">مصارف محافل بیرونی </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalOutExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"> پول موجودی   </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalOutPaied - $totalOutExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">پول باقی مانده بالای مشتریان بیرونی   </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalOutStock - $totalOutPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1" style="color: white"> باقی مانده بالای مشتریان   </div>
                                <div class="fs-22 fw-semibold text-primary" style="color: white">
                                  
                                    <h5 style="color: white">
                                         {{ number_format($totalPaied - $totalExpenses) }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"> عاید خالص محافل بیرونی   </div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalOutPaied - $totalOutExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>


                       <div class="col-md-12 col-xl-12">
                                <div class="card overflow-hidden">
                                    
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                                <i data-feather="table" class="widgets-icons"></i>
                                            </div>
                                            <h5 class="card-title mb-0">لیست قرض دفتر </h5>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-traffic mb-0">
                                                <tbody>

                                                    <thead>
                                                        <tr>
                                                            <th>نام</th>
                                                            <th>مقدرا</th>
                                                            <th>جزیات</th>
                                                            <th colspan="2">تاریخ</th>
                                                        </tr>
                                                    </thead>

                                                    @foreach ($totalDebt as  $debt)
                                                         <tr>
                                                        <td>
                                                            {{ $debt->name }}
                                                        </td>
                                                        <td>{{ $debt->price }}</td>
                                                        <td>{{ $debt->about }}</td>
                                                        <td>{{ $debt->date }}</td>
                                                       
                                                    </tr>
                                                    @endforeach

                                                   

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    

                </div>
            </div> <!-- end sales -->
        </div> <!-- end row -->

        


    </div> <!-- container-fluid -->
</div>

@endsection