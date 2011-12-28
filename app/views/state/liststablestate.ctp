<select <?include('inc_tooltip/country.php');?> name="stablestate"  id="stablestate" class="dropdown98" onChange="liststabletownshow()">
			<option value="">Select State</option>
			<?php
			if(is_array($state_arr)) {
				foreach($state_arr as $key=>$val) :									
					e("<option value=".$val['State']['id'].">".$val['State']['statename']."</option>");								
				endforeach;							
			}					
			?>						
</select>