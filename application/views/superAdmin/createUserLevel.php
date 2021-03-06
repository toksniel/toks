<section class="dashboard-counts section-padding" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header d-flex align-items-center" >
     					<h2 class=" display display">Group</h2>
     				</div>
     				<div class="card-body">
     					<p>Fill Record</p>
     					<div class="form-group row">
     						<div class="col-sm-4"></div>
     							<div class="table-responsive-sm"></div>
		                  			<table cellpadding="0" cellspacing="0" class="table" style="text-align: center;">
		                  				<tr>
		                  					<td width="110">
		                  						<strong>Group <br> Name</strong>
		                  					</td>
		                  					<td><span id="test"></span>
												  <input type="text" placeholder="Group Name" class="form-control " id="txtUserLevel"
												  value = "<?php if( !empty($saved) ){ echo $saved[0]->levelname; }?>" >
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td>
		                  						<strong>Group <br> Parent </strong>
		                  					</td>
		                  					<td>
		                  						<select class="form-control" id="textNewLevel">
													<?php 
														$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
														if($id == 0 ){
															echo '<option>New Group</option>';
														} 
													?>
													  <?php
													  $geg;
													 	if( !empty($saved) ){
														   $gege = $saved[0]->userParentID; 
														   foreach ($childID as $key => $value) {
															   if($gege == $value->userLevelChildUID){
																echo '<option value="'.$value->userLevelChildUID.'" selected>'.$value->levelname.'</option>';
															   }else{
																echo '<option value="'.$value->userLevelChildUID.'">'.$value->levelname.'</option>';
															   }
															}
														}else{
															foreach ($childID as $key => $value) {
																echo '<option value="'.$value->userLevelChildUID.'">'.$value->levelname.'</option>';
															}
														}
		                  							?>
		                  						</select>
		                  					</td>
		                  				</tr>
		                  				<tr>
		                  					<td colspan="2">
		                  						<button class="btn btn-success rounded" id="save">Save</button>
		                  						<a href="<?php echo base_url('Admin/userLevelMaster');?>"<button class="btn btn-danger rounded">Cancel</button></a>
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
	var userLevel ="";
	var	textNewLevel ="";
	var strCtr=0;
	var textNewLevel="";
	var santaclauseiscomingtotown = <?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;?>;
	var base_url ="<?php echo base_url();?>"
	$('#save').on('click',function(){
		userLevel = $('#txtUserLevel').val();
		newLevelID = $('#textNewLevel').val();
		textNewLevel =$('#textNewLevel').find('option:selected').text();
		var confirmSave = confirm("Are you sure you want to save New Level?");
		if(confirmSave = true){
			strCtr+=1;
			newlevel(newLevelID,userLevel);
		}
		if(strCtr==1){
		}
	});
	function newlevel(newLevelID,userLevel){
		console.log(santaclauseiscomingtotown);
		$.ajax({
			type:'get',
			url :base_url+"Admin/ajaxNewLevel",
			data:{
			'ajaxnewLevelID': newLevelID,
			'ajaxuserLevel': userLevel,
			'ajaxGID' :santaclauseiscomingtotown
			},
			success: function(data){
			},
			error:function(){
			alert("Error");
			}
		});
	}
</script>
                                   