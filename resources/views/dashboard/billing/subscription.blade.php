@extends('layouts.app')

@section('title', 'Abonnement')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Abonnement</h2>

                <div class="card">
                    <div class="card-block">
                        @if(Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif

                        @if($customer->account_balance < 0)
                            <section class="text-success">
                                <h4>Crédit disponible</h4>

                                <p>Vous
                                    avez {{ Laravel\Cashier\Cashier::formatAmount($customer->account_balance * -1) }} de
                                    disponible pour couvrir vos paiements futurs.</p>
                            </section>
                        @endif

                        <section>
                            <h4>Abonnement actuel</h4>

                            @if(!$user->subscribed())
                                <p class="text-warning">Vous n'êtes pas actuellement abonné à un plan.</p>
                            @else
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="card card-block">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <span class="h5"><strong>Abonnement:</strong> {{ $stripeSubscription->plan->name }}</span>
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
                                </div>

                                @if($stripeSubscription->cancel_at_period_end)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <p>
                                                    Votre abonnement sera mis à terme
                                                    le {{ Carbon\Carbon::createFromTimestamp($stripeSubscription->current_period_end)->toFormattedDateString() }}
                                                    .
                                                </p>

                                                <p>
                                                    {{ Form::open(['route' => 'dashboard.billing.subscription.reactivate']) }}
                                                    <button class="btn btn-primary">Réactiver mon abonnement</button>
                                                    {{ Form::close() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{ Form::open(['route' => 'dashboard.billing.subscription.destroy', 'method' => 'DELETE']) }}
                                    <button class="btn btn-danger">Annuler mon abonnement</button>
                                    {{ Form::close() }}
                                @endif
                            @endif
                        </section>

                        @if($user->subscribed())
                            <section>
                                <h4 class="title">Quantité</h4>

                                <p class="text-muted">
                                    Vous pouvez choisir la quantité d'animaux que vous voulez.
                                </p>

                                {{ Form::open(['route' => 'dashboard.billing.subscription.updateQuantity', 'method' => 'PATCH']) }}

                                <div class="form-group">
                                    <label for="quantity">Quantité</label>
                                    <input type="number" class="form-control" min="1" max="100" name="quantity"
                                           id="quantity" value="{{ $subscription->quantity }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Modifier la quantité</button>

                                {{ Form::close() }}
                            </section>
                        @endif

                        <section>
                            <h4 class="title">Abonnements disponibles</h4>

                            <p class="text-muted">
                                Vous pouvez choisir parmis les abonnements suivants.
                            </p>

                            <div class="card-columns columns-2">
                                @foreach($availableSubscriptions as $sub)
                                    <div class="card text-xs-center {{ $subscription && $subscription->stripe_plan === $sub->identifier ? 'card-success-outline' : '' }}">
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
                                        @if(!$subscription || $subscription->stripe_plan !== $sub->identifier)
                                            <div class="card-footer">
                                                {{ Form::open(['route' => 'dashboard.billing.subscription.update', 'method' => 'PATCH']) }}
                                                {{ Form::hidden('plan', $sub->identifier) }}
                                                <button class="btn btn-primary btn-sm">S'abonner</button>
                                                {{ Form::close() }}
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