<section class="dashboard-counts section-padding" >
	<div class="container-fluid">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h1 class="display" ><u><b>Role List</b></u></h1>
			</div>
			<div class="card-body">
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modulesLIST">Modules with Permission</button>
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modules">New Module with Permission </button>
			<br><br>
				<table class="table table-hover" >
					<thead>
						<tr>
							<th>ID #</th>
							<th>Name</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$dateNow = date("n/d/Y");
							foreach ($userLevel as $key => $value) {
								echo '<tr>';
									echo '<td width="5%">'. $value->rrID .'</td>';
									echo '<td width="45%">'. $value->rr_name .' </td>';
									echo '
										<td width="10%">
										<a href="'.base_url().'Admin/editaccess/'.$value->rrID.'" class="btn btn-sm btn-primary fa fa-pencil-square "></a>   
										<button class="btn btn-sm btn-danger fa fa-trash " onclick="uRbye('.$value->rrID.')"></button> 
										</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
				<div  style="float: right;">
					<a href="<?php echo base_url('Admin/useraccess');?>"><button class="btn btn-primary rounded">Add+</button></a>
					<a href="<?php echo base_url('Admin/index');?>"><button class="btn btn-danger rounded">Cancel</button></a>
				</div>
		</div>
	</div>
</div>
<div id="reminder" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	 			<h4 class="modal-title">System Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		<div class="modal-body">
			<p>Are you sure you want to permanently delete this?</p>
		</div>
		<div class="modal-footer">
	  	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="bbye()">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
      </div>
    </div>
  </div>
</div>
<div id="modulesLIST" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	 			<h4 class="modal-title"> Modules </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 55px;">
				<?php 
					if(!empty($modList)){
						foreach ($modList as $key => $value ){
							echo '<h5>'.$value->accessGroup.'</h5>';
						}
					}
				?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>
<div id="modules" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	 			<h4 class="modal-title"> New Module with Permission </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
				<label>Module Name : </label> <input type="text" id="ggname" class="form-control roundedRec">
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-default btn-info" data-dismiss="modal" onclick="newModule()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
      </div>
    </div>
  </div>
</div>
</section>
<script>
var heh;
var base_url ="<?php echo base_url();?>";
	function uRbye(int){
		heh = int;
		$('#reminder').modal('toggle');
	}
	function bbye(){
		$.ajax({
			url: base_url+"Admin/role_rem_noragrets/"+heh,
			type: "post",
			success: function(data){
			window.location.reload();
			}
		});
	}
	function newModule(){
		var mname = $('#ggname').val();
		console.log(mname);
		$.ajax({
			url: base_url+"Admin/newmod/",
			type: "post",
			data: { 'modname' : mname },
			success: function(data){
			window.location.reload();
			}
		});
	}
</script>   