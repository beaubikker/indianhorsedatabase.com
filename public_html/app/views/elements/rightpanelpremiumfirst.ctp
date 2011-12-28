<?php
$userarr=$this->requestaction('/user/userdetails');
?>
<div class="visitor">
						<div class="vis_up">&nbsp;</div>
						<div class="vis_mid">
							<h2>Welcome <?php e($userarr['User']['firstname']);?></h2> 
							<?php
							$imagedirectory="profileimage";
							$image=$userarr['User']['image'];
							if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
								if($image!="") {
									$xy = $rsz->imgResize(rootpth()."profileimage/".$image,96,83);
								?>
									<img src="<?php e($this->webroot);?>img/profileimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
								<?php
								}
								else {
								?>
									<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="96" height="83">
								<?php
								
								}
							}
							else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="96" height="83">
							<?php							
							}							
							?>													
							<ul>
								<li><a href="<?php e($html->url('/user/profile'));?>">Personal Profile</a></li>
								<li><a href="<?php e($html->url('/user/account'));?>">Account Details</a></li>
								<li><a href="<?php e($html->url('/horse/addhorse'));?>">Add horse</a></li>
								<li><a href="<?php e($html->url('/horse/mylistedhorse'));?>">Added horses</a></li>								
							</ul><input class="logout" type="button" value="Logout"  style="cursor:pointer" onClick="window.location.href='<?php e($html->url('/user/paiduserlogout'));?>'"/></div>
						<div class="vis_bottom">&nbsp;</div>	
						<?php
						$advertisementarr=$this->requestAction('/advertisement/listall');
						if(count($advertisementarr)>0) {
							foreach($advertisementarr as $key=>$val) :						
						?>
						<div class="advertisement">
							<h2><?php e($val['Advertisement']['name']);?></h2>
							<p><?php e($val['Advertisement']['shortdescription']);?></p>
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
						</div>	
						<?php
							endforeach;							
						}
						?>			
					</div>