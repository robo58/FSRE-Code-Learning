@extends('layouts.app')

@section('content')

    <teacher-list :teachers="{{ $teachers }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></teacher-list>

@endsection
