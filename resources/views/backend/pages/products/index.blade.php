@extends('backend.master')
@section('body')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">صفحه لیست محفل ها </h4>
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
                                        <th class="text-center">  شماره مسلسل </th>
                                        <th class="text-center">اسم</th>
                                        <th class="text-center">شماره تماس</th>
                                        <th class="text-center">هوتل</th>
                                        <th class="text-center">صالون</th>
                                        <th class="text-center"> تاریخ محفل</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $key=> $item)
                                        <tr>
                                            @if ($item->remaining > 0)
                                            <td class="text-center" style="background-color: red">{{ $key+1 }}</td>
                                            @else
                                            <td class="text-center">{{ $key+1 }}</td>
                                            @endif
                                            <td class="text-center">{{ $item->bellnumber }}</td>

                                            
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->lastname }}</td>
                                            
                                            <td class="text-center">{{ $item->hall }}</td>
                                            <td class="text-center">{{ $item->room }}</td>
                                            <td class="text-center">{{ $item->date }}</td>
                                           
                                            <td class="text-center">
                                                 <a href="{{ route('view.products', $item->id) }}" class="btn btn-info btn-sm">مشاهده</a>
                                                <a href="{{ route('edit.products', $item->id) }}" class="btn btn-success btn-sm">ویرایش</a>
                                                <a href="{{ route('delete.products', $item->id) }}" id="delete" class="btn btn-danger btn-sm delete-confirm">حذف</a>
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