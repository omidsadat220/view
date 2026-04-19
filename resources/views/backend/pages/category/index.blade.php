@extends('backend.master')
@section('body')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">صفحه  لیست خدمات </h4>
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
                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">خدمات و کرایه</th>
                        <th class="text-center">قیمت</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=> $item)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->price }}</td>
                                <td class="text-center">
                                    <a href="{{ route('edit.category', $item->id) }}" class="btn btn-success btn-sm">ویرایش</a>
                                    <a href="{{ route('delete.category', $item->id) }}" id="delete" class="btn btn-danger btn-sm delete-confirm">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                                </div>
                            </div>
                        </div>


                    </div> <!-- container-fluid -->

                </div> <!-- content -->

@endsection