@extends('layouts.app')

@section('content')

    @if($user ?? null)
        <inbox :user="{{ \Illuminate\Support\Facades\Auth::user() }}" :select="{{ $user }}"></inbox>
    @else
        <inbox :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></inbox>
    @endif

@endsection
