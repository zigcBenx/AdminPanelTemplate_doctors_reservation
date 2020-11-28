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
                <a href="javascript:;" class="btn btn-success" id="request-receipt">Zahtevaj recept <i class="fas fa-receipt"></i></a>
            </div>
            <!-- /.input group -->
        </div>
        <h2>Izdani recepti</h2>
        <hr>
        <input type="hidden" id="user_kzz" value="{{$user->zzzs}}">
        <input type="hidden" id="user_phone" value="{{$user->phone}}">
        <input type="hidden" id="user_mail" value="{{$user->email}}">
        @forelse($recepti as $recept)
        <div class="callout callout-warning">
            <div class="row">
                <div class="col-md-8">
                    <h5>Opis: {{ $recept->comment }}</h5>

                    <p>Ambulanta: {{ $recept->workplaceCode }}</p>
                </div>
                <div class="col-md-4">
                    @if ($recept->canceled)
                        <i>Preklican</i>
                    @else
                        <a href="javascript:;" class="btn btn-danger cancel-perscription">Prekliči izdajo recepta</a>
                        <input type="hidden" data-name="workplaceCode" value="{{$recept->workplaceCode}}">
                        <input type="hidden" data-name="doctorIVZ" value="{{$recept->doctorIVZCode}}">
                        <input type="hidden" data-name="requestId" value="{{$recept->requestId}}">
                        <input type="hidden" data-name="requestTime" value="{{$recept->requestTime}}">
                        <input type="hidden" data-name="comment" value="{{$recept->comment}}">
                        <input type="hidden" data-name="resid" value="{{$recept->id}}">
                    @endif
                </div>
            </div>
        </div>
        @empty
            Nimate izdanih receptov.
        @endforelse


    </div>
