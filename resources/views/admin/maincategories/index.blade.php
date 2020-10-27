@extends('layouts.admin')

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">الأقسام الرئيسية </h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item active"> الأقسام الرئيسية
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                      <div class="col-12">
                        @include('admin.includes.alerts.success')
                        @include('admin.includes.alerts.errors')
                      </div>
                      <hr>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">الأقسام الرئيسية </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal text-center">
                                            <thead>
                                            <tr>
                                                <th>القسم</th>
                                                <th>اللغة</th>
                                                <th>الحالة</th>
                                                <th>صورة القسم</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                              @isset($rows)
                                                    @foreach($rows as $row)
                                                    <tr>
                                                        <td> {{$row->name}} </td>
                                                        <td> {{$row->translation_lang}} </td>
                                                        <td>{{$row->active}}</td>
                                                        <td><img src="{{$row->photo}}" width="50px" height="50px"></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                    <a href="{{route('admin.maincategories.edit', $row->id)}}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                                   <a href="{{route('admin.maincategories.delete', $row->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                   <a href="{{route('admin.maincategories.delete', $row->id)}}"
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">تفعيل</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                              @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
@endsection
