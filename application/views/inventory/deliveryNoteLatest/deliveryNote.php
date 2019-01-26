<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid">
            <!-- Delivery Note Info  -->
            <div class="row">
                <div class="col-lg-12"><br>
                    <h1>Delivery-Note</h1>
                    <span></span>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control">
                </div>  
                <div class="col-sm-3">
                    <label for="">Invoice no.</label>
                    <input type="text" class="form-control">
                </div> 
                <div class="col-sm-3">
                    <label for="">Invoice Date</label>
                    <input type="date" class="form-control">
                </div> 
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Delivery Note no.</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-sm-4">
                    <label for="">Delivery date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-sm-2">
                    <label for="">Currency</label>
                    <select name="" id="selectMainCurrency" class="form-control typeRekt"> 
                        <option value="" selected disabled>Select Currency</option> 
                        <?php
                            if(!empty($currency)){
                                foreach($currency as $key => $value){
                                    echo'<option value="'.$value->curryName.'">'.$value->curryName.'</option> ';
                                }
                            }
                        ?> 
                    </select>
                </div>
            </div>
            <br><br>
        </div>
        <!-- Delivery Note Info End -->
        <br><br>
        <!-- Delivery Note Items -->
        <div class="paper container-fluid">
            <div class="row">
                <div class="col-lg-12"><br>
                    <h1>Items</h1>
                    <span></span>
                    <hr>
                </div>
                <div >
                    <table class="table-sm" id="entryData">
                        <thead>
                            <th width="5%">#</th>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Bundle</th>
                            <th>Quantity</th>
                            <th>Base Quantity</th>
                            <th width="5%">Unit</th>
                            <th>Weight Total</th>
                            <th width="5%">Unit</th>
                            <th>Price Per Piece</th>
                            <th width="5%">Currency</th>
                            <th>Price Total</th>
                            <th width="5%">Currency</th>
                            <th width="5%">Option</th>
                        </thead>
                        <?php 
                        $entranceCtr=0;
                       echo' <datalist id="rawMats">';
                                if(!empty($rawMats)){
                                    foreach($rawMats as $key => $value){
                                        echo'    <option value="'.$value->rawMatCode.'">';
                                    }
                                }
                                echo'</datalist>';
                        echo'<tbody >
                             
                            <tr id="memory1">
                                <td hidden><span class="memoryIndexes" >1</span></td>
                                <td> <span class="form-control sortmemory" id="entryNumber1">1</span></td>
                                <td><input list="rawMats" class="form-control typeRekt" id="itemCode1" placeholder=""></td>
                                
                              <td><input type="text" class="form-control typeRekt" id="itemName1" placeholder=""></td>
                                <td><input type="text" data-type="number" class="form-control typeRekt sums" id="bundle1" placeholder=""></td>
                                <td><input type="text" data-type="number" class="form-control typeRekt sums" id="quantity1" placeholder=""></td>
                                <td><input type="text" data-type="number" class="form-control typeRekt" id="baseQuantity1" placeholder=""></td>
                                <td>
                                    <select name="" id="firstSelect1" class="form-control typeRekt"> 
                                        <option value="" selected disabled>Select SI Unit</option> 
                                        <option value="mm1">mm</option> 
                                        <option value="m1">m</option> 
                                        <option value="km1">km</option> 
                                    </select>
                                </td>
                                <td><input type="text" data-type="number" class="form-control typeRekt" id="weightTotal1"></td>
                                <td>
                                    <select name="" id="secondSelect1" class="form-control typeRekt"> 
                                        <option value="" selected disabled>Select SI Unit</option> 
                                        <option value="mg1">mg</option> 
                                        <option value="g1">g</option> 
                                        <option value="kg1">kg</option> 
                                    </select>
                                </td>
                                <td><input type="text" data-type="number" class="form-control typeRekt sums" id="perPiece1" placeholder=""></td>
                                <td><input type="text" class="form-control " id="currentItem1" disabled></td>
                                <td><input type="text" data-type="number" class="form-control baseP" id="priceTotal1" placeholder="Total" disabled></td>
                                <td><input type="text" class="form-control " id="currentsItem1" disabled>
                                </td>
                                <td><button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDel(1)"><i class="fas fa-minus-circle"></i></button></td>
                            </tr>

                            </tbody>';
                            ?>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button  type="button" class="btn btn-sm btn-outline-success rounded" id="addEntry" onclick="foooooo(); getID()"><i class="fas fa-plus-circle"></i></button></td>
                            </tr>
                       
                        </tbody>
                    </table>
                    <table>
                    <thead>
                            <th width="5%"> </th>
                            <th> </th>
                            <th> </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th width="5%"></th>
                            <th></th>
                            <th width="5%"></th>
                            <th></th>
                            <th width="5%"></th>
                            <th></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </thead>
                        <tbody>
                        <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><h4>Total</h4></td>
                                <td><input type="text" class="form-control" id="demo" disabled></td>
                                <td></td>
                        </tr>
                        </tbody>
                    </table>
                        <input type="button" class="btn btn-outline-primary rounded" value="Calculate"  id="calculate" onclick="calculate();">
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <!-- Delivery Note Item End -->
        <br><br>
        <!-- Delivery Note Fees -->
        <div class="paper container-fluid">
            <div class="row">
                <div class="col-lg-12"><br>
                    <h1>Fees</h1>
                    <span></span>
                    <hr>
                </div>
                <div>
                    <table id="entryDataxxx">
                        <thead>
                            <th width="5%">#</th>
                            <th>Item Code</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th width="5%">Currency</th>
                            <th>Option</th>
                        </thead>
                        <?php
                        $entranceCtrxxx=0;
                       echo' <tbody>
                            <tr id="memoryxxx1">
                                <td hidden><span class="memoryIndexesxxx" >1</span></td>
                                <td> <span class="form-control sortmemoryxxx" id="entryNumberxxx1">1</span></td>
                                <td><input type="text" class="form-control typeRektxxx" id="feeCode1"></td>
                                <td><input type="text" class="form-control typeRektxxx" id="feeDescription1"></td>
                                <td><input type="text" class="form-control typeRektxxx basePxxx" id="feeAmount1"></td>
                                <td><input type="text" class="form-control" id="currentFee1" disabled></td>
                                <td><button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDelxxx(1)"><i class="fas fa-minus-circle"></i></button></td>
                            </tr>
                        </tbody>';
                        ?>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button  type="button" class="btn btn-sm btn-outline-success rounded" id="addEntryxxx" onclick="fooooooxxx();"><i class="fas fa-plus-circle"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <th width="5%"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th width="5%"></th>
                            <th></th>
                        </thead>
                            <tr>
                                <td></td>
                                <td></td>
                                
                                <td><h4 style="float:right;">Total : </h4></td>
                                <td><input type="text" class="form-control" disabled id="demoxxx"></td>
                                <td></td>
                                <td></td>
                            </tr>
                    </table>
                    <br><br>
                </div>
            </div>
        </div>
        <!-- Delivery Note Fees End-->
        <br><br>
        <!-- Delivery Note Payments -->
        
        <!-- Delivery Note Payments End -->
    </div>
