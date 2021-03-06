<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <section class="statistics">
      <div class="container-fluid">
        <div class="row d-flex">
          <div class="col-lg-4">
            <!-- CREATE USER-->
            <div class="card income text-center rounded" style="border: 1px solid #bfbfbf;">
							<a href="<?php echo base_url('Admin/newUser');?>"><div class="icon"><i class="fas fa-user-plus"></i></div>
								<strong class="text-primary">Create User</strong>
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <!-- GROUPINGS-->
          <div class="card income text-center rounded" style="border: 1px solid #bfbfbf;">
            <a href="<?php echo base_url('Admin/userLevelMaster');?>"><div class="icon"><i class="fas fa-users"></i></div>
              <strong class="text-primary">Groupings</strong>
            </a>
          </div>
          </div>
          <div class="col-lg-4">
            <!-- CREATE USER-->
          <div class="card income text-center rounded" style="border: 1px solid #bfbfbf;">
            <a href="<?php echo base_url('Admin/roles');?>"><div class="icon"><i class="fas fa-user-plus"></i></div>
              <strong class="text-primary">System Roles</strong>
            </a>
          </div>
        </div>
      </div>
    </section>
    <div class="">
      &nbsp;
    </div>
    <table class="table table-hover">
      <thead class="thead-dark">
        <th>User ID</th>
        <th>Name</th>
        <th>Job Description</th>
        <th>Contact Group</th>
        <th>Option</th>
      </thead>
      <tbody>
        <?php
        $ctr=0;
          foreach ($userList as $key => $value){
            echo '<tr>';
              echo '<td><b>' . $value->uniqueId . '</b></td>';
              echo '<td>' . $value->userFirstName . ' '. $value->userLastName. '</td>';
              echo '<td>' . $value->userJobDesc . '</td>';
              echo '<td>' . $value->cgroupUserLevel . '</td>';
              echo '<td width="15%">  
                <a href="'. base_url().'Admin/editUser/'. $value->uniqueId .'"><button class="btn btn-success btn-xs" ><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i></button></a>&emsp; <button class="btn btn-danger btn-xs rounded" onclick="del('.$value->uniqueId.')"><i class="fa fa-trash fa-lg" aria-hidden="true" ></i></button></td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
	</div>
</section>
<script>
  var base_url ="<?php echo base_url();?>";
  function del(id){
    var recStat="";
    var confirmSave = confirm("Are you sure you want to delete this User?");
    if(confirmSave == true){
      deleteUser(id,recStat);
    }
    else {
    }
  }
</script>
                                                                                                                                                                                                                                                                               