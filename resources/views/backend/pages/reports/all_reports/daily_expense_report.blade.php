@extends('backend.master')
@section('body')


<div class="container-fluid">

    {{-- TITLE --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="fw-bold">📊 گزارش مصارف روزانه</h3>
            <p>{{ \Carbon\Carbon::today()->format('Y-m-d') }}</p>
        </div>
    </div>


    {{-- SUMMARY CARD --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow p-3 text-center bg-danger text-white">
                <h5>مجموع مصارف امروز</h5>
                <h2>{{ number_format($dailyExpensesTotal, 2) }}</h2>
            </div>
        </div>
    </div>


    {{-- TABLE --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">لیست مصارف کارمندان</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered align-middle text-nowrap w-100">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>تاریخ</th>
                                    <th>نام کارمند / دوکان</th>
                                    <th>تعداد مصارف</th>
                                    <th>مجموع مبلغ</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($dailyExpenses->values() as $key => $item)

                                    <tr>

                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>

                                        <td class="text-center">
                                            {{ $item->last_date }}
                                        </td>

                                        <td class="text-center">

                                            @if ($item->employee_id && $item->employee)
                                                {{ $item->employee->name }}
                                            @else
                                                دوکان
                                            @endif

                                        </td>

                                        <td class="text-center">
                                            {{ $item->total_expenses }}
                                        </td>

                                        <td class="text-center text-danger fw-bold">
                                            {{ number_format($item->total_amount, 2) }}
                                        </td>

                                        <td class="text-center">

                                            <a href="{{ route('all.expenses.invoice', [
                                                'employee_id' => $item->employee_id ?: 0,
                                                'date' => $item->last_date,
                                            ]) }}"
                                               class="btn btn-success btn-sm">

                                                مشاهده

                                            </a>

                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            هیچ مصارف موجود نیست
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                            <tfoot class="table-dark">
                                <tr>
                                    <th colspan="4" class="text-center">
                                        مجموع کل
                                    </th>

                                    <th class="text-center">
                                        {{ number_format($dailyExpensesTotal, 2) }}
                                    </th>

                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>







@endsection