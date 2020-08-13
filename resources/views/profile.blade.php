@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2>{{$user->name}} 's Profile</h2>
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <div>
                        <label>Update Profile</label>
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" class="pull-right btn btn-sm btn-primary">
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
        </div>
    </div>
@endsection
