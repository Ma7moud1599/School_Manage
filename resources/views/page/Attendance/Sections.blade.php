@extends('layouts.master')
@section('css')
@section('title')
{{ trans('Section_trans.title_page') }} : {{ trans('Attendance.Attendance') }}

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('Section_trans.title_page') }} : {{ trans('Attendance.Attendance') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Section_trans.add_section') }}</a>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($grades as $Grade)

                        <div class="acd-group">
                            <a href="#" class="acd-heading">{{ $Grade->Name }}</a>
                            <div class="acd-des">

                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{ trans('Section_trans.Name_Section') }}</th>
                                                                <th>{{ trans('Section_trans.Name_Class') }}</th>
                                                                <th>{{ trans('Section_trans.Status') }}</th>
                                                                <th>{{ trans('Section_trans.Processes') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($Grade->sections as $list_sections)
                                                            <tr>
                                                                <?php $i++; ?>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $list_sections->Name_section }}</td>
                                                                <td>{{ $list_sections->section_class->Name_class }}</td>
                                                                <td>
                                                                    <label
                                                                        class="badge badge-{{$list_sections->Status == 1 ? 'success':'danger'}}">{{$list_sections->Status == 1 ?  'نشط':'غير نشط' }}</label>
                                                                </td>
                                                                {{-- '{{ trans('Attendance.active') }}' :
                                                                '{{ trans('Attendance.Inactive') }}'--}}
                                                                <td>
                                                                    <a href="{{route('Attendance.show',$list_sections->id)}}"
                                                                        class="btn btn-warning btn-sm" role="button"
                                                                        aria-pressed="true">{{ trans('main_trans.list_students') }}</a>
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
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- row closed -->
    @endsection
    @section('js')
    <script>
        $(document).ready(function () {
                    $('select[name="grade_id"]').on('change', function () {
                        var grade_id = $(this).val();
                        if (grade_id) {
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="class_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
    </script>

    @endsection