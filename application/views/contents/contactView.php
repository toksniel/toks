
<script src="https://apis.google.com/js/api.js"></script>
<script>
  function whosyourID(){ //loop html adv. serach result get ID
    allc=0;
    notc =0;
    $('#table_holderDATA2 td:nth-child(2)').each( function(){
      var uuID = $(this).text();
      uuID= uuID.replace(/[a-zA-Z]/g,'');
      uuID= uuID.replace(/[^0-9]/g,'');
      uuID = parseInt(uuID);
      console.log(uuID);
      $.ajax({
          type: "GET" ,
          url: "<?php echo base_url();?>Welcome/importToGoogle/"+uuID,
          success: function(data){
            allc++;
            executebatch(data.givenName,data.familyName,data.emailAddresses,data.phoneNumbers,data.streetAddress,data.city,data.jobDescription,data.company,data.biographies,data.urls,data.plabel,data.elabel,data.ulabel,data.id,data.mainP,data.mainE)
        }//(gName,fName,eAdd,pNum,street,city,jobDesc,company,biographies,urls,plabel,elabel,ulabel,id)
      });
      // insert AJAX fetch data with this id
      // echo data in success , ajax.success gapi function call
    });
  }
</script>
<style>
.scroll {overflow:auto; }
.scroll ul{ white-space: nowrap;}
.scroll li {display: inline-block;}
</style>
<script>
  function whosyourID(){ //loop html adv. serach result get ID
    allc=0;
    notc =0;
    $('#table_holderDATA2 td:nth-child(2)').each( function(){
      var uuID = $(this).text();
      uuID= uuID.replace(/[a-zA-Z]/g,'');
      uuID= uuID.replace(/[^0-9]/g,'');
      uuID = parseInt(uuID);
      console.log(uuID);
      $.ajax({
          type: "GET" ,
          url: "<?php echo base_url();?>Welcome/importToGoogle/"+uuID,
          success: function(data){
            allc++;
            executebatch(data.givenName,data.familyName,data.emailAddresses,data.phoneNumbers,data.streetAddress,data.city,data.jobDescription,data.company,data.biographies,data.urls,data.plabel,data.elabel,data.ulabel,data.id,data.mainP,data.mainE)
        }//(gName,fName,eAdd,pNum,street,city,jobDesc,company,biographies,urls,plabel,elabel,ulabel,id)
      });
      // insert AJAX fetch data with this id
      // echo data in success , ajax.success gapi function call
    });
  }
