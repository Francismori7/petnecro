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
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="card card-block">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="h5"><strong>Souscription:</strong> {{ $stripeSubscription->plan->name }}</span>
                                            </li>
                                            <li><strong><span class="fa fa-clock-o"></span> Débutée
                                                    le:</strong> {{ Carbon\Carbon::createFromTimestamp($stripeSubscription->start)->toFormattedDateString() }}
                                                à {{ Carbon\Carbon::createFromTimestamp($stripeSubscription->start)->toTimeString() }}
                                            </li>
                                            <li><strong><span class="fa fa-calendar-o"></span> Période:</strong>
                                                Du {{ Carbon\Carbon::createFromTimestamp($stripeSubscription->current_period_start)->toFormattedDateString() }}
                                                au {{ Carbon\Carbon::createFromTimestamp($stripeSubscription->current_period_end)->toFormattedDateString() }}
                                            </li>
                                            <li><strong><span class="fa fa-clone"></span>
                                                    Quantité:</strong> {{ $stripeSubscription->quantity }} {{ $stripeSubscription->quantity > 1 ? 'animaux' : 'animal' }}
                                            </li>
                                        </ul>
                                        <h5 class="text-success text-xs-center">
                                            <strong>Total:</strong>
                                            {{ Laravel\Cashier\Cashier::formatAmount($stripeSubscription->quantity * $stripeSubscription->plan->amount) }}
                                            /
                                            {{ $stripeSubscription->plan->interval_count }} {{ str_plural(trans('cashier.intervals.' . $stripeSubscription->plan->interval), $stripeSubscription->plan->interval_count) }}
                                        </h5>
                                    </div>
                                </div>

                                @if($stripeSubscription->cancel_at_period_end)
                                    <div class="alert alert-danger">
                                        <p>
                                            Votre souscription sera mise à terme
                                            le {{ Carbon\Carbon::createFromTimestamp($stripeSubscription->current_period_end)->toFormattedDateString() }}
                                            .
                                        </p>

                                        <p><a href="#" class="btn btn-primary">Réactiver ma souscription</a></p>
                                    </div>
                                @else
                                    <a href="#" class="btn btn-danger">Annuler ma souscription</a>
                                @endif
                            @endif
                        </section>

                        <section>
                            <h4 class="title">Souscriptions disponibles</h4>

                            <p class="text-muted">
                                Vous pouvez choisir parmis les souscriptions suivantes.
                            </p>

                            <div class="card-columns columns-2">
                                @foreach($availableSubscriptions as $sub)
                                    <div class="card text-xs-center {{ $subscription->stripe_plan === $sub->identifier ? 'card-success-outline' : '' }}">
                                        <div class="card-header">
                                            <h5>{{ $sub->name }}</h5>
                                        </div>
                                        <div class="card-block">
                                            <p class="h4">
                                                {{ Laravel\Cashier\Cashier::formatAmount($sub->amount) }}
                                                /
                                                {{ $sub->interval_count }} {{ str_plural(trans('cashier.intervals.' . $sub->interval), $sub->interval_count) }}
                                            </p>
                                            <p class="small text-muted">
                                                Le prix est par animal ajouté.
                                            </p>
                                        </div>
                                        @if($subscription->stripe_plan !== $sub->identifier)
                                            <div class="card-footer">
                                                <a href="#" class="btn btn-primary btn-sm">S'abonner</a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection