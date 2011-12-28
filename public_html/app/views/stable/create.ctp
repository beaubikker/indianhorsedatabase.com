<?php
e($this->renderelement('topheader'));
e($javascript->link('jquery_002'));
e($javascript->link('jquery'));
e($javascript->link('jScrollPane'));
e($html->css('jScrollPane'));
?>    
 <script type="text/javascript">			
	$(function()
	{
		$('#pane1').jScrollPane();				
	});			
</script>  
<script type="text/javascript">
	$(document).ready(function(){
		$(".changepic").click(function(){
			$("#changepic").toggle("slow");
		});	
	});		
	function closepic() {
		$("#changepic").toggle("slow");
	}	
    function closediv() {
		document.getElementById("changepic").style.display="none";
		document.getElementById("imgshow").innerHTML='';
		document.getElementById("num").value='';
	}	
	function frmsub() {
		document.frm.submit();	
	}
	function noofimages() {
		var num=4 ;
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
						divval='<div class='+divclass+'><div class=pox style="padding:6px 10px; 0 0"><strong>Image '+i+':</strong><input  type="file"  name="image_'+i+'"></div></div>';
						msg=msg+divval;	
						cntr++;			
					}	
					msg=msg+'<input class="submit_btn100" type="button" value="Close"  onclick="closepic()" style="cursor:pointer"/>';
				}
				document.getElementById("imgshow").innerHTML=msg;					
			}		
		}	
		function chkstable() {
			var StableStableName=document.getElementById("StableStableName").value;
			if(StableStableName!=""){
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
					req.open("GET","<?php echo $html->url('/stable/chkstable/');?>"+StableStableName,true);	
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
						document.getElementById("valid").disabled=true;
						document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>Stable Aready exists</em></b></font>";
					}
					else {
						document.getElementById("valid").disabled=false;
						document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>You can use this stable</em></b></font>";
					}						
				}
			}
		}		
		function Chkvalidation() {
			var err=0;
			var StableStableName=document.getElementById("StableStableName").value;
			var StableServices=document.getElementById("StableServices").value;
			var StableAbout=document.getElementById("StableAbout").value;
			var HorseLocation=document.getElementById("HorseLocation").value;
			var HorseCountry=document.getElementById("HorseCountry").value;
			var Horsestate=document.getElementById("Horsestate").value;
			if(Horsestate=="") {
				document.getElementById("Horsestate").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("Horsestate").style.border = "1px solid #7F9DB9";
			}			
			if(StableStableName=="") {
				document.getElementById("StableStableName").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("StableStableName").style.border = "1px solid #7F9DB9";
			}
			
			if(StableServices=="") {
				document.getElementById("StableServices").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("StableServices").style.border = "1px solid #7F9DB9";
			}	
			if(StableAbout=="") {
				document.getElementById("StableAbout").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("StableAbout").style.border = "1px solid #7F9DB9";
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
			if(err==0) {
				document.getElementById("showmsg").style.display="block";
				document.getElementById("showmsg").innerHTML='We are processing your information, thank you for your patience....';
				document.horseinfo.submit();			
			}		
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
					<form action="" method="post" name="horseinfo" enctype="multipart/form-data">
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid" style="padding-top: 25px;">
						<div style="float:left;">
							<div class="form_box"></div>
								<label class="formarea"> <strong>Name:</strong></label>								
								<?php echo $form->text('Stable.stable_name',array("size"=>"30","onchange"=>"chkstable()")); ?>
								<span id="horsemessage"></span>
								<div class="clear"></div>
							</div>	
							
							<div class="form_box">
								<label class="formarea">Horses</label>	
									<?php
									if(count($listhorst)>0) {
									?>							
									<div tabindex="0" style="height: 200px; width: 200px;" 
class="jScrollPaneContainer jScrollPaneScrollable"><div style="overflow:
 visible; height: auto; width: 185px; padding-right: 5px; position: 
absolute; top: -96px;" id="pane1" class="scroll-pane">
				
										<table align="center" width="100%" style="background-color:#FFFFFF">
										<?php
										
											foreach($listhorst as $key=>$val) :
												?>								
												<tr>
													<td valign="top">	
														<?php
														$imagedirectory="horseimage";
														$image=$val['Horse']['image'];
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],60,60);								
																?>									
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
															<?php
															}
															else {
																?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60">
															<?php
														}
														?>
												</td>
												<td valign="top"><font color="#994F26"><?php e($val['Horse']['name']);?></font>
												<br>
												<?php
												//pr($horseesid) ;
												//if($val['Horse']['stable_id']>0) {
													if($val['Horse']['stable_id']!="") {
														if($val['Horse']['stable_id']>0) {?>
															 <input type="checkbox" name="data[Stable][horse_id][<?php echo $key ;?>]" value="<?php echo $val['Horse']['id'] ;?>" id="<?php echo $val['Horse']['id'] ;?>" />
														<?php
														}
														else {
															e("<b><font color=#994F26>Already Assigned </font></b>");
														}
													}
													else {
													?>
														 <input type="checkbox" name="data[Stable][horse_id][<?php echo $key ;?>]" value="<?php echo $val['Horse']['id'] ;?>" id="<?php echo $val['Horse']['id'] ;?>" />
													<?php
													}
												//}
												
												?>												
												</td>
												</tr>
												<?php
											endforeach;								
																		
										?>		
										</table>								
			</div><div style="height: 0px;" class="jScrollCap jScrollCapTop"></div><div
 style="width: 10px; height: 200px; top: 0px;" class="jScrollPaneTrack"><div
 style="width: 10px; height: 25px; top: 12px;" class="jScrollPaneDrag"><div
 style="width: 10px;" class="jScrollPaneDragTop"></div><div 
style="width: 10px;" class="jScrollPaneDragBottom"></div></div></div><div
 style="height: 0px;" class="jScrollCap jScrollCapBottom"></div></div>
 <?php
 }
 else {
 	e("<div align=lefy><em><font color=#FF0000><strong>You have not added any horses </strong> </font></em></div>");
 }
 ?>
								<div class="clear"></div>
							</div>							
							<div class="form_box">
								<label class="formarea">Website:</label>								
								<?php echo $form->text('Stable.website',array("size"=>"30")); ?>
								<div class="clear"></div>
							</div>								
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
							<div class="form_box">
								<label class="formarea">About:</label> <?php echo $form->textarea('Stable.about',array('rows'=>'4','cols'=>23)); ?>								
							</div>					
							<div class="form_box">
								<label class="formarea">Services:</label><?php echo $form->textarea('Stable.services',array('rows'=>'8','cols'=>23)); ?>				
							</div>							
							<div class="form_box">
								<input class="mass00" type="button" value="Submit" id="valid"  onClick="Chkvalidation()" style="cursor:pointer"/>
								<input type="hidden" name="sub" value="add">
								<input class="mass00" type="button" value="Back" id="valid"  onClick="window.location.href='<?php e($html->url('/stable/stableprofile'));?>'" style="cursor:pointer"/>
								<div id="showmsg" style="color: #ff0000; position: absolute; margin: -80px 0 0 330px; width: auto; display:none"></div>
							</div>
						</div>																										
							<div class="pic">
								<a href="javascript:void(0)"  class="changepic" style="text-decoration:none"><h1>Click here to<br />add Image</h1></a>						
							</div>													
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>				
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>						
				</div>	
							
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>				
			</div>	<em></em>
		</div>	
		<div id="changepic" style="z-index:50000000000;display:none; position:absolute; left:40px; top:280px; height:auto">	
    <div class="pop_up" style="z-index:50000000000; background-color:#FFFBEC; border:#DBCB90 solid 1px;">
									<h3 class="pop_up_h" style="color:#994F26; font-family:verdana; font-size:16px; padding:12px 15pxs 0 20px; display:inline; padding-left:20px; ">Upload image of your horse</h3>
									<a href="javascript:void(0)" onClick="closepic()">Close&nbsp;<strong>x</strong></a>
									<p class="pop_up_p" style="color: #343434; font-family: verdana; font-size: 12px; line-height: 20px; padding: 10px 0 10px 20px; width:466px;">The Main image is used to represent this horse throughout the Database.
Please make sure to select your best one. If you are unsure what image is best, we have prepared some easy guidlines for you here.</p>
								<div class="img_browse">
										<div class="left"><div class=pox style="padding:6px 10px; 0 0"><strong>Select The Main Image:</strong> <?php echo $form->file('Stable.stable_image',array('size'=>10)); ?></div></div>						
									</div>	
								<div class="img_browse">	
									<div class="right"><div class=pox style="padding:6px 10px; 0 0"><strong>Image1</strong><input type="file" name="image_1"></div></div>
									<div class="left"><div class=pox style="padding:6px 10px; 0 0"><strong>Image2</strong><input type="file" name="image_2"></div></div>	
									<div class="right"><div class=pox style="padding:6px 10px; 0 0"><strong>Image3</strong><input type="file" name="image_3"></div></div>	
									<div class="left"><div class=pox style="padding:6px 10px; 0 0"><strong>Image4</strong><input type="file" name="image_4"></div></div>																						
									<input class="submit_btn100" type="button" value="Close"  onclick="closepic()" style="cursor:pointer"/>	
								</div>																				
							</div>
  
    </div>
	
	<input type="hidden" id="hiddval" name="hiddval" value="4">	
	</form>	
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>
					
</body>
</html>
