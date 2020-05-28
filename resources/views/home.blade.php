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

        /**
         * script for showing users doctors
         */
        $.post('{{ route("admin.user-doctor-show") }}', {_token: "{{ csrf_token() }}"})
            .done(function(data){
                console.log(data);

                $('#users-doctors-list').html('');
                for(let i = 0; i < data.length; i++) {
                    let doctorId = data[i].doctor_id;
                    fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode='+doctorId+'&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType= browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
                        .then( res => res.json())
                        .then( res => {
                            let doctorsFirstName = res.DoctorInfos[0].DoctorFirstName;
                            let doctorsLastName = res.DoctorInfos[0].DoctorLastName;
                            // append
                            $('#users-doctors-list').append("<b>" + doctorsFirstName + " " + doctorsLastName + "</b>,");
                        });
                }

            });


        /**
         * script for saving doctor & workplace for user
         */
        $('#save-doctor-button').click(function(){
            let submittedDoctor = $('#doctor-id').val();
            // alert(submittedDoctor);
            $.post('{{ route("admin.user-doctor")  }}',{_token: "{{ csrf_token() }}", docId: submittedDoctor, workplace: $('#ambulante').val() })
                .done(function(data){
                    $('#modal-doctor').modal('hide');
                    if(data == 'exists'){
                        alert('Ta doktor je že dodan.', 'Napaka');
                        return;
                    }
                    $('#modal-doctor').modal('hide');
                    alert("Doktor uspešno dodan", 'Uspešno');
                    location.reload(); // TODO: instead of this do async refresh
                });
            });

        /**
         * script for doctor-modal fill data
         */
        $('#ambulante').change(function(){
            let doctorsInfo = JSON.parse($('#doctorsInfoArr').val());

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
