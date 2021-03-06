@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                {{ trans('global.site_title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Za naročanje se je potrebno prijaviti</p>
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="E-pošta" name="email">
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Geslo" name="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <input type="checkbox" name="remember"> Ostani prijavljen
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Prijava</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <p class="mb-1">
{{--                <a class="" href="{{ route('password.request') }}">--}}
{{--                    Pozabljeno geslo--}}
{{--                </a>--}}
                <br>
                <a class="" href="{{ route('register') }}">
                    Nov uporabnik? Registriraj se.
                </a>
            </p>
            <p class="mb-0">

            </p>
            <p class="mb-1">

            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection
