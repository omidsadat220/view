@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">گزارش روزانه {{ $date }}</h4>
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
                                            @if($item->all_expenses->first()->type == 'withdraw')
                                                {{ $item->employee->name ?? 'N/A' }}
                                            @elseif($item->employee_id)
                                                {{ $item->employee->name ?? 'N/A' }}
                                            @else
                                                دوکان
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->total_expenses }}</td>
                                        <td class="text-center">{{ number_format($item->total_amount,2) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('all.expenses.invoice', [
                                                'employee_id' => $item->employee_id ?: 0,
                                                'date' => $item->last_date
                                            ]) }}" class="btn btn-success btn-sm">
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
                                        <th colspan="2" class="text-center">{{ number_format($dailyExpensesTotal ?? 0,2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ---------------- Sales Table ---------------- --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">

                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">گزارش محفل</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-sales" class="table table-bordered align-middle text-nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>نام کارمند</th>
                                        <th>مجموع تعداد فروش</th>
                                        <th>مجموع فروش</th>
                                        <th>مجموع مصارف</th>
                                        <th>سود</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as  $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->phone }}</td>
                                            <td class="text-center">{{ $item->hall }}</td>
                                            <td class="text-center">{{ $item->room }}</td>
                                            <td class="text-center">{{ $item->category->name ?? 'ناموجود' }}</td>
                                            <td class="text-center">{{ number_format($item->price, 2) }}</td>
                                            <td class="text-center">{{ number_format($item->paied, 2) }}</td>
                                            <td class="text-center">{{ number_format($item->remaining, 2) }}</td>
                                            <td class="text-center">{{ number_format($item->tax, 2) }}</td>
                                            
                                            
                                            <td class="text-center">
                                                <a href="{{ route('all.sales.invoice', [
                                                        'employee_id' => $sale->employee->id ?? 0,
                                                        'date' => $date
                                                    ]) }}" 
                                                    class="btn btn-success btn-sm">
                                                    مشاهده فروش‌ها
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
    <th class="text-center">مجموعه:</th>

    <th class="text-center">
        {{ number_format($products->sum('price'), 2) }}
    </th>

    <th class="text-center">
        {{ number_format($products->sum('paied'), 2) }}
    </th>

    <th class="text-center">
        {{ number_format($products->sum('remaining'), 2) }}
    </th>

    <th class="text-center">
        {{ number_format($products->sum('tax'), 2) }}
    </th>
</tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ---------------- Sponsors Table ---------------- --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">گزارش اسپانسر ها (Sponsers)</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-sponsors" class="table table-bordered align-middle text-nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">اسم کارمند</th>
                                        <th class="text-center">محصول</th>
                                        <th class="text-center">تعداد اسپانسر</th>
                                        <th class="text-center">مبلغ</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sponsors as $key => $sponser)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $sponser->employee->name ?? 'دوکان' }}</td>
                                            <td class="text-center">{{ $sponser->product->name ?? $sponser->product }}</td>
                                            <td class="text-center">{{ $sponser->sponsor_quantity }}</td>
                                            <td class="text-center">{{ number_format($sponser->amount,2) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('all.sponsors.invoice', [
                                                        'employee_id' => $sponser->employee->id ?? 0,
                                                        'date' => $date
                                                    ]) }}" 
                                                    class="btn btn-success btn-sm">
                                                    مشاهده اسپانسر
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">اسپانسری وجود ندارد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-center">مجموع اسپانسر ها:</th>
                                        <th colspan="2" class="text-center">{{ number_format($sponsorsTotal ?? 0,2) }}</th>
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
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="p-4 shadow-sm rounded text-end w-100" style="background:#f8f9fa; border-right:4px solid #0d6efd;">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">جمع سود واقعی :</span>
                                <strong>{{ number_format($dailySales->sum(fn($s) => $s->profit - $s->total_charges),2) }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">جمع اسپانسرها :</span>
                                <strong>{{ number_format($sponsorsTotal,2) }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">جمع مصارف :</span>
                                <strong>{{ number_format($dailyExpensesTotal,2) }}</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">مفاد نهایی :</span>
                               @php
                                $realProfit = $dailySales->sum(fn($s) => $s->profit - $s->total_charges);
                                $final = $realProfit - $sponsorsTotal - $dailyExpensesTotal;
                                @endphp

                                <strong class="{{ $final >= 0 ? 'text-primary' : 'text-danger' }}">
                                    {{ number_format($final,2) }}
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