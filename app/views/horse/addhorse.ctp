<!-- REYENG HAS BEEN HERE :) -->

<?php
e($this->renderelement('topheader'));
$listhorst=$this->requestAction('/horse/listhorse');
if(is_array($listhorst)) {
	 	$data='';
	 	foreach($listhorst as $key=>$val) {
			$data.=$val['Horse']['name'].",";		
		} 
	} 
?> 
 <?php
 e($javascript->link('autocomplete'));
 ?>
	<script>	
	$(document).ready(function(){
	var data = "<?php e($data);?>".split(",");
	//$("#HorseName").autocomplete(data);
	 });
	</script>
<script type="text/javascript">	
	$(document).ready(function(){
		$(".changepic").click(function(){
			$("#changepic").toggle("slow");
		});	
	});	
	$(document).ready(function(){
		$(".utubelink").click(function(){
			$("#utubelink").toggle("slow");
			document.getElementById("videpfromserver").style.display="none";
		});	
	});	
	$(document).ready(function(){
		$(".videpfromserver").click(function(){
			$("#videpfromserver").toggle("6200");
			document.getElementById("changepic").style.display="none";
		});	
	});	
	
	function closevideo() {
		$("#videpfromserver").toggle("6200");
		document.getElementById("changepic").style.display="none";	
	}
	function addtownvalid() {
			var Horsestate=document.getElementById("Horsestate").value;	
			var HorseCountry=document.getElementById("HorseCountry").value;	
			var addadditionaltown=document.getElementById("addadditionaltown").value;	
			var err=0;
			if(HorseCountry=="") {
				document.getElementById("HorseCountry").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("HorseCountry").style.border = "1px solid #7F9DB9";
			}
			if(Horsestate=="") {
				document.getElementById("Horsestate").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("Horsestate").style.border = "1px solid #7F9DB9";
			}
			if(addadditionaltown=="") {
				document.getElementById("addadditionaltown").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("addadditionaltown").style.border = "1px solid #7F9DB9";
			}
			if(err==0) {
				document.getElementById("showtownmsg").innerHTML=""
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
					req.onreadystatechange=processrequestadditionaltown;
					req.open("GET","<?php echo $html->url('/horse/additionaltown/');?>"+HorseCountry+"/"+Horsestate+"/"+addadditionaltown,true);	
					req.send(null);					
				}			
			}			
	}	
	
	function processrequestadditionaltown() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("showtownmsg").innerHTML=""	;					
					listtownanother();		
					donemsg();										
				}
			}	
	}
	
	function donemsg() {
		document.getElementById("addtown").style.display="none";	
		document.getElementById("showtownmsg").style.display="none";	
	}
	
	
	
	function youtubelickclose() {
		$("#utubelink").toggle("6200");
		document.getElementById("videpfromserver").style.display="none";
	}	
	function showmulimage() {
		var num=4;
		var msg='';
		var divval='';
		var cntr=0;
		var divclass='';
		if(parseInt(num)) {	
				if(num>4) {
					msg='<font color=#FF0000><em><b>You cannot upload more than 8 pictures </b></em></font>'
				}
				else {
					document.getElementById("hiddval").value=parseInt(num);
					for(i=1;i<=num;i++) {
						if(cntr%2==0) {
							divclass='left';
						}
						else {
							divclass='right';
						}
						divval='<div class='+divclass+'><div class="pox"><strong>Image '+i+':</strong><input	type="file"	 name=image_'+i+'></div></div>';
						msg=msg+divval;	
						cntr++;			
					}	
					msg=msg+'<input class="submit_btn100" type="button" value="Upload"	 onclick="addpicture()" style="cursor:pointer; width: 120px; margin-top: 0; margin-bottom: 20px;"/>';
				}
				document.getElementById("imgshow").innerHTML=msg;		
				document.getElementById("num").value=8;	
				document.getElementById("hiddval").value=8;								
			}	
	}
	
	
	function addpicture() {
		$("#changepic").toggle("slow");	
	}	
	function closediv() {
		$("#changepic").toggle("slow");	
	}	
	function frmsub() {
		document.frm.submit();	
	}
	function listingextinghorse() {
		document.getElementById("listhorse").style.display="block";
		document.getElementById("horsemessage").style.display="none";
		var horsename=document.getElementById("HorseName").value;
		var len=horsename.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlisthorse;
					req.open("GET","<?php echo $html->url('/horse/listhorseindatabase/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listhorse").innerHTML="" ;
			}
	}	
	
	function assignoffspring(horsename) {
		document.getElementById("Offspring").value=horsename;
		document.getElementById("listforoffspring").style.display="none";
	}	
	function listoffspring() {
		var horsename=document.getElementById("Offspring").value;
		var len=horsename.length;
			if(len>1){
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
					req.onreadystatechange=listoffspringoff;
					req.open("GET","<?php echo $html->url('/horse/listoffspring/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listforoffspring").innerHTML="" ;
			}	
	}
	
	function listoffspringoff() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("listforoffspring").innerHTML=req.responseText					
				}
			}		
		}
	
		
	function listmemberowner() {
		document.getElementById("listowner").style.display="block";
		var HorseOwnername=document.getElementById("HorseOwnername").value;
		var len=HorseOwnername.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlisthorselistowner;
					req.open("GET","<?php echo $html->url('/horse/listownerall/');?>"+HorseOwnername,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listowner").innerHTML="" ;
			}
	}	
	
	function liststable() {
		var HorseStablename=document.getElementById("HorseStablename").value;
		document.getElementById("liststb").style.display="block";
		var len=HorseStablename.length;
			if(len>1){
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
					req.onreadystatechange=processrequestliststableall;
					req.open("GET","<?php echo $html->url('/horse/liststableall/');?>"+HorseStablename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("liststb").innerHTML="" ;
			}	
	}
	
	
	function nostable() {
		//document.getElementById("HorseStablename").value=stable_name;
		document.getElementById("liststb").style.display="none";
	//	document.getElementById("loc").innerHTML="";	
	}
			
	function listbred() {
		var HorseBredName=document.getElementById("HorseBredName").value;
		document.getElementById("listbed").style.display="block";
		var len=HorseBredName.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlistbredall;
					req.open("GET","<?php echo $html->url('/horse/listbredall/');?>"+HorseBredName,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listbed").innerHTML="" ;
			}	
	}	
	
	function assignbred(stable_id,stable_name) {
		document.getElementById("HorseBredName").value=stable_name;
		document.getElementById("listbed").style.display="none";
	}	
	function processrequestliststableall() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					if(req.responseText==0) {
						//document.getElementById("HorseStablename").value='';
					}
					else {
						document.getElementById("liststb").innerHTML=req.responseText
					}					
				}
			}
		}	
		
		function processrequestlistbredall() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("listbed").innerHTML=req.responseText					
				}
			}		
		}			
		function assignstable(stable_id,stable_name) {
			document.getElementById("HorseStablename").value=stable_name;
			document.getElementById("liststb").style.display="none";
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
					req.onreadystatechange=liststableallcountrytownn;
					req.open("GET","<?php echo $html->url('/horse/liststableallcountrytownn/');?>"+stable_id,true);	
					document.getElementById("loc").innerHTML="<font color=#FF0000>Please wait....</font>";
					req.send(null);					
				}
		}
		
		function liststableallcountrytownn() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("loc").innerHTML=req.responseText					
				}
			}
		}		
		
		function notliststable() {
			document.getElementById("liststb").style.display="none";
		}
		
	 function processrequestlisthorselistowner() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("listowner").innerHTML=req.responseText					
				}
			}
		}			
	function notlistmemberowner() {
		document.getElementById("listowner").style.display="none";
	}	
	function assignowner(firstname,lastname,user_id) {
		document.getElementById("HorseOwnername").value=firstname+" "+lastname;
		document.getElementById("listowner").style.display="none";
		document.getElementById("hiddownerid").value=user_id;
	}	
	function assignmember(firstname,lastname,breederid) {
		document.getElementById("hiddbreederid").value=breederid;
		document.getElementById("HorseBreeder").value=firstname+" "+lastname;
		document.getElementById("listmem").style.display="none";
	}		
	function listmemberall() {
		document.getElementById("listmem").style.display="block";
		var HorseBreeder=document.getElementById("HorseBreeder").value;
		var len=HorseBreeder.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlisthorsemember;
					req.open("GET","<?php echo $html->url('/horse/listallmember/');?>"+HorseBreeder,true);	
					req.send(null);					
				}		
			}
		if(len<=1) {
			document.getElementById("listmem").innerHTML="" ;
		}
	}		
		function notlistmemberall() {
			document.getElementById("listmem").style.display="none";
		}
		function processrequestlisthorsemember() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{	
					document.getElementById("listmem").innerHTML=req.responseText					
				}
			}
		}
	
	function listingextinghorsesire() {
		document.getElementById("listsirehorse").style.display="block";
		var horsename=document.getElementById("HorseSire").value;
		var len=horsename.length;
		if(len>1){
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
					req.onreadystatechange=processrequestlisthorsesire;
					req.open("GET","<?php echo $html->url('/horse/listsirehorsedatabase/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listsirehorse").innerHTML="" ;
			}
		}		
		function assignsire(horsename,sireid) {
			document.getElementById("HorseSire").value=horsename;
			document.getElementById("hiddsireval").value=sireid;
			document.getElementById("listsirehorse").style.display="none";
		}
			
		function assigndam(horsename,horse_id) {
			document.getElementById("HorseDam").value=horsename;
			document.getElementById("hidddamval").value=horse_id;			
			document.getElementById("listsiredam").style.display="none";
		}		
		
		function showdeathfild() {
			document.getElementById("deathfield").style.display="block" ;
			blankallautocomplete() ;
		}		
		function dontshowdeathfild(){
			document.getElementById("deathfield").style.display="none" ;	
			blankallautocomplete() ;	
		}		
		function showregister() {
			document.getElementById("regcode").style.display="block" ;
			blankallautocomplete() ;	
		}
		function dontshowregister() {
			document.getElementById("regcode").style.display="none" ;
			blankallautocomplete() ;	
		}	
	function listingextinghorsedam() {
		document.getElementById("listsiredam").style.display="block";
		var horsename=document.getElementById("HorseDam").value;
		var len=horsename.length;
		if(len>1){
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
					req.onreadystatechange=processrequestlisthorsedam;
					req.open("GET","<?php echo $html->url('/horse/listdamhorsedatabase/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listsiredam").innerHTML="" ;
			}
		}		
		
		function notlistingextinghoredam() {
			document.getElementById("listsiredam").style.display="none";
		}		
		function processrequestlisthorsedam() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					document.getElementById("listsiredam").innerHTML=req.responseText					
				}
			}
		}	
	function processrequestlisthorsesire() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					document.getElementById("listsirehorse").innerHTML=req.responseText					
				}
			}
		}		
		function processrequestlisthorse() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					document.getElementById("listhorse").innerHTML=req.responseText					
				}
			}
		}		
		function notlistingextinghorsesire() {
			document.getElementById("listsirehorse").style.display="none";
		}			
	function noofimages() {
		var num=document.getElementById("num").value;
		var msg='';
		var divval='';
		var cntr=0;
		var divclass='';
		if(parseInt(num)) {	
				if(num>8) {
					msg='<font color=#FF0000><em><b>You cannot upload more than 8 pictures </b></em></font>'
				}
				else {
					document.getElementById("hiddval").value=parseInt(num);
					for(i=1;i<=num;i++) {
						if(cntr%2==0) {
							divclass='left';
						}
						else {
							divclass='right';
						}
						divval='<div class='+divclass+'><div class="pox"><strong>Image '+i+':</strong><input	type="file"	 name=image_'+i+'></div></div>';
						msg=msg+divval;	
						cntr++;			
					}	
					msg=msg+'<input class="submit_btn100" type="submit" value="Upload" />';
				}
				document.getElementById("imgshow").innerHTML=msg;	
							
			}		
		}	
		function chkhorse() {
			document.getElementById("listhorse").style.display="none";
			document.getElementById("horsemessage").style.display="block";
			var horsename=document.getElementById("HorseName").value;
			var len=horsename.length;
			if(len>2){
				document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>Checking please wait ......</em></b></font>";
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
					req.onreadystatechange=processrequest;
					req.open("GET","<?php echo $html->url('/horse/chkhorse/');?>"+horsename,true);	
					req.send(null);					
				}
			}
		}		
		function processrequest() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					if(req.responseText==1) {
						//document.getElementById("valid").disabled=true;
						document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>This horse exists</em></b></font>";
					}
					else {
						//document.getElementById("valid").disabled=false;
						document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>You can use this horse</em></b></font>";
					}						
				}
			}
		}		
		function Chkvalidation() {
			var err=0;
			var horsename=document.getElementById("HorseName").value;
			var gender=document.getElementById("gender").value;
			var breed=document.getElementById("breed").value;
			var year=document.getElementById("year").value;
			var height=document.getElementById("height").value;
			var coatcolor_id=document.getElementById("coatcolor_id").value;	
			var HorseLocation=document.getElementById("HorseLocation").value;
			var HorseCountry=document.getElementById("HorseCountry").value;
			var HorseOtherDetails=document.getElementById("HorseOtherDetails").value;
			var Horsestate=document.getElementById("Horsestate").value;		
			if(Horsestate=="") {
				document.getElementById("Horsestate").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("Horsestate").style.border = "1px solid #7F9DB9";
			}				
			if(document.getElementById("nameunknownoption").checked==false) {
				if(horsename=="") {
					document.getElementById("HorseName").style.border = "1px solid #FF0000";
					err++;		
				} 
				else {
					document.getElementById("HorseName").style.border = "1px solid #7F9DB9";
				}
			}
			if(gender=="") {
				document.getElementById("gender").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("gender").style.border = "1px solid #7F9DB9";
			}
			if(breed=="") {
				document.getElementById("breed").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("breed").style.border = "1px solid #7F9DB9";
			}
			if(height=="") {
				document.getElementById("height").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("height").style.border = "1px solid #7F9DB9";
			}
			if(coatcolor_id=="") {
				document.getElementById("coatcolor_id").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("coatcolor_id").style.border = "1px solid #7F9DB9";
			}
			if(coatcolor_id=="") {
				document.getElementById("coatcolor_id").style.border = "1px solid #FF0000"; 
				err++;		
			} 
			else {
				document.getElementById("coatcolor_id").style.border = "1px solid #7F9DB9";
			}	
			if(HorseLocation=="") {
				document.getElementById("HorseLocation").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("HorseLocation").style.border = "1px solid #7F9DB9";
			}	
			if(HorseCountry=="") {
				document.getElementById("HorseCountry").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("HorseCountry").style.border = "1px solid #7F9DB9";
			}				
			if(HorseOtherDetails=="") {
				document.getElementById("HorseOtherDetails").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("HorseOtherDetails").style.border = "1px solid #7F9DB9";
			}	
			if(err==0) {
				document.getElementById("showmsg").style.display="block";
				document.getElementById("showmsg").innerHTML='We are processing your information, thank you for your patience....';
				document.horseinfo.submit();			
			}		
		}			
	 function liststate() {
	 		blankallautocomplete();
			var HorseCountry=document.getElementById("HorseCountry").value;
			if(parseInt(HorseCountry)) {
				document.getElementById("showregion").innerHTML="<font color=#000>......finding those states for you</font>";
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
					req.onreadystatechange=processrequestlistate;
					req.open("GET","<?php echo $html->url('/state/liststate/');?>"+HorseCountry,true);	
					req.send(null);					
				}
			}
		}		
		
	function processrequestlistate() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("showregion").innerHTML=req.responseText;									
				}
			}
		}		
		function listtown() {
			var Horsestate=document.getElementById("Horsestate").value;
			blankallautocomplete();
			if(parseInt(Horsestate)) {
				document.getElementById("showtown").innerHTML="<font color=#000>.....looking for the cities</font>";
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
					req.onreadystatechange=processrequestlisttown;
					req.open("GET","<?php echo $html->url('/town/listtown/');?>"+Horsestate,true);	
					req.send(null);					
				}
			}		
		}
		
		function processrequestlisttown() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("showtown").innerHTML=req.responseText;		
					document.getElementById("addtown").style.display="block";	
					document.getElementById("showtownmsg").style.display="block";		
					document.getElementById("addadditionaltown").value="";									
				}
			}
		}	
		
		
	function	listtownanother() {
		var Horsestate=document.getElementById("Horsestate").value;
			blankallautocomplete();
			if(parseInt(Horsestate)) {
				document.getElementById("showtown").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestlisttownanother;
					req.open("GET","<?php echo $html->url('/town/listtown/');?>"+Horsestate,true);	
					req.send(null);					
				}
			}
	}
	
	
	function processrequestlisttownanother() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("showtown").innerHTML=req.responseText;														
				}
			}
		}
	</script>
	
	
	
