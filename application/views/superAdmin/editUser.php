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
										?>
		                  				<tr>
		                  					<td width="110">
		                  						<strong>First Name</strong>
		                  					</td>
		                  					<td>
		                  						<input type="text" placeholder="First Name" class="form-control " id="txtFirstName" value="<?=$value->userFirstName?>" >
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>Last Name</strong>
		                  					</td>
		                  					<td>
		                  						<input type="text" placeholder="Last Name" class="form-control " id="txtLastName" value="<?=$value->userLastName?>">
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>User Position</strong>
		                  					</td>
		                  					<td>
		                  						<input type="text" placeholder="Position" class="form-control " id="txtPosition" value="<?=$value->userJobDesc?>">
		                  					</td>
		                  				</tr>
															<tr>
		                  					<td>
		                  						<strong>Email</strong>
		                  					</td>
		                  					<td>
		                  						<input type="text" placeholder="Email" class="form-control " id="txtEmail" value="<?=$value->userEmail?>">
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>Username</strong>
		                  					</td>
		                  					<td>
		                  						<input type="text" placeholder="Username" class="form-control " id="txtUsername" value="<?=$value->userName?>" readonly>
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>Assigned Group</strong>
		                  					</td>
		                  					<td>
											  <?php  }} $group= $value->userGroupID;
											  $roleD = $value->sytemRole;?>
												<select id="userGroup" class="form-control" >
													<option value="">Select User Group</option>
													<?php
														foreach ($userLevel as $key => $value) {
															if($group ==$value->userLevelChildUID){
																echo '<option value="'. $value->userLevelChildUID .'" selected>'. $value->levelname .'</option>';
															}else{
																echo '<option value="'. $value->userLevelChildUID .'">'. $value->levelname .'</option>';
															}
														}
													?>
												</select>
		                  					</td>
		                  				</tr>
										<tr>
		                  					<td>
		                  						<strong>System Role</strong>
		                  					</td>
		                  					<td>
												<select id="systemRole" class="form-control" >
													<option value="">Select a Role</option>
													<?php
													if(!empty($roleList))
														foreach ($roleList as $key => $value) {
															if($roleD ==$value->rrID){
																echo '<option value="'. $value->rrID .'" selected>'. $value->rr_name .'</option>';
															}else{
																echo '<option value="'. $value->rrID .'">'. $value->rr_name .'</option>';
															}
														}
													?>
												</select>
		                  					</td>
		                  				</tr>
										<tr>
											<td>
												<strong>User Status</strong>
											</td>
											<td>
												<select class="form-control" name="" id="userStatus">
													<option value="Internal">Internal</option>
													<option value="External">External</option>
													<option value="Interim">Interim</option>
												</select>
											</td>
										</tr>
		                  				<tr>
		                  					<td colspan="2">
		                  						<button class="btn btn-success rounded" id="save">Save</button>
		                  						<a href="<?php echo base_url('Admin/index');?>">	<button class="btn btn-danger rounded">Cancel</button></a>
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

<script>
	var userFirstName = "";
	var userLastName = "";
	var userPosition = "";
	var userName = "";
	var userEmail = "";
	var userStatusText = document.getElementById("userStatus").options;
	var userStatus ="";
	var base_url ="<?php echo base_url();?>"
	var strCtr=0;
  	var userID =<?php echo $userID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ?>;
	var systemRORE;
	$('#save').on('click',function(){
		userFirstName = $('#txtFirstName').val();
		userLastName = $('#txtLastName').val();
		userJobDesc = $('#txtPosition').val();
		userName = $('#txtUsername').val();
		userGroup = $('#userGroup').val();
		userStatusText =$('#userGroup').find('option:selected').text();
		userStatus = $('#userStatus').val();
		userEmail =  $('#txtEmail').val();
		systemRORE =  $('#systemRole').val();
		var confirmSave = confirm("Are you sure you want to save this User?");
		if(confirmSave == true){
			editUser(userName,userLastName,userFirstName,userJobDesc,userGroup,userStatusText,userStatus,userEmail,systemRORE);
		}else{
			location.reload();
		}
	});
	function editUser(userName,userLastName,userFirstName,userJobDesc,userGroupID,userStatusText,userStatus,userEmail,systemRORE){
	  $.ajax({
	    type:'get',
	    url :base_url+"Admin/ajaxEditUser/"+userID,
	    data:{
			'ajaxUserName': userName,
			'ajaxUserLname': userLastName,
			'ajaxUserFname': userFirstName,
			'ajaxUserJob' : userJobDesc,
			'ajaxuserGroup' : userGroupID,
			'ajaxcgroupUserLevel': userStatusText,
			'ajaxUserStatus':userStatus,
			'ajaxEmail':userEmail,
			'ajaxRole' : systemRORE
	    },
	    success: function(data){
	      location.reload();
	    },
	    error:function(){
	      alert("Error");
	    }
	  });
	}
</script>
              