@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
        	<div class="container">
	        	<actions-component></actions-component>
	        	<hr>
	            <doctors-component></doctors-component>
	            <profile-edit-component></profile-edit-component>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection