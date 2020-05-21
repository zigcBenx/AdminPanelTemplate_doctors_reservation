@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-lg-12">
        	<div class="container">
        	<div class="form-group">
				<label>Date range:</label>

				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">
							<i class="far fa-calendar-alt"></i>
						</span>
					</div>
					<input type="text" class="form-control float-right" id="reservation">
				</div>
				<!-- /.input group -->
            </div>
                <hr>
                <div class="callout callout-info">
                    <div class="row">
                        <div class="col-8">
                            <h5>Termin 1: Dohter Janez</h5>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-info btn-lg" style="float:right;">Naroči se</button>
                        </div>
                    </div>
                    <p>15.00 - 15.30</p>
                </div>
                <div class="callout callout-info">
                    <div class="row">
                        <div class="col-8">
                            <h5>Termin 2: Dohter Janez</h5>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-info btn-lg" style="float:right;">Naroči se</button>
                        </div>
                    </div>
                    <p>15.30 - 16.00</p>
                </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
@parent

<script>
	$('#reservation').daterangepicker();
</script>
@endsection
