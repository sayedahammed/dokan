@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-3">
        <div class="col-md-8 text-center">
            <h2>Denim Tailors</h2>
            <h4 class="pt-3">Welcome {{ auth()->user()->name }}</h4>
        </div>
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
