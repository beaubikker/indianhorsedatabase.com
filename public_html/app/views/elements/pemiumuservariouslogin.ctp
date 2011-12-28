<?php
$userarr=$this->requestaction('/user/userdetails');
?>
<!-- added on 23.6 -->
<div style="float: right; width: 176px;">
<!-- added on 23.6 -->
<div class="visitor" style="position:absolute; top:165px">
						<div class="vis_up">&nbsp;</div>
						<div class="vis_mid">
							<h2 style="text-align: left; padding-left: 10px;">Welcome<br /><?php e($userarr['User']['firstname']);?></h2> 													
							<?php
							$imagedirectory="profileimage";
							$image=$userarr['User']['image'];
							if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
								if($image!="") {
									$xy = $rsz->imgResize(rootpth()."profileimage/".$image,96,83);
								?>
									<p style="text-align: center;"><img src="<?php e($this->webroot);?>img/profileimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>"></p>
								<?php
								}
								else {
								?>
									<p style="text-align: center;"><img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="96" height="83"></p>
								<?php
								
								}
							}
							else {
							?>
								<p style="text-align: center;"><img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="96" height="83"></p>
							<?php							
							}							
							?>
							<ul>
								<li><a href="<?php e($html->url('/user/premiumuserwelcomepage'));?>">Dashboard</a></li>
								<li><a href="<?php e($html->url('/user/profile'));?>">Personal Profile</a></li>
								<li><a href="<?php e($html->url('/user/userpaiduseaccount'));?>">Account Details</a></li>
								<?php
								$stablearr=$this->requestAction('/stable/viewuserstabename');
								if(count($stablearr)>0) {
								?>
									<li><a href="<?php e($html->url('/stable/viewmystableprofileprofile/'.$stablearr[0]['Stable']['id']));?>"><?php e($stablearr[0]['Stable']['stable_name']);?></a></li>
								<?php								
								}
								else {								
								?>
									<li><a href="<?php e($html->url('/stable/stableprofile/'));?>">Add your stable!</a></li>
								<?php
								}
								?>								
								<li><a href="<?php e($html->url('/horse/myhorsesforsale'));?>">My Horses For Sale</a></li>
								<li><a href="<?php e($html->url('/horse/myhorsesforstud'));?>">My Horses For Stud</a></li>
								<li><a href="<?php e($html->url('/horse/addhorse'));?>">Add horse</a></li>
								<li><a href="<?php e($html->url('/horse/mylistedhorse'));?>">My Horses</a></li>								
							</ul>
							<input class="button-reyeng" type="button" value="Logout"  style="cursor:pointer" onClick="window.location.href='<?php e($html->url('/user/freeuserlogout'));?>'"/></div>
						<div class="vis_bottom">&nbsp;</div>
						<!-- added on 23.6 -->
						</div>	
						<div style="height: 15px;"></div>
						<div class="visitor" style="position:absolute; top:660px">
						<div class="vis_up">&nbsp;</div>
						<div class="vis_mid">
						<!-- added on 23.6 -->	
						<?php
						$advertisementarr=$this->requestAction('/advertisement/listall'); 
						if(count($advertisementarr)>0) {
							foreach($advertisementarr as $key=>$val) :						
						?>
						<!-- added on 23.6 -->
						<!--<div class="advertisement">-->
						<!-- added on 23.6 -->
							<!--<h2 style="text-align: left; padding-left: 10px;"><?php //e($val['Advertisement']['name']);?></h2>-->
							<p style="text-align: center;"><?php e($val['Advertisement']['shortdescription']);?></p>
								<?php
								if($val['Advertisement']['image']!="") {
								?>
									<img class="message" src="<?php e($this->webroot);?>img/advertisementimage/<?php e($val['Advertisement']['image']);?>" alt=""  height="44" width="44" style="padding-left:6px" align="absmiddle"/>
								<?php
								}
								?>
							<?php
							if($val['Advertisement']['url']!="") {
							?>
								<a href="http://<?php e($val['Advertisement']['url']);?>" target="_blank"><?php e($val['Advertisement']['url']);?></a>
							<?php
							}
							?>
						<!-- added on 23.6 -->
						<!--</div>-->
						<!-- added on 23.6 -->	
						<?php
							endforeach;							
						}
						?>				
					</div>
					<!-- added on 23.6 -->
																					<div class="vis_bottom">&nbsp;</div>
																					</div>
																					</div>
																					<!-- added on 23.6 -->