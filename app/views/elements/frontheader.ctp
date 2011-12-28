<?php
$currpage=basename($_SERVER['REQUEST_URI']);
$settingarr=$this->requestAction('/setting/allimage');
if(count($settingarr)>0) {
	if($settingarr['Setting']['logo']!="") {
		$logo=$settingarr['Setting']['logo'];
	}
	if($settingarr['Setting']['headerimage']!="") {
		$headerimage=$settingarr['Setting']['headerimage'];
	}
}
?>
<script language="javascript">
	function namedis() {
		if(document.getElementById("nameunknownoption").checked==true) {
			document.getElementById("HorseName").disabled=true
		}
		else {
			document.getElementById("HorseName").disabled=false
		}	
	}
	
	function disablesire() {
		if(document.getElementById("sireunknowoption").checked==true) {
			document.getElementById("HorseSire").disabled=true
		}
		else {
			document.getElementById("HorseSire").disabled=false
		}	
	}	
	function disabledam() {
		if(document.getElementById("damunknownoption").checked==true) {
			document.getElementById("HorseDam").disabled=true
		}
		else {
			document.getElementById("HorseDam").disabled=false
		}	
	}
	
	function blankallautocomplete() {
		document.getElementById("listsirehorse").innerHTML="";
		document.getElementById("listsiredam").innerHTML="";
		document.getElementById("listmem").innerHTML="";
		document.getElementById("listowner").innerHTML="";
		document.getElementById("liststb").innerHTML="";
		document.getElementById("listbed").innerHTML="";	
	}
	
	function blanallapartfromsire() {
		document.getElementById("listsiredam").innerHTML="";
		document.getElementById("listmem").innerHTML="";
		document.getElementById("listowner").innerHTML="";
		document.getElementById("liststb").innerHTML="";
		document.getElementById("listbed").innerHTML="";	
	}	
	function blanallapartfromdam() {
		document.getElementById("listsirehorse").innerHTML="";
		document.getElementById("listmem").innerHTML="";
		document.getElementById("listowner").innerHTML="";
		document.getElementById("liststb").innerHTML="";
		document.getElementById("listbed").innerHTML="";	
	}
	
	
	
	
</script>
<div class="header" style="background:url(http://indianhorsedatabase.com/img/settingimages/<?php e($headerimage);?>) no-repeat; height:183px;"><a href="<?php echo $html->url(array("controller" => "content","action" => "front"));?>"><img src="<?php e($this->webroot);?>img/settingimages/<?php e($logo);?>" alt=""  width="343" height="117"/></a></div>
			<div class="nav">			                                                            
 				<ul>
					<li><a href="<?php echo $html->url(array("controller" => "content","action" => "front"));?>" <?php if($currpage=="indianhorse" || $currpage=="" || $currpage=="homeforpaiduser" || $currpage=="homeforpaiduser") { ?>class="active" <?php } ?>>Home</a></li>
					<li><a href="<?php echo $html->url(array("controller" => "horse","action" => "findahorse"));?>" <?php if($currpage=="findahorse" || $currpage=="findstable" || $currpage=="findamembers") { ?> class="active" <?php } ?>>Search the Database</a></li>
					<li><a href="<?php echo $html->url(array("controller" => "horse","action" => "addhorse"));?>" <?php if($currpage=="addhorse"|| $currpage=="addhorsebyfreemember") { ?>class="active" <?php } ?>>Add a Horse</a></li>
					<li><a href="<?php echo $html->url(array("controller" => "horse","action" => "salehorse"));?>" <?php if($currpage=="salehorse") { ?>class="active" <?php } ?>>Horses for Sale &amp; Stud</a></li>
					<li><a href="<?php echo $html->url(array("controller" => "help","action" => "showall"));?>" <?php if(strstr($_SERVER['REQUEST_URI'],'help')) { ?> class="active" <?php } ?>>Help</a></li>
					<li><a href="<?php e($html->url('/content/contact'));?>" <?php if($currpage=="contact") { ?> class="active" <?php } ?>>Contact Us</a></li>
				</ul>					
			</div>
