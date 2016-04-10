@extends('layouts.app')

@section('title', 'Carte de crédit')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Carte de crédit</h2>

                <div class="card">
                    <div class="card-block">
                        <p class="text-muted">
                            Vous pouvez modifier la carte de crédit associée à votre compte.
                        </p>

                        @if($user->card_last_four !== null)
                            <h4>Votre carte actuelle</h4>

                            <div class="my-cc">
                                <div class="item">
                                    <!-- Transparent Image -->
                                    <img src="images/transparent.png" alt="" class="img-responsive">
                                    <!-- Heading -->
                                    <div class="item-heading clearfix">
                                        <!-- Heading -->
                                        <h3>Carte de crédit</h3>
                                        <!-- Bank Name -->
                                        <h4></h4>
                                    </div>
                                    <!-- Account -->
                                    <div class="item-account">
                                        <!-- Value -->
                                        <span>****</span>
                                        <span>****</span>
                                        <span>****</span>
                                        <span>{{ $user->card_last_four }}</span>
                                    </div>
                                    <!-- Validity Starts -->
                                    <div class="item-validity">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <!-- Item -->
                                                <div class="item-valid clearfix">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <!-- Item -->
                                                <div class="item-valid clearfix">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Validity Ends -->

                                    <!-- Card Type Starts -->
                                    <div class="item-cc-type clearfix">
                                        <!-- Type -->
                                        <h6>CARTE {{ strtoupper($user->card_brand) }}</h6>
                                        <!-- Icon -->
                                        <i class="fa fa-cc-{{ strtolower($user->card_brand) }}"></i>
                                    </div>
                                    <!-- Card Type Ends -->
                                </div>
                            </div>
                        @endif

                        <section>
                            @if($user->card_last_four)
                                <h4 class="title">Modifier ma carte</h4>
                            @else
                                <h4 class="title">Ajouter une carte</h4>
                            @endif

                            <form action="{{ route('dashboard.billing.creditcard.update') }}"
                                  id="payment-form" autocomplete="on" method="POST">

                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}

                                <div class="alert alert-danger payment-errors hidden-xs-up"></div>

                                <div class="form-group">
                                    <label for="number">Numéro de carte</label>
                                    <input type="tel" id="number" class="form-control" required data-stripe="number"
                                           autocomplete="billing cc-number">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exp">Expiration (MM/AAAA)</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="tel" class="form-control" id="exp" required
                                                           data-stripe="exp" autocomplete="billing cc-exp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cvc">Code de vérification (CVC)</label>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <input type="tel" id="cvc" class="form-control" maxlength="5"
                                                           required
                                                           data-stripe="cvc" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Sauvegarder la carte</button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script>
    Stripe.setPublishableKey('{{ config('services.stripe.key') }}');

    $(document).ready(function () {
        $('input#number').payment('formatCardNumber');
        $('input#exp').payment('formatCardExpiry');
        $('input#cvc').payment('formatCardCVC');

        $('#payment-form').submit(function (event) {
            var $form = $(this);

            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        });
    });

    function stripeResponseHandler(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message).removeClass('hidden-xs-up');
            $form.find('button').prop('disabled', false);
        } else {
            $form.find('.payment-errors').text('').addClass('hidden-xs-up');
            // response contains id and card, which contains additional card details
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripeToken">').val(token));
            // and submit
            $form.get(0).submit();
        }
    }
</script>
@endpush