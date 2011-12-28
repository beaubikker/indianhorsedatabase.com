							<div class="form_box">
								<label class="formarea">Last known location:</label> 
								<div class="textfieldwrapperreyeng">
									<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
										<option value="">country</option>
										
										<?php
										if(is_array($country_arr)) {
											foreach($country_arr as $key=>$val) :									
												e("<option value=".$val['Country']['id'].">".$val['Country']['country']."</option>");								
											endforeach;							
										}					
										?>						
									</select>
								</div>	
								<div class="clear"></div>														
							</div>		
							
							
							<div class="form_box">
									<label class="formarea" style="visibility: hidden;">state</label>
								<div class="textfieldwrapperreyeng">
									<span id="showregion">
									<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
										<?php
											if(is_array($statearr)) {
												foreach($statearr as $key=>$val) :		
													if($val['State']['id']==$stable_arr[0]['Stable']['state_id']) {
														$sel='selected=selected';
													}							
													else {
														$sel='';
													}
													e("<option value=".$val['State']['id']." $sel;>".$val['State']['statename']."</option>");								
												endforeach;							
											}					
											?>						
									</select>	
									</span>
								</div>
								<div class="clear"></div>														
							</div>
																					
							<div class="form_box">
									<label class="formarea" style="visibility: hidden;">city</label> 
								<div class="textfieldwrapperreyeng">
									<span id="showtown">
									<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation">
										<?php
										if(is_array($town_arr)) {
											foreach($town_arr as $key=>$val) :	
												if($val['Town']['id']==$stable_arr[0]['Stable']['town_id']) {
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
