function chkcustom(){
	
	var description = $("#description").val();
	var customimage = $("#customimage").val();
	var L = $("#L").val();
	var W = $("#W").val();
	var D = $("#D").val();
	
	var contactname = $("#contactname").val();
	var emailadd = $("#emailadd").val();
	
	var msg='';
	
	if(L =="")
	{
		//dispAlert('Please enter your H value!');
		//$("#H").focus();
		//return false;
		msg =" * Please enter your H value! <br>";
		
	}
	
	
	if(W=="")
	{
		//dispAlert('Please enter your W value!');
		//$("#H").focus();
		//return false;
		msg =msg+" * Please enter your W value! <br>";
	}
	
	if(D=="")
	{
		//dispAlert('Please enter your D value!');
		//$("#D").focus();
		//return false;
		msg =msg+" * Please enter your D value! <br>";
	}
		
	if(description=="")
	{
		//dispAlert('Please enter description!');
		//$("#description").focus();
		//return false;
		msg =msg+" * Please enter your description! <br>";
	}
	if(customimage=="")
	{
		//dispAlert('Please enter your image!');		
		//return false;
		msg =msg+" * Please upload your image! <br>";
	}
	
	if(contactname=="")
	{
		//dispAlert('Please enter your image!');		
		//return false;
		msg =msg+" * Please enter  your contact name! <br>";
	}
	
	if(emailadd=="")
	{
		//dispAlert('Please enter your image!');		
		//return false;
		msg =msg+" * Please enter  your email address! <br>";
	}
	if(emailadd!="")
	{
			var x =emailadd;
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (filter.test(x)==false)
			{	
				//dispAlert("Please enter valid  email");
				//$("#email").select();
				//return false;
				msg= msg+" * Please enter a vaild email address!<br>";
			}
	 }
	
	
	
	
		if(msg !=""){
			dispAlert(msg);	
			return false;
		}else{
			return true;
		}
	}




function dispAlert(str){ 

	$("#error").show();
	$("#msg").html(str);
	//$("#errmsg").removeClass("alerthide");
	//$("#errmsg").addClass("alertshow");
	
	
}

function closediv(){ 
	$("#error").hide();
	
	}


