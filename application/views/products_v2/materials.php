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
        <a href="<?php echo site_url();?>ProductsV2/basicMaterialList"> <input type="button" class="btn btn-outline-danger rounded"  value="Cancel" > </a>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-4">
            <h1>Create Materials</h1>
        </div>
        <div class="col-lg-3 col-md-3  col-sm-2">
            <input type="button" class="btn btn-outline-success rounded" id="save" value="Save" > 
        </div>
    </div>
    <br>
</div>
<section class="dashboard-counts section-padding">
    <div class="row">
        <div class="col-sm-3">
        
        </div>
        <div class="col-sm-6">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12  col-sm-12">
                    <div class="paper container-fluid">
                        <br>
                       
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" align="center">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6  col-sm-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="">Material Code</label>
                                        <input type="text" class="form-control" id="textMatCode" data-toggle="tooltip" title="Required">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="">Material Name</label>
                                        <input type="text" class="form-control" id="textMatName">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12  col-sm-12">
                                <label for="">Material Description</label>
                                <textarea name="" id="textMatDesc" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">

                            </div>
                            <div class="col-lg-6 col-md-6  col-sm-6">
                                <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-primary rounded form-control">Select Dimensions</button>
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">

                            </div>
                        </div>
                        <div id="datasss">
                   
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-5 col-md-5  col-sm-5">
                                <label for="">Unit of Basis</label>
                                <select name="" id="textUnitBasis" class="form-control">
                                    <option value="" selected disabled>Select Unit</option>
                                   <?php
                                    if(!empty($drops)){
                                        foreach($drops as $key => $value ){
                                            echo'<option value="'.$value->dropVal.'">'.$value->dropName.'</option>';
                                            
                                        }
                                    }
                                   ?>
                                   <option value="pcs">Pieces</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">Material Weight</label>
                                <input type="text" class="form-control" id="textMatWeight">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="" class="">&nbsp;</label> <br>
                                <span for="" >Per <label class="bass" id="textMatWeightUnit"></label> </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="">PHP Price</label>
                                <input type="text" class="form-control" id="textMatPrice">
                            </div>
                            <div class="col-lg-3 col-md-3  col-sm-3">
                                <label for="" class="">&nbsp;</label> <br>
                                <span for="" >Per <label class="bass" id="textMatPriceUnit"></label> </span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                               
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Select Dimension</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <?php
                    if(!empty($dims)){
                        foreach($dims as $key => $value){
                            echo' <div class="col-sm-3">
                                    <input type="image" src="'.base_url($value->propImage).'"  id="'.$value->propID.'" onClick="getID(this.id) " data-dismiss="modal">
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>





<script>
    var base_url ="<?php echo base_url();?>";
    $(document).ready(function(){
        $('#textUnitBasis').on('change',function(){
            var basis = $(this).val();
            console.log(basis);
            $('.bass').text(basis);
        });
        
    });
    function getID(id){
        var x  =id;
        console.log(x);
        $.ajax({
            type:"GET",
            url: base_url+"ProductsV2/dimensions",
            data:{
                'ajaxID':x
            },
            success:function(data){
                $(datasss).html(data);
            }
        });
    }
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#zxc").change(function(){
        readURL(this);
    });
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }

    $('#save').on('click', function(){
        var image= $('#zxc').val();

    });
    var matCode ="";
    var matName ="";
    var matDescription ="";
    var matImage ="";
    var matWeight ="";
    var matWeightUnit ="";
    var matPrice ="";
    var matValue ="";textUnitBasis
    var matUnit2 ="";
    $('#save').on('click',function(){
        

        matCode = $('#textMatCode').val();
        matName =$('#textMatName').val();
        matDescription =$('#textMatDesc').val();
        matUnitBasis =$('#textUnitBasis').val();
      // matImage =$('#').val();
        matWeight =$('#textMatWeight').val();
        matWeightUnit =$('#textMatWeightUnit').text();
        matPrice =$('#textMatPrice').val();
        matPriceUnit =$('#textMatPriceUnit').text();
        
console.log(matUnitBasis);
        if(matCode  === '' ){
            alert('Fill the Material Code')
        }
        if(matName  === '' ){
            alert('Fill the Material Name')
        }
       
        if(matWeight === '' ){
            alert('Fill the Material Weight')
        }
        if(matPrice  === '' ){
            alert('Fill the Material Price')
        }

        if(matCode && matName && matWeight && matPrice != ''){
            addMaterial(matCode,matName,matDescription,matUnitBasis,matWeight,matWeightUnit,matPrice,matPriceUnit);
        }
        addDimensionsMat(matCode);
    });
    function addDimensionsMat(matCode){
        $('.dimensionsssss').each(function(){
        //cube
            var lengthD = $('#lengthD').val();
            var widthD = $('#widthD').val();
            var heightD = $('#heightD').val();
            var widthUnitD = $('#widthUnitD').val();
            //bolt
            var threadCountDa = $('#threadCountD').val();
            var threadLengthD = $('#threadLengthD').val();
            //dowel
            var threadCount2D = $('#threadCount2D').val();
            var threadLength2D = $('#threadLength2D').val();
            //base seal
            var baseAreaD = $('#baseAreaD').val();
            var baseLengthD = $('#baseLengthD').val();
            //bead seal
            var beadDiameterD = $('#beadDiameterD').val();
            var beadLengthD = $('#beadLengthD').val();
            //volume
            var volD = $('#volD').val();
            //washer
            var innderDiameterD = $('#innderDiameterD').val();
            var outerDiameterD = $('#outerDiameterD').val();
            //nut
            var nutDiaD = $('#nutDiaD').val();
            console.log(widthUnitD);
            $('.units').each(function(){
                
            });
            $.ajax({
                type:'GET',
                url:base_url+"ProductsV2/ajaxSaveMatDim",
                data:{
                    'ajaxlengthD':lengthD,
                    'ajaxwidthD':widthD
                    
                },
            });
        });
        
    }
    function addMaterial(matCode,matName,matDescription,matUnitBasis,matWeight,matWeightUnit,matPrice,matPriceUnit){
        $.ajax({
            type:'GET',
            url:base_url+"ProductsV2/ajaxSavingMaterial",
            data:{
                'ajaxCode':matCode,
                'ajaxName':matName,
                'ajaxDesc':matDescription,
                'ajaxBaseUnit':matUnitBasis,
                'ajaxWeight':matWeight,
                'ajaxWegithUnit':matWeightUnit,
                'ajaxPrice':matPrice,
                'ajaxPriceUnit':matPriceUnit
            },
            success:function(){
                console.log('Success');
            }
        });
    }

</script>


