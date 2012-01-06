						

						
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

<!-- reyeng added on JANUARY 5th 2012 - this code selects the name from the row of the current horse sire_id -->

<?php

if($horsearr['Horse']['sireunknowoption']!="Y") { 

/* this defines the sire_id into a variable */
	$sireid = $horsearr['Horse']['sire_id'];
	
/* this finds the row of that sire_id defined above */
	$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
	mysql_real_escape_string($sireid));
	$result = mysql_query($query);

/* this tell the code what column to show from that row defined above */
	while ($row = mysql_fetch_assoc($result)) {
	$sirename = $row['name'];
	}
	?>
<!-- this says what to display and making it into a link based upon the variables defined above -->

	<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$sirename));?>','<?php e($sireid);?>')">
<?php echo $sirename;?>
</p>
<?php
	} else {
  // if the sire is unknown, so we show the “Add this horse button”
?>
<p class="domen">
		<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/addasire/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add Sire</font></a>
	</p>
<?
}
?>

	</div>
</div>
<div class="infocontainer collumn1infocontainers dambgcolor">
	<div>
				<?php

if($horsearr['Horse']['damunknownoption']!="Y") {
/* this defines the sire_id into a variable */
	$damid = $horsearr['Horse']['dam_id'];
	
/* this finds the row of that sire_id defined above */
	$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
	mysql_real_escape_string($damid));
	$result = mysql_query($query);

/* this tell the code what column to show from that row defined above */
	while ($row = mysql_fetch_assoc($result)) {
	$damname = $row['name'];
	}
	?>
<!-- this says what to display and making it into a link based upon the variables defined above -->

	<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damname));?>','<?php e($damid);?>')">
<?php echo $damname;?>
</p>
<?php
	} else {
  // if the sire is unknown, so we show the “Add this horse button”
?>
<p class="domen">
		<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/adddam/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add Dam</font></a>
	</p>
<?
}
?>						

 </div>
	<!-- end reyeng added on JANUARY 5th 2012 - this code selects the name from the row of the current horse sire_id -->										  
						
								</div>
								</div>
								<div class="collumn pedigreechartwidthofcollumn">
									<?php									
									//if(count($firstsirenamearr)>0) {		
									?>									
										<div class="infocontainer collumn2infocontainers sirebgcolor">
											<div>
													
																					<?php
								
								if($horsearr['Horse']['sireunknowoption']!="Y") { 
								
								/* this defines the sire_id into a variable */
									$sireid = $horsearr['Horse']['sire_id'];
									
								/* this finds the row of that sire_id defined above */
									$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
									mysql_real_escape_string($sireid));
									$result = mysql_query($query);
								
								/* this tell the code what column to show from that row defined above */
									while ($row = mysql_fetch_assoc($result)) {
									$sirename = $row['name'];
									}
									?>
								<!-- this says what to display and making it into a link based upon the variables defined above -->
								
									<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$sirename));?>','<?php e($sireid);?>')">
								<?php echo $sirename;?>
								</p>
													
																						  
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
						