<div class="" style="background-color: #252525; letter-spacing: 2px;">
	<strong class="text-default" style="margin-left: 1%; color: #fefefefe;">Products</strong>
</div>
<div style="background-color: #252525;">
	<div class="container-fluid">
		<a href="<?php echo base_url();?>Products" class="btn btn-default" >Dashboard</a>
		<a href="<?php echo base_url();?>Products/barriers" class="btn btn-default">Barrier System</a>
		<a href="<?php echo base_url();?>Products/components" class="btn btn-default" style="background-color:rgb(244, 247, 250);">Components</a>
		<a href="<?php echo base_url();?>Products/materials" class="btn btn-default" >Materials</a>
	</div>
</div>

<br>
<div class="container col-lg-11 bg-default form-control">
	<a href="<?php echo base_url();?>Products/components" class="btn btn-sm btn-primary">Component List</a> 
	<h2>Component Details </h2>
	<br>	
	<div class="row" style="margin: auto;">
		<div class="col-lg-1"></div>
		<div class="col-lg-3">
			<label>Component Code </label>
			<input class="form-control" type="text" id="txtCompcode">
		</div>
		<div class="col-lg-2">
			<label> Class </label>
			<select class="form-control" id="txtCompclass">
				<?php foreach ($classdd as $key => $value) {echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';}?>
			</select>
	
		</div>
		<div class="col-lg-1">
			<label> Width </label>
			<input class="form-control ints" type="text" id="txtCompwidth" value="0">
		</div>
		<div class="col-lg-1">
			<label> Unit </label>
			<input class="form-control ints" type="text" id="txtCompwidthUnit" value="">
		</div>
		<div class="col-lg-1">
			<label> Height </label>
			<input class="form-control ints" type="text" id="txtCompheight" value="0">
		</div>
		<div class="col-lg-1">
			<label> Unit </label>
			<input class="form-control ints" type="text" id="txtCompheightUnit" value="">
		</div>
		<div class="col-lg-2">
			
		</div>
		<div class="col-lg-1">
			
		</div>
		
		<div class="col-lg-5">
			<label>Component Description</label>
			<textarea class="form-control ints" type="text" id="txtCompname" value="" ></textarea>
		</div>
		<div class="col-lg-2">
			<label>DE Cost </label>
			<input class="form-control ints" type="text" id="txtDecost" value="">
		</div>

	</div>

	<br>
	
	<br>
	<div class="col-lg-9" style="margin:auto;">
		<h3>Material List <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#listofmat">Add</button></h3>
		<table class="table table-bordered" id="materyalisKU">
			<thead style="text-align: center;">
			<th>Material Name</th>
				<th>Material Size</th>
				<th>Unit</th>
				<th>Material Quantity</th>
				<th>Ph Cost per Unit * Qty</th>
				<th>Total PH COST</th>
				<th><span class="fa fa-gear"></span></th>
			</thead>
			<tbody id="compMatList">
					<tr class="paper text-danger" id="matTotal">
								<td colspan="5"><strong>Total Cost</strong></td>
								<td ><span id="compMatPH">0</span></td>
								<td></td>
					</tr>
			</tbody>
		</table>

		<h2>Production Costs
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#listedModal">Add</button>
    </h2>
		<table class="table table-bordered" id="dinanMeyni">
			<thead style="text-align: center;">
					<th>Process</th>
					<th>Total Size</th>
					<th>Unit / Basis </th>
					<th>Ph Cost per unit</th>
					<th>Total PH Cost</th>
					<th><span class="fa fa-gear"></span></th>
			</thead>
			<tbody>
					

				<tr id="beforeME" class="paper text-danger">
					<td colspan="4"><strong>Total Cost</strong></td>
					<td><label class="" id="totalPHCOST" style="word-wrap: break-word">0</label></td>
					<td></td>
				</tr>
			</tbody>
		</table>


		
		

	</div>
	<h2>Component Cost</h2>
	<div class="col-lg-9 text-danger paper form-control" style="margin:auto;" align="right">
					<strong>Total Component PH COST : <span id="netPHP"></span></strong><br>	
	</div>
		<br>
	<div align="right" class="modal-footer">
		<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">SAVE</button>
	</div>
</div>





<!-- Modal update -->
<div id="listofmat" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Material Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="text-align: center;">
      	
      	<label>Search by Material Code 
      	<div style="background-color: #666; border-radius: 2px; padding: 5px;">
      		<input  type="text" id="byCode"><i class="fa fa-search"></i> 
      	</div> 
      	</label>
      
      	<table class="table table-bordered">
			<thead style="text-align: center;">
				<th>Material Code</th>
				<th>Material name</th>
				<th><span class="fa fa-gear"></span></th>
			</thead>
			<tbody id="modalMatdata">
				
			</tbody>
		</table>
  		
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
      </div>
    </div>

  </div>

 
</div>


  <!-- Modal fab list-->
  <div class="modal fade" id="listedModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Fabrication / Production   </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
              <thead>
                  <th>Process</th>
                  <th>Price per Unit</th>
                  <th>Fabricator</th>
                  <th>Option</th>
              </thead>
              <tbody>
              <?php 
                if(!empty($fabList)){
                   foreach($fabList as $key => $value){
                        echo'<tr>';
                            echo '<td>'.$value->fabProcess.'</td>';
                            echo '<td>'.$value->fabPriceper.' per '.$value->fabBasis.'</td>';
                            echo '<td>'.$value->fabFabricator.'</td>';
                            echo '<td><button class="btn btn-sm paper " data-dismiss="modal"
                            onclick="penetrating_Critical('.$value->fabID.",'".$value->fabProcess."','".$value->fabBasis."',".$value->fabPriceper.')">+</button></td>';
                        echo'</tr>';
                   }
                }
              ?>
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<!-- Modal delete -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Confirm Action</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p id="msgBox">Are you sure you want to save this data?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="getComps()">OK</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">
var req="";
var base_url ="<?php echo base_url();?>";
var filter="";
var req;
var compcode;
var compclass;
var compwidth;
var compheight;
var matcode;
var matsize;
var matunit;
var matqty;
var modalctr=0;
var req='';

$( document ).ready(function() {
   compmatdata();
});
function compmatdata(){
	$.ajax({
	    url: base_url+"Products/materialsxml",
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
        compmatdata();
    }
});

$('.ints').on('focusout', function(){
	if($(this).val()==''){
		$(this).val('0');
	}
	
});
var compname = "";
var compDEDEcost = 0;
function getComps(){
	compcode =  $('#txtCompcode').val();
	compclass = $('#txtCompclass').val();
	compwidth =  $('#txtCompwidth').val();
	compwidthUnit =  $('#txtCompwidthUnit').val();
	compheight =  $('#txtCompheight').val();
	compheightUnit =  $('#txtCompheightUnit').val();
	compname = $('#txtCompname').val();
	compDEDEcost =  $('#txtDecost').val();
	
	req='insertComp';
	console.log(compcode+"\n"+compclass+"\n"+compwidth+"\n"+compheight+"\n");
	$.ajax({
	    url: base_url+"Products/compxml",
	    type: "post",
	    data: {
		'xmlCompcode' : compcode,
		'xmlCompclass' : compclass,
		'xmlCompwidth' : compwidth,
		'xmlCompwidthUnit':compwidthUnit,
		'xmlCompheight' : compheight,
		'xmlCompheighthUnit':compheightUnit,
		'xmlCname' : compname,
		'xmlDE' : compDEDEcost,
		'xmlRequest' : req
		},
	    success: function(data){
	    	gethtmlvals();
	    }
	});
}

function gethtmlvals(){
	if ($(".txtIndex")[0]){
		$(".txtIndex").each( function(){
		var matcodeINDEx =  $(this).val();
		matcode = $('#txtcmCode'+matcodeINDEx).val();
		matsize = $('#txtsize'+matcodeINDEx).val();
		matunit = $('#txtunit'+matcodeINDEx).val();
		matqty = $('#txtqty'+matcodeINDEx).val();
		console.log(matcode+"\n"+matsize+"\n"+matunit+"\n"+matqty+"\n");
		//ajax
		$.ajax({
			url: base_url+"Products/compxml",
			type: "post",
			data: {
			'xmlCompmatcode' : compcode,
			'xmlCmat' : matcode,
			'xmlCmatsize' : matsize,
			'xmlCmatunit' : matunit,
			'xmlCmatqty' : matqty,
			'xmlRequest' : 'insertCompmat'
			},
			success: function(data){
				
			}
		});
		//
			$(this).remove();
			$('#txtsize'+matcode).remove();
			$('#txtunit'+matcode).remove();
			$('#txtqty'+matcode).remove();
		});
		console.log('saved'); //redir here
		weneedTHESE();
	
	} else {
		weneedTHESE();
	 
	}
}
function getMatCode(code,name,ph,de){
	modalctr++;
	
	var htmlSTR = ' <tr id="'+modalctr+'"><td><input class="txtIndex form-control" type="text" value="'+modalctr+'" hidden><input class="form-control" type="text" id="txtcmCode'+modalctr+'" value="'+code+'" hidden>'+name+'</td><td><input class="form-control numberkupar" type="text" id="txtsize'+modalctr+'" value="0"></td><td><input class="form-control" type="text" id="txtunit'+modalctr+'" value=""></td><td><input class="form-control pilanku" type="text" id="txtqty'+modalctr+'" value="0"></td><td><input class="form-control" type="text" id="txtphcost'+modalctr+'" value="'+ph+'" hidden>'+ph.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</td><td><label id="txtsubtotal'+modalctr+'">0.00</label></td><td><button class="btn btn-sm btn-danger "onclick="clearRow('+"'#"+modalctr+"'"+')">x</button></td></tr>';
	//$('#compMatList').append(htmlSTR);
	$(htmlSTR).insertBefore($('#matTotal'));
}

function clearRow(identifier){
	$(identifier).remove();
	materialcomputer();
}
</script>




<script>
    
    var critical = 0;
		var criticalHit = 0;
    var compat = $('#compMatPH').text();
    var dede = $('#compMatDE').text();
		var matpricePHP = 0;
		var matpriceDEDE = 0;
		var totalmatphp =0;
		var totalmatdede =0;
		var matyQty=0;
    compat = parseInt(compat);
   
    $('#compMatPH').text(compat.toLocaleString());
    $('#compMatDE').text(compat.toLocaleString());

    function materialcomputer(){
			totalmatphp =0;
			totalmatdede= 0;
			$(".txtIndex").each( function(){
			var matcodeINDEx =  $(this).val();
			
				matsize = $('#txtsize'+matcodeINDEx).val();
				matyQty = $('#txtqty'+matcodeINDEx).val();
				matpricePHP = $('#txtphcost'+matcodeINDEx).val();
			
				totalmatphp += (matyQty*matsize*matpricePHP);
		
				var substitute =(matyQty*matsize*matpricePHP);
				$('#txtsubtotal'+matcodeINDEx).text(substitute.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
			
			});

			 if(totalmatphp !="" || totalmatphp == null || totalmatphp>0){
           
					 $('#compMatPH').text(totalmatphp.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
			 }else{
				totalmatphp = 0;
					 $('#compMatPH').text(totalmatphp.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
			 }
			 if(totalmatdede !="" || totalmatdede == null || totalmatdede>0){
           
					 $('#compMatDE').text(totalmatdede.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
			 }else{
				totalmatdede = 0;
					 $('#compMatDE').text(totalmatdede.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
			 }
			 realtime();
			
		}
		function weneedTHESE(){
			var ttottt=0.
			var aajajajaj = 0;
			if ($(".txtIndex")[0]){
				$('.criticalID').each(function(){
					ttottt++;
						var critID = $(this).val();
						var valueC = compcode;
						var valueM = $('#critTotal'+critID).val();
						$.ajax({
							url: base_url+"Products/fabXml",
							type: "post",
							data: {
							'fabID' : critID,
							'compCode' : valueC,
							'valueMultiplier' : valueM,
							'xmlRequest' : 'init'
							},
							success: function(data){
								aajajajaj++;
								if(aajajajaj==ttottt){
									window.location.replace('<?php echo base_url();?>Products/components_edit/'+compcode);
								}
							}
						});
				
				});
			}else{
				window.location.replace('<?php echo base_url();?>Products/components_edit/'+compcode);
			}
			
			
		}
    function gegege(){
			criticalHit = 0;
        $('.criticalID').each(function(){
					
            var critID = $(this).val();
						
            var valueC = $('#critTotal'+critID).val();
            var valueM = $('#critMutiplier'+critID).val();
            if( (valueC !="" || valueC == null) && (valueM !="" || valueM == null)){
							criticalHit += (valueC*valueM);
            }

						var ppSubs = 0;
						
						ppSubs = valueC * valueM;
						
						$('#subProdcost'+critID).text(ppSubs.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
					
           
            
        });
        if(criticalHit !="" || criticalHit == null || criticalHit>0){
           
            $('#totalPHCOST').text( criticalHit.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}) );
        }else{
					criticalHit = 0;
            $('#totalPHCOST').text(criticalHit.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
        }
				realtime();
    }
    function penetrating_Critical(pcKey,pcProc,pcUnit,pcPrice){
			var truef=0;
        critical++;
																$('.criticalID').each(function(){
																	
																		var critID = $(this).val();
																		if(critID == pcKey){
																			truef = 1;
																		}
																});
			if(truef==0){

															
        var gg=
        '<tr class="refreshedGone" id="fabNumber'+critical+'">'+
            '<td><input class="form-control criticalID" value="'+pcKey+'" hidden>'+
                '<input class="form-control" value="'+pcProc+'" readonly hidden><label class="">'+pcProc+'</label>'+
           ' </td>'+
            '<td>'+
                '<input class="form-control mustCrit" id="critTotal'+pcKey+'" value=""> '+
           ' </td>'+
            '<td>'+
                '<input class="form-control"  id="critMutiplier'+pcKey+'"  value="'+pcPrice+'" hidden><label class="">'+pcUnit+'</label>'+
            '</td>'+
						'<td><label>'+pcPrice.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</label>'+
            '</td>'+
						'<td><label id="subProdcost'+pcKey+'">0.00</label></td>'+
            '</td>'+
            '<td>'+
              '  <button class="btn btn-sm  btn-danger" onclick="$(fabNumber'+critical+').remove();gegege();">x</button>'+
           ' </td>'+
        '</tr>';
       // console.log(gg);
       // $("#dinanMeyni").append(gg);
			 $(gg).insertBefore($('#beforeME'));
			} 
    }

  $('#dinanMeyni').on('keypress keyenter keyup focusin focusout blur click remove',".mustCrit", function(){
		var subtextProd = $(this).val();
	
		//subtextProd = subtextProd.replace(/\D/g,'');
		subtextProd = subtextProd.replace(/[^.0-9]/g, '');
		//subtextProd = parseFloat(subtextProd);
		//parseFloat(yourString).toFixed(2)
	
		if(subtextProd < 0 || isNaN(subtextProd)== true){
			subtextProd = 0;
		}
	  //console.log(subtextProd);
		$(this).val(subtextProd);
    gegege();
  });


	 $('#materyalisKU').on('keypress keyenter keyup focusin focusout blur click',".numberkupar", function(){
		// var subtextProd = $(this).val();
		
		// subtextProd = subtextProd.replace(/\D/g,'');
		// subtextProd = parseInt(subtextProd);
		// if(subtextProd < 0 || isNaN(subtextProd)== true){
		// 	subtextProd = 0;
		// }
	  // //console.log(subtextProd);
		// $(this).val(subtextProd);
		var subtextProd = $(this).val();
	
	//subtextProd = subtextProd.replace(/\D/g,'');
	subtextProd = subtextProd.replace(/[^.0-9]/g, '');
	//subtextProd = parseFloat(subtextProd);
	//parseFloat(yourString).toFixed(2)

	if(subtextProd < 0 || isNaN(subtextProd)== true){
		subtextProd = 0;
	}
	//console.log(subtextProd);
	$(this).val(subtextProd);
    materialcomputer();
  });

	 $('#materyalisKU').on('keypress keyenter keyup focusin focusout blur click',".pilanku", function(){
		var subtextProd = $(this).val();
		
		subtextProd = subtextProd.replace(/\D/g,'');
		subtextProd = parseInt(subtextProd);
		if(subtextProd < 0 || isNaN(subtextProd)== true){
			subtextProd = 0;
		}
	  //console.log(subtextProd);
		$(this).val(subtextProd);
    materialcomputer();
  });

	function realtime(){
		var totalCompPHP = parseFloat($('#totalPHCOST').text().replace(/[^.0-9]/g, ''));
		var totalCompDEDE = parseFloat($('#compDeCost').text().replace(/[^.0-9]/g, ''));
		var totalMatPHP =	parseFloat($('#compMatPH').text().replace(/[^.0-9]/g, ''));
		var totalMatDEDE  = parseFloat($('#compMatDE').text().replace(/[^.0-9]/g, ''));

		var tPHP = totalCompPHP + totalMatPHP;
		var tDEDE = totalCompDEDE + totalMatDEDE;
		$('#netPHP').text(tPHP.toLocaleString('en-US', {minimumFractionDigits: 2,maximumFractionDigits: 2}));
		//$('#netDEDE').text(tDEDE.toLocaleString());
	}
	



</script>




