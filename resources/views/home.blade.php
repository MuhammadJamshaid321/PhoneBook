@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <b>You are logged in....!</b>
                    <h3 class="text-center my-5">Welcome to Phone Book Application</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
