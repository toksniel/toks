<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <h1>Fabrication List</h1> 
                    
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo base_url('ProductsV2/fabricationCreate');?>"><input type="button" class="btn btn-outline-primary rounded" value="Add"></a>
                </div>
            </div><hr>
            <div class="responsive"> 
               <table id="myTable" class="table table-hover">
                    <thead class="bg-dark text-light">
                        <th width="10%"> Code</th>
                        <th>Name</th>
                        <th>Cost</th>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($fabs)){
                                foreach($fabs as $key => $value){
                                    echo'
                                        <tr>
                                            <td>'.$value->fabID.'</td>
                                            <td>'.$value->fabName.'</td>';
                                            if($value->fabCost ==""){
                                                echo'<td> </td>';
                                            }else{
                                                echo'<td>'.$value->fabCost.' / '.$value->fabUnit.'</td>';
                                            }

                                    echo'</tr>';
                                }
                            }
                        ?>
                    </tbody>
               </table>
            </div>
            <br><br>
        </div> 
    </div>
</section>
<script>
    var base_url ="<?php echo base_url();?>";
    $(document).ready(function(){
        $('#myTable').DataTable({
        });
    });


      
</script>