					<div style="float: left; width: 762px;">
					<?php
					if($session->check('Message.flash')):
						?>
							<div align="center"><h1 class="top"><?php $session->flash();?></h1></div>					
						<?php						
					endif;
					?>				
					
					
					
					<!-- EDIT BUTTONS AND FACEBOOK LIKE
	<div class="big4" align="center" style="padding-left:450px">
							
							<input class="newbutton" type="button" value="Edit" style="margin-right: 10px;" onClick="window.location.href='<?php e($html->url('/stable/editstable/'.$stable_id));?>'"/>
									<input class="newbutton" type="button" value="Remove" onClick="del_stable('<?php e($stable_id);?>')" />	
									
								<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like show_faces="false" width="450"></fb:like><br><br>
									
								</div>			
-->
					
					<div class="profile_info" style="padding-bottom: 0;">						
						<div class="po_inf_mid">
								<div class="stablenamereyeng"><?php e($stablearr['Stable']['stable_name']);?></div>			
								<div class="stableimageswrapperreyeng">
									<span id="mainimage">
									<?php
									$imagedirectory="stable_image";
									$image=$stablearr['Stable']['stable_image'];
									if($image!="") {
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."stable_image/".$stablearr['Stable']['stable_image'],729,397);								
											?>									
											<img src="<?php e($this->webroot);?>img/stable_image/<?php e($image);?>" alt="" width="729" height="397">
										<?php
										}
										else {
											?>
											<img src="<?php e($this->webroot);?>img/noimageavailable.jpeg" alt="" width="729" height="397">
											<?php
										}
									}
									else {
										?>
											<img src="<?php e($this->webroot);?>img/noimageavailable.jpeg" alt="" width="729" height="397">
										<?php
									}
									?>	
									</span>	
										<!-- 					mutiple images				 -->
										</div>
										<div class="stablethumbnailswrapper">
										
										
																			<?php
																	if(count($mulimage_arr)>0) {
																	?>
																	<a href="javascript:void(0)"  onclick="mainimagereplace('<?php e($imagedirectory);?>','<?php e($image);?>','<?php e($xy[0]) ;?>','<?php e($xy[1]) ;?>')" >
																	<?php
																		if($image!="") {
																			if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																				?>
																				<img src="<?php e($this->webroot);?>img/<?php e($imagedirectory);?>/<?php e($image);?>" class="thumbnailstablereyeng">
																			<?php
																			}
																		}
																		?> 
																		</a> 
																	
																<?php		
																if(is_array($mulimage_arr)){ 
																	foreach($mulimage_arr as $key=>$val) :
																	$imagedirectory="multiplestableimage";
																	$image=$val['Stableimage']['image'];
																	if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																	$xy1 = $rsz->imgResize(rootpth()."multiplestableimage/".$image,729,397);
																?>	
																	
																
																<a href="javascript:void(0)"  onclick="imagereplace('<?php e($image);?>','<?php e($xy1[0]) ;?>','<?php e($xy1[1]) ;?>')">
																	<img src="<?php e($this->webroot);?>img/multiplestableimage/<?php e($image);?>" alt="" class="thumbnailstablereyeng">
																</a> 						
																<?php
																	}
																	endforeach;
																}
																?>   				</div>	
															   <?php
															   }
															   ?>															
																		</div>
										<!-- 					mutiple images				 -->

								
								
								<div class="stabledetailscontainer">
									<p>Town/Region & Country:
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
									<p>Owner / Manager:
										  <?php 
										 $username=$this->requestAction('/user/username/'.$stablearr['Stable']['userid']);
										 ?>
										 <a href="<?php e($html->url('/user/viewaccount/'.base64_encode($username['User']['id'])));?>" style="color:#CBB056; text-decoration:none">
											<?php
											 e($username['User']['firstname']."  ".$username['User']['lastname']) ;
											 ?>
											 </a>
									</p>
									<p>Website:<?php e($stablearr['Stable']['website']);?></p>
									<p>About:<?php e($stablearr['Stable']['about']);?></p>
									<p>Services:<?php e($stablearr['Stable']['services']);?></p>									
								</div>
								
								
					</div>	
						<?php
						if(count($horselistarr)>0) {
						?>

						<div class="horseslivingherecontainerreyeng"> 
							<p class="heading">Horse stabled here</p> 
							<div class="horsesthumbnailsforstablereyeng"> 
								<?php
									if(count($horsearr)>0) {
									$total = count($horsearr);
									$cntr=1;
									if(is_array($horsearr)) {					
									foreach($horsearr as $key=>$val) :					
								?>					
								<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
								<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'].'/'.$val['Horse']['id'])));?>">
									<?php
										$imagedirectory="horseimage";						
										$image=$val['Horse']['image'] ;
										if($image!="") {
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										$xy = $rsz->imgResize(rootpth()."horseimage/".$image,120,120);
									?>
									<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" >
									<?php
										}	
										else {
									?>
									<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" class="horseprofilethumbnail" >
									<?php
										}	
										}	
										else {
									?>
									<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" class="horseprofilethumbnail" >
									<?php
										}			
									?>	
								</a>					
								<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
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
							</div>
						</div>
								
								
								
								
									<?php
						}
						?>
						<?php
						if(count($horsebred_arr)>0) {	
						?>	

								
										<div class="layer1"> 
											<p class="heading">Horse born here</p> 
											<div style="display: block;" class="content6"> 
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
																	$xy = $rsz->imgResize(rootpth()."horseimage/".$image,120,120);
																?>
																	<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" >
																<?php
																}	
																else {
																	?>
																		<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" class="horseprofilethumbnail">
																	<?php
																}	
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt=""class="horseprofilethumbnail" >
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
								</div>
																		<?php
						}
						?>							
						</div>
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