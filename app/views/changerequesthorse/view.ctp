<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Change Edit Request </td>
				</tr> 
			</table>
		</td>
	</tr>
<tr>
	<td valign="top" align="left" class="box"> 
	<table align="center" width="100%">
	<tr>
		<td align="left" style="color:#000000">
			<font color="#000000"><b>Status :</b></font>
			<br />
			<?php
			 if(count($reject_arr)>0) {
			 	if(is_array($reject_arr)) {
					foreach($reject_arr as $key=>$val) :
					?>
						<?php
						if($val['Reject']['typeofuser']=="owner") {
							e("Owner  : ") ;
						}
						if($val['Reject']['typeofuser']=="breeder") {
							e("Breeder  : ") ;
						}	
						if($val['Reject']['typeofuser']=="adder") {
							e("Adder  : ") ;
						}				
						e($val['User']['firstname'].'  '.$val['User']['lastname']);?> has <span style="background-color:#FF0000"><b>disagreed</b></span>  with change reason : "<?php e($val['Reject']['reason']);?>"	<br />			
					<?php	
					endforeach;		
				}			 
			 }			
			?>	
			<br />
			<br />			
			<?php
			 if(count($accept_arr)>0) {
			 	if(is_array($accept_arr)) {
					foreach($accept_arr as $key=>$val) :
					?>
						<?php
						if($val['Accept']['typeofuser']=="owner") {
							e("Owner  ") ;
						}
						if($val['Accept']['typeofuser']=="breeder") {
							e("Breeder  : ") ;
						}	
						if($val['Accept']['typeofuser']=="adder") {
							e("Adder  : ") ;
						}										
						e($val['User']['firstname'].'  '.$val['User']['lastname']);?> has <span style="background-color:#99CC66"><b>agreed</b></span>  with change		<br /><br />			
					<?php	
					endforeach;		
				}			 
			 }			
			?>	
			<p>&nbsp;&nbsp;</p>				
			</td>
		<td align="right">			
			<?php
			if($Changerequesthorsehorsearr['Changerequesthorse']['revert_status']=="N") {
			?>
				<input type="button" value="Cancel" class="button" onClick="window.location.href='<?php e($html->url('/changerequesthorse/'));?>'">
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Revert Changes" class="button" onClick="window.location.href='<?php e($html->url('/changerequesthorse/revert/'.$id));?>'">
			<?php
			}
			?>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="center">
			<form name="frm" id="event" method="post" action="" enctype="multipart/form-data">	
				<table width="50%" border="0" cellspacing="1" cellpadding="5" align="left" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Original Information </b></td>
				  </tr>				  
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Name: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['name']);
						?>			 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Gender: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$gender=$this->requestAction('/horse/gendername/'.$horsearr['Horse']['gender']);
							e($gender['Gender']['gender']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Breed: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$breeder=$this->requestAction('/horse/breedname/'.$horsearr['Horse']['breed_id']);
							e($breeder);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Year: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['year']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Deceased: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['yearofdeath']);
						?>										 	 
					</td>
				 </tr>
				
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Sire: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['sire']);
						?>				 	 
					</td>
				 </tr> 
				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Sire Known Option: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($horsearr['Horse']['sireunknowoption']=="Y") {
							e("Yes");
						}
						else {
							e("No");
						}
						?>				 	 
					</td>
				 </tr>
				 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Dam: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['dam']);
						?>				 	 
					</td>
				 </tr> 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Dam Known Option: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($horsearr['Horse']['damunknownoption']=="Y") {
							e("Yes");
						}
						else {
							e("No");
						}
						?>				 	 
					</td>
				 </tr>			 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Height: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$height=$this->requestAction('/horse/heightval/'.$horsearr['Horse']['height_id']);
							e($height);
						?>				 	 
					</td>
				 </tr> 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Coat Color: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$coatcolor=$this->requestAction('/horse/coatcolor/'.$horsearr['Horse']['coatcolor_id']);
							e($coatcolor);
						?>				 	 
					</td>
				 </tr>				
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Number: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['registration_code']);
						?>										 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Bloodline: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['bloodline']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Breeder: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['breeder']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Owner: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['ownername']);
						?>			 	 
					</td>
				 </tr>					   
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Stable: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['stablename']);
						?>				 	 
					</td>
				 </tr> 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Horse Image: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
								$imagedirectory="horseimage";
								$image=$horsearr['Horse']['image'] ;
								if($image) {
									if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										$xy = $rsz->imgResize(rootpth()."horseimage/".$image,250,135);
									?>
										<br>
										<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
									<?php
									}
								}
								?>				 	 
					</td>
				 </tr>
				 <?php
				 if(count($additionalimagearr)>0) {
				 ?>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Additional Image: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php								
							if(is_array($additionalimagearr)) {
								e("<br>");
								foreach($additionalimagearr as $key=>$val) :
								$imagedirectory="horseadditionalimage";
								$image=$val['Horseimage']['image'];
								if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
									$xy = $rsz->imgResize(rootpth()."horseadditionalimage/".$val['Horseimage']['image'],120,120);
								?>
									<img class="upload50" src="<?php e($this->webroot);?>img/horseadditionalimage/<?php e($image);?>" alt="" align="middle"  width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>"/>
									<?php
								}
								e("<br>");
								e("<br>");
								endforeach;
							}							
						?>		 	 
					</td>
				 </tr>
				 <?php
				 }
				 ?>	
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Country: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$Country=$this->requestAction('/country/countryname/'.$horsearr['Horse']['countryid']);
							e($Country['Country']['country']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">State: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$state=$this->requestAction('/state/Statename/'.$horsearr['Horse']['state_id']);
							e($state['State']['statename']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Town/Region: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$town=$this->requestAction('/town/townname/'.$horsearr['Horse']['town_id']);
							e($town['Town']['town']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Born at: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['bred_name']);
						?>				 	 
					</td>
				 </tr>				  				  
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Prize won: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['prize_won']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Other Details: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($horsearr['Horse']['other_details']);
						?>				 	 
					</td>
				 </tr>			 
  			  </table>
			  <table width="45%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>Changed Information</b></td>
				  </tr>				  
				  <tr class="even_tr" <?php if($horsearr['Horse']['name']!=$Changerequesthorsehorsearr['Changerequesthorse']['name']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Name: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['name']);
						?>			 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['gender']!=$Changerequesthorsehorsearr['Changerequesthorse']['gender']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Gender: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$gender=$this->requestAction('/horse/gendername/'.$Changerequesthorsehorsearr['Changerequesthorse']['gender']);
							e($gender['Gender']['gender']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['breed_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['breed_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Breed: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$breeder=$this->requestAction('/horse/breedname/'.$Changerequesthorsehorsearr['Changerequesthorse']['breed_id']);
							e($breeder);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['year']!=$Changerequesthorsehorsearr['Changerequesthorse']['year']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Year: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['year']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['yearofdeath']!=$Changerequesthorsehorsearr['Changerequesthorse']['yearofdeath']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Deceased: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['yearofdeath']);
						?>										 	 
					</td>
				 </tr>				
				 <tr class="even_tr" <?php if($horsearr['Horse']['sire_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['sire_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Sire: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['sire']);
						?>				 	 
					</td>
				 </tr> 
				 <tr class="even_tr" <?php if($horsearr['Horse']['sireunknowoption']!=$Changerequesthorsehorsearr['Changerequesthorse']['sireunknowoption']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Sire Known Option: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($Changerequesthorsehorsearr['Changerequesthorse']['sireunknowoption']=="Y") {
							e("Yes");
						}
						else {
							e("No");
						}
						?>				 	 
					</td>
				 </tr> 
				 
				  <tr class="even_tr" <?php if($horsearr['Horse']['dam_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['dam_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Dam: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['dam']);
						?>				 	 
					</td>
				 </tr>				 
				 <tr class="even_tr" <?php if($horsearr['Horse']['damunknownoption']!=$Changerequesthorsehorsearr['Changerequesthorse']['damunknownoption']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Dam Known Option: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($Changerequesthorsehorsearr['Changerequesthorse']['damunknownoption']=="Y") {
							e("Yes");
						}
						else {
							e("No");
						}
						?>				 	 
					</td>
				 </tr> 			 
				  <tr class="even_tr"  <?php if($horsearr['Horse']['height_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['height_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Height: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$height=$this->requestAction('/horse/heightval/'.$Changerequesthorsehorsearr['Changerequesthorse']['height_id']);
							e($height);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['coatcolor_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['coatcolor_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Coat Color: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$coatcolor=$this->requestAction('/horse/coatcolor/'.$Changerequesthorsehorsearr['Changerequesthorse']['coatcolor_id']);
							e($coatcolor);
						?>				 	 
					</td>
				 </tr>				 
				  <tr class="even_tr" <?php if($horsearr['Horse']['registration_code']!=$Changerequesthorsehorsearr['Changerequesthorse']['registration_code']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Number: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['registration_code']);
						?>										 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['bloodline']!=$Changerequesthorsehorsearr['Changerequesthorse']['bloodline']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Bloodline: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['bloodline']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['breeder_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['breeder_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Breeder: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['breeder']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['ownerid']!=$Changerequesthorsehorsearr['Changerequesthorse']['ownerid']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Owner: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['ownername']);
						?>			 	 
					</td>
				 </tr>					    
				 <tr class="even_tr" <?php if($horsearr['Horse']['stablename']!=$Changerequesthorsehorsearr['Changerequesthorse']['stablename']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Stable: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['stablename']);
						?>				 	 
					</td>
				 </tr> 
				 <tr class="even_tr" <?php if($horsearr['Horse']['image']!=$Changerequesthorsehorsearr['Changerequesthorse']['image']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Horse Image: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
								$imagedirectory="horseimage";
								$image=$Changerequesthorsehorsearr['Changerequesthorse']['image'] ;
								if($Changerequesthorsehorsearr['Changerequesthorse']['image']) {
									if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										$xy = $rsz->imgResize(rootpth()."horseimage/".$image,250,135);
									?>
										<br>
										<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
									<?php
									}
								}
								?>				 	 
					</td>
				 </tr>
				 <?php
				 if(count($change_image_ar)>0) {
				 ?>
				  <tr class="even_tr" style="padding:10px;background-color:#99FF66" >
					<td width="30%" align="left" valign="top" class="bold_text">Additional Image: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php								
							if(is_array($change_image_ar)) {
								e("<br>");
								foreach($change_image_ar as $key=>$val) :
								$imagedirectory="horseadditionalimage";
								$image=$val['Horseimage']['image'];
								if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
									$xy = $rsz->imgResize(rootpth()."horseadditionalimage/".$val['Horseimage']['image'],120,120);
								?>
									<img class="upload50" src="<?php e($this->webroot);?>img/horseadditionalimage/<?php e($image);?>" alt="" align="middle"  width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>"/>
									<?php
								}
								e("<br>");
								e("<br>");
								endforeach;
							}							
						?>		 	 
					</td>
				 </tr>
				 <?php
				 }
				 else {
					?>
				<tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Additional Image: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<b>No Chnage In Additioanal Image </b>	 	 
					</td>
				 </tr>					
					<?php
				}
				?>
				  <tr class="even_tr" <?php if($horsearr['Horse']['countryid']!=$Changerequesthorsehorsearr['Changerequesthorse']['countryid']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Country: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$Country=$this->requestAction('/country/countryname/'.$Changerequesthorsehorsearr['Changerequesthorse']['countryid']);
							e($Country['Country']['country']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['state_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['state_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">State: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$state=$this->requestAction('/state/Statename/'.$Changerequesthorsehorsearr['Changerequesthorse']['state_id']);
							e($state['State']['statename']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['town_id']!=$Changerequesthorsehorsearr['Changerequesthorse']['town_id']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Town/Region: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
							$town=$this->requestAction('/town/townname/'.$Changerequesthorsehorsearr['Changerequesthorse']['town_id']);
							e($town['Town']['town']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['bred_name']!=$Changerequesthorsehorsearr['Changerequesthorse']['bred_name']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Born at: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['bred_name']);
						?>				 	 
					</td>
				 </tr> 				  
				 <tr class="even_tr" <?php if($horsearr['Horse']['prize_won']!=$Changerequesthorsehorsearr['Changerequesthorse']['prize_won']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Prize won: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['prize_won']);
						?>				 	 
					</td>
				 </tr>
				 <tr class="even_tr" <?php if($horsearr['Horse']['other_details']!=$Changerequesthorsehorsearr['Changerequesthorse']['other_details']) { ?> style="padding:10px;background-color:#99FF66" <?php } ?>>
					<td width="30%" align="left" valign="top" class="bold_text">Other Details: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						e($Changerequesthorsehorsearr['Changerequesthorse']['other_details']);
						?>				 	 
					</td>
				 </tr>
				 
				 				 
				 <?php
				 
				 
				 if($Changerequesthorsehorsearr['Changerequesthorse']['approve_status']=="N") {
				 ?>		
					 <tr class="even_tr">
						<td>&nbsp;</td>
						<td align="left" class="bold_text" valign="top">
							<input type="button" value="Approve" class="button" onClick="window.location.href='<?php e($html->url('/changerequesthorse/approve/'.$id));?>'">
							&nbsp;&nbsp;&nbsp;
							<input type="button" value="Reject" class="button" onClick="window.location.href='<?php e($html->url('/changerequesthorse/reject/'.$id));?>'">
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/changerequesthorse') ;?>'" />					</td>
					  </tr>
				  <?php
				  }
				  else {
				  ?>
				  	 <tr class="even_tr">
						<td>&nbsp;</td>
						<td align="left" class="bold_text" valign="top">						
							<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/changerequesthorse') ;?>'" />					</td>
					  </tr>				  
				  <?php
				  }
				  ?>				 		 
  			  </table>
			</form>
		</td>
	</tr>		
</table>
</td>
</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 
