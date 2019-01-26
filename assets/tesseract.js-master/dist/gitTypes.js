
function getNumber(){
	var stringLength = ocrTExt.length+1;
	 console.log("\n\n\n" + ocrTExt);
	for(var x=0; x< stringLength; x++){
		ocrChar = ocrTExt[x];
		var y = x +1;
		var z = x - 1;
		var ocrChar2 = ocrChar + ocrTExt[y];
		var ocrChar3 = ocrTExt[y];
		
			
			if( (ocrChar2=="\\n" || ocrChar == "/" || ocrChar == "*"  ) && flag=="true" && ocrString){

				var IndNum = /^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/;
				subString = ocrString;
				subString = subString.replace("(","");
				subString = subString.replace(")","");
				subString = subString.replace("-","");
				subString = subString.replace(/ /g,'');
				subString = subString.replace(/[a-zA-Z]/g,'0');
				
				console.log(subString);
				var intMobile = parseInt(subString);
			    if(IndNum.test(subString) && intMobile > 100000){
			    	var countryCode = subString[0]+subString[1];
			    	var countryCode1 = subString[0]+subString[1]+subString[2];
			    	var countryCode2 = subString[0]+subString[1]+subString[3]+subString[4];
			    	if(country.length <1 ){
			    		if (countryCode1=="+63" || countryCode =="09" || countryCode =="63") {
			    			country ="Philippines";
			    		}

			    		$('#location').append('<label contenteditable="true">Country</label>');
			    		$('#location').append('<input class="form-control" type="text" value="'+country+'" > ');
			    	}

			         $('#mobile').append('<label>Mobile</label>');
					$('#mobile').append('<input class="form-control" type="text" value="'+subString+'" > ');

					ocrTExt = ocrTExt.replace(ocrString ,"");
					x=0;
					 //console.log("\n\n\n" + ocrTExt);
					   stringLength = ocrTExt.length+1;
					
			    }
			   


			  
					
				ocrString ="";
				
				flag="false";
				
			}

		
		if(ocrChar == "0" || ocrChar == "+" || ocrChar == "(" || flag == "true"){
			flag = "true";
		}else{
			flag = "false";
		}

		if( flag == "true"){
				ocrString += ocrChar;
		}
		//console.log(ocrChar + " =  " + flag);

	}
}