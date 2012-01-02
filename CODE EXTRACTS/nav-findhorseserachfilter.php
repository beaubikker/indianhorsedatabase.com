NAV: frontheader.ctp:


					<!-- <li><a href="<?php/* echo $html->url(array("controller" => "content","action" => "front"));?>" <?php if($currpage=="indianhorse" || $currpage=="" || $currpage=="homeforpaiduser" || $currpage=="homeforpaiduser") { ?>class="active" <?php } */?>>Home</a></li> -->

<div id="searchthreecolumntabsreyeng">
								
									<div <?php if($searchcriteria==""|| $searchcriteria=="Horse") { ?>class="searchtabreyeng activesearchreyeng float_left" <?php } else { ?> class="searchtabreyeng float_left" <?php } ?> id="horsearchtb" onClick="horsesearchtab()"><h3>Horses</h3>
									</div>
									
									<div 
									<?php if($searchcriteria=="Stable")  { ?> class="searchtabreyeng activesearchreyeng float_right" 
									<?php } else { ?> class="searchtabreyeng float_right" <?php } ?> id="stablesearchtb" onClick="gotostable()">
									<h3>Stables</h3>
									</div>
									
								</div>



<div class="searchfilterwrapperreyeng">
																<label class="formarea">Age:</label>
																<select name="age" size="1" class="dropdown98">
																	<option selected="selected"></option>
																	<?php
																	for($i=1;$i<=25;$i++) {
																	if($i==$age) {
																	$sel='selected=selected';
																	}
																	else {
																	$sel='';
																	}
																	e("<option value=".$i." $sel>".$i."</option>");										  
																	}											  
																	?>
																</select>
																<div class="clear"></div>		
															</div>									
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Height:</label>
																<select name="height" id="height" size="1" class="dropdown98">
																	<option selected="selected" value=""></option>
																	<?php
																	if(is_array($height_arr)) {
																	foreach($height_arr as $key=>$val) :
																	if($val['Height']['id']==$height) {
																	$sel='selected=selected' ;
																	}
																	else {
																	$sel='';
																	}	
																	e("<option value=".$val['Height']['id']." $sel>".$val['Height']['height']."</option>");								
																	endforeach;							
																	}					
																	?>
																</select>
																<div class="clear"></div>	
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Owner:</label>
																<input class="visson" name="ownername" id="ownername" type="text" <?php if($ownername!="") { ?> value="<?php e($ownername);;?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';"/>
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Breeder:</label>
																<input class="visson" name="breedname" id="breedname" type="text" <?php if($breedname!="") { ?> value="<?php e($breedname);?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';"/>
																<div class="clear"></div>							
															</div>					
															<div class="form_box59">											
															<div class="clear"></div>						
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Registered:</label>
																<select name="registeredstatus" class="dropdown98" id="registeredstatus" >
																	<option value="">All Horses </option> 
																	<option value="Y" <?php if($registeredstatus=="Y") { ?> selected="selected" <?php } ?>>Registered </option> 
																	<option value="N" <?php if($registeredstatus=="N") { ?> selected="selected" <?php } ?>>Not Registered </option> 											
																</select>
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Country:</label>
																<select name="country_id" class="dropdown98" id="HorseCountry" onChange="liststate()">
																	<option value="">Select Country </option>
																	<?php
																	if(is_array($country_arr)) {
																	foreach($country_arr as $key=>$val) :	
																	if($val['Country']['id']==$country_id) {
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
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">State:</label>
																<span id="showregion">
																	<select name="state_id" class="dropdown98" id="Horsestate" onChange="listtown()">
																		<option value="">Select state  </option>
																		<?php
																		if(is_array($state_arr)) {
																		foreach($state_arr as $key=>$val) :		
																		if($val['State']['id']==$state_id) {
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
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Town/Region:</label>
																<span id="showtown">
																	<select name="town_id" class="dropdown98" id="HorseLocation" >
																		<option value="">Select Town </option>
																		<?php
																		if(is_array($town_arr)) {
																		foreach($town_arr as $key=>$val) :
																		if($val['Town']['id']==$town_id) {
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
															</div>
															<div class="clear"></div>
														</div>
														<div class="clear"></div>
													</div>	