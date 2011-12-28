<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
function del_horse(horse_id) {
	if(horse_id) {
		if(window.confirm("Are you sure to delete")) {
			window.location.href='<?php e($html->url('/horse/userhorsedel/'));?>'+horse_id;		
		}		
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
					<h1 class="top">My Horses</h1>			
					<div class="profile_info">
						<div class="po_inf_up">
						
							<div>&nbsp;</div>
							<br>
							</div>
							
							
						<!--<div class="po_inf_up">
						<?php
						//if(count($mypostedhorsearr)>0) {
						?>
							<div align="center" style="padding-left:700px"><b>Sort</b> : <a href="<?php //e($html->url('/horse/mylistedhorsefreemember/asc'));?>" style="text-decoration:none; color:#994F26;"><font size="+1">a</font></a>/<a href="<?php //e($html->url('/horse/mylistedhorsefreemember/desc'));?>" style="text-decoration:none; color:#994F26"><font size="+1">z</font></a><br></div>
							
							<?php
							//}
							?><br>
							</div>-->
							
							
						<div class="po_inf_mid">
							<?php
					if(count($mypostedhorsearr)>0) {
					?>
						<div align="center" style="padding-left:585px;"><b>Sort</b> : <a href="<?php e($html->url('/horse/mylistedhorse/asc'));?>" style="text-decoration:none; color:#994F26;"><font size="+1">a</font></a>/<a href="<?php e($html->url('/horse/mylistedhorse/desc'));?>" style="text-decoration:none; color:#994F26"><font size="+1">z</font></a><br><br>
						</div>
					<?php
					}
					?>
							<?php
							if(count($mypostedhorsearr)>0) {
								if(is_array($mypostedhorsearr)) {								
									foreach($mypostedhorsearr as $key=>$val) :
								?>
										<div class="pannel">
											<div class="big1" style="width: 112px;">
												<?php
												$imagedirectory="horseimage";
												$image=$val['Horse']['image'];
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],90,91);								
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
											<div class="big2"><p class="kits"><?php e($val['Horse']['name']);?><br /><span>Date: <?php e(date('F Y', strtotime($val['Horse']['posted_date']))); ?></span></p></div>
											<div class="big3"><p class="axe"><?php e(substr($val['Horse']['other_details'],0,300));?></p></div>		
											<div class="big4">
												<input class="submit_btn9" type="button" value="Edit"  onClick="window.location.href='<?php e($html->url('/horse/edithorseinfobyfreeuser/'.$val['Horse']['id']));?>'"/>
												<input class="submit_btn9" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>											
											</div>						
										</div>	
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />		
									<?php
									endforeach;
								}
							}
							else  {
								e("<div align=center><font color=#FF0000><em><b>Sorry! You have not posted any horse in Indian Horse database </b></em></font></div>");	
							}
							?>				
							<div>&nbsp;</div>													
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
