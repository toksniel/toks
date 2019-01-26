<section class="dashboard-counts section-padding"  >
    <div class="container-fluid">
		<div class="col-lg-12 col-md-12  col-sm-12">
			<div class="paper container-fluid">
				<br>
       			<div><h1>Add New Raw Material</h1></div><hr>
				<div class="row">
                    <div class="col-sm-4">
                        <input type="text" placeholder="Material Name" class="form-control" id="txtMaterialName">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Material Unit" class="form-control" id="txtMaterialUnit">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Material Quantity" class="form-control" id="txtMaterialQty">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Low Stock Value" class="form-control" id="txtMaterialStock">
                    </div>
                    
            	</div>
                <br><input type="button" class="btn btn-outline-success rounded" value="Save" id="save">
                <a href="<?php echo base_url();?>Inventory/inventoryRawMat" class="btn btn-outline-danger rounded" style="margin: 10px;">Cancel</a><hr><br>
                
			</div>
		</div>
    </div>
</section>
<script>
    var matName ="";
    var matCode = "";
    var matUnit ="";
    var matStock ="";
    var matQty ="";
    var str=0;
    var base_url ="<?php echo base_url();?>"
    $('#save').on('click',function(){
        matName = $('#txtMaterialName').val();
        matStock = $('#txtMaterialStock').val();
        matQty = $('#txtMaterialQty').val();
        matUnit = $('#txtMaterialUnit').val();
        var confirmSave = confirm("Are you sure you want to Add this Raw Material?");
        if(confirmSave == true){
            str+=1;
        }
        if(str==1){
            addMaterial(matName,matUnit,matStock,matQty);
        }
    });
    function addMaterial(matName,matUnit,matStock,matQty){
        $.ajax({
            type:'get',
            url:base_url+"Inventory/ajaxAddNewRawMat",
            data:{
                'ajaxName':matName,
                'ajaxUnit':matUnit,
                'ajaxStock':matStock,
                'ajaxQty':matQty
            },
            success: function(data){
                window.location.replace("<?php echo base_url();?>Inventory/inventoryRawMat");
            },
            error:function(){
                alert("Error Saving");
            }
        });
    }
</script>
