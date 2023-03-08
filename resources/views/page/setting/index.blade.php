@extends('layouts.master')
@section('css')
@section('title')
{{trans('Settings.Settings')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Settings.Settings')}}@stop
<!-- breadcrumb -->
@endsection
@section('content')


@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 border-right-2 border-right-blue-400">
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold pt-5">{{trans('Settings.school_logo')}}</label>
                                <div class="col-lg-9">
                                    <div class="mb-3">
                                        {{-- <img style="width: 100px" height="100px"
                                            src="{{ URL::asset('attachments/logo/'.$setting['logo']) }}" alt=""> --}}
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input"
                                        data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.school_name')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['school_name'] }} --}}
                                    <input name="school_name" value="" required type="text" class="form-control"
                                        placeholder="Name of School">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current_session"
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.current_year')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Choose..." required name="current_session"
                                        id="current_session" class="select-search form-control">
                                        <option value=""></option>
                                        @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1
                                            years')); $y++) <option
                                            {{ ($setting['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>
                                            {{ ($y-=1).'-'.($y+=1) }}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.Short_name')}}</label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['school_title'] }} --}}
                                    <input name="school_title" value="" type="text" class="form-control"
                                        placeholder="School Acronym">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.the_phone')}}</label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['phone'] }} --}}
                                    <input name="phone" value="" type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Teacher_trans.Email')}}</label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['school_email'] }} --}}
                                    <input name="school_email" value="" type="email" class="form-control"
                                        placeholder="School Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.school_address')}}
                                    <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['address'] }} --}}
                                    <input required name="address" value="" type="text" class="form-control"
                                        placeholder="School Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.first_term')}}</label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['end_first_term'] }} --}}
                                    <input name="end_first_term" value="" type="text" class="form-control date-pick"
                                        placeholder="Date Term Ends">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-2 col-form-label font-weight-semibold">{{trans('Settings.second_term')}}</label>
                                <div class="col-lg-9">
                                    {{-- {{ $setting['end_second_term'] }} --}}
                                    <input name="end_second_term" value="" type="text" class="form-control date-pick"
                                        placeholder="Date Term Ends">
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{trans('Students_trans.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection