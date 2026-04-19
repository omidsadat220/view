@extends('backend.master')
@section('body')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">فروشات</h4>
                            </div>
            
                            {{-- <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <a href="{{ route('add.employee') }}" class="btn btn-secondary">اضافه کردن کارمند</a>
                                </ol>
                            </div> --}}
                        </div>

                        <!-- Datatables  -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        
                                    </div><!-- end card header -->

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered align-middle text-nowrap w-100">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">اسم محصول</th>
                            <th class="text-center">اسم کارمند</th>
                            <th class="text-center">مقدار جنس</th>
                            {{-- <th class="text-center">قیمت خرید</th> --}}
                            <th class="text-center">قیمت فروش</th>
                            <th class="text-center">مصارف و کرایه</th>
                            <th class="text-center">نمبر بل</th>
                            <th class="text-center">حالت</th>
                            <th class="text-center">مفاد</th>
                            <th class="text-center">مجموعه</th>
                            {{-- <th class="text-center">مجموعه</th> --}}
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $item->product->name ?? '' }}</td>
                                    <td class="text-center">{{ $item->employee->name ?? '' }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    {{-- <td class="text-center">{{ $item->buy_price }}</td> --}}
                                    <td class="text-center">{{ $item->sale_price }}</td>
                                    <td class="text-center">{{ $item->charges }}</td>
                                    <td class="text-center">{{ $item->bill }}</td>
                                    <td class="text-center">
                                        @if($item->status == 'pending')
                                            <span class="badge text-bg-warning">در انتظار</span>

                                        @elseif($item->status == 'completed')
                                            <span class="badge text-bg-success">تکمیل شده</span>

                                        @elseif($item->status == 'cancelled')
                                            <span class="badge text-bg-danger">لغو شده</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->profit < $item->buy_price)
                                            <span class="badge text-bg-danger">{{ $item->profit }}</span>
                                            @else
                                            <h4>
                                                <span class="badge text-bg-primary">{{ $item->profit }}</span>
                                            </h4>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">{{ $item->total }}</td> --}}
                                    <td class="text-center">
                                        @if ($item->total <= $item->price)
                                            <span class="badge text-bg-danger">{{ $item->total }}</span>
                                            @else
                                            <h4>
                                                <span class="badge text-bg-secondary">{{ $item->total }}</span>
                                            </h4>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a title="Details" href="{{ route('details.sales',$item->id) }}" class="btn btn-info btn-sm"> <span class="mdi mdi-eye-circle mdi-18px"></span> </a>
                                        <a title="Edit" href="{{ route('edit.sales', $item->id) }}" class="btn btn-success btn-sm"> <span class="mdi mdi-book-edit mdi-18px"></span> </a>
                                        <a title="Delete" href="{{ route('delete.sales', $item->id) }}" class="btn btn-danger btn-sm delete-confirm" id="delete"><span class="mdi mdi-delete-circle  mdi-18px"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            
                                </div>
                            </div>
                        </div>


                    </div> <!-- container-fluid -->

                </div> <!-- content -->

@endsection