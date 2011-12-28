<?php e($javascript->link('jquery-1'));?> 
<?php e($javascript->link('jquery'));?>
<?php e($this->renderElement('header_logon'));
$listhorst=$this->requestAction('/horse/listhorse');
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
<script language="javascript">
function moreimg() {
		var hiddval=document.getElementById("hiddval").value;
		hiddval++;
		var i;
		var msg='';
		msg='<br>' ;
		if(hiddval) {
			for(i=1;i<=hiddval;i++) {
				msg=msg+"<span id=imagsh_"+i+"><input type=file class=button1 name=img_"+i+" class=look id=img_"+i+">&nbsp&nbsp;<input type=button value=Cancel class=button onclick=can('"+i+"') id=can_"+i+" style=cursor:pointer><br></span>";			
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
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add Stable </td>
			</tr> 
		</table>
	</td>
</tr>
<tr>
	<td valign="top" align="left" class="box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="center">
			<form name="frm" id="event" method="post" action="" enctype="multipart/form-data">	
			<?php e($form->hidden('Stable.posted_date',array("value"=>date('Y-m-d')))); ?>			
				<table width="92%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Add Stable </b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>			   		
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Owner <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Stable][userid]" class="look" id="user" >
							<option value="">Select Owner </option>
							<?php
							if(is_array($user_arr)) {
								foreach($user_arr as $key=>$val) :
									if($val['User']['id']==$userdata) {
										$sel="selected=selected";
									}
									else {
										$sel='';
									}
									e("<option value=".$val['User']['id']." $sel>".$val['User']['firstname']." ".$val['User']['lastname']."</option>");
								
								endforeach;							
							}					
							?>						
						</select>
						 <br><span class="error"><?php echo $form->error('Stable.userid');?>
						 </span>					</td>
				 </tr>	
				 
				 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Horse <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<div tabindex="0" style="height: 200px; width: 200px;" 
class="jScrollPaneContainer jScrollPaneScrollable"><div style="overflow:
 visible; height: auto; width: 185px; padding-right: 5px; position: 
absolute; top: -96px;" id="pane1" class="scroll-pane">
				
										<table align="center" width="100%" style="background-color:#FFFFFF">
										<?php
										if(count($listhorst)>0) {
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
													if($val['Horse']['stable_id']>0) {?>
														 <input type="checkbox" name="data[Stable][horse_id][<?php echo $key ;?>]" value="<?php echo $val['Horse']['id'] ;?>" id="<?php echo $val['Horse']['id'] ;?>" />
													<?php
													}
													else {
														e("<b><font color=#994F26>Already Assigned </font></b>");
													}
												//}
												
												?>												
												</td>
												<?php
											endforeach;								
										}										
										?>		
										</table>								
			</div><div style="height: 0px;" class="jScrollCap jScrollCapTop"></div><div
 style="width: 10px; height: 200px; top: 0px;" class="jScrollPaneTrack"><div
 style="width: 10px; height: 25px; top: 12px;" class="jScrollPaneDrag"><div
 style="width: 10px;" class="jScrollPaneDragTop"></div><div 
style="width: 10px;" class="jScrollPaneDragBottom"></div></div></div><div
 style="height: 0px;" class="jScrollCap jScrollCapBottom"></div></div>
					</td>
				 </tr>
				 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Stable Name <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Stable.stable_name',array("class"=>"look","size"=>"30")); ?>
					 	 <br><span class="error"><?php echo $form->error('Stable.stable_name');?>
						 <?php
						 if($duplicateerr>0) {
						 	e("Stable already exists");
						 }						 
						 ?>
						 </span>					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Stable Website:</td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Stable.website',array("class"=>"look","size"=>"30")); ?>
					 	 <br><span class="error"><?php echo $form->error('Stable.website');?>
						 </span>					
				     </td>
				 </tr>
				 
				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Country : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
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
							<br><span class="error"><?php echo $form->error('Stable.countryid');?>
					</td>
				  </tr>			  
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">State : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
							<span id="showregion">
								<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
									<option value="">Select state  </option>
									<?php
									if(is_array($state_arr)) {
										foreach($state_arr as $key=>$val) :									
											e("<option value=".$val['State']['id'].">".$val['State']['statename']."</option>");								
										endforeach;							
									}					
									?>						
								</select>	
							</span>
							<br><span class="error"><?php echo $form->error('Stable.state_id');?>
					</td>
				  </tr>
				  
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Town/Region: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<span id="showtown">
								<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation" >
									<option value="">Select Town/Region  </option>
									<?php
									if(is_array($town_arr)) {
										foreach($town_arr as $key=>$val) :									
											e("<option value=".$val['Town']['id'].">".$val['Town']['town']."</option>");								
										endforeach;							
									}					
									?>						
								</select>	
							</span>
							<br><span class="error"><?php echo $form->error('Stable.town_id');?>
					</td>
				  </tr>
				  		 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">About Stable:  <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->textarea('Stable.about',array("class"=>"look","rows"=>"8","cols"=>"82")); ?>
						  <br><span class="error"><?php echo $form->error('Stable.about');?>
						 </span>				    </td>
				 </tr>	
				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Stable Services:  <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->textarea('Stable.services',array("class"=>"look","rows"=>"8","cols"=>"82")); ?>
						  <br><span class="error"><?php echo $form->error('Stable.services');?>
						 </span>				    </td>
				 </tr>
				 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Stable  Image</td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->file('Stable.stable_image',array("class"=>"look")); ?>	
						<input name="button" type="button" class="button" onclick="moreimg()" value="More"/>
               			 <br />
                      <span id="imgval"> </span>
                      <input type="hidden" id="hiddval" value="" name="hiddval" />
						</td>
				 </tr>			 	 		 				 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/Stable') ;?>'" />					</td>
				  </tr>
  			  </table>
			</form>
		</td>
	</tr>		
</table>
</td>
</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 
