<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function Chkvalid() {
		var err=0;
		if(document.getElementById("HorsesaleContactdetails").value=="") {
			document.getElementById("HorsesaleContactdetails").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("HorsesaleContactdetails").style.border = "1px solid #7F9DB9";
		}
		if(document.getElementById("HorsesaleSalesdescription").value=="") {
			document.getElementById("HorsesaleSalesdescription").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("HorsesaleSalesdescription").style.border = "1px solid #7F9DB9";
		}
		if(!parseInt(document.getElementById("pricerange").value)) {
			document.getElementById("pricerange").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("pricerange").style.border = "1px solid #7F9DB9";
		}		
		if(!parseInt(document.getElementById("pricerangefrom").value)) {
			document.getElementById("pricerangefrom").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("pricerangefrom").style.border = "1px solid #7F9DB9";
		}
			
		if(err==0) {
			document.putforsale.submit();
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
					<form action="" method="post" name="putforsale">			
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">		
							<div class="form_box">
								<p class="formarea" style="color: #994F26; font-size: 14px;"><strong>Put <?php e($hornamearr['Horse']['name']);?> up for sale</strong></p>
							</div>	
							<div class="form_box">
								<label class="formarea"><strong>Contact Details :</strong></label>
								<?php echo $form->textarea('Horsesale.contactdetails',array('rows'=>'4','cols'=>23,"value"=>$salesarr['Horsesale']['contactdetails'])); ?>						
							</div>	
							<div>&nbsp;</div>
							
							<div class="form_box">
								<label class="formarea"><strong>Sales Description :</strong></label>
								<?php echo $form->textarea('Horsesale.salesdescription',array('rows'=>'4','cols'=>23,"value"=>$salesarr['Horsesale']['salesdescription'])); ?>						
							</div>	
							<div>&nbsp;</div>		
							<div class="form_box" style="margin-left: 20px;">
								<label class="formarea"><strong>Price Range From:</strong></label>
								<select name="data[Horsesale][pricerange_fromid]" class="dropdown98" id="pricerangefrom">
									<option value="">Select Price Range </option>
									<?php
									if(is_array($pricerangearr)) {
										if(count($pricerangearr)>0) {
											foreach($pricerangearr as $key=>$val) :
												if($val['Pricerange']['id']==$salesarr['Horsesale']['pricerange_fromid']) {
													$sel='selected=selected';
												}
												else {
													$sel='';
												}
												e("<option value=".$val['Pricerange']['id']." $sel>".$val['Pricerange']['pricefrom']."</option>");									
											endforeach;									
										}								
									}								
									?>							
								</select>								
							</div>
							<div>&nbsp;</div>		
							<div class="form_box" style="margin-left: 20px;">
								<label class="formarea"><strong>Price Range To:</strong></label>
								<select name="data[Horsesale][pricerange_toid]" class="dropdown98" id="pricerange">
									<option value="">Select Price Range </option>
									<?php
									if(is_array($pricerangearr)) {
										if(count($pricerangearr)>0) {
											foreach($pricerangearr as $key=>$val) :
												if($val['Pricerange']['id']==$salesarr['Horsesale']['pricerange_toid']) {
													$sel='selected=selected';
												}
												else {
													$sel='';
												}
												e("<option value=".$val['Pricerange']['id']." $sel>".$val['Pricerange']['pricetoo']."</option>");									
											endforeach;									
										}								
									}								
									?>							
								</select>								
							</div>						
							<div>&nbsp;</div>	
							<input class="submit_btn_other" type="button" value="Submit"  onClick="Chkvalid()"/>
							<input class="submit_btn_other" type="button" value="Back"  onClick="window.history.back();"/>
							<div>&nbsp;</div>
							<div>&nbsp;</div>
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