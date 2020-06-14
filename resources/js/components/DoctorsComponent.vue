<template>
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Izberi zdravnika</div>

                    <div class="card-body">
                    	Moji zdravniki: <span id="users-doctors-list"></span>
                    	<table>
                    		<tr>
                    			<td>
                    				<select class="form-control" id="doctorsList">
			                        	<option v-for="doctor in doctors" :key="doctor.DoctorIVZCode" :value="doctor.DoctorIVZCode">
			                        		{{ doctor.DoctorFirstName }} {{ doctor.DoctorLastName }}
			                        	</option>
			                        </select>
                    			</td>
                    			<td>
                    				<button type="button" class="btn btn-block btn-outline-success btn-md" style="max-width:200px;" @click="showModal">Dodaj zdravnika</button>
                    			</td>
                    		</tr>
                    	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    /**
     *
     * YOUUU ALOOO
     * Tale API moreš drugič uporabljat curl -X GET "https://durs.comtrade.com/ctNarocanje/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=browser&request.client.applicationVersion=1.22&request.client.applicationId=myXlife" -H  "accept: application/json"
     * !!! tro jes dejasnko testni od comtrada tist je biu pa od zd trbovlje
     *
     *
     *
     *
     *
     */
    export default {
    	data(){
    		return {
    			doctors : [],
                doctorInfo: null,
                link: 'https://durs.comtrade.com/ctNarocanje', // https://enarocanje-gw1.comtrade.com/ctNarocanjeTest
    		}
    	},
    	created(){
    		// fetch doctors was here before
    	},
    	methods: {
    		fetchDoctors(){
    			fetch('https://durs.comtrade.com/ctNarocanje/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=browser&request.client.applicationVersion=1.22&request.client.applicationId=myXlife',{mode:'cors'})
    			.then( res => res.json())
    			.then( res => {
    			    console.log("SUCCESS:");
    			    console.log(res);
    				this.doctors = res.Doctors;
    			}).catch(function(error) {
    			    console.log("FUCK YOU:");
                    console.log(error);
                });
    		},
            showModal(){
                $('#modal-doctor').modal('show');

                // show only save button and hide others
                $("#save-doctor-button").show();
                $("#edit-doctor-button").hide();
                $("#delete-doctor-button").hide();

                // get doctor from select input
                let selectedDoctorsName = $("#doctorsList option:selected").text().trim();
                let selectedDoctorsId = $("#doctorsList option:selected").val();
                // get Doctor data https://durs.comtrade.com
                //https://enarocanje-gw1.comtrade.com
                fetch('https://durs.comtrade.com/ctNarocanje/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode='+selectedDoctorsId+'&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType= browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
                .then( res => res.json())
                .then( res => {
                    this.doctorInfo = res.DoctorInfos;

                    // set doctor id to form input
                    $('#doctor-id').val("");
                    $('#doctor-id').val(selectedDoctorsId);

                    $("#doctorNameSpan").html("");
                    $("#doctorNameSpan").append('<b>'+selectedDoctorsName+'</b>');


                    // for later select on change -> see home.blade.php javascript
                    $('#doctorsInfoArr').val("");
                    $('#doctorsInfoArr').val(JSON.stringify(this.doctorInfo));

                    // populate first auto selected doctors info
                    $('#doctorAddress').html(this.doctorInfo[0].WorkplaceAddress);
                    $('#doctorPhone').html(this.doctorInfo[0].WorkplacePhone);
                    $('#doctorEmail').html(this.doctorInfo[0].DoctorEmail);
                    $('#providerName').html(this.doctorInfo[0].ProviderName);
                    $('#workplaceName').html(this.doctorInfo[0].WorkplaceName);

                    $('#dejavnosti').html('');
                    for (let i =0; i< this.doctorInfo[0].VZPs.length;i++){
                        $('#dejavnosti').append('<li>'+this.doctorInfo[0].VZPs[i].Description+'</li>')
                    }

                    $('#storitve').html('');
                    for (let i =0; i< this.doctorInfo[0].VZSs.length;i++){
                        $('#storitve').append('<li>'+this.doctorInfo[0].VZSs[i].Description+'</li>')
                    }

                    // populate ambulante
                    $('#ambulante').html("");
                    for (let i = 0; i<this.doctorInfo.length;i++){
                        $('#ambulante').append($('<option>', {
                            value: this.doctorInfo[i].WorkplaceCode,
                            text: this.doctorInfo[i].WorkplaceName
                        }));
                    }

                });
            }
    	},
        mounted() {
            this.fetchDoctors(); // before was in created
        }
    }
</script>
