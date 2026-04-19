@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl my-4">

        <div class="d-md-flex align-items-center justify-content-between mb-4">
            <h3 class="fs-18 fw-semibold m-0">
                جزییات مصارف {{ $expenses->first()->employee->name ?? 'دوکان' }}:
            </h3>
            {{-- <a href="{{ route('all.expenses') }}" class="btn btn-outline-primary">بازگشت</a> --}}
        </div>

        {{-- Expense Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">خلاصه هزینه</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered align-middle text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام کارمند</th>
                                        <th>تاریخ</th>
                                        <th>نوع مصرف</th>
                                        <th>مقدار</th>
                                        <th>عنوان  </th>
                                        <th>توضیحات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($expenses as $key => $expense)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $expense->employee->name ?? 'دوکان' }}</td>
                                        <td>{{ $expense->date }}</td>
                                        <td>
                                            @if($expense->type == 'withdraw')
                                                برداشت
                                            @elseif($expense->type == 'employee')
                                                هزینه کارمند
                                            @else
                                                هزینه دکان
                                            @endif
                                        </td>
                                        <td>{{ number_format($expense->amount, 2) }}</td>
                                        <td>
                                            {{ $expense->title }}
                                        </td>
                                        <td>
                                            {{ $expense->note }}
                                        </td>
                                    </tr>
                                    @php $total += $expense->amount; @endphp
                                    @endforeach
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
                                        <span class="text-muted">تعداد مصارف:</span>
                                        <strong>{{ $expenses->count() }}</strong>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">مجموع پرداختی‌ها:</span>
                                        <strong>{{ number_format($total,2) }}</strong>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0">مبلغ نهایی:</h5>
                                        <h5 class="fw-bold text-primary mb-0">
                                            {{ number_format($total,2) }}
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