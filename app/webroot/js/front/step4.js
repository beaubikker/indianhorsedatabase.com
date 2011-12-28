function chk() {
		 var totalcolor = document.getElementById("totcolor").value;
		 var totalart = document.getElementById("totart").value;		
		 
		// var fmobj = document.step;
		 var cntr = 0;
		 var cntart = 0;
		
		for (var i=0;i<totalcolor;i++)
		 {
			  if(document.getElementById("colorcombination_"+i).checked==true) {
			  	cntr++;
			  }  
		 }	
		 
		 for (var j=0;j<totalart;j++)
		 {
			  if(document.getElementById("artwork_"+j).checked==true) {
			  	cntart++;
			  }  
		 }			
		 if(cntr==0) {
		 	document.getElementById("error").style.display="block";
			document.getElementById("msg").innerHTML="Please select color combination <br>for printed box";
			return false
		 }
		 if(cntr > 1) {
		 	document.getElementById("error").style.display="block";
			document.getElementById("msg").innerHTML="Please select only one color combination <br>for printed box";
			return false;
		 }
		 
		  if(cntart==0) {
		 	document.getElementById("error").style.display="block";
			document.getElementById("msg").innerHTML="Please select artwork <br>for printed box";
			return false
		 }
		 if(cntart > 1) {
		 	document.getElementById("error").style.display="block";
			document.getElementById("msg").innerHTML="Please select only one artwork <br>for printed box";
			return false;
		 }
		 
		 
		 
		 
	}// JavaScript Document// JavaScript Document