						

						
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
											
											
												/* this defines the sire_id into a variable */
													$sireid = $horsearr['Horse']['sire_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
													mysql_real_escape_string($sireid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$siresireid = $row['sire_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresireid."",
													mysql_real_escape_string($siresireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$siresirename = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siresirename));?>','<?php e($siresireid);?>')">
												<?php echo $siresirename;?>
												</p>
											  
											  </div>
											 					
											</div>
											
										<div class="infocontainer collumn2infocontainers dambgcolor">
											<div>											
											<?php
											
											
												/* this defines the sire_id into a variable */
													$sireid = $horsearr['Horse']['sire_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
													mysql_real_escape_string($sireid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$siredamid = $row['dam_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siredamid."",
													mysql_real_escape_string($siredamid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$siredamname = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siredamname));?>','<?php e($siredamid);?>')">
												<?php echo $siredamname;?>
												</p>
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
											
											
												/* this defines the sire_id into a variable */
													$damid = $horsearr['Horse']['dam_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
													mysql_real_escape_string($damid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$damsireid = $row['sire_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damsireid."",
													mysql_real_escape_string($damsireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$damsirename = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damsirename));?>','<?php e($damsireid);?>')">
												<?php echo $damsirename;?>
												</p>
											  </div>
											  
										</div>
										
										<div class="infocontainer collumn2infocontainers  dambgcolor">
											<div>
											<?php
											
											
												/* this defines the sire_id into a variable */
													$damid = $horsearr['Horse']['dam_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
													mysql_real_escape_string($damid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$damdamid = $row['dam_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damdamid."",
													mysql_real_escape_string($damdamid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$damdamname = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damdamname));?>','<?php e($damdamid);?>')">
												<?php echo $damdamname;?>
												</p>
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
											
											
												/* this defines the sire_id into a variable */
													$sireid = $horsearr['Horse']['sire_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
													mysql_real_escape_string($sireid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$siresireid = $row['sire_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresireid."",
													mysql_real_escape_string($siresireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$siresiresireid = $row['sire_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresiresireid."",
													mysql_real_escape_string($siresiresireid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$siresiresirename = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siresiresirename));?>','<?php e($siresiresireid);?>')">
												<?php echo $siresiresirename;?>
												</p>
										  </div>
										  
										  
									</div>
																	
									<div class="infocontainer collumn3infocontainers dambgcolor">
											<div>
											<?php
											
											
												/* this defines the sire_id into a variable */
													$sireid = $horsearr['Horse']['sire_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
													mysql_real_escape_string($sireid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$siresireid = $row['sire_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresireid."",
													mysql_real_escape_string($siresireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$siresiredamid = $row['dam_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresiredamid."",
													mysql_real_escape_string($siresiredamid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$siresiredamname = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siresiredamname));?>','<?php e($siresiredamid);?>')">
												<?php echo $siresiredamname;?>
												</p>
											  </div>
											 
									</div>
									
									<div class="infocontainer collumn3infocontainers sirebgcolor">
											<div>																						
											<?php
											
											
												/* this defines the sire_id into a variable */
													$sireid = $horsearr['Horse']['sire_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
													mysql_real_escape_string($sireid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$siresireid = $row['dam_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresireid."",
													mysql_real_escape_string($siresireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$siredamsireid = $row['sire_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siredamsireid."",
													mysql_real_escape_string($siredamsireid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$siredamsirename = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siredamsirename));?>','<?php e($siredamsireid);?>')">
												<?php echo $siredamsirename;?>
												</p>
											  </div>
											  								  
									</div>
									<div class="infocontainer collumn3infocontainers dambgcolor">
											<div>
											<?php
											
											
												/* this defines the sire_id into a variable */
													$sireid = $horsearr['Horse']['sire_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$sireid."",
													mysql_real_escape_string($sireid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$siresireid = $row['dam_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siresireid."",
													mysql_real_escape_string($siresireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$siredamdamid = $row['dam_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$siredamdamid."",
													mysql_real_escape_string($siredamdamid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$siredamdamname = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$siredamdamname));?>','<?php e($siredamdamid);?>')">
												<?php echo $siredamdamname;?>
												</p>
											  </div>
											  
											  
									</div>
									<div class="infocontainer collumn3infocontainers sirebgcolor">
										<div>
											<?php
											
											
												/* this defines the sire_id into a variable */
													$damid = $horsearr['Horse']['dam_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
													mysql_real_escape_string($damid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$damsireid = $row['sire_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damsireid."",
													mysql_real_escape_string($damsireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$damsiresireid = $row['sire_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damsiresireid."",
													mysql_real_escape_string($damsiresireid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$damsiresirename = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damsiresirename));?>','<?php e($damsiresireid);?>')">
												<?php echo $damsiresirename;?>
												</p>
											  </div>
											  
											  
									</div>
									<div class="infocontainer collumn3infocontainers dambgcolor">
											<div>
											<?php
											
											
												/* this defines the sire_id into a variable */
													$damid = $horsearr['Horse']['dam_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
													mysql_real_escape_string($damid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$damsireid = $row['sire_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damsireid."",
													mysql_real_escape_string($damsireid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$damsiredamid = $row['dam_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damsiredamid."",
													mysql_real_escape_string($damsiredamid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$damsiredamname = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damsiredamname));?>','<?php e($damsiredamid);?>')">
												<?php echo $damsiredamname;?>
												</p>
											  </div>
											  
											  										
								  </div>
									<div class="infocontainer collumn3infocontainers sirebgcolor">
										<div>
										<?php
											
											
												/* this defines the sire_id into a variable */
													$damid = $horsearr['Horse']['dam_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
													mysql_real_escape_string($damid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$damdamid = $row['dam_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damdamid."",
													mysql_real_escape_string($damdamid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$damdamsireid = $row['sire_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damdamsireid."",
													mysql_real_escape_string($damdamsireid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$damdamsirename = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damdamsirename));?>','<?php e($damdamsireid);?>')">
												<?php echo $damdamsirename;?>
												</p>
											  </div>
											  
											  
									</div>
									<div class="infocontainer collumn3infocontainers dambgcolor">
										<div>
										<?php
											
											
												/* this defines the sire_id into a variable */
													$damid = $horsearr['Horse']['dam_id'];
													
												/* this finds the row of that sire_id defined above */
													$query = sprintf("SELECT * FROM tbl_horses WHERE id=".$damid."",
													mysql_real_escape_string($damid));
													$result = mysql_query($query);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result)) {
													$damdamid = $row['dam_id'];
													}
													$query2 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damdamid."",
													mysql_real_escape_string($damdamid));
													$result2 = mysql_query($query2);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result2)) {
													$damdamdamid = $row['dam_id'];
													}
													$query3 = sprintf("SELECT * FROM tbl_horses WHERE id=".$damdamdamid."",
													mysql_real_escape_string($damdamdamid));
													$result3 = mysql_query($query3);
												
												/* this tell the code what column to show from that row defined above */
													while ($row = mysql_fetch_assoc($result3)) {
													$damdamdamname = $row['name'];
													}

													
													
													?>
												<!-- this says what to display and making it into a link based upon the variables defined above -->
												
													<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$damdamdamname));?>','<?php e($damdamdamid);?>')">
												<?php echo $damdamdamname;?>
												</p>
											  </div>
											  
									</div>	
																	
								</div>
							
							</div>		
										</div>	
						</div>
						