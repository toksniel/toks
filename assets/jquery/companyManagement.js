function archiveCompany(id,recStat){
  $.ajax({
    type:'get',
    url :base_url+"Company/ajaxArchiveCompany",
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
//do thisssssss
function perUserEdit(userName,userLastName,userFirstName,userJobDesc){
  $.ajax({
    type:'get',
    url :base_url+"Admin/ajaxPerUserEdit/"+userID,
    data:{
      'ajaxUserName': userName,
      'ajaxUserLname': userLastName,
      'ajaxUserFname': userFirstName,
      'ajaxUserJob' : userJobDesc
    },
    success: function(data){
      $('#logout').trigger('click');
    },
    error:function(){
      alert("Error");
    }
  });
}
function addCompany2(companyName,companyType,companyIndustry,addContType,addRegionID, addDistrict,addCity, addTown,addStreet,addBldg,addZip, dataEmail, dataEmailLabel, dataPhoneCode, dataPhone, dataPhoneLabel, dataurl, dataurlLabel){
  $.ajax({
    type: 'get',
    url: base_url+"Welcome/ajaxSavingCompany/",
    data:{
      'ajaxCompName': companyName,
      'ajaxCompType': companyType,
      'ajaxCompIndustry': companyIndustry,
      'ajaxContType':addContType,
      'ajaxRegion': addRegionID,
      'ajaxDistrict': addDistrict,
      'ajaxCity': addCity,
      'ajaxTown': addTown,
      'ajaxStreet': addStreet,
      'ajaxBldg': addBldg,
      'ajaxZip': addZip,
      'ajaxArrEmail': JSON.stringify(dataEmail),
      'ajaxArrEmailLbl': JSON.stringify(dataEmailLabel),
      'ajaxArrPhoneCode': JSON.stringify(dataPhoneCode),
      'ajaxArrPhone': JSON.stringify(dataPhone),
      'ajaxArrPhoneLbl': JSON.stringify(dataPhoneLabel),
      'ajaxArrURL': JSON.stringify(dataurl),
      'ajaxArrURLLbl':JSON.stringify(dataurlLabel)
    },
    success: function(data){
      location.reload();

    },error:function(){
      alert("Error");
    }
  } );
}
function updateCompany(companyName,companyType,companyIndustry,addContType,addRegionID, addDistrict,addCity, addTown,addStreet,addBldg,addZip){
  $.ajax({
    type: 'get',
    url: base_url+"Company/ajaxUpdateCompany/"+companyID,
    data:{
      'ajaxCompName': companyName,
      'ajaxCompType': companyType,
      'ajaxCompIndustry': companyIndustry,
      'ajaxContType':addContType,
      'ajaxRegion': addRegionID,
      'ajaxDistrict': addDistrict,
      'ajaxCity': addCity,
      'ajaxTown': addTown,
      'ajaxStreet': addStreet,
      'ajaxBldg': addBldg,
      'ajaxZip': addZip,
    },
    success: function(data){
      location.reload();
    },error:function(){
      alert("Error");
    }
  });
}
function addCompany1111(addContType, dataEmail, dataEmailLabel, dataPhoneCode, dataPhone, dataPhoneLabel, dataurl, dataurlLabel){
  $.ajax({
    type: 'get',
    url: base_url+"Company/ajaxxxxx/"+companyID,
    data:{
      'ajaxContType':addContType,
      'ajaxArrEmail': JSON.stringify(dataEmail),
      'ajaxArrEmailLbl': JSON.stringify(dataEmailLabel),
      'ajaxArrPhoneCode': JSON.stringify(dataPhoneCode),
      'ajaxArrPhone': JSON.stringify(dataPhone),
      'ajaxArrPhoneLbl': JSON.stringify(dataPhoneLabel),
      'ajaxArrURL': JSON.stringify(dataurl),
      'ajaxArrURLLbl':JSON.stringify(dataurlLabel)
    },
    success: function(data){
    },error:function(){
      alert("Error");
    }
  } );
}
function getValDynamically(subArr, dynaKind, dataVal, dataSubVal, dataC){
  for(x=0; x<subArr.length; x++){
    event.preventDefault();
    idIndecator = subArr[x];
    var valueText = $('#'+dynaKind+dataC+idIndecator).val();
    var valueLabel = $('#label'+dynaKind+dataC+idIndecator).val();
    dataVal.push(valueText);
    dataSubVal.push(valueLabel);
  }
}
function getValDynamically2(subArr, dynaKind, dataVal, dataSubVal1, dataSubVal2, dataC){
  for(x=0; x<subArr.length; x++){
      event.preventDefault();
      idIndecator = subArr[x];
      var valueText = $('#'+dynaKind+dataC+idIndecator).val();
      var valueCode = $('#combo-'+dynaKind+"code"+dataC+idIndecator).val();
      var valueLabel = $('#label'+dynaKind+dataC+idIndecator).val();
      dataVal.push(valueText);
      dataSubVal1.push(valueLabel);
      dataSubVal2.push(valueCode);
    }
}
