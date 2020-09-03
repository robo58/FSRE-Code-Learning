@extends('layouts.app')

@section('content')
    @can('create-posts')
        <course-index></course-index>
    @else
        <course-students :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></course-students>
    @endcan
@endsection
