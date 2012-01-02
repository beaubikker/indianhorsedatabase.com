<!-- REYENG HAS BEEN HERE :) -->

<?php
e($this->renderelement('topheader'));
//e($javascript->link('main'));?>
<?php e($html->css('skin1'));?>
<script language="javascript">
	function details(hornamename,horseid) {
		if(parseInt(horseid)) {
			window.location.href='<?php e($html->url('/horse/details/'));?>'+hornamename+'/'+horseid ;		
		}
	}
	$(document).ready(function(){
			$(".offsping").click(function(){
				$("#offsping").toggle("5000");
				document.getElementById("siblings").style.display="none";
			});	
		});		
		$(document).ready(function(){
			$(".siblings").click(function(){
				$("#siblings").toggle("5000");
				document.getElementById("offsping").style.display="none";
			});	 
		});
		
		function offspringshow() {
			$("#offsping").toggle("5000");
			document.getElementById("siblings").style.display="none";
		}
		
		function siblingshow() {
			$("#siblings").toggle("5000");
			document.getElementById("offsping").style.display="none";
		}
			
	function offclose() {
		document.getElementById("offsping").style.display="none";
	}	
	function sibclose() {
		document.getElementById("siblings").style.display="none";
	}	
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});
</script>
<?php
//e($javascript->link('jquerypop'));
e($javascript->link('jquery1'));
?>
<script language="javascript">
	function gajimage() {
		document.getElementById("smaallimage").style.display="block";
	}
	function notimage() {
		document.getElementById("smaallimage").style.display="none";
	}	
	function damimage() {
		document.getElementById("smaallimagefordam").style.display="block";
	}
	function notimagefordam() {
		document.getElementById("smaallimagefordam").style.display="none"; 
	}	
	function damimage1() {
		document.getElementById("smaallimagefordam1").style.display="block";
	}
	function notimagefordam1() {
		document.getElementById("smaallimagefordam1").style.display="none"; 
	}
	function gajimage1() {
		document.getElementById("smaallimage1").style.display="block";
	}
	function notimage1() {
		document.getElementById("smaallimage1").style.display="none";
	}
	function imagereplace(image,width,height) {
		var imagedirectory="horseadditionalimage";
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/"+imagedirectory+"/"+image+" height="+height+" width="+width+" + align=middle>";
	}	
	function mainimagereplace(imagedirectory,image,width,height) {
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/"+imagedirectory+"/"+image+" height="+height+" width="+width+" + align=middle>";
	}	
	function listfirstsirehorseinfo() {
		document.getElementById("smaallimageforfirstsire").style.display="block";
	}	
	function notimageforfirstsire() {
		document.getElementById("smaallimageforfirstsire").style.display="none";
	}
	function listfirstdamhorseinfo() {	
		document.getElementById("smaallimageforfirstdam").style.display="block";		
	}
	function notimageforfirstdam() {
		document.getElementById("smaallimageforfirstdam").style.display="none";		
	}
	function displaysecondsire() {
		document.getElementById("smaallimageforsecondsire").style.display="block";
	}
	function notdisplaysecondsire() {
		document.getElementById("smaallimageforsecondsire").style.display="none";
	}
	function listfrstsireinfo() {
		document.getElementById("smaallimageforsecondsireview").style.display="block";		
	}
	function notlistfrstsireinfo() {
		document.getElementById("smaallimageforsecondsireview").style.display="none";
	}
	function thirddaminfo() {
		document.getElementById("smaallimageforthirdsireview").style.display="block";
	}	
	function notthirddaminfo() {
		document.getElementById("smaallimageforthirdsireview").style.display="none";
	}
	function displaysecondsirethird() {	
		document.getElementById("smaallimageforthirdsireviewthird").style.display="block";
	}
	function notdisplaysecondsirethird() {	
		document.getElementById("smaallimageforthirdsireviewthird").style.display="none";
	}	
	function firsthirerchysiredamfirst() {
		document.getElementById("hirerchyfirst").style.display="block";
	}	
	function notfirsthirerchysiredamfirst() {
		document.getElementById("hirerchyfirst").style.display="none";
	}	
	function firsthirerchysiredamsecond() {	
		document.getElementById("hirerchysecond").style.display="block";		
	}	
	function notfirsthirerchysiredamsecond() {	
		document.getElementById("hirerchysecond").style.display="none";		
	}
	function firsthirerchysiredamthird() {
		document.getElementById("hirerchythird").style.display="block"		
	}
	function notfirsthirerchysiredamthird() {
		document.getElementById("hirerchythird").style.display="none"		
	}
	function firsthirerchysiredamfourth() {
		document.getElementById("hirerchyfourth").style.display="block"	;		
	}
	function notfirsthirerchysiredamfourth() {
		document.getElementById("hirerchyfourth").style.display="none"	;		
	}
	function firsthirerchysiredamfifth() {
		document.getElementById("hirerchyfifth").style.display="block"	;		
	}
	function notfirsthirerchysiredamfifth() {
		document.getElementById("hirerchyfifth").style.display="none"	;		
	}	
	function firsthirerchysiredamsixth() {
		document.getElementById("hirerchysixth").style.display="block"	;		
	}
	function notfirsthirerchysiredamsixth() {
		document.getElementById("hirerchysixth").style.display="none"	;		
	}	
	function firsthirerchysiredamseventh() {
		document.getElementById("hirerchyseventh").style.display="block"	;		
	}
	function notfirsthirerchysiredamseventh() {
		document.getElementById("hirerchyseventh").style.display="none"	;		
	}	
	function firsthirerchysiredameight() {
		document.getElementById("hirerchyeight").style.display="block"	;		
	}
	function notfirsthirerchysiredameight() {
		document.getElementById("hirerchyeight").style.display="none"	;		
	}
	function subscribefornotification(horse_id) {
		if(horse_id) {
			document.getElementById("subsmsg").innerHTML="";
			document.getElementById("unsub").style.display="block";
			document.getElementById("subs").style.display="none";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=processrequesnoti;
				req.open("GET","<?php echo $html->url('/horse/subscribefornotification/');?>"+horse_id,true);	
				req.send(null);					
			}
		}
	}
	function processrequesnoti() {
		if(req.readyState==4)
		{				
			if(req.status==200)
			{			
				//document.getElementById("subsmsg").innerHTML=req.responseText		
				document.getElementById("subsmsg").innerHTML="";			
			}
		}
	}
	function unsubsubscribefornotification(horse_id) {
		if(horse_id) {
			document.getElementById("subsmsg").innerHTML="";			
			document.getElementById("unsub").style.display="none";
			document.getElementById("subs").style.display="block";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=processrequesnoti;
				req.open("GET","<?php echo $html->url('/horse/unsubscribefornotification/');?>"+horse_id,true);	
				req.send(null);					
			}
		}	
	}
	function chkchangerequest(id) {
		if(parseInt(id)) {
			document.getElementById("chkrequestmsg").innerHTML="";
			document.getElementById("subsmsg").innerHTML="";
			document.getElementById("unsubsmsg").innerHTML="";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=chkreq;
				req.open("GET","<?php echo $html->url('/horse/chkrequest/');?>"+id,true);	
				req.send(null);					
			}		
		}
	}	
	function chkreq() {
		if(req.readyState==4)
		{				
			if(req.status==200)
			{			
				if(req.responseText=="1") {
					document.getElementById("chkrequestmsg").innerHTML="<font color=#FF0000>You have already Requested</font><br>";
				}	
				else {
					window.location.href='<?php e($html->url('/horse/changerequest/'.$horseid));?>';
				}	
			}
		}
	}