</section>
<script>
//change currency
$('#selectMainCurrency').on('change',function(){
    var e = document.getElementById("selectMainCurrency");
    var strUser = e.options[e.selectedIndex].value;
    console.log(strUser);
    $('.memoryIndexes').each(function(){
            var memeIndex = $(this).text();
            //memeIndex.replace(/ /g,'');
            $('#currentItem'+memeIndex).val(strUser);
            $('#currentFee'+memeIndex).val(strUser);
            $('#currentsItem'+memeIndex).val(strUser);
    });
});

</script>

<!-- - - - -blabalbalbalbalbalbalbalablablablabal -->
<script type="text/javascript">


function calculate(ids){
    $('.memoryIndexes').each( function(){
        var memeIndex = $(this).text();
        memeIndex.replace(/ /g,'');
        var  bundle = parseFloat($('#bundle'+memeIndex).val());
        var  quantity = parseFloat($('#quantity'+memeIndex).val());
        var  piece = parseFloat($('#perPiece'+memeIndex).val());
        var x = bundle * quantity * piece;
        var total = $('#priceTotal'+memeIndex).val(x);
        
        var z = $('#tots').val();

        var xstat=0;
        console.log(bundle);
        console.log(quantity);
        console.log(piece);

        if($('#memory'+memeIndex).is(":visible")){
        xstat = 1;
        }else{
        xstat = 0;
        }
    
    });
}

