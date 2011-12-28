// JavaScript Document
var refer=true;
var refer1=true;

function chartD()
{
	if (refer) 
	{
		//document.getElementById("bfree").src='images/freea.gif';
		//document.getElementById("bv3").src='images/v3b.gif';
		
		document.getElementById("free").style.display='';
		document.getElementById("v3").style.display='none';
		
		refer=false;
		refer1=true;	
	}
	else 
	{
		document.getElementById("free").style.display='none';
		refer=true;
	}
}
function chartD1()
{
	if (refer1) 
	{
		//document.getElementById("bfree").src='images/freeb.gif';
		//document.getElementById("bv3").src='images/v3a.gif';
		
		document.getElementById("v3").style.display='';
		document.getElementById("free").style.display='none';
		
		refer1=false;
		refer=true;
	}
	else 
	{
		document.getElementById("v3").style.display='none';
		refer1=true;
	}
}

