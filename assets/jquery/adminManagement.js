function deleteUser(id,recStat){
  $.ajax({
    type:'get',
    url :base_url+"Admin/ajaxArchiveUser",
    data:{
      'ajaxID': id
    },
    success: function(data){
      location.reload();
    },
    error:function(){
      alert("Error");
    }
  });
}

function changePass(userPass1,hiddenUserPass,oldPass){
  $.ajax({
    type:'get',
    url :base_url+"Admin/ajaxChangePass/"+userID,
    data:{
      'ajaxuserPass1': userPass1,
      'ajaxhiddenUserPass':hiddenUserPass,
      'ajaxoldPass':oldPass
    },
    success: function(data){
      alert(data);
      $('#logout').trigger('click');
    },
    error:function(data){
      alert(data);
    }
  });
} 
//                                                                                                                                                                                                                                                                                                          