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
      <table class="table table-hover">
        <thead>
            <th width="10%">#</th>
            <th>Mateial Name</th>
            
          
        </thead>
        <tbody id="this_tdata_modal2">
        
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-oultine-danger rounded" data-dismiss="modal" value="Close">
        <!--<input type="button" class="btn btn-outline-primary rounded" value="Mark as Done" id="done" onclick="doneProducts();">-->
      </div>
    </div>
  </div>
</div>

<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Production List</h1></div><hr>
            <div class="form-group row"> 
                <table class="table table-hover" id="table1">
                    <thead>
                        <th width="5%">#</th>
                        <th>Component Name</th>
                        <th>Quantity</th>
                        <th>Progress</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                       <?php
                        $listID="";
                            if(!empty($list)){
                                foreach($list as $key => $value){
                                    $listID = $value->listProductionID;
                                    $compName = $value->compName;
                                    $qty = $value->perPiece;
                                    $compID=$value->componentUID;
                                    $flag = $value->listFlag;
                                    $qty = $value->quantity;
                                    $rawDeductID = $value->prodID;
                                    
                                    echo '<tr>';
                                        echo '<td>'.$listID.'</td>';
                                        echo '<td>'.$compName.'</td>';
                                        echo '<td id="quant">'.$qty.'</td>';
                                        if($flag == 0){
                                            
                                            echo '<td class="text-danger"><i>Done</i></td>';
                                        }else{
                                            echo '<td class="text-primary"><i>In Progress</i></td>';
                                        }
                                        if($flag == 0){
                                            echo '<td><input type="button" class="btn btn-primary rounded" value="Undo" onclick="undoProducts('.$value->listProductionID.')">&nbsp;<input type="button" class="btn btn-danger rounded" value="Delete" onclick="addComponents('.$compID.','.$qty.');deleteProducts('.$value->listProductionID.' ); deductRawMats('.$value->listProductionID.');  " ></td>';
                                        }else{
                                            echo '<td><input type="button" class="btn btn-success rounded" data-toggle="modal" data-target="#myModal" value="View" id="'.$listID.'" onclick="getMats('.$compID.');">&nbsp;<input type="button" class="btn btn-warning rounded" value="Mark as Done" onclick="doneProducts('.$value->listProductionID.')"></td>';
                                        }
                                        
                                echo '</tr>';
                                }
                            }else{
                                echo '</tbody>
                                </table>
                                <p><h3><i>No Production in progress</h3></i></p>';
                            }
                       ?>
            </div>
        </div> 
    </div>
</section>
<script>
var listIDProd ="<?php echo $listID; ?>"
var getData = "";

var base_url ="<?php echo base_url();?>";
    function getMats(id){
        getData = "getData"; 
        $.ajax({
            type:"POST",
            url: base_url+"Inventory/getMatForListProd",
            data:{
                ajaxID: id,
                ajaxRes: getData
            },
            success: function(data){
                $(this_tdata_modal2).html(data);
            }
        });
    }

function doneProducts(id,recStat){
  $.ajax({
    type:'get', 
    url :base_url+"Inventory/ajaxDoneProducts",
    data:{
      'ajaxID': id
    },
    success: function(data){
      location.reload();
    },
    error:function(){
      alert("Error");
    }
  });
}
function deleteProducts(id,recStat){
  $.ajax({
    type:'get',
    url :base_url+"Inventory/ajaxArchiveProducts",
    data:{
      'ajaxID': id
    },
    success: function(data){
  
      //location.reload();
    },
    error:function(){
      alert("Error");
    }
  });
}
function undoProducts(id,recStat){
  $.ajax({
    type:'get',
    url :base_url+"Inventory/ajaxUndoProducts",
    data:{
      'ajaxID': id
    },
    success: function(data){
      location.reload();
    },
    error:function(){
      alert("Error");
    }
  });
}
function getQty(qt){

}
function addComponents(id,qty){
  var tdElem = document.getElementById ("quant");
  var tdText = tdElem.innerHTML

  $.ajax({
    type:"GET",
    url:base_url+"Inventory/getCompID",
    data:{
      ajaxCompID: id,
      ajaxQty: tdText
    },
    success:function(data){
    
      var qty ="";
        $.ajax({
          type:"GET",
          url:base_url+"Inventory/ajaxUpdateComponents",
          data:{
            ajaxCompID: id,
            ajaxQty: tdText
          },
          success:function(data){
      
          }
      });
    }
  });
}
function deductRawMats(id){
  console.log(id);
  $.ajax({
    type:"GET",
    url:base_url+"Inventory/ajaxDeductRawMats",
    data:{
      'ajaxProdId':id,
    
    },
    success:function(data){
    }
  });

}
</script>


