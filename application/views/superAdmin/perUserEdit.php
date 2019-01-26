<style >
	.picpic{
		height: auto !important;
		width: 80% !important;
		cursor: pointer;
	}
	.csIMG2{
		width: 80%;
		border-radius: 1%;
		display: block;
    	margin: 0 auto;
		
		height: auto;
	}
</style>
<script src="<?php echo base_url();?>assets/cropper/js/jquery.Jcrop.min.js"></script>
<section class="dashboard-counts section-padding" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header d-flex align-items-center" >
     					<h2 class=" display display">User Form</h2>
     				</div>
     				<div class="card-body">
							<label class="btn btn-sm btn-warning" for="img"><strong>Change Image</strong></label>
							<input type="file" id ="img" name="file" onchange="readURL(this);"style="visibility:hidden;" accept="image/*" capture/>
							<div style="margin:auto; " align="center">
								<?php
									if($this->session->has_userdata('userSession')){
										$imgID = 1;
										$userprofile="";
										$userprofile = $this->session->userdata['userSession']['user_profpic'];
										if($userprofile!="" && file_exists($userprofile)){
											echo '<img src="'.base_url().$userprofile.'?ts='.date("h.i.sa").'" 
											onclick="gitGud('."'".$userprofile."',".$imgID."".')" alt="person" class="img-fluid picpic" id="listedIMAGE1" >';
										}else{
											echo '<img src="'.base_url().'assets/img/sample.jpg?ts='.date("h.i.sa").'" alt="person" class="img-fluid picpic" id="listedIMAGE1" style="height:auto; width:555px;">';
										}
									}
									else{
										redirect(base_url() . 'Welcome/logIn');
									}
								?>
							</div>
							<br>
							<div class="">
							<hr>
								<p>Edit Record </p>
							</div> 
							<div class="form-group row">
								<div class="col-sm-4"></div>
									<div class="table-responsive-sm"></div>
										<table cellpadding="0" cellspacing="0" class="table" style="text-align: center;">
											<?php
												if(!empty($editData)){
													foreach ($editData as $key => $value) {
											?>
											<tr>
												<td width="110">
													<strong>First Name</strong>
												</td>
												<td>
													<input type="text" placeholder="First Name" class="form-control " id="txtFirstName" value="<?=$value->userFirstName?>">
												</td>
											</tr>
											<tr>
												<td>
													<strong>Last Name</strong>
												</td>
												<td>
													<input type="text" placeholder="Last Name" class="form-control " id="txtLastName" value="<?=$value->userLastName?>">
												</td>
											</tr>
											<tr>
												<td>
													<strong>User Position</strong>
												</td>
												<td>
													<input type="text" placeholder="Position" class="form-control " id="txtPosition" value="<?=$value->userJobDesc?>">
												</td>
											</tr>
											<tr>
												<td>
													<strong>Username</strong>
												</td>
												<td>
													<input type="text" placeholder="Username" class="form-control " id="txtUsername" value="<?=$value->userName?>" readonly >
												</td>
											</tr>
												<?php  }} $group= $value->userGroupID;?>
											<tr>
												<td colspan="2">
													<button class="btn btn-success rounded" id="save">Save</button>
													<a href="<?php echo base_url('Welcome/index');?>">	<button class="btn btn-danger rounded">Cancel</button></a>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
     				</div>
				</div>
			</div>
		</div>
	</div>
	<div hidden>
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#imgModal">Open Modal</button>
</div>
</section>

<!-- Modal -->
<div id="imgModal" class="modal fade" role="dialog" >
  	<div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
        	<h4 class="modal-title">User Image</h4>
			
      	</div>
      	<div class="modal-body" id="getThatdime" align="center">
		  <button type="button" name="button" class="btn btn-info btn-sm " id="protato" onclick="potato_rotato();">Rotate</button>
      <button type="button" name="button" class="btn btn-info btn-sm " id="cropato" onclick="thisCrop();">Crop</button><br><br>
        <div id="reres"></div>
        	<p style="font-size: 25px;" id="msgBox" align="center"></p>
        <div id="loadingGif" align="center" hidden>
        	<img style="width: 50%; height: 10px;" src="<?php echo base_url();?>assets/tesseract.js-master/loading.gif">
        </div>
    	</div>
      		<div class="modal-footer" id="closeBTN" >
        		<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      		</div>
    	</div>
  	</div>
