<template>
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
            <label for="doctor">Vaši zdravniki</label>
            <div class="input-group">
                <div class="input-group-prepend">
						<span class="input-group-text">
							<i class="far fa-hospital"></i>
						</span>
                </div>
                <select name="" id="doctor" class="form-control float-right">
                    <option :value="Janko">Janko</option>
                    <option :value="Metka">Metka</option>
                    <option :value="Carovnica">Carovnica</option>
                </select>
                <button class="btn btn-success">Dodaj zdravnika <i class="fa fa-plus"></i></button>
            </div>
            <!-- /.input group -->
        </div>

        <hr>
        <p>Ni možnih rezervacij za ta termin.</p>
        <div class="callout callout-info" v-for="termin in termini.FreeSlots"  :key="termin.SlotId">
            <div class="row">
                <div class="col-8">
                    <h5>Termin 1: Dohter Janez</h5>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-info btn-lg" style="float:right;">Naroči se</button>
                </div>
            </div>
            <p>{{termin.End}} - {{termin.Start}}</p>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                termini : {
                    "FreeSlots": [
                        {
                            "SlotId": 0,
                            "Start": "2020-05-23T15:35:44.049Z",
                            "End": "2020-05-23T16:35:44.049Z"
                        },
                        {
                            "SlotId": 1,
                            "Start": "2020-05-23T16:35:44.049Z",
                            "End": "2020-05-23T17:35:44.049Z"
                        },
                        {
                            "SlotId": 1,
                            "Start": "2020-05-23T17:35:44.049Z",
                            "End": "2020-05-23T18   :35:44.049Z"
                        }
                    ],
                    "IsSuccessful": true,
                    "ErrorCode": "string",
                    "ErrorDescription": "string"
                },
                doctor:'', // value from select
            }
        },
        created(){

        },
        methods: {
            /*fetchFreeSlots(){
                fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=mozilla&request.client.applicationVersion=1.0')
                    .then( res => res.json())
                    .then( res => {
                        this.doctors = res.Doctors;
                    })
            }*/
        },
        mounted() {
            // $.get('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=mozilla&request.client.applicationVersion=1.0', function(data,status){
            // 	this.doctors = ['a','b'];
            // 	console.log(data.Doctors);
            // 	console.log(status);
            // });

            //this.doctors = ['d1','d2','d3'];
        }
    }
</script>
