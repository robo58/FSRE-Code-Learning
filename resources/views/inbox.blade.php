@extends('layouts.app')

@section('content')

    <inbox :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></inbox>

@endsection
