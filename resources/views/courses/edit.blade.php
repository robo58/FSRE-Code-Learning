@extends('layouts.app')

@section('content')
    <course-edit :course="{{ $course  }}"></course-edit>
@endsection
