ON HOVER INFO HORSE PROFILE SIRE DAM
<!-- 				code line #1 start			 -->


<div class="small_box" id="smaallimage" style="position: absolute; left: 200px; top: 170px; display: none;" >
			<?php
			if(count($horsesirearr)>0) {
			?>	
				<h3 class="toxic1"><?php e($horsesirearr[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horsesirearr[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}


						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horsesirearr[0]['Horse']['breed_id']));?><br /><?php e($horsesirearr[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			?>
			</div>			
			<div class="small_box" id="smaallimage1" style="position: absolute; left: 200px; top: 170px; display: none;"  >
			<?php
			if($horsearr['Horse']['sire_id']!="") {
			?>	
				<h3 class="toxic1"><?php e($siredetailsarr['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$siredetailsarr['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$siredetailsarr['Horse']['breed_id']));?><br /><?php e($siredetailsarr['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
			
<!-- 		Code line #1 end	 -->
<!-- 				code line #1 start			 -->


<div class="small_box" id="smaallimagefordam" style="position: absolute; left: 200px; top: 213px; display: none;" >
			<?php
			if(count($horsedamarr)>0) {
			?>	
				<h3 class="toxic1"><?php e($horsedamarr[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horsedamarr[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horsedamarr[0]['Horse']['breed_id']));?><br /><?php e($horsedamarr[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			?>
			</div>	
			
			<div class="small_boxsire" id="smaallimagefordam1" style="position: absolute; left: 200px; top: 213px; display: none;" >
			<?php			
			if($horsearr['Horse']['dam_id']!="") {
			?>
		
				<h3 class="toxic1"><?php e($damdetailsarr['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$damdetailsarr['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$damdetailsarr['Horse']['breed_id']));?><br /><?php e($damdetailsarr['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
			<!-- 		Code line #2 end	 -->



<!-- 		Disabled by reyeng first collumn of pedigree chart
						<div class="poll" style="text-align: center; line-height: 167px; height: 167px;"><h3 style="padding: 0;"><?php/* e($horsearr['Horse']['name']);*/?></h3></div> 
						
						-->
			