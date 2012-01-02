						<div class="panne25" style="height: 218px;">
									<?php
									if($firsthirerchysiredam[0]['Horse']['sire']!="") {
										$horprifilesire5=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam[0]['Horse']['dam']!="") {
										$horprifilesire6=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam[0]['Horse']['dam']);
									}
									if($firsthirerchysiredam2[0]['Horse']['sire']!="") {
										$horprifilesire7=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam2[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam2[0]['Horse']['dam']!="") {
										//e($firsthirerchysiredam2[0]['Horse']['dam']
										$horprifilesire8=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam2[0]['Horse']['dam']);
									}
									if($firsthirerchysiredam3[0]['Horse']['sire']!="") {
										$horprifilesire9=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam3[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam3[0]['Horse']['dam']!="") {
										$horprifilesire10=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam3[0]['Horse']['dam']);
									}
									if($firsthirerchysiredam4[0]['Horse']['sire']!="") {
										$horprifilesire11=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam4[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam4[0]['Horse']['dam']!="") {
										$horprifilesire12=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam4[0]['Horse']['dam']);
									}
									?>
						
						
							<div class="magic21" style="background-color:#feefcd; border-bottom: 1px solid #E7D5A3;"><h3>Pedigree</h3></div>
							<div>
								<div class="poll" style="text-align: center; line-height: 167px; height: 167px;"><h3 style="padding: 0;"><?php e($horsearr['Horse']['name']);?></h3></div>
								<div class="poll1" style="height: 167px;">
									<div class="magic" style="height: 83px; line-height: 83px; text-align: center; color: #CBB056; position: relative;">
										<div>
										  <?php
										  //e($horsearr['Horse']['sire']."test");
										   if($horsearr['Horse']['sire']!="") {
												$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['sire_id']);
												//pr($chksirearr) ;
												$frststendsire=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['sire_id']);
												//pr($chksirearr);
												if(count($chksirearr)>0) {
													?>
										<a href="javascript:void(0)" style="color:#994F26; text-decoration:none" onMouseOver="listfirstsirehorseinfo()" onMouseOut="notimageforfirstsire()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
										<?php
												}	
												else {
													 e($horsearr['Horse']['sire']);
												}
										  }
										  ?>
										</div>
										<div class="small_boxsirefirstsire" id="smaallimageforfirstsire" style="display: none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
								<?php			
								$firstsirenamearr=$this->requestaction('/horse/firsrsirenamelist/'.$horsearr['Horse']['sire']);	
								$firstdamnamearr=$this->requestaction('/horse/firstdamelist/'.$horsearr['Horse']['dam']);
								if(count($chksirearr)>0) {
								?>	
									<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
										<?php
										$imagedirectory="horseimage";
										$image=$chksirearr[0]['Horse']['image'] ;
										if($image!="") {
											if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
											?>
												<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
											<?php
											}
											else {
												?>
													<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
												<?php
											}
										}
										else {
											?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
											<?php
										}
										?>			
									<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?>
									<br />
									<?php e($chksirearr[0]['Horse']['year']);?></div>
									<div class="clear"></div>			
								<?php
								}
								?>
								</div>
									</div>
									
									<div class="magic1" style="height: 83px; line-height: 83px; text-align: center; color: #CBB056; position: relative;">
										<div>
										  <?php
										  if($horsearr['Horse']['dam']!="") {
												$horsedamarr=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['dam_id']);
												$seconddam=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['dam_id']);
												//pr($chksirearr);
												if(count($horsedamarr)>0) {
													?>
													<a href="javascript:void(0)" style="color:#994F26; text-decoration:none" onMouseOver="listfirstdamhorseinfo()" onMouseOut="notimageforfirstdam()" onClick="details('<?php e(str_replace(" ", "-",$horsedamarr[0]['Horse']['name']));?>','<?php e($horsedamarr[0]['Horse']['id']);?>')"><?php e($horsedamarr[0]['Horse']['name']);?></a>
												<?php
												}	
												else {
													 e($horsearr['Horse']['dam']);
												}
										  }
										  ?>
										  </div>
									  <div class="small_boxsirefirstdam" id="smaallimageforfirstdam" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
										<?php
										if(count($horsedamarr)>0) {
										?>	
											<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($horsedamarr[0]['Horse']['name']);?></div>
												<?php
												$imagedirectory="horseimage";
												$image=$horsedamarr[0]['Horse']['image'] ;
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
													?>
														<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
													<?php
													}
													else {
														?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
													<?php
												}
												?>			
											<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;">
											<?php e($breedname=$this->requestaction('/horse/breedname/'.$horsedamarr[0]['Horse']['breed_id']));?>
											<br />
											<?php e($horsedamarr[0]['Horse']['year']);?></div>
											<div class="clear"></div>			
										<?php
										}
										else {
											e("<div align=center><em>No Info </em></div>");
										}
										?>
										</div>
									</div>
								</div>
								<div class="poll2">
									<?php									
									//if(count($firstsirenamearr)>0) {		
									?>									
										<div class="doom0" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($frststendsire[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['sire_id']);
													$hierchsire=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="listfrstsireinfo()" onMouseOut="notlistfrstsireinfo()" onClick="details('<?php e(str_replace(" ", "-",$firstsirenamearr[0]['Horse']['sire']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($frststendsire[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsirefirst" id="smaallimageforsecondsireview" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
											<?php
											if(count($chksirearr)>0) {
											?>	
												<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
													<?php
													$imagedirectory="horseimage";
													$image=$chksirearr[0]['Horse']['image'] ;
													if($image!="") {
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
															$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
														?>
															<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
														<?php
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
													}
													else {
														?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
														<?php
													}
													?>			
												<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
												<div class="clear"></div>			
											<?php
											}
											else {
												e("<div align=center><em>No Info </em></div>");
											}
											?>
											</div>									
											</div>
											
										<div class="doom1" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>											
											<?php
											  if($frststendsire[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['dam_id']);
													$fifthheirh=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="thirddaminfo()" onMouseOut="notthirddaminfo()" onClick="details('<?php e(str_replace(" ", "-",$firstsirenamearr[0]['Horse']['dam']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($frststendsire[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsire" id="smaallimageforthirdsireview" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
										</div>
									<?php										
									//}
									?>
									<?php
									//if(count($firstdamnamearr)>0) {
										$cntr=1;
									?>									
										<div class="doom0" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($seconddam[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['sire_id']);
													$fourthdam=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="displaysecondsire()" onMouseOut="notdisplaysecondsire()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($seconddam[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsirefirst" id="smaallimageforsecondsire" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img  src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
										</div>
										
										<div class="doom1" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($seconddam[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['dam_id']);
													$fourthdam1=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="displaysecondsirethird()" onMouseOut="notdisplaysecondsirethird()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($seconddam[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsire" id="smaallimageforthirdsireviewthird" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
										  </div>
											  
										</div>
									<?php										
									//}
									?>									
								</div>
								<div class="poll3">
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
										<?php
										  if($hierchsire[0]['Horse']['sire']!="") {
												$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$hierchsire[0]['Horse']['sire_id']);
												if(count($chksirearr)>0) {
													?>
													<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamfirst()" onMouseOut="notfirsthirerchysiredamfirst()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
												<?php
												}	
												else {
													 e($chksirearr[0]['Horse']['sire']);
												}
										  }
										  ?>
										  </div>
										  
										  <div class="small_hirerchyfirst" id="hirerchyfirst" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
											<?php
											if(count($chksirearr)>0) {
											?>	
												<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
													<?php
													$imagedirectory="horseimage";
													$image=$chksirearr[0]['Horse']['image'] ;
													if($image!="") {
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
															$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
														?>
															<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
														<?php
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
													}
													else {
														?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
														<?php
													}
													?>			
												<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
												<div class="clear"></div>			
											<?php
											}
											else {
												e("<div align=center><em>No Info </em></div>");
											}
											?>
									  </div>
									</div>
																	
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($hierchsire[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$hierchsire[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamsecond()" onMouseOut="notfirsthirerchysiredamsecond()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($hierchsire[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchysecond" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>																						
											<?php
											  if($fifthheirh[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fifthheirh[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamthird()" onMouseOut="notfirsthirerchysiredamthird()" onClick="details('<?php e(str_replace(" ", "-",$firsthirerchysiredam2[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fifthheirh[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchythird" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>											  
									</div>
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($fifthheirh[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fifthheirh[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamfourth()" onMouseOut="notfirsthirerchysiredamfourth()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['sire']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fifthheirh[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyfourth" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
											<?php
											  if($fourthdam[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamfifth()" onMouseOut="notfirsthirerchysiredamfifth()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	 
													else {
														 e($fourthdam[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyfifth" style="display:none; position: absolute; left: 30px; top: -190px; z-index: 100;" >
												<?php
												
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<br>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($fourthdam[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamsixth()" onMouseOut="notfirsthirerchysiredamsixth()" onClick="details('<?php e(str_replace(" ", "-",$firsthirerchysiredam3[0]['Horse']['dam']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fourthdam[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchysixth" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  										
								  </div>
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
										<?php
											 if($fourthdam1[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam1[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamseventh()" onMouseOut="notfirsthirerchysiredamseventh()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fourthdam1[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyseventh" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
										<?php
											  if($fourthdam1[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam1[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredameight()" onMouseOut="notfirsthirerchysiredameight()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fourthdam1[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyeight" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>									
								</div>
							</div>						
						</div>