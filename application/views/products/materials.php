<style type="text/css">
	tr {
    cursor: pointer;
	}
	table{
margin: 0 auto;
width: 100%;
clear: both;
border-collapse: collapse;
table-layout: fixed; // ***********add this
word-wrap:break-word; // ***********and this
}

</style>
<div class="" style="background-color: #252525; letter-spacing: 2px;">
	<strong class="text-default" style="margin-left: 1%; color: #fefefefe;">Products</strong>
</div>
<div style="background-color: #252525;">
	<div class="container-fluid">
		<a href="<?php echo base_url();?>Products" class="btn btn-default" >Dashboard</a>
		<a href="<?php echo base_url();?>Products/barriers" class="btn btn-default">Barrier System</a>
		<a href="<?php echo base_url();?>Products/components" class="btn btn-default">Components</a>
		<a href="<?php echo base_url();?>Products/materials" class="btn btn-default" style="background-color:rgb(244, 247, 250);">Materials</a>
	</div>
</div>
<br>
<div class="container-fluid">
	<div class=" form-control">
		<h3>Materials <button class="btn btn-sm btn-primary" id="addnew">Add New</button></h3>
		
		<br>
		<!-- THIS IS FOR NEW ENTRY -->	
		<div id="newEntry" class="container paper" style="margin: auto; padding: 50px; border-radius: 5px;">
			<h5>Material Code : </h5>
			<input class="form-control" type="text" id="txtmatcode">
			<br>
			<h5>Material Name : </h5>
			<input class="form-control" type="text" id="txtmatname">
			<br>
			<div class="row">
				<div class="col-lg-4">
					<h5>PH Cost : </h5>
					<input class="form-control" type="text" id="txtphpcost">
				</div>
				<div class="col-lg-1"></div>
				<div class="col-lg-4">
					<h5>DE Cost : </h5>
					<input class="form-control" type="text" id="txtdecost">
				</div>
			</div>
			<br>
			<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"  id="save">Save</button>
			<button class="btn btn-sm btn-default border-secondary" id="cancel">Cancel</button><br>
			<br>
		</div>
		<br>
		<div id="mal_a_table">
		<table class="table table-bordered" style="text-align: left; margin-top: 1%; width:100%; z-index:-99999999;">
			<thead  style="background-color:#666; color:white;">
				<th width="30%">
					Material Code
				</th>
				<th width="30%">
					Material Name
				</th>
			</thead>
			<tbody id="materialList">
				<?php
					if(!empty($matList)){
						$ctr = 0;
						foreach ($matList as $key => $value) {
							$ctr++;
							echo '<tr onclick="optionHide(); show('.$ctr.');">';
								echo 
									'<td>
										<button 
										class="btn btn-sm btn-warning fas fa-edit hider show'.$ctr.'"
										data-toggle="modal" data-target="#edit"
										onclick="update('."'".$value->materialCode."','".$value->materialName."',".$value->phPrice.",".$value->dePrice.')"
										>
										</button>

										<button 
										class="btn btn-sm btn-danger fa fa-trash hider show'.$ctr.'"
										data-toggle="modal" data-target="#myModal" 
										onclick="del('."'".$value->materialCode."'".')">
										</button> 
										'.$value->materialCode.' 
									</td>';
								echo '<td>'.$value->materialName.'</td>';
							echo '</tr>';
						}

					}else{
						echo "No data Available";
					}
				?>
			</tbody>
		</table>
		</div>
	</div>
	
</div>


<!-- Modal delete -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Confirm Action</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p id="msgBox"></p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="go()">OK</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal update -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Change Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<h2>Material Data</h2>
  		<div class="col-lg-10">
  			<h5>Material Code : <input class="form-control" type="text" id="updateMatcode" disabled></h5>
  		</div>
  		<br>
  		<div class="col-lg-10">
  			<h5>Material Name : <input class="form-control" type="text" id="updateMatname"></h5>
  		</div>
		<div class="col-lg-4">
  			<h5>PH Cost : <input class="form-control" type="text" id="updatephcost"></h5>
  		</div>
		<div class="col-lg-4">
  			<h5>De Cost : <input class="form-control" type="text" id="updatedecost"></h5>
  		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="change()">Change</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	var matcode="";
	var matname="";
	var req="";
	var base_url ="<?php echo base_url();?>";

$( document ).ready(function() {
	req = 'refreshdata';
    optionHide();
	$('#newEntry').hide();

});
	$('#addnew').on('click', function(){
 	 	$('#newEntry').show('333');
 	 	$('#addnew').hide('333');
 	 	
 	 	$('#txtmatname').val('');
 	 	$('#txtmatcode').val('');
	});
	$('#cancel').on('click', function(){
 	 	$('#newEntry').hide('333');
 	 	$('#addnew').show('333');
 	 	
 	 	$('#txtmatname').val('');
 	 	$('#txtmatcode').val('');
	});
	var matph=0;
	var matde =0;
	$('#save').on('click', function(){
		matph = $('#txtphpcost').val();
		matde = $('#txtdecost').val();
		matname = $('#txtmatname').val();
 	 	matcode = $('#txtmatcode').val();
 	 	req='insert';
 	 	editmsgbox('Are you sure you want to save this ?<br> material code : '+matcode+' <br> material name : '+matname+'')
 	 	
 	 	
	});
	
	function optionHide() {
		$('.hider').hide();
	}
	function show(int){
		$('.show'+int).show();
	}
	function editmsgbox(str){
		$('#msgBox').html(str);
	}
	function update(id,name,ph,de){
		matcode = id;
		$('#updateMatcode').val(matcode);
		matname = name;
		$('#updateMatname').val(matname);
		matph = ph;
		matde = de;
		$('#updatephcost').val(matph);
		$('#updatedecost').val(matde);
	}
	function change(){
		matcode = $('#updateMatcode').val();
		matname = $('#updateMatname').val()
		matph = $('#updatephcost').val();
		matde = $('#updatedecost').val();
		req ='update';
		go();
		
	}
	function del(id2){
		matcode = id2;
		req='delete';
		editmsgbox('Are you sure you want to delete this material : <br> " '+matcode+' " ?');
		matcode = id2;
		
		
	}
	function go(){
		$.ajax({
		    url: base_url+"Products/materialsxml",
		    type: "post",
		    data: {
			'xmlMatcode' : matcode,
			'xmlMatname' : matname,
			'xmlDEmat' : matde,
			'xmlPHmat' : matph,
			'xmlRequest' : req
			},
		    success: function(data){
		    	refdata();
		    	$('#cancel').trigger('click');
		    }
		});
	}
	function refdata(){
		window.location.reload();
		// $.ajax({
		//     url: base_url+"Products/materialsxml",
		//     type: "post",
		//     data: {
		// 	'xmlMatcode' : matcode,
		// 	'xmlMatname' : matname,
		// 	'xmlRequest' : 'refreshdata'
		// 	},
		//     success: function(data){
		//     	$('#materialList').html(data);
		//     	optionHide();
					
		//     }
		// });
	}

	
</script>


<script type="text/javascript">

$(document).ready(function(){

    var oTable = $('.table').dataTable( {
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false ,
                "order": [ 0, 'asc' ]} );
    $('#listeddata_filter input').unbind();
    $('#listeddata_filter input').bind('keyup', function(e) {
        if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
        }
    });


});

</script>         