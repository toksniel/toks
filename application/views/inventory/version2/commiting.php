<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div>
                <h1>Delivery</h1><hr>
            </div>
            <div class="row">
                <div class="col-lg-1">
                    <label for="">#</label>
                </div>
                <div class="col-lg-7">
                    <label for="">Name</label>
                </div>
                <div class="col-lg-2">
                    <label for="">Suggested</label>
                </div>
                <div class="col-lg-2">
                    <label for="">Current</label>
                </div>
            </div>
            <div class="row">
                <?php
                    $x=0;
                    if(!empty($comm)){
                        foreach($comm as $key => $value){
                            $x++;
                            echo'
                                <div class="col-lg-1">
                                    <input type="text" class="form-control" value="'.$x.'">
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control">
                                </div><br><br>
                            ';
                        }
                    }else{
                        echo'
                            <div class="row">
                                <div class="col-lg-12" style="text-align:center; color:red;">
                                    <h1>No Data Found......<h1>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
            <br>
        </div>
    </div>
</section>