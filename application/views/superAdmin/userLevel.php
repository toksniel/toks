<section class="dashboard-counts section-padding" >
	<div class="container-fluid">
		<div class="card">
			<div class="card-header d-flex align-items-center">
					<h1 class="display"><u><b>Group List</b></u></h1>
			</div>
			<div class="card-body">
				<div class="table table-responsive">
				<table id="example" class="table table-hover" >
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
										echo '<td width="5%">'. $value->userLevelChildUID .'</td>';
										echo '<td width="45%">'. $value->levelname .' </td>';
										echo '<td width="10%">
											<a href="'.base_url().'Admin/editGroup/'.$value->userLevelChildUID.'" class="btn btn-sm btn-primary fa fa-pencil-square "></a> 
											<button class="btn btn-sm btn-danger fa fa-trash " onclick="uRbye('.$value->userLevelChildUID.')"></button> 
										</td>';
									echo '</tr>';
								}
							?>
						</tbody>
					</table></div>
						<div  style="float: right;">
							<a href="<?php echo base_url('Admin/addUserLevel');?>"><button class="btn btn-primary rounded">Add+</button></a>
						<a href="<?php echo base_url('Admin/index');?>"><button class="btn btn-danger rounded">Cancel</button></a>
					</div>
				</div>
		</div>
	</div>
</section>
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
	  	<button type="button" class="btn btn-danger rounded" data-dismiss="modal" onclick="bbye()">Delete</button>
        <button type="button" class="btn btn-success rounded" data-dismiss="modal" >Cancel</button>
      </div>
    </div>
  </div>
</div>
<script>
	var heh;
	var base_url ="<?php echo base_url();?>";
	function uRbye(int){
		heh = int;
		$('#reminder').modal('toggle');
	}
	function bbye(){
		$.ajax({
			url: base_url+"Admin/group_rem_noragrets/"+heh,
			type: "post",
			success: function(data){
				window.location.reload();
			}
		});
	}
	$(document).ready(function() {
    $('#example').DataTable({
      "aoColumnDefs" : [ {
            "bSortable" : false,
            "aTargets" : [ "sorting_disabled" ]
        } ],
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false ,
      "pagingType": "numbers",
      
      "order": [ 2, 'asc' ]});
} );
</script>   