<style type="text/css">
	tr {
    cursor: pointer;
	}
</style>
<div class="" style="background-color: #252525; letter-spacing: 2px;">
	<strong class="text-default" style="margin-left: 1%; color: #fefefefe;">Products</strong>
</div>
<div style="background-color: #252525;">
	<div class="container-fluid">
		<a href="<?php echo base_url();?>Products" class="btn btn-default" >Dashboard</a>
		<a href="<?php echo base_url();?>Products/barriers" class="btn btn-default" style="background-color:rgb(244, 247, 250);">Barrier System</a>
		<a href="<?php echo base_url();?>Products/components" class="btn btn-default" >Components</a>
		<a href="<?php echo base_url();?>Products/materials" class="btn btn-default" >Materials</a>
	</div>
</div>
<br>
<div class="container col-lg-11 form-control">
	<a href="<?php echo base_url();?>Products/barriers" class="btn btn-sm btn-primary">System List</a> 
	<h2>Barrier Details</h2>
	<div class="row">
		<div class="col-lg-1" ></div>
		<div class="col-lg-6" >
			<label>System Code</label>
			<input class="form-control" type="text" id="txtSyscode">
		</div>
		<div class="col-lg-3" >
			<label>System Type</label>
			<select class="form-control" id="txtsysType">
				<?php 
					foreach ($systypedd as $key => $value) {

						echo '<option value="'.$value->dropVal.'">'.$value->dropVal.'</option>';
					}
				?>
			</select>
		</div>	
	</div>
	<br>
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-3" >
			<label>Width (mm)</label>
			<input class="form-control width" type="text" id="txtSyswidth" value="0">
		</div>	
		<div class="col-lg-3" >
			<label>Height (mm)</label>
			<input class="form-control height" type="text" id="txtSyheight" value="0">
		</div>
		<div class="col-lg-3" >
			<label>System Category</label>
			<select class="form-control" id="txtSyscat">
				<?php 
					foreach ($syscatdd as $key => $value) {
						echo '<option value="'.$value->dropVal.'">'.$value->dropVal.'</option>';
					}
				?>
			</select>
			
		</div>			
	</div>
	<br>
	<h2>Component Class Details</h2>
	
		<div class="col-lg-10" style="margin: auto;">
			<table class="table table">
				<thead>
					<th>Component Class</th>
					<th>Quantity</th>
					<th>Attribute</th>
					<th>Size (mm)</th>
					<th>Material</th>
					<th><i class="fa fa-gear"></i></th>
				</thead>
				<tbody id="compClasslist">
					
				</tbody>
			</table>
			<button class="btn btn-sm btn-info"  onclick="addclass()">Add Component Class</button>
			<button class="btn btn-sm btn-info" onclick="addMatclass()">Add Material as Component Class</button>
			<hr>
			
		</div>
		<div class="modal-footer">
			<button class="btn btn-md btn-primary"  data-toggle="modal" data-target="#myModal">Save</button>
		</div>			
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Confirm Action</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p id="msgBox">Are you sure you want to save this data?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="getBarrier()">OK</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
var base_url ="<?php echo base_url();?>";
var appendCtr=0;
var systemCode="";
var systemType="";
var systemWidth="";
var systemHeight="";
var systemCat="";

