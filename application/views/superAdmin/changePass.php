<section class="dashboard-counts section-padding" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header d-flex align-items-center" >
     					<h2 class=" display display">User Form</h2>
     				</div>
     				<div class="card-body">
     					<p>Edit Record</p>
     					<div class="form-group row">
     						<div class="col-sm-4"></div>
     							<div class="table-responsive-sm"></div>
		                  			<table cellpadding="0" cellspacing="0" class="table" style="text-align: center;">
										<?php
											if(!empty($editData)){
												foreach ($editData as $key => $value) {
													$hiddenUserPass = $value->userPass;
										?>
		                  				<tr>
		                  					<td width="200">
		                  						<strong>Enter Current Password</strong>
		                  					</td>
		                  					<td>
		                  						<input type="text" placeholder="Enter Current Password" class="form-control " id="txtOldPass" autofocus>
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>Enter New Password</strong>
		                  					</td>
		                  					<td>
		                  						<input type="password" placeholder="Enter New Password" class="form-control " id="txtPassword1" >
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>Re-enter New Password</strong>
		                  					</td>
		                  					<td>
		                  						<input type="password" placeholder="Re-enter New Password" class="form-control " id="txtPassword2" >
																	<input type="password" placeholder="Re-enter New Password" class="form-control " id="hiddenUserPass" value="<?=$value->userPass?>" hidden>
		                  					</td>
		                  				</tr>
                                  		<?php  }} $group= $value->userGroupID;?>
		                  				<tr>
		                  					<td colspan="2">
		                  						<button class="btn btn-success rounded" id="save">Save</button>
		                  					<a href="<?php echo base_url('Welcome/index');?>">	<button class="btn btn-danger rounded">Cancel</button></a>
		                  					</td>
		                  				</tr>
		                  			</table>
		                  		</div>
	                  		</div>
                  		</div>
                 	</div>
     				</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php ?>
<script>
	var oldPass = "";
	var userPass1 = "";
	var userPass2 = "";
	var hiddenUserPass ="";
	var userStatus ="";
	var base_url ="<?php echo base_url();?>"
	var strCtr=0;
  	var userID =<?php echo $userID = $this->session->userdata['userSession']['user_ID'] ?>;
	$('#save').on('click',function(){
		oldPass	= $('#txtOldPass').val();
		hiddenUserPass	= $('#hiddenUserPass').val();
		userPass1 = $('#txtPassword1').val();
		userPass2 = $('#txtPassword2').val();
		if(userPass1 != userPass2){
			alert('Mismatched Password');
		}
		else {
			var confirmSave = confirm("Are you sure you want to save this User?");
			if(confirmSave == true){
				changePass(userPass1,hiddenUserPass,oldPass);
			}
			else{
			}
		}
	});
</script>
