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

        <div class="callout callout-warning">
            <h5>Recept1: Bla asd</h5>

            <p>Tdsf sd fsd fds ut.</p>
        </div>
        <div class="callout callout-warning">
            <h5>Recept2: Bla fgh</h5>

            <p>Sasd asff dsfd sdf.</p>
        </div>
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
                            "WorkplaceCode": workplaceOfselectedDoctor,
                            "DoctorIVZCode": $("#users-doctors-list").val(),
                            "RequestId": $.now(),
                            "Patient": {
                                "KzzNumber": $('#user_kzz').val(),
                                "Email": $('#user_mail').val(),
                                "Phone": $('#user_phone').val()
                            },
                            "Comment": $('#pripomba').val(),
                            // "Attachments": [
                            //     {
                            //         "Name": "string",
                            //         "Content": "string",
                            //         "Comment": "string"
                            //     }
                            // ],
                            "ProviderZZZSNumber": "102320",
                            "Client": {
                                "UniqueDeviceId": "A3DE534DB",
                                "ClientType": "browser (User-Agent)",
                                "ApplicationVersion": "1.22",
                                "ApplicationId": "myXlife"
                            }
                        };
                        $.post("https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/RequestPrescription", dataToSubmit)
                            .done(function (data) {
                                if(!data.IsSuccessful){
                                    alert(data.ErrorDescription);
                                    // return;
                                }
                                console.log(data);
                                // do whač ju goda do
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
        });
    </script>

@endsection
