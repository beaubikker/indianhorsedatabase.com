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
					<h1 class="top">Search Horse</h1>		
					<?php
					if($searchcondition=='yes') { 
					?>		
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
											<div class="big2"><p class="kits"><?php e($val['Horse']['name']);?><br /><span>Date: <?php e(date('F Y', strtotime($val['Horse']['posted_date']))); ?></span></p></div>
											<div class="big3"><p class="axe"><?php e(substr($val['Horse']['other_details'],0,300));?></p></div>		
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
