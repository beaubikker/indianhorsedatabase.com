<?php
e($this->renderelement('topheader'));
$userarr=$this->requestaction('/user/userdetails');
e($javascript->link('jquery1'));
?>
<script language="javascript">
	function seechange(horse_id) {
		$("#changeview").toggle("slow");
		if(parseInt(horse_id)) {
			document.getElementById("changeview").style.display="block";
			document.getElementById("changeview").innerHTML="<font color=#FF0000><strong>Processing Please wait......................</strong></font>";	
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
				 req.onreadystatechange=changeview;
				 req.open("GET","<?php echo $html->url('/horse/viewchange/'); ?>"+horse_id,true);			 
				req.send(null);					
			}		
		}
	}
	function changeview() {
		if(req.readyState==4)
		{				
			if(req.status==200)
			{	
				document.getElementById("changeview").innerHTML=req.responseText ;						
			}		
		}		
	}
	function chkmembershipstat() {
		$("#membershipstatus").toggle("slow");
	}
	
	function deletenotifivation(id) {
		window.location.href='<?php e($html->url('/user/deletenotification/'));?>'+id
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
					<div style="float: left; width: 762px;">			
					<h1 class="top">Welcome to the IHD <?php e($userarr['User']['firstname']);?>
					<?php
					if($session->check('Message.flash')):
						?>
							<?php $session->flash();?>							
						<?php						
					endif;
					?>					
					</h1>					
					<?php
					$expirearr=$this->requestAction('/user/userdetails');							
					?>												
						<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>	
						<div class="po_inf_mid">
						<?php
						if(count($notificationarr)<=0 && count($liststablearr)<=0 && count($listuserarr)<=0  && count($newuserhorsepostarr)<=0 && count($changenotiarr)<=0 && $pendingcntr<=0 && count($breederarr)<=0 && count($adderarr)<=0 && count($oldownerarr)<=0 && count($oldbrederarr)<=0)  {?>
							<h2 class="up_heading">You have no notifications</h2>	
						<?php
						}
						else {
						?>
							<h2 class="up_heading">Notifications</h2>	
							<?php }
							?>		
							<?php
								if(count($notificationarr)>0) {
									if(is_array($notificationarr)) {
										?>
										<h3 class="plus">Notification From Admin <span style="float:right; padding-right:15px;"></span></h3>
										<?php
										foreach($notificationarr as $key=>$val) :
										?>									
											<div class="box_text">
												<span style="float: left; width: 500px; display: block;"><?php
													e($val['Notification']['notification_title']);
													?></span>
													<span style="float: left; width: auto; display: block; font: normal 13px/18px Calibri; color: #000;"><strong><em><?php echo date('l dS \of F Y', strtotime($val['Notification']['posted_date'])); ?></em></strong></span>
													<img src="<?php e($this->webroot);?>img/x_button.gif" onClick="deletenotifivation('<?php e($val['Notification']['id']) ;?>')" style="float: right; padding-right: 10px; cursor: pointer;"/>
													<?php
													e("<br>");
													e($val['Notification']['notificationdetails']);													
												?>
												<!--<div align="left" style="padding-left:585px">
													<strong><em><?php //echo date('l dS \of F Y', strtotime($val['Notification']['posted_date'])); ?></em></strong>
												</div>-->
											</div>
										<?php
											endforeach;
										}
									}
									?>							
							<?php
								if(count($liststablearr)>0) {
									if(is_array($liststablearr)) {
										?>
										<h3 class="plus">Stable<span style="float:right; padding-right:15px;"></span></h3>
										<?php
										foreach($liststablearr as $key=>$val) :
										?>									
											<p class="box_text">
												<a href="<?php e($html->url('/stable/viewprofile/'.$val['Stable']['id']));?>" style="color:#CBBF84; text-decoration:none">
													<?php 
													$usernamearr=$this->requestAction('/user/username/'.$val['Stable']['userid']);
													//e("<b>".$usernamearr['User']['firstname']."     ".$usernamearr['User']['lastname']."</b>");
													?> 
													<?php e($val['Stable']['stable_name']);?> has been updated by <?php e("<b>".$usernamearr['User']['firstname']."     ".$usernamearr['User']['lastname']."</b>");?>
													.</a>
													<a href="<?php e($html->url('/user/stabledelsubscribtionfront/'.$val['Stablesubscribtion']['id']));?>"><img src="<?php e($this->webroot);?>img/x_button.gif" style="cursor:pointer" border="0"  align="right"/></a>
											</p>
										<?php
												endforeach;
										}
									}
									?>					
									
								<?php
								if(count($listuserarr)>0) {
									if(is_array($listuserarr)) {
										?>
										<h3 class="plus">User<span style="float:right; padding-right:15px;"></span></h3>
										<?php
										foreach($listuserarr as $key=>$val) :
										?>									
											<p class="box_text">
												<a href="<?php e($html->url('/user/viewaccount/'.base64_encode($val['User']['id'])));?>" style="color:#CBBF84; text-decoration:none">
												<?php 
												$usernamearr=$this->requestAction('/user/username/'.$val['Usersubscription']['usrid']);
												e("<b>".$usernamearr['User']['firstname']."     ".$usernamearr['User']['lastname']."</b>");
												?>'s profile has recently been updated</a>
											<a href="<?php e($html->url('/user/usersubscriptiondel/'.$val['Usersubscription']['id']));?>"><img src="<?php e($this->webroot);?>img/x_button.gif" style="cursor:pointer; padding-right: 5px;"  align="right" border="0"/></a>
											</p>
										<?php
												endforeach;
										}
									}
									?>									
								<?php
								if(count($listhorsearr)>0) {
									if(is_array($listhorsearr)) {
										?>
										<h3 class="plus">Horse<span style="float:right; padding-right:15px;"></span></h3>
											<?php
											foreach($listhorsearr as $key=>$val) :
											?>									
													<p class="box_text">
													<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'])."/".$val['Horse']['id']));?>" style="color:#CBBF84; text-decoration:none">
													Profile of <?php e("<b>".$val['Horse']['name']."</b>");?> has been updated 
													<?php if($val['Horse']['ownerid']) { ?> by <?php 
													$usernamearr=$this->requestAction('/user/username/'.$val['Horse']['ownerid']);
													e("<b>".$usernamearr['User']['firstname']."     ".$usernamearr['User']['lastname']."</b>");
													?></a>
													<?php } ?>												
													<a href="<?php e($html->url('/user/horsedeletesubscription/'.$val['Horsesubscribtion']['id']));?>"><img src="<?php e($this->webroot);?>img/x_button.gif" style="cursor:pointer; padding-right: 5px;"  align="right" border="0"/></a>
													</p>
										<?php
												endforeach;
										}
									}
									?>								
									<?php
								if(count($newuserhorsepostarr)>0) {
									if(is_array($newuserhorsepostarr)) {
										?>
											<?php
											foreach($newuserhorsepostarr as $key=>$val) :
											if($val['Horse']['ownerid']!="") {
											?>									
													<p class="box_text">
													<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'])."/".$val['Horse']['id']));?>" style="color:#CBBF84; text-decoration:none">
														<?php 
														if($val['Horse']['ownerid']!="") {
														$usernamearr=$this->requestAction('/user/username/'.$val['Horse']['ownerid']);
														e("<b>".$usernamearr['User']['firstname']."     ".$usernamearr['User']['lastname']."</b>");
														?> added new horse named as <?php e("<b>".$val['Horse']['name']."</b>");
														}
														?></a>														
													</p>
										<?php
											}
												endforeach;
										}
									}
									?>
									<?php
									$horseexistsarr='';
									$pendingcntr=0;
									if(count($changenotiarr)>0) {
										foreach($changenotiarr as $key=>$val) :
												if($val['Changerequest']['requestedby_id']!=$userid) {
													if($val['Changerequest']['acceptedbyid']!=$userid) {
														$pendingcntr++;										
													}
												}
										endforeach;	
									}								
									if(count($changenotiarr)>0 && $pendingcntr>0) {										
									?>	
											<h3 class="plus">Pending change requests<span style="float:right; padding-right:15px;"></span></h3>	
											<?php
											if(is_array($changenotiarr)) {
											?>
												<?php
												foreach($changenotiarr as $key=>$val) :
														if($val['Changerequest']['requestedby_id']!=$userid) {
															if($val['Changerequest']['acceptedbyid']!=$userid) {
															$horseexistsarr[]=$val['Changerequest']['horse_id'] ;
													?>									
																<p class="box_text">
																	A user has requested changes of <b><?php e($val['Changerequest']['name']);?></b>. Can you approve these changes?<br><br> 
																	<a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
																		<input type="button" class="newbutton" value="See Change" onClick="seechange('<?php e($val['Changerequest']['horse_id']);?>')" style="cursor:pointer">
																	</a>
																	&nbsp;&nbsp;<a href="<?php e($html->url('/horse/acceptchange/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/owner'));?>" style="color:#CBBF84; text-decoration:none">Yes </a> &nbsp;&nbsp;<a href="<?php e($html->url('/horse/reject/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/owner')) ;?>" style="color:#CBBF84; text-decoration:none">No </a>
																</p>
													<?php
															}
														}
												endforeach;
												}											
											?>								
									<?php
									}
									?>		
									
									<?php
									if(count($oldownerarr)>0) {
									?>	
											<?php
											if(is_array($oldownerarr)) {
											?>
												<?php
												foreach($oldownerarr as $key=>$val) :
														if($val['Changerequest']['requestedby_id']!=$userid) {
															if($val['Changerequest']['acceptedbyid']!=$userid) {
																if(!in_array($val['Changerequest']['horse_id'],$horseexistsarr)) {
																	$breadexistsarr[]=$val['Changerequest']['horse_id'];
													?>									
																<p class="box_text">
																	A user has requested changes of <b><?php e($val['Changerequest']['name']);?></b>. Can you approve these changes?<br><br> 
																	<a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
																		<input type="button" class="newbutton" value="See Change" style="cursor:pointer" onClick="seechange('<?php e($val['Changerequest']['horse_id']);?>')" >
																	</a>&nbsp;&nbsp;<a href="<?php e($html->url('/horse/acceptchange/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/owner'));?>" style="color:#CBBF84; text-decoration:none">Yes </a> &nbsp;&nbsp;<a href="<?php e($html->url('/horse/reject/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/breeder')) ;?>" style="color:#CBBF84; text-decoration:none">No </a>
																</p>
													<?php	
																}
															}
														}
												endforeach;
												}											
											?>								
									<?php
									}
									?>	
									
									
									<?php
									if(count($oldbrederarr)>0) {
									?>	
											<?php
											if(is_array($oldbrederarr)) {
											?>
												<?php
												foreach($oldbrederarr as $key=>$val) :
														if($val['Changerequest']['requestedby_id']!=$userid) {
															if($val['Changerequest']['acceptedbyid']!=$userid) {
																if(!in_array($val['Changerequest']['horse_id'],$horseexistsarr)) {
																	$breadexistsarr[]=$val['Changerequest']['horse_id'];
													?>									
																<p class="box_text">
																	A user has requested changes of <b><?php e($val['Changerequest']['name']);?></b>. Can you approve these changes?<br><br> 
																	<a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
																		<input type="button" class="newbutton" value="See Change" style="cursor:pointer" onClick="seechange('<?php e($val['Changerequest']['horse_id']);?>')" >
																	</a>&nbsp;&nbsp;<a href="<?php e($html->url('/horse/acceptchange/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/owner'));?>" style="color:#CBBF84; text-decoration:none">Yes </a> &nbsp;&nbsp;<a href="<?php e($html->url('/horse/reject/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/breeder')) ;?>" style="color:#CBBF84; text-decoration:none">No </a>
																</p>
													<?php	
																}
															}
														}
												endforeach;
												}											
											?>								
									<?php
									}
									?>								
															
									<?php
									if(count($breederarr)>0) {
									?>	
											<?php
											if(is_array($breederarr)) {
											?>
												<?php
												foreach($breederarr as $key=>$val) :
														if($val['Changerequest']['requestedby_id']!=$userid) {
															if($val['Changerequest']['acceptedbyid']!=$userid) {
																if(!in_array($val['Changerequest']['horse_id'],$horseexistsarr)) {
																	$breadexistsarr[]=$val['Changerequest']['horse_id'];
													?>									
																<p class="box_text">
																	A user has requested changes of <b><?php e($val['Changerequest']['name']);?></b>. Can you approve these changes?<br><br> 
																	<a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
																		<input type="button" class="newbutton" value="See Change" style="cursor:pointer" onClick="seechange('<?php e($val['Changerequest']['horse_id']);?>')" >
																	</a>&nbsp;&nbsp;<a href="<?php e($html->url('/horse/acceptchange/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/breeder'));?>" style="color:#CBBF84; text-decoration:none">Yes </a> &nbsp;&nbsp;<a href="<?php e($html->url('/horse/reject/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/breeder')) ;?>" style="color:#CBBF84; text-decoration:none">No </a>
																</p>
													<?php	
																}
															}
														}
												endforeach;
												}											
											?>								
									<?php
									}
									?>
									<?php
									if(count($adderarr)>0) {
									?>
										<?php
											if(is_array($adderarr)) {
											?>
											
												<?php
												foreach($adderarr as $key=>$val) :
														if($val['Changerequest']['requestedby_id']!=$userid) {
															if($val['Changerequest']['acceptedbyid']!=$userid) {
																if(@!in_array($val['Changerequest']['horse_id'],$horseexistsarr) && !@in_array($val['Changerequest']['horse_id'],$horseexistsarr)) {
													?>									
																<p class="box_text">
																	A user has requested changes of <b><?php e($val['Changerequest']['name']);?></b>. Can you approve these changes?<br><br> 
																		<a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
																			<input type="button" class="newbutton" value="See Change" onClick="seechange('<?php e($val['Changerequest']['horse_id']);?>')" style="cursor:pointer">
																		</a>
																		&nbsp;&nbsp;<a href="<?php e($html->url('/horse/acceptchange/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/adder'));?>" style="color:#CBBF84; text-decoration:none">Yes </a> &nbsp;&nbsp;<a href="<?php e($html->url('/horse/reject/'.$val['Changerequest']['horse_id'].'/'.$val['Changerequest']['id'].'/adder')) ;?>" style="color:#CBBF84; text-decoration:none">No </a>
																</p>
													<?php		
																}
															}
														}
												endforeach;
												}											
											?>								
									<?php									
									}
									if(count($notificationarr)<=0 && count($liststablearr)<=0 && count($breederarr)<=0  && count($newuserhorsepostarr)<=0 && count($adderarr)<=0 && count($changenotiarr)<=0 )  {
										?><div align="left" style="padding-left:16px"> <?php //e("<b><font color=#FF0000><em>You have no notifications</em></font></b>");?></div>									
									<?php
									}								
									?>						  	
						  <div class="po_inf_btm">&nbsp;</div>						  				
					</div>											
			  </div>					  
			  			<div class="profile_info">
								<div class="po_inf_up">&nbsp;</div>	
								<div class="po_inf_mid">
										<h2 class="up_heading" style="cursor:pointer" onClick="chkmembershipstat()">Click here for membership status information</h2>	
										<div class="alert_box"  id="membershipstatus" style="overflow:auto; width:600px;height:auto; margin-left:20px; margin-top:20px; display:none">
											<img src="<?php e($this->webroot);?>img/alert.png" alt="bb" style="float:left; margin-right:20px;" />
											<p class="alert" style="float:left;">Your membership will expire on <?php e( date('l dS \of F Y', strtotime($expirearr['User']['membership_exipre_date'])));?><span>&nbsp;<br />&nbsp;to extend your membership.&nbsp;&nbsp;<a href="<?php e($html->url('/user/extendmembership'));?>">Click here</a></span></p>
											<div>&nbsp;</div>
										</div>	
										<div class="clear"></div>
									</div>
								<div class="po_inf_btm">&nbsp;</div>	
							</div>  				
						<div class="profile_info">
							<div class="po_inf_up">&nbsp;</div>
							<div class="po_inf_mid">
								<h3>What would you like to do ?</h3>
								<ul>
									<li><a href="<?php e($html->url('/horse/addhorse'));?>">Add a new Horse</a></li>
									<li><a href="<?php e($html->url('/horse/mylistedhorse'));?>">Put up a Horse for sale</a></li>
									<li><a href="<?php e($html->url('/horse/mylistedhorse'));?>">Put up a Horse for stud</a></li>
									<li><a href="<?php e($html->url('/horse/mylistedhorse'));?>">View your added Horses</a></li>
									<li><a href="<?php e($html->url('/stable/stableprofile'));?>">Create or edit your Stable profile page</a></li>
									<li><a href="<?php e($html->url('/user/account'));?>">Edit your personal profile page</a></li>									
								</ul>
							</div>
							<div class="po_inf_btm">&nbsp;</div>						
						</div>
					</div>																	
					<?php
					e($this->renderElement('pemiumuservariouslogin'));					
					?>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>				
			  </div>				
				<div class="bottom"><img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" /></div>				
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>		
</body>
</html>
<div style="display: none; width: 450px !important; padding-right: 0; margin-top: -160px; margin-left: -290px;" id="offsping" class="popup_block">
		<div style="overflow-y: scroll; overflow-x: hidden; height: 400px;">
				<div id="changeview">					
					<div style="width: 200px; float: right;"></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>