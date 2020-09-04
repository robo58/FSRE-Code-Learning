@extends('layouts.app')

@section('content')
    <b-container class="text-center">
        <b-card class="py-4" title="{{ $course->title }}" sub-title="{{ $course->created_at }}">
            <b-card-text>
                Do you want to start this course?
            </b-card-text>
            <b-button variant="success" v-on:click="startCourse({{$course->id}},{{\Illuminate\Support\Facades\Auth::id()}})" href="/courses/{{$course->id}}">Start</b-button>
            <b-button variant="secondary" href="{{ url()->previous() }}">Cancel</b-button>
        </b-card>
    </b-container>
@endsection
