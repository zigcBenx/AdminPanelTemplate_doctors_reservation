<div class="modal fade" id="modal-doctor" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dodajanje zdravnika</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body card">
                <form action="" class="form" id="addDoctorForm">
                    <div class="zdravnik-name">
                        <b>Zdravnik:</b> <span id="doctorNameSpan"></span>
                    </div>

                    <div class="zdravnik-ambulanta">
                        <label for="ambulante">Ambulanta</label>
                        <select name="ambulante" class="form-control" id="ambulante"></select>
                    </div>
                    <br>
                    <div class="ambulanta-okvir card">
                        <div class="card-header">Ambulanta</div>
                        <div class="card-body">
                            <span id="providerName"></span><br>
                            <span id="workplaceName"></span><br>
                            <b>Naslov: </b><span id="doctorAddress"></span><br>
                        </div>
                    </div>
                    <br>
                    <div class="kontakt-okvir card">
                        <div class="card-header">Kontakt</div>
                        <div class="card-body">
                            <b>Telefon: </b><span id="doctorPhone"></span><br>
                            <b>E-pošta: </b><span id="doctorEmail"></span><br>
                        </div>
                    </div>

                    <div class="dejavnosti-okvir card">
                        <div class="card-header">Dejavnosti</div>
                        <div class="card-body">
                            <div>
                                <ul id="dejavnosti"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="storitve-okvir card">
                        <div class="card-header">Storitve</div>
                        <div class="card-body">
                            <div>
                                <ul id="storitve"></ul>
                            </div>
                        </div>
                    </div>

                </form>
                <input type="hidden" id="doctorsInfoArr">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zapri</button>
                <input type="hidden" id="doctor-id">
                <button type="button" class="btn btn-primary" id="save-doctor-button">Dodaj zdravnika</button>
                <button type="button" class="btn btn-warning" id="edit-doctor-button">Uredi zdravnika</button>
                <button type="button" class="btn btn-danger" id="delete-doctor-button">Izbriši zdravnika</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
