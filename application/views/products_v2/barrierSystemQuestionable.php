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
        <a href="<?php echo site_url();?>ProductsV2/barrierSystemList"> <input type="button" class="btn btn-outline-danger rounded"  value="Cancel" > </a>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-4">
            <h1>Create Barrier</h1>
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
                        <br>
                       
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" align="center">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h1>Barrier Details</h1><hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">System Code</label>
                                <input type="text" class="form-control" id="textSysCode">
                            </div>
                            <div class="col-lg-4 col-md-4  col-sm-4">
                                <label for="">System Configuration</label>
                                <select name="" id="textSysConfig" class="form-control">
                                    <option value="" selected disabled>Configuration</option>
                                    <option value="">Single Span</option>
                                    <option value="">Split</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">System Category</label>
                                <select name="" id="textSysCate" class="form-control">
                                    <option value="" selected disabled>Category</option>
                                    <?php
                                        if(!empty($drops)){
                                            foreach($drops as $key => $value){
                                                echo'<option value="'.$value->dropName.'">'.$value->dropName.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">System Name</label>
                                <input type="text" class="form-control" id="textSysName" data-toggle="tooltip" title="Required">
                            </div>
                           <!-- <div class="col-sm-3">
                                <label for="">System Price</label>
                                <input type="text" class="form-control" id="textSysPrice" data-toggle="tooltip" title="Required">
                            </div> -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12  col-sm-12">
                                <label for="">Description</label>
                                <textarea name="" id="textSysDesc" cols="30" rows="7" class="form-control"></textarea>
                                <hr>
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Width</label>
                                <input type="text" class="form-control" id="textWidth">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Height</label>
                                <input type="text" class="form-control" id="textHeight">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Length</label>
                                <input type="text" class="form-control" id="textLength">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Weight</label>
                                <input type="text" class="form-control" id="textWeight">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                               <h3>Component Used</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table" id="clickMe">
                                    <thead class="thead-dark">
                                        <th>Component</th>
                                        <th width="5%">Unit</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th width="10%">Option</th> 
                                    </thead>
                                    <tbody>
                                        <tr id="trSys">
                                            <td colspan="5"></td>
                                            <td><input type="button" data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary " value="Add"></td>
                                        </tr>
                                        <tr class="text-danger">
                                            <td colspan="4"></td>
                                            <td>Total Component Price :<label for=""id="totalCompPrice">0.00</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h3>Material Used</h3>
                                <table class="table table-hover" id="clickMe2">
                                    <thead class="thead-dark">
                                        <th>Material</th>
                                        <th>Size</th>
                                        <th width="5%">Unit</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th width="10%">Option</th>
                                    </thead>
                                    <tbody>
                                        <tr id="matTotal">
                                            <td colspan="6"></td>
                                            <td><input type="button" data-toggle="modal" data-target="#materialModal" class="btn btn-outline-primary " value="Add"></td>
                                        </tr>
                                        <tr class="text-danger">
                                            <td colspan="5"></td>
                                            <td>Total Material Price : <label for=""id="totalMatPrice">0.00</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-12 text-light bg-danger"  style="text-align:center !important;">
                                <h3>Net Total : <label for=""id="netPHP">0.00</label></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Modal component list -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Materials</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 ">
                        <span><input  type="text" id="byCode" class="form-control"><i class="fa fa-search"></i></span>
                    </div>

                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead class="bg-dark text-light">
                                <th>Component Class</th>
                                <th>Component Name</th>
                            </thead>
                            <tbody id="modalMatdata">
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Modal for materials -->

<div class="modal fade" id="materialModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Materials</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 ">
                        <span><input  type="text" id="byCode" class="form-control"><i class="fa fa-search"></i></span>
                    </div>

                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead class="bg-dark text-light">
                                <th>Material Code</th>
                                <th>Material Name</th>
                                <th>Option</th>
                            </thead>
                            <tbody id="modalMatdata2">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        showSysCompList();
        showMatList();
    });
    var base_url ="<?php echo base_url();?>";
    var filter="";
    var modalctr=0;
    var modalctr2=0;
    function showSysCompList(){
        $.ajax({
            url: base_url+"ProductsV2/sysCompListQuestionable",
            type: "post",
            data: {
            'xmlFilter' : filter,
            'xmlRequest' : 'modalmatDATA'
            },
            success: function(data){
                $('#modalMatdata').html(data);
            }
	    });
    }

 
    function getSysCompCode(code,name,unit,pricess){
        var x = JSON.stringify(pricess);
        modalctr++;
        var sysCOmp = '<tr id="'+modalctr+'"><td hidden><input type="text" class="txtIndex" value="'+modalctr+'" hidden><input type="text" value="'+code+'" id="textCompClass'+modalctr+'" hidden></td><td><label for=""id="textClassName'+modalctr+'">'+name+'</label></td><td><label id="textClassUnit'+modalctr+'">'+unit+'</label></td><td><input type="text" class="form-control tooo" id="textClassQuantity'+modalctr+'"></td><td><label for="" id="textClassPrice'+modalctr+'">'+pricess+'</td><td><label id="totalCompPrice'+modalctr+'">0.00</label></td><td><button class="btn btn-sm btn-danger "onclick="clearRow('+"'#"+modalctr+"'"+')">x</button></td></tr>';
        $(sysCOmp).insertBefore($('#trSys'));
    }
    function clearRow(identifier){
        $(identifier).remove();
    }
    function showMatList(){
        $.ajax({
            type: "post",
            url: base_url+"ProductsV2/matListQuestionable",
            data: {
            'xmlFilter' : filter,
            'xmlRequest' : 'modalmatDATA'
            },
            success: function(data){
                $('#modalMatdata2').html(data);
            }
	    });
    }
    function getMatCode(code,name,price,unit){
        modalctr2++;
        var htmlSTR = '<tr id="'+modalctr2+'"><td hidden><input type="text" class="txtIndex2" value="'+modalctr2+'" hidden><input type="text" value="'+code+'" id="textMaterialCode'+modalctr2+'" ></td><td><label for=""id="textMatName'+modalctr2+'">'+name+'</label></td><td><input type="text" id="textMatSize'+modalctr2+'" class="form-control sss"></td><td><label id="textMatUnit'+modalctr2+'">'+unit+'</label></td><td><input type="text" class="form-control sss" id="textMatQty'+modalctr2+'"></td><td><label for="" id="textMatPrice'+modalctr2+'" class="sss">'+price+'</label></td><td><label for="" id="textMatPriceTotal'+modalctr2+'">0.00</label></td><td><button class="btn btn-sm btn-danger "onclick="clearRow('+"'#"+modalctr2+"'"+')">x</button></td></tr>';
        $(htmlSTR).insertBefore($('#matTotal'));
    }

    // -----------------------------------------------------compute components start
    $('#clickMe').on('keypress keyenter keyup focusin focusout blur click',".tooo", function(){
		var subtextProd = $(this).val();
		subtextProd = subtextProd.replace(/\D/g,'');
		subtextProd = parseInt(subtextProd);
		if(subtextProd < 0 || isNaN(subtextProd)== true){
			subtextProd = 0;
		}
		$(this).val(subtextProd);
        materialcomputer();
    });
    $('#clickMe').on('keypress keyenter keyup focusin focusout blur click',".numberkupar", function(){
		var subtextProd = $(this).val();
        subtextProd = subtextProd.replace(/[^.0-9]/g, '');
        if(subtextProd < 0 || isNaN(subtextProd)== true){
            subtextProd = 0;
        }
        $(this).val(subtextProd);
        materialcomputer();
    });

    function materialcomputer(){
        totalcompphp =0;
        totalmatdede= 0;
        $(".txtIndex").each( function(){
        //materials
        var matcodeINDEx =  $(this).val();
        var qty = $('#textClassQuantity'+matcodeINDEx).val();
        var srp =  $('#textClassPrice'+matcodeINDEx).text();
        var toootal = qty * srp;
        totalcompphp +=  (qty * srp);
        $('#totalCompPrice'+matcodeINDEx).text(toootal.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
           /* console.log(matyQty);
            console.log(matsize);
            console.log(matpricePHP);
            console.log(matWaste);*/
        });
            if(totalcompphp !="" || totalcompphp == null || totalcompphp>0){
                $('#totalCompPrice').text(totalcompphp.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }else{
                totalcompphp = 0;
                $('#totalCompPrice').text(totalcompphp.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }
           realtime();
    }

    // -----------------------------------------------------compute components end
     // -----------------------------------------------------compute materials start
     $('#clickMe2').on('keypress keyenter keyup focusin focusout blur click',".sss", function(){
		var subtextProd = $(this).val();
		subtextProd = subtextProd.replace(/\D/g,'');
		subtextProd = parseInt(subtextProd);
		if(subtextProd < 0 || isNaN(subtextProd)== true){
			subtextProd = 0;
		}
		$(this).val(subtextProd);
        materialcomputer2();
    });
    $('#clickMe2').on('keypress keyenter keyup focusin focusout blur click',".numberkupar", function(){
		var subtextProd = $(this).val();
        subtextProd = subtextProd.replace(/[^.0-9]/g, '');
        if(subtextProd < 0 || isNaN(subtextProd)== true){
            subtextProd = 0;
        }
        $(this).val(subtextProd);
        materialcomputer2();
    });
    function materialcomputer2(){
        totalcompphp =0;
        totalmatdede= 0;
        totalMatsss=0;
        $(".txtIndex2").each( function(){
        //materials
        var matcodeINDEx =  $(this).val();
        var size = $('#textMatSize'+matcodeINDEx).val();
        var qty =  $('#textMatQty'+matcodeINDEx).val();
        var srp = $('#textMatPrice'+matcodeINDEx).text();
        var toootal = qty * srp * size;
        totalMatsss +=  (qty * srp * size);
        $('#textMatPriceTotal'+matcodeINDEx).text(toootal.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
           /* console.log(matyQty);
            console.log(matsize);
            console.log(matpricePHP);
            console.log(matWaste);*/
        });
            if(totalMatsss !="" || totalMatsss == null || totalMatsss>0){
                $('#totalMatPrice').text(totalMatsss.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }else{
                totalcompphp = 0;
                $('#totalMatPrice').text(totalMatsss.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }
           realtime();
    }

     
    
    function realtime(){
		var totalMatPrice = parseFloat($('#totalMatPrice').text().replace(/[^.0-9]/g, ''));
		var totalCompPrice = parseFloat($('#totalCompPrice').text().replace(/[^.0-9]/g, ''));
		var tPHP = totalMatPrice + totalCompPrice;

		$('#netPHP').text(tPHP.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
	}
         // -----------------------------------------------------compute materials start
     // -----------------------------------------------------saving
    $('#save').on('click',function(){
        var sysCode = $('#textSysCode').val();
        var sysName = $('#textSysName').val();
        var sysPrice = $('#netPHP').text();
        //var sysPrice = $('#textSysPrice').val();
        var sysConfig = $('#textSysConfig').val();
        var sysCate = $('#textSysCate').val();
        var sysDesc = $('#textSysDesc').val();
        var sysWeight = $('#textWeight').val();
        var sysHeight = $('#textHeight').val();
        var sysWidth = $('#textWidth').val();
        var sysLength = $('#textLength').val();
        console.log(sysLength);

        $.ajax({
            type:'get',
           // url:base_url+"ProductsV2/savingBarrierSystem",
            data:{
                'ajaxSysCode':sysCode,
                'ajaxSysName':sysName,
                'ajaxSysPrice':sysPrice,
                'ajaxSysConfig':sysConfig,
                'ajaxSysCate':sysCate,
                'ajaxSysDesc':sysDesc,
                'ajaxSysWeight':sysWeight,
                'ajaxSysHeight':sysHeight,
                'ajaxSysWidth':sysWidth,
                'ajaxSysLength':sysLength
            },
            success:function(){
                //savingSysComp(sysCode);
                //savingSysMat(sysCode);
            }
        });
    });
    function savingSysComp(sysCode){
        $(".txtIndex").each( function(){
            var compCtrIndex =  $(this).val();
            var componentCode = $('#textComponentCode'+compCtrIndex).val();
           // var compSize = $('#textClassSize'+compCtrIndex).val();

            var CompClass = $('#textCompClass'+compCtrIndex).val();
            var compUnit = $('#textClassUnit'+compCtrIndex).text();
            var comQty = $('#textClassQuantity'+compCtrIndex).val();
            console.log(componentCode);
            console.log(compSize);
            console.log(CompClass);
            console.log(compUnit);
            console.log(comQty);
            /*$.ajax({
                type:'get',
                url:base_url+"ProductsV2/savingBarrierComp",
                data:{
                    'ajaxCompCode':componentCode,
                    'ajaxCompClass':CompClass,
                    'ajaxCompSize':compSize,
                    'ajaxCompUnit':compUnit,
                    'ajaxCompQty':comQty
                },
                success:function(){

                }
            });*/
            $.ajax({
                type:"GET",
                url:base_url+"ProductsV2/",
                data:{

                }

            });
        });
    }
    function savingSysMat(sysCode){
            $(".txtIndex2").each( function(){
                var matCtrIndex =  $(this).val();
                var materialCode = $('#textMaterialCode'+matCtrIndex).val();
                var matName = $('#textMatName'+matCtrIndex).val();
                var matSize = $('#textMatSize'+matCtrIndex).val();
                var matUnit = $('#textMatUnit'+matCtrIndex).text();
                var matQty = $('#textMatQty'+matCtrIndex).val();
                console.log(materialCode);
                $.ajax({
                    type:'get',
                    url:base_url+"ProductsV2/savingBarrierMat",
                    data:{
                        'ajaxBarSysCode':sysCode,
                        'ajaxMatCode':materialCode,
                        'ajaxMatName':matName,
                        'ajaxMatSize':matSize,
                        'ajaxMatUnit':matUnit,
                        'ajaxMatQty':matQty
                    },
                    success:function(){

                    }
                });
            });
        }

    
</script>