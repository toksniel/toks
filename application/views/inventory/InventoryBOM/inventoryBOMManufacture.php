<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Manufacturing Orders</h1></div><hr>
            <div class="form-group row">   
                <div class="col-sm-4">
                    <label><strong>Choose Product</strong></label>
                    <select class="form-control" id="componentDrop">
                        <option>Select Component</option>
                        <?php
                            $x=0;
                            $compList ="";
                            $compID="";
                            foreach($componentList as $key => $value){
                                $x++;
                                $compList =$value->compName;
                                $comID= $value->componentUID;
                                echo '<option value="'.$comID.'">'.$x.'-'.$compList.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label><strong>Quantity to Produce</strong></label>
                    <input type="text" class="form-control" placeholder="Enter Quantity (pcs)" id="compQty">
                </div>
                <!-- <div class="col-sm-2">
                   <label><strong>Deadline</strong></label>
                      <input type="date" class="form-control">
                </div>-->
                <div class="col-sm-2">
                    <label for="">&nbsp;</label><br>
                    <input type="button" class="btn btn-outline-primary rounded" value="Calculate" id="calculate">
                </div>
            </div>
            <hr>
            <div>
                <table class="table table-hover" id="myTable" >
                    <thead>
                        <th>#</th>
                        <th>Material Name</th>
                        <th>Material Length</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody id="this_tdata_modal">
                    </tbody>
                </table>
                
            </div>
            <br><input type="button" class="btn btn-outline-success rounded" value="Save for Production" id="save"><br><br>
        </div>
    </div>
</section>
<script>
    var compQty = "";
    var getData = "";
    var dropID = "";

    var prodCompID ="";
    var prodMatID = ""
    var prodMatName ="";
    var prodMatLength ="";
    var prodMatUnit ="";
    var prodMatQuantity ="";
    var str=0;
    var listNum = 0;
    var id="";
    var base_url="<?php echo base_url();?>";
    //---- get Mat Data
    $('#calculate').on('click',function(){
        dropID = $('#componentDrop').val();
        compQty =$('#compQty').val();
        getData = "getData";
        $.ajax({
            type:"POST",
            url: base_url+"Inventory/getMatData",
            data:{
                ajaxDropID: dropID,
                ajaxRes: getData,
                ajaxQty: compQty
            },
            success: function(data){
                $(this_tdata_modal).html(data);
            }
        });
    });
    //-----getLastID and saving

        $(document).ready(function() {
           
            $("#save").click(function() { 
                compQty =$('#compQty').val();
                
                $.ajax({
                    type: "GET",
                    url:    base_url+"Inventory/ajaxGetLastID",   
                    success: function(lastID){                    
                        $("#responsecontainer").html(lastID); 
                  
                        prodCompID = $('#componentDrop').val();

                    
                        prodPerItem = $('#compQty').val();
                        $('#this_tdata_modal tr').each(function(row, tr){
                            prodMatID = $(tr).find('td:eq(0)').text();
                            prodMatName = $(tr).find('td:eq(1)').text();
                            prodMatLength = $(tr).find('td:eq(2)').text();
                            prodMatUnit = $(tr).find('td:eq(3)').text();
                            prodMatQuantity =$(tr).find('td:eq(4)').text();
                            addToProduction(prodCompID,lastID,prodMatID,prodMatName,prodMatLength,prodMatUnit,prodMatQuantity,prodPerItem);
                           
                        });
                   
                        getID();
                        addToListProduct(compQty);
                
                    }
                });
            });
        });
   
    function addToProduction(prodCompID,lastID,prodMatID,prodMatName,prodMatLength,prodMatUnit,prodMatQuantity,prodPerItem){
        $.ajax({
            type:"GET",
            url: base_url+"Inventory/saveToProduction",
            data:{
                'ajaxprodCompID': prodCompID,
                'ajaxLastID':lastID,
                'ajaxprodMatID': prodMatID,
                'ajaxprodMatName': prodMatName,
                'ajaxprodMatLength': prodMatLength,
                'ajaxprodMatUnit': prodMatUnit,
                'ajaxprodMatQuantity': prodMatQuantity,
                'ajaxprodPcsQuantity':prodPerItem
                },
                success: function(data){
                }
        });
    } 
    function getID(ids){
        compQty =$('#compQty').val();
        $.ajax({
            type:'GET',
            url: base_url+"Inventory/ajaxGetLastListProdID",
            success:function(ids){
                compQty =$('#compQty').val();
              
                $("#as").html(ids);
                addToListProduct(ids,compQty);
            }
        });
    }
    function addToListProduct(ids,compQty){
        $.ajax({
            type:"GET",
            url: base_url+"Inventory/saveToProductionList",
            data:{
                'ajaxProductID':ids,
                'ajaxCompID':prodCompID,
                'ajaxQty':compQty
            },
            success: function(data){
                location.reload();
            }
        });
    }
</script>


