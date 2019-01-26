<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid">
            <div class="row">
                <div class="col-lg-12"><br>
                    <h1>Delivery-In</h1>
                </div>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>From</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                        <?php
                        $x=0;
                        $y="";
                        $z="";
                            if(!empty($list)){
                                foreach($list as $key => $value){
                                    $date = $value->itemDeliveryDate;
                                    $id= $value->groupID;
                                    $id2= $value->groupID;
                                    $id3= $value->groupID;
                                    $z = sprintf('%05d',$id3);
                                    $y= md5($id2);
                                    $from = $value->itemDeliveryFrom;
                                    $x++;
                                    $stats = $value->recStat;
                                  
                                    echo'
                                        <tr>
                                            <td>D'.$z.'-N</td>
                                            <td>'. $from.'</td>
                                            <td>'.$date.'</td>';
                                            if($value->recStat == "0"){
                                                echo'<td class="text-primary">Received</td>';
                                            }else{
                                                echo'<td class="text-danger">Pending</td>';
                                            }
                                         echo '<td><input type="button" class="btn btn-outline-primary rounded" data-toggle="modal" data-target="#exampleModalLong" value="View" onclick="viewDetails('.$id.');"></td>
                                        </tr>
                                    ';
                                }
                            }else{
                                echo "No Data Found";
                            }
                        ?>
                    </tbody>
                </table>
                <br><br>
            </div>
        </div>
    </div>
</section>
<!-- Button trigger modal -->


<!-- Modal -->

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle">Item List</h1>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Quantity</th>
                <th>Length</th>
                <th style="text-align:center !important;">Price</th>
            </thead>
            <tbody id="datasss">
            
            </tbody>
        </table>
        <div id="zzz">
        
        </div>
        <div id="sss">
        
        </div>
        
      </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger rounded" data-dismiss="modal">Close</button>
       <button type="button" class="btn btn-outline-primary rounded" onclick="receivedDelivery()">Mark as Receive</button>
      </div>
    </div>
  </div>
</div>


<script>
    var base_url ="<?php echo base_url();?>";
    function viewDetails(ids){
        console.log(ids)
        $.ajax({
            type:'get',
            url:base_url+'Inventory/deliveryListView',
            data:{
                'ajaxID':ids
            },
            success:function(data){
                $(datasss).html(data);
                viewDetails2(ids);
            }
        });
    }
    function viewDetails2(ids){
        $.ajax({
            type:'get',
            url:base_url+'Inventory/deliveryListViewTotal',
            data:{
                'ajaxID':ids
            },
            success:function(data){
                $(sss).html(data);
                viewDetails3(ids)
            }
        });
    }
    function viewDetails3(ids){
        $.ajax({
            type:'get',
            url:base_url+'Inventory/deliveryListViewFreight',
            data:{
                'ajaxID':ids
            },
            success:function(data){
                $(zzz).html(data);
                
            }
        });
    }
    function receivedDelivery(){
        var id = 'getss';
        $.ajax({
            type:"POST",
            url:base_url+'Inventory/receivedDelivery',
            data:{
                ajaxID:id
            },
            success:function(){

            }
        });
    }
</script>

