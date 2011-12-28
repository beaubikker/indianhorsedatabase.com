function valid() {
		var msg='';
		var quantity = $("#quantity").val();		
		var CustomerCompanyname = $("#CustomerCompanyname").val();		
		var CustomerContactname = $("#CustomerContactname").val();
		var CustomerEmail = $("#CustomerEmail").val();
		var CustomerZip = $("#CustomerZip").val();		
		
		if(quantity=="" || quantity ==0 || isNaN(quantity)) {		
			msg=msg+'Please Provide order quantity . <br>';
		}
		if(CustomerCompanyname=="") {		
			msg=msg+'Please Provide company name <br>';
		}
		if(CustomerContactname=="") {		
			msg=msg+'Please Provide customer contact name <br>';
		}
		if(CustomerEmail=="") {		
			msg=msg+'Please Provide customer email address<br> ';
		}		
		if(CustomerEmail!="") {
			if (echeck(CustomerEmail)==false){
				msg=msg+'Please Provide valid customer email address<br> ';				
			}					
		}		
		if(msg !=""){
			dispAlert(msg);	
			return false;
		}else{
			//document.step.submit();
		}
	} 
	function echeck(str) {
			var at="@"
			var dot="."
			var lat=str.indexOf(at)
			var lstr=str.length
			var ldot=str.indexOf(dot)
			if (str.indexOf(at)==-1){
				  return false
			}
			if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
				return false
			}
		
			if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
				return false
			}
		
			 if (str.indexOf(at,(lat+1))!=-1){
				return false
			 }
		
			 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
				return false
			 }
		
			 if (str.indexOf(dot,(lat+2))==-1){
				return false
			 }
			
			 if (str.indexOf(" ")!=-1){
				return false
			 }
			 return true					
		}	
	function dispAlert(str){
		$("#error").show();
		$("#msg").html(str);			
	}	