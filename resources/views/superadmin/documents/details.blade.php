@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{$data->title}}</h2>
            <h3>{{$data->description}}</h3>
            <p>
                <iframe src="{{url('uploads/'.$data->file)}}" style="height: 500px; width: 600px;"></iframe>
            </p>
        </div>
    </div>
    </div>

@endsection
