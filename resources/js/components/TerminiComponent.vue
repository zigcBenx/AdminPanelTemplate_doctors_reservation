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
                            "SlotId": 2,
                            "Start": "2020-05-23T17:35:44.049Z",
                            "End": "2020-05-23T18   :35:44.049Z"
                        }
                    ],
                    "IsSuccessful": true,
                    "ErrorCode": "string",
                    "ErrorDescription": "string"
                },
                doctors:[], // value from select
            }
        },
        created(){
            // this.getUsersDoctors();
        },
        methods: {
            // getUsersDoctors(){
            //     fetch('/admin/user-doctor-show', {_token: "{{ csrf_token() }}"})
            //
            //         .then( res => {
            //             console.log(res);
            //             // $('#users-doctors-list').html('');
            //             // for(let i = 0; i < data.length; i++) {
            //             //     let doctorId = data[i].doctor_id;
            //             //     fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode='+doctorId+'&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType= browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
            //             //         .then( res => res.json())
            //             //         .then( res => {
            //             //             let doctorsFirstName = res.DoctorInfos[0].DoctorFirstName;
            //             //             let doctorsLastName = res.DoctorInfos[0].DoctorLastName;
            //             //             console.log(res.DoctorInfos[0].DoctorFirstName)
            //             //             // $('#users-doctors-list').option("<b>" + doctorsFirstName + " " + doctorsLastName + "</b>,");
            //             //         });
            //             // }
            //
            //         });
            // },
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
