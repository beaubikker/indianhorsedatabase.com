					
<!-- 	SOMETHING TO PLAY WITH FOR REYENG	 -->
					
					<?php/*
					if($salesstatus='S'); {
					<?php
					e($this->renderelement('../horse/forsalebanner'));			
					?>	
					<?php } */?>
					
<!-- 	SOMETHING TO PLAY WITH FOR REYENG	 -->

				
	<?php	
		$mainimage='';						
		if($horsearr['Horse']['image']!="") {
		$imagedirectory="horseimage";
		$mainimage=$horsearr['Horse']['image'] ;
		}
		else {
		if($horseimagearr[0]['Horseimage']['image']) {
		$imagedirectory="horseadditionalimage";
		$mainimage=$horseimagearr[0]['Horseimage']['image'] ;	
		}						
		}
	?>	
	<span id="shmainimage" style="display:none">
		<input  type="button"  value="Back To Main Image" onClick="mainimagereplace('<?php e($imagedirectory);?>','<?php e($image);?>')"  style="background:url(http://indianhorses.india-web-design.com/app/webroot/img/sub_big_btn.png) no-repeat 0 1px; border: medium none; color: #FFFFFF;font-family: verdana; font-size: 14px; font-weight: bold; width:183px; height:25px; text-align:center; cursor:pointer" />
	</span>					
	<div id="horseprofiledetailswrapperreyeng" >
		<div id="horseprofilemainimagewrapperreyeng">
			
			<?php
			if($mainimage!="") {
			if(file_exists(rootpth()."/".$imagedirectory."/".$mainimage)) {
			$xy = $rsz->imgResize(rootpth().$imagedirectory."/".$mainimage,300,300);
			?>
			<img src="<?php e($this->webroot);?>img/<?php e($imagedirectory);?>/<?php e($mainimage);?>" alt="" width="<?php e($xy[0]) ;?>" height="<?php e($xy[1]) ;?>">
			<?php
			}
			}
			?>										

	<?php
		if(count($horseimagearr)>0) {								
	?>
	<?php
		}
	?>
			</div>

	<div id="horseprofiledetailsotherwrapperreyeng">
								<div class="line_para">

							<h1 class="horseprofiledetailnamereyeng"><?php e($horsearr['Horse']['name']);?></h1>
