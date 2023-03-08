@extends('layouts.master')
@section('css')
@section('title')
{{trans('Questions.test_adjustment')}}{{$quizz->name}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Questions.test_adjustment')}}{{$quizz->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{route('quizzes.update','test')}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">

                                <div class="col">
                                    <label for="title">{{trans('Questions.name_test_Arabic')}}</label>
                                    <input type="text" name="Name_ar" value="{{$quizz->getTranslation('name','ar')}}"
                                        class="form-control">
                                    <input type="hidden" name="id" value="{{$quizz->id}}">
                                </div>

                                <div class="col">
                                    <label for="title">{{trans('Questions.name_test_English')}}</label>
                                    <input type="text" name="Name_en" value="{{$quizz->getTranslation('name','en')}}"
                                        class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{trans('Questions.Subject')}}: <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="subject_id">
                                            @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{$subject->id == $quizz->subject_id ? "selected":""}}>
                                                {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{trans('Students_trans.Grade')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grade_id">
                                            @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{$grade->id == $quizz->grade_id ? "selected":""}}>{{ $grade->Name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="classroom_id">
                                            <option value="{{$quizz->classroom_id}}">{{$quizz->classroom->Name_class}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                            <option value="{{$quizz->section_id}}">{{$quizz->section->Name_section}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div><br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>
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