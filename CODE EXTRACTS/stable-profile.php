CODE EXTRACTED is for displaying the small images at stable profile for horses living here 

HORSES FOR SALE:

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




Horses bred:

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


Horses living: 
								<ul>
								<?php
								if(count($horselistarr)>0) {										
									if(is_array($horselistarr)) { 
										foreach($horselistarr as $key=>$val) :
										$imagedirectory="horseimage";
										$image=$val['Horse']['image'];											
										?>
								<li>
									<div align="center">
										<b><?php e($val['Horse']['name']);?></b>
									</div>
									
									
									
<!-- 				REYENG REMOVED: onMouseOver="showimage('<?php/* e($val['Horse']['id']);?>')" onMouseOut="noimage('<?php e($val['Horse']['id']);*/?>')" FROM THE BELOW <div> tag					 -->



									<div>
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
													</div>
												</li>
											
										<?php
											//}
											endforeach;				
									}
									}
									?>														
								</ul>	

<div id="ownerhorse_<?php e($val['Horse']['id']);?>">
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