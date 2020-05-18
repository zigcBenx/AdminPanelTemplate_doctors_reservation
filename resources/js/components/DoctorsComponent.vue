<template>
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Izberi zdravnika</div>

                    <div class="card-body">
                    	Trenutno izbran zdravnik: <span><b>Joze Novak</b></span> <i class="fas fa-pencil-alt"></i>
                    	<table>
                    		<tr>
                    			<td>
                    				<select class="form-control">
			                        	<option value="" v-for="doctor in doctors" :key="doctor.DoctorIVZCode">
			                        		{{ doctor.DoctorFirstName }} {{ doctor.DoctorLastName }}
			                        	</option>
			                        </select>			
                    			</td>
                    			<td>
                    				<button type="button" class="btn btn-block btn-outline-success btn-md" style="max-width:200px;">Shrani</button>
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
    export default {
    	data(){
    		return {
    			doctors : []
    		}
    	},
    	created(){
    		this.fetchDoctors()
    	},
    	methods: {
    		fetchDoctors(){
    			fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=mozilla&request.client.applicationVersion=1.0')
    			.then( res => res.json())
    			.then( res => {
    				this.doctors = res.Doctors;
    			})
    		}
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