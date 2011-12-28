						<div class="build">
							<div><img src="<?php  e($this->webroot);?>img/front/buildtop.gif" alt="" width="267" height="4" /></div>
							<div class="buildcontent">
							<p><img src="<?php  e($this->webroot);?>img/front/spacer.gif" alt="" width="1" height="5" /></p>
							<p class="centeralign"><img src="<?php  e($this->webroot);?>img/front/buildtitle.gif" alt="" width="153" height="29" /></p>
							<p class="centeralign"><img src="<?php  e($this->webroot);?>img/front/builddash.gif" alt="" width="230" height="1" /></p>
							<div class="complete">
								<div class="first">Style:</div>
								<?php
								$sizecount=$html->requestAction('/boxtype/sizecount');
								if($sizecount>0) {			
								?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxtype/step1'));?>">Edit</a></div>
								<?php
								}
								else {
								?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/icon_inactive.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxtype/step1'));?>">Add</a></div>
									<?php
								}
								$strengthcount=$html->requestAction('/boxtype/strengthcount');
								?>
								<div class="clear"></div>
								<div class="first">Strength:</div>
								<?php
								if($strengthcount>0) {
								?>								
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxwall/step2'));?>">Edit</a></div>
								<?php
								}
								else {
								?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/icon_inactive.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxwall/step2'));?>">Add</a></div>
								<?php
								}
								?>
								<div class="clear"></div>							
								<div class="first">Color:</div>
								<?php
								$colorcount=$html->requestAction('/boxtype/colorcount');
								if($colorcount>0) {
								?>
								<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
								<div class="third"><a href="<?php e($html->url('/boxtype/step3'));?>">Edit</a></div>
								<?php
								}
								else {
								?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/icon_inactive.gif" alt="" width="22" height="22" /></div>							
									<div class="third"><a href="<?php e($html->url('/boxtype/step3'));?>">Add</a></div>
								<?php								
								}
								?>
								<div class="clear"></div>
								<div class="first">Print Color Combo:</div>
								<?php
								$countcolorcombi=$html->requestAction('/boxtype/countcolorcombi');
								?>
								<?php
								if($countcolorcombi>0) { 
								?>
								<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
								<div class="third"><a href="<?php e($html->url('/boxtype/step4'));?>">Edit</a></div>								
								<?php
								}
								else { ?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/icon_inactive.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxtype/step4'));?>">Add</a></div>
								<?php
								}
								?>
								<div class="clear"></div>
								<div class="first"># of Panels:</div>
								<?php
								$countartwork=$html->requestAction('/boxtype/countartwork');
								if($countartwork>0) {
								?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/tick.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxtype/step4'));?>">Edit</a></div>
								<?php
								}
								else { ?>
									<div class="second"><img src="<?php  e($this->webroot);?>img/front/icon_inactive.gif" alt="" width="22" height="22" /></div>
									<div class="third"><a href="<?php e($html->url('/boxtype/step4'));?>">Add</a></div>
								<?php
								}
								?>
								<div class="clear"></div>
								<p class="floatright"><a href="<?php e($html->url('/boxtype/restart'));?>" class="btn2"><span>Restart</span></a></p>
							</div>
							</div>
						<div><img src="<?php  e($this->webroot);?>img/front/buildbottom.gif" alt="" width="267" height="4" /></div>
					</div>