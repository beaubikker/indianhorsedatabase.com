<?php
e($this->renderelement('topheader'));
$listhorst=$this->requestAction('/horse/listhorse');
if(is_array($listhorst)) {
	 	$data='';
	 	foreach($listhorst as $key=>$val) {
			$data.=$val['Horse']['name'].",";		
		} 
	} 
e($html->css('facebox'));
e($javascript->link('facebox'));
?>
<?php e($html->css('skin1'));?>
 <script src="http://code.jquery.com/jquery-latest.js"></script>
 <link rel="stylesheet" href="http://dev.jquery.com/view/trunk/plugins/autocomplete/jquery.autocomplete.css" type="text/css" />
 <script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/autocomplete/jquery.autocomplete.js"></script>
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
	
	
	function addpicture() {
		$("#changepic").toggle("slow");		
	}	
    function closediv() {
		$("#changepic").toggle("slow");
	}	
	function frmsub() {
		document.frm.submit();	
	}
	function closevideo() {
		$("#videpfromserver").toggle("6200");
		document.getElementById("changepic").style.display="none";	
	}
	function youtubelickclose() {
		$("#utubelink").toggle("6200");
		document.getElementById("videpfromserver").style.display="none";
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
					//document.getElementById("hiddval").value=parseInt(num);
					for(i=1;i<=num;i++) {
						if(cntr%2==0) {
							divclass='left';
						}
						else {
							divclass='right';
						}
						divval='<div class='+divclass+'><div class=pox style="padding:6px 10px; 0 0"><strong>Image '+i+':</strong><input  type="file"  name=image_'+i+'></div></div>';
						msg=msg+divval;	
						cntr++;			
					}	
					msg=msg+'<input class="submit_btn100" type="button" value="Upload"  onclick="addpicture()" style="cursor:pointer; width: 120px; margin-top: 0; margin-bottom: 20px; padding-left: 10px;"/>';
				}
				document.getElementById("imgshow").innerHTML=msg;		
				document.getElementById("hiddval").value=4;				
			}	
	}
	
	
		function assignowner(firstname,lastname,user_id) {
			document.getElementById("HorseOwnername").value=firstname+" "+lastname;
			document.getElementById("listowner").style.display="none";
			document.getElementById("hiddownerid").value=user_id;
			//alert(document.getElementById("hiddownerid").value) ;
		}		
		function assignmember(firstname,lastname,breederid) {
			document.getElementById("hiddbreederid").value=breederid;
			document.getElementById("HorseBreeder").value=firstname+" "+lastname;
			document.getElementById("listmem").style.display="none";
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
						//document.getElementById("HorseStablename").value='This stable has not been added yet';
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
	function deladdimage(image,horse_id) {
		if(parseInt(horse_id)) {
			if(confirm("Are you sure to delete")) {
				window.location.href='<?php e($html->url('/horse/addiimagedel/'));?>'+'/'+image+'/'+horse_id
			}
		}
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
						divval='<div class='+divclass+'><div class=pox style="padding:6px 10px; 0 0"><strong>Image '+i+':</strong><input  type="file"  name=image_'+i+'></div></div>';
						msg=msg+divval;	
						cntr++;			
					}	
					msg=msg+'<input class="submit_btn100" type="submit" value="Upload" />';
				}
				document.getElementById("imgshow").innerHTML=msg;					
			}		
		}	
		function chkhorse(horse_id) {
			var horsename=document.getElementById("HorseName").value;
			document.getElementById("listhorse").style.display="none";
			document.getElementById("horsemessage").style.display="block";
			if(horsename!=""){
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
					req.open("GET","<?php echo $html->url('/horse/chkhorseforedit/');?>"+horse_id+'/'+horsename,true);	
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
			var HorseCountry=document.getElementById("HorseCountry").value;
			document.getElementById("showtown").innerHTML='<select name=data[Horse][town_id] class=dropdown id=HorseLocation><option value="">Select Town/Region</option></select>';
			if(parseInt(HorseCountry)) {
				document.getElementById("showregion").innerHTML="<font color=#FF0000>Please wait....</font>";
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
				}
			}
		}		
		function showdeathfild() {
			document.getElementById("deathfield").style.display="block" ;
		}	
		
		function dontshowdeathfild() {
			document.getElementById("deathfield").style.display="none" ;
		}
		function showregister() {
			document.getElementById("regcode").style.display="block" ;
		}
		function dontshowregister() {
			document.getElementById("regcode").style.display="none" ;
		}
  </script>
 </head>
