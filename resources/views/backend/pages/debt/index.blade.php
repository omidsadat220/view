@extends('backend.master')
@section('body')

<div class="content">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">لیست قرض ها</h4>
            </div>

            <div class="text-end">
                <a href="{{ route('add.debt') }}" class="btn btn-secondary">
                    افزودن قرض جدید
                </a>
            </div>
        </div>

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
                                        <th class="text-center">تاریخ</th>
                                        <th class="text-center">توضیحات</th>
                                        <th class="text-center">نام</th>
                                        <th class="text-center">مقدار قرض</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($expenses as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key+1 }}</td>
                                            <td class="text-center">{{ $item->date }}</td>
                                            <td class="text-center">{{ $item->about }}</td>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">
                                                <span class="badge text-bg-danger">
                                                    {{ $item->price }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('edit.debt',$item->id) }}" class="btn btn-success btn-sm">
                                                    ویرایش
                                                </a>
                                                <a href="{{ route('delete.debt',$item->id) }}" class="btn btn-danger btn-sm delete-confirm" id="delete">
                                                    حذف
                                                </a>
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

    </div>

</div>

@endsection