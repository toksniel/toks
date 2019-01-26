<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid">
            <div class="row">
                <div class="col-lg-6"><br>
                    <h1>Material Request Form</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1">
                <label for="" class="text-justify"> Date:</label> 
                </div>
                <div class="col-sm-3">
                <input type="date" id="dates" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <datalist id="unit">
                        <option value="m">
                        <option value="mm">
                        <option value="km">
                        <option value="pcs">
                        <option value="g">
                        <option value="mg">
                        <option value="kg">
                        <option value="tube">
                    </datalist>
                    <datalist id="code">
                       <?php
                            foreach($rawMats as $key => $value){
                                echo'    <option value="'.$value->rawMatCode.'">';
                            }
                       ?> 
                    </datalist>
                    <datalist id="matName">
                       <?php
                       $x=0;
                            foreach($rawMats as $key => $value){
                                $x++;
                                echo'    <option value="'.$x.' | '.$value->rawMatName.'">';
                            }
                       ?> 
                    </datalist>
                    <div style="margin:15px; ">
                        <div id="entryData" style="margin-top:5px;">
                            <div class="row">
                                <div class="col-lg-1">
                                    <label for="">#</label>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Item Code</label>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Item Name</label>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Quantity</label>
                                </div>
                                <div class="col-lg-1">
                                    <label for="">Unit</label>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Remarks</label>
                                    
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
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <input list="code" id="matCode1" class="form-control typeRekt">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    <input list="matName" id="matName1" class="form-control typeRekt"  >
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                    <input type="number" id="matQty1" class="form-control typeRekt"   >
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <input list="unit" id="matUnit1" class="form-control typeRekt"   >
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <input type="text" id="matRemarks1" class="form-control typeRekt baseP"   >
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
                    <input type="button" class="btn btn-outline-success rounded" value="Save" id="save" style="float:right;">
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var base_url ="<?php echo base_url();?>"
    var arrs=[];
    $('#addEntry').hide();
    var entmemory = <?php if($entranceCtr>0){ echo $entranceCtr;}else{ echo "1";}?>;
    var addCtrmemory = <?php if($entranceCtr>0){ echo $entranceCtr;}else{ echo "1";}?>; 
    var resorter=0;
    function hideMymemory(id){
        $('#memory'+id).hide();
    }
    $('#addEntry').on('click', function(){
        totalrekt = 0;
        totalrektfilled = 0;
        $('#addEntry').hide();
        entmemory++;
        addCtrmemory++;
        
        var z= $('#entryData').append('<div class="row" id="memory'+entmemory+'"><span class="memoryIndex" hidden>'+entmemory+'</span><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><label class="form-control sortmemory" id="entryNumber'+entmemory+'">'+addCtrmemory+'</label></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input list="code" id="matCode'+entmemory+'" class="form-control typeRekt"></div><div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><input list="matName" id="matName'+entmemory+'" class="form-control typeRekt"  ></div><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><input type="number" id="matQty'+entmemory+'" class="form-control typeRekt"   ></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input list="unit" id="matUnit'+entmemory+'" class="form-control typeRekt"   ></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="text" id="matRemarks'+entmemory+'" class="form-control typeRekt baseP"   ></div><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDel('+"'"+entmemory+"'"+')"><i class="fas fa-minus-circle"></i></button></div></div>');

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
    $(document).ready(function(){
    $("input[data-type='number']").keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "");
      var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
   //   console.log(num2);
      // the following line has been simplified. Revision history contains original.
      $this.val(num2);
  });
});
function foooooo(){
    $("input[data-type='number']").keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "");
      var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
      console.log(num2);
      // the following line has been simplified. Revision history contains original.
      $this.val(num2);
  });
}

$('#save').on('click',function(){
    $('.memoryIndex').each( function(){
        var memeIndex = $(this).text();
        memeIndex.replace(/ /g,'');
        var code = $('#matCode'+memeIndex).val();
        var name = $('#matName'+memeIndex).val();
        var qty = $('#matQty'+memeIndex).val();
        var unit = $('#matUnit'+memeIndex).val();
        var remarks = $('#matRemarks'+memeIndex).val();
        console.log(memeIndex);
        console.log (code);
        console.log (name);
        console.log (qty);
        console.log (unit);
        console.log (remarks);

    });
});


   /* function dynamicEntrance(ids){
        $('.memoryIndex').each( function(){
            var memeIndex = $(this).text();
            memeIndex.replace(/ /g,'');
            var code = $('#matCode'+memeIndex).val();
            var name = $('#matName'+memeIndex).val();
            var qty = $('#matQty'+memeIndex).val();
            var unit = $('#matUnit'+memeIndex).val();
            var remarks = $('#matRemarks'+memeIndex).val();
            var xstat=0;
            console.log (code);
            console.log (name);
            console.log (qty);
            console.log (unit);
            console.log (remarks);            
        });
    }*/


</script>
