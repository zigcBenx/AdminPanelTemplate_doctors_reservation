@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
        	<div class="container">
	        	<actions-component></actions-component>
	        	<hr>
                <hospital-component></hospital-component>
	            <doctors-component></doctors-component>
	            <profile-edit-component></profile-edit-component>
            </div>
        </div>
    </div>
</div>
@include('partials.doctor-modal')

@endsection
@section('scripts')
@parent
<script>

    $(document).ready(function(){
        // script for doctor-modal
        $('#ambulante').change(function(){
            let doctorsInfo = JSON.parse($('#doctorsInfoArr').val());
            console.log(doctorsInfo[$(this).prop('selectedIndex')]);
            $('#doctorAddress').html(doctorsInfo[$(this).prop('selectedIndex')].WorkplaceAddress);
            $('#doctorPhone').html(doctorsInfo[$(this).prop('selectedIndex')].WorkplacePhone);
            $('#doctorEmail').html(doctorsInfo[$(this).prop('selectedIndex')].DoctorEmail);
            $('#providerName').html(doctorsInfo[$(this).prop('selectedIndex')].ProviderName);
            $('#workplaceName').html(doctorsInfo[$(this).prop('selectedIndex')].WorkplaceName);

            $('#dejavnosti').html('');
            for (let i =0; i< doctorsInfo[$(this).prop('selectedIndex')].VZPs.length;i++){
                $('#dejavnosti').append('<li>'+doctorsInfo[$(this).prop('selectedIndex')].VZPs[i].Description+'</li>')
            }

            $('#storitve').html('');
            for (let i =0; i< doctorsInfo[$(this).prop('selectedIndex')].VZSs.length;i++){
                $('#storitve').append('<li>'+doctorsInfo[$(this).prop('selectedIndex')].VZSs[i].Description+'</li>')
            }
        });
    });
</script>
@endsection
