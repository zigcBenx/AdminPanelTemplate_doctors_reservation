<template>
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Urejanje profila</div>

                    <div class="card-body">
                        {{$user}}
                    	<div class="input-group">
							<input type="text" class="form-control" placeholder="ZZZS številka">
							<div class="input-group-append">
								<div class="input-group-text"><i class="fas fa-hospital"></i></div>
							</div>
		                </div>
						<br>
						<label>Ime:</label>
						<div class="input-group">
                        	<input type="text" class="form-control" placeholder="Janez">
                        	<div class="input-group-append">
								<div class="input-group-text"><i class="fas fa-user"></i></div>
							</div>
                      	</div>
						<br>
						<label>Priimek:</label>
                      	<div class="input-group">
                        	<input type="text" class="form-control" placeholder="Novak">
                        	<div class="input-group-append">
								<div class="input-group-text"><i class="fas fa-user"></i></div>
							</div>
                      	</div>
						<br>
						<label>E-pošta:</label>
						<div class="input-group">
							<input type="email" class="form-control" id="exampleInputEmail1" placeholder="janez@email.com">
							<div class="input-group-append">
								<div class="input-group-text"><i class="fas fa-at"></i></div>
							</div>
						</div>
						<br>
                    	<label>Telefon:</label>
                    	<div class="input-group">
		                    <div class="input-group-prepend">
		                    	<span class="input-group-text"><i class="fas fa-phone"></i></span>
		                    </div>
		                	<input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" im-insert="true">
		                	<div class="input-group-append">
								<div class="input-group-text"><i class="fas fa-telephone"></i></div>
							</div>
		                </div>
						<br>
		                <button type="button" class="btn btn-block btn-outline-success btn-md" style="max-width:200px;">Shrani</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
