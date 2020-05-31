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
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Urejanje profila</div>
                                <form action="{{route('admin.users-update')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                <div class="card-body">
                                    <label>KZZ številka:</label>
                                    <div class="input-group">
                                        <input type="text" name="zzzs" class="form-control" value="{{$user[0]->zzzs}}" placeholder="ZZZS številka">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fas fa-hospital"></i></div>
                                        </div>
                                    </div>
                                    <br>
                                    <label>Ime:</label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" value="{{$user[0]->name}}" placeholder="Janez Novak">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                                        </div>
                                    </div>
                                    <br>
                                    <label>E-pošta:</label>
                                    <div class="input-group">
                                        <input type="email" name="email" value="{{$user[0]->email}}" class="form-control" id="exampleInputEmail1" placeholder="janez@email.com">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fas fa-at"></i></div>
                                        </div>
                                    </div>
                                    <br>
                                    <label>Telefon:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="phone" value="{{$user[0]->phone}}" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" im-insert="true">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fas fa-telephone"></i></div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-block btn-outline-success btn-md" style="max-width:200px;">Shrani</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                $('#users-doctors-list').append("<ul>");
                for(let i = 0; i < data.length; i++) {
                    let doctorId = data[i].doctor_id;
                    fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode='+doctorId+'&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType= browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
                        .then( res => res.json())
                        .then( res => {
                            let doctorsFirstName = res.DoctorInfos[0].DoctorFirstName;
                            let doctorsLastName = res.DoctorInfos[0].DoctorLastName;
                            // append
                            $('#users-doctors-list').append("<li>" + doctorsFirstName + " " + doctorsLastName + " <a href='#' class='edit-doctor text-danger' title='Izbriši' id='"+doctorId+"'><i class='fa fa-times'></i></a></li>");
                        });
                }
                $('#users-doctors-list').append("</ul>");

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

    $('body').on('click','.edit-doctor',function(e){
        e.preventDefault();
        if(!confirm('Ali res želite izbrisati tega zdravnika?')){return;}
        $.post('{{ route("admin.delete-doctor")  }}',{_token: "{{ csrf_token() }}", docId: $(this).attr('id') })
            .done(function(data){
                alert("Zdravnika izbrisan.");
                location.reload();
            });
    });
</script>
@endsection
