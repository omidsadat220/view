@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl my-4">

        <div class="d-md-flex align-items-center justify-content-between mb-4">
            <h3 class="fs-18 fw-semibold m-0">
               جزییات فروش {{ $employee->name ?? '' }}:
            </h3>
        </div>

        {{-- Sales Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" 
                        style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">خلاصه فروش</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @php 
                                $grand_total = 0; 
                                $grand_quantity = 0; 
                                $grand_profit = 0;
                                $grand_charges = 0;
                                $grand_buy_price = 0;
                                $grand_net_profit = 0; 
                            @endphp
                            <table id="datatable-sale-invoice" class="table table-bordered align-middle text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">نام کارمند</th>
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
                                    @foreach ($sales as $key => $sale)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $sale->employee->name ?? 'N/A' }}</td>
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
                                        $grand_buy_price += ($sale->status == 'completed' ? $sale->buy_price : 0);
                                        $grand_net_profit += ($sale->status == 'completed' ? ($sale->sale_price - $sale->buy_price - ($sale->charges ?? 0)) : 0);
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" colspan="4">مجموعه:</th>
                                        <th class="text-center">{{ $grand_quantity }}</th>
                                        <th class="text-center">{{ number_format($grand_buy_price,2) }}</th>
                                        <th class="text-center">{{ number_format($grand_total,2) }}</th>
                                        <th class="text-center">{{ number_format($grand_charges,2) }}</th>
                                        <th class="text-center" colspan="3">{{ number_format($grand_net_profit, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary Card --}}
        @if($sales->count())
        <div class="row mt-2">
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start" dir="rtl">
                            <div class="p-4 shadow-sm rounded text-end w-100" 
                                style="background:#f8f9fa; border-right:4px solid #0d6efd;">

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">جمع تعداد فروشات:</span>
                                    <strong>{{ $grand_quantity }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">جمع فروشات:</span>
                                    <strong>{{ number_format($grand_total,2) }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">جمع سود:</span>
                                    <strong>{{ number_format($grand_net_profit,2) }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">جمع مصارف :</span>
                                    <strong>{{ number_format($grand_charges,2) }}</strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">سود خالص:</h5>
                                    <h5 class="fw-bold text-primary mb-0">
                                        <strong>{{ number_format($grand_net_profit - ($pendingCharges ?? 0) - ($cancelledCharges ?? 0),2) }}</strong>
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection