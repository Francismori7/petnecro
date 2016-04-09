<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Facture</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-6"><h2>{{ $header or $vendor }}</h2></div>
            <div class="col-xs-6 text-xs-right"><h2>FACTURE</h2></div>
        </div>

        <br>

        <div class="card-deck-wrapper">
            <div class="card-deck">
                <div class="card">
                    <div class="card-header">Détails de la facture</div>
                    <div class="card-block">
                        Facture: #{{ strtoupper(ltrim($invoice->id, 'in_')) }}<br>
                        Description: {{ $product }}<br>
                        Date: {{ $invoice->date()->toFormattedDateString() }}
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card-deck-wrapper">
            <div class="card-deck">
                <div class="card">
                    <div class="card-header">Vendeur</div>
                    <div class="card-block">
                        <h4>{{ $vendor }}</h4>
                        @if (isset($street))
                            {{ $street }}<br>
                        @endif
                        @if (isset($location))
                            {{ $location }}<br>
                        @endif
                        @if (isset($phone))
                            <strong>T:</strong> <a href="tel:{{ $phone }}">{{ $phone }}</a><br>
                        @endif
                        @if (isset($url))
                            <a href="{{ $url }}">{{ $url }}</a>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Client</div>
                    <div class="card-block">
                        <h4>{{ $user->profile->full_name }}</h4>
                        @if (isset($user->profile->address1))
                            {{ $user->profile->address1 }}<br>
                        @endif
                        @if (isset($user->profile->city))
                            {{ $user->profile->city }}
                        @endif
                        @if (isset($user->profile->state))
                            , {{ $user->profile->state }}
                        @endif
                        @if (isset($user->profile->zip))
                            &nbsp;&nbsp;{{ $user->profile->zip }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <br>

        <table class="table table-bordered">
            <thead class="thead-default">
            <tr>
                <th width="60%">Description</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Sous-total</th>
            </tr>
            </thead>
            <tbody>
            <!-- Existing Balance -->
            <tr>
                <td colspan="3">Balance initiale</td>
                <td>{{ $invoice->startingBalance() }}</td>
            </tr>
            </tbody>

            @if(count($invoice->invoiceItems()))
                <tbody>
                @foreach ($invoice->invoiceItems() as $item)
                    <tr>
                        <td colspan="3">{{ $item->description }}</td>
                        <td>{{ $item->total() }}</td>
                    </tr>
                @endforeach
                </tbody>
            @endif

            @if(count($invoice->subscriptions()))
                <tbody>
                @foreach ($invoice->subscriptions() as $subscription)
                    <tr>
                        <td>Abonnement ({{ $subscription->plan->name }}) - Du {{ $subscription->startDate() }}
                            au {{ $subscription->endDate() }}</td>
                        <td>{{ $subscription->quantity }}</td>
                        <td>{{ Laravel\Cashier\Cashier::formatAmount($subscription->plan->amount) }}</td>
                        <td>{{ $subscription->total() }}</td>
                    </tr>
                @endforeach
                </tbody>
            @endif

            @if ($invoice->hasDiscount())
                <tbody>
                <tr>
                    @if ($invoice->discountIsPercentage())
                        <td colspan="3">{{ $invoice->coupon() }} (Réduction de {{ $invoice->percentOff() }}%)</td>
                    @else
                        <td colspan="3">{{ $invoice->coupon() }} (Réduction de {{ $invoice->amountOff() }})</td>
                    @endif
                    <td>-{{ $invoice->discount() }}</td>
                </tr>
                </tbody>
            @endif

            <tbody>
            <tr>
                <td colspan="3" class="text-xs-right"><strong>Sous-total:</strong></td>
                <td><strong>{{ $invoice->subtotal() }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-xs-right"><strong>Taxes ({{ $invoice->tax_percent }}%):</strong></td>
                <td><strong>{{ Laravel\Cashier\Cashier::formatAmount($invoice->tax) }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-xs-right"><h3>Total:</h3></td>
                <td><h3>{{ $invoice->total() }}</h3></td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
