<select name="town" class="dropdown" id="town" >
										<option value="">Select Town/Region  </option>
										<?php
										if(is_array($town_arr)) {
											foreach($town_arr as $key=>$val) :									
												e("<option value=".$val['Town']['id'].">".$val['Town']['town']."</option>");								
											endforeach;							
										}					
										?>						
									</select>