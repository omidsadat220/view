@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl my-4">

        <div class="d-md-flex align-items-center justify-content-between mb-4">
            <h3 class="fs-18 fw-semibold m-0">
               جزییات اسپانسر {{ $sponsors->first()->employee->name ?? '' }}:
            </h3>
            {{-- <a href="{{ route('all.expenses') }}" class="btn btn-outline-primary">بازگشت</a> --}}
        </div>

        {{-- Expense Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                        <h5 class="mb-0 fw-bold">خلاصه اسپانسر</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered align-middle text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">نام کارمند</th>
                                        <th class="text-center">محصول</th>
                                        <th class="text-center">مبلغ</th>
                                        <th class="text-center">تاریخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($sponsors as $key => $sponser)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $sponser->employee->name ?? 'دوکان' }}</td>
                                        <td class="text-center">{{ $sponser->product->name ?? $sponser->product }}</td>
                                        <td class="text-center">{{ number_format($sponser->amount,2) }}</td>
                                        <td class="text-center">{{ $sponser->date }}</td>
                                    </tr>
                                    @php $total += $sponser->amount; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($sponsors->count())
            <div class="row mt-2">
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start" dir="rtl">
                                <div class="p-4 shadow-sm rounded text-end w-100" 
                                    style="background:#f8f9fa; border-right:4px solid #0d6efd;">

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">تعداد اسپانسر:</span>
                                        <strong>{{ $sponsors->count() }}</strong>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">مجموع پرداختی‌ها:</span>
                                        <strong>{{ number_format($total,2) }}</strong>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0">مبلغ نهایی:</h5>
                                        <h5 class="fw-bold text-primary mb-0">
                                            <strong>{{ number_format($total,2) }}</strong>
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