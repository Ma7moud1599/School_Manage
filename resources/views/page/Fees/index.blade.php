@extends('layouts.master')
@section('css')
@section('title')
{{trans('Fees.study_fees')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Fees.study_fees')}}@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('Fees.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('Fees.Add_new_fees')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Fees.name')}}</th>
                                            <th>{{trans('Fees.the_amount')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.academic_year')}}</th>
                                            <th>{{trans('grades_trans.Notes') }}</th>
                                            <th>{{trans('grades_trans.Processes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fees as $fee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee->title}}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{$fee->grade->Name}}</td>
                                            <td>{{$fee->classroom->Name_class}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->description}}</td>
                                            <td>
                                                <a href="{{route('Fees.edit',$fee->id)}}" class="btn btn-info btn-sm"
                                                    role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#Delete_Fee{{ $fee->id }}"
                                                    title="{{ trans('grades_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                                <a href="#" class="btn btn-warning btn-sm" role="button"
                                                    aria-pressed="true"><i class="far fa-eye"></i></a>

                                            </td>
                                        </tr>
                                        @include('page.Fees.Delete')
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection