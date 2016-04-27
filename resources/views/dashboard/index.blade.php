@extends('layouts.app')

@section('title', trans('pages.dashboard.title'))

@section('content')
    <dashboard-index :user.sync="user" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-3 col-xs-12">
                    @include('dashboard._navigation')
                </div>
                <div class="col-md-7 col-xs-12">
                    <h2 class="page-header">Aperçu de votre compte</h2>

                    <div class="card">
                        <div class="card-block">
                            <div v-if="user">
                                <div v-if="user.has_filled_profile">
                                    <div class="pull-md-right">
                                        <img :src="user.gravatar_link" class="img-circle img-responsive">
                                    </div>

                                    <h4>@{{ user.profile.full_name }}</h4>

                                    <h5>Limites du compte</h5>
                                    <div class="row">
                                        <div class="card-group">
                                            <div class="col-md-4 col-xs-6">
                                                <div class="card text-xs-center">
                                                    <div class="card-header">
                                                        Animaux
                                                    </div>
                                                    <div class="card-block">
                                                        <h4 :class="{'text-success': canAddPets, 'text-danger': !canAddPets}">
                                                            @{{ user.pets.length }} / @{{ user.maximum_pets }}
                                                        </h4>
                                                    </div>
                                                    <div class="card-footer text-muted">
                                                        <a href="#" class="btn btn-primary btn-sm">Augmenter</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <br>
                                        <a href="{{ route('dashboard.edit.profile') }}" class="btn btn-primary">Modifier
                                            mon
                                            profil</a>
                                    </div>
                                </div>
                                <div v-else>
                                    <h4>@{{ user.username }}</h4>

                                    <div class="alert alert-info last clearfix">
                                        Votre profil utilisateur n'est pas encore configuré!
                                        <a href="{{ route('dashboard.edit.profile') }}"
                                           class="btn btn-sm btn-info pull-right">Configurer
                                            mon profil</a>
                                    </div>
                                </div>
                            </div>
                            <loading-indicator v-else></loading-indicator>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </dashboard-index>
@endsection
