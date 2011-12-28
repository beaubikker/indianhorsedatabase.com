<table> 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Country : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
							<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
								<?php
								if(is_array($country_arr)) {
									foreach($country_arr as $key=>$val) :									
										e("<option value=".$val['Country']['id'].">".$val['Country']['country']."</option>");								
									endforeach;							
								}					
								?>						
							</select>
					</td>
				  </tr>			  
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">State : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
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
					</td>
				  </tr>
				  
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Town/Region: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
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
					</td>
				  </tr>	
				  </table>