@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/files" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="text" name="title" placeholder="title">
                <input type="text" name="description" placeholder="description">
                <input type="file" name="file">
                <input type="submit" name="Submit">
            </form>
        </div>
    </div>
    </div>

@endsection
