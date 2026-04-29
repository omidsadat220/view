@extends('backend.master')
@section('body')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">کارمندان</h4>
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

                                   <!-- <div class="card-header">
                                        
                                    </div> end card header -->

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered align-middle text-nowrap w-100">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">تخلص</th>
                            <th class="text-center">معاش</th>
                            <th class="text-center">وظیفه</th>
                            <th class="text-center">شماره تماس</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $key=> $item)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->lname }}</td>
                                    <td class="text-center">{{ $item->salary }}</td>
                                    <td class="text-center">{{ $item->position }}</td>
                                    <td class="text-center">{{ $item->phone }}</td>
                                  
                                    <td>
                                        <a href="{{ route('edit.employee', $item->id) }}" class="btn btn-success btn-sm">ویرایش</a>
                                        <a href="{{ route('delete.employee', $item->id) }}" id="delete" class="btn btn-danger btn-sm delete-confirm">حذف</a>
                                        <a href="{{ route('details.employee', $item->id) }}" id="details" class="btn btn-primary btn-sm">جزییات</a>
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