var indexfinder="";
var syscompclass="";
var syscompqty="";
var syscompattrib="";
var syscompsize="";
var syscompmaterial="";
	$('.width').on('click focusin', function(){
		if($(this).val() == 0){
			$(this).val('');
		}
	});
	$('.height').on('click focusin', function(){
		if($(this).val() == 0){
			$(this).val('');
		}
	});
	$('.width').on('focusout', function(){
		if($(this).val() == ''){
			$(this).val('0');
		}
		var x = $(this).val(); 
		x = x/250;
		x = Math.ceil(x);
		x = x *250;
	
		$(this).val(x); 
	});
	$('.height').on('focusout', function(){
		if($(this).val() == ''){
			$(this).val('0');
		}
		var y = $(this).val(); 
		y = y/300;
		y = Math.ceil(y);
		y = y *300;
		
		$(this).val(y); 
	});
	function addclass(){
		appendCtr++;
		var trStart = '<tr id="row'+appendCtr+'">';
		var tdClass = '<td><span class="rowindex" hidden>'+appendCtr+'</span><select class="form-control" id="class'+appendCtr+'"><?php foreach ($classdd as $key => $value) {echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';}?></select></td>';
		var tdQty = '<td><input class="form-control" type="text" id="qty'+appendCtr+'"></td>';
		var tdAttrib ='<td><select class="form-control" id="attrib'+appendCtr+'"><?php foreach ($attribdd as $key => $value) {echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';}?></select></td>';
		var tdSize ='<td><input class="form-control" type="text" id="size'+appendCtr+'"></td>';
		var tdMat ='<td><select class="form-control" id="matclass'+appendCtr+'" disabled><option value="N/A">N/A</option><?php foreach ($matdd as $key => $value) {echo '<option value="'.$value->materialCode.'">'.$value->materialName.'</option>';}?></select></td>';
		var tdOption = '<td><button class="btn btn-sm btn-primary fa fa-trash" onclick="remove('+"'"+appendCtr+"'"+')"></button></td>';
		var trEnd = '</tr>';
		$('#compClasslist').append(trStart);
		$('#compClasslist').append(trEnd);
		$('#row'+appendCtr).append(tdClass);
		$('#row'+appendCtr).append(tdQty);
		$('#row'+appendCtr).append(tdAttrib);
		$('#row'+appendCtr).append(tdSize);
		$('#row'+appendCtr).append(tdMat);
		$('#row'+appendCtr).append(tdOption);
		

	}
	function addMatclass(){
		appendCtr++;
		var trStart = '<tr id="row'+appendCtr+'">';
		var tdClass = '<td><span class="rowindex" hidden>'+appendCtr+'</span><select class="form-control" id="class'+appendCtr+'" disabled><option value="N/A">N/A</option><?php foreach ($classdd as $key => $value) {echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';}?></select></td>';
		var tdQty = '<td><input class="form-control" type="text" id="qty'+appendCtr+'"></td>';
		var tdAttrib ='<td><select class="form-control" id="attrib'+appendCtr+'"><?php foreach ($attribdd as $key => $value) {echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';}?></select></td>';
		var tdSize ='<td><input class="form-control" type="text" id="size'+appendCtr+'"></td>';
		var tdMat ='<td><select class="form-control" id="matclass'+appendCtr+'" ><?php foreach ($matdd as $key => $value) {echo '<option value="'.$value->materialCode.'">'.$value->materialName.'</option>';}?></select></td>';
		var tdOption = '<td><button class="btn btn-sm btn-primary fa fa-trash" onclick="remove('+"'"+appendCtr+"'"+')"></button></td>';
		var trEnd = '</tr>';
		$('#compClasslist').append(trStart);
		$('#compClasslist').append(trEnd);
		$('#row'+appendCtr).append(tdClass);
		$('#row'+appendCtr).append(tdQty);
		$('#row'+appendCtr).append(tdAttrib);
		$('#row'+appendCtr).append(tdSize);
		$('#row'+appendCtr).append(tdMat);
		$('#row'+appendCtr).append(tdOption);

	}
	function remove(str){
		$('#row'+str).remove();
	}


function getBarrier(){
	systemCode= $('#txtSyscode').val();
	systemWidth= $('#txtSyswidth').val();
	systemHeight= $('#txtSyheight').val();
	systemType= $('#txtsysType').val();
	systemCat= $('#txtSyscat').val();
	$.ajax({
	    url: base_url+"Products/systemXml",
	    type: "post",
	    data: {
	    'xmlsystemCode' : systemCode,
		'xmlsystemWidth' : systemWidth,
		'xmlsystemHeight' : systemHeight,
		'xmlsystemType' : systemType,
		'xmlsystemCat' : systemCat,
		'xmlRequest' : 'insertBar'
		},
	    success: function(data){
	    	getClass();
	    }
	});
}
function getClass(){
	if ($(".rowindex")[0]){
	    $(".rowindex").each( function(){

			indexfinder = $(this).text();
			syscompclass= $('#class'+indexfinder).val();
			syscompqty= $('#qty'+indexfinder).val();
			syscompattrib= $('#attrib'+indexfinder).val();
			syscompsize= $('#size'+indexfinder).val();
			syscompmaterial= $('#matclass'+indexfinder).val();

			$.ajax({
			    url: base_url+"Products/systemXml",
			    type: "post",
			    data: {
			    'xmlsystemCode' : systemCode,
				'xmlsyscompclass' : syscompclass,
				'xmlsyscompqty' : syscompqty,
				'xmlsyscompattrib' : syscompattrib,
				'xmlsyscompsize' : syscompsize,
				'xmlsyscompmaterial' : syscompmaterial,
				'xmlRequest' : 'insertSyscomp'
				},
			    success: function(data){
			    	
			    }
			});
		});
		console.log('saved'); //redir here
		window.location.replace('<?php echo base_url();?>Products/barriers_edit/'+systemCode);
	} else {
	    window.location.replace('<?php echo base_url();?>Products/barriers_edit/'+systemCode);
	}
	 
}
</script>







                                    