<body onLoad="showmulimage();">		
	<form action="" method="post" name="horseinfo" enctype="multipart/form-data">
	<input type="hidden" id="hiddval" name="hiddval" value="4">	
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
					<?php e($form->hidden('Horse.edited_date',array("value"=>date('Y-m-d')))); ?>		
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid" style="padding-top: 25px;">
						<div style="float:left;">
							<div class="form_box">
								<label class="formarea" style="font-size: 16px;"> <strong>Name:</strong></label>	
								<?php echo $form->text('Horse.name',array("class"=>"newinput","size"=>"30","onkeypress"=>"listingextinghorse()","autocomplete"=>"off","value"=>$useridarr[0]['Horse']['name'],"onchange"=>"chkhorse(".$horse_id.")")); ?>
								<div align="right"><input type="checkbox" name="data[Horse][nameunknownoption]" value="Y" id="nameunknownoption" <?php if($useridarr[0]['Horse']['nameunknownoption']=="Y") { ?> checked="checked" <?php } ?>><font color="#994F26"> Unknown</font></div>
								<span id="listhorse" style="overflow:visible; padding-left:65px"></span>
								<span id="horsemessage"></span>							
								<div class="clear"></div>
							</div>
							
							<div class="form_box">
								<label class="formarea">Gender:</label>
								<select name="data[Horse][gender]" class="dropdown" size="1" id="gender">
									<option value="">Select Gender </option>
									<?php
									if(is_array($genderarr)) {
										foreach($genderarr as $key=>$val) :
											if($val['Gender']['id']==$useridarr[0]['Horse']['gender']) {
												$sel="selected=selected";
											}
											else {
												$sel='';
											}
											e("<option value=".$val['Gender']['id']." $sel>".$val['Gender']['gender']."</option>");
										endforeach;
									}
									?>
								</select>								
								<div class="clear"></div>
							</div> 
							<div class="form_box">
								<label class="formarea">Breed:</label>
								<select name="data[Horse][breed_id]" class="dropdown" id="breed">
									<option value="">Select Breed </option>
									<?php
									if(is_array($breed_arr)) {
										foreach($breed_arr as $key=>$val) :		
											if($val['Breed']['id']==$useridarr[0]['Horse']['breed_id']) {
												$sel="selected=selected";
											}
											else {
												$sel='';
											}					
											e("<option value=".$val['Breed']['id']." $sel>".$val['Breed']['breed']."</option>");								
										endforeach;							
									}					
									?>						
								</select>
								<div class="clear"></div>
							</div>
						  <div class="form_box">
								<label class="formarea">Year:</label>
								<input type="text" name="data[Horse][year]" id="year" value="<?php e($useridarr[0]['Horse']['year']);?>" size="30"> 
							</div>
							<?php 
								if($useridarr[0]['Horse']['deathstat']=="Y") { 
									$show="block";
								}
								else {
									$show="none";
								}
							?>
							 
							<div class="form_box">
								<label class="formarea">Deceased:</label>	
									<input type="radio" id="diedyes" name="data[Horse][deathstat]" value="Y" onClick="showdeathfild()" <?php if($useridarr[0]['Horse']['deathstat']=="Y") { ?> checked="checked" <?php } ?>>
									<font color="#994F26">Yes</font> <input type="radio" id="diedno" name="data[Horse][deathstat]" value="N" onClick="dontshowdeathfild()" <?php if($useridarr[0]['Horse']['deathstat']=="N") { ?> checked="checked" <?php } ?>>
									<font color="#994F26">No</font>									
									<div class="clear"></div>                             
						  </div>
						  <div class="form_box" id="deathfield" style="margin-bottom: 10px; display:<?php e($show);?>;">
								<label class="formarea"><strong style="padding-left: 10px;">Year of death</strong>:</label>	
								      <input type="text" name="data[Horse][yearofdeath]" id="year" size="30" value="<?php e($useridarr[0]['Horse']['yearofdeath']);?>">  									
								<div class="clear"></div>
						  </div>										

							<div class="form_box">
								<label class="formarea">Sire:</label>								 
								  <?php echo $form->text('Horse.sire',array("size"=>"30","onkeypress"=>"listingextinghorsesire()","autocomplete"=>"off","value"=>$useridarr[0]['Horse']['sire'])); ?>
								 <br>
								 <span id="listsirehorse" style="overflow:visible;"></span>
								 <div class="clear"></div>
								 <div align="right"><input type="checkbox" name="data[Horse][sireunknowoption]" value="Y" <?php if($useridarr[0]['Horse']['sireunknowoption']=="Y") { ?> checked="checked" <?php } ?>><font color="#994F26"> Unknown</font></div>
							</div>
							
							<div class="form_box">
								<label class="formarea">Dam:</label>
								 <br>
								<?php echo $form->text('Horse.dam',array("size"=>"30","onkeypress"=>"listingextinghorsedam()","autocomplete"=>"off","value"=>$useridarr[0]['Horse']['dam'])); ?>
								 
								 <br><span id="listsiredam" style="overflow:visible;"></span>
								 <div class="clear"></div>
								 <div align="right"><input type="checkbox" name="data[Horse][damunknownoption]" value="Y" <?php if($useridarr[0]['Horse']['damunknownoption']=="Y") { ?> checked="checked" <?php } ?>><font color="#994F26"> Unknown</font></div>
								<div class="clear"></div>
							</div>
							
							<div class="form_box">
								<label class="formarea">Height:</label>
								<select name="data[Horse][height_id]" class="dropdown"  id="height">
									<option value="">Select height </option>
									<?php
									if(is_array($height_arr)) {
										foreach($height_arr as $key=>$val) :
											if($val['Height']['id']==$useridarr[0]['Horse']['height_id']) {
												$sel="selected=selected";
											}
											else {
												$sel='';
											}
											e("<option value=".$val['Height']['id']." $sel>".$val['Height']['height']."</option>");								
										endforeach;							
									}					
									?>						
								</select>
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">Coat color:</label>
									<select name="data[Horse][coatcolor_id]" class="dropdown" id="coatcolor_id">
										<option value="">Select Coatcolor </option>
										<?php
										if(is_array($coatcolor_arr)) {
											foreach($coatcolor_arr as $key=>$val) :
												if($val['Coatcolor']['id']==$useridarr[0]['Horse']['coatcolor_id']) {
													$sel="selected=selected";
												}
												else {
													$sel='';
												}
												e("<option value=".$val['Coatcolor']['id']." $sel>".$val['Coatcolor']['color']."</option>");								
											endforeach;							
										}					
										?>						
									</select>
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">Registered:</label><font color="#994F26">Yes</font> <input type="radio" name="data[Horse][registered]" value="Y" <?php if($useridarr[0]['Horse']['registered']=="Y") { ?> checked="checked" <?php } ?> onClick="showregister()">	
																			&nbsp;&nbsp;<font color="#994F26">No</font>
																			<input type="radio" name="data[Horse][registered]" value="N" onClick="dontshowregister()" <?php if($useridarr[0]['Horse']['registered']=="N") { ?> checked="checked" <?php } ?>>			
								<div class="clear"></div>
							</div>
							<?php
							 $showregister='';
							 if($useridarr[0]['Horse']['registered']=="Y") {
							 	$showregister="block";							 
							 }			
							 else {
							 	$showregister="none";		
							 }					
							?>						
							<div class="form_box" id="regcode" style="margin-bottom: 10px; display:<?php e($showregister);?>">
								<label class="formarea"><strong style="padding-left: 10px;">Number</strong></label>								
                                 	<input type="text" name="data[Horse][registration_code]" id="registrationcode" size="30" value="<?php e($useridarr[0]['Horse']['registration_code']);?>">                                 
							 </div>	
							
							
							<div class="form_box">
								<label class="formarea">Bloodline:</label><?php echo $form->text('Horse.bloodline',array("size"=>"30","value"=>$useridarr[0]['Horse']['bloodline'])); ?>						
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">Breeder:</label><?php echo $form->text('Horse.breeder',array("size"=>"30","onkeypress"=>"listmemberall()","autocomplete"=>"off","value"=>$useridarr[0]['Horse']['breeder'])); ?>
								 <br>
								 <span id="listmem" style="overflow:visible;"></span>
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">Owner:</label>
								<?php echo $form->text('Horse.ownername',array("size"=>"30","onkeypress"=>"listmemberowner()","autocomplete"=>"off","value"=>$useridarr[0]['Horse']['ownername'])); ?>
								 <br>
								 <span id="listowner" style="overflow:visible;"></span>
								<div class="clear"></div>								
							</div>
							
							<?php
							if($useridarr[0]['Horse']['stable_id']!="") {
								$stablenamearr=$this->requestAction('/horse/stablename/'.$useridarr[0]['Horse']['stable_id']) ;
								$stablename=$stablenamearr['Stable']['stable_name'] ;
							}
							else {
								$stablename=$useridarr[0]['Horse']['stablename'] ;
							}
							?>
							
							<div class="form_box">
								<label class="formarea">Stable:</label>
								<?php echo $form->text('Horse.stablename',array("size"=>"30","onkeypress"=>"liststable()","autocomplete"=>"off","value"=>$stablename)); ?>
								 <br>
								 <span id="liststb" style="overflow:visible;"></span>								
								<div class="clear"></div>
							</div>							
														
									
							<?php
							$imagedirectory="horseimage";
							$image=$useridarr[0]['Horse']['image'] ;
							if($image!="") {
							?>
							<div class="form_box">
								<label class="formarea">Horse Image:</label>
								<?php								
								if($image) {
									if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										$xy = $rsz->imgResize(rootpth()."horseimage/".$image,250,135);
									?>
										<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
									<?php
									}
								}
								?>
								<div class="clear"></div>
							</div>	
							<?php
							}
							?>							
							<span id="loc">
							
							
							<div class="form_box">
								<label class="formarea">Country:</label> 
								<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
									<option value="">Select Country </option>
									<?php
									if(is_array($country_arr)) {
										foreach($country_arr as $key=>$val) :	
											if($val['Country']['id']==$useridarr[0]['Horse']['countryid']) {
												$sel='selected=selected';
											}
											else {
												$sel='';
											}									
											e("<option value=".$val['Country']['id']." $sel>".$val['Country']['country']."</option>");								
										endforeach;							
									}					
									?>						
								</select>	
								<div class="clear"></div>														
							</div>
							<div class="form_box">
								<label class="formarea">State:</label> 
								<span id="showregion">
									<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
										<option value="">Select state  </option>
										<?php
										if(is_array($state_arr)) {
											foreach($state_arr as $key=>$val) :		
												if($val['State']['id']==$useridarr[0]['Horse']['state_id']) {
													$sel='selected=selected';
												}
												else {
													$sel='';
												}					
												e("<option value=".$val['State']['id']." $sel>".$val['State']['statename']."</option>");								
											endforeach;							
										}					
										?>						
									</select>	
								</span>
								<div class="clear"></div>														
							</div>											
							<div class="form_box">
								<label class="formarea">Town/Region:</label> 
								<span id="showtown">
								<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation">
									<option value="">Select Town/Region  </option>
									<?php
									if(is_array($town_arr)) {
										foreach($town_arr as $key=>$val) :		
											if($val['Town']['id']==$useridarr[0]['Horse']['town_id']) {
												$sel='selected=selected';
											}
											else {
												$sel='';
											}						
											e("<option value=".$val['Town']['id']." $sel>".$val['Town']['town']."</option>");								
										endforeach;							
									}					
									?>						
								</select>
								</span>	
								<div class="clear"></div>														
							</div>
								
							</span>
							
							<div class="form_box">
								<label class="formarea">Born at:</label>
								<?php echo $form->text('Horse.bred_name',array("size"=>"30","onkeypress"=>"listbred()","autocomplete"=>"off","value"=>$useridarr[0]['Horse']['bred_name'])); ?>
								 <br>
								 <span id="listbed" style="overflow:visible;"></span>								
								<div class="clear"></div>
							</div>
							<div class="form_box" style="height: 50px;">
								<label class="formarea">Prize won:</label><?php echo $form->textarea('Horse.prize_won',array('rows'=>'4','cols'=>'50','style'=>'border: 1px solid #F2CE87; position: absolute; height: 40px',"value"=>$useridarr[0]['Horse']['prize_won'],'class'=>'newtextarea')); ?>
								<div class="clear"></div>
							</div>		
							
							
							<div class="form_box" style="height: 150px;">
								<label class="formarea">Other details:</label><?php echo $form->textarea('Horse.other_details',array('rows'=>'8','cols'=>23,"class"=>"newtextarea","value"=>$useridarr[0]['Horse']['other_details'])); ?>				
								<div class="clear"></div>
							</div>		
																		
							
							
									
													
							<div class="form_box">
								<input class="mass00" type="button" value="Submit" id="valid"  onClick="Chkvalidation()" style="cursor:pointer"/>
								<?php
								if($useridarr[0]['Horse']['putforsale']=="Y") {
									if($salesstatus=="yes") { 
									?>
										<input class="mass00" type="button" value="Put For Sale" id="valid"  onClick="window.location.href='<?php e($html->url('/horse/putforsale/'.$horse_id));?>'" style="cursor:pointer"/>
									<?php
									}
								}
								?>
								<div id="showmsg" style="color: #ff0000; position: absolute; margin: -33px 0 0 330px; width: auto; display:none"></div>
							</div>
						</div>
																									
							<div class="pic">
								<a href="javascript:void(0)"   onClick="addpicture()" style="text-decoration:none"><h1>Click here to<br />add Image</h1></a>											
							</div>
							<div class="upload">
								<?php	
								if(count($additionalimagearr)>0) {
									if(is_array($additionalimagearr)) {
										e("<br>");
										foreach($additionalimagearr as $key=>$val) :
										$imagedirectory="horseadditionalimage";
										$image=$val['Horseimage']['image'];
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."horseadditionalimage/".$val['Horseimage']['image'],80,60);
										?>
											<img class="upload50" src="<?php e($this->webroot);?>img/horseadditionalimage/<?php e($image);?>" alt="" align="absbottom"  width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>"/>
											<img class="upload50" src="<?php e($this->webroot);?>img/del.png" alt="" align="absbottom"   title="delete" style="cursor:pointer" onClick="deladdimage('<?php e($image);?>','<?php e($val['Horseimage']['id']);?>')"/>											
										<?php
										}
										endforeach;
									}
									e("<br>");
								}
								?>		
							</div>
							
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>
					<div class="position" id="utubelink" style="display:none; overflow:hidden">						
						<div class="embed_vdo"style="padding-left:10px">
								<div align="right">
									<img src="<?php e($this->webroot);?>img/closeButton_normal.gif"  onClick="youtubelickclose()" style="cursor:pointer">
								</div>					
								<label class="out">Add your link :</label><br /><br />
								<?php e($form->textarea('Horse.utube_link',array("class"=>"top_str","rows"=>4,"cols"=>35,"value"=>$useridarr[0]['Horse']['utube_link'])));?>			
						</div>									
					</div>					
					<div class="position1" id="videpfromserver" style="display:none;overflow:hidden">						
						<div class="embed_vdo" style="padding-left:10px">	
								<div align="right">
									<img src="<?php e($this->webroot);?>img/closeButton_normal.gif"  onClick="closevideo()" style="cursor:pointer">
								</div>						
								<label class="out">Upload Video :</label><br /><br />
								<input type="file" name="data[Horse][video]">	
								<?php
								if($useridarr[0]['Horse']['video']!="") {
									e("<br>");
									e("<b>".$useridarr[0]['Horse']['video']."</b>");
								}
								?>				
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
		<div id="changepic" style="z-index:50000000000;display:none; position:absolute; left:40px; top:280px; height:auto">	
    <div class="pop_up" style="z-index:50000000000; background-color:#FFFBEC; border:#DBCB90 solid 1px;">
									<h3 class="pop_up_h" style="color:#994F26; font-family:verdana; font-size:16px; padding:12px 15pxs 0 20px; display:inline; padding-left:20px; ">Upload image of your horse</h3>
									<a href="javascript:void(0)" onClick="closediv()">Close&nbsp;<strong>x</strong></a>
									<p class="pop_up_p" style="color: #343434; font-family: verdana; font-size: 12px; line-height: 20px; padding: 10px 0 10px 20px; width:466px;">The Main image is used to represent this horse throughout the Database.
Please make sure to select your best one. If you are unsure what image is best, we have prepared some easy guidlines for you here.</p>
<div style="padding-left:15px"><input type="hidden" id="num" value="8" size="2" name="num" class="file23"></div>
								
									<div class="img_browse">
										<div class="left"><div class=pox style="padding:6px 10px; 0 0"><strong>Select The Main Image:</strong> <?php echo $form->file('Horse.image',array("size"=>"15")); ?></div></div>						
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
	<input type="hidden" name="hiddsireval" id="hiddsireval" value="">
	<input type="hidden" name="hidddamval" id="hidddamval" value="">	
	</form>				
</body>
</html>
