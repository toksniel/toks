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
		<a href="<?php echo base_url();?>Products/barriers" class="btn btn-default" style="background-color:rgb(244, 247, 250);">Barrier System</a>
		<a href="<?php echo base_url();?>Products/components" class="btn btn-default">Components</a>
		<a href="<?php echo base_url();?>Products/materials" class="btn btn-default" >Materials</a>
	</div>
</div>
<br>
<div class="container-fluid">
	<div class=" form-control">
	<h2>Barrier System <a href="<?php echo base_url();?>Products/barrier_new" class="btn btn-sm btn-primary">Create new</a> </h2>
	<br>
	<br>
	<table class="table table-bordered" style="text-align: left; margin-top: 1%; width:100%; z-index:-99999999;">
		<thead style="background-color:#666; color:white;">
			<th>System Code</th>
			<th> Width</th>
			<th> Height</th>
			<th>System Type</th>
			<th>System Category</th>
		</thead>
		<tbody id="systemList">
			<?php 
				$ctr=0;
				if(!empty($systemData)){
					foreach ($systemData as $key => $value) {
						$ctr++;
						echo '<tr id="'.$value->sysCode.'" onclick="optionHide(); show('.$ctr.');">';
							echo '<td>
								<a href="'.base_url().'Products/barriers_view/'.$value->sysCode.'" 
										class="btn btn-primary btn-sm fa fa-eye hider show'.$ctr.'"
										>
									</a>
								<a href="'.base_url().'Products/barriers_edit/'.$value->sysCode.'" 
										class="btn btn-warning btn-sm fas fa-edit hider show'.$ctr.'"
										>
									</a>
									<button 
										class="btn btn-danger btn-sm fa fa-trash hider show'.$ctr.'"
										data-toggle="modal" data-target="#myModal" 
										onclick="del('."'".$value->sysCode."'".')"
										>
									</button> '.$value->sysCode.'</td>';
							echo '<td>'.$value->sysWidth.'</td>';
							echo '<td>'.$value->sysHeight.'</td>';
							echo '<td>'.$value->sysType.'</td>';
							echo '<td>'.$value->sysCategory.'</td>';
						echo '</tr>';
					}
				}else{
					echo "<td>No data available.</td>";
				}
			?>
		</tbody>
		
	</table>
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
        <p id="msgBox"></p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="go()">OK</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>





<script type="text/javascript">
var base_url ="<?php echo base_url();?>";
var compcode;
$( document ).ready(function() {
   optionHide();
});
	function optionHide(){
		$('.hider').hide();
	}
	function show(int){
		$('.show'+int).show();
	}

function editmsgbox(str){
		$('#msgBox').html(str);
	}



	function del(id2){
		compcode = id2;
		req='delsysNsyscomp';
		editmsgbox('Are you sure you want to delete this System : <br> " '+compcode+' " ?');
		compcode = id2;
	}
	
	function go(){
		$.ajax({
		    url: base_url+"Products/systemXml",
		    type: "post",
		    data: {
			'xmlGet' : compcode,
			'xmlRequest' : 'delsysNsyscomp'
			},
		    success: function(data){
		    	window.location.reload();
		    	
		    }
		});
	}

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
</script>                                              