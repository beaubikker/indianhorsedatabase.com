<?php
e($this->renderelement('topheader'));
?>
<?php e($html->css('skin1'));?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#mycarousel').jcarousel();
	});
	$(document).ready(function(){
		$(".viewallbred").click(function(){
			$("#viewallbred").toggle("5000");
		});	
	});	
	$(document).ready(function(){
		$(".bredhorse").click(function(){
			$("#bredhorse").toggle("5000");
		});	
	});
	function offclose1() {
		document.getElementById("viewallbred").style.display="none";
	}	
	function offclose() {
		document.getElementById("bredhorse").style.display="none";
	}
	jQuery(document).ready(function() {
		jQuery('#mycarouse2').jcarousel();
	});
	function imagereplace(image,width,height) {
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/multiplestableimage/"+image+" height="+height+" width="+width+" align=middle style=padding-left:30px>";
	}
	function mainimagereplace(imagedirectory,image,width,height) {
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/"+imagedirectory+"/"+image+" height="+height+" width="+width+"+ align=middle style=padding-left:30px>";
	}
	function showimage(id) {
		document.getElementById("ownerhorse_"+id).style.display="block";
	}
	function noimage(id) {
		document.getElementById("ownerhorse_"+id).style.display="none";
	}
	
	function showbredimage(id) {
		document.getElementById("brehhorse_"+id).style.display="block";	
	}	
	function noshowbredimage(id) {
		document.getElementById("brehhorse_"+id).style.display="none";
	}	
	function del_stable(stable_id) {
		if(stable_id) {
			if(confirm("Are you sure to delete")) {
				window.location.href='<?php e($html->url('/stable/stabledelete/'));?>'+stable_id
			}
		}
	}
