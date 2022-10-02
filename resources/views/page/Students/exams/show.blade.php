@extends('layouts.master')
@section('css')
    @livewireStyles
    @section('title')
{{trans('Questions.make_test')}}    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
{{trans('Questions.make_test')}}     @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
    @livewireScripts
@endsection
