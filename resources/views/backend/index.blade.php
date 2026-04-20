@extends('backend.master')
@section('body')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1 d-flex align-items-center gap-2">
                <i class="fa-solid fa-house icon" style="color: #F5C542;"></i><h4 class="fs-18 fw-semibold m-0">صفحه اصلی</h4>
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
                                <div class="fs-14 mb-1"><i class="fa-solid fa-money-bill-wave" style="color: #F5C542; margin-left:10px"></i> آمد مکمل ماه </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalStock) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total totalPaied -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-money-bill-transfer icon" style="color: #F5C542; margin-left:10px"></i> پیش پرداخت ها </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-chart-line icon" style="color: #F5C542; margin-left:10px"></i> مصرف </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-wallet icon" style="color: #F5C542; margin-left:10px"></i> پول موجودی   </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalPaied - $totalExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                      <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-users icon" style="color: #F5C542; margin-left:10px"></i> پول باقی مانده بالای مشتریان   </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalStock - $totalPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1" style="color: 062A29"><i class="fa-solid fa-users icon" style="color: #062A29; margin-left:10px"></i>    </div>
                                <div class="fs-22 fw-semibold text-primary" style="color: #062A29;  ">
                                  
                                    <h5 style="color: #062A29 display: none" >
                                        محافل هوتل تاج
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body" style="background-color:#f5c542">
                                <div class="fs-14 mb-1 fw-semibold" style="color: #062A29; " > <i class="fa-solid fa-money-bill-trend-up icon" style="color: #062A29; margin-left:10px"></i> عاید خالص   </div>
                                <div class="fs-22 fw-semibold" style="color: #062A29" >
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
                                <div class="fs-14 mb-1"><i class="fa-solid fa-box-open icon" style="color: #F5C542; margin-left:10px"></i>  آمد مکمل محافل بیرونی </div>
                                <div class="fs-22 fw-semibold" style="color: #062A29">
                                    {{ number_format($totalOutStock) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Total totalPaied -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-box-open icon" style="color: #F5C542; margin-left:10px"></i>  پیش پرداخت محافل بیرونی </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalOutPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Total totalPaied -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-box-open icon" style="color: #F5C542; margin-left:10px"></i>  مصارف محافل بیرونی </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalOutExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body" style="background-color:#f5c542">
                                <div class="fs-14 mb-1 fw-semibold " style="color:#062A29"; ><i class="fa-solid fa-coins" style="color: color: #062A29; margin-left:10px"></i> پول موجودی   </div>
                                <div class="fs-22 fw-semibold" style="color: #062A29">
                                    {{ number_format($totalOutPaied - $totalOutExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-users icon" style="color: #F5C542; margin-left:10px"></i> پول باقی مانده بالای مشتریان بیرونی   </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalOutStock - $totalOutPaied) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1" style="color: 062A29"><i class="fa-solid fa-users icon" style="color: #062A29; margin-left:10px"></i>    </div>
                                <div class="fs-22 fw-semibold text-primary" style="color: #062A29;  ">
                                  
                                    <h5 style="color: #062A29 display: none" >
                                        محافل بیرونی
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1"><i class="fa-solid fa-box-open icon" style="color: #F5C542; margin-left:10px"></i>  عاید خالص محافل بیرونی   </div>
                                <div class="fs-22 fw-semibold" style="color: #F5C542">
                                    {{ number_format($totalOutPaied - $totalOutExpenses) }}
                                </div>
                            </div>
                        </div>
                    </div>


                       <div class="col-md-12 col-xl-12">
                                <div class="card overflow-hidden">
                                    
                                    <div class="card-header" style="background-color:#062A29">
                                        <div class="d-flex align-items-center">
                                            <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                                <i data-feather="table" class="widgets-icons"  style="color:#eee"></i>
                                            </div>
                                            <h5 class="card-title mb-0" style="color:#eee"><i class="fa-solid fa-file-invoice-dollar icon" style="color: #F5C542; margin-left:10px"></i> لیست قرض دفتر </h5>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-traffic table-bordered border-primary mb-0">
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