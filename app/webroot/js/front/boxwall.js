function checkboxwall(wallid){
	
	/*to get max value*/
	document.getElementById('maximum').value = "";
	
	/*to set session*/
	document.getElementById('wallid').value = wallid;
	var id = document.getElementById('ids').value;
	var cnt = id.split(',');
	
	var total = cnt.length;
	
	for(var i=0;i<total;i++){
		
		if(wallid== cnt[i]){
			document.getElementById('selectBT_'+wallid).disabled =false;
			document.getElementById('selectECT_'+wallid).disabled =false;
			
			
			
			document.getElementById('BT_'+wallid).disabled =false;
			document.getElementById('BT_'+wallid).checked =true;
			document.getElementById('ECT_'+wallid).disabled =false;
			
			document.getElementById('selectECT_'+wallid).disabled = true;
			
			document.getElementById('BTtxt_'+wallid).style.color ="#61A257";
			document.getElementById('ECTtxt_'+wallid).style.color ="#61A257";
		}else{
			
			
			
			document.getElementById('selectBT_'+cnt[i]).disabled =true;
			document.getElementById('selectECT_'+cnt[i]).disabled =true;
			
			document.getElementById('selectBT_'+cnt[i]).selectedIndex = 0;
			document.getElementById('selectECT_'+cnt[i]).selectedIndex = 0;
			
			document.getElementById('maxdiv_'+cnt[i]).innerHTML = "select";
			
			document.getElementById('BT_'+cnt[i]).disabled =true;
			document.getElementById('ECT_'+cnt[i]).disabled =true;
			document.getElementById('BT_'+cnt[i]).checked =false;
			document.getElementById('ECT_'+cnt[i]).checked =false;
			
				
			document.getElementById('BTtxt_'+cnt[i]).style.color ="#C1AA80";
			document.getElementById('ECTtxt_'+cnt[i]).style.color ="#C1AA80";
			
		}
		
		
		}
	
	
		return false;
	}

function chkradio(radioid){
	
	document.getElementById('maximum').value = "";
	document.getElementById('maxdiv_'+radioid).innerHTML = "select";
	
	if(document.getElementById('BT_'+radioid).checked == true){
		
		document.getElementById('strengthval').value="BT";		
		document.getElementById('selectECT_'+radioid).disabled = true;
		
		document.getElementById('selectECT_'+radioid).selectedIndex = 0;
		
		document.getElementById('selectBT_'+radioid).disabled = false;
	}
	
	if(document.getElementById('ECT_'+radioid).checked == true){
		
		document.getElementById('strengthval').value="ECT";		
		
		document.getElementById('selectBT_'+radioid).selectedIndex = 0;
		
		
		
		document.getElementById('selectBT_'+radioid).disabled = true;
		document.getElementById('selectECT_'+radioid).disabled = false;
	}
		
	}



function showmax(maxval,id){
	
	maxval = maxval.split("#");
	
	if(maxval[0] !=0){
	document.getElementById('maxdiv_'+id).innerHTML = maxval[0];
	document.getElementById('maximum').value = maxval[0];
	document.getElementById('strengthid').value = maxval[1];
	
	}else{
		document.getElementById('maxdiv_'+id).innerHTML = "select";
	}
	
	}
	
	
	function validatefrm(){
		
		
		if(document.getElementById('maximum').value =="" ){
			dispAlert("Select any strength value");
			return false;
			}
		
		}



function dispAlert(str){ 

	$("#error").show();
	$("#msg").html(str);
	
}

function closediv(){ 
	$("#error").hide();
	
	}