</div>
							<div class="line_para">
								<div class="same"><p>Gender</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								$gender=$this->requestAction('/horse/gendername/'.$horsearr['Horse']['gender']);
								e($gender['Gender']['gender']);
								?>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Breed</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								$breedname=$this->requestAction('/horse/breedname/'.$horsearr['Horse']['breed_id']);
								e($breedname);
								?>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Coat Colour</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen">
								<?php 
								$colorname=$this->requestAction('/horse/coatcolor/'.$horsearr['Horse']['coatcolor_id']);
								e($colorname);
								?>
								</p></div>
								</div>

							<div class="line_para">
								<div class="same"><p>Height</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen">
										<?php 
										$heightval=$this->requestAction('/horse/heightval/'.$horsearr['Horse']['height_id']);
										e($heightval);
										?>
									</p>
								</div>
							</div>
							<?php
							if($horsearr['Horse']['year']) {
							?>
							<div class="line_para">
								<div class="same"><p>Year</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen"><?php e($horsearr['Horse']['year']);?></p></div>
							</div>
							<?php
							}
							?>
							<?php
							if($horsearr['Horse']['yearofdeath']!="") {
							?>
							<div class="line_para">
								<div class="same"><p>Deceased</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								if($horsearr['Horse']['yearofdeath']!="") {
									e($horsearr['Horse']['yearofdeath']);
								}
								else  {
									e("");
								}
								?></p></div>
							</div>
							<?php } ?>
	<div style="padding: 15px 0 0 50px;"><img src="<?php e($this->webroot);?>img/divider.png" alt=""></div>
							<?php
							if($horsearr['Horse']['registered']=='Y') {
							?>
							<div class="line_para">
								<div class="same"><p>Registered</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								if($horsearr['Horse']['registration_code']!="") {
									e($horsearr['Horse']['registration_code']);
								}
								else  {
									e("");
								}
								?>
								</p></div>
							</div>
							<?php
							}
							?>							
							<div class="line_para">
								<div class="same"><p>Bloodline</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php
								if($horsearr['Horse']['bloodline']!="") {
									e($horsearr['Horse']['bloodline']) ;
								}
								else {
									e("");
								}
								?>								
								</p>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Breeder</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen">
									<?php
									if($horsearr['Horse']['breeder_id']!="") {
										$username=$this->requestAction('/horse/findusername/'.$horsearr['Horse']['breeder_id']);
										?>
										<span style="cursor:pointer" onClick="javascript:window.location.href='<?php e($html->url('/user/viewaccount/'.base64_encode($username['User']['id'])));?>'"><?php e($username['User']['firstname']."   ".$username['User']['lastname']);?></span>
										<?php
									}
									if($horsearr['Horse']['breeder_id']=="") {
										if($horsearr['Horse']['breeder']!="") {
											e($horsearr['Horse']['breeder']);
										}
										else {
											e("");
										}
									}
									?>								
								</p></div>
							</div>
							
							<?php
							if(is_numeric($horsearr['Horse']['bred_id'])) {
							?>
							<div class="line_para">
								<div class="same"><p>Born At</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<a href="<?php e($html->url('/stable/viewprofile/'.$horsearr['Horse']['bred_id']));?>" style="text-decoration:none">
									<p class="domen">
										<?php
										$stablenamearr=$this->requestAction('/horse/stablename/'.$horsearr['Horse']['bred_id']);
										?>
										<?php e($stablenamearr['Stable']['stable_name']);?>				
									</p>
									</a>	
								</div>
							</div>
							<?php
							}
							else {
							?>		
							<div class="line_para">
								<div class="same">
								  <p>Born At</p>
								</div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen">
									<?php 
									if($horsearr['Horse']['bred_name']) {
										e($horsearr['Horse']['bred_name']);
										
									}
									else {
										e("");
									}
									?>	
									</p>								
								</div>
							</div>						
							<?php
							}
							?>
								
							<div style="padding: 15px 0 0 50px;"><img src="<?php e($this->webroot);?>img/divider.png" alt=""></div>
							
							<div class="line_para">
								<div class="same"><p>Last known owner</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen" style="width: 520px">
										<?php
										if($horsearr['Horse']['ownerid']!="") {
											$username=$this->requestAction('/horse/findusername/'.$horsearr['Horse']['ownerid']);
											?>
											<span style="cursor:pointer" onClick="javascript:window.location.href='<?php e($html->url('/user/viewaccount/'.base64_encode($username['User']['id'])));?>'"><?php e($username['User']['firstname']."   ".$username['User']['lastname']);?></span>
											<?php
										}
										if($horsearr['Horse']['ownerid']=="") {
											if($horsearr['Horse']['ownername']!="") {
												e($horsearr['Horse']['ownername']);
											}
											else {
												e("");
											}
										}
										?>								
									</p>
								</div>
							</div>
							<?php
							if(is_numeric($horsearr['Horse']['stable_id'])) {
							?>
							<div class="line_para">
								<div class="same"><p>Last know stable</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<a href="<?php e($html->url('/stable/viewprofile/'.$horsearr['Horse']['stable_id']));?>" style="text-decoration:none">
									<p class="domen" style="width: 520px">
										<?php
										$stablenamearr=$this->requestAction('/horse/stablename/'.$horsearr['Horse']['stable_id']);
										?>
										<?php e($stablenamearr['Stable']['stable_name']);?>				
									</p>
									</a>	
								</div>
							</div>
							<?php
							}
							else {
							?>		
							<div class="line_para">
								<div class="same"><p>Last known stable</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen" style="width: 520px">
									<?php 
									if($horsearr['Horse']['stablename']) {
										e($horsearr['Horse']['stablename']);
										
									}
									else {
										e("");
									}
									?>	
									</p>								
								</div>
							</div>							
							<?php
							}
							?>										
							<div class="line_para">
								<div class="same"><p>Location</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><h4 class="">
								<?php 
											if($horsearr['Horse']['countryid']) {
												$countryname=$this->requestAction('/country/countryname/'.$horsearr['Horse']['countryid']);
												e("".$countryname['Country']['country'].",  ");											
											}
											if($horsearr['Horse']['state_id']) {
												$statename=$this->requestAction('/state/Statename/'.$horsearr['Horse']['state_id']);
												e("".$statename['State']['statename'].",  ");											
											}											
											if($horsearr['Horse']['town_id']) {
												$townname=$this->requestAction('/town/townname/'.$horsearr['Horse']['town_id']);
												e($townname['Town']['town']);											
											}
											
											?>								
								</h4></div>
							</div>
							
							<div class="line_para">
								<div class="same">
								  <p>Prize won</p>
								</div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen" style="width: 520px">
								<?php
								if($horsearr['Horse']['prize_won']!="") {
									e($horsearr['Horse']['prize_won']) ;
								}
								else {
									e("");
								}
								?>								
								</p>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Other Details</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen" style="width: 520px">
								<?php e($horsearr['Horse']['other_details']);?>								
								</p>
								</div>
							</div>


								
								
								
								

								<?php	
								$mainimage='';						
								if($horsearr['Horse']['image']!="") {
									$imagedirectory="horseimage";
									$mainimage=$horsearr['Horse']['image'] ;
								}
								else {
									if($horseimagearr[0]['Horseimage']['image']) {
										$imagedirectory="horseadditionalimage";
										$mainimage=$horseimagearr[0]['Horseimage']['image'] ;	
									}						
								}
								?>		
								
								
								
														

			
		</div>
	</div>
</div>
<div style="clear: both;"></div>						
									
