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
		<a href="<?php echo base_url();?>Products/components" class="btn btn-default" style="background-color:rgb(244, 247, 250);">Components</a>
		<a href="<?php echo base_url();?>Products/materials" class="btn btn-default" >Materials</a>
	</div>
</div>

<br>

<div class="container-fluid">

	
	
	<div class=" form-control">
	<h3>Components <a href="<?php echo base_url();?>Products/components_new" class="btn btn-sm btn-primary">Create new Component</a> 
		</h3>
	<br>
	<br>
	<table class="table table-bordered" style="text-align: left; margin-top: 1%; width:100%; z-index:-99999999;">
		<thead  style="background-color:#666; color:white;">
			<th>
				Component Code
			</th>
			<th>
				Component Class
			</th>
			<th>
				Component Width
			</th>
			<th>
				Component Height
			</th>
		</thead>
		<tbody id="componentList">
            <?php
                if(!empty($compList)){
					$ctr=0;
					foreach ($compList as $key => $value) {
						$ctr++;
						echo '<tr onclick="optionHide(); show('.$ctr.');">';
							echo '
							<td> 
								<a href="'.base_url().'Products/components_edit/'.$value->componentCode.'" 
									class="btn btn-warning btn-sm fas fa-edit hider show'.$ctr.'"
									>
								</a>
								<button 
									class="btn btn-danger btn-sm fa fa-trash hider show'.$ctr.'"
									data-toggle="modal" data-target="#myModal" 
									onclick="del('."'".$value->componentCode."'".')"
									>
								</button> 
								'.$value->componentCode.' 
							</td>';
							echo '<td>'.$value->componentClass.'</td>';
							echo '<td>'.$value->componentWidth.'</td>';
							echo '<td>'.$value->componentHeight.'</td>';
						echo '</tr>';
					}

				}else{
					echo "<td> No data Available. </td>";
				}
            ?>
		</tbody>
	</table>
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

<script type="text/javascript">
	var base_url ="<?php echo base_url();?>";
	var compcode;
	var req;
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
		req='delete';
		editmsgbox('Are you sure you want to delete this Component : <br> " '+compcode+' " ?');
		compcode = id2;
	}
	
	function go(){
		$.ajax({
		    url: base_url+"Products/compxml",
		    type: "post",
		    data: {
			'xmlCompcode' : compcode,
			'xmlRequest' : req
			},
		    success: function(data){
		    	refdata();
				
		    }
		});
	}
	function refdata(){
		$.ajax({
		    url: base_url+"Products/compxml",
		    type: "post",
		    data: {
			'xmlCompcode' : compcode,
			'xmlRequest' : 'refreshdata'
			},
		    success: function(data){
		    	$('#componentList').html(data);
		    	optionHide();
						
		    }
		});
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

</script>              