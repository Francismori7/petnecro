@extends('layouts.app')

@section('title', trans('pages.dashboard.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7">
                <h2 class="page-header">Modifier votre compte</h2>

                <div class="card">
                    <div class="card-block">
                        {{ Form::model(Auth::user(), ['route' => 'dashboard.update.account', 'method' => 'patch']) }}

                        <section>
                            <h4>Contact</h4>
                            <p class="text-muted">Nous utilisons ces informations pour vous contacter.</p>

                            {{ Form::bsEmail('email', 'Courriel') }}
                        </section>

                        <section>
                            <h4 class="title">Connexion</h4>
                            <p class="text-muted">
                                Vous utilisez ces informations pour vous connecter.
                            </p>

                            {{ Form::bsText('username', "Nom d'utilisateur") }}

                            {{ Form::bsPassword('password', 'Mot de passe') }}

                            {{ Form::bsPassword('password_confirmation', 'Mot de passe (confirmation)') }}
                        </section>

                        {{ Form::submit('Sauvegarder', ['class' => 'btn btn-lg btn-primary']) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