<!-- REYENG	 -->
	 <script src="/js/jquery.tools.min.js"></script>  
<!-- /REYENG	 -->



 </head>
<body onLoad="showmulimage()">	
<!-- REYENG	 -->
<div style="display:none;">
<?php
include('inc_tooltip/tooltip_strings.php');
?>
</div>	
<!-- /REYENG	 -->
	<form id="addedithorseform" action="#" method="post" name="horseinfo" enctype="multipart/form-data" autocomple="off">
	<input type="hidden" id="hiddval" name="hiddval" value="4">
	<input type="hidden" name="hiddsireval" value="" id="hiddsireval">
	<input type="hidden" name="hidddamval" value="" id="hidddamval">
	<input type="hidden" name="hiddownerid" value="" id="hiddownerid">
	<input type="hidden" name="hiddbreederid" value="" id="hiddbreederid">
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
				<h1 class="top">Add new horse</h1>
			<?php e($form->hidden('Horse.posted_date',array("value"=>date('Y-m-d')))); ?>	
			<div class="profile_info">
				<?php
				$horname='';
				if($addfor!="") {
					if($addfor=="addasire") {
						$horname='';
						?>
							<h2 style="padding: 20px 0pt 0pt 30px; color: rgb(153, 79, 38);">Thank you for adding <?php e(str_replace("-", " ",$horsename));?>'s sire to the database.	</h2>		<br>					
						<?php							
					}
					if($addfor=="adddam") {
						$horname='';
						?>
							<h2 style="padding: 20px 0pt 0pt 30px;color: rgb(153, 79, 38);">Thank you for adding <?php e(str_replace("-", " ",$horsename));?>'s dam to the database.</h2>	<br>						
						<?php							
					}	
					if($addfor=="horse") {
						$horname=$horsename;
					}											
				}
				?>
				<div class="po_inf_up">&nbsp;</div>
				<div class="po_inf_mid" style="padding-top: 25px;">
				<div id="formareawrapperreyeng">
					<div class="form_box">
						<label class="formarea" style="font-size: 16px;"><strong>Name:</strong></label>				
						<div class="textfieldwrapperreyeng">
							<?php echo $form->text('Horse.name',array("size"=>"30","onchange"=>"chkhorse()","onkeypress"=>"listingextinghorse()","autocomplete"=>"off","value"=>$horname,"class"=>"newinput textfieldreyeng textfieldnamereyeng","title"=>"$tooltip_name", "onclick"=>"blankallautocomplete()")); ?>
							<div>
								<input type="checkbox" name="data[Horse][nameunknownoption]" value="Y" id="nameunknownoption" onClick="namedis()"><span class="checkboxtextreyeng">I don't know the name</span></div>
								<span id="listhorse" class="listhorseview" style="overflow:visible; padding-left:45px; display: none; position:relative"></span>
								<span id="horsemessage"></span>
							</div>	
						</div>
						<div class="clear"></div>
						<div class="form_box">
							<label class="formarea">Gender:</label>
					 		<div class="textfieldwrapperreyeng">
								<select title="<?=$tooltip_gender?>" name="data[Horse][gender]" class="dropdown" size="1" id="gender"	 onChange="blankallautocomplete()">
									<option value="">Select Gender</option>
									<?php
									if(is_array($genderarr)) {
									foreach($genderarr as $key=>$val) :
									e("<option value=".$val['Gender']['id'].">".$val['Gender']['gender']."</option>");
									endforeach;
									}
									?>
								</select>								
							</div>
							<div class="clear"></div>
						</div>
						<div class="form_box">
							<label class="formarea">Breed:</label>
							<div class="textfieldwrapperreyeng">
								<select title="" name="data[Horse][breed_id]" 	class="dropdown" id="breed"	 onChange="blankallautocomplete()">
									<option value="">Select Breed </option>
									<?php
									if(is_array($breed_arr)) {
										foreach($breed_arr as $key=>$val) :									
											e("<option value=".$val['Breed']['id'].">".$val['Breed']['breed']."</option>");								
										endforeach;							
									}					
									?>						
								</select>
							</div>
							<div class="clear"></div>
						</div>
							<div class="form_box">
								<label class="formarea">Height:</label>
								<div class="textfieldwrapperreyeng">
									<select title="If you're unsure of the height see our help section for a guideline</br> on tips and tricks for measuring horses." name="data[Horse][height_id]" class="dropdown"	 id="height" onChange="blankallautocomplete()">
										<option value="">Select height </option>
										<?php
										if(is_array($height_arr)) {
											foreach($height_arr as $key=>$val) :
												e("<option value=".$val['Height']['id'].">".$val['Height']['height']."</option>");								
											endforeach;							
											}					
										?>						
									</select>
								</div>
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">Coat color:</label>
								<div class="textfieldwrapperreyeng">
									<select title="See our help section on coat colors</br>to help you determine out the correct color of the horse." name="data[Horse][coatcolor_id]" class="dropdown" id="coatcolor_id" onChange="blankallautocomplete()">
									<option value="">Select Coatcolor</option>
									<?php
									if(is_array($coatcolor_arr)) {
										foreach($coatcolor_arr as $key=>$val) :
											e("<option value=".$val['Coatcolor']['id']." $sel>".$val['Coatcolor']['color']."</option>");								
										endforeach;							
									}
									?>						
								</select>
							</div>
							<div class="clear"></div>
							</div>	
							<div class="form_box">
								<label class="formarea">Year born:</label>								
								<div class="textfieldwrapperreyeng">
								<input title="If the year of birth is approximate</br> put a "~" symbol in front of the year." type="text" class="textfieldreyeng" name="data[Horse][year]" id="year" size="15" onClick="blankallautocomplete()" title="Your horses birth year" />

								 		</div>									<div class="clear"></div>											
							</div>
							
							<div class="form_box">
								<label class="formarea">Is this horse deceased?:</label>
								<div class="textfieldwrapperreyeng">
									<span class="checkboxtextreyeng">Yes</span>
									<input type="radio" id="diedyes" name="data[Horse][deathstat]" value="Y" onClick="showdeathfild()">&nbsp;&nbsp;
									<span class="checkboxtextreyeng">No</span>
									<input type="radio" id="diedno" name="data[Horse][deathstat]" value="N" onClick="dontshowdeathfild()" checked="checked">	
								</div>
							<div class="clear"></div>
							</div>	
							<div class="form_box formboxindentfieldreyeng" id="deathfield" style="margin-bottom: 10px; display:none">
								<label class="formarea"><strong style="padding-left: 10px;">Year of death</strong>:</label>
								<div class="textfieldwrapperreyeng">
									<input title="If you only know an approximately which year</br> the horse died put a '~' in front of the year." type="text"		class="textfieldreyeng"		name="data[Horse][yearofdeath]" id="year" size="30">
								</div>							 
							 </div>
							<div class="clear"></div>
							
							
							<!--<div class="form_box">
								<label class="formarea">Year of Death:</label>	
									<input type="radio" id="diedyes" name="data[Horse][deathstat]" value="Y" onClick="showdeathfild()">
									<font color="#994F26">Yes</font> <input type="radio" id="diedno" name="data[Horse][deathstat]" value="N" onClick="dontshowdeathfild()" checked="checked">
									<font color="#994F26">No</font>
									<span id="deathfield" style="display:none; padding-left:148px">	
										<br>
										<p style="padding-bottom:5px; padding-left:0px">Year Of Death :	</p>													
								 		<input type="text" name="data[Horse][yearofdeath]" id="year" size="30">	 
										<br>
									</span> 
									<div class="clear"></div>
							</div>-->
							
							<div class="addhorsedividerreyeng"></div>
							<div class="form_box">
								<label class="formarea">Sire:</label>
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.sire',array("size"=>"30","onkeypress"=>"listingextinghorsesire()","autocomplete"=>"off","class"=>"textfieldreyeng","title"=>"As you type existing horses will be listed</br> for you to select from.</br>Type the sire's name if it is not in the list</br> and you will be prompted to add it to the IHD later on.</br>If the sire is unknown, check the checkbox below.</br>You are always able to add the sire later on.","onclick"=>"blanallapartfromsire()")); ?>
									<br>
									<span id="listsirehorse" class="autocompletereyeng" style="overflow:visible;"></span>
									<div class="clear"></div>
									<div>
									<input type="checkbox" name="data[Horse][sireunknowoption]" value="Y" onClick="disablesire()" id="sireunknowoption">
									<span class="checkboxtextreyeng">I don't know the sire</span>
									</br>
									</div>
								</div>	
							</div>
							<div class="form_box">
								<label class="formarea">Dam:</label>
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.dam',array("size"=>"30","onkeypress"=>"listingextinghorsedam()","class"=>"textfieldreyeng","autocomplete"=>"off","title"=>"As you type existing horses will be listed</br> for you to select from.</br>Type the dam's name if it is not in the list</br> and you will be prompted to add it to the IHD later on.</br>If the sire is unknown, check the checkbox below.</br>You are always able to add the dam later on.","onclick"=>"blanallapartfromdam()")); ?>
									 </br>
									 <span id="listsiredam" class="autocompletereyeng" style="overflow:visible;"></span>
									<div class="clear"></div>
									<div>
										<input type="checkbox" name="data[Horse][damunknownoption]" value="Y" onClick="disabledam()" id="damunknownoption">
										<span class="checkboxtextreyeng">I don't know the dam</span>
										</br>
									</div>
								</div>	
							</div>
							<div class="clear"></div>
							
							<div class="addhorsedividerreyeng"></div>
						
										
							<div class="form_box">
								<label class="formarea">Owner:</label>
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.ownername',array("size"=>"30","onkeypress"=>"listmemberowner()","class"=>"textfieldreyeng","title"=>"As you type existing members of the IHD will be listed below for you to select from. </br>Fill in the full name of an owner if they are not in the IHD.","autocomplete"=>"off","onclick"=>"blankallautocomplete()")); ?>
									<br>
									 <span id="listowner" class="autocompletereyeng" style="overflow:visible;"></span>
								 </div>
								<div class="clear"></div>								
							</div>
								
							<div class="form_box">
								<label class="formarea">Stable:</label>
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.stablename',array("size"=>"30","onkeypress"=>"liststable()","class"=>"textfieldreyeng","title"=>"As you type, the system will list the existing stables of the IHD</br>If the stable is not listed, type it in.</br>We'll take care of the rest.","autocomplete"=>"off","onFocus"=>"nostable()","onclick"=>"blankallautocomplete()")); ?>
									<br>
									 <span id="liststb" class="autocompletereyeng" style="overflow:visible;"></span>
								</div>
								<div class="clear"></div>
							</div>	
							
							<span id="loc">
							<div class="form_box">
								<label class="formarea">Last known location:</label> 
								<div class="textfieldwrapperreyeng">
									<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
										<option value="">country </option>
										
										<?php
										if(is_array($country_arr)) {
											foreach($country_arr as $key=>$val) :									
												e("<option value=".$val['Country']['id'].">".$val['Country']['country']."</option>");								
											endforeach;							
										}					
										?>						
									</select>
								</div>	
								<div class="clear"></div>														
							</div>							
							<div class="form_box">
								<label class="formarea" style="visibility: hidden;">state</label> 
								<div class="textfieldwrapperreyeng">
									<span id="showregion">
									<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
										<option value="">state</option>
										
