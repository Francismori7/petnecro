@extends('layouts.app')

@section('title', trans('pages.dashboard.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7">
                <h2 class="page-header">Aperçu de votre compte</h2>

                <div class="card">
                    <div class="card-header">
                        {{ trans('pages.dashboard.title') }}
                    </div>
                    <div class="card-block">
                        <p class="card-text">
                            Your Application's Landing Page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