</div>
<script>
	var userFirstName = "";
	var userLastName = "";
	var userPosition = "";
	var userName = "";
	var userEmail = "";
	var base_url ="<?php echo base_url();?>"
	var strCtr=0;
  	var userID =<?php echo $userID = $this->session->userdata['userSession']['user_ID'] ?>;
	$('#save').on('click',function(){
		userFirstName = $('#txtFirstName').val();
		userLastName = $('#txtLastName').val();
		userJobDesc = $('#txtPosition').val();
		userName = $('#txtUsername').val();
		userEmail =  $('#txtEmail').val();
		var confirmSave = confirm("Are you sure you want to save this User?");
		if(confirmSave == true){
			perUserEdit(userName,userLastName,userFirstName,userJobDesc,userEmail);
		}
		else{
			location.reload();
		}
	});
</script>
<script type="text/javascript">
	var imgPath="";
	var fakeURL = "";
	var name ="";
	var gitSet="";
var deviceMo;

  var rrrtter =0;
  var angle = 0;
  var ctrPatatas =0;
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

	function readURL(input) {
		if (input.files && input.files[0]) {

			getOrientation(input.files[0], function(orientation) {
			
			rrrtter= orientation;
			
			if(deviceMo == 'ios'){
				if(orientation == 3){
					angle = 180;
					ctrPatatas =0;
				}else if(orientation == 6){
					angle = 0;
					ctrPatatas =1;
				}
				else if(orientation == 8){
					angle = 90;
					ctrPatatas =1;
				}

			}else{
				if(orientation == 3){
				angle = 180;
				ctrPatatas =0;
				}else if(orientation == 6){
					angle = 90;
					ctrPatatas =1;
				}
				else if(orientation == 8){
					angle = -90;
					ctrPatatas =1;
				}
			}
			
		console.log(rrrtter);
	
		gitSet = base_url+"Admin/uploadimg/1/"+userID+"/"+rrrtter+'/'+deviceMo;
		uploadFile();
		
		});

			var reader = new FileReader();
			reader.onload = function (e) {
				$('#imgPicUser')
				.attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
			fakeURL = $('#img').val();
			fakeURL = fakeURL.split("\\").pop();
			fakeURL = ""+fakeURL;
			
		}
	}
	function uploadFile(){
		$('#cropato').hide();
    	$('#protato').hide();
		var input = document.getElementById("img");
		file = input.files[0];
			if(file != undefined){
				formData= new FormData();
				if(!!file.type.match(/image.*/)){
					formData.append("image", file);
					gitSet = base_url+"Admin/uploadimg/1/"+userID+"/"+rrrtter+'/'+deviceMo;
					gitSet = gitSet.replace(/ /g,'');
					$.ajax({
						url: gitSet,
						type: "post",
						data: formData,
						processData: false,
						contentType: false,
						beforeSend: function() {
						$('#loadingGif').show();
						$('#msgBox').text('Uploading Image... Do not Close the webpage or Shut down the Device.');
						$('#imgModal').modal('toggle');
					},
					success: function(data){
						$('#imgModal').modal('toggle');
						bool_mode="0";
						window.location.replace('<?php echo base_url();?>Welcome/logout');
						//var xText =data;
						$('#closeBTN').trigger('click');
						$('#loadingGif').hide();
						//$('#msgBox').html(xText);
						$('#closeBTN').show();
					},error: function(){
						$('#loadingGif').hide();
						$('#msgBox').text("Error File not supported.");
						$('#closeBTN').show();
					}
				});
			}else{
				$('#imgModal').modal('toggle');
				$('#loadingGif').hide();
				$('#msgBox').text('This is not an image!');
				$('#closeBTN').show();
			}
		}else{
		$('#imgModal').modal('toggle');
			$('#loadingGif').hide();
			$('#msgBox').text('No image top upload!');
			$('#closeBTN').show();
		}
	}
	function perUserEdit(userName,userLastName,userFirstName,userJobDesc,userEmail){
	$.ajax({
		type:'get',
		url :base_url+"Admin/ajaxPerUserEdit/"+userID,
		data:{
			'ajaxUserName': userName,
			'ajaxUserLname': userLastName,
			'ajaxUserFname': userFirstName,
			'ajaxUserJob' : userJobDesc,
			'ajaxEmail' : userEmail
		},
		success: function(data){
			bool_mode="0";
			window.location.replace('<?php echo base_url();?>Welcome/logout');
		},
		complete: function(data){
			bool_mode="0";
			window.location.replace('<?php echo base_url();?>Welcome/logout');
		},
		error:function(){
			alert("Error");
		}
	});
}











function showCoords(c)
				{
					 // variables can be accessed here as
     			 // c.x, c.y, c.x2, c.y2, c.w, c.h
						// console.log(c.x);
						// console.log(c.x2);
						// console.log(c.y);
						// console.log(c.y2);
						// console.log(c.w);
						// console.log(c.h);
						widthCropper = c.x ;
						heightCropper = c.y ;
						sourceX = c.x2;
						sourceY = c.y2;
						hhhh = c.h;
						wwww = c.w;

						 console.log ("New h : " + hhhh);
						 console.log ("New w : "+ wwww);
						// heightCropper = originHeight - heightCropper;
						// widthCropper = originWidth-widthCropper;
						console.log("New y : "+ heightCropper);
						console.log("New x : "+ widthCropper);

						console.log("New y2 : "+ sourceY);
						console.log("New x2 : "+ sourceX);
        };


$( document ).ready(function() {
	deviceMo = "android";
   // Windows Phone must come first because its UA also contains "Android"
if (/windows phone/i.test(userAgent)) {
 // alert ("Windows Phone");
 deviceMo = "android";
}

if (/android/i.test(userAgent)) {
 // alert ("Android");
 deviceMo = "android";
}

// iOS detection from: http://stackoverflow.com/a/9039885/177710
if (/iPad|iPhone|Mac|iPod/.test(userAgent) && !window.MSStream) {
  //alert ("iOS");
  deviceMo = "ios";
}
});







function getOrientation(file, callback) {
    var reader = new FileReader();
    reader.onload = function(e) {

        var view = new DataView(e.target.result);
        if (view.getUint16(0, false) != 0xFFD8)
        {
            return callback(-2);
        }
        var length = view.byteLength, offset = 2;
        while (offset < length) 
        {
            if (view.getUint16(offset+2, false) <= 8) return callback(-1);
            var marker = view.getUint16(offset, false);
            offset += 2;
            if (marker == 0xFFE1) 
            {
                if (view.getUint32(offset += 2, false) != 0x45786966) 
                {
                    return callback(-1);
                }

                var little = view.getUint16(offset += 6, false) == 0x4949;
                offset += view.getUint32(offset + 4, little);
                var tags = view.getUint16(offset, little);
                offset += 2;
                for (var i = 0; i < tags; i++)
                {
                    if (view.getUint16(offset + (i * 12), little) == 0x0112)
                    {
                        return callback(view.getUint16(offset + (i * 12) + 8, little));
                    }
                }
            }
            else if ((marker & 0xFF00) != 0xFF00)
            {
                break;
            }
            else
            { 
                offset += view.getUint16(offset, false);
            }
        }
        return callback(-1);
    };
    reader.readAsArrayBuffer(file);
}













var imgGitter=0;
  var originWidth ;
  var originHeight ;
  var img_op_flag = "";
  var thisImage_gud;
  var thisImage_path;
  var getGitter;
  function gitGud(path,gitter){
    
    getGitter = gitter;

    thisImage_gud = $('#listedIMAGE'+gitter);
    thisImage_path = path;
    console.log(thisImage_gud.attr('src') + '\n' + path);
    var d = new Date();
    var n = d.getTime();
   
    imgGitter = gitter;
    imgPath = path;
    var xText ='<img src="<?php echo base_url();?>'+path+'?ts='+n+'" class="csIMG2" id="vmImage">';
    

   img_op_flag ="";
    
  
    $('#loadingGif').hide();
    $('#msgBox').html(xText);
    $('#closeBTN').show();
    $('#imgModal').modal('show');
    var tog=  $('#imgModal').css('display');
    if(tog =='none'){
      setTimeout(() => {
				$('#cropato').show();
        $('#protato').show();
        
        angle = 0;
        originWidth  = $('#vmImage').prop("naturalWidth");
        originHeight  = $('#vmImage').prop("naturalHeight");
      
        if(originWidth > originHeight){
          classifier = 'pr';
          ctrPatatas = 0;
        
         
        }else{
          classifier = 'lp';
          ctrPatatas = 1 ;
         
          
        }	
      
      }, 555);
    }else{
      setTimeout(() => {
				$('#cropato').show();
        $('#protato').show();
        angle = 0;
        //originWidth  = $('#vmImage').prop("naturalWidth");
        //originHeight  = $('#vmImage').prop("naturalHeight");
         if(originWidth > originHeight){
          classifier = 'pr';
          ctrPatatas = 0;
        
        }else{
          classifier = 'lp';
          ctrPatatas = 1 ;
      
          
        }	
      
      }, 222);

    }
    
  
  }




var classifier ;
var adder_euls;
var gag9;
var angleForcloud;
  function myCaser(){
    gag9 = base_url+'Contacts/';
    switch(img_op_flag){
      case 'cropato' :
        adder_euls ='cropato';
        gag9+= adder_euls;
        crop_part2();
      break;
      case 'protato' :
        adder_euls ='protato';
        gag9+= adder_euls;
        rotate_part2();
       
      break;
      default:
      break;  
    }

  
    
   // alert(gag9);

  }

  function rotate_part2(){
    $('#reres').hide();
    $('#cropato').hide();
          $('#protato').hide();
    $.ajax({
      url: gag9,
      type: "post",
      data: {
			'AJurl' : thisImage_path,
      'AJangle' : angleForcloud
			},
      beforeSend: function(data2) {
        $('.disappear').remove();
        $('#msgBox').html('');
            $('#loadingGif').show();
            $('#msgBox').text('Rotating Image... Do not Close the webpage or Shut down the Device.');
        $('#closeBTN').hide();
	    },
      success: function(data2){
        var d2 = new Date();
        var n2 = d2.getTime();
        console.log(thisImage_path);
        var xText ='Image successfully rotated. <hr><br><img src="<?php echo base_url();?>'+thisImage_path+'?ts='+n2+'" class="csIMG2" id="vmImage">';
        thisImage_gud.attr('src','<?php echo base_url();?>'+thisImage_path+'?ts='+n2);
        $('#msgBox').html('');
        $('#msgBox').hide();
        
            $('#loadingGif').hide();
            $('#msgBox').html(xText);
          $('#msgBox').show();
          $('#closeBTN').show();
          $('.disappear').remove();
          
		   			
        },error: function(){
        	alert("error");
          $('#cropato').hide();
          $('#protato').hide();
        }
      });
  }
  function crop_part2(){
    $('#reres').hide();
    $('#cropato').hide();
          $('#protato').hide();
    $.ajax({
      url: gag9,
      type: "post",
      data: {
			'AJurl' : thisImage_path,
      'AJwcropper' : widthCropper,
      'AJhcropper' : heightCropper,
			'AJhhhh' : hhhh,
      'AJwwww' : wwww,
      'AJsx' : sourceX,
      'AJsy' : sourceY
			},
      beforeSend: function(data2) {
        $('.disappear').remove();
        $('#msgBox').html('');
            $('#loadingGif').show();
            $('#msgBox').text('Cropping Image... Do not Close the webpage or Shut down the Device.');
        $('#closeBTN').hide();
	    },
      success: function(data2){
       
        var d2 = new Date();
        var n2 = d2.getTime();
        console.log(thisImage_path);
        var xText ='Image successfully cropped. <hr><br><img src="<?php echo base_url();?>'+thisImage_path+'?ts='+n2+'" class="csIMG2" id="vmImage">';
        thisImage_gud.attr('src','<?php echo base_url();?>'+thisImage_path+'?ts='+n2);
        $('#msgBox').html('');
        $('#msgBox').hide();
       
        
            $('#loadingGif').hide();
            $('#msgBox').html(xText);
          $('#msgBox').show();
          $('#closeBTN').show();
          $('.disappear').remove();
		   			
        },error: function(){
        	alert("error");
          $('#cropato').hide();
          $('#protato').hide();
        }
      });
  }
function thisCrop(){
	originWidth  = $('#vmImage').prop("naturalWidth");
        originHeight  = $('#vmImage').prop("naturalHeight");
  
  $('#reres').show();
  $('#reres').html('<button id="caser" onclick="myCaser();" class="btn btn-sm btn-primary">Reupload Image</button>&nbsp;<button  onclick="gitGud(thisImage_path,getGitter);$(\'#reres\').html(\'\');" class="btn btn-sm btn-danger">Cancel</button><hR>');
  //alert(originWidth,originHeight);
 
  img_op_flag = "cropato";
  $('#caser').show();
  $('#protato').hide();
  $('#vmImage').Jcrop({
													onSelect: showCoords,
													onChange: showCoords,
													bgColor: 'white',
													boxWidth: $('#getThatdime').width()*.9,
    												boxHeight: $('#getThatdime').height()*.9,
													setSelect:   [ originWidth/2,  originHeight/2, 1, 1 ],
													trueSize: [ originWidth, originHeight ]
												}
											);
}
  var widthCropper;
  var heightCropper;
  var sourceX;
  var sourceY;
  var hhhh;
  var wwww;

  $('#imgModal').on('hidden.bs.modal', function () {
    $('#cropato').show();
    $('#protato').show();
  });
        
function potato_rotato() {
  $('#reres').show();
  $('#reres').html('<button id="caser" onclick="myCaser();" class="btn btn-sm btn-primary">Reupload Image</button>&nbsp;<button  onclick="gitGud(thisImage_path,getGitter);$(\'#reres\').html(\'\');" class="btn btn-sm btn-danger">Cancel</button><hR>');
  img_op_flag = "protato";
  $('#caser').show();
  $('#cropato').hide();
	var i_H = $('#vmImage').height();
	var i_W = $('#vmImage').width();

  ctrPatatas++;
 

	//console.log(classifier);
  var img = $('.csIMG2');
  angle += 90;

  
  //alert(angleForcloud);
  //gitSet = base_url+"Ocr/uploadimg/1/"+name+"/"+widthCropper+"/"+heightCropper+"/"+hhhh+"/"+wwww+"/"+sourceX+"/"+sourceY+'/'+angleForcloud+'/'+rrrtter;
	
									
	 
  	 $('#vmImage').css('transform','rotate(' + angle + 'deg)');
	
     if(deviceMo == 'ios'){
	


	switch (angle){
		case 90 :
		angleForcloud = -90;
		break;
		case 180 :
		angleForcloud = 180;
		break;
		case 270: 
		angleForcloud = 90;
		break;
		case 360: 
		angleForcloud = 0;
		angle = 0;
		break;
	}
	//alert(angleForcloud);
  }else{

	switch (angle){
		case 90 :
		angleForcloud = -90;
		break;
		case 180 :
		angleForcloud = 180;
		break;
		case 270: 
		angleForcloud = 90;
		break;
		case 360: 
		angleForcloud = 0;
		angle = 0;
		break;
	}
  }
	

		if(ctrPatatas % 2 == 1){
			$('#vmImage').css('margin-top',i_W*.5+'px');
      $('#vmImage').css('margin-bottom',i_W*.25+'px');
      $('#vmImage').css('width', $('#getThatdime').width() * .7 );
      $('#vmImage').css('height', $('#getThatdime').height() * .7 );
		}else{
			$('#vmImage').css('margin-top',i_W/3+'px');
      $('#vmImage').css('margin-bottom','55px');
      $('#vmImage').css('width', $('#getThatdime').width() * .5 );
      $('#vmImage').css('height', $('#getThatdime').height() * .5 );
    
			
		}

      console.log(ctrPatatas + ' : angle ' + angle +' | true a : '+angleForcloud);
	

}




  $('#imgModal').on('hidden.bs.modal', function () {
    $('#cropato').show();
    $('#protato').show();
    $('#reres').hide();
  });

</script>
                                                            