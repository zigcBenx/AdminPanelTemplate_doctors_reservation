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