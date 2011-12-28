<?php
define ("INCLUDE_PATH", "../");
require_once INCLUDE_PATH."lib/configures.php";
header('content-type: application/x-javascript;');
$phpPage = reset(explode("?", basename($_SERVER['HTTP_REFERER'])));
?>

var hostName = '<?php echo DOMAIN_PATH; ?>';

function onLoadCommonFunction() {
	//MM_preloadImages('<?php echo ADMIN_IMAGE_LINK; ?>/slide_right.jpg');
}

function popupWindow(path, where, hite, wide){
	if (window.event){ 
		window.event.returnValue = false;   
	}
	var width;
	var height;
	var imgWidth;
	var imgHeight;
	
	if (screen.width<wide){
		width=screen.width-20;
		imgWidth=width-10;
		var windowX = (screen.width-width)/2;
	}
	else{
		var windowX = (screen.width-wide)/2;
		width=wide;
	}

	if (screen.height<hite){
		height=screen.height-70;
		imgHeight=height-20;
		var windowY = (screen.height-height)/2-30;
	}
	else{
		var windowY = (screen.height-hite)/2-10;
		height=hite;
	}

	var rand_no = Math.random();
	var i = Math.round(100*Math.random());
	if(screen.height<hite || screen.width<wide){
		var props=window.open(path, i, 'scrollbars=1,toolabars=0,resizable=0,status=0,menubar=0,directories=0,location=0,height='+(hite+30)+', width='+(wide+30));
	}
	else{
		var props=window.open(path, i, 'scrollbars=1,toolabars=0,resizable=1,status=0,menubar=0,directories=0,location=0,height='+(hite+30)+', width='+(wide+30));
	}
	props.moveTo(windowX,windowY);
}


if(window.ActiveXObject) {
	try {
		var oHTTP = new ActiveXObject("Msxml2.XMLHTTP");
	} 
	catch(e) {
		var oHTTP = new ActiveXObject("Microsoft.XMLHTTP");
	}
} 
else {
	var oHTTP = new XMLHttpRequest();
}


/*******************************************************
For Check User Details
*******************************************************/
function checkUserName(){
	if(document.forms['userRegistration'].elements['user_name'].value==""){
		document.getElementById('textContentHTML').innerHTML = 'Please enter user name.';
		document.getElementById('theLayer').style.visibility = 'visible';	
		return false;
	}
	var userLoginName = document.forms['userRegistration'].elements['user_name'].value;
	var firstName = document.forms['userRegistration'].elements['first_name'].value;
	var lastName = document.forms['userRegistration'].elements['last_name'].value;
	
	checkUser(hostName+'/ajax_call.php?mode=check_username&user_name='+userLoginName+'&first_name='+firstName+'&last_name='+lastName+'');
}

function checkUser(page) {
	oHTTP.open("POST", page, true);
	oHTTP.onreadystatechange=function() {
		if (oHTTP.readyState==4) {
			var getValue=oHTTP.responseText;
			document.getElementById('textContentHTML').innerHTML = getValue;
			document.getElementById('theLayer').style.visibility = 'visible';
		}
	}
	oHTTP.send(null);
}


function changeUsernameValue(val){
	document.forms['userRegistration'].elements['user_name'].value = val;
	hideMe(); 
	return false;
}

