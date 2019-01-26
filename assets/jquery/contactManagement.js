function addContact(contLastName,contFirstName,contMiddleName,contPrefix,contSuffix,contSource,addContType,addRegionID,
		addDistrict,addCity, addTown,addStreet,addBldg,addZip,
		dataEmail, dataEmailLabel, dataPhoneCode, dataPhone, dataPhoneLabel, dataurl, dataurlLabel, allTags, ctAssigned,contTypeR){
		$.ajax({
			type: 'get',
			url: base_url+"Welcome/ajaxSavingContacts/"+ccTR,
			data:{
				'ajaxLastName': contLastName,
				'ajaxFirstName': contFirstName,
				'ajaxMiddleName': contMiddleName,
				'ajaxPrefix': contPrefix,
				'ajaxSuffix': contSuffix,
				'ajaxSource': contSource,
				'ajaxContType':addContType,
				'ajaxRegion': addRegionID,
				'ajaxDistrict': addDistrict,
				'ajaxCity': addCity,
				'ajaxContRType' : contTypeR,
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
				'ajaxArrURLLbl':JSON.stringify(dataurlLabel),
				'ajaxAllTags':JSON.stringify(allTags),
				'ajaxAssigned': ctAssigned
			},
			success: function(data){
				getmyID();
				location.reload();
			},error:function(){
				alert("Error");
			}
		});
	}
	function addCompany(comName,comType,comIndustry,addContType,addRegionID, addDistrict,addCity, addTown,addStreet,addBldg,addZip, dataEmail, dataEmailLabel, dataPhoneCode, dataPhone, dataPhoneLabel, dataurl, dataurlLabel){
		$.ajax({
			type: 'get',
			url: base_url+"Welcome/ajaxSavingCompany",
			data:{
				'ajaxCompName': comName,
				'ajaxCompType': comType,
				'ajaxCompIndustry': comIndustry,
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
				 refdata();
				 $('#companySearch').trigger('click');
				 /*<br>
                        <div class="row">
                          <div class="col-sm-8">
                            <div style="box-sizing:content-box; border: 1px solid gray; padding: 5px;" class="roundedRec">
                              <div class="row">
                                <div class="col-sm-6">
                                  COMPANY NAME
                                </div>
                                <div class="col-sm-2">
                                  <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                                </div>
                                <div class="col-sm-4">
                                  <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6" style="font-size: 10px; color: gray;">
                                  COMPANY NAME
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        */
			},error:function(){
				alert("Error");
			}
		});
	}
	function getRegion(countryVal, comboName){
		$.ajax({
			type: 'get',
			url: base_url+"Welcome/ajaxGetRegion",
			dataType: "json",
			data:{
				'ajaxCountryVal': countryVal
			},
			success: function(data){
				$('#'+comboName).empty();
				$('#'+comboName).append('<option value="0" disabled>Select Region</option>');
				$.each(data, function(key, value)
					{
						$('#'+comboName).append('<option value="'+ value.regionID +'">'+ value.regionName +'</option>');
					});
			},
			error: function(){
				alert("Error");
			}
		});
	}
	function removeValInArray(arraySubj, idSubj){
		for(var i = 0; i<arraySubj.length; i++){
			var subjIDs = arraySubj[i];
			if(subjIDs == idSubj){
				arraySubj.splice(i,1);
			}
		}
	}
	function removeAdditionalText(allText, numRemove){
		var finalText = allText.substring(numRemove);
		return finalText;
	}
	function dynamicRemove(name, id){
		$('#'+name+id).remove();
	}
	function fillComboDynamic(arrayUse, comboID, count, arrayVal){
		for(var x = 0; x < arrayUse.length; x++){
			$('#'+comboID+count).append("<option value='"+ arrayVal[x] +"' >"+ arrayUse[x] +"</option>");
		}
	}
	function numberOnly(id){
		$('#'+id).on('keypress input', function() {
      var value = $('#'+id).val();
      value = value.replace(/\D+/, '');
      $('#'+id).val(value);
      });
	}
	function enableDisableAddBtn(dynamicField, addName){
		var emptyInputs = $('#'+dynamicField).find('.required').filter(function() {
        return $.trim($(this).val() ) == ""
      }).length;
      $('#'+addName).prop('disabled', emptyInputs);
	}
	function getValDynamicallySingle(subArr, dynaKind, dataVal, dataC){
		for(x=0; x<subArr.length; x++){
        event.preventDefault();
        idIndecator = subArr[x];
        var valueText = $('#'+dynaKind+dataC+idIndecator).val();
        dataVal.push(valueText);
      }
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
	function disableButton(name){
		$('#'+name).prop('disabled', true);
	}
	function remove_duplicate_in_array(arra1) {
		var i,
		len=arra1.length,
		result = [],
		obj = {};
		for (i=0; i<len; i++)
		{
			obj[arra1[i]]=0;
		}
		for (i in obj) {
			result.push(i);
		}
		return result;
  }
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
	function addCompany2(comName,comType,comIndustry,addContType,addRegionID, addDistrict,addCity, addTown,addStreet,addBldg,addZip, dataEmail, dataEmailLabel, dataPhoneCode, dataPhone, dataPhoneLabel, dataurl, dataurlLabel){
		$.ajax({
			type: 'get',
			url: base_url+"Welcome/ajaxSavingCompany",
			data:{
				'ajaxCompName': comName,
				'ajaxCompType': comType,
				'ajaxCompIndustry': comIndustry,
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
		});
	}
//                                                                       