<div class="po_inf_mid" style="padding-left:10px">
							<h4 onClick="closenoti()" style="cursor:pointer">close x</h4>
							<h2 class="up_heading" style="padding: 0 0 10px 0;">Subscriptions</h2>
							<?php
								if(count($liststablearr)>0) {
									if(is_array($liststablearr)) {
										?>
										<h3 class="plus">Stable<span style="float:right; padding-right:15px;"></span></h3>
										<?php
										foreach($liststablearr as $key=>$val) :
										?>		
											<div style="overflow:hidden;">									
											  <p class="box_text"> <a href="<?php e($html->url('/stable/viewprofile/'.$val['Stable']['id']));?>" style="color:#CBBF84; text-decoration:none"> <b>
											    <?php e($val['Stable']['stable_name']) ;?>
											    </b> </a> <span style="float:right; padding-right:10px; cursor:pointer" onClick="delstablenotifi('<?php e($val['Stable']['id']) ;?>')"><img src="<?php e($this->webroot);?>img/x_button.gif" onClick="delstablenotifi('<?php e($val['Stable']['id']) ;?>')" /></span> </p>
											</div>
										<?php
												endforeach;
												e("<br>");
										}
									}
									?>									
								<?php
								if(count($listuserarr)>0) {
									if(is_array($listuserarr)) {
										?>
										<h3 class="plus">User<span style="float:right; padding-right:15px;"></span></h3>
										<?php
										foreach($listuserarr as $key=>$val) :
										?>		
											<div style="overflow:hidden;">							
											<p class="box_text">
												<a href="<?php e($html->url('/user/viewaccount/'.base64_encode($val['User']['id'])));?>" style="color:#CBBF84; text-decoration:none">
													<?php e("<b>".$val['User']['firstname']."     ".$val['User']['lastname']."</b>");;?>
												</a>											
											<span style="float:right; padding-right:10px; cursor:pointer" onClick="delusernoti('<?php e($val['Usersubscription']['usrid']) ;?>')">
											<img src="<?php e($this->webroot);?>img/x_button.gif" onClick="delusernoti('<?php e($val['Usersubscription']['usrid']) ;?>')" /></span> </p>
											</div>											
										<?php
												endforeach;
												e("<br>");
										}
									}
									?>									
								<?php
								if(count($listhorsearr)>0) {
									if(is_array($listhorsearr)) {
										?>
										<h3 class="plus">Horse<span style="float:right; padding-right:15px;"></span></h3>
											<?php
											foreach($listhorsearr as $key=>$val) :
											?>			
													<div style="overflow:hidden;">								
													<p class="box_text">
													<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name'])."/".$val['Horse']['id']));?>" style="color:#CBBF84; text-decoration:none">
														<?php e("<b>".$val['Horse']['name']."</b>");?>
													</a>													
													<span style="float:right; padding-right:10px; cursor:pointer" onClick="delhorsenoti('<?php e($val['Horse']['id']) ;?>')">
													<img src="<?php e($this->webroot);?>img/x_button.gif" onClick="delhorsenoti('<?php e($val['Horse']['id']) ;?>')" /></span> </p>
													</div>
										<?php
												endforeach;
												e("<br>");
										}
									}
									?>																						
						  	<div>&nbsp;</div>
						  <div class="po_inf_btm">&nbsp;</div>						
					</div>