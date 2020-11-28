@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2>Pretekli pregledi/rezervacije</h2>
        @forelse($reservations as $reservation)

            @if(($reservation->canceled === 1))
                <div class="callout callout-danger" title="preklicana">
            @elseif(\Carbon\Carbon::parse($reservation->start)->isPast())
                <div class="callout callout-warning" title="pretekla">
            @else
                 <div class="callout callout-success" title="aktivna">
            @endif
                <div class="row">
                    <div class="col-md-8">
                        <h5>Ambulanta: {{$reservation->workplace_id}}</h5>

                        <p>{{\Carbon\Carbon::parse($reservation->start)->format('h:i')}} - {{\Carbon\Carbon::parse($reservation->end)->format('h:i')}} <small>({{\Carbon\Carbon::parse($reservation->start)->format('d.m.Y')}})</small></p>
                    </div>
                    <div class="col-md-4">
                        @if(($reservation->canceled === 0) ?? (! \Carbon\Carbon::parse($reservation->start)->isPast()))
                            <a href="javascript:;" class="btn btn-danger cancel-reservation">Prekliči rezervacijo</a>
                            <input type="hidden" data-name="slotId" value="{{$reservation->workplace_id}}">
                            <input type="hidden" data-name="start" value="{{$reservation->start}}">
                            <input type="hidden" data-name="end" value="{{$reservation->end}}">
                            <input type="hidden" data-name="resid" value="{{$reservation->id}}">
                        @endif

                        @if($reservation->canceled === 1)
                            <i>Preklicana</i>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            Ni rezervacij ali pregledov
        @endforelse
    </div>


@endsection
@section('scripts')
    @parent

    <script>
        $(document).on('click','.cancel-reservation',function(e){
            e.preventDefault();
            if(confirm("Ali res želite preklicati ta termin?")){
                let slotId = $(this).siblings('input[data-name="slotId"]').val();
                let start = $(this).siblings('input[data-name="start"]').val();
                let end = $(this).siblings('input[data-name="end"]').val();
                let resid = $(this).siblings('input[data-name="resid"]').val();

                let dataToSend =
                    {
                        _token: "{{ csrf_token() }}",
                        "params": {
                            "Slot": {
                                "SlotId": slotId,
                                "Start": start,
                                "End": end
                            },
                            "KzzNumber": "{{\Illuminate\Support\Facades\Auth::user()->zzzs}}",
                            "ProviderZZZSNumber": "102320",
                            "Client": {
                                "UniqueDeviceId": "string",
                                "ClientType": "string",
                                "ApplicationVersion": "string",
                                "ApplicationId": "string"
                            }
                        }
                    };
                $.post('{{route('admin.api-cancelBookSlot')}}',dataToSend)
                    .done(function(data){
                        alert("Termin uspešno preklican");
                        $.post('{{route('admin.reservations-delete')}}',{_token: "{{ csrf_token() }}", id:resid})
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
    </script>

@endsection
