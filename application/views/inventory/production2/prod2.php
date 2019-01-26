<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Manufacturing Orders</h1></div><hr>
            <div class="form-group row">
                <div class="col-sm-4">
                   <?php
                    foreach($productionListComponent as $key => $value){
                        $compName = $value->compName;
                        echo '<h2>'.$compName .'</h2>';
                    }
                   ?>
                </div>
            </div>
            <hr>
            <div>
            <table class="table table-hover" id="myTable">
                    <thead>
                        <th> Name</th>
                        <th> Length</th>
                        <th>Quantity</th>
                      
                    </thead>
                    <tbody>
                    <?php
                        foreach ($productionListMaterial as $key =>$value){
                        $matName = $value->matName;
                        $matLength = $value->matLength;
                        $matQty = $value->matQuantity;
                        
                        echo '<tr>';
                            echo '<td>'.$matName.'</td>';
                            echo '<td>'.$matLength.'</td>';
                            echo '<td>'.$matQty.'</td>';
                            
                        echo '</tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <br><input type="button" class="btn btn-outline-success rounded" value="Next" id="save"><br><br>
        </div>
    </div>
</section>