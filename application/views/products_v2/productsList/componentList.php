<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <h1>Component List</h1> 
                    
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo base_url('ProductsV2/componentsCreate');?>"><input type="button" class="btn btn-outline-primary rounded" value="Add"></a>
                </div>
            </div><hr>
            <div class="form-group row"> 
               <table id="myTable" class="table ">
                    <thead class="bg-dark text-light">
                        <th width="20%">Component Code</th>
                        <th>Material Name</th>
                        <th>Material Description</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($mats)){
                                foreach($mats as $key => $value){
                                    echo    '<tr onclick="matList('."'".$value->compID."'".');">
                                                <td data-toggle="modal" data-target="#exampleModalCenter">'.$value->compID.'</td>
                                                <td data-toggle="modal" data-target="#exampleModalCenter">'.$value->compName.'</td>
                                                <td data-toggle="modal" data-target="#exampleModalCenter">'.$value->compDescription.'</td>
                                                <td><input type="button" class="btn btn-outline-primary" onclick="getCompCode('."'".$value->compID."'".')" value="Edit"></td>
                                            </tr>';
                                }
                            }
                        ?> 
                    </tbody>
               </table>
            </div>
            <br><br>
        </div> 
    </div>
</section>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Select Dimension</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-hover">
                <thead>
                    <th>Material Code</th>
                    <th>Material Name</th>
                    <th>Size</th>
                    <th>Material Quantity</th>
                </thead>
                <tbody id="matModal">
                
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<script>
    var base_url ="<?php echo base_url();?>";
    $(document).ready(function() {
        $('#myTable').DataTable( {
        } );
    } );

    function matList(id){
    
        //console.log(id);
        $.ajax({
            type:"GET",
            url:base_url+"ProductsV2/compMatList",
            data:{
                'ajaxID':id
            },
            success:function(data){
                $("#matModal").html(data);
            }
        });
    }
    function getCompCode(id){
        console.log(id);
        $.ajax({
            type:"GET",
            url:base_url+"ProductsV2/componentEdit",
            data:{
                'ajaxID':id
            },
            success:function(){
                //window.location.replace(base_url+"ProductsV2/componentEdit");
            }

        });
    }
</script>