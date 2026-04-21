@extends('backend.master')
@section('body')

<div class="container-fluid">

    <div class="row mb-4 d-flex justify-content-between align-items-center">
    <div class="col-md-12 text-center">
        <h3 class="fw-bold pt-4">📅 گزارش روزانه </h3>
        <p>{{ \Carbon\Carbon::today()->format('Y-m-d') }}</p>
    </div>
</div>

{{-- SUMMARY --}}
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow p-3 text-center">
            <h6>مجموع قیمت امروز</h6>
            <h3>{{ number_format($products->sum('price'), 2) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow p-3 text-center">
            <h6>مجموع پرداخت امروز</h6>
            <h3>{{ number_format($products->sum('paied'), 2) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow p-3 text-center">
            <h6>مجموع باقی‌مانده امروز</h6>
            <h3>{{ number_format($products->sum('remaining'), 2) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow p-3 text-center">
            <h6>مجموع مفاد امروز</h6>
            <h3>{{ number_format($products->sum('tax'), 2) }}</h3>
        </div>
    </div>

</div>



   


    {{-- ---------------- Products Tax 45 Table ---------------- --}}

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm">

            <div class="card-header bg-info text-white">
                <h5 class="mb-0">گزارش روزانه  (سهم 45)</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="datatable-products"
                        class="table table-bordered align-middle text-nowrap w-100">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>هوتل</th>
                                <th>صالون</th>
                                <th>قیمت</th>
                                <th>پرداخت شده</th>
                                <th>باقیمانده</th>
                                <th>سهم</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($products->where('tax', 45)->values() as $key => $item)
                                <tr>

                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->lastname }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->hall }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->room }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($item->price, 2) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($item->paied, 2) }}
                                    </td>

                                    <td class="text-center text-danger fw-bold">
                                        {{ number_format($item->remaining, 2) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($item->tax, 2) }}
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger">
                                        محصولی موجود نیست
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                        <tfoot class="table-info">

                            <tr>
                                <th colspan="5" class="text-center">
                                    مجموع
                                </th>

                                <th class="text-center">
                                    {{ number_format($products->where('tax', 45)->sum('price'), 2) }}
                                </th>

                                <th class="text-center">
                                    {{ number_format($products->where('tax', 45)->sum('paied'), 2) }}
                                </th>

                                <th class="text-center text-danger">
                                    {{ number_format($products->where('tax', 45)->sum('remaining'), 2) }}
                                </th>

                                <th class="text-center">
                                    {{ number_format(45, 2) }}
                                </th>

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

            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">گزارش روزانه  (سهم 35)</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="datatable-products-35"
                        class="table table-bordered align-middle text-nowrap w-100">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>هوتل</th>
                                <th>صالون</th>
                                <th>قیمت</th>
                                <th>پرداخت شده</th>
                                <th>باقیمانده</th>
                                <th>سهم</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($products->where('tax', 35)->values() as $key => $item)
                                <tr>

                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->lastname }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->hall }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->room }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($item->price, 2) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($item->paied, 2) }}
                                    </td>

                                    <td class="text-center text-danger fw-bold">
                                        {{ number_format($item->remaining, 2) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($item->tax, 2) }}
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger">
                                        محصولی موجود نیست
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                        <tfoot class="table-warning">

                            <tr>
                                <th colspan="5" class="text-center">
                                    مجموع
                                </th>

                                <th class="text-center">
                                    {{ number_format($products->where('tax', 35)->sum('price'), 2) }}
                                </th>

                                <th class="text-center">
                                    {{ number_format($products->where('tax', 35)->sum('paied'), 2) }}
                                </th>

                                <th class="text-center text-danger">
                                    {{ number_format($products->where('tax', 35)->sum('remaining'), 2) }}
                                </th>

                                <th class="text-center">
                                    {{ number_format(35, 2) }}
                                </th>

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