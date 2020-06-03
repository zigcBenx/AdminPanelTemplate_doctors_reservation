@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="form-group">

            <label for="users-doctors-list">Vaši zdravniki:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-hospital"></i>
                                </span>
                </div>

                <select name="" id="users-doctors-list" class="form-control float-right" >
                </select>
                <a href="/admin" class="btn btn-success">Zahtevaj recept <i class="fas fa-receipt"></i></a>
            </div>
            <!-- /.input group -->
        </div>
        <h2>Izdani recepti</h2>
        <hr>

        <div class="callout callout-warning">
            <h5>Recept1: Bla asd</h5>

            <p>Tdsf sd fsd fds ut.</p>
        </div>
        <div class="callout callout-warning">
            <h5>Recept2: Bla fgh</h5>

            <p>Sasd asff dsfd sdf.</p>
        </div>
    </div>

@endsection
@section('scripts')
    @parent

@endsection
