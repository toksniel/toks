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
            <a href="<?php echo site_url();?>ProductsV2/componentList"> <input type="button" class="btn btn-outline-danger rounded"  value="Cancel" > </a>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-4">
            <h1>Create Component</h1>
        </div>
        <div class="col-lg-3 col-md-3  col-sm-2">
            <input type="button" class="btn btn-outline-success rounded" id="save" value="Save" > 
        </div>
    </div>
    <br>
</div>
            
<section class="dashboard-counts section-padding">
    <div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-8">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12  col-sm-12">
                    <div class="paper container-fluid">
                        <br>
                       
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" align="center">
                                <img src="#" alt="" id="blah" width="80%" height="auto">
                                <input type="file" name="pic" accept="image/*" class="form-control" id="zxc">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6  col-sm-6">
                                <label for="">Component Code</label>
                                <input type="text" class="form-control" id="textCompCode">
                            </div>
                            <div class="col-lg-6 col-md-6  col-sm-6">
                                <label for="">Component Class</label>
                                <select name="" id="textCompClass" class="form-control">
                                    <option value="" selected disabled>Select Class</option>
                                    <?php
                                        if(!empty($drops)){
                                            foreach($drops as $key => $value){
                                                echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Component Name</label>
                                <input type="text" name="" class="form-control" id="textCompName">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Component Description</label>
                                <textarea name="" id="textCompDesc" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Barrier Dimension Basis</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Size</label>
                                <input type="text" class="form-control" id="textDimBasis">
                            </div>
                            <div class="col-sm-4">
                                <label for="">Unit</label><br>
                                <label for="" id="baseUnit"></label>
                            </div>
                        </div>
                        <hr>
                        <div class="row rounded" style="border:1px solid">
                            <div class="col-sm-12">
                                <span><h3>Material <input type="button" data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary rounded" value="Add"></h3>  </span>
                            </div>
                            <div class="col-sm-12 " style="border:1px solid">
                                <table id="materyalisKU">
                                    <thead>
                                        <th>Material Name</th>
                                        <th>Size </th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Price Per Unit</th>
                                        <th>Waste%</th>
                                        <th>Calculated Price PHP</th>
                                        <th>Option</th>
                                    </thead>
                                    <tbody>
                                        <tr id="matTotal" style="border-top:1px solid;">
                                            <td class=" text-danger" colspan="6"><strong>Total Material Cost</strong></td>
                                            <td ><strong id="compMatPH" class="text-danger">0.00</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row rounded" style="border:1px solid">
                            <div class="col-sm-12">
                                <span><h3>Fabrication <input type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-outline-primary rounded" value="Add"></h3></span>
                            </div>
                            <div class="col-sm-12 " style="border:1px solid">
                                <table id="materyalisKU2">
                                    <thead>
                                        <th>Fabrication Name</th>
                                        <th>Size</th>
                                        <th>Unit</th>
                                        <th>Price per Unit</th>
                                        <th>Calculated Price PHP</th>
                                        <th>Option</th>
                                    </thead>
                                    <tbody>
                                        <tr  id="fabTotal" style="border-top:1px solid;">
                                            <td colspan="4" class=" text-danger"><strong>Total Fabrication Cost</strong></td>
                                            <td ><strong id="compFabPH" class="text-danger">0.00</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn btn-outline-danger form-control">
                                    <h4>Total Component Cost : <span id="netPHP"> 0.00</span></h4> 
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Modal for materials -->

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
                        <table width="100%" class="table">
                            <thead>
                                <th>Material Code</th>
                                <th>Material Name</th>
                                <th>Option</th>
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
<!--Modal for Fabrication -->

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Dimensions</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 ">
                        <span><input  type="text" id="byCodesssss" class="form-control"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="col-sm-12">
                        <table width="100%" class="table">
                            <thead>
                                <th>Fabrication Name</th>
                                <th>Price</th>
                                <th>Unit</th>
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
    var base_url ="<?php echo base_url();?>";
    var filter="";
    var modalctr=0;
    var modalctr2=0;
    $(document).ready(function(){
        showMatList();
        showFabList()
        $('#textCompClass').on('change',function(){
            var val = $(this).val();
            $.ajax({
                type:'GET',
                url:base_url+"ProductsV2/autoChange",
                data:{
                    'ajaxPass':val
                },
                success:function(data){
                    $("#baseUnit").html(data);
                }
            });
        });
    });
    function showMatList(){
        $.ajax({
            url: base_url+"ProductsV2/matList",
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
    $('#byCode').on('keypress', function(e){
        if(e.which == 13) {
            filter = $('#byCode').val();
            showMatList();
        }
    });
    function getMatCode(code,name,ph,unit){
        modalctr++;
        var htmlSTR = ' <tr id="'+modalctr+'"><td><input class="txtIndex form-control" type="text" value="'+modalctr+'" hidden><input class="form-control" type="text" id="textMatName'+modalctr+'" value="'+code+'" hidden>'+name+'</td><td><input type="text" class="form-control" id="textSize'+modalctr+'"></td><td><label for="" id="textUnit'+modalctr+'">'+unit+'</label></td><td><input type="text" class="form-control pilanku" id="textQty'+modalctr+'"></td><td><label for="" id="textPrice'+modalctr+'">'+ph+'</label></td><td><input type="text" class="form-control pilanku" id="textWaste'+modalctr+'"></td><td><label id="txtsubtotal'+modalctr+'">0.00</label></td><td><button class="btn btn-sm btn-danger "onclick="clearRow('+"'#"+modalctr+"'"+')">x</button></td></tr>';
        $(htmlSTR).insertBefore($('#matTotal'));
        materialcomputer();
    }
    function clearRow(identifier){
        $(identifier).remove();
        materialcomputer();
        materialcomputer2();
    }
    function showFabList(){
        $.ajax({
            url: base_url+"ProductsV2/fabList",
            type: "post",
            data: {
            'xmlFilter' : filter,
            'xmlRequest' : 'modalmatDATA2'
            },
            success: function(data){
                $('#modalMatdata2').html(data);
            }
	    });
    }
    $('#byCodesssss').on('keypress', function(e){
        if(e.which == 13) {
            filter = $('#byCodesssss').val();
            showFabList();
        }
    });
    function getFabCode(code,name,ph,unit){
        modalctr2++;
        var htmlSTR = ' <tr id="'+modalctr2+'"><td><input class="txtIndex2 form-control" type="text" value="'+modalctr2+'" hidden><input class="form-control" type="text" id="textFabName'+modalctr2+'" value="'+code+'" hidden>'+name+'</td><td><input type="text" class="form-control pilanku2" id="textFabSize'+modalctr2+'"></td><td><label for="" id="textFabUnit'+modalctr2+'">'+unit+'</label></td><td><label for="" id="textFabPrice'+modalctr2+'">'+ph+'</label></td><td><label id="txtFabsubtotal'+modalctr2+'">0.00</label></td><td><button class="btn btn-sm btn-danger "onclick="clearRow('+"'#"+modalctr2+"'"+')">x</button></td></tr>';
        $(htmlSTR).insertBefore($('#fabTotal'));
        materialcomputer2();
    }
	 $('#materyalisKU').on('keypress keyenter keyup focusin focusout blur click',".pilanku", function(){
		var subtextProd = $(this).val();
		subtextProd = subtextProd.replace(/\D/g,'');
		subtextProd = parseInt(subtextProd);
		if(subtextProd < 0 || isNaN(subtextProd)== true){
			subtextProd = 0;
		}
		$(this).val(subtextProd);
        materialcomputer();

    });
    $('#materyalisKU2').on('keypress keyenter keyup focusin focusout blur click',".pilanku2", function(){
		var subtextProd = $(this).val();
		subtextProd = subtextProd.replace(/\D/g,'');
		subtextProd = parseInt(subtextProd);
		if(subtextProd < 0 || isNaN(subtextProd)== true){
			subtextProd = 0;
		}
		$(this).val(subtextProd);
        materialcomputer2();
    });
    //Material Computation
    function materialcomputer(){
        totalmatphp =0;
        totalmatdede= 0;
        $(".txtIndex").each( function(){
        //materials
        var matcodeINDEx =  $(this).val();

            matsize = $('#textSize'+matcodeINDEx).val();
            matyQty = $('#textQty'+matcodeINDEx).val();
            matpricePHP = $('#textPrice'+matcodeINDEx).text();
            matWaste =  $('#textWaste'+matcodeINDEx).val();
            var percent = matWaste/100;
            var tots =((matyQty*matsize*matpricePHP)*percent);
            totalmatphp += ((matyQty*matsize*matpricePHP)+tots);
            
            var substitute = ((matyQty*matsize*matpricePHP)+tots);
            $('#txtsubtotal'+matcodeINDEx).text(substitute.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
           /* console.log(matyQty);
            console.log(matsize);
            console.log(matpricePHP);
            console.log(matWaste);*/
        });
            if(totalmatphp !="" || totalmatphp == null || totalmatphp>0){
                $('#compMatPH').text(totalmatphp.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }else{
                totalmatphp = 0;
                $('#compMatPH').text(totalmatphp.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }
           realtime();
    }
    //Fabrication Computation
    function materialcomputer2(){
        totalmatphp =0;
        totalmatdede= 0;
        var totalFab =0;
        $(".txtIndex2").each( function(){
        var matcodeINDEx2 =  $(this).val();
            //Fabrication
            fabSize =  $('#textFabSize'+matcodeINDEx2).val();
            fabPrice = $('#textFabPrice'+matcodeINDEx2).text();
            totalFab += (fabSize*fabPrice);
            var substitute2 =(fabSize*fabPrice);
            $('#txtFabsubtotal'+matcodeINDEx2).text(substitute2.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
        });
            if(totalFab !="" || totalFab == null || totalFab>0){
                $('#compFabPH').text(totalFab.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }else{
                totalFab = 0;
                $('#compFabPH').text(totalFab.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
            }
           realtime();
    }
    //Material and Fabrication total computation
    function realtime(){
		var totalCompPHP = parseFloat($('#compFabPH').text().replace(/[^.0-9]/g, ''));
		var totalCompDEDE = parseFloat($('#compDeCost').text().replace(/[^.0-9]/g, ''));
		var totalMatPHP =	parseFloat($('#compMatPH').text().replace(/[^.0-9]/g, ''));
		var totalMatDEDE  = parseFloat($('#compMatDE').text().replace(/[^.0-9]/g, ''));
		var tPHP = totalCompPHP + totalMatPHP;
		var tDEDE = totalCompDEDE + totalMatDEDE;
		$('#netPHP').text(tPHP.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
	}
	 $('#materyalisKU').on('keypress keyenter keyup focusin focusout blur click',".numberkupar", function(){
		var subtextProd = $(this).val();
        subtextProd = subtextProd.replace(/[^.0-9]/g, '');
        if(subtextProd < 0 || isNaN(subtextProd)== true){
            subtextProd = 0;
	    }
        console.log(subtextProd);
        $(this).val(subtextProd);
        materialcomputer();
        materialcomputer2();
    });
	 $('#materyalisKU2').on('keypress keyenter keyup focusin focusout blur click',".numberkupar", function(){
		var subtextProd = $(this).val();
        subtextProd = subtextProd.replace(/[^.0-9]/g, '');
        if(subtextProd < 0 || isNaN(subtextProd)== true){
            subtextProd = 0;
        }
	$(this).val(subtextProd);
    materialcomputer();
    materialcomputer2();
  });

  //saving Component
  $('#save').on('click',function(){
      var comCode  = $('#textCompCode').val();
      var comName = $('#textCompName').val();
      var compClass = $('#textCompClass').val();
      var comDescription = $('#textCompDesc').val();
      var comDimBasisVal = $('#textDimBasis').val();
      var comDimBasisUnit = $('#baseUnit').text();
      var total = $('#netPHP').text();
      console.log(total);
        $.ajax({
            type:'get',
            url:base_url+"ProductsV2/ajaxSavingComponent",
            data:{
                'ajaxCode':comCode,
                'ajaxName':comName,
                'ajaxClass':compClass,
                'ajaxDesc':comDescription,
                'ajaxBaseVal':comDimBasisVal,
                'ajaxBaseUnit':comDimBasisUnit,
                'ajaxPrice':total
            },
            success:function(){
                savingCompMat(comCode);
                savingFabrication(comCode);
            }
        });

      /*console.log(comCode);
      console.log(comName);
      console.log(compClass);
      console.log(comDescription);
      console.log(comDimBasisVal);
      console.log(comDimBasisUnit);*/

  });

    function savingCompMat(comCode){
        $(".txtIndex").each( function(){
            //materials
            var matcodeINDEx =  $(this).val();
            var matcodes = $('#textMatName'+matcodeINDEx).val();
            matsize = $('#textSize'+matcodeINDEx).val();
            matyQty = $('#textQty'+matcodeINDEx).val();
            matpricePHP = $('#textPrice'+matcodeINDEx).text();
            matWaste =  $('#textWaste'+matcodeINDEx).val();
            /*   console.log(matcodes);
                console.log(matsize);
                console.log(matyQty);
                console.log(matpricePHP);
                console.log(matWaste);*/
            $.ajax({
                type:'GET',
                url:base_url+"ProductsV2/ajaxSavingCompMat",
                data:{
                    'ajaxCompCode':comCode,
                    'ajaxMatCode':matcodes,
                    'ajaxMatSize':matsize,
                    'ajaxmatQty':matyQty,
                    'ajaxPrice':matpricePHP,
                    'ajaxWaste':matWaste
                },
                success:function(){
                    console.log('Success');
                }
            });
        });
    }
    function savingFabrication(comCode){
        $(".txtIndex2").each( function(){
        var matcodeINDEx2 =  $(this).val();
            //Fabrication
            fabCode = $('#textFabName'+matcodeINDEx2).val();
            fabSize =  $('#textFabSize'+matcodeINDEx2).val();
            fabPrice = $('#textFabPrice'+matcodeINDEx2).text();
            /* console.log(fabCode);
            console.log(fabSize);
            console.log(comCode);*/
            $.ajax({
                type:'GET',
                url:base_url+"ProductsV2/ajaxSavingFabrication",
                data:{
                    'ajaxFabName':fabCode,
                    'ajaxSize':fabSize,
                    'ajaxCompCode':comCode
                },
                success:function(){

                }
            });

            
        });
    }
</script>