@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl">
        
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">مشاهده قرارداد: {{ $product->name }} {{ $product->lastname }}</h4>
            </div>
            
            <div class="text-end">
                <a href="{{ route('all.products') }}" class="btn btn-secondary">بازگشت</a>
                {{-- <a href="{{ route('product.pdf', $product->id) }}" class="btn btn-danger" target="_blank">
                    <i class="bx bxs-file-pdf"></i> پرینت PDF
                </a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title text-white mb-0">اطلاعات کامل قرارداد</h5>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <!-- Personal Information -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">اطلاعات شخصی</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="35%">مسلسل بل:</th>
                                        <td>{{ $product->bellnumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>اسم:</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>شماره تماس:</th>
                                        <td>{{ $product->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>خدمات و کرایه</th>
                                        <td>
                                            @if($product->categories && count($product->categories) > 0)
                                                @foreach($product->categories as $category)
                                                    <span class="badge bg-primary m-1">{{ $category->name }},{{ $category->price }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- Wedding Information -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">اطلاعات محفل</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="35%">هوتل:</th>
                                        <td>{{ $product->hall }}</td>
                                    </tr>
                                    <tr>
                                        <th>صالون:</th>
                                        <td>{{ $product->room }}</td>
                                    </tr>
                                    <tr>
                                        <th>تاریخ محفل:</th>
                                        <td>{{ \Carbon\Carbon::parse($product->date)->format('Y-m-d') }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- Financial Information -->
                            <div class="col-md-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">اطلاعات مالی</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6>مبلغ مجموع  </h6>
                                                <h4 class="text-primary">{{ number_format($product->price) }} AFN</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($product->tax == 45)
                                        <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6>مبلغ سهم هوتل تاج %45 </h6>
                                                <h4 class="text-success">{{ number_format($product->tax * $product->price / 100) }} AFN</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                      <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6> مبلغ سهم بیرونی </h6>
                                                <h4 class="text-success">{{ number_format($product->tax * $product->price / 100) }} AFN</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    
                                    

                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6>مبلغ پرداخت شده</h6>
                                                <h4 class="text-success">{{ number_format($product->paied) }} AFN</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6>مبلغ باقی مانده</h6>
                                                <h4 class="text-danger">{{ number_format($product->remaining) }} AFN</h4>
                                            </div>
                                        </div>
                                    </div>

                                     @php
                                        $total = $product->categories->sum('price');

                                        $paid = $product->paied ?? 0;

                                        // ❌ removed tax calculation
                                        // ✅ now using paid directly
                                        $paidAfterTax = $product->paied ?? 0;

                                        $remaining = $paidAfterTax - $total;
                                    @endphp

                                        <div class="col-md-12">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6>مبلغ پرداخت شده</h6>
                                                    <h4 class="text-success">
                                                        {{ number_format($paidAfterTax) }} AFN
                                                    </h4>
                                                </div>

                                                @if($product->categories && count($product->categories) > 0)
                                                    @foreach($product->categories as $category)
                                                        <div class="d-flex justify-content-between border-bottom py-1 px-2">
                                                            <span>{{ $category->name }}</span>
                                                            <span class="text-danger">{{ number_format($category->price) }} AFN</span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-secondary">-</span>
                                                @endif

                                                <span class="badge">
                                              <h1>   AFN {{ number_format($total) }}</h1>
                                                </span>

                                                <div class="card-body text-center">
                                                    <h6>مجموع خالص مبلغ</h6>
                                                    <h4 class="text-success">
                                                        {{ number_format($remaining) }} AFN
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                        
                                       


                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-12">
                            <div class="col-12 text-center">
                                <button onclick="window.print()" class="btn btn-secondary">
                                    <i class="bx bx-printer"></i> پرینت صفحه
                                </button>
                                {{-- <a href="{{ route('product.pdf', $product->id) }}" class="btn btn-danger" target="_blank">
                                    <i class="bx bxs-file-pdf"></i> دانلود PDF
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
    @media print {
        .btn, .text-end, .card-header .btn {
            display: none !important;
        }
        .card {
            border: none !important;
        }
        .bg-light {
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

@endsection