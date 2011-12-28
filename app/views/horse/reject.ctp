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
					<form action="" name="frmreject" method="post">				
						<div class="profile_info">
							<div class="po_inf_up">&nbsp;</div>
						  <div class="po_inf_mid">	
								<div>&nbsp;</div>
								<?php
								if(count($count_arr)<=0) {
								?>
										<h3>Your Reason</h3>
										<div>&nbsp;</div>
										<p>Please help us understand what is incorrect about this information.</p>
										<div class="form_box" style="width: 450px;">
											<div style="float: left; width: 300px; padding: 0 20px;"><textarea class="formarea1" name="message" id="message" value="" style="width: 300px; height: 70px;" /></textarea></div>
											<div style="float: left; width: 50px; margin-top: 50px;"><input style="cursor:pointer;" class="newbutton" type="submit" value="Go"   name="sub"/></div>
											<div style="clear: both; line-height: 0; font-size: 0;"></div>
										</div>
										<br>
										<br>
									<?php
									}
								else {
									?>
										<h3>You have already specified a reason :</h3>
										<div class="form_box">
											<label class="formarea">Message:</label><p><?php e($count_arr[0]['tbl_horserequestreject']['reason']);?></p>											
										</div>
										<input class="mass150" type="button" value="Back"   onClick="javascript:window.history.back()" style="cursor:pointer"/>
								<?php
								}
								?>								
							</div>
							<div class="po_inf_btm">&nbsp;</div>						
						</div>
					</form>
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
