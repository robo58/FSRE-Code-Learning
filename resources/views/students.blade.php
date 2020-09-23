@extends('layouts.app')

@section('content')

    <student-list :students="{{ $students }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></student-list>

@endsection
