<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div class="row">
              <div class="col-lg-12">
                <h1>Delivery Note</h1>
                
              </div>
              <div class="col-lg-2">
              <input type="date" class="form-control" id="textDate">
              </div>
              <hr>
            </div>
            <div style="margin:15px; ">
       <div id="entryData" style="margin-top:5px;">
         <div class="row" style="text-align:center;">
           <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
              <label for="">No.</label><br>
           </div>
           <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <label for="">Item Code</label>
           </div>
           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
             <label for="">Quantity <small>( in   pcs )</small> </label>
           </div>
           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
             <label for="">Length <small>( in mm )</small> </label>
           </div>
           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
             <label for="">Price <small>( in PHP )</small> </label>
           </div>
           <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
              <label for="">Option</label><br>
           </div>
         </div>
         <?php
         $entranceCtr=0;
            if(!empty($inquiryEntrances)){
              foreach ($inquiryEntrances as $key => $value) {
                $entranceCtr++;
                $sta = $value->entryStatus ;
                if($sta==1){
                  echo '
                  <div class="row" id="memory'.$entranceCtr.'">
                    <span class="memoryIndex" hidden>'.$entranceCtr.'</span>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <label class="form-control sortmemory" id="entryNumber'.$entranceCtr.'">'.$value->entryNumber.'</label>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <input type="text" id="entryName'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryName.'">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <input type="number" id="entryHeight'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryHeight.'">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <input type="number" id="entryWidth'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryWidth.'">
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                      <button type="button" class="btn btn-sm btn-danger rounded" onclick="hideMymemory('.$entranceCtr.')"  sstyle=" text-align: center;"><i class="far fa-trash-alt"></i></button>
                    </div>
                  </div>
                  ';
                }else{
                  echo '
                  <div class="row" id="memory'.$entranceCtr.'" hidden>
                    <span class="memoryIndex" hidden>'.$entranceCtr.'</span>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <label class="form-control sortmemory" id="entryNumber'.$entranceCtr.'">'.$value->entryNumber.'</label>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                      <input type="text" id="entryName'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryName.'">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <input type="number" id="entryHeight'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryHeight.'">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <input type="number" id="entryWidth'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryWidth.'">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <input type="number" id="entryWidth'.$entranceCtr.'" class="form-control typeRekt" value="'.$value->entryWidth.'">
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style=" text-align: center;">
                      <button type="button" class="btn btn-sm btn-danger rounded" onclick="hideMymemory('.$entranceCtr.')" >x</button>
                    </div>
                  </div>
                  ';
                }

              }
            }else{
              echo '
              <div class="row" id="memory1">
                <span class="memoryIndex" hidden>1</span>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <label class="form-control sortmemory" id="entryNumber1">1</label>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <input type="text" id="entryName1" class="form-control typeRekt">
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <input type="number" id="entryHeight1" class="form-control typeRekt"  >
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <input type="number" id="entryWidth1" class="form-control typeRekt"   >
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <input type="number" id="entryWidth1" class="form-control typeRekt"   >
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style=" text-align: center;">
                  <button type="button" class="btn btn-sm btn-danger rounded" onclick="memoryDel(1)"  >x</button>
                </div>
              </div>
              ';
            }
         ?>

       </div>
       <div class="row">
         <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">

         </div>
         <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

         </div>
         <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

         </div>
         <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

         </div>
         <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style=" text-align: center;">
           <button  type="button" class="btn btn-sm btn-success rounded" id="addEntry" >+</button>
         </div>
       </div>
      </div>
        <hr>
          
        <br><br>
      </div>
      <br><br>
      <div class="paper container-fluid">
        <br>
        <div>
            <h1>Fees</h1>
            <hr>
        </div>
        <div class="row" style="text-align:center;">
          <div class="col-lg-3">
            &nbsp;
          </div>
          <div class="col-lg-6">
            <label for="">Type</label>
          </div>
          <div class="col-lg-3">
            <label for="">Price</label>
          </div>
        </div>


        <div class="row">
          <div class="col-lg-3">
            <label>Packaging</label>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" id="textPack">
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="textPackPrice">
          </div>
        </div><br>
        <div class="row">
          <div class="col-lg-3">
            <label>Sea / Air Freight</label>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" id="textSAFreight">
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="textSAFreightPrice">
          </div>
        </div><br>
        <div class="row">
          <div class="col-lg-3">
            <label>Land Freight</label>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" id="textLFreight">
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="textLFreightPrice">
          </div>
        </div><hr>
        <input type="button" value="Save" id="save" class="btn btn-outline-primary rounded" style="float:right;" onclick="getID();">
        <br><br>
      </div>
    </div>
