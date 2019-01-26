<section class="dashboard-counts section-padding"  >
    <div class="container-fluid">
		<div class="col-lg-12 col-md-12  col-sm-12">
			<div class="paper container-fluid">
				<br>
       			<div><h1>Add New Supplier</h1></div><hr>
				<div class="row">
                    <div class="col-sm-4">
                        <input type="text" placeholder="Supplier Name" class="form-control" id="txtSupplierName">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Supplier Company" class="form-control" id="txtSupplierCompany">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Supplier Email" class="form-control" id="txtSupplierEmail">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Supplier Phone" class="form-control" id="txtSupplierPhone">
                    </div>
                    
            	</div>
                <br><input type="button" class="btn btn-outline-success rounded" value="Save" id="save">
                <a href="<?php echo base_url();?>Inventory/inventorySupplierList" class="btn btn-outline-danger rounded" style="margin: 10px;">Cancel</a><hr><br>
                
			</div>
		</div>
    </div>
</section>
<script>
    var supName ="";
    var supCompany = "";
    var supEmail ="";
    var supPhone ="";
    var str=0;
    var base_url ="<?php echo base_url();?>"
    $('#save').on('click',function(){
        supName = $('#txtSupplierName').val();
        supCompany = $('#txtSupplierCompany').val();
        supEmail = $('#txtSupplierEmail').val();
        supPhone = $('#txtSupplierPhone').val();

        var confirmSave = confirm("Are you sure you want to Add this Supplier?");
        if(confirmSave == true){
            str+=1;
        }
        if(str==1){
            addMaterial(supName,supCompany,supEmail,supPhone);
        }
    });
    function addMaterial(supName,supCompany,supEmail,supPhone){
        $.ajax({
            type:'get',
            url:base_url+"Inventory/ajaxAddNewSupplier",
            data:{
                'ajaxName':supName,
                'ajaxCompany':supCompany,
                'ajaxEmail':supEmail,
                'ajaxPhone':supPhone
            },
            success: function(data){
                //window.location.replace("<?php echo base_url();?>Inventory/inventorySupplierList");
            },
            error:function(){
                alert("Error Saving");
            }
        });
    }
</script>
