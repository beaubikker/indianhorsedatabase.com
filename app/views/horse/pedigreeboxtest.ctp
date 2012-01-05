						

						
						<div id="pedigreeboxcontainerreyeng">
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
						
						
<div id="pedigreechartcontainerreyeng">
								<div class="collumn pedigreechartwidthofcollumn">
									<div class="infocontainer collumn1infocontainers sirebgcolor">
										<div>
										  	<?php
									if($horsearr['Horse']['sireunknowoption']!="Y") {
										if($horsearr['Horse']['sire']) {
											if($horsearr['Horse']['sire_id']=="") {
										?>
										
												<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$horsesirearr[0]['Horse']['name']));?>','<?php e($horsesirearr[0]['Horse']['id']);?>')"><?php e($horsearr['Horse']['sire']);?>
												</p>
										<?php
											}
											else {
												$siredetailsarr=$this->requestAction('/horse/siredetails/'.$horsearr['Horse']['sire_id']);
											?>
												<p class="domen" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siredetailsarr['Horse']['name']));?>','<?php e($siredetailsarr['Horse']['id']);?>')"><?php e($siredetailsarr['Horse']['name']);?>
												</p>
											<?php
											}											
										}
										else {
											?>
											<p class="domen">
												
											</p>
										<?php
										}
									}
									else {
										?>
										<p class="domen">
											<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/addasire/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add this horse </font></a>
										</p>
										<?php
									}
									?>
										
									</div>
									</div>
									<div class="infocontainer collumn1infocontainers dambgcolor">
										<div>
										
																		<?php
								if($horsearr['Horse']['damunknownoption']!="Y") {
									if($horsearr['Horse']['dam']) {
									?>
									
										<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$horsedamarr[0]['Horse']['name']));?>','<?php e($horsedamarr[0]['Horse']['id']);?>')">
										
											<?php
											
												e($horsearr['Horse']['dam']) ;										
											?>			
																
										</p>
									<?php
									}
									else {
										?>
										<p class="domen">
											
										</p>
										<?php
									}
								}
								else {
									?>
										<p class="domen">
											<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/adddam/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add this horse</font> </a>
										</p>
										<?php
								}
								?>
										  
										  </div>

								</div>
								</div>
								<div class="collumn pedigreechartwidthofcollumn">
									<?php									
									//if(count($firstsirenamearr)>0) {		
									?>									
										<div class="infocontainer collumn2infocontainers sirebgcolor">
											<div>
																						  
											<?php
											  if($frststendsire[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['sire_id']);
													$hierchsire=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														
														
														<a href="javascript:void(0)" onClick="details('<?php e(str_replace(" ", "-",$firstsirenamearr[0]['Horse']['sire']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
														
													<?php
													}	
													else {
														 e($frststendsire[0]['Horse']['sire']);
													}
											  }
											  ?>
											  
											  </div>
											 					
											</div>
											
										<div class="infocontainer collumn2infocontainers dambgcolor">
											<div>											
											<?php
											  if($frststendsire[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['dam_id']);
													$fifthheirh=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														
														
														<a href="javascript:void(0)" onClick="details('<?php e(str_replace(" ", "-",$firstsirenamearr[0]['Horse']['dam']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
														
														
													<?php
													}	
													else {
														 e($frststendsire[0]['Horse']['dam']);
													}
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
										<div class="infocontainer collumn2infocontainers sirebgcolor">
											<div>
											<?php
											  if($seconddam[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['sire_id']);
													$fourthdam=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
																												
														<a href="javascript:void(0)" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($seconddam[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  
										</div>
										
										<div class="infocontainer collumn2infocontainers  dambgcolor">
											<div>
											<?php
											  if($seconddam[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['dam_id']);
													$fourthdam1=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														
														<a href="javascript:void(0)" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($seconddam[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  
											  
										</div>
									<?php										
									//}
									?>									
								</div>
								<div class="collumn pedigreechartwidthofcollumn">
									<div class="infocontainer collumn3infocontainers sirebgcolor">
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
										  
										  
									</div>
																	
									<div class="infocontainer collumn3infocontainers dambgcolor">
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
											 
									</div>
									
									<div class="infocontainer collumn3infocontainers sirebgcolor">
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
											  								  
									</div>
									<div class="infocontainer collumn3infocontainers dambgcolor">
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
											  
											  
									</div>
									<div class="infocontainer collumn3infocontainers sirebgcolor">
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
											  
											  
									</div>
									<div class="infocontainer collumn3infocontainers dambgcolor">
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
											  
											  										
								  </div>
									<div class="infocontainer collumn3infocontainers sirebgcolor">
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
											  
											  
									</div>
									<div class="infocontainer collumn3infocontainers dambgcolor">
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
											  
									</div>	
																	
								</div>
							
							</div>		
										</div>	
						</div>
						