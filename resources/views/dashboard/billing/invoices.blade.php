@extends('layouts.app')

@section('title', 'Factures')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Factures</h2>

                <div class="card">
                    <div class="card-block">
                        <p>Vous pouvez voir ici les 24 dernières factures de votre compte.</p>

                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Date</th>
                                <th>Montant</th>
                                <th width="20%">&nbsp;</th>
                            </tr>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                    <td>{{ Laravel\Cashier\Cashier::formatAmount($invoice->total - ($invoice->rawStartingBalance() * -1)) }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.billing.invoices.show', ltrim($invoice->id, 'in_')) }}"
                                           class="btn btn-sm btn-primary">Voir</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Vous n'avez pas de factures dans votre compte.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection