<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function Chkvalid() {
		var err=0;
		if(document.getElementById("otherreason").checked==true) {
			if(document.getElementById("other").value=="") {
				document.getElementById("other").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("other").style.border = "1px solid #7F9DB9";
			}
		}
		else {
			var Horsestate=document.getElementById("Horsestate").value;		
			var HorseCountry=document.getElementById("HorseCountry").value;	
			var HorseLocation=document.getElementById("HorseLocation").value;			
			if(Horsestate=="") {
				document.getElementById("Horsestate").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("Horsestate").style.border = "1px solid #7F9DB9";
			}		
			if(HorseCountry=="") {
				document.getElementById("HorseCountry").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("HorseCountry").style.border = "1px solid #7F9DB9";
			}
			if(HorseLocation=="") {
				document.getElementById("HorseLocation").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("HorseLocation").style.border = "1px solid #7F9DB9";
			}
		}		
		if(err==0) {
			document.reason.submit();
		}
	}	
	function show() {
		document.getElementById("showinfo").style.display="block";
		document.getElementById("otherre").style.display="none";	
	}
	function donoshowshow() {
		document.getElementById("showinfo").style.display="none";
		document.getElementById("otherre").style.display="block";	
	}	
	 function liststate() {
			var HorseCountry=document.getElementById("HorseCountry").value;
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
					req.open("GET","<?php echo $html->url('/horse/listownerallremovesale/');?>"+HorseOwnername,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listowner").innerHTML="" ;
			}
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
		function assignowner(firstname,lastname,user_id) {
			document.getElementById("HorseOwnername").value=firstname+" "+lastname;
			document.getElementById("listowner").style.display="none";
			document.getElementById("hiddownerid").value=user_id;
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
					req.open("GET","<?php echo $html->url('/horse/liststableallremovesale/');?>"+HorseStablename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("liststb").innerHTML="" ;
			}	
		}
	
	function processrequestliststableall() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					if(req.responseText==0) {
						document.getElementById("HorseStablename").value='This stable has not been added yet';
					}
					else {
						document.getElementById("liststb").innerHTML=req.responseText
					}					
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
					req.open("GET","<?php echo $html->url('/horse/liststableallcountrytownnforremove/');?>"+stable_id,true);	
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
					<form action=""  method="post" name="reason">				
					<div class="popup1" style="height: 400px; width: 500px;">
							<h3>Please tell us why you are removing <?php e($horsearr[0]['Horse']['name']);?> for sale</h3>														
							<div class="form_box_vio">
								<span class="vp" style="margin: 0 10px 0 15px; float: left;">&nbsp;Sold</span><input type="radio" name="data[Salereason][type]" value="Sold" id="sold"  onClick="show()"  checked="checked" style="margin-right: 40px; float: left;"/>
								<label class="formarea_yui" style="float: left;"><input type="radio" name="data[Salereason][type]" value="otherreason" id="otherreason"  onClick="donoshowshow()"  style="margin: 0 10px;"/><span class="vp">&nbsp;Other Reason</span></a><br /></label>
								<span id="otherre" style="display:none">
								<span style="color: #994F26; margin: 30px 0 0 55px;">Tell us your reason:</span><br>
								<textarea rows="4" cols="25"  name="data[Salereason][otherreason]" id="other" style="width: 250px; height: 150px; margin: 10px 0 0 55px;"></textarea>
								</span><div style="clear: both; line-height: 0; font-size: 0;"></div><br><br>
								<span id="showinfo" style="display:block; margin-left: 30px;">
								<div class="form_box">
									<label class="formarea">New Owner:</label>
									<?php echo $form->text('Horse.ownername',array("size"=>"30","onkeypress"=>"listmemberowner()","autocomplete"=>"off")); ?>
									 <span id="listowner" style="overflow:visible;"></span>
									<div class="clear"></div>								
								</div>							
								<div class="form_box">
									<label class="formarea">Stable:</label>
									<?php echo $form->text('Horse.stablename',array("size"=>"30","onkeypress"=>"liststable()","autocomplete"=>"off")); ?>
									 <span id="liststb" style="overflow:visible;"></span>								
									<div class="clear"></div>
								</div>								
								<span id="loc">
								<div class="form_box">
								<label class="formarea">Country:</label> 
								<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
									<option value="">Select Country </option>
									<?php
									if(is_array($country_arr)) {
										foreach($country_arr as $key=>$val) :									
											e("<option value=".$val['Country']['id'].">".$val['Country']['country']."</option>");								
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
									</select>	
								</span>
								<div class="clear"></div>														
							</div>																						
							<div class="form_box">
								<label class="formarea">Town/Region:</label> 
								<span id="showtown">
									<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation" >
										<option value="">Select Town/Region  </option>																
									</select>	
								</span>
								<div class="clear"></div>														
							</div>		
							</span>	
							</span>						
							</div>
							<input class="submit_btn_rt" type="button" value="Submit"  onClick="Chkvalid()" style="cursor:pointer; margin-left: 410px;"/>
							<!--<input class="submit_btn_rt" type="button" value="Back"  onClick="window.history.back()" style="cursor:pointer"/>-->
					  </div>								
					</form>	
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>						
				</div>				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>				
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>
</body>
</html>