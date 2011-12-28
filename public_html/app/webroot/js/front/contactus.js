function checkcontact(){
	
	var name = $("#name").val();
	var email = $("#email").val();
	var company = $("#company").val();
	var comments = $("#comments").val();
	var msg ='';
	
	if(name=="")
	{
		//dispAlert('Please enter your name!');
		//$("#name").focus();
		//return false;
		msg=" * Please enter your name!<br>";
		
	}
	
	
	if(email=="")
	{
		//dispAlert('Please enter email address!');
		//$("#email").focus();
		//return false;
		msg= msg+" * Please enter your email address!<br>";
	}
	
	
	if(email!="")
	{
			var x =email;
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (filter.test(x)==false)
			{	
				//dispAlert("Please enter valid  email");
				//$("#email").select();
				//return false;
				msg= msg+" * Please enter a vaild email!<br>";
			}
	 }
	
	
	if(company=="")
	{
		//dispAlert('Please enter company name!');
		//$("#company").focus();
		//return false;
		msg= msg+" * Please enter company name!<br>";
	}
	if(comments=="")
	{
		//dispAlert('Please enter your comments!');
		//$("#comments").focus();
		//return false;
		msg= msg+" * Please enter your comments!<br>";
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
}

function closediv(){ 
	$("#error").hide();
	
	}
