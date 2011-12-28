<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
			<option value="">Select State</option>
			<?php
			if(is_array($state_arr)) {
				foreach($state_arr as $key=>$val) :									
					e("<option value=".$val['State']['id'].">".$val['State']['statename']."</option>");								
				endforeach;							
			}					
			?>						
</select>