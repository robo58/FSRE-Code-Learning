@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
    <home-page></home-page>

                    {{ __('You are logged in!') }}

                </div>
            </div>
        </div>
    </div>

@endsection
