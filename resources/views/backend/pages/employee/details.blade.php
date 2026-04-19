@extends('backend.master')
@section('body')

<div class="content mt-4">
    <div class="container-xxl">

        <div class="row">

            <!-- Left Side - Employee Info -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">جزئیات کارمند</h4>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">نام</th>
                                <td>{{ $emp->name }}</td>
                            </tr>

                            <tr>
                                <th>تخلص</th>
                                <td>{{ $emp->lname }}</td>
                            </tr>

                            <tr>
                                <th>ولایت</th>
                                <td>{{ $emp->province }}</td>
                            </tr>

                            <tr>
                                <th>ایمیل</th>
                                <td>{{ $emp->email }}</td>
                            </tr>

                            <tr>
                                <th>شماره تماس</th>
                                <td>{{ $emp->phone }}</td>
                            </tr>

                            <tr>
                                <th>نمبر تذکره</th>
                                <td>{{ $emp->national_id }}</td>
                            </tr>
                        </table>

                        <h5 class="mb-3"> مصارف </h5>

                        <table class="table table-bordered">
                           

                            <tr>
                                <th>مصارف کارمند</th>
                                <td>{{ number_format($employeeCharges) }}</td>
                            </tr>

                        </table>

                        <a href="{{ route('all.employee') }}" class="btn btn-secondary mt-3">
                            بازگشت
                        </a>

                    </div>
                </div>
            </div>

            


            <!-- Right Side - Employee Image -->
            <div class="col-md-4 my-auto">
                <div class="card">
                    <div class="card-body text-center">

                        @if($emp->photo)
                            <img src="{{ asset($emp->photo) }}" 
                                 class="img-fluid rounded" 
                                 style="max-height:350px; object-fit:cover;">
                        @else
                            <p>عکس موجود نیست</p>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        {{-- Monthly Expenses --}}
        <div class="row">
            <div class="col-12">
                @if(isset($expenses) && $expenses->count())
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">مصارف ماه جاری </h5>
                        </div>
                        <div class="card-body table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">تاریخ</th>
                                        <th class="text-center">نوع</th>
                                        <th class="text-center">مقدار</th>
                                        <th class="text-center">عنوان</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $key => $expense)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $expense->date }}</td>
                                        <td class="text-center">
                                            @if($expense->type == 'withdraw')
                                                برداشت
                                            @elseif($expense->type == 'employee')
                                                هزینه کارمند
                                            @else
                                                هزینه دکان
                                            @endif
                                        </td>
                                        <td class="text-center">{{ number_format($expense->amount,2) }}</td>
                                        <td class="text-center">{{ $expense->title }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-center">مجموع</th>
                                        <th colspan="2" class="text-center">{{ number_format($expensesTotal,2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Monthly Sales --}}
        <div class="row">
            <div class="col-12">
                @if(isset($allSales) && $allSales->count())
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">فاکتور فروش ماه جاری</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered align-middle text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">محصول</th>
                                        <th class="text-center">دسته</th>
                                        <th class="text-center">تعداد</th>
                                        <th class="text-center">قیمت خرید</th>
                                        <th class="text-center">قیمت فروش</th>
                                        <th class="text-center">مصارف</th>
                                        <th class="text-center">سود</th>
                                        <th class="text-center">تاریخ</th>
                                        <th class="text-center">وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $grand_total = 0; 
                                        $grand_quantity = 0; 
                                        $grand_profit = 0;
                                        $grand_charges = 0;
                                        $grand_net_profit = 0; 
                                    @endphp
                                    @foreach ($allSales as $key => $sale)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $sale->product->name ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $sale->category->name ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $sale->quantity }}</td>
                                        <td class="text-center">{{ number_format($sale->buy_price ?? 0,2) }}</td>
                                        <td class="text-center">{{ number_format($sale->sale_price,2) }}</td>
                                        <td class="text-center">{{ number_format($sale->charges ?? 0,2) }}</td>
                                        <td class="text-center">
                                            @if($sale->status == 'completed')
                                                {{ number_format(($sale->sale_price ?? 0) - ($sale->buy_price ?? 0) - ($sale->charges ?? 0), 2) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($sale->date)->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            @if($sale->status == 'completed')
                                                <span class="badge bg-success">تکمیل شده</span>
                                            @elseif($sale->status == 'pending')
                                                <span class="badge bg-warning text-dark">در انتظار</span>
                                            @elseif($sale->status == 'cancelled')
                                                <span class="badge bg-danger">لغو شده</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $grand_total += ($sale->status == 'completed' ? $sale->sale_price : 0);
                                        $grand_quantity += ($sale->status == 'completed' ? $sale->quantity : 0);
                                        $grand_profit += ($sale->status == 'completed' ? ($sale->sale_price - $sale->buy_price - ($sale->charges ?? 0)) : 0);
                                        $grand_charges += $sale->charges ?? 0;
                                        $grand_net_profit += ($sale->status == 'completed' ? ($sale->sale_price - $sale->buy_price - ($sale->charges ?? 0)) : 0);
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-center">مجموعه:</th>
                                        <th class="text-center">{{ $grand_quantity }}</th>
                                        <th class="text-center">{{ number_format($grand_total,2) }}</th>
                                        <th class="text-center">{{ number_format($grand_total,2) }}</th>
                                        <th class="text-center">{{ number_format($grand_charges,2) }}</th>
                                        <th colspan="3" class="text-center">{{ number_format($grand_net_profit - ($pendingCharges ?? 0) - ($cancelledCharges ?? 0), 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>


        {{-- Monthly Sponsors --}}
        <div class="row">
            <div class="col-12">
                @if(isset($sponsors) && $sponsors->count())
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">اسپانسر ماه جاری</h5>
                        </div>
                        <div class="card-body table-responsive">

                            <table class="table table-bordered align-middle text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">محصول</th>
                                        <th class="text-center">مبلغ</th>
                                        <th class="text-center">تاریخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sponsors as $key => $sponser)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $sponser->product->name ?? $sponser->product }}</td>
                                        <td class="text-center">{{ number_format($sponser->amount,2) }}</td>
                                        <td class="text-center">{{ $sponser->date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-center">مجموع</th>
                                        <th colspan="2" class="text-center">{{ number_format($sponsorTotal,2) }}</th>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection