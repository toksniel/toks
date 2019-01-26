<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Consumable</h1></div><hr>
            <div class="form-group row">   
                <div class="col-sm-12">
                    <div>
                        <table class="table" >
                            <thead>
                                <th>Raw ID</th>
                                <th>Raw Material Name</th>
                                <th>Low Stock Value</th>
                                <th width="10%">Unit</th>
                                <th>Quantity</th>
                                <th>Option</th>
                            </thead>
                            <tbody id="">
                            <?php
                                $consID = "";
                                $consName = "";
                                $consQty = "";
                                $consUnit = "";
                                $consLow = "";
                                $consNone ='0';
                                foreach($consumable as $key => $value){
                                    $consID = $value->consID;
                                    $consName = $value->consName;
                                    $consQty = $value->consQuantity;
                                    $consUnit = $value->consUnit;
                                    $consLow = $value->consLowQty;
                                        echo '<tr>';
                                        echo '<td>'.$consID.'</td>';
                                        echo '<td>'.$consName.'</td>';
                                        echo '<td>'.$consLow.'</td>';
                                        echo '<td>'.$consUnit.'</td>';
                                       
                                        if($consQty <= $consNone){
                                            echo '<td class="table-danger" title="Out of Stock">'.$consQty.'</td>';
                                        }elseif($consQty <= $consLow){
                                            echo '<td class="table-warning" title="Stock is Low">'.$consQty.'</td>';
                                        }else{
                                            echo '<td class="table-light">'.$consQty.'</td>';
                                        }
                                        echo '<td align="right"><input type="button" class="btn btn-info rounded" data-toggle="modal" data-target="#myModal" value="+Add" id="view" onclick="viewCons('.$consID.');">';
                                        echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List of Materials</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-sm-6">
            <span id="this_tdata_modal" style="word-wrap: break-word; font-size:20px;"></span>
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="Enter Quantity" id="consQty"> 
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-oultine-danger rounded" data-dismiss="modal" value="Close">
        <input type="button" class="btn btn-outline-primary rounded" value="Save" id="save" >
      </div>
    </div>
  </div>
</div>
<script>
    var base_url ="<?php echo base_url();?>";
    $(document).ready(function() {
        $('#myTable').DataTable( {
        
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false ,
        "pagingType": "numbers",

        "order": [ 3, 'asc' ]
        } );
    } );
    function viewCons(consID){
        $.ajax({
        type:"GET",
        url:base_url+"Inventory/viewConsumable",
        data:{
            'ajaxConsID':consID,
        },
        success:function(data){
            $(this_tdata_modal).html(data);
            
            $('#save').on('click',function(consIDs){
                var consQty = $('#consQty').val();
                var total = parseFloat(qty)+parseFloat(consQty);
                $.ajax({
                    type:"GET",
                    url: base_url+"Inventory/ajaxUpdateConsumable",
                    data:{
                        'ajaxConsID':consID,
                        'ajaxConsQty':total
                    },
                    success: function(data){
                       location.reload();
                    }
                });
            });
        }
        });
    }
</script>


