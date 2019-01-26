<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Component Inventory</h1></div><hr>
            <div class="form-group row">   
                <div class="col-sm-12">
                    <div>
                        <table class="table table-hover" id="myTable">
                            <thead align="center">
                                <th>Item Code</th>
                                <th>Component Name</th>
                                <th>Low Stock Value</th>
                                <th width="10%">Unit</th>
                                <th>Quantity</th>
                       
                            </thead>
                            <tbody id="">
                                <?php
                                    $compName = "";
                                    $compCode = "";
                                    $compQty = "";
                                    $compLow = "";
                                    foreach($components as $key => $value){
                                        $compName = $value->compName;
                                        $compCode = $value->compItemCode;
                                        $compQty = $value->compQuantity;
                                        $compLow = $value->compLowStock;
                                        $none = '0';
                                        echo '<tr>';
                                            echo '<td align="center">'.$compCode.'</td>';
                                            echo '<td>'.$compName.'</td>';
                                            echo '<td align="center">'.$compLow.'</td>';
                                            echo '<td align="center">pcs</td>';
                                            if($compQty <= $none ){
                                                echo '<td class="table-danger" title="Out of Stock" align="center">'.$compQty.'</td>';
                                            }elseif($compQty < $compLow){
                                                echo '<td class="table-warning" title="Stock is Low" align="center">'.$compQty.'</td>';
                                            }else{
                                                echo '<td class="table-light" align="center">'.$compQty.'</td>';
                                            }
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="col-sm-4">
                        <input type="number" class="form-control">
                    </div>
                </div>
                <table>
                    <thead>
                        <th>Raw Materials</th>
                        <th>Quantity</th>
                    </thead>      
                    <tbody>
                        <tr>
                            <td>asdd</td>
                            <td>asdd</td>
                        </tr>
                    </tbody>   
                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#myTable').DataTable( {
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false ,
      "pagingType": "numbers",

      "order": [ 3, 'asc' ]
    } );
} );
</script>