</section>
<script>
 /*   var hiddenDeliveryArray = [];
    hiddenDeliveryArray.push(1);
    var deliveryCount = 1;
    var base_url ="<?php echo base_url();?>"
    $('#save').on('click',function(){
        str=0;
        var charge = "";
        var from = "";
        var itemCode = "";
        var quantity = "";
        var pricePH = "";
        itemCode = $('#textItemCode').val();
        quantity = $('#textQuantity').val();
        pricePH = $('#textPrice').val();
        charge = $('#textCharge').val();
        from = $('#textFrom').val();
        var confirmSave = confirm("Are you sure you want to Save this record?");
        if(confirmSave == true){
        str+=1;
        }
        if(str==1){
            getValDynamicallySingle();
            saveDeliveryRecipt(charge,from,itemCode,quantity,pricePH);
        }
    });


    function saveDeliveryRecipt(charge,from,itemCode,quantity,pricePH){
        $.ajax({
            type:'GET',
            url:base_url+"Inventory/ajaxSavingDelivery",
            data:{
                'ajaxCharge':charge,
                'ajaxFrom':from,
                'ajaxItemCode':itemCode,
                'ajaxQuantity':quantity,
                'ajaxPricePH':pricePH
            },
            success:function(data){
                //location.reload();
            },
            error:function(){
                alert("Error Saving");
            }
        });

    }*/

var base_url ="<?php echo base_url();?>"

$('#addEntry').hide();
var entmemory = <?php if($entranceCtr>0){ echo $entranceCtr;}else{ echo "1";}?>;
var addCtrmemory = <?php if($entranceCtr>0){ echo $entranceCtr;}else{ echo "1";}?>;
var resorter=0;
  function hideMymemory(id){
    $('#memory'+id).hide();
  }

  $('#addEntry').on('click',function(){
    totalrekt = 0;
    totalrektfilled = 0;
    $('#addEntry').hide();
    entmemory++;
    addCtrmemory++;
    $('#entryData').append('<div class="row" id="memory'+entmemory+'" style="margin-top:5px;"><span class="memoryIndex" hidden>'+entmemory+'</span><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><label class="form-control sortmemory" id="entryNumber'+entmemory+'">'+addCtrmemory+'</label></div><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"><input type="text" id="entryName'+entmemory+'" class="form-control typeRekt"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="number" id="entryHeight'+entmemory+'" class="form-control typeRekt"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="number" id="entryWidth'+entmemory+'" class="form-control typeRekt"   ></div><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style=" text-align: center;"><button type="button" class="btn btn-sm btn-danger rounded" onclick="memoryDel('+"'"+entmemory+"'"+')">x</button></div></div>');
  });

  function resorterAgent(){
    resorter =0;
    $('.sortmemory').each(function(){
        resorter++;
        $(this).text(resorter);
    });


  }
  function memoryDel(get) {
    addCtrmemory--;
    $('#memory'+get).remove();
    if(addCtrmemory==0){
      $('#addEntry').show();
    }
    memcheck();
    resorterAgent();

  }
  var totalrekt =0;
  var totalrektfilled = 0;
  function exert(){

  }

  $('#entryData').on('keypress keyenter keyup focusin focusout blur click',".typeRekt", function(){
    memcheck();
  });
  function memcheck(){
    totalrekt = 0;
    totalrektfilled = 0;
    $('.typeRekt').each(function(){
      totalrekt++;
      var sub = $(this).val();
      if(sub!=""){
        totalrektfilled++;
      }
    });
    if(totalrekt==totalrektfilled){
        $('#addEntry').show();
    }else{
      $('#addEntry').hide();
    }
  }
$( document ).ready(function() {
    $('.typeRekt').trigger('click');

});

</script>
<script type="text/javascript">
    var dunnok = 1;
    var ids="";
    function removeK(get){
        $('#staticAssigned'+get).remove();
        $('#movek'+get).remove();
    }
    function getID(){
        compQty =$('#compQty').val();
            $.ajax({
                type:'GET',
                url: base_url+"Inventory/ajaxGetLastID2",
                success:function(ids){
                    compQty =$('#compQty').val();
                    $("#as").html(ids);
                    dynamicEntrance(ids);
                    console.log(ids);
                }
            });
    }

    function dynamicEntrance(ids){
        $('.memoryIndex').each( function(){
            var memeIndex = $(this).text();
            memeIndex.replace(/ /g,'');
            var entryNum = $('#entryNumber'+memeIndex).text();
            entryNum = entryNum.replace(/ /g,'');
            var entryName = $('#entryName'+memeIndex).val();
            var entyHeight = $('#entryHeight'+memeIndex).val();
            var entryWidth  = $('#entryWidth'+memeIndex).val();
            var xstat=0;
            var charge = $('#textCharge').val();
            var from = $('#textFrom').val();
            var dates = $('#textDate').text();
            if($('#memory'+memeIndex).is(":visible")){
            xstat = 1;
            }else{
            xstat = 0;
            }
            if((entryName !="" && entyHeight !="" && entryWidth !="" && entryNum !="") && xstat >=0  ){
              $.ajax({
                type: "POST" ,
                url: "<?php echo base_url();?>Inventory/inquiry_s3/",
                data: {
                  'AX_entryNum' : charge ,
                  'AX_entryName' : entryName ,
                  'AX_entyHeight' : entyHeight ,
                  'AX_entryWidth' : entryWidth,
                  'Ax_stat' : from,
                  'Ax_id':ids,
                  'Ax_date':dates
                },
                success: function(data){
                    
                    
                }
              });
            }
        });

    console.log('delivery saved');
    }
</script>