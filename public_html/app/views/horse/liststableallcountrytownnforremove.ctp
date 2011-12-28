			<div class="form_box">
				<label class="formarea">Country:</label> 
				<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
					<?php
					if(is_array($country_arr)) {
						foreach($country_arr as $key=>$val) :	
							if($val['Country']['id']==$stable_arr[0]['Stable']['country_id']) {
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
				<div class="form_box">
					<label class="formarea">State:</label> 
					<span id="showregion">
						<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
							<?php
								if(count($statearr)>0) {
									if(is_array($statearr)) {
										foreach($statearr as $key=>$val) :
											if($val['State']['id']==$stable_arr[0]['Stable']['state_id']) {
												$sel='selected=selected';
											}
											else {
												$sel='';
											}
											e("<option value=".$val['State']['id']." $sel>".$val['State']['statename']."</option>");										
										endforeach;								
									}							
								}						
							?>																
						</select>	
					</span>
					<div class="clear"></div>														
				</div>															
			<div class="form_box">
				<label class="formarea">Town/Region:</label> 
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
				<div class="clear"></div>														
			</div>		
