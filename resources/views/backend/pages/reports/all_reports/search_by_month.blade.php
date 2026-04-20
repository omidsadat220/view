@extends('backend.master')
@section('body')
    <div class="content">
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">گزارش ماهانه {{ $month }}</h4>
                </div>
            </div>

            {{-- ---------------- Expenses Table ---------------- --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow-sm">

                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">گزارش مصارف</h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-expenses" class="table table-bordered align-middle text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">تاریخ</th>
                                            <th class="text-center">نام کارمند</th>
                                            <th class="text-center">تعداد مصارف</th>
                                            <th class="text-center">مجموع مبلغ</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dailyExpenses->values() as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $item->last_date }}</td>
                                                <td class="text-center">
                                                    @if ($item->all_expenses->first()->type == 'withdraw')
                                                        {{ $item->employee->name ?? 'N/A' }}
                                                    @elseif($item->employee_id)
                                                        {{ $item->employee->name ?? 'N/A' }}
                                                    @else
                                                        دوکان
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $item->total_expenses }}</td>
                                                <td class="text-center">{{ number_format($item->total_amount, 2) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('all.expenses.invoice', [
                                                        'employee_id' => $item->employee_id ?: 0,
                                                        'month' => $month,
                                                    ]) }}"
                                                        class="btn btn-success btn-sm">
                                                        مشاهده مصارف
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">مصارفی وجود ندارد</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-center">مجموع مصارف:</th>
                                            <th colspan="2" class="text-center">
                                                {{ number_format($dailyExpensesTotal ?? 0, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ---------------- Products Tax 45 Table ---------------- --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">

                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">45 گزارش مالیه </h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-sales" class="table table-bordered align-middle text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>نام </th>
                                            <th> شماره تماس</th>
                                            <th>صالون</th>
                                            <th> اتاق</th>
                                            <th> دسته‌بندی</th>
                                            <th> قیمت</th>
                                            <th> پرداخت شده</th>
                                            <th> باقیمانده</th>
                                            <th>مالیه</th>
                                            {{-- <th>عملیات</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products->where('tax', 45) as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $item->name }}</td>
                                                <td class="text-center">{{ $item->lastname }}</td>
                                                <td class="text-center">{{ $item->hall }}</td>
                                                <td class="text-center">{{ $item->room }}</td>
                                                <td class="text-center">{{ $item->category->name ?? 'ناموجود' }}</td>
                                                <td class="text-center">{{ number_format($item->price, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->paied, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->remaining, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->tax, 2) }}</td>


                                                {{-- <td class="text-center">
                                                    <a href="{{ route('all.sales.invoice', [
                                                        'employee_id' => $sale->employee->id ?? 0,
                                                        'month' => $month,
                                                    ]) }}"
                                                        class="btn btn-success btn-sm">
                                                        مشاهده فروش‌ها
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot class="table-info">

                                        <tr>
                                            <th>مجموع</th>
                                            <th>پرداخت شده</th>
                                            <th>باقیمانده</th>
                                            <th>مالیه</th>

                                        </tr>
                                        <tr>
                                            <th>{{ number_format($products->where('tax', 45)->sum('price'), 2) }}</th>
                                            <th>{{ number_format($products->where('tax', 45)->sum('paied'), 2) }}</th>
                                            <th>{{ number_format($products->where('tax', 45)->sum('remaining'), 2) }}</th>
                                            <th>{{ number_format(45, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ---------------- Products Tax 35 Table ---------------- --}}

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">

                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">35 گزارش مالیه </h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-sales" class="table table-bordered align-middle text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>نام </th>
                                            <th> شماره تماس</th>
                                            <th>صالون</th>
                                            <th> اتاق</th>
                                            <th> دسته‌بندی</th>
                                            <th> قیمت</th>
                                            <th> پرداخت شده</th>
                                            <th> باقیمانده</th>
                                            <th>مالیه</th>
                                            {{-- <th>عملیات</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products->where('tax', 35) as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $item->name }}</td>
                                                <td class="text-center">{{ $item->lastname }}</td>
                                                <td class="text-center">{{ $item->hall }}</td>
                                                <td class="text-center">{{ $item->room }}</td>
                                                <td class="text-center">{{ $item->category->name ?? 'ناموجود' }}</td>
                                                <td class="text-center">{{ number_format($item->price, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->paied, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->remaining, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->tax, 2) }}</td>


                                                {{-- <td class="text-center">
                                                    <a href="{{ route('all.sales.invoice', [
                                                        'employee_id' => $sale->employee->id ?? 0,
                                                        'month' => $month,
                                                    ]) }}"
                                                        class="btn btn-success btn-sm">
                                                        مشاهده فروش‌ها
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot class="table-warning">

                                        <tr>
                                            <th>مجموع</th>
                                            <th>پرداخت شده</th>
                                            <th>باقیمانده</th>
                                            <th>مالیه</th>

                                        </tr>

                                        <tr>
                                            <th>{{ number_format($products->where('tax', 35)->sum('price'), 2) }}</th>
                                            <th>{{ number_format($products->where('tax', 35)->sum('paied'), 2) }}</th>
                                            <th>{{ number_format($products->where('tax', 35)->sum('remaining'), 2) }}</th>
                                            <th>{{ number_format(35, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>






            {{-- ---------------- Summary Card ---------------- --}}
            <div class="row mt-4">
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">

                    <div class="card shadow-sm w-100 border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">خلاصه راپور روزانه</h5>
                        </div>

                        <div class="card-body">

                            <div class="p-3 rounded" style="background:#f8f9fa;">

                                <div class="d-flex justify-content-between mb-2">
                                    <span>جمع قیمت :</span>
                                    <strong>{{ number_format($totalPrice, 2) }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>جمع پرداخت شده :</span>
                                    <strong>{{ number_format($totalPaid, 2) }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>جمع باقی مانده :</span>
                                    <strong>{{ number_format($totalRemaining, 2) }}</strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>پرداخت مالیه 35 :</span>
                                    <strong class="text-success">
                                        {{ number_format($totalPaid35, 2) }}
                                    </strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>پرداخت مالیه 45 :</span>
                                    <strong class="text-info">
                                        {{ number_format($totalPaid45, 2) }}
                                    </strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>جمع مصارف :</span>
                                    <strong class="text-danger">
                                        {{ number_format($dailyExpensesTotal, 2) }}
                                    </strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <span>مفاد نهایی :</span>

                                    <strong class="{{ $finalProfit >= 0 ? 'text-primary' : 'text-danger' }}">
                                        {{ number_format($finalProfit, 2) }}
                                    </strong>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
