<div style="float: left; width: 762px;">	
					<h1 class="top"> This horse has been successfully added</h1>
					<h3 class="horse_salehead"><strong><?php e($horsearr['Horse']['name']);?>'s Sire Dam And Stable Information</strong></h3>
					<div class="profile_info">						
					<div class="po_inf_up">&nbsp;</div>
					<div class="po_inf_mid">
						<div class="form_box10" style="float: left; width: 200px;">
							<label><strong>Sire :</strong></label>
									<?php											
											if($horsearr['Horse']['sire']!="") {												
												$sirechk=$this->requestAction('/horse/horselinkinfo/'.$horsearr['Horse']['sire']);
												if(count($sirechk)>0) {
												?>
													<h3 class="toxic1" style="padding:10px 2px;"><?php e($sirechk[0]['Horse']['name']);?></h3>
													<?php
													$imagedirectory="horseimage" ;
													$image=$sirechk[0]['Horse']['image'];
													if($image!="") {
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,60,60);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
														}	
													else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
													<?php
													}			
													?>
													<h4 class="toxic3" style="padding:5px 2px">
														<?php e($breedname=$this->requestaction('/horse/breedname/'.$sirechk[0]['Horse']['breed_id']));?><br /><?php e($sirechk[0]['Horse']['year']);?>
													</h4>
													<p class="toxic4"></p>
												<?php
												}
												else {
													?>
													Sire : <?php e($horsearr['Horse']['sire']);?> is not in the database <a href="<?php e($html->url('/horse/addhorse/horse/'.$horsearr['Horse']['sire']));?>" style="color:#994F26">Add this horse</a>
													<?php
												}
											}
											else {
												e("<div align=left><em>You did not select a sire.</em></div>");
											}
											?>
									
									
									
							<div class="clear"></div>
						</div>	
						<div class="form_box10" style="float: left; width: 200px;">
							<label><strong>Dam :</strong></label>
							<?php
											e($horsearr['Horse']['dam']);
											if($horsearr['Horse']['dam']!="") {
												$damchk=$this->requestAction('/horse/horselinkinfo/'.$horsearr['Horse']['dam']);
												if(count($damchk)>0) {
												?>
													<h3 class="toxic1" style="padding:10px 2px;"><?php e($damchk[0]['Horse']['name']);?></h3>
													<?php
													$image=$damchk[0]['Horse']['image'];
													if($image!="") {
														$imagedirectory="horseimage" ;
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,60,60);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
														}	
													else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
													<?php
													}			
													?>
													<h4 class="toxic3" style="padding:5px 2px">
														<?php e($breedname=$this->requestaction('/horse/breedname/'.$damchk[0]['Horse']['breed_id']));?><br /><?php e($damchk[0]['Horse']['year']);?>
													</h4>
													<p class="toxic4"></p>
												<?php
												}
												else {
													?>
														Dam : <?php e($horsearr['Horse']['dam']);?> is not in the database <a href="<?php e($html->url('/horse/addhorse/horse/'.$horsearr['Horse']['dam']));?>" style="color:#994F26">Add this horse</a>
													<?php
												}
											}
											else {
												e("<div align=left><em>You did not select a dam.</em></div>");
											}
											?>						
							<div class="clear"></div>
						</div>
						<div class="form_box10" style="float: left; width: 200px;">
							<label><strong>Stable :</strong></label> <?php
											    if($horsearr['Horse']['stable_id']!="") {
												$stablearr=$this->requestAction('/stable/stabledetails/'.$horsearr['Horse']['stable_id']);
												if(count($stablearr)>0) {
												?>
													<h3 class="toxic1" align="left" style="padding:10px 2px;"><?php e($stablearr['Stable']['stable_name']);?></h3>
													<?php
													$stable_image=$stablearr['Stable']['stable_image'];
													if($stable_image!="") {
														$imagedirectory="stable_image" ;
														if(file_exists(rootpth()."/".$imagedirectory."/".$stable_image)) {
																$xy = $rsz->imgResize(rootpth()."stable_image/".$stable_image,60,60);
																?>
																<img src="<?php e($this->webroot);?>img/stable_image/<?php e($stable_image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" >
																<?php
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" >
																<?php
															}	
														}	
													else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" >
													<?php
													}			
													?>													
													<p class="toxic4"></p>
												<?php
												}
												else {
													e("<div align=left><em>No Info</em></div>");
												}
											}
											else {
												?>
												This horse is not listed in a stable listed in the IHD<?php /*?>,  <a href="<?php e($html->url('/stable/create/'))?>" style="color:#994F26">create a stable page</a><?php */?>
												<?php
												
											}
											?>								
							<div class="clear"></div>
						</div>
						<div class="clear"></div>					
					</div>

					<div class="po_inf_btm">&nbsp;</div>						
				</div>