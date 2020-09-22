@extends('layouts.app')

@section('content')
    <course-show :course="{{ $course }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></course-show>

    <div>
        @comments(['model' => $course])
    </div>
@endsection
