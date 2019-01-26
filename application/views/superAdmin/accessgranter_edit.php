<style >
	.picpic{
		height: 80px !important;
		width: auto !important;
	}
</style>
<br>
<div class="container paper">
<br>
    <h5>Role Info</h5>
    <div class="row col">
        <div class="col-xs-1">&nbsp;&nbsp;</div>
        <div class="col-xs-1">&nbsp;&nbsp;</div>
        <div class="col-xs-4 col-lg-2">
           <label for="">* Role Name <br> ( Unique )</label>
        </div>
        <div class="col-xs-1">&nbsp;&nbsp;</div>
        <div class="col-xs-6 col-lg-6">
           <input type="text" id="txtrole" class="form-control" value="<?php if(!empty($roleInfo)){ echo $roleInfo[0]->rr_name; } ?>">
        </div>
    </div>
    <br>
    <div class="col-lg-10 row form-control" style="margin:auto;padding:15px;">
        <h5>Access Permissions</h5>
        <?php
            $sub1;
            $sub2;
            //accessList2
            //accessList
            if(!empty($accessList)){
                foreach($accessList as $key => $value){
                    $sub1 = $value->accessGroup;
                    echo '<div class="col-lg-8" style="margin:auto;">';
                    echo '<label>'.$sub1.'</label>';
                    echo '<select class="form-control getmyid" style="margin-left:18px;">>';
                    if( !empty($accessList2) ) {
                        $selected = 0;
                        $sub3;
                        $persistUaID=0;
                        $staticUaID=0;
                        foreach($access_m_role as $key => $value  ){
                            $sub3 = $value->accessGroup;
                            if($sub3 == $sub1){
                                $persistUaID = $value->uaID;
                                echo '<option value="'.$value->uaID.'" Selected>'.$value->displayName.'</option>';
                                $selected ==1;
                            }
                        }
                        foreach($accessList2 as $key => $value){
                            $sub2 = $value->accessGroup;
                            $staticUaID = $value->uaID;
                            if($sub1 == $sub2){
                                if($selected == 0){
                                    echo '<option value="0">No Access</option>';
                                }
                                $selected++;
                                if($staticUaID != $persistUaID){
                                    echo '<option value="'.$value->uaID.'">'.$value->displayName.'</option>';
                                }
                            
                            }
                        }
                    }
                    echo '</select>';
                    echo '</div>';
                }
            }
        ?>
    </div>
    <br>
    <div class="modal-footer">
        <button class="btn btn-md btn-success " onclick="getit()">Update</button>
        <a href="<?php echo base_url('Admin/roles');?>"><button class="btn btn-primary">Cancel</button></a>
    </div>
</div>
<script>
    var roleDD = <?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;?>;
    var roleName;
    var accessID;
    var base_url = "<?php echo base_url();?>";
    function getit(){
        roleName = $('#txtrole').val();
        $.ajax({
            url: base_url+"Admin/role_access1/"+roleDD,
            type: "post",
            data: {
                'xmlRR' : roleName
                },
            success: function(data){
               var sds = data; 
               var eachCtr = 0;
               var ajCtr = 0;
                 $('.getmyid').each(function(){
                    eachCtr++;
                    accessID = $(this).val();
                    $.ajax({
                    url: base_url+"Admin/role_access2/"+roleDD,
                    type: "post",
                    data: {
                        'xmlAA' : accessID,
                        'xmlRR' : sds
                        },
                        success: function(data){
                            ajCtr++;
                            if(ajCtr == eachCtr){
                                window.location.replace(base_url+"Admin/editaccess/"+sds);
                            }
                        }
                    });
                });
            }
        });
    }
</script>