</script> 
<div class="" style="background-color:#212121; position:fixed; top:0;left:0; width:100%;  z-index:1000000;
    overflow-x: scroll;">
  <div class="container-fluid  disOps scroll" style="display:none; padding-top:15px; padding-bottom:22px; " id="contactlistOptions" >
    <ul>
      <li>
        <button class="btn-sm   btn-primary " onclick="actlogger();htflags='contactlist';" style="margin-top:5px; margin-right:10px;">
          Write Activity Log
        </button>
      </li>
      <li>
        <button class="btn-sm   btn-primary " onclick="santaclauserG();htflags='contactlist';" style="margin-top:5px; margin-right:10px;">
          Migrate to Google Contacts
        </button>
      </li>
      <li>
        <button class="btn-sm   btn-primary " onclick="grouper();htflags='contactlist';" style="margin-top:5px; margin-right:10px;">
          <small></small> Grouping
        </button>
      </li>
      <li>
        <button class="btn-sm   btn-primary " onclick="omit();htflags='contactlist';" style="margin-top:5px; margin-right:10px;">
          <small></small> Delete
        </button>
      </li>
    </ul>
  </div>
  <div class="container-fluid  disOps scroll" style="display:none; padding-top:22px; padding-bottom:22px;" id="dynlistOptions" >
    <ul>
      <li>
        <button class="btn-sm   btn-primary " onclick="actlogger();htflags='dynlist';" style="margin-top:5px; margin-right:10px;">
          Write Activity Log
        </button>
      </li>
      <li>
        <button class="btn-sm   btn-primary " onclick="santaclauserG();htflags='dynlist';" style="margin-top:5px; margin-right:10px;">
          Migrate to Google Contacts
        </button>
      </li>
      <li>
        <button class="btn-sm   btn-primary " onclick="grouper();htflags='dynlist';" style="margin-top:5px; margin-right:10px;">
          Grouping
        </button>
      </li>
      <li>
        <button class="btn-sm   btn-primary " onclick="omit();htflags='dynlist';" style="margin-top:5px; margin-right:10px;">
          Delete
        </button>
      </li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding" >


  <div class="container-fluid">
    <div class="card">
      <div  align="right">
      <a style="margin:12px;" href="<?php echo base_url('Welcome/loadData');?>"><button class="btn btn-primary rounded">&nbsp;+ Add&emsp;</button></a>
      </div>
      <div class="card-header d-flex align-items-center">
        <h1 class="display"><u><b>Contact List <?php echo $somedata;?></b></u>
        </h1><hr>

      </div>
      <div class="card-body">
        <div class="container row" style="z-index:-123;">
            <div class="col-lg-3 col-md-4  col-sm-5 col-xs-12" id="btnAdsearch">
              <button  class="btn btn-sm btn-info rounded" onclick="$('#filteringToggler').show(111);$('#btnAdsearch').hide(111);htflags='dynlist';" >Advanced Search</button>
            </div>
            <div class="col-lg-3 col-md-4  col-sm-4 col-xs-12">
              <select class="form-control" id="addThisPIECEtoPuzzle">
                <option value="0" selected disabled>Select Contact Type</option>
                <option value="0">All</option>
                <?php
                  $contStatus =  $this->uri->segment(3);
                  if(!empty($dropValue)){
                    foreach($dropValue as $key => $value){
                      $type = $value->dropcontent;
                      if($contStatus == $type ){
                        echo '<option value="'.$type.'" Selected>'.$type.'</option>';
                      }else{
                        echo '<option value="'.$type.'">'.$type.'</option>';
                      }

                    }
                  }
                  if($contStatus == 1 ){
                    echo ' <option value="1" selected>Ungrouped</option>';
                  }else{
                    echo '<option value="1">Ungrouped</option>';
                  }
                ?>
              </select>
            </div>
          </div>
        <br>
        <br>
        <div class="paper container-fluid" id="filteringToggler" style="z-index:1201231; margin-top:-20px; ">
          <button type="button" name="button" class="btn btn-sm btn-info closer" style="float:right;" onclick="$('#filteringToggler').hide(111);$('#btnAdsearch').show(111);">Close</button>
          <br>
            <h4 style="text-align: center;">Advanced Search</h4>
            <div class="row">
              <div class="col-lg-4">
                <label>Filter : </label>
                <br>
                <select class="form-control" id="getfilterCrit">
                  <?php
                    foreach ($dropFilter as $key => $value) {
                      echo '<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-lg-3">
                <label>Option : </label>
                <br>
                <select class="form-control" id="getFilterOption">
                  <option value="Is">Is</option>
                  <option value="Not">Not</option>
                  <option value="Has">Has</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label>Word : </label>
                <br>
                <input class="form-control" type="text" id="getFilterWord" value="">
              </div>
              <div class="col-lg-2">
                <label>&nbsp;</label>
                <br>
                <button class="btn btn-md btn-primary butones" type="button" name="button" id="myFilterBuilder">Add Filter</button>
              </div>
            </div>
            <br>
            <h5>Filter List</h5>
            <div class="container-fluid" id="filterWrapper">
            </div>
              <button class="btn btn-sm btn-info butones" id="butones" style="float:right;" >Search</button>
            <br>
            <br>
        </div>
        <br>
        <br>
        <div class="form-control">
<!-- cccccccccccccccccc  cccccc  ccc cc cc c  cc cc  c cc  c-->
          <div id="table_holderDATA1">
          <table data-limit-navigation="3" class="table table-hover  table-striped" id="listeddata" style="text-align: left; margin-top: 1%; width:100%; z-index:-99999999;">
            <thead style="background-color:#666; color:white;">
              <tr>
                <th width="5%"  class="sorting_disabled  text-left" align="left">
                  <input  class="form-control text-left" name="flagscb" id="cb1cl" type="checkbox" onclick="flagger('contactlist','cb1cl');toggle_check('contactlist');">
                </th>
                <th width="10%" class="toggle_g sorting_disabled" hidden> ID </th>
                <th width="45px"  class="sorting_disabled ">
                </th>
                <th width="20%">Contact Name </th>
                <th width="25%" class="toggle_g" >Email </th>
                <th width="15%" class="toggle_g" >Phone Number</th>
                <th class="toggle_g2" width="20%;">Position / Company </th>
                <th hidden>Tags</th>
              </tr>
            </thead>
            <tbody id="contactlist">

              <?php
              $nonono = true;
              $contactID;
              $phoneCont;
                if(!empty($arrayData)){
                  $contactIDprev=0;
                foreach ($arrayData as $key => $value) {

                  $stringer = 'CT'.sprintf("%04d",$value->contUID) .'';
                  $stringer = str_replace(' ', '', $stringer);
                  $contactID = $value->contUID;
                  $ururur="";
                  $urlqwe = "";
                  $s = $value->contUrl;
                  $date = date(".m.d.y.");
                  $time = date("h.i.s.a.");
                  $g = 0;
                  if($s != "" && file_exists($s) ){
                    $urlqwe = base_url().$s.'?ts=a'.$date.$time;
                    $ururur= '<img src="'.base_url().$s.'?ts=a'.$date.$time.'" id="listedIMAGE'.$g.'" class="img-fluid rounded-circle mCS_img_loaded " style="width:40px; height:40px;"   >';
                  }else{
                    $ururur= '<img  src="'.base_url().'assets/img/nodp.png" id="listedIMAGE'.$g.'" class="img-fluid rounded-circle mCS_img_loaded   " style="width:40px; height:40px;"  >';
                    $urlqwe = base_url().$s.'assets/img/nodp.png';
                  }

                  $group_icon = "";
                  if(!empty($contactGroup)){
                    $group_icon = "";
                    $nonoGcon = true;
                    $gtcont = 0;
                    foreach ($contactGroup as $key412 => $valueGt) {

                      $contactGcon = $valueGt->contactID;

                      if($contactID == $contactGcon && $nonoGcon == true){
                         $group_icon = '<i class=" fas fa-users"></i>';
                        $nono33 = false;
                        $gtcont++;
                      }
                    }
                    $nonoGcon = false;
                    if($nonoGcon == false && $gtcont ==0){
                      $group_icon =' <i class=" fas fa-user"></i> ';


                    }
                  }
                  

                  echo '<tr onclick="htflags=\'contactlist\';"  >';
                  echo '<td ><label class="container">


                  <input  type="checkbox"  name="contactlistCB" id="clCB'.$value->contUID.'"
                  class=" contactlistCB " value="'.$value->contUID.'" onclick="toggle_check(\'contactlist\');">
                  <BR>&nbsp;'.$group_icon.'
                  </label>
                   </td>';
                  echo '<td hidden onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" >CT'. sprintf("%04d",$value->contUID) .'</td>';
                  echo '<td >'.$ururur.'</td>';
                  echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-order="' .$value->contPrefix.' '. $value->contFirstName .' '.$value->contMiddleName. ' ' .$value->contLastName.' ' .$value->contSuffix.'" data-target="#modalContact">
                    '  .$value->contPrefix.' '. $value->contFirstName .' '.$value->contMiddleName. ' ' .$value->contLastName.' <br>' .$value->contSuffix.'
                     </td>';

                    if($contactID != $contactIDprev){
                      if(!empty($contMail)){
                        $nonono1 = true;
                        $mail  = 0;
                        foreach ($contMail as $key3 => $value3) {
                          $emailCunt = $value3->emailContID;

                          if($contactID == $emailCunt && $nonono1 == true){
                            echo '<td class="toggle_g" onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact">' .$value3->emailAddress.' </td>';
                            $nonono1 = false;
                            $mail++;
                          }else{
                            //echo '<td></td>';
                          }
                        }
                        $nonono1= false;
                        if($nonono1 == false && $mail==0){
                          echo '<td  class="toggle_g" onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact"></td>';
                        }
                      }
                      if(!empty($contPhones)){
                        $nonono2 = true;
                        $phone = 0;
                        foreach ($contPhones as $key2 => $value2) {
                          $phoneCont = $value2->phoneContID;

                          if($contactID == $phoneCont && $nonono2 == true){
                            echo '<td class="toggle_g"  onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact">' . $value2->phoneCode .' '.$value2->phoneNumber.'</td>';
                            $nonono2 = false;
                            $phone ++;
                          }else{
                            //echo '<td></td>';
                          }
                        }
                        $nonono2 = false;
                        if($nonono2 == false && $phone == 0){
                          echo '<td class="toggle_g" onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact"></td>';
                        }
                      }
                      if(!empty($contComp)){
                        $nono33 = true;
                        $comp = 0;
                        foreach ($contComp as $key4 => $value4) {
                          $compContact = $value4->contUID;

                          if($contactID == $compContact && $nono33 == true){
                            echo '<td class="toggle_g2" data-order="'.$value4->compName.'" onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact">' . $value4->contcompPosition.' <br><i><small> '.$value4->compName.'</small></i></td>';
                            $nono33 = false;
                            $comp++;
                          }else{

                            //echo '<td></td>';

                          }
                        }
                        $nono33 = false;
                        if($nono33 == false && $comp ==0){
                          echo '<td class="toggle_g2" data-order="" onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact"></td>';
                        }
                      }

                      if(!empty($contactTags)){
                        $nono35 = true;
                        $tags = 0;
                        foreach($contactTags as $key55 => $value55){
                          $tagContact = $value55->tagContID;

                          if($contactID == $tagContact && $nono35==true){
                            if($tags == 0){
                              echo '<td  hidden class="bitags">';
                            }
                            echo ' '.$value55->tagCloudDesc.' ';
                            $nono35 = true;
                            $tags++;
                          }else{

                          }
                        }
                        echo '</td>';
                        $nono35 = false;
                        if($nono35 == false && $tags ==0){
                          echo '<td hidden class="bitags"></td>';
                        }
                      }
                    }
                    $contactIDprev = $value->contUID;
                    // echo '<td>' .$value->emailAddress.' </td>';
                    // echo '<td>' . $value->phoneCode .' '.$value->phoneNumber.' </td>';
                    // echo '<td>' . $value->contcompPosition .', '.$value->compName.' </td>';
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <div id="table_holderDATA2" >
        </div>
        <br>
      </div>
    </div>
<script src="https://apis.google.com/js/api.js"></script>
<script>
  bool_mode="0";
  var col;
  var colname;
  var opt;
  var keyword;
  var filtCtr=0;
  var keyIndex;
  var qString="";
  var key = "";
	var sprinter="";
  $('#getFilterWord').keypress(function (e) {
   var key = e.which;
   $(this).val().replace(/[^a-zA-Z0-9 ]/g,'')

    if(key == 13){
      $(this).val(  $(this).val().replace(/[^a-zA-Z0-9 ]/g,'') ) ;
      $('#myFilterBuilder').trigger('click');
    }
  });
  $('#myFilterBuilder').on('click', function(){

    col = $('#getfilterCrit').val();
    colname = $('#getfilterCrit option:selected').text();
    opt = $('#getFilterOption').val();
    keyword = $('#getFilterWord').val();


    col = col.replace(/[^a-zA-Z0-9 ]/g,'');
    colname = colname.replace(/[^a-zA-Z0-9 ]/g,'');
    opt = opt.replace(/[^a-zA-Z0-9 ]/g,'');

    keyword = keyword.replace(/[^a-zA-Z0-9 ]/g,'');

    if(keyword!=""){
      filtCtr++;
      $('#filterWrapper').append('<div class="row" id="rowFilter'+filtCtr+'"><div class="col-lg-1 getDiv" hidden>'+filtCtr+'</div><div class="col-lg-3" id="tcoler'+filtCtr+'" hidden>'+col+'</div><div class="col-lg-3" >'+colname+'</div><div class="col-lg-3" id="opter'+filtCtr+'">'+opt+'</div><div class="col-lg-3" id="keywer'+filtCtr+'">'+keyword+'</div><div class="col-lg-1"><button onclick="$('+"'"+'#rowFilter'+filtCtr+"'"+').remove(); $('+"'.butones'"+').trigger('+"'click'"+');" class="btn btn-xs btn-danger fa fa-trash" ></button></div></div>');
      $('#getFilterWord').val('');
    }
  });
  $('.butones').on('click', function(){
    var eachCTR = 0;
    $('#table_holderDATA1').hide();
    $('.getDiv').each(function(){
        keyIndex = $(this).text();
        if(keyIndex != ""){
          var cols = $('#tcoler'+keyIndex).text();
          var opts = $('#opter'+keyIndex).text();
          var keys = "'"+$('#keywer'+keyIndex).text()+"'";
          if(opts == 'Has'){
            keys = "'!"+$('#keywer'+keyIndex).text()+"!'";
          }
          if(eachCTR>=0){
              qString += cols +' '+ opts +' '+ keys +' | ';
          }else{
              qString += cols +' '+ opts +' '+ keys +'';
          }
        }
        eachCTR++;
    });
    if(qString !=""){

      $('#table_holderDATA2').html();
      $.ajax({
        type: "POST" ,
        url: "<?php echo base_url();?>Contacts/filters/"+xgx,
        data: {
        ajaxQst : qString
        },
        beforeSend: function() {

        },
        success: function(data){
          flagger('dynlist','dy1cl');toggle_check('dynlist');

          $('#table_holderDATA2').html(data);
          var oTable = $('#listeddata2').dataTable( {
            "aoColumnDefs" : [ {
            "bSortable" : false,
            "aTargets" : [ "sorting_disabled" ]
        } ],
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,

          "bAutoWidth": true,
          "order": [ 3, 'asc' ] } );
          $('#listeddata2_filter input').unbind();
          $('#listeddata2_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
          });
        }
      });
    
    }else{
      flagger('contactlist','cb1cl');toggle_check('contactlist');
    }
    if(eachCTR == 0){
      $('#table_holderDATA2').html('');
      $('#table_holderDATA1').show();
    }else{
      $('#table_holderDATA1').hide();
    }
    eachCTR =0 ;
    qString ="";
  });
  $('#filteringToggler').hide();
	function sprint(str,kk){
    $("#contactViewModal").html('');
		$('#ct').text(str);
    key = kk;
    $.ajax({
      type: "POST" ,
      url: "<?php echo base_url();?>Contacts/edit_contactModal/"+kk,
      success: function(data){
        $("#contactViewModal").html(data);
        bool_mode = "0";
      }
    });
	}
	function getkey(){
	}
  function santaclauserG(){ //loop html adv. serach result get ID
    askcb();
  }
  var allc=0;
  var notc=0;
  function rudolf(){
    allc=0;
    notc=0;
    $('.'+htflags+'CB').each(function(){
      if($(this).is(':checked')) {
        var hohoho = $(this);
        hohoho = hohoho.val();
        $.ajax({
          type: "GET" ,
          url: "<?php echo base_url();?>Welcome/importToGoogle/"+hohoho,
          success: function(data){
            allc++;
            executebatch(data.givenName,data.familyName,data.emailAddresses,data.phoneNumbers,data.streetAddress,data.city,data.jobDescription,data.company,data.biographies,data.urls,data.plabel,data.elabel,data.ulabel,data.id,data.mainP,data.mainE)

          }//(gName,fName,eAdd,pNum,street,city,jobDesc,company,biographies,urls,plabel,elabel,ulabel,id)
      });
      }
    });
  }
  function whosyourID2(){ //loop html adv. serach result get ID
      $.ajax({
        type: "GET" ,
        url: "<?php echo base_url();?>Welcome/importToGoogle/"+key,
        success: function(data){
          execute(data.givenName,data.familyName,data.emailAddresses,data.phoneNumbers,data.streetAddress,data.city,data.jobDescription,data.company,data.biographies,data.urls,data.plabel,data.elabel,data.ulabel,data.id,data.mainP,data.mainE)
      }
    });
  }
  function ask2(){
    console.log(key);
    var confirmSave = confirm("Are you sure you want to import to Google Contacts?");
      if(confirmSave == true){
        strCtr+=1;
      }
      if(strCtr==1){
        authenticate2();
      }
  }
  function loadClient2() {
    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/people/v1/rest")
    .then(function() { console.log("GAPI client loaded for API");
      whosyourID2();
    },
      function(err) { console.error("Error loading GAPI client for API", err); });
  }
	var strCtr=0;
  function ask(){
    var confirmSave = confirm("Are you sure you want to save this User?");
      if(confirmSave == true){
        strCtr+=1;
      }
      if(strCtr==1){
        authenticate();
      }else{
      }
  }
  function askcb(){
    var confirmSave = confirm("Are you sure you want to save this User?");
      if(confirmSave == true){
        strCtr+=1;
      }
      if(strCtr==1){
        authenticatecb();
      }else{
      }
  }
  function authenticate() {
    return gapi.auth2.getAuthInstance()
    .signIn({scope: "https://www.googleapis.com/auth/contacts"})
    .then(function() {
      console.log("Sign-in successful");
      loadClient();
    },
      function(err) { console.error("Error signing in", err); });
  }
  function authenticate2() {
    return gapi.auth2.getAuthInstance()
    .signIn({scope: "https://www.googleapis.com/auth/contacts"})
    .then(function() {
      console.log("Sign-in successful");
      loadClient2();
    },
      function(err) { console.error("Error signing in", err); });
  }
  function authenticatecb() {
    return gapi.auth2.getAuthInstance()
    .signIn({scope: "https://www.googleapis.com/auth/contacts"})
    .then(function() {
      console.log("Sign-in successful");
      loadClientcb();
    },
      function(err) { console.error("Error signing in", err); });
  }
  function loadClientcb() {
    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/people/v1/rest")
    .then(function() { console.log("GAPI client loaded for API");
      rudolf();
    },
      function(err) { console.error("Error loading GAPI client for API", err); });
  }

  function loadClient() {
    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/people/v1/rest")
    .then(function() { console.log("GAPI client loaded for API");
      whosyourID();
    },
      function(err) { console.error("Error loading GAPI client for API", err); });
  }
  // Make sure the client is loaded and sign-in is complete before calling this method.
  //
  function executebatch(gName,fName,eAdd,pNum,street,city,jobDesc,company,biographies,urls,plabel,elabel,ulabel,id,mainP,mainE) {
    console.log('Contacts ('+allc+') pkpk'+id);
    var contNum = mainP;
    var jsonBody = '{   "resource": { "names": [{"givenName": "'+gName+'",  "familyName": "'+fName+'"}],"emailAddresses": ['+mainE+'],  "phoneNumbers": [  '+contNum+'],"addresses": [{  "city": "'+city+'","region": "'+street+'"}  ],"organizations": [{ "name":"'+company+'","title": "'+jobDesc+'"}],"biographies": [{"value": "'+biographies+'"}],"urls": [{"value": "http://crm.floodcontrol.asia/Contacts/edit_contact/'+id+'","type":"Link to CRM"}]}}';
    console.log(jsonBody);
    jsonBody = JSON.parse(jsonBody);


    return gapi.client.people.people.createContact(jsonBody)
    .then(function(response) {
      // Handle the results here (response.result has the parsed body).
      console.log("Response", response);
      notc++;
      if(allc==notc){
        alert("Successfully Added to google Contacts");
        location.reload();
      }
      console.log(notc+' Contact Processed pkpk'+id);
    },
      function(err) { console.error("Execute error", err); });
  }



   function execute(gName,fName,eAdd,pNum,street,city,jobDesc,company,biographies,urls,plabel,elabel,ulabel,id,mainP,mainE) {
    var contEm = mainE;
    console.log(contEm);
    var contNum = mainP;
    var jsonBody = '{   "resource": { "names": [{"givenName": "'+gName+'",  "familyName": "'+fName+'"}],"emailAddresses": ['+contEm+'],  "phoneNumbers": [  '+contNum+'],"addresses": [{  "city": "'+city+'","region": "'+street+'"}  ],"organizations": [{ "name":"'+company+'","title": "'+jobDesc+'"}],"biographies": [{"value": "'+biographies+'"}],"urls": [{"value": "http://crm.floodcontrol.asia/Contacts/edit_contact/'+id+'","type":"Link to CRM"}]}}';
    console.log(jsonBody);
    jsonBody = JSON.parse(jsonBody);

    return gapi.client.people.people.createContact(jsonBody)
    .then(function(response) {
      // Handle the results here (response.result has the parsed body).
      console.log("Response", response);
      alert("Successfully Added to google Contacts");
      location.reload();
    },
      function(err) { console.error("Execute error", err); });
  }
  gapi.load("client:auth2", function() {
    gapi.auth2.init({client_id: '215910084831-b7fg2e7ue468o4cfuk33rp05bjt8bndk.apps.googleusercontent.com', apiKey: 'AIzaSyBYBWNVpMmGpOSX0CevFHvcLjvsh6Ml2Pw'});
  });
</script>
<script type="text/javascript">
$( window ).resize(function() {
  var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    console.log(width);

});

var xgx='<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;?>';
  $(document).ready(function(){
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    console.log(width);
    $('#butones').hide();
    var oTable = $('#listeddata').dataTable( {
      "aoColumnDefs" : [ {
            "bSortable" : false,
            "aTargets" : [ "sorting_disabled" ]
        } ],
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false ,
      "pagingType": "numbers",

      "order": [ 3, 'asc' ]} );
    $('#listeddata_filter input').unbind();
    $('#listeddata_filter input').bind('keyup', function(e) {
      if(e.keyCode == 13) {
        oTable.fnFilter(this.value);
      }
    });
  });
  $(document).ready(function() {
  } );
</script>
	</div>
</section>
<!-- Modal View -->
<div id="modalContact" class="modal fade" role="dialog" data-keyboard="true" aria-labelledby="orderModal" aria-hidden="true" tabindex='-1' style="z-index:123123213213412312;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Contact View <?php echo $somedata;?></h3><button class="btn paper" data-dismiss="modal" aria-hidden="true">X</button>
      </div>
      <div id="contactViewModal" class="modal-body">
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="orderModal" class="modal fade" role="dialog" aria-labelledby="orderModal" aria-hidden="true">
</div>
<button onclick="authenticate().then(loadClient)" hidden>authorize and load</button>

<script>
var htflags="contactlist";
function toggle_check(sstr){
  $('.disOps').hide();
  htflags=sstr;
  countCb();
  if(totalcb>0){
    $('#'+htflags+'Options').show();
  }
}
function flagger(sstr,htht){
  htflags=sstr;
  var htcb = $('#'+htht);
  if(htcb.is(':checked')){
    $('.'+htflags+'CB').prop( "checked", true );
  }else{
    $('.'+htflags+'CB').prop( "checked", false );
  }
}
var totalcb=0;
var pdcb=0;
  function countCb(){
    totalcb=0;
    $('.'+htflags+'CB').each(function(){
      if($(this).is(':checked')) {
        totalcb++;
      }
    });
  }
  function gogogo_fire_in_the_hole(){
    pdcb=0;
    $('.'+htflags+'CB').each(function(){
      if($(this).is(':checked')) {
        var hohoho = $(this);
        hohoho = hohoho.val();
        hohoho = parseInt(hohoho);

          if(hohoho!=0){
            $.ajax({
              type: "POST" ,
              url: "<?php echo base_url();?>Contacts/delete",
              data: {
              ajaxkey : hohoho
              },
              success: function(data){
                pdcb++;
                if(pdcb == totalcb){
                  window.location.reload();
                }
              }
            });
          }

      }
    });
  }

  function actlogger(){
    var actstring= "";
    var acterCtr=0;
    $('.'+htflags+'CB').each(function(){
      if($(this).is(':checked')) {
        if(acterCtr !=0){
          actstring+= "-";
        }
        var hohoho = $(this);
        hohoho = hohoho.val();
        actstring+= String(hohoho);
        acterCtr++;
      }
    });
    window.location.replace("<?php echo base_url();?>Activity/Main/"+actstring);
  }


  function grouper(){
    var actstring= "";
    var acterCtr=0;
    $('.'+htflags+'CB').each(function(){
      if($(this).is(':checked')) {
        if(acterCtr !=0){
          actstring+= "-";
        }
        var hohoho = $(this);
        hohoho = hohoho.val();
        actstring+= String(hohoho);
        acterCtr++;
      }
    });
    window.location.replace("<?php echo base_url();?>Contacts/grouping/"+actstring);
  }
  function omit(){
    var seater="";
    if(totalcb>1){seater='s';}
    countCb();
    if (confirm("Are you sure you want to delete : "+totalcb+" Contact"+seater+"?")) {
      if(totalcb>0){
        gogogo_fire_in_the_hole();
      }
    }

  }
  $('#addThisPIECEtoPuzzle').on('change', function(){
    xgx = $(this).val();
    if(htflags == "contactlist"){
      bool_mode = "0";
      window.location.replace("<?php echo base_url();?>Welcome/home/"+xgx);
    }else{
      $('.butones').trigger('click');
    }
  });
</script>

                                                                                                                                                                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
