function chk() {
		 var fmobj = document.step3;
		 var cntr=0;
		 for (var i=0;i<fmobj.elements.length;i++)
		 {
			  if(fmobj.elements[i].checked==true) {
			  	cntr++;
			  }  
		 }	
		 if(cntr==0) {
		 	document.getElementById("error").style.display="block";
			document.getElementById("msg").innerHTML="Please select atleast one color";
			return false
		 }
		 if(cntr>1) {
			 document.getElementById("error").style.display="block";
			 document.getElementById("msg").innerHTML="You cannot select more than one color";
			 return false
		 }
		 else {
		 	//document.step3.submit();
		 }
	}// JavaScript Document