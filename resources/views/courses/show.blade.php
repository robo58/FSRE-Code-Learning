@extends('layouts.app')

@section('content')
    <course-show :course="{{ $course  }}"></course-show>
@endsection
