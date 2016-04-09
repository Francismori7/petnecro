@extends('layouts.app')

@section('title', trans('pages.dashboard.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Aperçu de votre compte</h2>

                <div class="card">
                    <div class="card-block">
                    @if($user->hasFilledProfile())
                            <div class="pull-md-right">
                                <img src="{{ $user->gravatarLink() }}" class="img-circle img-responsive">
                            </div>

                            <h4>{{ $profile->full_name }}</h4>

                            <h5>Limites du compte</h5>
                            <div class="row">
                                <div class="card-group">
                                    <div class="col-md-4 col-xs-6">
                                        <div class="card text-xs-center">
                                            <div class="card-header">
                                                Animaux
                                            </div>
                                            <div class="card-block">
                                                <h4 class="{{ $petsCount < $maxPetsCount ? 'text-success' : 'text-danger' }}">
                                                    {{ $petsCount }} / {{ $maxPetsCount }}
                                                </h4>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <a href="#" class="btn btn-primary btn-sm">Augmenter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                <a href="{{ route('dashboard.edit.profile') }}" class="btn btn-primary">Modifier mon profil</a>
                            </div>

                        @else
                            <h4>{{ $user->username }}</h4>

                            <div class="alert alert-info last clearfix">
                                Votre profil utilisateur n'est pas encore configuré!
                                <a href="{{ route('dashboard.edit.profile') }}" class="btn btn-sm btn-info pull-right">Configurer
                                    mon profil</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
