<?php
e($html->css('style'));
?>
<div style="width: 300px; float: left;">
	<p style="font: normal 13px/20px calibri;"><b>We've been requested to change information for:<br>horse: <?php e($horsearr['Horse']['name']);?></b></p>
	<div style="border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 10px 0; margin: 10px 0; font: normal 13px/20px calibri;">
		<p>You're asked to approve this, as your are either:<br>The Owner - The Breeder or the person who added this horse to the IHD.</p>
		<p>We would like to ask you to check this info and let the IHD know about your opinion.</p>
	</div>
	<p style="font: normal 13px/20px calibri; padding-bottom: 15px;"><b>Following are the details about the change RQ:</b></p>
	<?php
	if(count($changereqarr)>0) {
		$cntr=1;
		//pr($changereqarr) ;
		foreach($changereqarr as $key=>$val) :
		$imagedirectory="horseadditionalimage";
		$image=$val['ChangerequestHorseimage']['image'];
		if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
		?>
		<div style="padding-bottom: 10px;">
			<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong></strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;"></span>
			<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>Image <?php e($cntr);?></strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
				<?php
					$imagedirectory="horseadditionalimage";
					$image=$val['ChangerequestHorseimage']['image'];
					if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
						$xy = $rsz->imgResize(rootpth()."horseadditionalimage/".$val['ChangerequestHorseimage']['image'],80,60);
						?>
						<img src="<?php e($this->webroot);?>img/horseadditionalimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
						<?php
					}	
					else {
						e("NA");
					}			
				?>
			</span>
			<div class="clear"></div>
		</div>	
		<?php
		}
		$cntr++;
		endforeach;
	}
	?>
	
	
	<?php if($horsearr['Horse']['name']!=$originalhorsearr[0]['Changerequesthorse']['name']) { ?>	
	<div style="padding-bottom: 10px;">
		<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Name:</strong></span>
		<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;"><strong><?php e($originalhorsearr[0]['Changerequesthorse']['name']);?></strong></span>
		<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
		<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;"><strong><?php e($horsearr['Horse']['name']);?></strong></span>
		<div class="clear"></div>
	</div>
	<?php
	}
	?>
	<?php if($horsearr['Horse']['stablename']!=$originalhorsearr[0]['Changerequesthorse']['stablename']) { ?>	
	<div style="padding-bottom: 10px;">
		<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Stable :</strong></span>
		<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;"><strong><?php e($originalhorsearr[0]['Changerequesthorse']['stablename']);?></strong></span>
		<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
		<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;"><strong><?php e($horsearr['Horse']['stablename']);?></strong></span>
		<div class="clear"></div>
	</div>
	<?php
	}
	?>
	<?php if($horsearr['Horse']['ownername']!=$originalhorsearr[0]['Changerequesthorse']['ownername']) { ?>	
		<div style="padding-bottom: 10px;">
			<span style="float: left; width: 100px; color:#994F26; font: normal 12px/20px calibri;"><strong>Owner Name :</strong></span>
			<span style="float: left; width: 50px; font: normal 12px/20px calibri; color:#D5B17C;"><strong><?php e($originalhorsearr[0]['Changerequesthorse']['ownername']);?></strong></span>
			<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;"><strong><?php e($horsearr['Horse']['ownername']);?></strong></span>
			<div class="clear"></div>
		</div>
	<?php
	}
	?>	
	<?php if($horsearr['Horse']['breeder']!=$originalhorsearr[0]['Changerequesthorse']['breeder']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Breeder:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					if($originalhorsearr[0]['Changerequesthorse']['breeder']) {
						e($originalhorsearr[0]['Changerequesthorse']['breeder']);
					}
					else {
						e("NA");
					}
					?>
				</strong></span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					e($horsearr['Horse']['breeder']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	 <?php if($horsearr['Horse']['gender']!=$originalhorsearr[0]['Changerequesthorse']['gender']) { ?>
		<div style="padding-bottom: 10px;">
			<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Gender :</strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
				<strong><?php
					$gender=$this->requestAction('/horse/gendername/'.$originalhorsearr[0]['Changerequesthorse']['gender']);
					e($gender['Gender']['gender']);
				?>
				</strong>
			</span>
			<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
				<strong><?php
					$gender=$this->requestAction('/horse/gendername/'.$horsearr['Horse']['gender']);
					e($gender['Gender']['gender']);
				?>
				</strong>
			</span>
			<div class="clear"></div>
		</div>
	<?php
	}
	?>	
	<?php if($horsearr['Horse']['breed_id']!=$originalhorsearr[0]['Changerequesthorse']['breed_id']) { ?>
		<div style="padding-bottom: 10px;">
			<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Breed :</strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
				<strong><?php
					$breedname=$this->requestAction('/horse/breedname/'.$originalhorsearr[0]['Changerequesthorse']['breed_id']);
					e($breedname);
				?>
				</strong>
			</span>
			<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
			<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
				<strong><?php
					$breedname=$this->requestAction('/horse/breedname/'.$horsearr['Horse']['breed_id']);
					e($breedname);
				?>
				</strong>
			</span>
			<div class="clear"></div>
		</div>
	<?php
	}
	?>
	<?php 
		if($horsearr['Horse']['year']!=$originalhorsearr[0]['Changerequesthorse']['year']) { ?>
			<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Year :</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
					if($originalhorsearr[0]['Changerequesthorse']['year']) {
						e($originalhorsearr[0]['Changerequesthorse']['year']);
					}
					else {
						e("NA");
					}
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
						e($horsearr['Horse']['year']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>	
	<?php 
		if($horsearr['Horse']['yearofdeath']!=$originalhorsearr[0]['Changerequesthorse']['yearofdeath']) { ?>
			<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Deceased:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">&nbsp;&nbsp;&nbsp;
					<strong>
					<?php
					if($originalhorsearr[0]['Changerequesthorse']['yearofdeath']) {
						e($originalhorsearr[0]['Changerequesthorse']['yearofdeath']);
					}
					else {
						e("NA");
					}
					?>					
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
						e($horsearr['Horse']['yearofdeath']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	<?php 
		if($horsearr['Horse']['sire']!=$originalhorsearr[0]['Changerequesthorse']['sire']) { ?>
			<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Sire :</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
						if($originalhorsearr[0]['Changerequesthorse']['sire']) {
							e($originalhorsearr[0]['Changerequesthorse']['sire']);
						}
						else {
							e("NA");
						}
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
						e($horsearr['Horse']['sire']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	<?php 
		if($horsearr['Horse']['dam']!=$originalhorsearr[0]['Changerequesthorse']['dam']) { ?>
			<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Dam:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
						if($originalhorsearr[0]['Changerequesthorse']['dam']) {
							e($originalhorsearr[0]['Changerequesthorse']['dam']);
						}
						else {
							e("NA");
						}
					?>
					</strong>					
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php
						e($horsearr['Horse']['dam']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>	
	<?php if($horsearr['Horse']['height_id']!=$originalhorsearr[0]['Changerequesthorse']['height_id']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Height:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$heightval=$this->requestAction('/horse/heightval/'.$originalhorsearr[0]['Changerequesthorse']['height_id']);
					e($heightval);
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$heightval=$this->requestAction('/horse/heightval/'.$horsearr['Horse']['height_id']);
					e($heightval);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>	
	<?php if($horsearr['Horse']['coatcolor_id']!=$originalhorsearr[0]['Changerequesthorse']['coatcolor_id']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Coat Color:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$colorname=$this->requestAction('/horse/coatcolor/'.$originalhorsearr[0]['Changerequesthorse']['coatcolor_id']);
					e($colorname);
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$heightval=$this->requestAction('/horse/coatcolor/'.$horsearr['Horse']['coatcolor_id']);
					e($heightval);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	
	<?php if($horsearr['Horse']['registration_code']!=$originalhorsearr[0]['Changerequesthorse']['registration_code']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Number:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					if($originalhorsearr[0]['Changerequesthorse']['registration_code']) {
						e($originalhorsearr[0]['Changerequesthorse']['registration_code']);
					}
					else {
						e("NA");
					}
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					e($horsearr['Horse']['registration_code']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>	
	<?php if($horsearr['Horse']['bloodline']!=$originalhorsearr[0]['Changerequesthorse']['bloodline']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Bloodline:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">&nbsp;&nbsp;&nbsp;
					<strong>
					<?php 
					if($originalhorsearr[0]['Changerequesthorse']['bloodline']) {
						e($originalhorsearr[0]['Changerequesthorse']['bloodline']);
					}
					else {
						e("NA") ;
					}
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					e($horsearr['Horse']['bloodline']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>	
	
	<?php if($horsearr['Horse']['countryid']!=$originalhorsearr[0]['Changerequesthorse']['countryid']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Country:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$countryname=$this->requestAction('/country/countryname/'.$originalhorsearr[0]['Changerequesthorse']['countryid']);
					e($countryname['Country']['country']);
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$countryname=$this->requestAction('/country/countryname/'.$horsearr['Horse']['countryid']);
					e($countryname['Country']['country']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	
	<?php if($horsearr['Horse']['state_id']!=$originalhorsearr[0]['Changerequesthorse']['state_id']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>State:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$statename=$this->requestAction('/state/Statename/'.$originalhorsearr[0]['Changerequesthorse']['state_id']);
					e($statename['State']['statename']) ;
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$statename=$this->requestAction('/state/Statename/'.$horsearr['Horse']['state_id']);
					e($statename['State']['statename']) ;
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	<?php if($horsearr['Horse']['town_id']!=$originalhorsearr[0]['Changerequesthorse']['town_id']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Town:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$townname=$this->requestAction('/town/townname/'.$originalhorsearr[0]['Changerequesthorse']['town_id']);
					e($townname['Town']['town']) ;
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					$townname=$this->requestAction('/town/townname/'.$horsearr['Horse']['town_id']);
					e($townname['Town']['town']) ;
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	
	<?php if($horsearr['Horse']['prize_won']!=$originalhorsearr[0]['Changerequesthorse']['prize_won']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 100px; color:#994F26; font: normal 12px/20px calibri;"><strong>Prize Won:</strong></span>
				<span style="float: left; width: 50px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
						if($originalhorsearr[0]['Changerequesthorse']['prize_won']) {
							e($originalhorsearr[0]['Changerequesthorse']['prize_won']);
						}
						else {
							e("NA");
						}
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					e($horsearr['Horse']['prize_won']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	
	
	<?php if($horsearr['Horse']['bred_id']!=$originalhorsearr[0]['Changerequesthorse']['bred_id']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 100px; color:#994F26; font: normal 12px/20px calibri;"><strong>Born At:</strong></span>
				<span style="float: left; width: 50px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
						if($originalhorsearr[0]['Changerequesthorse']['bred_name']) {
							e($originalhorsearr[0]['Changerequesthorse']['bred_name']);
						}
						else {
							e("NA");
						}
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					if($horsearr['Horse']['bred_name']) {
						e($horsearr['Horse']['bred_name']);
					}
					else {
						e("NA");
					}
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>
	<?php if($horsearr['Horse']['other_details']!=$originalhorsearr[0]['Changerequesthorse']['other_details']) { ?>
		<div style="padding-bottom: 10px;">
				<span style="float: left; width: 50px; color:#994F26; font: normal 12px/20px calibri;"><strong>Other Details:</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
						e($originalhorsearr[0]['Changerequesthorse']['other_details']);
					?>
					</strong>
				</span>
				<span style="float: left; width: 45px; font: normal 12px/20px calibri; color:#D5B17C;"><strong>To</strong></span>
				<span style="float: left; width: 100px; font: normal 12px/20px calibri; color:#D5B17C;">
					<strong>
					<?php 
					e($horsearr['Horse']['other_details']);
					?>
					</strong>
				</span>
				<div class="clear"></div>
			</div>
	<?php
	}
	?>	
</div>
		<div style="width: 110px; float: right;">
		<?php
		$imagedirectory="horseimage";
		$image=$horsearr['Horse']['image'] ;
		if($image!="") {
			if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
				$xy = $rsz->imgResize(rootpth()."horseimage/".$image,100,100);
			?>
				<br>
				<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
			<?php
			}
		}
		?></div>
<div class="clear"></div>