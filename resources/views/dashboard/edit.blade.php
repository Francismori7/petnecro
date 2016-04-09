@extends('layouts.app')

@section('title', trans('pages.dashboard.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Modifier votre profil</h2>

                <div class="card">
                    <div class="card-block">
                        @if(!Auth::user()->hasFilledProfile())
                            <div class="alert alert-info">
                                Vous devez compléter votre profil utilsateur pour utiliser le site web.
                            </div>
                            {{ Form::open(['route' => 'dashboard.store.profile']) }}
                        @else
                            {{ Form::model($profile, ['route' => 'dashboard.update.profile', 'method' => 'patch']) }}
                        @endif

                        <section>
                            <h4>Photo</h4>
                            <p class="text-muted">
                                Nous utilisons <a href="https://fr.gravatar.com/">Gravatar</a> pour les photos de
                                profil.
                            </p>

                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ Auth::user()->gravatarLink() }}"
                                         class="img-circle img-fluid">
                                </div>
                                <div class="col-md-9">
                                    <a href="https://fr.gravatar.com/emails/"
                                       class="btn btn-xs btn-info-outline"
                                       target="_blank">Modifier</a>
                                </div>
                            </div>
                        </section>

                        <section>
                            <h4 class="title">Nom</h4>
                            <p class="text-muted">
                                Comment vous appelez-vous?
                            </p>

                            {{ Form::bsText('first_name', 'Prénom') }}

                            {{ Form::bsText('last_name', 'Nom') }}
                        </section>

                        {{--
                        <section>
                            <h4 class="title">Adresse personnelle</h4>
                            <p class="text-muted">Votre addresse est seulement nécessaire lorsque vous prenez un abonnement
                            et est privée.</p>

                            {{ Form::bsText('address1', 'Adresse (ligne 1)') }}

                            {{ Form::bsText('address2', 'Adresse (ligne 2)') }}

                            {{ Form::bsText('city', 'Ville') }}

                            {{ Form::bsText('state', 'Province') }}

                            {{ Form::bsText('zip', 'Code postal') }}

                            {{ Form::bsText('country', 'Pays') }}
                        </section>
                        --}}

                        {{ Form::submit('Sauvegarder', ['class' => 'btn btn-lg btn-primary']) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
