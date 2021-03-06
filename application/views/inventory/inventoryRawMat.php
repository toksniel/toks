<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Raw Materials</h1></div><hr>
            <div class="form-group row">   
                <div class="col-sm-12">
                    <div>
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <th width="10%">Raw ID</th>
                                <th>Raw Material Code</th>
                                <th>Raw Material Name</th>
                                <th>Low Stock Value</th>
                                <th width="10%">Unit</th>
                                <th>Quantity</th>
                                <th>Option</th>
                            </thead>
                            <tbody id="">
                                <?php
                                    $rawID = "";
                                    $rawName = "";
                                    $rawQty = "";
                                    $rawLow = "";
                                    $rawUnit = "";
                                    $rawNone = '0' ;
                                    foreach($rawMats as $key =>$value){
                                        $rawID = $value->rawID;
                                        $rawName = $value->rawMatName;
                                        $rawQty = $value->rawMatQuantity;
                                        $rawLow = $value->rawMatLowStock;
                                        $rawUnit = $value->rawMatUnit;  
                                        $rawCode = $value->rawMatCode; 
                                        echo '<tr>';
                                            echo '<td>'. $rawID.'</td>';
                                            echo '<td>'. $rawCode.'</td>';
                                            echo '<td>'. $rawName.'</td>';
                                            echo '<td>'. $rawLow.'</td>';
                                            echo '<td>'. $rawUnit.'</td>';
                                            if($rawQty <= $rawNone){
                                                echo '<td class="table-danger" title="Out of Stock">'. $rawQty.'</td>';
                                            }elseif($rawQty <= $rawLow){
                                                echo '<td class="table-warning" title="Stock is Low">'. $rawQty.'</td>';
                                            }else{
                                                echo '<td class="table-light">'. $rawQty.'</td>';
                                            }
                                               echo '<td align="right"><input type="button" class="btn btn-info rounded" data-toggle="modal" data-target="#myModal" value="+Add" id="view" onclick="veiwMat('.$rawID.');">';
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
            <input type="text" class="form-control" placeholder="Enter Quantity" id="matQty"> 
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
    function veiwMat(rawID){
        $.ajax({
        type:"GET",
        url:base_url+"Inventory/viewMat",
        data:{
            'ajaxRawID':rawID,
        },
        success:function(data){
            $(this_tdata_modal).html(data);
            
            $('#save').on('click',function(rawIDs){
                var rawMatQty = $('#matQty').val();
                var total = parseFloat(qty)+parseFloat(rawMatQty);
                console.log(total);
                
                $.ajax({
                    type:"GET",
                    url: base_url+"Inventory/ajaxUpdateRawMat",
                    data:{
                        ajaxRawID:rawID,
                        ajaxRawMatQty:total
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

<!--<table class="table table-hover" id="myTable">
                            <thead>
                                <th width="10%">Raw ID</th>
                                <th>Raw Material Code</th>
                                <th>Raw Material Name</th>
                                <th>Low Stock Value</th>
                                <th width="10%">Unit</th>
                                <th>Quantity</th>
                                <th>Option</th>
                            </thead>
                            <tbody id="">
                                <?php
                                    $rawID = "";
                                    $rawName = "";
                                    $rawQty = "";
                                    $rawLow = "";
                                    $rawUnit = "";
                                    $rawNone = '0' ;
                                    foreach($rawMats as $key =>$value){
                                        $rawID = $value->rawID;
                                        $rawName = $value->rawMatName;
                                        $rawQty = $value->rawMatQuantity;
                                        $rawLow = $value->rawMatLowStock;
                                        $rawUnit = $value->rawMatUnit;  
                                        $rawCode = $value->rawMatCode; 
                                        echo '<tr>';
                                            echo '<td>'. $rawID.'</td>';
                                            echo '<td>'. $rawCode.'</td>';
                                            echo '<td>'. $rawName.'</td>';
                                            echo '<td>'. $rawLow.'</td>';
                                            echo '<td>'. $rawUnit.'</td>';
                                            if($rawQty <= $rawNone){
                                                echo '<td class="table-danger" title="Out of Stock">'. $rawQty.'</td>';
                                            }elseif($rawQty <= $rawLow){
                                                echo '<td class="table-warning" title="Stock is Low">'. $rawQty.'</td>';
                                            }else{
                                                echo '<td class="table-light">'. $rawQty.'</td>';
                                            }
                                               echo '<td align="right"><input type="button" class="btn btn-info rounded" data-toggle="modal" data-target="#myModal" value="+Add" id="view" onclick="veiwMat('.$rawID.');">';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table> -->