//---------getting sum

/*$(document).ready(function() {
    var bundle = 1;
            var quantity = 1;
            var piece = 1;
            var x = 0;
            var y =0;
            $('#bundle1').val(y);
            $('#quantity1').val(y);
            $('#perPiece1').val(y);
        $('.sums').keyup(function() {
       
        $('.memoryIndex').each( function(){
         
           
            var memeIndex = $(this).text();
             memeIndex.replace(/ /g,'');
            bundle = parseInt($('#bundle'+memeIndex).val());
            quantity = parseInt($('#quantity'+memeIndex).val());
            piece = parseInt($('#perPiece'+memeIndex).val());
            if(bundle+memeIndex ==''){
                x =  quantity * piece;
                $('#bundle'+memeIndex).val(y);
            }
            else if(quantity+memeIndex ==''){
                x =  bundle * piece;
            }
            else if(piece+memeIndex ==''){
                x =  bundle * quantity;
            }else{
                x = bundle * quantity * piece;
            }
            var total = $('#priceTotal'+memeIndex).val(x);
        });
    });
});*/

//------------------------------------------ this is the main multi;
/*   $(document).ready(function(){
        $('.memoryIndexes').each(function(){
            var memeIndex = $(this).text();
            //memeIndex.replace(/ /g,'');
        $('.sums').on('keypress keyenter keyup focusin focusout blur click', function(){  
            
              
                //memeIndex.replace(/ /g,'');
                
                memeIndex = (/.$/).exec(memeIndex);
             //   console.log(r);
                var bundle= $('#bundle'+memeIndex).val();
                var quantity= $('#quantity'+memeIndex).val();
                var piece= $('#perPiece'+memeIndex).val();
                var x = parseInt(bundle);
                var y = parseInt(quantity);
                var z = parseInt(piece);
                if(x+memeIndex===""){
                    var total = y * z;
                    var pass = $('#priceTotal'+memeIndex).val(total);
                } if(y+memeIndex===""){
                    var total = x * z;
                    var pass = $('#priceTotal'+memeIndex).val(total);
                } if(z+memeIndex===""){ 
                    var total = x * y;
                    var pass = $('#priceTotal'+memeIndex).val(total);
                }if(z+memeIndex!="" || y+memeIndex!=""||x+memeIndex!=""){
                    var total = x * y * z;
                    var pass = $('#priceTotal'+memeIndex).val(total);
                }
            });
        });
    });*/


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
        
        var z= $('#entryData').append('<tr id="memory'+entmemory+'"><td hidden><span class="memoryIndexes" >'+entmemory+'</span></td><td> <span class="form-control sortmemory" id="entryNumber'+entmemory+'">'+addCtrmemory+'</span></td><td><input list="rawMats" class="form-control typeRekt" id="itemCode'+entmemory+'" placeholder=""></td><td><input type="text" class="form-control typeRekt" id="itemName'+entmemory+'" placeholder=""></td><td><input type="text" data-type="number" class="form-control typeRekt sums" id="bundle'+entmemory+'" placeholder=""></td><td><input type="text" data-type="number" class="form-control typeRekt sums" id="quantity'+entmemory+'" placeholder=""></td><td><input type="text" data-type="number" class="form-control typeRekt" id="baseQuantity1" placeholder=""></td><td><select name="" id="firstSelect'+entmemory+'" class="form-control typeRekt"> <option value="" selected disabled>Select SI Unit</option> <option value="mm">mm</option> <option value="m">m</option> <option value="km">km</option> </select></td><td><input type="text" data-type="number" class="form-control typeRekt" id="weightTotal'+entmemory+'"></td><td><select name="" id="secondSelect'+entmemory+'" class="form-control typeRekt"> <option value="" selected disabled>Select SI Unit</option> <option value="mg">mg</option> <option value="g">g</option> <option value="kg">kg</option> </select></td><td><input type="text" data-type="number" class="form-control typeRekt sums" id="perPiece'+entmemory+'" placeholder=""></td><td><input type="text" class="form-control " id="currentItem'+entmemory+'" disabled></td><td><input type="text" data-type="number" class="form-control baseP" id="priceTotal'+entmemory+'" placeholder="Total" disabled></td><td><input type="text" class="form-control " id="currentsItem'+entmemory+'" disabled></td><td><button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDel('+"'"+entmemory+"'"+')"><i class="fas fa-minus-circle"></i></button></td></tr>');

    });
    $('#calculate').click(function(){
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
           // dynamicEntrance(ids);
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
</script>


<script>//for fees </script>


<script>

    var base_url ="<?php echo base_url();?>"
    var arrs=[];
    $('#addEntry').hide();
    var entmemoryxxx = <?php if($entranceCtrxxx>0){ echo $entranceCtrxxx;}else{ echo "1";}?>;
    var addCtrmemoryxxx = <?php if($entranceCtrxxx>0){ echo $entranceCtrxxx;}else{ echo "1";}?>; 
    var resorterxxx=0;
    function hideMymemory(id){
        $('#memoryxxx'+id).hide();
    }
    $('#addEntryxxx').on('click', function(){
        totalrektxxx = 0;
        totalrektfilledxxx = 0;
        $('#addEntryxxx').hide();
        entmemoryxxx++;
        addCtrmemoryxxx++;
        
        var z= $('#entryDataxxx').append('<tr id="memoryxxx'+entmemoryxxx+'"><td hidden><span class="memoryIndexesxxx" >'+entmemoryxxx+'</span></td><td> <span class="form-control sortmemoryxxx" id="entryNumberxxx'+entmemoryxxx+'">'+addCtrmemoryxxx+'</span></td><td><input type="text" class="form-control typeRektxxx" id="feeCode'+entmemoryxxx+'"></td><td><input type="text" class="form-control typeRektxxx" id="feeDescription'+entmemoryxxx+'"></td><td><input type="text" class="form-control typeRektxxx basePxxx" id="feeAmount'+entmemoryxxx+'"></td><td><input type="text" class="form-control" id="currentFee'+entmemoryxxx+'" disabled></td><td><button type="button" class="btn btn-sm btn-outline-danger rounded" onclick="memoryDelxxx('+"'"+entmemoryxxx+"'"+')"><i class="fas fa-minus-circle"></i></button></td></tr>');

    });
    $('#addEntryxxx').click(function(){
        var totalxxx=0;
        totalxxx = parseInt(totalxxx);
        $('.basePxxx').each(function(){
            var  x =0;
            x= $(this).val();
            if(x!=''){
                x = parseInt(x);
                totalxxx+=x;
            }
        });
        $('#demoxxx').val(totalxxx);
    });
    function resorterAgentxxx(){
        resorterxxx =0;
        $('.sortmemoryxxx').each(function(){
            resorterxxx++;
            $(this).text(resorterxxx);
        });
    }
    function memoryDelxxx(get) {
        addCtrmemoryxxx--;
        $('#memoryxxx'+get).remove();
        if(addCtrmemory==0){
            $('#addEntryxxx').show();
        }
        memcheckxxx();
        resorterAgentxxx();
    }
    var totalrekt =0;
    var totalrektfilled = 0;
    function exert(){
    }
  $('#entryDataxxx').on('keypress keyenter keyup focusin focusout blur click',".typeRektxxx", function(){
    memcheckxxx();

  });
    function memcheckxxx(){
        totalrektxxx = 0;
        totalrektfilledxxx = 0;
        $('.typeRektxxx').each(function(){
            totalrektxxx++;
            var subxxx = $(this).val();
            if(subxxx!=""){
                totalrektfilledxxx++;
            }
        });
        if(totalrektxxx==totalrektfilledxxx){
            $('#addEntryxxx').show();
        }else{
            $('#addEntryxxx').hide();
        }
    }
    $( document ).ready(function() {
        $('.typeRektxxx').trigger('click');

    });
    function getIDxxx(){
        compQty =$('#compQtyxxx').val();
        $.ajax({
            type:'GET',
            url: base_url+"Inventory/ajaxGetLastID2",
        success:function(ids){
            compQtyxxx =$('#compQty').val();
            $("#asxxx").html(ids);
            dynamicEntrancexxx(ids);
            saveFeesxxx(ids);
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
function fooooooxxx(){
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


</script>