<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function removefromsale(horseid,salesid) {
		if(parseInt(horseid)) {
			//if(confirm("Are you sure to delete this")) {
			window.location.href='<?php e($html->url('/horse/reasonofremoving/'));?>'+horseid+'/'+salesid
			//}		
		}	
	}
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
					<h1 class="top" style="width: auto;">For Sale</h1>
				      <div style="float: right; width: auto;"><input type="button" onClick="window.location.href='<?php e($html->url('/horse/mylistedhorse'));?>'"  class="submit_btn200" value="Put a horse up for Sale"></div>
					  <div style="clear: both; line-height: 0; font-size: 0;"></div>	
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">
							<?php
							if(count($listhorseforsale)>0) {
								if(is_array($listhorseforsale)) { 
									foreach($listhorseforsale as $key=>$val) :
									$horsedetailsarr=$this->requestAction('/horse/horsedetails/'.$val['Horsesale']['horse_id']);
								?>
							<div class="pannel">
								<div class="big1" style="width: 112px;">
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
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="112" />
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="112" />
													<?php
												}
												?>								
								</div>
								<div class="big2" style="width: 540px;"><p class="kits" style="width: 500px; padding-left: 20px; padding-right: 20px; padding-top: 0;">
								<span  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$horsedetailsarr['Horse']['name']));?>','<?php e($horsedetailsarr['Horse']['id']);?>')"><a href="javascript:void(0)"><?php e($horsedetailsarr['Horse']['name']);?></a></span><br />
								<div style="float: left; width: 230px; padding-left: 20px;">
								<span>Date put up for sale:<br><?php e(date(' d F Y', strtotime($val['Horsesale']['posted_date']))); ?></span><br /><br />
								<span>For Sale:<br><?php							
								$pricerangename=$this->requestAction('/pricerange/pricerangename/'.$val['Horsesale']['pricerange_fromid']);								
								$pricerangenameto=$this->requestAction('/pricerange/pricerangename/'.$val['Horsesale']['pricerange_toid']);
								e($pricerangename['Pricerange']['pricefrom']."--".$pricerangenameto['Pricerange']['pricetoo']);								
								?></span>
								</div>
								<div style="float: left; width: 230px; margin-left: 20px;">
								<span><?php e($val['Horsesale']['salesdescription']);?></span>
								</div>
								<div style="clear: both; line-height: 0; font-size: 0;"></div>
								</p>
								</div>
								<div class="big4">
									<input class="submit_btn9" type="button" value="Edit"  onClick="window.location.href='<?php e($html->url('/horse/edithorseforsale/'.$val['Horsesale']['id']));?>'"/>
									<input class="submit_btn10" type="button" value="Remove"  onClick="removefromsale('<?php e($horsedetailsarr['Horse']['id']);?>','<?php e($val['Horsesale']['id']);?>')"/>	
									<input class="submit_btn9" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$horsedetailsarr['Horse']['name']));?>','<?php e($horsedetailsarr['Horse']['id']);?>')"/>
								</div>						
							</div>																		
							<div>&nbsp;</div>	
							<?php
									endforeach;
								}
							 }							
							else {
								e("<div align=center><em><font color=#FF0000>There is no horse for sale </font></em></div>");
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