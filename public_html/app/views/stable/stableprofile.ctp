<!-- REYENG HAS BEEN HERE :) -->

<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
function del_stable(stable_id) {
	if(stable_id) {
		if(window.confirm("Are you sure to delete")) {
			window.location.href='<?php e($html->url('/stable/stabledelete/'));?>'+stable_id;		
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
					<h1 class="top">My Stable Profile 
					<?php
					if($stableexists=='NO') {
					?>
			
					<!-- REYENG - disabling the create stable feature -->
					

<!--
<a href=" <?php e($html->url('/stable/create'));?>"  style="color: #994F26;
						font-family: verdana;
						font-size: 18px;
						line-height: 20px;
						padding: 12px 0 0 30px;
						text-decoration: none;">Create Stable </a>
-->


<!-- REYENG -->


					<?php
					}
					?>
					</h1>			
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						
						<div class="po_inf_mid">
							
							<div align="center"><br>
							This feature will be added soon!
							</div>
							
<!-- REYENG - disabling the create stable feature -->

							
							<?php/*
							if(count($stable_arr)>0) {
								if(is_array($stable_arr)) {
									foreach($stable_arr as $key=>$val) :
									?>
							<div class="pannel">
								<div class="big1">
									<a href="<?php e($html->url('/stable/viewprofile/'.$val['Stable']['id']));?>">
									<?php
									$imagedirectory="stable_image";
									$image=$val['Stable']['stable_image'];
									if($image!="") {
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."stable_image/".$val['Stable']['stable_image'],90,91);								
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
									</a>							
								</div>
								<div class="big2"><p class="kits"><?php e($val['Stable']['stable_name']);?><br /><span>Date: <?php e(date('F Y', strtotime($val['Stable']['posted_date']))); ?></span></p></div>
								<div class="big3"><p class="axe"><?php e(substr($val['Stable']['services'],0,300));?></p></div>		
								<div class="big4">
									<input class="submit_btn9" type="button" value="Edit"  onClick="window.location.href='<?php e($html->url('/stable/editstable/'.$val['Stable']['id']));?>'"/>
									<input class="submit_btn10" type="button" value="Remove" onClick="del_stable('<?php e($val['Stable']['id']);?>')" />	
								</div>						
							</div>
							<?php
									endforeach;
								}								
							}
							else {
									e("<div align=center><b><em><font color=#FF0000>There is no stable </font></em></b></div>");
								}
							*/?>	
							
<!-- REYENG - disabling the create stable feature -->
			
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
