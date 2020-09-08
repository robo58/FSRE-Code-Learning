@extends('layouts.app')

@section('content')
    <category-show :user="{{ \Illuminate\Support\Facades\Auth::user() }}" :category="{{ $category }}"></category-show>
@endsection
