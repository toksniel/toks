<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <h1>Supplier</h1>
                    
                </div>
                <div class="col-sm-8">
                   <a style="float:right !important;" href="<?php echo base_url();?>Inventory/addSupplier"><input type="button" class="btn btn-outline-primary rounded" value="+ ADD" ></a> 
                </div>
            </div>
        
            <div class="form-group row">   
                <div class="col-sm-12">
                    <div>
                        <table class="table" border="1px">
                            <thead>
                                <th>Supplier Name</th>
                                <th>Supplier Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </thead>
                            <tbody>
                                <?php
                                    $supName="";
                                    $supComp="";
                                    $supEm="";
                                    $supPhone="";
                                    if(!empty($supplier)){
                                        foreach($supplier as $key => $value){
                                            $supName = $value->supplierName;
                                            $supComp = $value->supplierCompany;
                                            $supEm = $value->supplierEmail;
                                            $supPhone = $value->supplierPhone;
                                            echo '<tr>';
                                            echo '<td>'.$supName.'</td>';
                                            echo '<td>'.$supComp.'</td>';
                                            echo '<td>'.$supEm.'</td>';
                                            echo '<td>'.$supPhone.'</td>';
                                            echo '</tr>';
                                        }
                                    }else{
                                        echo '<tr colspan="4"><td rowspan="4">No Data Found.....</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br>
    </div>
</section>

