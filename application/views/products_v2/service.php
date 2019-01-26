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
        <a href="<?php echo site_url();?>ProductsV2/serviceList"> <input type="button" class="btn btn-outline-danger rounded"  value="Cancel" > </a>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-4">
            <h1>Create Service</h1>
        </div>
        <div class="col-lg-3 col-md-3  col-sm-2">
            <input type="button" class="btn btn-outline-success rounded" id="save" value="Save" > 
        </div>
    </div>
    <br>
</div>
<section class="dashboard-counts section-padding">
    <div class="row">

        <div class="col-sm-12">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12  col-sm-12">
                    <div class="paper container-fluid">
                        <div class="row">
                            <br>
                            <div class="col-lg-12 col-md-12 col-sm-12" align="center">
                                
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="">Service code</label>
                                <input type="text" class="form-control" id="textSeviceCode">
                            </div>
                            <div class="ccol-lg-12 col-md-12 col-sm-12">
                                <label for="">Service Name</label>
                                <input type="text" class="form-control" id="textServiceName">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="">Service Description</label>
                                <textarea name="" id="textServiceDescription" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12">
                                &nbsp;
                            </div>
                            <div class="row rounded" style="border:1px solid">
                                <div class="col-sm-12">
                                    <span><h3>Service Cost Breakdown </h3></span>
                                </div>
                                <div class="col-sm-12 " style="border:1px solid">
                                    <table id="materyalisKU2">
                                        <thead>
                                            <th>Description</th>
                                            <th>Value</th>
                                            <th>PHP Cost</th>
                                            <th>Unit</th>
                                            <th>Total</th>
                                            <th>Option</th>
                                        </thead>
                                        <tbody>
                                            <tr  id="serviceTotal" style="border-top:1px solid;">
                                                <td colspan="4" class=" text-danger"><strong>Total Service Cost</strong></td>
                                                <td ><strong id="textTotalService" class="text-danger">0.00</strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <input type="button" class="btn btn-outline-primary rounded" value="Add" style="float:right !important;" id="addBreakdown">
                                    <br><br>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    //add class for computation

    var base_url ="<?php echo base_url();?>";
    var ctr=0;
    $('#addBreakdown').on('click',function(){
        ctr++;
        var addingFields = '<tr id="'+ctr+'" class=""><td hidden><input class="txtIndex form-control" type="text" value="'+ctr+'" hidden></td><td><input type="text" class="form-control" id="textDes'+ctr+'"></td><td><input type="text" class="form-control countings" id="textVal'+ctr+'"></td><td><input type="text" class="form-control countings" id="textPHP'+ctr+'"></td><td><select name="" id="textUnit'+ctr+'" class="form-control"><option value="" selected disabled>Select Unit</option><option value="usd">USD</option><option value="eur">EUR</option><option value="php">PHP</option></select></td><td><label for="" id="textTots'+ctr+'">0.00</label></td><td><input type="button" class="btn btn-outline-danger btn-xs" value="X" onclick="clearRow('+"'#"+ctr+"'"+')"></td></tr>';
        $(addingFields).insertBefore($('#serviceTotal'));
    });
    function clearRow(identifier){
        $(identifier).remove();
    }
    $('#save').on('click', function(){
        var serviceCode = $('#textSeviceCode').val();
        var serviceName = $('#textServiceName').val();
        var serviceDescription = $('#textServiceDescription').val();
        var ServiceTotal = $('#textTotalService').text();
        console.log(serviceName);
        console.log(serviceDescription);
        
        $.ajax({
            type:'GET',
            url:base_url+"ProductsV2/ajaxSavingService",
            data:{
                'ajaxServiceCode':serviceCode,
                'ajaxServiceName':serviceName,
                'ajaxServiceDescription':serviceDescription,
                'ajaxServiceTotal':ServiceTotal
            },
            success:function(){ 
                saveBreakDown(serviceCode);
            }
        });
       
    });
    function saveBreakDown(serviceCode){
        var ctrs=0;
        $('.txtIndex').each(function(){
            var breakServiceIndex =  $(this).val();
            var breakDescription = $('#textDes'+breakServiceIndex).val();
            var breakValue = $('#textVal'+breakServiceIndex).val();
            var breakCost = $('#textPHP'+breakServiceIndex).val();
            var beakUnit = $('#textUnit'+breakServiceIndex).val();
            console.log(breakServiceIndex);
            console.log(breakDescription);
            console.log(breakValue);
            console.log(breakCost);
            console.log(beakUnit);
            console.log(serviceCode);
            $.ajax({
                type:'GET',
                url:base_url+"ProductsV2/ajaxServiceBreak",
                data:{
                    'ajaxBreakDesc':breakDescription,
                    'ajaxBreakVal':breakValue,
                    'ajaxBreakCost':breakCost,
                    'ajaxBreakUnit':beakUnit,
                    'ajaxServiceCode':serviceCode
                },
                success:function(){ 

                }
            });
        });
    }
</script>   
