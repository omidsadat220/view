@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl my-4">

        <div class="d-md-flex align-items-center justify-content-between mb-4">
            <h3 class="fs-18 fw-semibold m-0">جزئیات فروش</h3>
            <a href="{{ route('all.sales') }}" class="btn btn-outline-primary">بازگشت</a>
        </div>

        {{-- Product Info --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">محصول</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>نام محصول:</strong> {{ $sale->product->name ?? '-' }}</p>
                        <p><strong>دسته بندی:</strong> {{ $sale->category->name ?? '-' }}</p>
                        <p><strong>مقدار:</strong> {{ $sale->quantity }}</p>
                    </div>
                </div>
            </div>

            {{-- Employee Info --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">کارمند</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>اسم کارمند:</strong> {{ $sale->employee->name ?? '-' }}</p>
                        <p><strong>ولایت:</strong> {{ $sale->province ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Sale Info --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">اطلاعات فروش</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>قیمت خرید:</strong> {{ number_format($sale->buy_price, 2) }}</p>
                        <p><strong>قیمت فروش:</strong> {{ number_format($sale->sale_price, 2) }}</p>
                        <p><strong>مصارف و کرایه:</strong> {{ number_format($sale->charges, 2) }}</p>
                        <p><strong>سود:</strong> {{ number_format($sale->profit, 2) }}</p>
                        <p><strong>مجموعه:</strong> {{ number_format($sale->total, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order Summary Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">خلاصه سفارش</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام محصول</th>
                                    <th>مقدار</th>
                                    <th>قیمت واحد</th>
                                    <th>مصارف</th>
                                    <th>مجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $sale->product->name ?? '-' }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ number_format($sale->sale_price, 2) }}</td>
                                    <td>{{ number_format($sale->charges, 2) }}</td>
                                    <td>{{ number_format($sale->total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection