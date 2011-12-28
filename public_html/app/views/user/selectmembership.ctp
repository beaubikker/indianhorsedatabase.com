<?php
e($this->renderelement('topheader'));
?>
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
					<h3 class="top8"></h3>				
					<div class="kilo">
						<div style="margin: 0 auto; width: 420px;">
						
<!-- 			LINK TO FREE MEMBER DEACTIVATED ON 24DEC 2011 by REYENG			 -->
						<!--
							<div class="info_80">
								<input class="submit_box111" type="submit" value="Free Member" onClick="window.location.href='<?/*php e($html->url('/user/freemembersignup'));?>'" style="cursor:pointer"/>
								<ul>
									<?php/*
									$freeuserarr=$this->requestAction('membership/listfreeall');
									if(count($freeuserarr)>0) {			
										foreach($freeuserarr as $key=>$val) :					
									?>
										<li>
											<a href="<?php e($html->url('/content/viewdetailsforfree/'.str_replace(" ", "-",$val['Listingfree']['contentname'])."/".$val['Listingfree']['id']))?>"><?php e($val['Listingfree']['contentname']);?></a>									
										</li>
									<?php
										endforeach ;
									}
									*/?>	
								</ul>
							</div>
							-->
<!-- 			LINK TO FREE MEMBER DEACTIVATED ON 24DEC 2011 by REYENG			 -->

							<div class="info_90">
								<input class="submit_box222" type="submit" value="Premium Member" onClick="window.location.href='<?php e($html->url('/user/signup/paidmember'));?>'" style="cursor:pointer"/>
								<ul>
									<?php
									$paidarr=$this->requestAction('membership/listpaidall');
									if(count($paidarr)>0) {			
										foreach($paidarr as $key=>$val) :					
									?>
										<li>
											<a href="<?php e($html->url('/content/viewdetailsforpaid/'.str_replace(" ", "-",$val['Listingpaid']['contentname'])."/".$val['Listingpaid']['id']))?>"><?php e($val['Listingpaid']['contentname']);?></a>									
										</li>
									<?php
										endforeach ;
									}
									?>
								</ul>
							</div>
							<div class="clear"></div>
						</div>
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
