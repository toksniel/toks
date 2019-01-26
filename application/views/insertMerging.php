<section class="dashboard-counts section-padding"  >
    <div class="container-fluid">
		<div class="col-lg-12 col-md-12  col-sm-12">
			<div class="paper container-fluid">
				<br>
       			<div><h1>Merging</h1></div><hr>
				<div class="row">
                   
                    <div class="col-sm-4">
                        <input type="text" placeholder="rawID" class="form-control" id="txtrawID" autofocus>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="compID" class="form-control" id="txtcompID">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="length" class="form-control" id="txtlength">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="quantity" class="form-control" id="txtquant">
                    </div>
                    
            	</div>
                <br><input type="button" class="btn btn-outline-success rounded" value="Save" id="save">
           
                
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
        rawID = $('#txtrawID').val();
        compID = $('#txtcompID').val();
        length = $('#txtlength').val();
        qty = $('#txtquant').val();

        
            addMaterial(rawID,compID,length,qty);
        
    });
    function addMaterial(rawID,compID,length,qty){
        $.ajax({
            type:'get',
            url:base_url+"Inventory/ajaxInsertMerging",
            data:{
                'ajaxrawID':rawID,
                'ajaxcompID':compID,
                'ajaxlength':length,
                'ajaxqty':qty
            },
            success: function(data){
                //window.location.replace("<?php echo base_url();?>Inventory/inventorySupplierList");

                location.reload(); 
            },
            error:function(){
                alert("Error Saving");
            }
        });
    }
</script>
