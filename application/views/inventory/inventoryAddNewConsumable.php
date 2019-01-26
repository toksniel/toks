<section class="dashboard-counts section-padding"  >
    <div class="container-fluid">
		<div class="col-lg-12 col-md-12  col-sm-12">
			<div class="paper container-fluid">
				<br>
       			<div><h1>Add New Components</h1></div><hr>
				<div class="row">
                    <div class="col-sm-4">
                        <input type="text" placeholder="Consumable Name" class="form-control" id="txtConsumableName">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Consumable Unit" class="form-control" id="txtConsumableUnit">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Consumable Quantity" class="form-control" id="txtConsumableQty">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Low Stock Value" class="form-control" id="txtConsumableStock">
                    </div>
                    
            	</div>
                <br><input type="button" class="btn btn-outline-success rounded" value="Save" id="save">
                <a href="<?php echo base_url();?>Inventory/inventoryConsumables" class="btn btn-outline-danger rounded" style="margin: 10px;">Cancel</a><hr><br>
                
			</div>
		</div>
    </div>
</section>
<script>
var consName ="";
var consUnit ="";
var consStock ="";
var consQty ="";
var str=0;
var base_url ="<?php echo base_url();?>"
$('#save').on('click',function(){
    consName = $('#txtComponentName').val();
    consStock = $('#txtComponentStock').val();
    consQty = $('#txtComponentQty').val();
    consUnit = $('#txtComponentUnit').val();
    var confirmSave = confirm("Are you sure you want to Add this Consumable?");
    if(confirmSave == true){
        str+=1;
    }
    if(str==1){
        addConsumable(consName,consUnit,consStock,consQty);
    }
});
function addConsumable(consName,consCode,consUnit,consStock,consQty){
    $.ajax({
        type:'get',
        url:base_url+"Inventory/ajaxAddNewConsumable",
        data:{
            'ajaxName':consName,
            'ajaxUnit':consUnit,
            'ajaxStock':consStock,
            'ajaxQty':consQty
        },
        success: function(data){
            window.location.replace("<?php echo base_url();?>Inventory/inventoryConsumable");
        },
        error:function(){
            alert("Error Saving");
        }
    });
}
</script>
