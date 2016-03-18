@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-block">
                    <h3 class="card-title">{{ trans('pages.login.title') }}</h3>
                    <form method="POST" action="{{ url('/login') }}" class="card-block">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }} row">
                            <label class="col-md-4 control-label" for="username">{{ trans('pages.login.username') }}</label>

                            <div class="col-md-8">
                                <input type="text"
                                       class="form-control{{ $errors->has('username') ? ' form-control-danger' : '' }}"
                                       name="username" id="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <small class="text-danger">
                                        {{ $errors->first('username') }}
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} row">
                            <label class="col-md-4 control-label"
                                   for="password">{{ trans('pages.login.password') }}</label>

                            <div class="col-md-8">
                                <input type="password" id="password"
                                       class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}"
                                       name="password">

                                @if ($errors->has('password'))
                                    <small class="text-danger">
                                        {{ $errors->first('password') }}
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('pages.login.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-btn fa-sign-in"></span> {{ trans('pages.login.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    {{ trans('pages.login.forgot') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
