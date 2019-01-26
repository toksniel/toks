<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <h1>Material List</h1> 
                    
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo base_url('ProductsV2/materialsCreate');?>"><input type="button" class="btn btn-outline-primary rounded" value="Add"></a>
                </div>
            </div><hr>
            <div class="form-group row"> 
               <table id="myTable" class="table table-hover">
                    <thead class="bg-dark text-light">
                        <th width="30%">Material Code</th>
                        <th>Material Name</th>
                        <th>Material Description</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($mats)){
                                foreach($mats as $key => $value){
                                    echo    '<tr >
                                                <td  data-toggle="modal" data-target="#exampleModalCenter">'.$value->matCode.'</td>
                                                <td onclick="matImage('."'".$value->matDimProp."'".');" data-toggle="modal" data-target="#exampleModalCenter">'.$value->matName.'</td>
                                                <td onclick="matImage('."'".$value->matDimProp."'".');" data-toggle="modal" data-target="#exampleModalCenter">'.$value->matDescription.'</td>
                                                <td><input type="button" class="btn btn-outline-primary rounded" onclick="materialEdit('.$value->matID.')" value="Edit"></td>
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
<!-- Modal 
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Dimension</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4" id="matDimModal">
                   
                </div>
                <div class="col-sm-4">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table>
                        <thead>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>-->
<script>
    var base_url ="<?php echo base_url();?>";
    $(document).ready(function(){
        $('#myTable').DataTable({
        });
    });

    function matImage(id){
        console.log(id);
     /*   $.ajax({
            type:"GET",
            url:base_url+"ProductsV2/matDimImage",
            data:{
                'ajaxID':id
            },
            success:function(data){
                $("#matDimModal").html(data);
            }
        });*/
    }
    function materialEdit(id){
        console.log(id);
        $.ajax({
            type:'GET',
            url:base_url+"ProductsV2/materialEdit",
            data:{
                'ajaxid':id
            },
            success:function(){
                window.location.replace(base_url+"ProductsV2/materialEdit");
            }
        });
    }
</script>