@extends('layouts.app')

@section('content')
    <course-show :course="{{ $course }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></course-show>

    <b-container>
        <b-row>
            <b-col>
                @comments(['model' => $course])
            </b-col>
        </b-row>
    </b-container>
@endsection
