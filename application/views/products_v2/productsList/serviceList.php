<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <h1>Service List</h1> 
                    
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo base_url('ProductsV2/serviceCreate');?>"><input type="button" class="btn btn-outline-primary rounded" value="Add"></a>
                </div>
            </div><hr>
            <div class="form-group row"> 
               <table id="myTable" class="table table-hover">
                    <thead class="bg-dark text-light">
                        <th>#</th>
                        <th width="30%">Material Code</th>
                        <th>Material Name</th>
                    </thead>
                    <tbody>
                        <?php
                            $x = 0;
                            if(!empty($serviceList)){
                                foreach($serviceList as $key => $value){
                                    $x++;
                                    echo    '<tr onclick="serviceBreakdown('."'".$value->serviceCode."'".')" data-toggle="modal" data-target="#exampleModalCenter">
                                                <td>'.$x.'</td>
                                                <td data-toggle="modal" data-target="#exampleModalCenter">'.$value->serviceCode.'</td>
                                                <td data-toggle="modal" data-target="#exampleModalCenter">'.$value->serviceName.'</td>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Breakdown</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-12">
                    <table>
                        <thead class="bg-dark text-white">
                            <th>Name</th>
                            <th>Value</th>
                            <th>Cost</th>
                            <th>Unit</th>
                        </thead>
                        <tbody id="breakService">
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
        </div>
    </div>
</div>
<script>
    var base_url ="<?php echo base_url();?>";
    $(document).ready(function(){
        $('#myTable').DataTable({
        });
    });

    function serviceBreakdown(id){
        var x = $(this).val(id);
        console.log(x);
        $.ajax({
            type:"GET",
            url:base_url+"ProductsV2/ajaxGetServiceBreakdown",
            data:{
                'ajaxID':id
            },
            success:function(data){
                $("#breakService").html(data);
            }
        });
    }
      
</script>