<!-- REYENG - not sure what the following code does, removing it didn't change anything --> 
											<?php /*
								
		if(is_array($state_arr)) {
											foreach($state_arr as $key=>$val) :									
												e("<option value=".$val['State']['id'].">".$val['State']['statename']."</option>");								
											endforeach;							
										}	*/
										?>	
										
									</select>	
									</span>
								</div>
								<div class="clear"></div>														
							</div>																						
							<div class="form_box">
								<label class="formarea"	 style="visibility: hidden;">city</label> 
								<div class="textfieldwrapperreyeng">
									<span id="showtown">
									<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation" >
										<option value="">city</option>	
									</select>	
								</span>	
								</div>
								<div align="center" style="width:665px; display:none" id="showtownmsg"><b></b></div>	
														
								<div class="clear"></div>	
																	
							</div>		
							</span>	
							
							<div class="form_box formboxindentfieldreyeng" id="addtown" style="display:none">
								<label class="formarea">add city</label>								
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.addadditionaltown',array("size"=>"30","title"=>"Enter the town name here if it is not in the list above.","onclick"=>"blankallautocomplete()","class"=>"textfieldreyeng","id"=>"addadditionaltown")); ?>	
									<input class="mass00 button-reyeng" type="button" value="Add" id="valid"	onClick="addtownvalid()" style="cursor:pointer"/>
								</div>
							
								<span id="addmsgtown"></span>
								<div class="clear"></div>
							</div>	
							
							<div class="addhorsedividerreyeng"></div>
							
							<div class="form_box">
							<label class="formarea">Registered:</label>
									<div class="textfieldwrapperreyeng">
									<span class="checkboxtextreyeng">Yes</span>
									<input type="radio" name="data[Horse][registered]" value="Y"	 onClick="showregister()">&nbsp;&nbsp;
									<span class="checkboxtextreyeng">No</span>
									<input type="radio" name="data[Horse][registered]" value="N" onClick="dontshowregister()" checked="checked">
								</div>			
								<div class="clear"></div>
							</div>	
							
							<div class="form_box formboxindentfieldreyeng" id="regcode" style="margin-bottom: 10px; display:none">
								<label class="formarea"><strong style="padding-left: 10px;">Number</strong>:</label>							<div class="textfieldwrapperreyeng">
								 		<input title="If the horse is registered in an</br> organization include it's registration number here." type="text" class="textfieldreyeng" name="data[Hrse][registration_code]" id="registrationcode" size="30">
								 	</div>								 
							 </div>
							<div class="clear"></div>						
							<div class="form_box">
								<label class="formarea">Bloodline:</label>
								<div class="textfieldwrapperreyeng">
								<?php echo $form->text('Horse.bloodline',array("size"=>"30","class"=>"textfieldreyeng","title"=>"Thank you for only entering details on the horse's bloodline that you are confident are correct.","onclick"=>"blankallautocomplete()")); ?>
									</div>						
								<div class="clear"></div>
							</div>		
							
							<div class="form_box">
								<label class="formarea">Breeder:</label>
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.breeder',array("size"=>"30"," onkeypress"=>"listmemberall()","class"=>"textfieldreyeng","title"=>"The breeder is generally the person that owned the dam of this horse at the time of birth.</br>As you type, the system will list the existing members of the IHD</br>If the name is not listed, type it in.</br>We'll take care of the rest.","autocomplete"=>"off","onclick"=>"blankallautocomplete()")); ?>
									 <br>
									 <span id="listmem" class="autocompletereyeng" style="overflow:visible;"></span>
								 </div>
								<div class="clear"></div>
							</div>
							
							<div class="form_box">
								<label class="formarea">Born at:</label>
								<div class="textfieldwrapperreyeng">
									<?php echo $form->text('Horse.bred_name',array("size"=>"30","onkeypress"=>"listbred()","class"=>"textfieldreyeng","title"=>"At what stable was your horse born? As you type, the system will list the existing stables of the IHD</br>If the stable is not listed, type it in.</br>We'll take care of the rest.","autocomplete"=>"off","onclick"=>"blankallautocomplete()")); ?>
									 <br>
									 <span id="listbed" class="autocomplete"></span>		
								</div>
								<div class="clear"></div>
							</div>
														
							<div class="form_box">
							<label class="formarea">Prize won:</label>
							<div class="textfieldwrapperreyeng">
								<?php echo $form->textarea('Horse.prize_won',array('rows'=>'8','cols'=>23,"class"=>"newtextarea textareareyeng","title"=>"List any shows or races the horse has appeared in</br>(In the future new features will be added to handle this information).","onclick"=>"blankallautocomplete()")); ?>
								</div>		
								<div class="clear"></div>
							</div>
																		
							<div class="form_box">
							<label class="formarea">Other details:</label>
							<div class="textfieldwrapperreyeng">
								<?php echo $form->textarea('Horse.other_details',array('rows'=>'8','cols'=>23,"class"=>"newtextarea textareareyeng","title"=>"Anything that you couldn't describe in the above fields.</br>Some ideas: Character, training level, special markings.","onclick"=>"blankallautocomplete()")); ?>
								</div>		
								<div class="clear"></div>
							</div>
							
																							
							<div class="form_box">
								<input class="button-reyeng" type="button" value="Submit" id="valid"	 onClick="Chkvalidation()" style="cursor:pointer"/>
								
								<div id="showmsg" style="color: #ff0000; position: absolute; margin: -33px 0 0 330px; width: auto; display:none"></div>
							</div>
						</div>																									
							<div class="pic">
								<a href="javascript:void(0)"	 onClick="addpicture()" style="text-decoration:none"><h1>Click here to<br />add Image</h1></a>					
							</div>							
							<div class="upload" style="padding-left:7px">								
							</div>							
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>					
					<div class="position" id="utubelink" style="display:none; overflow:hidden">											
						<div class="embed_vdo"style="padding-left:10px">
								<div align="right">
									<img src="<?php e($this->webroot);?>img/closeButton_normal.gif"	onClick="youtubelickclose()" style="cursor:pointer">
								</div>						
								<label class="out">Add your link :</label><br /><br />
								<?php e($form->textarea('Horse.utube_link',array("class"=>"top_str","rows"=>4,"cols"=>35)));?>			
						</div>									
					</div>					
					<div class="position1" id="videpfromserver" style="display:none;overflow:hidden">	
										
						<div class="embed_vdo" style="padding-left:10px">
								<div align="right">
									<img src="<?php e($this->webroot);?>img/closeButton_normal.gif"	onClick="closevideo()" style="cursor:pointer">
								</div>								
								<label class="out">Upload Video :</label><br /><br />
								<input type="file" name="data[Horse][video]">					
						</div>									
					</div>			
					</div>	
					<div style="clear: both; line-height: 0; font-size: 0;"></div>						
				</div>				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>				
			</div>	
		</div>	
		<div id="changepic" style="z-index:50000000000;display:none; position:absolute;left:40px; top:280px; height:auto" >	
	<div class="pop_up" style="z-index:50000000000; background-color:#FFFBEC; border:#DBCB90 solid 1px;">
									<h3 class="pop_up_h" style="color:#994F26; font-family:verdana; font-size:16px; padding:12px 15pxs 0 20px; display:inline; padding-left:20px; ">Upload image of your horse</h3>
									<a href="javascript:void(0)" onClick="closediv()">Close&nbsp;<strong>x</strong></a>
									<p class="pop_up_p" style="color: #343434; font-family: verdana; font-size: 12px; line-height: 20px; padding: 10px 0 10px 20px; width:466px;">The Main image is used to represent this horse throughout the Database.
Please make sure to select your best one. If you are unsure what image is best, we have prepared some easy guidlines for you here.</p>
<div style="padding-left:15px"><input type="hidden" value="8" id="num" size="2" name="num" class="file23"></div>
									<div class="img_browse">
										<div class="left"><div class="pox"><strong>Select The Main Image:</strong> <?php echo $form->file('Horse.image',array("size"=>"15")); ?></div></div>						
									</div>							
								<div class="img_browse">	
									<span id="imgshow" style="padding-left:10px">									
									</span>																								
								</div>								
							</div>
	
	</div>	
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>	
	<input type="hidden" name="hiddstableval" id="hiddstableval" value="">
	
</body>
</html>
