@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-lg-12">
        	<div class="container">
                <div class="termini">

                    <div class="form-group">

                        <label for="datepicker">Date range:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
						<span class="input-group-text">
							<i class="far fa-calendar-alt"></i>
						</span>
                            </div>
                            <input type="text" class="form-control float-right date" id="datepicker">
                        </div>
                        <br>
                        <label for="users-doctors-list">Vaši zdravniki</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
						<span class="input-group-text">
							<i class="far fa-hospital"></i>
						</span>
                            </div>
                            <select name="" id="users-doctors-list" class="form-control float-right" >

                            </select>
                            <a href="/admin" class="btn btn-success">Dodaj zdravnika <i class="fa fa-plus"></i></a>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <hr>
                    <p>Ni možnih rezervacij za ta termin.</p>
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-8">
                                <h5>Termin 1: Dohter Janez</h5>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-info btn-lg" style="float:right;">Naroči se</button>
                            </div>
                        </div>
                        <p> OD DO PLACE</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
@parent

<script>
    $(document).ready(function () {
        $.post('{{ route("admin.user-doctor-show") }}', {_token: "{{ csrf_token() }}"})
            .done( function(data) {
                // prikaži proste termine za prvega dohterja?
                showFreeSlots(data[0].doctor_id);

                $('#users-doctors-list').html('');
                for(let i = 0; i < data.length; i++) {
                    let doctorId = data[i].doctor_id;
                    fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode='+doctorId+'&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType= browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
                        .then( res => res.json())
                        .then( res => {
                            let doctorsFirstName = res.DoctorInfos[0].DoctorFirstName;
                            let doctorsLastName = res.DoctorInfos[0].DoctorLastName;
                            $("#users-doctors-list").append('<option value="'+res.DoctorInfos[0].DoctorIVZCode+'">'+doctorsFirstName+' '+doctorsLastName+'</option>')
                        });
                }

            });

        function showFreeSlots(docId) {
            $.post('{{route('admin.get-work-place')}}', {_token: "{{ csrf_token() }}", docId:docId})
                .done(function(data){
                    alert(data);
                });
            // from User_Doctor ->  check if authorized user has this doctor and in which workplace
            //check free slots for this doctor for this workplace
            //display them + button NAROČI SE
        }
    });
</script>
@endsection
