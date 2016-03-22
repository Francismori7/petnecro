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
                    <div class="card-block">
                        @if(Auth::user()->hasFilledProfile())
                            @php($profile = Auth::user()->profile)
                            <div class="pull-md-right">
                                <img src="{{ Auth::user()->gravatarLink() }}" class="img-circle img-responsive">
                            </div>

                            <h4>{{ $profile->first_name }} {{ $profile->last_name }}</h4>

                            {{--
                            <div class="row">
                                <div class="col-md-3">
                                    Adresse:
                                </div>
                                <div class="col-md-7">
                                    <address>
                                        {{ $profile->address1 }}<br>
                                        {{ $profile->address2 }}{{ $profile->address2 ? '<br>' : '' }}
                                        {{ $profile->city }}, {{ $profile->state }}&nbsp;&nbsp;{{ $profile->zip }}<br>
                                        {{ $profile->country }}
                                    </address>
                                </div>
                            </div>
                            --}}
                            <div class="clearfix">
                                <br>
                                <a href="{{ route('dashboard.edit') }}" class="btn btn-primary">Modifier mon profil</a>
                            </div>

                        @else
                            <h4>{{ Auth::user()->username }}</h4>

                            <div class="alert alert-info last clearfix">
                                    Votre profil utilisateur n'est pas encore configuré!
                                    <a href="#" class="btn btn-sm btn-info pull-right">Configurer mon profil</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
