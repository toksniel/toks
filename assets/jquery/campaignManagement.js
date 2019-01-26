function archiveCampaign(id,recStat){
  $.ajax({
    type:'POST',
    url :base_url+"Campaigns/ajaxArchiveCampaigns/"+request,
    data:{
      'ajaxRequest': request
    },
    success: function(data){
      location.reload();
    },
    error:function(){
      alert("Error");
}
});
}
