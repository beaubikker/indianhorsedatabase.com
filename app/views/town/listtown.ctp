<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation" >
										<option value="">city</option>
										<?php
										if(is_array($town_arr)) {
											foreach($town_arr as $key=>$val) :									
												e("<option value=".$val['Town']['id'].">".$val['Town']['town']."</option>");								
											endforeach;							
										}					
										?>						
									</select>