<select name="data[Stable][horse_id][]" class="look"  multiple="multiple">
								<?php
								if(is_numeric($user_id)) {
									if(is_array($horse_arr)) {
										foreach($horse_arr as $key=>$val) :
											e("<option value=".$val['Horse']['id'].">".$val['Horse']['name']."</option>");									
										endforeach;								
									}	
								}	
								else {
								?>
								<option value="">Select Horse</option>
								<?php
								}					
								?>										
</select>