<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid">
            <div class="row">
                <div class="col-lg-12"><br>
                    <h1>Delivery-Note</h1>
                    <span></span>
                    <hr>
                </div>
                <div class="col-sm-4">
                <label for="">Delivery From</label>    
                <input type="text" class="form-control" id="deliFrom">
                </div>
                <div class="col-sm-3">
                    <label for="">Date</label>
                    <input type="date" class="form-control" id="dateRec">
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
    <div style="margin:15px; ">
       <div id="entryData" style="margin-top:5px;">
         <div class="row">
         <div class="col-lg-1">
                        <label for="">#</label>
                    </div>
                    <div class="col-lg-3">
                        <label for="">Item Name</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Quantity</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Length</label>
                    </div>
                    <div class="col-lg-1">
                        <label for="">Unit</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Base Price</label>
                        
                    </div>
                    <div class="col-lg-1">
                        <label for="">Option</label>
                    </div>
         </div>
         <?php
         $entranceCtr=0;
            
              echo '
              <div class="row" id="memory1">
                <span class="memoryIndex" hidden>1</span>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <label class="form-control sortmemory" id="entryNumber1">1</label>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <input type="text" id="deliveryName1" class="form-control typeRekt">
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <input type="number" id="deliveryQty1" class="form-control typeRekt"  >
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <input type="number" id="deliveryLength1" class="form-control typeRekt"   >
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                  <input type="text" id="deliveryBaseP2" class="form-control typeRekt"   >
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <input type="number" id="deliveryBaseP1" class="form-control typeRekt baseP"   >
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                  <button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDel(1)"><i class="fas fa-minus-circle"></i></button>
                </div>
              </div>
              ';
            
         ?>

       </div>
       <div class="row">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-3">

            </div>
            <div class="col-lg-2">

            </div>
            <div class="col-lg-1">

            </div>
            <div class="col-lg-2">

            </div>
            <div class="col-lg-2">

            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <button  type="button" class="btn btn-sm btn-outline-success rounded" id="addEntry"><i class="fas fa-plus-circle"></i></button>
            </div>
       </div>
       </div>

       <br>
    </div>
    <br>
    <div class="paper container-fluid">
        <br>
        <div>
            <h1>Fees</h1>
            <hr>
        </div>
        <div class="row" style="text-align:center;">
          <div class="col-lg-2">
            &nbsp;
          </div>
          <div class="col-lg-7">
            <label for="">Type</label>
          </div>
          <div class="col-lg-2">
            <label for="">Price<sub>(PHP)</sub></label>
          </div>
        </div>


            <div class="row">
            <div class="col-lg-2">
                <label>Packaging</label>
            </div>
            <div class="col-lg-7">
                <input type="text" class="form-control" id="textPack">
            </div>
            <div class="col-lg-2">
                <input type="text" class="form-control" id="textPackPrice">
            </div>
            </div><br>
            <div class="row">
            <div class="col-lg-2">
                <label>Sea / Air Freight</label>
            </div>
            <div class="col-lg-7">
                <input type="text" class="form-control" id="textSAFreight">
            </div>
            <div class="col-lg-2">
                <input type="text" class="form-control" id="textSAFreightPrice">
            </div>
            </div><br>
            <div class="row">
            <div class="col-lg-2">
                <label>Land Freight</label>
            </div>
            <div class="col-lg-7">
                <input type="text" class="form-control" id="textLFreight">
            </div>
            <div class="col-lg-2">
                <input type="text" class="form-control" id="textLFreightPrice">
            </div><br><br>
            <div class="col-sm-9" style="text-align:right;"><hr>
            <label for="">Total</label>
            </div>
            <div class="col-sm-2">
            <hr><input type="text" class="form-control" id="demo" disabled >
            </div>
        </div>
      
        
        <input type="button" value="Save" id="save" class="btn btn-outline-primary rounded" style="float:right;" onclick="getID();">
        <br><br>
      </div>
</div>


