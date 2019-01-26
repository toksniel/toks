<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div>
                <h1>List to be review</h1><hr>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                        <?php
                        $x=0;
                            if(!empty($list)){
                                foreach($list as $key => $value){
                                    $x++;
                                    echo'
                                    <tr>
                                        <td>'.$x.'</td>
                                        <td>'.$value->date.'</td>';
                                        if($value->recStat == 0){
                                            echo'<td class="text-danger"><i>Done</i></td>';
                                        }else{
                                            echo'<td class="text-primary"><i>Review</i></td>';
                                        }
                                     echo'   <td><input type="button" class="btn btn-sm btn-outline-success rounded" onclick="getDeliID('.$value->groupID.')"  value="View" data-toggle="modal" data-target=".bd-example-modal-lg">&nbsp;<input type="button" class="btn btn-sm btn-outline-danger rounded" value="Delete"></td>
                                    </tr>';
                                }
                            }else{
                                echo'
                                <tr>
                                    <td colspan="3" align="center"><h1 style="color:red;">No data to be check....</h1></td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
        </div>
    </div>
</section>

<!-- Modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List of Materials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--<table class="table table-hover">
                    <thead>
                        <th width="10%">#</th>
                        <th>Item Code</th>
                        <th>Suggested Price</th>
                        <th>Current Price</th>
                        <th>Option</th>
                    </thead>
                    <tbody id="this_tdata_modal2">
                    </tbody>
                </table>-->
                <div class="row">
                    <div class="col-lg-1">
                        <label for="">#</label>
                    </div>
                    <div class="col-lg-3">
                        <label for="">Item Name</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Current Price</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Suggested Price</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Percentage</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Option</label>
                    </div>
                </div>
                <div class="row" id="this_tdata_modal2">
                   
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-success rounded" value="Save">  
                <input type="button" class="btn btn-outline-danger rounded" data-dismiss="modal" value="Close">
            </div>
        </div>
    </div>
</div>
<script>
    var base_url ="<?php echo base_url();?>";
    function getDeliID(id){
        getData = "getData"; 
        $.ajax({
            type:"POST",
            url: base_url+"Inventory/getDeli",
            data:{
                ajaxID: id,
                ajaxRes: getData
            },
            success: function(data){
                $(this_tdata_modal2).html(data);
            }
        });
    }
    function suggestedPrice(){
        getData = "getData"; 
        $.ajax({
            type:"POST",
            url: base_url+"Inventory/getDeli",
            data:{
                ajaxID: id,
                ajaxRes: getData
            },
            success: function(data){
              
            }
        });
    }
    
</script>