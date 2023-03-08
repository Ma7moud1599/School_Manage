@extends('layouts.master')
@section('css')
@section('title')
{{trans('Fees.Add_new_fees')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Fees.Add_new_fees')}}@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="post" action="{{ route('Fees.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">{{trans('Fees.name_Arabic')}}</label>
                            <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for="inputEmail4" {{trans('Fees.name_English')}}></label>
                            <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control">
                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">{{trans('Fees.the_amount')}}</label>
                            <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                            <select class="custom-select mr-sm-2" name="grade_id">
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                @foreach($grades as $Grade)
                                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">{{trans('Students_trans.classrooms')}}</label>
                            <select class="custom-select mr-sm-2" name="classroom_id">

                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">{{trans('Students_trans.academic_year')}}</label>
                            <select class="custom-select mr-sm-2" name="year">
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                @php
                                $current_year = date("Y")
                                @endphp
                                @for($year=$current_year; $year<=$current_year +1 ;$year++) <option value="{{ $year}}">
                                    {{ $year }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">{{trans('Fees.Fee_type')}}</label>
                            <select class="custom-select mr-sm-2" name="Fee_type">
                                <option value="1">{{trans('Fees.Tuition_fees')}}</option>
                                <option value="2">{{trans('Fees.bus_fee')}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">{{ trans('grades_trans.Notes') }}</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                            rows="4"></textarea>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">{{ trans('grades_trans.submit') }}</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection