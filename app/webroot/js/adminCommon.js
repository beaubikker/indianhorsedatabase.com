var hostName = 'http://main:233';

function onLoadAdminCommonFunction() {
	//highlightFormElements();
	//highlightsRowsInit();
	MM_preloadImages('../img/slide_right.jpg', 
					'../img/slide_left.jpg', 
					'../img/admin_left_bar.jpg', 
					'../img/bg_top_line.jpg', 
					'../img/admin_right_bar.jpg', 
					'../img/icon_inactive.gif', 
					'../img/icon_active.gif', 
					'../img/icon_edit.gif', 
					'../img/icon_add.gif', 
					'../img/icon_delete.gif', 
					'../img/delete_image.png', 
					'../img/icon_open.gif', 
					'../img/icon_password.gif', 
					'../img/loader.gif', 
					'../img/icon_error.gif', 
					'../img/icon_changeaccess.gif', 
					'../img/icon_lock.gif', 
					'../img/icon_unlock.gif');
}


function changeIconColor(ID){
	var $obj = document.getElementById(ID);
	$obj.className = 'icon_box_hover';
}

function restoreIconColor(ID){
	var $obj = document.getElementById(ID);
	$obj.className = 'icon_box';
}

function popupWindowAdmin(path, where, hite, wide){
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
		var props=window.open(path, i, 'scrollbars=0,toolabars=0,resizable=0,status=0,menubar=0,directories=0,location=0,height='+(hite+30)+', width='+(wide+30));
	}
	props.moveTo(windowX,windowY);
}

function findPosX(obj){
	var curleft = 0;
	if(obj.offsetParent)
		while(1){
		  curleft += obj.offsetLeft;
		  if(!obj.offsetParent)
			break;
		  obj = obj.offsetParent;
		}
	else if(obj.x)
		curleft += obj.x;
	return curleft;
}

function findPosY(obj){
	var curtop = 0;
	if(obj.offsetParent)
		while(1){
		  curtop += obj.offsetTop;
		  if(!obj.offsetParent)
			break;
		  obj = obj.offsetParent;
		}
	else if(obj.y)
		curtop += obj.y;
	return curtop;
}



/*******************************************************
Highlights table rows
*******************************************************/

var marked_row = new Array;

/*function highlightsRowsInit() {
	// for every table row ...
    var rows = document.getElementsByTagName('tr');
    for ( var i = 0; i < rows.length; i++ ) {
        // ... with the class 'odd' or 'even' ...
        if ( 'odd_tr' != rows[i].className.substr(0,6) && 'even_tr' != rows[i].className.substr(0,7) ) {
            continue;
        }
        // ... add event listeners ...
        // ... to highlight the row on mouseover ...
        if ( navigator.appName == 'Microsoft Internet Explorer' ) {
            // but only for IE, other browsers are handled by :hover in css
            rows[i].onmouseover = function() {
                this.className += ' mouseHover';
            }
            rows[i].onmouseout = function() {
                this.className = this.className.replace( ' mouseHover', '' );
            }
        }
        // Do not set click events if not wanted
        if (rows[i].className.search(/noclick/) != -1) {
            continue;
        }
        // ... and to mark the row on click ...
        rows[i].onmousedown = function() {
            var unique_id;
            var checkbox;

            checkbox = this.getElementsByTagName( 'input' )[0];
            if ( checkbox && checkbox.type == 'checkbox' ) {
                unique_id = checkbox.name + checkbox.value;
            } else if ( this.id.length > 0 ) {
                unique_id = this.id;
            } else {
                return;
            }

            if ( typeof(marked_row[unique_id]) == 'undefined' || !marked_row[unique_id] ) {
                marked_row[unique_id] = true;
            } else {
                marked_row[unique_id] = false;
            }

            if ( marked_row[unique_id] ) {
                this.className += ' selected_bg';
            } else {
                this.className = this.className.replace(' selected_bg', '');
            }

            if ( checkbox && checkbox.disabled == false ) {
                checkbox.checked = marked_row[unique_id];
            }
        }

        // ... and disable label ...
        var labeltag = rows[i].getElementsByTagName('label')[0];
        if ( labeltag ) {
            labeltag.onclick = function() {
                return false;
            }
        }
        // .. and checkbox clicks
        var checkbox = rows[i].getElementsByTagName('input')[0];
        if ( checkbox ) {
            checkbox.onclick = function() {
                // opera does not recognize return false;
                this.checked = ! this.checked;
            }
        }
    }
}
*/

function markAllSelectedRows(container_id) {
    var rows = document.getElementById(container_id).getElementsByTagName('tr');
    var unique_id;
    var checkbox;

    for ( var i = 0; i < rows.length; i++ ) {

        checkbox = rows[i].getElementsByTagName( 'input' )[0];

        if ( checkbox && checkbox.type == 'checkbox' ) {
            unique_id = checkbox.name + checkbox.value;
            if ( checkbox.disabled == false ) {
                checkbox.checked = true;
                if ( typeof(marked_row[unique_id]) == 'undefined' || !marked_row[unique_id] ) {
                    rows[i].className += ' selected_bg';
                    marked_row[unique_id] = true;
                }
            }
        }
    }
    return true;
}


function unMarkSelectedRows( container_id ) {
    var rows = document.getElementById(container_id).getElementsByTagName('tr');
    var unique_id;
    var checkbox;

    for ( var i = 0; i < rows.length; i++ ) {

        checkbox = rows[i].getElementsByTagName( 'input' )[0];

        if ( checkbox && checkbox.type == 'checkbox' ) {
            unique_id = checkbox.name + checkbox.value;
            checkbox.checked = false;
            rows[i].className = rows[i].className.replace(' selected_bg', '');
            marked_row[unique_id] = false;
        }
    }

    return true;
}



/*******************************************************
Highlights input boxes
*******************************************************/

/*function highlightFormElements() {
    // add input box highlighting
    addFocusHandlers(document.getElementsByTagName("input"));
    addFocusHandlers(document.getElementsByTagName("textarea"));
}*/

/*function addFocusHandlers(elements) {
    for (i=0; i < elements.length; i++) {
        if (elements[i].type != "button" && elements[i].type != "submit" && 
            elements[i].type != "reset" && elements[i].type != "checkbox" && elements[i].type != "radio" && elements[i].type != "image") {
            if (!elements[i].getAttribute('readonly') && !elements[i].getAttribute('disabled')) {
				elements[i].onfocus=function() {this.className = 'look_selected'; this.select()};
                elements[i].onmouseover=function() {this.style.backgroundColor=''; this.className = 'look_selected';};
                elements[i].onblur=function() {this.style.backgroundColor=''; this.className = 'look';}
                elements[i].onmouseout=function() {this.style.backgroundColor=''; this.className = 'look';}
				elements[i].onkeyup=function() {this.style.backgroundColor=''; this.className = 'look_selected';}
				elements[i].onkeypress=function() {this.style.backgroundColor=''; this.className = 'look_selected';}
            }
        }
    }
}*/


/*******************************************************
Preloader
*******************************************************/

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function roll_over(imgname,imgsrc) {
	document[imgname].src=imgsrc;
}

/*******************************************************
AJAX handler
*******************************************************/


if(window.ActiveXObject) {
	try {
		var oHTTP = new ActiveXObject("Msxml2.XMLHTTP");
	} catch(e) {
		var oHTTP = new ActiveXObject("Microsoft.XMLHTTP");
	}
} else {
	var oHTTP = new XMLHttpRequest();
}


function menuHide(){
	callNewPage(hostName+'/admin/admin_hide_menu.php?mode=chk&uri=');
}

function callNewPage(page) {
	oHTTP.open("GET", page, true);
	oHTTP.onreadystatechange=function() {
		if (oHTTP.readyState==4) {
			var getValue=oHTTP.responseText;
			
			if (getValue=="none") {
				document.getElementById('menuPortion').style.display = "none";
				document.getElementById('menuDisp').src = "../admin_images/slide_right.jpg";
			}
			else{
				document.getElementById('menuPortion').style.display = "";
				document.getElementById('menuDisp').src = "../admin_images/slide_left.jpg";
			}
		}
	}
	oHTTP.send(null);
}



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function roll_over(imgname,imgsrc) {
	document[imgname].src=imgsrc;
}


function colorPicker(){
	var obj = document.forms['configManager'];
	if(obj.elements['adminbgColor']) attachColorPicker(obj.elements['adminbgColor']);
	if(obj.elements['borderColor']) attachColorPicker(obj.elements['borderColor']);
	if(obj.elements['adminTopbgColor']) attachColorPicker(obj.elements['adminTopbgColor']);
	if(obj.elements['adminBottombgColor']) attachColorPicker(obj.elements['adminBottombgColor']);
	if(obj.elements['menuPortionBgColor']) attachColorPicker(obj.elements['menuPortionBgColor']);
	if(obj.elements['menuPortionBorderColor']) attachColorPicker(obj.elements['menuPortionBorderColor']);
	if(obj.elements['ddMenuBgColor']) attachColorPicker(obj.elements['ddMenuBgColor']);
	if(obj.elements['ddMenuBgHoverColor']) attachColorPicker(obj.elements['ddMenuBgHoverColor']);
	if(obj.elements['menuTextColor']) attachColorPicker(obj.elements['menuTextColor']);
	if(obj.elements['menuHoverTextColor']) attachColorPicker(obj.elements['menuHoverTextColor']);
	if(obj.elements['adminRowColor']) attachColorPicker(obj.elements['adminRowColor']);
	if(obj.elements['boxBgColor']) attachColorPicker(obj.elements['boxBgColor']);
	if(obj.elements['boxBorderColor']) attachColorPicker(obj.elements['boxBorderColor']);
	if(obj.elements['adminRowHoverColor']) attachColorPicker(obj.elements['adminRowHoverColor']);
	if(obj.elements['adminRowSelectColor']) attachColorPicker(obj.elements['adminRowSelectColor']);
	if(obj.elements['adminRowEvenColor']) attachColorPicker(obj.elements['adminRowEvenColor']);
	if(obj.elements['adminRowOddColor']) attachColorPicker(obj.elements['adminRowOddColor']);
}






function deleteConfirmRecord(path, toDelete){
	if(confirm('Are you sure to delete this '+toDelete+'?')){
		location.href=''+path+'';
	}
	else{
		return false;	
	}
}




function CreatePageValidation() {
	if(document.forms['createPage'].elements['page_name'].value=="") {
		alert ("Please enter file name.");
		document.forms['createPage'].elements['page_name'].focus();
		return false;
	}
	var page_name = document.forms['createPage'].elements['page_name'].value;
	var space = page_name.indexOf(" ", 0);
	var num = page_name.indexOf(".",0);
	var ch = page_name.charAt(num+1);
	var ext = page_name.indexOf(".php", 0);
	if(space>=0) {
		alert ("White space is not allowed...");
		document.forms['createPage'].elements['page_name'].select();
		return false;
	}
	if(num<0 && ext<=0) {
		alert ("File name must be with extension .php ");
		document.forms['createPage'].elements['page_name'].select();
		return false;
	}
	if(ch ==" " || ch == "." || ch =="" || num==0) {
		alert ("File name is not proper...");
		document.forms['createPage'].elements['page_name'].select();
		return false;
	}
}



function changeStatus_M(tname, idname, changeMode, ID, statusPortion){
	if(changeMode!="" && ID!="" && statusPortion!=""){
		document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/loader.gif" align="absmiddle" alt="Loader" border="0" title="Please Wait" class="changeStatus" />';
		changeStatusResponse_M(hostName+'/admin/admin_change_status.php?tname='+tname+'&idname='+idname+'&mode='+changeMode+'&id='+ID+'', changeMode, ID, statusPortion, tname, idname);
	}
}

function changeStatusResponse_M(page, changeMode, ID, statusPortion, tname, idname) {
	oHTTP.open("GET", page, true);
	oHTTP.onreadystatechange=function() {
		if (oHTTP.readyState==4) {
			var getValue=oHTTP.responseText;			
			if (getValue=="none") {
				document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/icon_inactive.gif" align="absmiddle" alt="Inactive" border="0" onclick="javascript: changeStatus_M(\''+tname+'\',\''+idname+'\',\''+changeMode+'\', '+ID+', \''+statusPortion+'\');" title="Change Status" class="changeStatus" />';
			}
			else{
				document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/icon_active.gif" align="absmiddle" alt="Active" border="0" onclick="javascript: changeStatus_M(\''+tname+'\',\''+idname+'\',\''+changeMode+'\', '+ID+', \''+statusPortion+'\');" title="Change Status" class="changeStatus" />';
			}
		}
	}
	oHTTP.send(null);
}



function changeStatus(changeMode, ID, statusPortion){
	if(changeMode!="" && ID!="" && statusPortion!=""){
		document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/loader.gif" align="absmiddle" alt="Loader" border="0" title="Please Wait" class="changeStatus" />';
		changeStatusResponse(hostName+'/admin/admin_change_status.php?mode='+changeMode+'&id='+ID+'', changeMode, ID, statusPortion);
	}
}

function changeStatusResponse(page, changeMode, ID, statusPortion) {
	oHTTP.open("GET", page, true);
	oHTTP.onreadystatechange=function() {
		if (oHTTP.readyState==4) {
			var getValue=oHTTP.responseText;
			if (getValue=="none") {
				document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/icon_inactive.gif" align="absmiddle" alt="Inactive" border="0" onclick="javascript: changeStatus(\''+changeMode+'\', '+ID+', \''+statusPortion+'\');" title="Change Status" class="changeStatus" />';
			}
			else{
				document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/icon_active.gif" align="absmiddle" alt="Active" border="0" onclick="javascript: changeStatus(\''+changeMode+'\', '+ID+', \''+statusPortion+'\');" title="Change Status" class="changeStatus" />';
			}
		}
	}
	oHTTP.send(null);
}



function changeSSLStatus(changeMode, ID, statusPortion){
	if(changeMode!="" && ID!="" && statusPortion!=""){
		document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/loader.gif" align="absmiddle" alt="Loader" border="0" title="Please Wait" class="changeStatus" />';
		changeSSLStatusResponse(hostName+'/admin/admin_change_status.php?mode='+changeMode+'&id='+ID+'', changeMode, ID, statusPortion);
	}
}

function changeSSLStatusResponse(page, changeMode, ID, statusPortion) {
	oHTTP.open("GET", page, true);
	oHTTP.onreadystatechange=function() {
		if (oHTTP.readyState==4) {
			var getValue=oHTTP.responseText;
			if (getValue=="none") {
				document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/icon_unlock.gif" align="absmiddle" alt="Inactive" border="0" onclick="javascript: changeSSLStatus(\''+changeMode+'\', '+ID+', \''+statusPortion+'\');" title="Change Status" class="changeStatus" />';
			}
			else{
				document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/icon_lock.gif" align="absmiddle" alt="Active" border="0" onclick="javascript: changeSSLStatus(\''+changeMode+'\', '+ID+', \''+statusPortion+'\');" title="Change Status" class="changeStatus" />';
			}
		}
	}
	oHTTP.send(null);
}

function deleteImage(changeMode, ID, statusPortion, type){
	if(confirm('Are you sure to delete this '+type+'?')){
		if(changeMode!="" && ID!="" && statusPortion!=""){
			document.getElementById(statusPortion).innerHTML = '<img src="'+hostName+'/admin_images/loader.gif" align="absmiddle" alt="Loader" border="0" title="Please Wait" class="changeStatus" /> Please wait';
			deleteImageResponse(hostName+'/admin/admin_delete_image.php?mode='+changeMode+'&id='+ID+'', changeMode, ID, statusPortion);
		}
	}
}

function deleteImageResponse(page, changeMode, ID, statusPortion) {
	oHTTP.open("GET", page, true);
	oHTTP.onreadystatechange=function() {
		if (oHTTP.readyState==4) {
			var getValue=oHTTP.responseText;
			if (getValue=="done") {
				document.getElementById(statusPortion).innerHTML = '';
			}
		}
	}
	oHTTP.send(null);
}