@extends('layouts.app')

@section('content')

    @guest
        <guest-page></guest-page>
    @else
        <guest-page :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></guest-page>
    @endguest
@endsection
