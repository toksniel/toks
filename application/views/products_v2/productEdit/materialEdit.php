<style>
    hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #ccc;
        margin: 1em 0;
        padding: 0; 
    }
    #navbar{
        background: #000000;
        color: #ffffff;
        padding-top: 15px;
        margin: 0;
        position: -webkit-sticky;
        position: sticky;
        top: -1px;
        z-index:9999999999999;
        text-align:center;
        height: 50px auto;
    }
</style>    
<div id="navbar">
    <div class="row" >
        <div class="col-lg-3 col-md-3  col-sm-2">
        <a href="<?php echo site_url();?>ProductsV2/basicMaterialList"> <input type="button" class="btn btn-outline-danger rounded"  value="Cancel" > </a>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-4">
            <h1>Create Materials</h1>
        </div>
        <div class="col-lg-3 col-md-3  col-sm-2">
            <input type="button" class="btn btn-outline-success rounded" id="save" value="Save" > 
        </div>
    </div>
    <br>
</div>
<section class="dashboard-counts section-padding">
    <div class="row">
        <div class="col-sm-3">
        
        </div>
        <div class="col-sm-6">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12  col-sm-12">
                    <div class="paper container-fluid">
                        <br>
                       
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" align="center">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6  col-sm-6">
                                <div class="row">
                                <?php foreach($mats as $key => $value){?>
                                    <div class="col-sm-12">
                                        <label for="">Material Code</label>
                                        <input type="text" class="form-control" id="textMatCode" value="<?=$value->matCode?>">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="">Material Name</label>
                                        <input type="text" class="form-control" id="textMatName" value="<?=$value->matName?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6  col-sm-6">
                                <img src="#" alt="" id="blah" width="80%" height="auto">
                                <input type="file" name="pic" accept="image/*" class="form-control" id="zxc">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12  col-sm-12">
                                <label for="">Material Description</label>
                                <textarea name="" id="textMatDesc" cols="20" rows="5" class="form-control" ><?=$value->matDescription?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-5 col-md-5  col-sm-5">
                                <label for="">Unit of Basis</label>
                                <select name="" id="textUnitBasis" class="form-control">
                                    <option value="" selected disabled>Select Unit</option>
                                    <option value="mm">Millimeter</option>
                                    <option value="pcs">Pieces</option>
                                    <option value="m">Meter</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Material Weight</label>
                                <input type="text" class="form-control" id="textMatWeight" value="<?=$value->matUnitWeight?>">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="" class="">&nbsp;</label> <br>
                                <span for="" >Per <label class="bass" id="textMatWeightUnit"><?=$value->matBaseUnit?></label> </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">PHP Price</label>
                                <input type="text" class="form-control" id="textMatPrice" value="<?=$value->matUnitPrice?>">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="" class="">&nbsp;</label> <br>
                                <span for="" >Per <label class="bass" id="textMatPriceUnit"><?=$value->matBaseUnit?></label> </span>
                            </div>
                        </div>
                                <?php }?>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                               
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>