</script>
</head>
<body>		
	<div id="wrapper_parrent">
		<div class="sign_in_parrent">
			<?php e($this->renderelement('search'));?>
		</div>
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
					<h1 class="top"><?php e($stablearr['Stable']['stable_name']);?></h1>
					<?php
					if($session->check('Message.flash')):
						?>
							<div align="center"><h1 class="top"><?php $session->flash();?></h1></div>					
						<?php						
					endif;
					?>				
					<div class="profile_info" style="padding-bottom: 0;">
						<div class="po_inf_up">&nbsp;</div>
						
						
							
						<div class="po_inf_mid">
							<div class="big4" align="center" style="padding-left:450px">
								<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like show_faces="false" width="450"></fb:like><br><br>
									
								</div>							
							<div class="combo">
								<div class="vtop">
									<span id="mainimage">
									<?php
									$imagedirectory="stable_image";
									$image=$stablearr['Stable']['stable_image'];
									if($image!="") {
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."stable_image/".$stablearr['Stable']['stable_image'],379,440);								
											?>									
											<img src="<?php e($this->webroot);?>img/stable_image/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>" style="padding-left:30px">
										<?php
										}
										else {
											?>
											<img src="<?php e($this->webroot);?>img/noimageavailable.jpeg" alt="" width="379" height="300">
											<?php
										}
									}
									else {
										?>
											<img src="<?php e($this->webroot);?>img/noimageavailable.jpeg" alt="" width="379" height="300">
										<?php
									}
									?>	
									</span>	
									<br>
									<?php
							if(count($mulimage_arr)>0) {
							?>
							<div class="photo">
								<ul>
									<div class=" jcarousel-skin-tango">
						<div style="position: relative; 
							display: block;" class="jcarousel-container 
							jcarousel-container-horizontal">
							<div style="overflow: hidden; position: 
							relative;" class="jcarousel-clip jcarousel-clip-horizontal"><ul 
							style="overflow: hidden; position: relative; top: 0px; margin: 0px; 
							padding: 0px; left: -255px; width: 750px;" id="mycarousel" 
							class="jcarousel-list jcarousel-list-horizontal">
							
							 <li jcarouselindex="1" style="float: left; height:150px; list-style: none outside 
							none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 
							jcarousel-item-1-horizontal"> <a href="javascript:void(0)"  onmouseover="mainimagereplace('<?php e($imagedirectory);?>','<?php e($image);?>','<?php e($xy[0]) ;?>','<?php e($xy[1]) ;?>')" >
							<?php
								if($image!="") {
									if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										?>
										<img src="<?php e($this->webroot);?>img/<?php e($imagedirectory);?>/<?php e($image);?>" width="77" height="69">
									<?php
									}
								}
								?> </a> 
								</li>
							
						<?php		
						if(is_array($mulimage_arr)){ 
							foreach($mulimage_arr as $key=>$val) :
							$imagedirectory="multiplestableimage";
							$image=$val['Stableimage']['image'];
							if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy1 = $rsz->imgResize(rootpth()."multiplestableimage/".$image,379,440);
						?>	
							
						<li jcarouselindex="1" style="float: left; height:120px; list-style: none outside 
						none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 
						jcarousel-item-1-horizontal">
						<a href="javascript:void(0)"  onmouseover="imagereplace('<?php e($image);?>','<?php e($xy1[0]) ;?>','<?php e($xy1[1]) ;?>')">
							<img src="<?php e($this->webroot);?>img/multiplestableimage/<?php e($image);?>" alt="" width="77" 
							height="69">
						</a> 						
						</li>
						<?php
							}
							endforeach;
						}
						?>   
						</ul></div><div disabled="false" style="display: block;" 
						class="jcarousel-prev jcarousel-prev-horizontal"></div><div 
						disabled="false" style="display: block;" class="jcarousel-next 
						jcarousel-next-horizontal"></div></div></div>								
								</ul>
							</div>	
					   <?php
					   }
					   ?>															
								</div>
								<div class="ytop" style="width:350px; margin-left:20px;">
									<p><strong style="color: #994F26;">Town/Region & Country :</strong><br> 
									<?php										
										if($stablearr['Stable']['town_id']) {
											$townname=$this->requestAction('/town/townname/'.$stablearr['Stable']['town_id']);
											e($townname['Town']['town']);											
										}
										//e($stablearr['Stable']['country_id']);
										if($stablearr['Stable']['country_id']) {
											$countryname=$this->requestAction('/country/countryname/'.$stablearr['Stable']['country_id']);
											e(",".$countryname['Country']['country']);											
										}
									?>								
									</p>
									<p><strong style="color: #994F26;">Owner / Manager:</strong><br>
									  <?php 
									 $username=$this->requestAction('/user/username/'.$stablearr['Stable']['userid']);
									 ?>
									 <a href="<?php e($html->url('/user/viewaccount/'.base64_encode($username['User']['id'])));?>" style="color:#CBB056; text-decoration:none">
										<?php
										 e($username['User']['firstname']."  ".$username['User']['lastname']) ;
										 ?>
									 </a></p>
									<p><strong style="color: #994F26;">Website:</strong><br><?php e($stablearr['Stable']['website']);?></p>
									<p><strong style="color: #994F26;">About:</strong><br><?php e($stablearr['Stable']['about']);?></p>
									<p><strong style="color: #994F26;">Services:</strong><br><?php e($stablearr['Stable']['services']);?></p>									
								</div>
							</div>				
						</div>						
											
					</div>	
					<div id="manbox" style="background:#ffefce; overflow:hidden; width:758px; border: 1px solid #DACC9F;">	
						<?php
						if(count($horselistarr)>0) {
						?>
						<div class="slider">
							<a class="hor1" href="javascript:void(0)" style="cursor:default">Horses living here </a><br />	
								<div class="clear"></div>				
									<div class="classified">
									<?php
									if(count($horsearr)>7) {
										?>
											<br><div style="float: right;"><a class="viewallbred" href="javascript:void(0)" style="background:url(http://indianhorses.india-web-design.com/app/webroot/img/sub_big_btn.png) no-repeat center 1px; border: medium none; color: #fff;font-family: verdana; font-size: 13px; font-weight: bold; width:183px; height:30px; line-height:25px; text-align:center; display:block; text-decoration:none; cursor:pointer">View All</a></div>
											<div style="clear: both; font-size: 0; line-height: 0;"></div>
										<?php
									}
									?>	
									<ul>
									<?php
									if(count($horselistarr)>0) {										
										if(is_array($horselistarr)) { 
											foreach($horselistarr as $key=>$val) :
											$imagedirectory="horseimage";
											$image=$val['Horse']['image'];											
											?>
												<li>
													<div align="center"><b><?php e($val['Horse']['name']);?></b></div><br>
													<div onMouseOver="showimage('<?php e($val['Horse']['id']);?>')" onMouseOut="noimage('<?php e($val['Horse']['id']);?>')">
													<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'].'/'.$val['Horse']['id'])));?>">
														<?php
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],80,80);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($val['Horse']['image']);?>" width="<?php e($xy[0]) ;?>" height="<?php e($xy[1]) ;?>">
																<?php
															}
														}
														else {
															?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="80" height="80" style="cursor:pointer" >
															<?php
														}
														?>
													</a>
													<div id="ownerhorse_<?php e($val['Horse']['id']);?>" style="display: none; position: absolute;" class="small_box_0">
														<div>	
															<span>Year :
															 <?php 
															if($val['Horse']['year']) {
																e($val['Horse']['year']);
															}
															else {
																e("NA");
															}									
															?></span>	
															<br><span><?php 
															$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
															e($breedname);											
															 ?>													
															<?php 
															$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
															e(",".$gender['Gender']['gender']); 
															?></span>
															<br>
															<span>Sire :
															<?php 
																if($val['Horse']['sire']) {
																	e($val['Horse']['sire']);
																}
																else {
																	e("NA");
																}									
																?>
															</span>
															
															<br>
															<span>Dam :
															<?php 
																if($val['Horse']['dam']) {
																	e($val['Horse']['dam']);
																}
																else {
																	e("NA");
																}									
																?>
															</span>	
																			
														</div>
													</div>
													</div>
												</li>
											
										<?php
											//}
											endforeach;				
									}
									}
									?>														
								</ul>	
																						
							</div>								
						</div>	
						<?php
						}
						?>
						<div class="clear"></div>	
						<?php
						if(count($horsebred_arr)>0) {	
						?>	
						<div class="slider" style="margin-top:40px;">
							<a class="hor1" href="javascript:void(0)" style="cursor:default;">Horses Bred Here</a><br />	
								<div class="clear"></div>				
									<div class="classified">
									<?php
									if(count($bredall)>6) {
										?>
											<br><div style="float: right;"><a class="bredhorse" href="javascript:void(0)" style="background:url(http://indianhorses.india-web-design.com/app/webroot/img/sub_big_btn.png) no-repeat center 1px; border: medium none; color: #fff;font-family: verdana; font-size: 13px; font-weight: bold; width:183px; height:30px; line-height:25px; text-align:center; display:block; text-decoration:none; cursor:pointer">View All</a></div>
											<div style="clear: both; font-size: 0; line-height: 0;"></div>
										<?php
									}
									?>	
									<ul>
									<?php
									if(count($horsebred_arr)>0) {
										if(is_array($horsebred_arr)) { 
											foreach($horsebred_arr as $key=>$val) :
											$imagedirectory="horseimage";
											$image=$val['Horse']['image'];											
											?>
												<li>
													<div align="center"><b><?php e($val['Horse']['name']);?></b></div><br>
													<div onMouseOver="showbredimage('<?php e($val['Horse']['id']);?>')" onMouseOut="noshowbredimage('<?php e($val['Horse']['id']);?>')">
													<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'].'/'.$val['Horse']['id'])));?>">
														<?php
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],80,80);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($val['Horse']['image']);?>" width="<?php e($xy[0]) ;?>" height="<?php e($xy[1]) ;?>">
																<?php
															}
														}
														else {
															?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="80" height="80" style="cursor:pointer" >
															<?php
														}
														?>
													</a>																							
													<div id="brehhorse_<?php e($val['Horse']['id']);?>" style="display: none; position: absolute;" class="small_box_0">
														<div>	
															<span>Year :
															 <?php 
															if($val['Horse']['year']) {
																e($val['Horse']['year']);
															}
															else {
																e("NA");
															}									
															?></span>	
															<br><span><?php 
															$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
															e($breedname);											
															 ?>													
															<?php 
															$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
															e(",".$gender['Gender']['gender']); 
															?></span>
															<br>
															<span>Sire :
															<?php 
																if($val['Horse']['sire']) {
																	e($val['Horse']['sire']);
																}
																else {
																	e("NA");
																}									
																?>
															</span>
															<br>
															<span>Dam :
															<?php 
																if($val['Horse']['dam']) {
																	e($val['Horse']['dam']);
																}
																else {
																	e("NA");
																}									
																?>
															</span>	
														</div>	
														</div>
													</div>										
												</li>
										<?php
											//}
											endforeach;
										}
									}
									?>														
								</ul>															
							</div>	
							</div>	
							<?php
							}
							?>
							<div class="clear"></div>	
							<?php
							if(count($listhorsesalearr)>0) {
							?>
							<div class="slider" style="margin-top:40px;">
							<a class="hor1" href="javascript:void(0)" style="cursor:default;">Horses For Sale here</a><br />	
								<div class="clear"></div>				
									<div class="classified">										
									<ul>
									<?php
									if(count($listhorsesalearr)>0) {
										$cntr=1;
										if(is_array($listhorsesalearr)) { 
											foreach($listhorsesalearr as $key=>$val) :
											$imagedirectory="horseimage";
											$image=$val['Horse']['image'];											
											?>
												<li>
													<div align="center"><b><?php e($val['Horse']['name']);?></b></div><br>
													<div onMouseOver="showsalehorse('<?php e($val['Horse']['id']);?>')" onMouseOut="noshowsalehorse('<?php e($val['Horse']['id']);?>')">
													<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'].'/'.$val['Horse']['id'])));?>">
														<?php
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],80,80);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($val['Horse']['image']);?>" width="<?php e($xy[0]) ;?>" height="<?php e($xy[1]) ;?>">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" width="80" height="80" alt="" style="cursor:pointer" >
																<?php
														}
														?>
													</a>																						
													<div id="salehorse_<?php e($val['Horse']['id']);?>" style="display: none; position: absolute;" class="small_box_0">
														<div>	
															<span>Year :
															 <?php 
															if($val['Horse']['year']) {
																e($val['Horse']['year']);
															}
															else {
																e("NA");
															}									
															?></span>	
															<br><span><?php 
															$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
															e($breedname);											
															 ?>													
															<?php 
															$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
															e(",".$gender['Gender']['gender']); 
															?></span>
															<br>
															<span>Sire :
															<?php 
																if($val['Horse']['sire']) {
																	e($val['Horse']['sire']);
																}
																else {
																	e("NA");
																}									
																?>
															</span>
															<br>
															<span>Dam :
															<?php 
																if($val['Horse']['dam']) {
																	e($val['Horse']['dam']);
																}
																else {
																	e("NA");
																}									
																?>
															</span>														</div>	
															</div>
												  </div>												</li>
										<?php
											$cntr++;
											//}
											endforeach;
										}
									}
									?>														
								</ul>															
							</div>	
							</div>	
							<?php
							}
							?>											
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
	
	
	<span id="viewallbred" style="display:none">
			<div class="pop_up_2" style="position:absolute; top:400px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Listed Horse</h3>
		<h4 onClick="offclose1()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<hr class="line_base" />
				<table style="overflow:hidden"; width="100%" cellpadding="0" cellspacing="0" >
				<tr>	
				<?php
				if(count($horsearr)>0) {
				$total = count($horsearr);
				$cntr=1;
					if(is_array($horsearr)) {					
					foreach($horsearr as $key=>$val) :					
					?>					
					<td style=" padding: 60px 0 0 40px;">
						<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
							<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'].'/'.$val['Horse']['id'])));?>">
						<?php
							$imagedirectory="horseimage";						
							$image=$val['Horse']['image'] ;
							if($image!="") {
								if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
									$xy = $rsz->imgResize(rootpth()."horseimage/".$image,187,182);
								?>
									<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" >
								<?php
								}	
								else {
									?>
										<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182">
									<?php
								}	
							}	
							else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182">
							<?php
							}			
						?>	
						</a>					
						<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
					</td>
					<?php
					if($cntr%2!=0) {?>
						
					<?php
					}
					else {
					?>
					
					<?php
					}
					if($cntr%2==0) {
						e("</tr><tr>");
					}
					?>
					<?php
					$cntr++;
					endforeach;
					}		
				}				
				?>			
			</table>		
	</div>
	</span>
	<span id="bredhorse" style="display:none">
			<div class="pop_up_2" style="position:absolute; top:400px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Listed Horse</h3>
		<h4 onClick="offclose()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<hr class="line_base" />
				<table style="overflow:hidden"; width="100%" cellpadding="0" cellspacing="0" >
				<tr>	
				<?php
				if(count($bredall)>0) {
				$total = count($bredall);
				$cntr=1;
					if(is_array($bredall)) {					
					foreach($bredall as $key=>$val) :					
					?>					
					<td style=" padding: 60px 0 0 40px;">
						<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
							<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'].'/'.$val['Horse']['id'])));?>">
						<?php
							$imagedirectory="horseimage";						
							$image=$val['Horse']['image'] ;
							if($image!="") {
								if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
									$xy = $rsz->imgResize(rootpth()."horseimage/".$image,187,182);
								?>
									<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" >
								<?php
								}	
								else {
									?>
										<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182">
									<?php
								}	
							}	
							else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182">
							<?php
							}			
						?>	
						</a>					
						<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
					</td>
					<?php
					if($cntr%2!=0) {?>
						
					<?php
					}
					else {
					?>
					
					<?php
					}
					if($cntr%2==0) {
						e("</tr><tr>");
					}
					?>
					<?php
					$cntr++;
					endforeach;
					}		
				}				
				?>			
			</table>		
	</div>
	</span>
		
</body>
</html>
