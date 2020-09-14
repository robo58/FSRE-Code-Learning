@extends('layouts.app')

@section('content')
    @can('create-posts')
        <category-index></category-index>
    @else
        <category-students></category-students>
    @endcan
@endsection
