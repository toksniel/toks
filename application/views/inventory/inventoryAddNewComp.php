<section class="dashboard-counts section-padding"  >
    <div class="container-fluid">
		<div class="col-lg-12 col-md-12  col-sm-12">
			<div class="paper container-fluid">
				<br>
       			<div><h1>Add New Components</h1></div><hr>
				<div class="row">
                    <div class="col-sm-2">
                        <input type="text" placeholder="Component Code" class="form-control" id="txtComponentCode">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Component Name" class="form-control" id="txtComponentName">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Component Unit" class="form-control" id="txtComponentUnit">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Component Quantity" class="form-control" id="txtComponentQty">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Low Stock Value" class="form-control" id="txtComponentStock">
                    </div>
                    
            	</div>
                <br><input type="button" class="btn btn-outline-success rounded" value="Save" id="save">
                <a href="<?php echo base_url();?>Inventory/inventoryComponents" class="btn btn-outline-danger rounded" style="margin: 10px;">Cancel</a><hr><br>
                
			</div>
		</div>
    </div>
</section>
<script>
var compName ="";
var compCode = "";
var compUnit ="";
var compStock ="";
var compQty ="";
var str=0;
var base_url ="<?php echo base_url();?>"
$('#save').on('click',function(){
    compName = $('#txtComponentName').val();
    compCode = $('#txtComponentCode').val();
    compStock = $('#txtComponentStock').val();
    compQty = $('#txtComponentQty').val();
    compUnit = $('#txtComponentUnit').val();
    var confirmSave = confirm("Are you sure you want to Add this Component?");
    if(confirmSave == true){
        str+=1;
    }
    if(str==1){
        addComponent(compName,compCode,compUnit,compStock,compQty);
    }
});
function addComponent(compName,compCode,compUnit,compStock,compQty){
    $.ajax({
        type:'get',
        url:base_url+"Inventory/ajaxAddNewComponent",
        data:{
            'ajaxCode':compCode,
            'ajaxName':compName,
            'ajaxUnit':compUnit,
            'ajaxStock':compStock,
            'ajaxQty':compQty
        },
        success: function(data){
            window.location.replace("<?php echo base_url();?>Inventory/inventoryComponents");
        },
        error:function(){
            alert("Error Saving");
        }
    });
}
</script>
<script>
    $(document).ready(function(){
        console.log('')
    })
</script>