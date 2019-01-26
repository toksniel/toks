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
	<Br><br>
	<h2>Barrier Details</h2>
	<div class="form-control col-lg-10" style="margin: auto;">
		<?php 		
		if(!empty($systemData)){
			foreach ($systemData as $key => $value) {
				echo '<h5 > System Code : '.$value->sysCode.'</h5>';
				echo '<h5> Width : '.$value->sysWidth.'</h5>';
				echo '<h5> Height : '.$value->sysHeight.'</h5>';
				echo '<h5> System Type :'.$value->sysType.'</h5>';
				echo '<h5> System Cateogry : '.$value->sysCategory.'</h5>';
			}
		}
	?>
	</div>
	<br>
	<h2>Barrier's Component Material Class Details</h2>
	<div class="col-lg-10" style="margin: auto;">
		<?php 		
		if(!empty($components)){
			$ctr=0;
			foreach ($components as $key => $value) {
				$ctr++;
				$sub;
				echo '<div class="form-control">';
					echo '<label>Component Code : '.$value->componentCode.'</label><br>';
					$sub = $value->componentCode;
					echo '<label>Class : '.$value->componentClass.'</label><br>';
					foreach ($compMAT as $key => $value) {
						if($sub == $value->componentCode){
							echo' <label> Material : '.$value->materialCode.' </label> | ';
							echo' <label> Size : '.$value->materialSize.' </label> | ';
							echo' <label> Unit : '.$value->materialUnit.' </label> | ';
							echo' <label> Quantity : '.$value->materialQty.' </label> <br>';
						}
						
					}
				echo '</div><br>';
				
			}
		}
		?>
		<?php 		
		if(!empty($syscomp)){
			$ctr=0;
			foreach ($syscomp as $key => $value) {
				$ctr++;
				echo '<div class="form-control">';
				
					echo '<label>Material as Component : '.$value->sysMat.'</label>';
				echo '</div><br>';
				
			}
		}
		?>
		<!-- 
		<table class="table table-bordered">
			<thead>
				<th>Component Code</th>
				<th>Material Code</th>
				<th>Material Size</th>
				<th>Unit</th>
				<th>Quantity</th>
			</thead>
			<tbody>
				<?php /*
					foreach ($compMAT as $key => $value) {
						echo'<tr>';
							echo'<td>'.$value->componentCode.'</td>';
							echo'<td>'.$value->materialCode.'</td>';
							echo'<td>'.$value->materialSize.'</td>';
							echo'<td>'.$value->materialUnit.'</td>';
							echo'<td>'.$value->materialQty.'</td>';
						echo'</tr>';
					}
				*/
				?>
			</tbody>
			
		</table>
		-->
	</div>
</div>

<script type="text/javascript">
	function showchild(id){

	}
	function hidechild(id){

	}
</script>                                                                                                           