function addActivity(userID,activityLog,activityType,activityStatus,activityDateAndTime){
  $.ajax({
    type:'get',
    url: base_url+"ajaxSaveActivity",
    data:{
      'ajaxuserID': userID,
      'ajaxactivityLog': activityLog,
      'ajaxactivityType': activityType,
      'ajaxactivityStatus': activityStatus,
      'ajaxactivityDateAndTime': activityDateAndTime
    },
      success: function(data){
      getmyID();
    },error:function(){
      alert("Error");
    }
  });
}
function addActivityLogMerge(activityID,contactID){
  $.ajax({
    type:'get',
    url: base_url+"ajaxSaveActivity",
    data:{
      'ajaxactivityID': activityID,
      'ajaxcontactID': contactID,
    },
      success: function(data){
      getmyID();
    },error:function(){
      alert("Error");
    }
  });
}
