@extends('layouts.master')
@section('css')
@section('title')
{{trans('Fees.Tuition_fee_adjustment')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Fees.Tuition_fee_adjustment')}}@stop
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

                <form action="{{route('Fees.update','test')}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">{{trans('Fees.name_Arabic')}}</label>
                            <input type="text" value="{{$fee->getTranslation('title','ar')}}" name="title_ar"
                                class="form-control">
                            <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for="inputEmail4">{{trans('Fees.name_English')}}</label>
                            <input type="text" value="{{$fee->getTranslation('title','en')}}" name="title_en"
                                class="form-control">
                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">{{trans('Fees.the_amount')}}</label>
                            <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                            <select class="custom-select mr-sm-2" name="grade_id">
                                @foreach($grades as $Grade)
                                <option value="{{ $Grade->id }}" {{$Grade->id == $fee->grade_id ? 'selected' : ""}}>
                                    {{ $Grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">{{trans('Students_trans.classrooms')}}</label>
                            <select class="custom-select mr-sm-2" name="classroom_id">
                                <option value="{{$fee->classroom_id}}">{{$fee->classroom->Name_class}}</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">{{trans('Students_trans.academic_year')}}</label>
                            <select class="custom-select mr-sm-2" name="year">
                                @php
                                $current_year = date("Y")
                                @endphp
                                @for($year=$current_year; $year<=$current_year +1 ;$year++) <option value="{{ $year}}"
                                    {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">{{ trans('grades_trans.Notes') }}</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                            rows="4">{{$fee->description}}</textarea>
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