<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
function del_horse(horse_id) {
	if(horse_id) {
		//if(window.confirm("Are you sure to delete")) {
			window.location.href='<?php e($html->url('/horse/userhorsedel/'));?>'+horse_id;		
		//}		
	}
}
	function details(hornamename,horseid) {
		if(parseInt(horseid)) {
			window.location.href='<?php e($html->url('/horse/details/'));?>'+hornamename+'/'+horseid ;		
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
					<h1 class="top">My Horses</h1>					
					<div class="profile_info">
						<div class="po_inf_up">
						
							<div>&nbsp;</div>
							<br>
							</div>
						<div class="po_inf_mid">
							<?php
					if(count($mypostedhorsearr)>0) {
					?>
						<div align="center" style="padding-left:585px;"><b>Sort</b> : <a href="<?php e($html->url('/horse/mylistedhorse/asc'));?>" style="text-decoration:none; color:#994F26;"><font size="+1">a</font></a>/<a href="<?php e($html->url('/horse/mylistedhorse/desc'));?>" style="text-decoration:none; color:#994F26"><font size="+1">z</font></a><br><br>
						</div>
					<?php
					}
					?>	
							<?php
							if(count($mypostedhorsearr)>0) {
								if(is_array($mypostedhorsearr)) {								
									foreach($mypostedhorsearr as $key=>$val) :
								?>
										<div class="pannel">
											<div class="big1" style="width: 90px;">
												<?php
												$imagedirectory="horseimage";
												$image=$val['Horse']['image'];
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],90,91);								
														?>									
														<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
													<?php
													}
													else {
														?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91">
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91">
													<?php
												}
												?>											
											</div>
											<div class="big2" style="width: 500px;"><p class="kits" style="width: 460px; padding-left: 20px; padding-right: 20px;">
											<span  style="cursor:pointer;" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"><a href="javascript:void(0)"><?php e($val['Horse']['name']);?></a></span><!--<br /><span>Date: <?php //e(date('F Y', strtotime($val['Horse']['posted_date']))); ?></span>-->
											<div style="float: left; width: 210px; padding-left: 20px;">&nbsp;</div>
											<div style="float: left; width: 210px; margin-left: 20px;">
											<span><?php e(substr($val['Horse']['other_details'],0,300));?></span>
											</div>
											<div style="clear: both; line-height: 0; font-size: 0;"></div>
											 </p>
											</div>
											<!--<div class="big3" style="width:315"><p class="axe"><?php //e(substr($val['Horse']['other_details'],0,300));?></p></div>-->		
										  <div class="big4">
												<input class="submit_btn9" type="button" value="Edit"  onClick="window.location.href='<?php e($html->url('/horse/edithorseinfo/'.$val['Horse']['id']));?>'"/>
												<br>
												<?php
												if($val['Horse']['sales_status']=="S" || $val['Horse']['sales_status']=="Stud" || $val['Horse']['sales_status']=="") {
													$chksalestatus=$this->requestAction('/horse/chksalesstatus/'.$val['Horse']['id']);
													if(count($chksalestatus)>0) {
														?>
															<input  type="button" value="Already For sale"  onClick="window.location.href='<?php e($html->url('/horse/edithorseforsale/'.$chksalestatus[0]['Horsesale']['id']));?>'" class="newbutton"/>
														<?php
													}
													else {	
														if($val['Horse']['deathstat']!='Y') {									
														?>												
															<input  type="button" value="Put For Sale"   onClick="window.location.href='<?php e($html->url('/horse/putforsale/'.$val['Horse']['id']));?>'" class="newbutton"/>	
													<?php
														}
													}													
												}
												?>
																								
												<?php
												if($val['Horse']['sales_status']=="Stud" || $val['Horse']['sales_status']=="S" || $val['Horse']['sales_status']=="") {													
													$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
													//e($gender['Gender']['gender']);
													if($gender['Gender']['gender']=="Stallion") {
													$chksalestatus=$this->requestAction('/horse/chkstudstatussstatus/'.$val['Horse']['id']);
													if(count($chksalestatus)>0) {
														?>
															<input  type="button" value="Already For Stud" onClick="window.location.href='<?php e($html->url('/horse/edithorseforstud/'.$chksalestatus[0]['Horseforstud']['id']));?>'" class="newbutton"/>&nbsp;&nbsp;
														<?php
													}
													else {
															if($val['Horse']['deathstat']!='Y') {	
																if($val['Horse']['gender']==2) {								    	
															?>												
															<input  type="button" value="Put For Stud"   onClick="window.location.href='<?php e($html->url('/horse/putahorseforstud/'.$val['Horse']['id']));?>'" class="newbutton"/>	
														<?php
																}
															}
														}
													}														
												}
												?>																						
												<input class="submit_btn9" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>										
											</div>						
										</div>		
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />	
									<?php
									endforeach;
								}
							}
							else  {
								e("<div align=center><font color=#FF0000><em><b>Sorry! You have not posted any horse in Indian Horse database </b></em></font></div>");	
							}
							?>				
							<div>&nbsp;</div>													
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>	
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
