<script language="javascript">
	function chkalllist() {
		var hiddchkall=document.getElementById("hiddchkall").value;
		hiddchkall=hiddchkall-1;
		var i;
		if(document.getElementById("chkall").checked==true) {
			if(parseInt(hiddchkall)) {
				for(i=1;i<=hiddchkall;i++) {
					document.getElementById("listusr_"+i).checked=true
				}
			}
		}	
		else {
			if(parseInt(hiddchkall)) {
				for(i=1;i<=hiddchkall;i++) {
					document.getElementById("listusr_"+i).checked=false ;
				}
			}
		}  
	}	
	function chkfreelist() {
		var hiddchkall=document.getElementById("chkfreecounter").value;
		hiddchkall=hiddchkall-1;
		var i;
		if(document.getElementById("chkfree").checked==true) {
			if(parseInt(hiddchkall)) {
				for(i=1;i<=hiddchkall;i++) {
					document.getElementById("freechk_"+i).checked=true
				}
			}
		}	
		else {
			if(parseInt(hiddchkall)) {
				for(i=1;i<=hiddchkall;i++) {
					document.getElementById("freechk_"+i).checked=false ;
				}
			}
		}  
	}	
	function chkpaidlist() {	
		var hiddchkall=document.getElementById("chkpaidcntr").value;
		hiddchkall=hiddchkall-1;
		var i;
		if(document.getElementById("paidchk").checked==true) {
			if(parseInt(hiddchkall)) {
				for(i=1;i<=hiddchkall;i++) {
					document.getElementById("chkpaid_"+i).checked=true
				}
			}
		}	
		else {
			if(parseInt(hiddchkall)) {
				for(i=1;i<=hiddchkall;i++) {
					document.getElementById("chkpaid_"+i).checked=false ;
				}
			}
		} 
	}	
</script>
<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Send Notification</td>
			</tr> 
		</table>
	</td>
</tr>
<tr>
	<td valign="top" align="left" class="box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="center">
			<form name="frm" id="event" method="post" action="" enctype="multipart/form-data">	
				<table width="84%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Send Notification </b></td>
				  </tr>
				  <?php
					if($session->check('Message.flash')):
						?>
							<tr>
								<td  colspan="2" align="center"><div class="messageBox" style="width: 300px;"><?php $session->flash();?></div></td>
							</tr>
						<?php						
					endif;
					?>
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"></td>
				  </tr>
					 <tr class="even_tr">				
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">&nbsp; </td>
					<td   width="70%" align="left" class="err"></td>
				 </tr> 
				 <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text" width="20%">Lists Of Paid Users: </td>
					<td align="left" valign="top">
					<div style="width:300px; height: 200px; overflow:auto; background-color:#FFFFFF; border: solid 1px #999999;">
					  <br />
						<strong>&nbsp;&nbsp;&nbsp;<font color="#000000"><input type="checkbox" id="paidchk" paidchk="paidchk" onclick="chkpaidlist()" />Check All &nbsp;&nbsp;Paid User List : </font></strong><br />
					  <br />
							<?php
							if(count($userarr)>0) {
								if(is_array($userarr)) {
									$chkpaidcntr=1;
									foreach($userarr as $key=>$val) :
									if($val['User']['usertype']=="P") {
									?>														 
										<input type="checkbox" id="chkpaid_<?php e($chkpaidcntr);?>" name="data[User][]" value="<?php e($val['User']['id']);?>" class="look" />&nbsp;<?php e("<font color=#FF0000>".$val['User']['firstname']."   ".$val['User']['lastname']."(".$val['User']['usertype'].")</font>");?>
										<br />
							<?php
									$chkpaidcntr++;
									}
									endforeach;
								}
							}
							?>	
							<input type="hidden" id="chkpaidcntr" value="<?php e($chkpaidcntr);?>" />				
					</div>						
					</td>
				  </tr>	
				   <tr class="even_tr">				
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">&nbsp; </td>
					<td   width="70%" align="left" class="err"></td>
				 </tr> 	
				  
				  <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text" width="20%">Lists Of Free Users: </td>
					<td align="left" valign="top">
					<div style="width:300px; height: 200px; overflow:auto; background-color:#FFFFFF; border: solid 1px #999999;">
					  <br />
						<strong>&nbsp;&nbsp;&nbsp;<font color="#000000"><input type="checkbox" id="chkfree" value="chkfree" onclick="chkfreelist()" />Check All &nbsp;&nbsp;Free User List : </font></strong><br />
					  <br />
							<?php
							if(count($userarr)>0) {								
								if(is_array($userarr)) {
									$chkfreecounter=1;
									foreach($userarr as $key=>$val) :
									if($val['User']['usertype']=="F") {										
									?>														 
										<input type="checkbox" id="freechk_<?php e($chkfreecounter);?>" name="data[Freeuser][]" value="<?php e($val['User']['id']);?>" class="look" />&nbsp;<?php e("<font color=#FF0000>".$val['User']['firstname']."   ".$val['User']['lastname']."(".$val['User']['usertype'].")</font>");?>
										<br />
							<?php
									$chkfreecounter++;
									}									
									endforeach;
								}
							}
							?>		
							<input type="hidden" id="chkfreecounter" value="<?php e($chkfreecounter);?>" />					
					</div>						
					</td>
				  </tr>
				    <tr class="even_tr">				
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">&nbsp; </td>
					<td   width="70%" align="left" class="err"></td>
				 </tr> 
				  
				  
				  <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text" width="20%">Lists Of All Users: </td>
					<td align="left" valign="top">
					<div style="width:300px; height: 200px; overflow:auto; background-color:#FFFFFF; border: solid 1px #999999;">
					  <br />
						<strong>&nbsp;&nbsp;&nbsp;<font color="#000000"><input type="checkbox" id="chkall" value="chkall" onclick="chkalllist()" />Check All &nbsp;&nbsp;All User List : </font></strong><br />
					  <br />
							<?php
							if(count($userarr)>0) {
								$countlistuser=1;
								if(is_array($userarr)) {
									foreach($userarr as $key=>$val) :
									?>														 
										<input type="checkbox" name="data[Userall][]" value="<?php e($val['User']['id']);?>" class="look"  id="listusr_<?php e($countlistuser);?>"/>&nbsp;<?php e("<font color=#FF0000>".$val['User']['firstname']."   ".$val['User']['lastname']."(".$val['User']['usertype'].")</font>");?>
										<br />
							<?php
									$countlistuser++;
									endforeach;
								}
							}
							?>		
							<input type="hidden" id="hiddchkall" value="<?php e($countlistuser);?>" />			
					</div>						
					</td>
				  </tr>				  		  				 
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Title Of Notification : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Content.title',array("class"=>"look","size"=>"100")); ?>					 	 
					</td>
				 </tr>				 
			
			    <tr class="even_tr" style="padding:10px;">
				<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">Content Of notification </td>
				<td width="70%" align="left" valign="top" class="smalltext">															
					<?php echo $fck->Create('Content/notification',' ','90%','300','Default'); ?>	
					<br>	 <span class="error"><?php echo $form->error('');?></span>						
				 </td>	
			    </tr>
						 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Send Notification" name="sub" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/admin/home') ;?>'" />					</td>
				  </tr>
  			  </table>
			</form>
		</td>
	</tr>		
</table>
</td>
</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 
