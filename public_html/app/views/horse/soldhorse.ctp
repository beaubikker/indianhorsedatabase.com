<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function removefromsale(horseid,salesid) {
		if(parseInt(horseid)) {
			if(confirm("Are you sure to delete this")) {
				window.location.href='<?php e($html->url('/horse/reasonofremoving/'));?>'+horseid+'/'+salesid
			}		
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
					<h1 class="top">My Sold Horse </h1>	
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">
							<?php
							if(count($listsold_arr)>0) {
								if(is_array($listsold_arr)) {
									foreach($listsold_arr as $key=>$val) :
									$horsedetailsarr=$this->requestAction('/horse/horsedetails/'.$val['Remove']['horse_id']);
								?>
							<div class="pannel">
								<div class="big1">
												<?php
												$imagedirectory="horseimage";
												$image=$horsedetailsarr['Horse']['image'];
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."horseimage/".$horsedetailsarr['Horse']['image'],90,91);								
														?>									
														<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
													<?php
													}
													else {
														?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="112" height="91">
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="112" height="91">
													<?php
												}
												?>								
								</div>
								<div class="big2"><p class="kits"><?php e($horsedetailsarr['Horse']['name']);?><br /><span></p></div>
								<div class="big3"><p class="axe"><?php e($val['Remove']['reason_remove_sale']);?></p></div>		
								<div class="big4">										
								</div>						
							</div>																		
							<div>&nbsp;</div>	
							<?php
									endforeach;
								}
							 }							
							else {
								e("<div align=center><em><font color=#FF0000>There is no horse which has been sold </font></em></div>");
							}
							?>												
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>	
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
