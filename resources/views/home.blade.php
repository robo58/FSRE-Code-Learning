@extends('layouts.app')

@section('content')

    @can('create-posts')
        <teacher-home :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></teacher-home>
    @else
        <home-page :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></home-page>
    @endcan

@endsection
