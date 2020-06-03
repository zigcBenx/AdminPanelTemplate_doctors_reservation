<div class="modal fade" id="reserve-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rezervacija termina</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <b>Zdravnik: </b> <span id="doctor_name"></span>
                </div>
{{--                <div class="form-group">--}}
{{--                    <b>Ambulanta: </b> <span id="workplace_name"></span>--}}
{{--                </div>--}}
                <div class="form-group">
                    <b>Termin: </b> <span id="termin_name"></span>
                </div>
                <div class="form-group">
                    <label for="pripomba">Pripombe:</label>
                    <textarea class="form-control" name="" id="pripomba" cols="8" rows="1" placeholder="Tukaj vnesite morebitne pripombe ..."></textarea>
{{--                    <i>Priloge</i>--}}
                </div>
            </div>
            <input type="hidden" id="user_kzz" value="{{$user->zzzs}}">
            <input type="hidden" id="user_phone" value="{{$user->phone}}">
            <input type="hidden" id="user_mail" value="{{$user->email}}">
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Zapri</button>
                <button type="button" class="btn btn-success" id="reserveTermin">Rezerviraj</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
