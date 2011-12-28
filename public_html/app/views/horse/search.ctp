<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function details(hornamename,horseid) {
		if(parseInt(horseid)) {
			window.location.href='<?php e($html->url('/horse/details/'));?>'+hornamename+'/'+horseid ;		
		}	
	}
</script>
</head>
<body>		
	<div id="wrapper_parrent">		
		<?php e($this->renderelement('search'));?>
		<br clear="all" />
		<div id="wrapper">
		<?php
		e($this->renderelement('frontheader'));			
		?>		
		<div class="sub_body">			
				<div class="upper">
				<div>&nbsp;</div>					
					<?php
					$chksession=$this->requestaction('/user/chksession');
					if($chksession=="") {
						 e($this->renderElement('rightpanel'));						 
					}
					else {
						$usertype=$this->requestaction('/user/usertype');
						if($usertype=="P") {
							$chklogincounter=$this->requestaction('/user/chklogincounter');
							if($chklogincounter<=0) {
								e($this->renderElement('rightpanelpremiumfirst'));	
							}
							else {
								e($this->renderElement('pemiumuservariouslogin'));	
							}	
						}	
						else {
							e($this->renderElement('rightpanelfreeuser'));
						}					
					}
					?>
					<div style="float: left; width: 762px;">
					<h1 class="top">Search Horse <?php if(@$_GET['search']!="Search") { if(@$_GET['search']){ e("( With '".$_GET['search']."' Keyword )") ; } }?></h1>				
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">
							<?php
							if(count($horslistarr)>0) {
								if(is_array($horslistarr)) {
									foreach($horslistarr as $key=>$val):
									?>
										<div class="pannel">
											<div class="big1">
												<?php
												$imagedirectory="horseimage";
												$image=$val['Horse']['image'];
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],90,91);								
														?>									
														<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>
													<?php
													}
													else {
														?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="91" height="91" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="91" height="91" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
													<?php
												}
												?>											
											</div>
											<div class="big2"><p class="kits">
											<span  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"><a href="javascript:void(0)"><?php e($val['Horse']['name']);?></a></span><br />
											<?php 
												$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
												e($gender['Gender']['gender']);  
											?>
											 <br /><span>Year :
											 <?php 
												if($val['Horse']['year']) {
													e($val['Horse']['year']);
												}
												else {
													e("NA");
												}									
											 ?></span>											
											<br><?php 
											$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
											e($breedname);											
											 ?>											
											 </p></div>
											<div class="big3"><p class="axe">
											<?php 
											if($val['Horse']['town_id']) {
												$townname=$this->requestAction('/town/townname/'.$val['Horse']['town_id']);
												e($townname['Town']['town']);											
											}
											if($val['Horse']['countryid']) {
												$countryname=$this->requestAction('/country/countryname/'.$val['Horse']['countryid']);
												e(",".$countryname['Country']['country']);											
											}
											e("<br>");
											e($val['Horse']['sire']);
											e("<br>");
											e($val['Horse']['dam']);
											?>
											</p></div>		
											<div class="big4">
												<input class="submit_btn9" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>										
											</div>														
										</div>		
									<?php
									endforeach;
								}
							}
							else  {
								e("<div align=center><font color=#FF0000><em><b>Sorry! No horse found from database </b></em></font></div>");	
							}
							?>				
							<div>&nbsp;</div>													
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>	
					<?php
					if($pagistr!="") { 
					?>
					<div class="pagination">
						<ul>
							<?php
							e($prevpage);
							e($pagistr);				
							e($nextpage);?>
						</ul>
					</div>
					<?php
					}
					?>
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>														
				</div>				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>				
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>		
</body>
</html>
