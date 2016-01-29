@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-block">
                    <h3 class="card-title">{{ trans('pages.register.title') }}</h3>
                    <form class="card-block" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} row">
                            <label class="col-md-4 control-label" for="name">{{ trans('pages.register.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}"
                                       name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <small class="text-danger">
                                        {{ $errors->first('name') }}
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} row">
                            <label class="col-md-4 control-label"
                                   for="email">{{ trans('pages.register.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}"
                                       name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <small class="text-danger">
                                        {{ $errors->first('email') }}
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} row">
                            <label class="col-md-4 control-label"
                                   for="password">{{ trans('pages.register.password') }}</label>

                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}"
                                       name="password">

                                @if ($errors->has('password'))
                                    <small class="text-danger">
                                        {{ $errors->first('password') }}
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} row">
                            <label class="col-md-4 control-label"
                                   for="password_confirmation">{{ trans('pages.register.password_confirmation') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation"
                                       type="password"
                                       class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}"
                                       name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-btn fa-user"></span> {{ trans('pages.register.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
