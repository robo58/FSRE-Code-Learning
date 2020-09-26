@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-4">
            <div class="col-md-12">
                <img src="uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2>{{$user->name}} 's Profile</h2>
                @if($user->id == \Illuminate\Support\Facades\Auth::id())
                    <div v-if="!setEdit">
                        <h6>{{ $user->email }}</h6>
                        <button class="btn btn-primary" @click="setEdit=true">Edit</button>
                        <div class="row mt-3"><br></div>
                        <div class="row mt-3"><br></div>
                        <div class="row mt-3"><br></div>
                    </div>
                    <div v-else>
                        <form enctype="multipart/form-data" action="/profile" method="POST">
                            <div>
                                <label>Update Profile</label>
                                <input type="file" name="avatar">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" class="pull-right btn btn-sm btn-primary">
                                <button class="btn btn-secondary" @click.prevent="setEdit=false">Cancel</button>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        <a href="{{route('password-change')}}"><button type="button" class="btn btn-warning">Change password</button></a>
                    </div>
                @else
                    <h6>{{ $user->email }}</h6>
                    <div class="row mt-3"><br></div>
                    <div class="row mt-3"><br></div>
                    <div class="row mt-3"><br></div>

                @endif
                @can('create-posts')
                    @if(!empty($courses))
                <h2 class="text-center">My Courses</h2>
                <b-row class="py-4">
                    <b-col>
                        <list-courses :courses="{{ $courses }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></list-courses>
                    </b-col>
                </b-row>
                    @endif
                    <h2 class="text-center">Enrolled Courses</h2>
                    <b-row class="py-4">
                        <b-col>
                            <list-courses :courses="{{ $enrolledCourses }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></list-courses>
                        </b-col>
                    </b-row>
                @else
                    <h2 class="text-center">Enrolled Courses</h2>
                    <b-row class="py-4">
                        <b-col>
                            <list-courses :courses="{{ $enrolledCourses }}" :user="{{ \Illuminate\Support\Facades\Auth::user() }}"></list-courses>
                        </b-col>
                    </b-row>
                @endcan
            </div>
        </div>
    </div>
@endsection
