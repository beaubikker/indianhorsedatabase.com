	function video() {
		document.getElementById("video_com").style.display="block";
		document.getElementById("youtube_com").style.display="none";	
	}	
	function youtube() {
		document.getElementById("video_com").style.display="none";
		document.getElementById("youtube_com").style.display="block";	
	}
	function moreimg() {
		var hiddval=document.getElementById("hiddval").value;
		hiddval++;
		var i;
		var msg='';
		if(hiddval) {
			for(i=1;i<=hiddval;i++) {
				msg=msg+"<span id=imagsh_"+i+"><input type=file class=button1 name=img_"+i+" id=img_"+i+">&nbsp&nbsp;<input type=button value=Cancel class=button onclick=can('"+i+"') id=can_"+i+" style=cursor:pointer><br></span>";			
			}	
			document.getElementById("imgval").innerHTML=msg;
		}
		document.getElementById("hiddval").value=hiddval;
	}	
	function can(no) {
		if(no) {
			document.getElementById("img_"+no).style.display="none";
			document.getElementById("can_"+no).style.display="none";
			document.getElementById("imagsh_"+no).style.display="none";			
			no--;
			document.getElementById("hiddval").value=no ;
		}
	}
