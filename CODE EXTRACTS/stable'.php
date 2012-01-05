					<div id="searchwrapperreyeng">
						
								</div>
						<form action="" method="get" name="frm"">
							<span id="stablehearch" <?php if($searchcriteria=="Stable") { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
								<div class="profile_info">
									<div class="po_inf_mid">
										<div class="searchnamegenderboxreyeng">
											<div align="center">
												<label class="formarea">Name:</label>
												<input class="visson" name="stablename"  id="stablename" <?php if($stablename!="") { ?> value="<?php e($stablename);?>" <?php }  else { e("value='enter stable name'"); } ?> type="text" size="30" value="enter stable name" onFocus="if(this.value=='enter stable name')this.value='';" onBlur="if(this.value=='')this.value='enter stable name';"/>
												<div class="clear"></div>
											</div>
										</div>
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />
										<h3 class="xo">Filter Results</h3>
										<div class="fonto">
											<div class="form_box59">
												<div class="searchfilterwrapperreyeng">
													<label class="formarea">Country:</label>
													<select name="countrystable"  id="countrystable" class="dropdown98" onChange="liststatblestate()">
														<option value=""></option>
														<?php
														if(is_array($country_arr)) {
														foreach($country_arr as $key=>$val) :	
														if($val['Country']['id']==$countrystable) {
														$sel='selected=selected';
														}							
														else {
														$sel='';
														}						
														e("<option value=".$val['Country']['id']." $sel>".$val['Country']['country']."</option>");								
														endforeach;							
														}					
														?>						
													</select>							
													<div class="clear"></div>
												</div>
											</div>
											<div class="form_box59">
												<div class="searchfilterwrapperreyeng">
													<label class="formarea">State:</label>
													<span id="stablest">
														<select name="stablestate"  id="stablestate" class="dropdown98" onChange="liststabletownshow()">
															<option value=""></option>
															<?php
															if(is_array($statestatearr)) {
															foreach($statestatearr as $key=>$val) :	
															if($val['State']['id']==$stablestate) {
															$sel='selected=selected';
															}							
															else {
															$sel='';
															}						
															e("<option value=".$val['State']['id']." $sel>".$val['State']['statename']."</option>");								
															endforeach;							
															}					
															?>						
														</select>	
													</span>				
													<div class="clear"></div>
												</div>
											</div>
											<div class="form_box59">
												<div class="searchfilterwrapperreyeng">
												<label class="formarea">Town/Region:</label>
												<span id="stabletwn">
													<select name="stabletownid"  id="stabletownid" class="dropdown98"> 
														<option value=""></option>
														<?php
														if(is_array($stabletownarr)) {
														foreach($stabletownarr as $key=>$val) :	
														if($val['Town']['id']==$stabletownid) {
														$sel='selected=selected';
														}							
														else {
														$sel='';
														}						
														e("<option value=".$val['Town']['id']." $sel>".$val['Town']['town']."</option>");								
														endforeach;							
														}					
														?>						
													</select>	
												</span>				
												<div class="clear"></div>
												</div>
											</div>
											<div class="clear"></div>
										</div>
										<input class="button-reyeng" type="submit" value="Search"  name="stablesearch"/>
										<input class="button-reyeng" type="button" value="Reset"  onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>
									</div>						
								</div>
							</span>	
							<?php
							if($searchcriteria!="") {
							?>
							<span id="stablesearchresult"  style="display:block">
								<div class="profile_info top-margin">
									<div class="po_inf_mid">
										<?php
										if(count($horslistarr)>0) {
										if(is_array($horslistarr)) {
										foreach($horslistarr as $key=>$val):
										?>
										<div class="pannel">
											<div class="big1" style="width: 90px;">
												<?php
												$imagedirectory="stable_image";
												$image=$val['Stable']['stable_image'];
												if($image!="") {
												if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."stable_image/".$image,90,91);								
												?>									
												<img src="<?php e($this->webroot);?>img/stable_image/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>"  onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer">
												<?php
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91" onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer">
												<?php
												}
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91" onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer">
												<?php
												}
												?>											
											</div>
											<div class="big2" style="width: 130px;">
												<p class="kits">
													<span onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer"><?php e($val['Stable']['stable_name']);?>
													</span><br />
													
												</p>
											</div>
											<div class="big3">
												<p class="axe"><?php e(substr($val['Stable']['about'],0,300));?></p>
											</div>		
											<div class="big4">
												<input class="button-reyeng" type="button" value="View"  onClick="stabledetails('<?php e($val['Stable']['id']);?>')"/>										
											</div>														
										</div>		
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />		
										<?php
										endforeach;
										}
										}
										else  {
										e("<div align=center><h3>There is no stable matching your search criteria</h3></br></div>");	
										}
										?>										
									</div>				
								</div>	
								<?php
								if($pagistr!="") { 
								?>
								<div class="pagination">
									<ul>
										<?php
										e($prevpage);
										e($pagistr);				
										e($nextpage);?>
									</ul>
								</div>
								<?php
								}
								?>
							</span>
							<?php				
							}	
							?>			
						</form>		
					</div>
				<div style="clear: both; line-height: 0; font-size: 0;"></div>
			</div>
		</div>
		<div class="bottom">
			<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
		</div>
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</body>
</html>