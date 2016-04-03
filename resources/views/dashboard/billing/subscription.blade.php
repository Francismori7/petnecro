@extends('layouts.app')

@section('title', 'Souscription')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Souscription</h2>

                <div class="card">
                    <div class="card-block">
                        <section>
                            <h4>Souscription actuelle</h4>

                            @if(!$user->subscribed())
                                <p class="text-warning">Vous n'êtes pas actuellement souscrit à un plan.</p>
                            @else
                                <p class="text-success">{{ $user->subscription() }}</p>
                            @endif
                        </section>

                        <section>
                            <h4 class="title">Souscriptions disponibles</h4>

                            <p class="text-muted">
                                Vous pouvez choisir parmis les souscriptions suivantes.
                            </p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection