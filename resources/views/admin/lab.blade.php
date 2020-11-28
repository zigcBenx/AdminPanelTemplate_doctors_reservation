@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2>Rezervacija v laboratoriju</h2>

        <input type="hidden" id="user_kzz" value="{{$user->zzzs}}">
        <input type="hidden" id="user_phone" value="{{$user->phone}}">
        <input type="hidden" id="user_mail" value="{{$user->email}}">
        <input type="hidden" id="workplace_code"> <!--added on termini load-->

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-stethoscope"></i>
                </span>
            </div>
            <input type="text" class="form-control" id="lab-order-number" placeholder="Številka naročila">
            <a href="javascript:;" class="btn btn-success" id="submit-lab-order" >Pridobi proste termine za laboratorij <i class="fa fa-plus"></i></a>
        </div>

        <hr>
        <div class="lab-info" style="display: none;">
            <h4>Podatki o laboratoriju:</h4>
            <b>Naslov: </b> <span id="lab-naslov"></span><br>
            <b>Laboratorij: </b> <span id="lab-ime"></span><br>
            <b>Kontakt: </b> <span id="lab-kontakt"></span>
            <hr>
        </div>

        <div id="free-slots">

        </div>
        <div class="no-slots">Ni prostih terminov.</div>
    </div>
@endsection
@section('scripts')
    @parent

    <script>

        $(document).ready(function(){

            // display lab free slots
            $("#submit-lab-order").click(function(){
                let labNumber = $("#lab-order-number").val();
                showFreeSlots(labNumber);
            });


            $(document).on('click','.reserve-button',function(){
                let slotId = $(this).attr('id');
                let terminFrom = $(this).data('from');
                let terminTo = $(this).data('to');

                let userMail = $('#user_mail').val();
                let userPhone = $('#user_phone').val();
                let userKzz = $('#user_kzz').val();

                // Book a slot
                let dataToSend =
                    {
                        _token: "{{ csrf_token() }}",
                        "params": {
                            "Patient": {
                                "KzzNumber": userKzz,
                                "Email": userMail,
                                "Phone": userPhone,
                            },
                            "Slot": {
                                "SlotId": slotId,
                                "Start": terminFrom,
                                "End": terminTo,
                            },
                            "Comment": "string",
                            "Attachments": [
                                //{
                                //    "Name": "Name",
                                //    "Content": "0",
                                //    "Comment": "Comment"ssword

                                //},
                            ],
                            "WorkplaceCode": $('#workplace_code').val(),
                            "DoctorIVZCode": 0, // TODO: what here? this is laboratory and has no doctor?
                            "ProviderZZZSNumber": "102320",// fixed on trbovlje only,

                            "Client": {
                                "UniqueDeviceId": "A3DE534DB",
                                "ClientType": "browser (User-Agent)",
                                "ApplicationVersion": "1.22",
                                "ApplicationId": "myXlife"
                            }
                        }
                    };

                $.post('{{route('admin.api-bookSlot')}}',dataToSend)
                    .done(function(data){
                        if(!data.isSuccessful){
                            console.log(data);
                            if(data.ErrorDescription != null) {
                                alert(data.ErrorDescription);
                            }else{
                                successfullReservation(dataToSend);
                            }
                            return;
                        }
                        successfullReservation(dataToSend);

                    });

            });



            // insert lab reservation in database
            function successfullReservation(dataToSend){
                showFreeSlots($("#users-doctors-list").val(),$('input[name="date"]').val());
                //$('#reserve-modal').modal('hide');
                alert("Termin je uspešno rezerviran.");

                let slotId = dataToSend.params.Slot.SlotId;
                let workplace_id = dataToSend.params.WorkplaceCode;
                let start = dataToSend.params.Slot.Start;
                let end = dataToSend.params.Slot.End;

                console.log(slotId);
                console.log(workplace_id);

                // add reservation to database
                $.post('{{route('admin.reservations-create')}}', {_token: "{{ csrf_token() }}", 'slotId':slotId, 'workplace_id':workplace_id, 'start':start, 'end':end})
                    .done(function(data){
                        if(data == 'nojs'){
                            // termin je uspešno dodan v podatkovno bazo
                        }else{ // wtf should I do if it's not inserted successfully???
                        }
                    });
            }


            // show free lab slots
            function showFreeSlots(labNumber) {
                $.get("{{route('admin.api-requestFreeLabSlots')}}", {labNumber: labNumber})
                    .done(function (res) {
                        if(res.FreeSlots === undefined || res.FreeSlots === null || !res.FreeSlots.length){
                            $("#no-slots").show();
                            $("#free-slots").html('');
                            $('.lab-info').hide();
                        }else{
                            $("#no-slots").hide();
                            $("#free-slots").html('');
                            $('#workplace_code').val(res.WorkplaceCode);
                            $('#lab-ime').html(res.WorkplaceName);
                            $('#lab-kontakt').html(res.WorkplacePhone);
                            $('#lab-naslov').html(res.WorkplaceAddress);
                            $('.lab-info').show();
                            console.log(res.WorkplaceName);
                            console.log(res);
                            for (let i = 0; i < res.FreeSlots.length; i++) {
                                $("#free-slots").append(
                                    '<div class="callout callout-info">\n' +
                                    '                        <div class="row">\n' +
                                    '                            <div class="col-4">\n' +
                                    '                                <h5>' + $("#users-doctors-list option:selected").text() + '</h5>\n' +
                                    '                            </div>\n' +
                                    '                            <div class="col-4">\n' +
                                    '                                <p style="font-size:30px;">' + moment(res.FreeSlots[i].Start).format('H:mm') + " - " + moment(res.FreeSlots[i].End).format('H:mm') + '</p>' +
                                    '                            </div>\n' +
                                    '                            <div class="col-4">\n' +
                                    '                                <button type="button" data-from="'+res.FreeSlots[i].Start+'" data-to="'+res.FreeSlots[i].End+'" id="'+res.FreeSlots[i].SlotId+'" class="btn btn-info btn-lg reserve-button" style="float:right;">Naroči se</button>\n' +
                                    '                            </div>\n' +
                                    '                        </div>' +
                                    '                        <p>' + moment(res.FreeSlots[i].End).format('D.M.Y') + '</p>' +
                                    '                    </div>');

                            }
                        }

                        // TODO: loading add
                    });
            }

        });
    </script>
@endsection
