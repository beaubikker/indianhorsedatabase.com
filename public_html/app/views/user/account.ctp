<?php
e($this->renderelement('topheader'));
?>
<?php
e($javascript->link('jquery-1.4.2'));
?>
</script>
<script language="javascript">
	$(document).ready(function(){
		$(".changepic").click(function(){
			$("#changepic").toggle("slow");
		});	
	});	
	
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
		
		
		function chkvalid() {
			var err=0;
			var HorseLocation=document.getElementById("HorseLocation").value;
			var HorseCountry=document.getElementById("HorseCountry").value;
			var Horsestate=document.getElementById("Horsestate").value;	
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
			if(Horsestate=="") {
				document.getElementById("Horsestate").style.border = "1px solid #FF0000";
				err++;		
			} 
			else {
				document.getElementById("Horsestate").style.border = "1px solid #7F9DB9";
			}
			if(err==0) {
				document.getElementById("showmsg").style.display="block";
				document.getElementById("showmsg").innerHTML='We are processing your information, thank you for your patience....';
				document.frm.submit();
			}
			else {
				return false;
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
					<h1 class="top">Edit Premium member profile
						<?php
						if($msg):
							?>
								<br>
								You have successfully updated your profile 
							<?php						
						endif;
						?>
					</h1>
					<form action="" method="post" enctype="multipart/form-data" name="frm">		<br>
					<?php e($form->hidden('User.edited_date',array("value"=>date('Y-m-d')))); ?>	
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>	
						<?php
						if($session->check('Message.flash')):
							?>
								<div class="messageBox" style="width: 300px;"><?php $session->flash();?></div>
							<?php						
						endif;
						?>
												
						<div class="po_inf_mid">
							<div class="content_box">
								<div class="horse1" style="width: 151px;">
								<?php
								$imagedirectory="profileimage";
								$image=$userarr['User']['image'];
								if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
									if($image!="") {
										$xy = $rsz->imgResize(rootpth()."profileimage/".$image,196,194);
									?>
										<img src="<?php e($this->webroot);?>img/profileimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
									<?php
									}
									else {
									?>
										<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="196" height="194">
									<?php
									
									}
								}
								else {
								?>
									<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="196" height="194">
								<?php							
								}							
								?>
									<p class="changepic" style="cursor:pointer; padding-left: 0; text-align: center;">Change profile picture</p>
									<span id="changepic" style="display:none; cursor:pointer">
										<input type="file" name="data[User][image]" onChange="document.frm.submit()">									
									</span>
								</div>
								<div class="horse2">																				
							<div class="form_box">
								<label class="formarea">Country:</label> 
								<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()" style="width: 210px;">
									<option value="">Select Country </option>
									<?php
									if(is_array($country_arr)) {
										foreach($country_arr as $key=>$val) :	
											if($val['Country']['id']==$userarr['User']['countryid']) {
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
									<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()" style="width: 210px;">
										<option value="">Select state  </option>
										<?php
										if(is_array($state_arr)) {
											foreach($state_arr as $key=>$val) :		
												if($val['State']['id']==$userarr['User']['state_id']) {
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
								<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation" style="width: 210px;">
									<option value="">Select Town/Region  </option>
									<?php
									if(is_array($town_arr)) {
										foreach($town_arr as $key=>$val) :		
											if($val['Town']['id']==$userarr['User']['town_id']) {
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
										
										<div class="form_box">
											<label class="formarea">Website :</label><?php e($form->text('User.website',array("size"=>"30","value"=>$userarr['User']['website'])));?>								
										</div>
										
										<div class="form_box">
											<label class="formarea">My Facebook Url :</label><?php e($form->text('User.facebook_url',array("size"=>"30","value"=>$userarr['User']['facebook_url'])));?>								
										</div>
										
										<div class="form_box">
								<label class="formarea">About Me :</label>
									<?php e($form->textarea('User.about_me',array("class"=>"formarea1","style"=>"width: 210px; height: 100px;","value"=>$userarr['User']['about_me'])));?>
										
										</div>
										<input class="mass18" type="button" value="Submit"  onClick="chkvalid()" style="cursor:pointer"/>
										<div id="showmsg" style="color: #ff0000; position: absolute; margin: -33px 0 0 220px; width: 300px; display:none"></div>
								</div>
							</div>							
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>
					</form>
					<?php /*?><?php
					if($userarr['User']['facebook_url']!="") {
					?>
						<div class="lower_link">
							<div class="vfx">
								<a href="<?php e($userarr['User']['facebook_url'])?>" target="_blank"><img src="<?php e($this->webroot);?>img//facebook.jpg" alt=""  style="cursor:pointer"/></a>
							</div>
						</div>
					<?php
					}
					?>	<?php */?>								
					<div style="clear: both; line-height: 0; font-size: 0;"></div>		
			  </div>									
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