<!--  REYENG DISABLE 1st january 2012
						<?php/*
						if(is_numeric($userid)) {
								if($userid==$horseowerarr[0]['Horse']['ownerid']) {										
									if($horsearr['Horse']['deathstat']!="Y") {			
									?>
										<input  type="button"  value="Put up for Sale"  class="button-reyeng sutble" onClick="window.location.href='<?php e($html->url('/horse/putforsale/'.$horseid));?>'"/>
									<?php
									}
									if($horsearr['Horse']['gender']==2) {
										if($horsearr['Horse']['deathstat']!="Y") {		
									?>
										<input  type="button"  value="Put up for Stud"  class="button-reyeng sutble" onClick="window.location.href='<?php e($html->url('/horse/putforsale/'.$horseid));?>'"/>
									<?php	
										}	
									}												
								}
							}						
						*/?>	
						
-->
				<div style="clear: both;"></div>						
<a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
								<input  type="button"  value="Offspring"   class="button-reyeng" />
							</a>
							<a linkindex="1" href="#?w=500" rel="siblings" class="poplight" style="text-decoration:none">
								<input  type="button" value="Siblings"   class="button-reyeng" />
							</a>
<?php
						e($this->renderelement('../horse/pedigreebox'));		
						?>
						</div>	
						
							</div>
								
			  	</div>
			  			
				<div style="clear: both; line-height: 0; font-size: 0;"></div>						
				</div>						
			</div>	
		</div>		
	<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>	
	<div style="display: none; width: 450px !important; padding-right: 0; margin-top: -160px; margin-left: -290px;" id="offsping" class="popup_block">
			<div style="overflow-y: scroll; overflow-x: hidden; height: 400px;">					
			<h3 class="dilraj" style="border-bottom: 1px solid #666; width: 430px; padding-bottom: 10px;"><?php e($horsearr['Horse']['name']);?> Offspring </h3>			
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>	
				<?php
				if(count($offspingarr)>0) {
				$total = count($offspingarr);
				$cntr=1;
					if(is_array($offspingarr)) {	
					foreach($offspingarr as $key=>$val) :	
					if($val['Horse']['id']!=$horseid) {		
						?>					
						<td style="padding: 10px 0;">
							<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
							<?php
								$imagedirectory="horseimage";						
								$image=$val['Horse']['image'] ;
								if($image!="") {
									if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										$xy = $rsz->imgResize(rootpth()."horseimage/".$image,187,182);
									?>
										<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
									<?php
									}	
									else {
										?>
											<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
										<?php
									}	
								}	
								else {
								?>
									<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
								<?php
								}			
							?>						
							<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
						</td>
						<?php
						if($cntr%2!=0) {?>
							<td style=" float:left; padding: 10px 0;"></td>
						<?php
						}
						else {
						?>
						<td style=" float:left; padding: 10px 0;"></td>
						<?php
						}
						if($cntr%2==0) {
							e("</tr><tr>");
						}
						?>
						<?php
						$cntr++;
					}
					endforeach;
					}		
				}
				else {
					e("<div align=center><font color=#FF0000><em>There is no offspring of this horse in the IHD </em></font></div>"); 
				}
				?>			
			</table>			
			</div>
		</div>
	<div style="display: none; width: 450px !important; padding-right: 0; margin-top: -160px; margin-left: -290px;" id="siblings" class="popup_block">
		<div style="overflow-y: scroll; overflow-x: hidden; height: 400px;">
		<h3 class="dilraj" style="border-bottom: 1px solid #666; width: 430px; padding-bottom: 10px;"><?php e($horsearr['Horse']['name']);?> Siblings</h3>
		<table style="overflow:hidden"; width="100%" cellpadding="0" cellspacing="0">
				<tr>	
				<?php
				 if(count($siblingsarr)>0) {
					$total = count($siblingsarr);
					$cntr=1;
						if(is_array($siblingsarr)) {					
						foreach($siblingsarr as $key=>$val) :	
						if($val['Horse']['id']!=$horseid) {		
							?>					
							<td style="padding: 10px 0;">
								<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
								<?php
									$imagedirectory="horseimage";						
									$image=$val['Horse']['image'] ;
									if($image!="") {
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."horseimage/".$image,187,182);
										?>
											<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
										<?php
										}	
										else {
												?>
													<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
												<?php
											}	
									}	
									else {
									?>
										<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
									<?php
									}			
								?>										
								<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
							</td>
							<?php
							if($cntr%2!=0) {?>
								<td style=" float:left; padding: 10px 0;"></td>
							<?php
							}
							else {
							?>
							<td style=" float:left; padding: 10px 0;"></td>
							<?php
							}
							if($cntr%2==0) {
								e("</tr><tr>");
							}
							?>
							<?php
							$cntr++;
							}
						endforeach;
						}		
					}
					else {
						e("<div align=center><font color=#FF0000><em>There are no siblings of this horse in the IHD</em></font></div>"); 
					}				
				?>			
			</table>
		</div>
	</div>
</body>
</html>