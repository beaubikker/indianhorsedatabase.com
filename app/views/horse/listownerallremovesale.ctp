<?php
if(count($userarr)>0) {
	if(count($userarr)==1) {
		$height=80;
	}
	else {
		$height=200;
	}
?>
<div style="position:absolute; left:198px; height:<?php e($height);?>px; width:210px; overflow:auto; overflow-x:hidden; background:#fff;">
									<table align="center" width="210" class="listbox" cellspacing="0" cellpadding="4">
										<?php
										if(count($userarr)>0) {
											foreach($userarr as $key=>$val) :
												?>								
												<tr onClick="assignowner('<?php e($val['User']['firstname']);?>','<?php e($val['User']['lastname']);?>','<?php e($val['User']['id']);?>')">
													<td valign="top">	
														<?php
														$imagedirectory="profileimage";
														$image=$val['User']['image'];
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."profileimage/".$val['User']['image'],60,60);								
																?>									
																<img src="<?php e($this->webroot);?>img/profileimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
															<?php
															}
															else {
																?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60">
															<?php
														}
														?>
												</td>
												<td valign="top"><font color="#994F26"><?php e($val['User']['firstname']);?></font>
												<br>
												<span><?php e($val['User']['lastname']);?></span>																													
												</td>
												</tr>
												
												<?php
											endforeach;								
										}										
										?>		
										</table>	
							</div>
							<input type="hidden" name="hiddownerid" id="hiddownerid" value="" />
<?php
}
?>