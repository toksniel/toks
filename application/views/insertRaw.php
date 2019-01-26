<section class="dashboard-counts section-padding"  >
    <div class="container-fluid">
		<div class="col-lg-12 col-md-12  col-sm-12">
			<div class="paper container-fluid">
				<br>
       			<div><h1>Add New Supplier</h1></div><hr>
				<div class="row">
                   
                    <div class="col-sm-4">
                        <input type="text" placeholder="code" class="form-control" id="txtrawCode" autofocus>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="name" class="form-control" id="txtrawName">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="unit" class="form-control" id="txtrawUnit">
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
        rawCode = $('#txtrawCode').val();
        rawName = $('#txtrawName').val();
        rawUnit = $('#txtrawUnit').val();


        
            addMaterial(rawCode,rawName,rawUnit);
        
    });
    function addMaterial(rawCode,rawName,rawUnit){
        $.ajax({
            type:'get',
            url:base_url+"Inventory/ajaxInsertRaw",
            data:{
                'ajaxrawCode':rawCode,
                'ajaxrawName':rawName,
                'ajaxrawUnit':rawUnit
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
