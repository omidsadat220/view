@extends('backend.master')
@section('body')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">گزارش مصارفات بر اساس ماه</h4>
            </div>
        </div>

        <!-- Datatables  -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5>ماه انتخاب شده: {{ request('month') }}</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered align-middle text-nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">نام</th>
                                        <th class="text-center">آخرین تاریخ</th>
                                        <th class="text-center">تعداد مصارف</th>
                                        <th class="text-center">مجموع مبلغ</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($expenses->values() as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>

                                        <td class="text-center fw-semibold">
                                            {{ $item->employee_id ? ($item->employee->name ?? 'N/A') : 'Shop' }}
                                        </td>

                                        <td class="text-center">{{ $item->last_date }}</td>

                                        <td class="text-center">
                                            <span class="badge bg-info">
                                                {{ $item->total_expenses }}
                                            </span>
                                        </td>

                                        <td class="text-center text-primary fw-bold">
                                            {{ number_format($item->total_amount,2) }}
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('all.expenses.invoice', [
                                                    'employee_id' => $item->employee_id ?: 0,
                                                    'month' => request('month')  // این اضافه شد
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
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        @if($expenses->count())
        <div class="row mt-2">
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-start" dir="rtl">
                            <div class="p-4 shadow-sm rounded text-end w-100" 
                                style="background:#f8f9fa; border-right:4px solid #0d6efd;">

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">تعداد کارمندان:</span>
                                    <strong>{{ $expenses->count() }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">مجموع پرداختی‌ها:</span>
                                    <strong>{{ number_format($monthlyTotal,2) }}</strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">مبلغ نهایی:</h5>
                                    <h5 class="fw-bold text-primary mb-0">
                                        {{ number_format($monthlyTotal,2) }}
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif

    </div> <!-- container-xxl -->

</div> <!-- content -->

@endsection