</script>
</head>
<body>		
	<div id="wrapper_parrent">		
		<?php e($this->renderelement('search'));?> 
		<br clear="all" />
		<div id="wrapper">
		<?php
		e($this->renderelement('frontheader'));			
		?>		
		<div class="sub_body">			
				<div class="upper">
					<div>&nbsp;</div>					
					<?php
					$chksession=$this->requestaction('/user/chksession');
					if($chksession=="") {
						 e($this->renderElement('rightpanel'));						 
					}
					else {
						$usertype=$this->requestaction('/user/usertype');
						if($usertype=="P") {
							$chklogincounter=$this->requestaction('/user/chklogincounter');
							if($chklogincounter<=0) {
								e($this->renderElement('rightpanelpremiumfirst'));	
							}
							else {
								e($this->renderElement('pemiumuservariouslogin'));	
							}	
						}	
						else {
							e($this->renderElement('rightpanelfreeuser'));
						}					
					}
					?>
					<div style="float: left; width: 762px;">	
					<?php
					e($this->renderelement('../horse/forsalebanner'));			
					?>
						


					
					<?php
					$chksession=$this->requestaction('/user/chksession');
					if($chksession=="") {
							e($this->renderelement('../horse/horseprofile-limited'));			
					}
					else {
						$usertype=$this->requestaction('/user/usertype');
						if($usertype=="P") {
							$chklogincounter=$this->requestaction('/user/chklogincounter');
							if($chklogincounter<=0) {
								e($this->renderElement('rightpanelpremiumfirst'));	
							}
							else {
								e($this->renderelement('../horse/horseprofile-full'));			
							}	
						}	
						else {
							e($this->renderelement('../horse/horseprofile-limited'));			
						}					
					}
					?>
					<?php
					?>	



