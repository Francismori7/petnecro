@extends('layouts.app')

@section('title', 'Réductions')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                @include('dashboard._navigation')
            </div>
            <div class="col-md-7 col-xs-12">
                <h2 class="page-header">Réductions</h2>

                <div class="card">
                    <div class="card-block">
                        <p class="text-muted">
                            Vous pouvez ajouté une réduction à votre abonnement si vous possédez un coupon-rabais.
                        </p>

                        @if(session()->has('error'))
                            <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif

                        @if(session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @endif

                        {{ Form::open(['route' => 'dashboard.billing.discount.store', 'method' => 'POST']) }}

                        <div class="form-group">
                            <label for="coupon">Coupon-rabais</label>
                            <input type="text" name="coupon" id="coupon" required class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter le coupon-rabais</button>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection