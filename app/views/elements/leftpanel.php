<div class="complete">
				<div class="first">Style:</div>
				<?php
				$sizecount=$html->requestAction('/boxtype/sizecount');
				if($sizecount>0) {			
				?>
					<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
					<div class="third"><a href="#">Edit</a></div>
				<?php
				}
				else {
				?>
					<div class="second"><img src="<?php  e($this->webroot);?>img/front/icon_inactive.gif" alt="" width="22" height="22" /></div>
					<?php
				}
				?>
				<div class="clear"></div>
				<div class="first">Detail:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<div class="first">Size:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<div class="first">Strength:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<div class="first">Color:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<div class="first">Quantity:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<div class="first">Print Color Combo:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<div class="first"># of Panels:</div>
				<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
				<div class="third"><a href="#">Edit</a></div>
				<div class="clear"></div>
				<p class="floatright"><a href="<?php e($html->url('/boxtype/restart'));?>" class="btn2"><span>Restart</span></a></p>
</div>