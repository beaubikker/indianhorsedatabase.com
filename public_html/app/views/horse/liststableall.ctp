<?php
if(count($stablearr)>0) {
	if(count($stablearr)==1) {
		$height=100;
	}
	else {
		$height=200;
	}
?>

<div style="height:<?php e($height);?>px;">			
										<table align="center" width="205" class="listbox" cellspacing="0" cellpadding="4">
										<?php
										if(count($stablearr)>0) {
											foreach($stablearr as $key=>$val) :
												?>								
												<tr onClick="assignstable('<?php e($val['Stable']['id']);?>','<?php e($val['Stable']['stable_name']);?>')">
													<td valign="top">	
														<?php
														$imagedirectory="stable_image";
														$image=$val['Stable']['stable_image'];
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."stable_image/".$image,90,91);								
																?>									
																<img src="<?php e($this->webroot);?>img/stable_image/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
															<?php
															}
															else {
																?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91">
															<?php
														}
														?>
												</td>
												<td valign="top"><font color="#994F26"><?php e($val['Stable']['stable_name']);?></font>
												<br>
												<span><br /><span>Date: <?php e(date('F Y', strtotime($val['Stable']['posted_date']))); ?></span>																													
												</td>
												</tr>												
												<?php
											endforeach;								
										}										
										?>		
										</table>	
							</div>
<?php
}
?>