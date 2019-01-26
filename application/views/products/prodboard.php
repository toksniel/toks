<div class="" style="background-color: #252525; letter-spacing: 2px;">
	<strong class="text-default" style="margin-left: 1%; color: #fefefefe;">Products</strong>
</div>
<div style="background-color: #252525;">
	<div class="container-fluid">
		<a href="<?php echo base_url();?>Products" class="btn btn-default" style="background-color:rgb(244, 247, 250);">Dashboard</a>
		<a href="<?php echo base_url();?>Products/barriers" class="btn btn-default">Barrier System</a>
		<a href="<?php echo base_url();?>Products/components" class="btn btn-default">Components</a>
		<a href="<?php echo base_url();?>Products/materials" class="btn btn-default" >Materials</a>
	</div>
</div>
<br>
<div class="container-fluid">
<div class=" form-control">
	<h2>Products Dashboard</h2>
	<div class="row">
		<div class="col-lg-4  col-md-4 col-xs-4  col-sm-4">
			<a href="<?php echo base_url();?>Products/barriers" class="btn btn-info form-control">
				<label>Barrier System</label><br>
				<label><?php echo $systemData;?></label>
			</a>
			<br><br>
		</div>
		<div class="col-lg-4  col-md-4 col-xs-4  col-sm-4">
			<a href="<?php echo base_url();?>Products/components" class="btn btn-primary form-control">
				<label>Components</label><br>
				<label><?php echo $compData;?></label>
			</a><br><br>
		</div>
		<div class="col-lg-4  col-md-4 col-xs-4  col-sm-4">
			<a href="<?php echo base_url();?>Products/materials" class="btn btn-warning form-control">
				<label>Materials</label><br>
				<label><?php echo $matData;?></label>
			</a><br><br>
		</div>
	</div>
</div>
</div>
     