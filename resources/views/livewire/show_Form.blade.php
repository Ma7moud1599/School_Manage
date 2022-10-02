@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.Parents_add')}}
    {{-- @if($updateMode)
        {{trans('Parent_trans.edit_parent')}}
    @else
        {{trans('main_trans.Parents_add')}}
    @endif --}}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Parents_add')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @livewire('add-parent')
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
    @livewireScripts
@endsection
