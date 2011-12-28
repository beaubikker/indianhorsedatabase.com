<?php
if(count($listhorst)>0) {
	if(count($listhorst)==1) {
		$height=80;
	}
	else {
		$height=200;
	}
?>
<div style="position:absolute; left:145px; height:<?php e($height);?>px; width:205px; overflow:auto; overflow-x:hidden; background:#fff;">			
										<table align="center" width="205" class="listbox" cellspacing="0" cellpadding="4">
										<?php
										if(count($listhorst)>0) {
											foreach($listhorst as $key=>$val) :
												?>								
													<tr onclick="assignoffspring('<?php e($val['Horse']['name']);?>')">
														<td valign="top">	
															<?php
															$imagedirectory="horseimage";
															$image=$val['Horse']['image'];
															if($image!="") {
																if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																	$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],60,60);								
																	?>									
																	<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
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
													<td valign="top"><font color="#994F26"><?php e($val['Horse']['name']);?></font>
													<br>
													<span><?php 
														$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
														e($breedname);											
														 ?></span>
														 <br /><span>Year :
														 <?php 
															if($val['Horse']['year']) {
																e($val['Horse']['year']);
															}
															else {
																e("NA");
															}									
														 ?></span>																	
													</td>
													</tr>
													<tr>
														<td></td>
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