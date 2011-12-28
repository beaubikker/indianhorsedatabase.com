<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	$(document).ready(function(){
		$(".viewallowned").click(function(){
			$("#viewallowned").toggle("5000");			
		});	
	});		
	$(document).ready(function(){
		$(".viewallbred").click(function(){
			$("#viewallbred").toggle("5000");
		});	
	});
	function offclose() {
		document.getElementById("viewallowned").style.display="none";
	}	
	function offclose1() {
		document.getElementById("viewallbred").style.display="none";
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
					<h1 class="top"><?php e($userarr['User']['firstname']."  ".$userarr['User']['lastname']);?> </h1> 		  	
					<?php
					if($msg=="") {
					?>		  	
						
					<?php
					}
					else {
					?>
						<h1 class="top">You have successfully updated your profile</h1>					
					<?php
					}
					?>									
					</h1>									
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
							
						<div class="po_inf_mid">
							<div align="center" style="padding-left:550px;"><input class="submit_btn9" type="button" value="Edit"   onClick="window.location.href='<?php e($html->url('/user/useraccount'));?>'"></div>
							<div class="content_box">
								<div class="horse1">
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
								</div>
								<div class="horse2">																		
									<div class="form_box">
											<label class="formarea">Town/Region & Country :</label>
											<span><?php 
											if($userarr['User']['town_id']) {
												$townname=$this->requestAction('/town/townname/'.$userarr['User']['town_id']);
												e($townname['Town']['town']);											
											}
											if($userarr['User']['countryid']) {
												$countryname=$this->requestAction('/country/countryname/'.$userarr['User']['countryid']);
												e(",<br>".$countryname['Country']['country']);											
											}
											if($userarr['User']['town_id']=="") {
												e("NA");
											}
											?></span>
											<div class="clear"></div>
								  </div>
									  <?php
									  if($userarr['User']['usertype']=="P") {
									  ?>
										<div class="form_box">
											<label class="formarea">Stables :</label>
											<span><?php e($stablenamearr[0]['Stable']['stable_name']);?></span>	
											<div class="clear"></div>										
										</div>
									<?php
									}
									?>
										<?php
										if(stristr($userarr['User']['website'],'http')) {
											$http='';
										}
										else {
											$http='http://';
										}
										?>
										<div class="form_box">
											<label class="formarea">Website :</label>
											<span>
											<?php
											if($userarr['User']['website']) {
											?>
												<a href="<?php e($http);?><?php e($userarr['User']['website']);?>" target="_blank"><?php e($userarr['User']['website']);?></a></span>	
											<?php
											}
											else {
												e("NA");
											}
											?>
											<div class="clear"></div>
										</div>	
										
										<?php
										if($userarr['User']['about_me']) {	
										?>								
										<div class="form_box47">
											<label class="formarea47">About Me :</label>
											<span class="nio"><?php 
											if($userarr['User']['about_me']) {											
												e($userarr['User']['about_me']);
											}
											else {
												e("NA");
											}		
											?></span>
										</div>
										<?php
										}
										?>
								</div>
							</div>	
							<div class="classified">
								<?php
								if(count($ownerhorse_arr)>0) {
								?>
								<a class="fox12" href="javascript:void(0)">Horses owned by <?php e($userarr['User']['firstname']);?></a>
								<?php
								}
								?>
								<ul>
									<?php
									if(count($ownerhorse_arr)>0) {
										if(is_array($ownerhorse_arr)) { 
											foreach($ownerhorse_arr as $key=>$val) :
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
															<span>
																Year : <?php 
																if($val['Horse']['year']) {
																	e($val['Horse']['year']);
																	}
																else {
																	e("NA");
																}							
																?></span>
															<br>
																<span>
																<?php 
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
																?><span>
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
									<?php
									if(count($ownerhorse_allarr)>=8) {
										?>
											<div align="center"><a class="viewallowned" href="javascript:void(0)" style="background:url(http://indianhorsedatabase.com/app/webroot/img/sub_big_btn.png) no-repeat 0 1px; border: medium none; color: #000000;font-family: verdana; font-size: 14px; font-weight: bold; width:183px; height:25px; text-align:right; text-decoration:none; cursor:pointer">View All</a></div>
										<?php
									}
									?>						
								</ul>
								<?php
								if(count($breddnamearr)>0) {?>
									<a class="fox13" href="javascript:void(0)">Horses bred by <?php e($userarr['User']['firstname']);?></a>
								<?php
								}
								?>	
								
								<ul>
									<?php
									if(count($breddnamearr)>0) {
										if(is_array($breddnamearr)) { 
											foreach($breddnamearr as $key=>$val) :
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
															<br>
															<span><?php 
															$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
															e($breedname);											
															 ?>													
															<?php 
															$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
															e(",".$gender['Gender']['gender']); 
															?>
															</span>
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
									
									<?php
									if(count($allbreddnamearr)>=8) {
										?>
											<div align="center"><a class="viewallbred" href="javascript:void(0)" style="background:url(http://indianhorses.india-web-design.com/app/webroot/img/sub_big_btn.png) no-repeat 0 1px; border: medium none; color: #000000;font-family: verdana; font-size: 14px; font-weight: bold; width:183px; height:25px; text-align:center; text-decoration:none; cursor:pointer">View All</a></div>
										<?php
									}
									?>								
								</ul>							
								<?php
								if(count($listhorsesalearr)>0) {?>
									<a class="fox13" href="javascript:void(0)">Horses for sale</a>
								<?php
								}
								?>								
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
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="80" height="80" style="cursor:pointer" ></a></span>
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
	
	<span id="viewallowned" style="display:none">
			<div class="pop_up_2" style="position:absolute; top:400px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">View All Owned horse by <?php e($userarr['User']['firstname']);?></h3>
		<h4 onClick="offclose()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<hr class="line_base" />
				<table style="overflow:hidden"; width="100%" cellpadding="0" cellspacing="0" >
				<tr>	
				<?php
				if(count($ownerhorse_allarr)>0) {
				$total = count($ownerhorse_allarr);
				$cntr=1;
					if(is_array($ownerhorse_allarr)) {					
					foreach($ownerhorse_allarr as $key=>$val) :					
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
	<span id="viewallbred" style="display:none">
			<div class="pop_up_2" style="position:absolute; top:400px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">View All breeded by <?php e($userarr['User']['firstname']);?></h3>
		<h4 onClick="offclose1()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<hr class="line_base" />
				<table style="overflow:hidden"; width="100%" cellpadding="0" cellspacing="0" >
				<tr>	
				<?php
				if(count($allbreddnamearr)>0) {
				$total = count($allbreddnamearr);
				$cntr=1;
					if(is_array($allbreddnamearr)) {					
					foreach($allbreddnamearr as $key=>$val) :					
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