</div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var base_url ="<?php echo base_url();?>"
    var arrs=[];
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
        var z= $('#entryData').append('<div class="row" id="memory'+entmemory+'" style="margin-top:5px;"><span class="memoryIndex" hidden>'+entmemory+'</span><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><label class="form-control sortmemory" id="entryNumber'+entmemory+'">'+addCtrmemory+'</label></div><div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><input type="text" id="deliveryName'+entmemory+'" class="form-control typeRekt"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="number" id="deliveryQty'+entmemory+'" class="form-control typeRekt"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="number" id="deliveryLength'+entmemory+'" class="form-control typeRekt"   ></div><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><input type="number" id="deliveryBaseP2'+entmemory+'" class="form-control typeRekt baseP"   ></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="number" id="deliveryBaseP'+entmemory+'" class="form-control typeRekt baseP"   ></div><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDel('+"'"+entmemory+"'"+')"><i class="fas fa-minus-circle"></i></button></div></div>');


    });
 
    
  

    $('#addEntry').click(function(){
        var total=0;
        total = parseInt(total);
        $('.baseP').each(function(){
            var  x =0;
            x= $(this).val();
            if(x!=''){
                x = parseInt(x);
                total+=x;
            }
        });
        $('#demo').val(total);
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
    function getID(){
        compQty =$('#compQty').val();
        $.ajax({
            type:'GET',
            url: base_url+"Inventory/ajaxGetLastID2",
        success:function(ids){
            compQty =$('#compQty').val();
            $("#as").html(ids);
            dynamicEntrance(ids);
            saveFees(ids);
            console.log(ids);
        }
        });
    }
    function dynamicEntrance(ids){
        $('.memoryIndex').each( function(){
            var memeIndex = $(this).text();
            memeIndex.replace(/ /g,'');
            var deliFrom = $('#deliFrom').val();
            var deliDate = $('#dateRec').val();
            var entryNum = $('#entryNumber'+memeIndex).text();
            entryNum = entryNum.replace(/ /g,'');
            var deliName = $('#deliveryName'+memeIndex).val();
            var deliQty = $('#deliveryQty'+memeIndex).val();
            var deliLeng  = $('#deliveryLength'+memeIndex).val();
            var deliBase  = $('#deliveryBaseP'+memeIndex).val();
            var xstat=0;
         
            if($('#memory'+memeIndex).is(":visible")){
            xstat = 1;
            }else{
            xstat = 0;
            }
           // if((deliFrom !="" && deliDate !="" && entryNum !="" && deliName !="" && deliQty !="" && deliBase !="") && xstat >=0  ){
              $.ajax({
                type: "get" ,
                url: "<?php echo base_url();?>Inventory/saveDeliveryNote",
                data: {
                 'ajaxName':deliName,
                 'ajaxQty':deliQty,
                 'ajaxLeng':deliLeng,
                 'ajaxBase':deliBase,
                 'ajaxFrom':deliFrom,
                 'ajaxDate':deliDate,
                 'ajaxID':ids
                },
                success: function(ids){
            
                }
              });
           // }
        });
    }
    function saveFees(ids){
        var pack =$('#textPack').val();
        var packPrice =$('#textPackPrice').val();
        var saFreight =$('#textSAFreight').val();
        var saFreightPrice =$('#textSAFreightPrice').val();
        var landFreight =$('#textLFreight').val();
        var landFreightPrice =$('#textLFreightPrice').val();
        $.ajax({
            type:'POST',
            url:base_url+"Inventory/saveOtherFees",
            data:{
                'ajaxPack':pack,
                'ajaxPackPrice':packPrice,
                'ajaxSaFreight':saFreight,
                'ajaxSaFreightPrice':saFreightPrice,
                'ajaxLandFreight':landFreight,
                'ajaxLandFreightPrice':landFreightPrice,
                'ajaxGroupID':ids
            },
            success:function(){
                console.log(ids);
            }
        });
    }

</script>
