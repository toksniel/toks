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
        <a href="<?php echo site_url();?>ProductsV2/fabricationList"> <input type="button" class="btn btn-outline-danger rounded"  value="Cancel" > </a>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-4">
            <h1>Create Fabrication</h1>
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
                            <div class="col-sm-6">
                                <label for="">Fabrication Code</label>
                                <input type="text" class="form-control" id="textFabCode" data-toggle="tooltip" title="Required">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Fabrication Name</label>
                                <input type="text" class="form-control" id="textFabName">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Fabrication Cost</label>
                                <input type="text" class="form-control" id="textFabCost">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Fabrication Unit</label>
                                <select name="" id="textUnitBasis" class="form-control">
                                    <option value="" selected disabled>Select Unit</option>
                                    <option value="mm">Millimeter</option>
                                    <option value="pcs">Pieces</option>
                                    <option value="m">Meter</option>
                                </select>
                            </div>
                        </div>
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
<script>
    var base_url ="<?php echo base_url();?>";
    $('#save').on('click',function(){
        var fabcode = $('#textFabCode').val();
        var fabName = $('#textFabName').val();
        var fabCost = $('#textFabCost').val();
        var fabUnit = $('#textUnitBasis').val();
        $.ajax({
            type:'get',
            url:base_url+"ProductsV2/savingNewFabrication",
            data:{
                'ajaxCode':fabcode,
                'ajaxName':fabName,
                'ajaxCost':fabCost,
                'ajaxUnit':fabUnit
            },
            success:function(){

            }
        });
    });
</script>