@include('partials.receipt-modal')
@endsection
@section('scripts')
    @parent

    <script>
        $(document).ready(function() {
            /**
             * Show modal
             */
            $('#request-receipt').click(function(){
                if(!$.isNumeric($("#users-doctors-list").val())){
                    alert("Prosimo izberite zdravnika.");
                    return;
                }
                $('#doctor_name').html($("#users-doctors-list option:selected").text());
                $('#receipt-modal').modal('show');

            });

            /**
             * Submit receipt request
             */
            $('#request-receipt-button').click(function(){
                $.post('{{route('admin.get-work-place')}}', {_token: "{{ csrf_token() }}", docId:$("#users-doctors-list").val()})
                    .done(function(data) {
                        let workplaceOfselectedDoctor = data[0].workspace;
                        let dataToSubmit = {
                            '_token': "{{ csrf_token() }}",
                            "params": {
                                "WorkplaceCode": workplaceOfselectedDoctor,
                                "DoctorIVZCode": $("#users-doctors-list").val(),
                                "RequestId": $.now(),
                                "Patient": {
                                    "KzzNumber": $('#user_kzz').val(),
                                    "Email": $('#user_mail').val(),
                                    "Phone": $('#user_phone').val()
                                },
                                "Comment": $('#pripomba').val(),
                                "CBZNacionalnaSifraZdravila": "002160",
                                "CBZPoimenovanjeZdravila": "Granisetron Lek 1 mg filmsko obložene tablete",
                                //"Attachments": [
                                //     {
                                //         "Name": "string",
                                //         "Content": "string",
                                //         "Comment": "string"
                                //     }
                                //],
                                "ProviderZZZSNumber": "102320",
                                "Client": {
                                    "UniqueDeviceId": "A3DE534DB",
                                    "ClientType": "browser (User-Agent)",
                                    "ApplicationVersion": "1.22",
                                    "ApplicationId": "myXlife"
                                }
                            }
                        };
                        $.post("{{route('admin.api-requestPerscription')}}", dataToSubmit)
                            .done(function (data) {
                                if(data.IsSuccessful) {
                                    alert("Zahtevek uspešno oddan!");
                                    $('#receipt-modal').modal('hide');

                                    // dodaj recept
                                    let requestId = dataToSubmit.params.RequestId;
                                    let workplace_id = dataToSubmit.params.WorkplaceCode;
                                    let comment = dataToSubmit.params.Comment;
                                    let doctorCode = dataToSubmit.params.DoctorIVZCode;


                                    // add reservation to database
                                    $.post('{{route('admin.addPerscription')}}', {_token: "{{ csrf_token() }}", 'requestId':requestId, 'workplace_id':workplace_id, 'comment':comment, 'doctorCode':doctorCode})
                                        .done(function(data){
                                            if(data == 'nojs'){
                                                // termin je uspešno dodan v podatkovno bazo
                                                console.log("termin je uspešno dodan v bazo");
                                                location.reload();
                                            }else{ // wtf should I do if it's not inserted successfully???
                                                console.log(data);
                                            }
                                        });
                                    // reload location
                                }else{
                                    alert("Opps, nekaj je šlo narobe, prosimo preverite, ali ste izpolnili vsa polja.");
                                    console.log(data);
                                }
                            });
                    });
            });

            $.post('{{ route("admin.user-doctor-show") }}', {_token: "{{ csrf_token() }}"})
                .done(function (data) {
                    $('#users-doctors-list').html('');
                    if (data.length == 0) {
                        $('.loading').hide();
                        $("#no-doctor").show();
                        return;
                    }
                    displayDoctor = data[0].doctor_id;
                    $("#users-doctors-list").append('<option>Izberi zdravnika</option>')
                    for (let i = 0; i < data.length; i++) {
                        let doctorId = data[i].doctor_id;
                        fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode=' + doctorId + '&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType= browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
                            .then(res => res.json())
                            .then(res => {
                                let doctorsFirstName = res.DoctorInfos[0].DoctorFirstName;
                                let doctorsLastName = res.DoctorInfos[0].DoctorLastName;
                                $("#users-doctors-list").append('<option value="' + res.DoctorInfos[0].DoctorIVZCode + '">' + doctorsFirstName + ' ' + doctorsLastName + '</option>')
                            });
                    }
                    $('.loading').hide();

                });


            // preklic zahtevka recepta
            $(document).on('click','.cancel-perscription',function(e){
                e.preventDefault();
                if(confirm("Ali res želite preklicati ta termin?")){
                    let workplaceCode = $(this).siblings('input[data-name="workplaceCode"]').val();
                    let doctorIVZ = $(this).siblings('input[data-name="doctorIVZ"]').val();
                    let requestId = $(this).siblings('input[data-name="requestId"]').val();
                    let requestTime = $(this).siblings('input[data-name="requestTime"]').val();
                    let comment = $(this).siblings('input[data-name="comment"]').val();
                    let resid = $(this).siblings('input[data-name="resid"]').val();

                    let dataToSend =
                        {
                            _token: "{{ csrf_token() }}",
                            "params": {
                                "WorkplaceCode": workplaceCode,
                                "DoctorIVZCode": doctorIVZ,
                                "RequestId": requestId,
                                "PrescriptionRequestedOn": requestTime,
                                "Patient": {
                                    "KzzNumber": $('#user_kzz').val(),
                                    "Email": $('#user_mail').val(),
                                    "Phone": $('#user_phone').val()
                                },
                                "Comment": comment,
                                "ProviderZZZSNumber": "102320",
                                "Client": {
                                    "UniqueDeviceId": "KrnekiRes",
                                    "ClientType": "Full dobr",
                                    "ApplicationVersion": "1.2",
                                    "ApplicationId": "myXlife"
                                }
                            }
                        };
                    $.post('{{route('admin.api-cancelPerscription')}}',dataToSend)
                        .done(function(data){
                            console.log(data);
                            alert("Zahtevek uspešno preklican");
                            $.post('{{route('admin.removePerscription')}}',{_token: "{{ csrf_token() }}", id:resid})
                                .done(function(data){
                                    console.log("reservation canceled");
                                    location.reload(); // reload, so status of termini is correctly displayed
                                })
                                .fail(function(xhr, status, error){
                                    console.log(xhr);
                                    console.log(status);
                                    console.log(error);
                                });
                        })
                        .fail(function(xhr, status, error){
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        });
                }
            });
        });
    </script>

@endsection
