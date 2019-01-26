<section class="dashboard-counts section-padding" >
	<div class="container-fluid">
		<div class="card">
            <div class="card-header d-flex align-items-center">
            	<h1 class="display"><u><b>User List</b></u></h1>
            </div>
            	<div class="card-body">
					<table class="table table-hover">
						<thead class="thead-dark">
							<th>User ID</th>
							<th>Name</th>
							<th>Job Description</th>
							<th>User Level</th>
							<th>Option</th>
						</thead>
						<tbody>
							<?php
								foreach ($userList as $key => $value){
									echo '<tr>';
										echo '<td><b>' . $value->uniqueId . '</b></td>';
										echo '<td>' . $value->userFirstName . ' '. $value->userLastName. '</td>';
										echo '<td>' . $value->userJobDesc . '</td>';
										echo '<td>' . $value->cgroupUserLevel . '</td>';
										echo '<td width="10%"><a href="#"><i class="fas fa-unlock-alt fa-lg" aria-hidden="true"></i></a>  <a href="#"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i></a>   <a href="#"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>';
									echo '</tr>';
								}
							?>
						</tbody>
					</table>
					<div  style="float: right;">
	                	<a href="<?php echo base_url('Admin/newUser');?>"><button class="btn btn-primary rounded">Add+</button></a>
	                <a href="<?php echo base_url('Admin/index');?>"><button class="btn btn-danger rounded">Cancel</button></a>
             		</div>
				</div>
			</div>
		</div>
	</div>
</section>
