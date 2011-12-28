<?php e($this->renderElement('header_logon'));?> 
<?php e($javascript->link('jquery-1'));?> 
<?php e($javascript->link('jquery'));?>
<script language="javascript">
	function extend() {
		$("#choosetime").toggle("slow");
	}
</script>
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Edit User </td>
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
					<td colspan="2" class="headertext"><b>&nbsp;Edit User </b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>	
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Usertype <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <select name="data[User][usertype]" class="look">
						 	<option value="">Select Usertype </option>
						 	<option value="P" <?php if($edit_arr['User']['usertype']=="P") { ?> selected="selected" <?php } ?>>Paid </option>
						 	<option value="F" <?php if($edit_arr['User']['usertype']=="F") { ?> selected="selected" <?php } ?>>Free </option>
						 </select>						 
					 	 <br><span class="error"><?php echo $form->error('User.usertype');?>
						  </span>
					</td>
				 </tr>					  	
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Firstname <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('User.firstname',array("class"=>"look","size"=>"30","value"=>$edit_arr['User']['firstname'])); ?>
					 	 <br><span class="error"><?php echo $form->error('User.firstname');?>
						  </span>
					</td>
				 </tr>				  			  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Lastname <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('User.lastname',array("class"=>"look","size"=>"30","value"=>$edit_arr['User']['lastname'])); ?>
					 	 <br><span class="error"><?php echo $form->error('User.lastname');?>
						  </span>
					</td>
				 </tr>	
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Email address <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('User.email_address',array("class"=>"look","size"=>"30","value"=>$edit_arr['User']['email_address'])); ?>
					 	 <br><span class="error"><?php echo $form->error('User.email_address');?>
						  <?php
						 if($duplicateerr>0) {
						 	e("Email address already exists");
						 }						 
						 ?>						 
						  </span>
					</td>
				 </tr>	
				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Password <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->password('User.password',array("class"=>"look","size"=>"30","value"=>base64_decode($edit_arr['User']['password']))); ?><b> (Password: <?php e(base64_decode($edit_arr['User']['password']));?>)</b>
					 	 <br><span class="error"><?php echo $form->error('User.password');?>
						  </span>
						 
						  
					</td>
				 </tr>
				 <?php
				// if($edit_arr['User']['usertype']=="P") {
				 ?>
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Membership Expiration Date <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php 
						if($edit_arr['User']['membership_exipre_date']) {
							e( date('l dS \of F Y', strtotime($edit_arr['User']['membership_exipre_date'])));
						}
						?>
						<input type="button" value="Do you want extent the membership" class="button" onclick="extend()">
						<span id="choosetime" style="display:none">
							<h3>Choose a Time Period:</h3>
							<div>&nbsp;</div>
							<div class="form_box">
								<label class="formarea">Member time period:</label>
								<select name="data[User][expiration_time_periode]" >
								  <option value="6 months" <?php if($edit_arr['User']['expiration_time_periode']=="6 months") { ?> selected="selected" <?php } ?>>6 Months</option>
								  <option value="1 Year" <?php if($edit_arr['User']['expiration_time_periode']=="1 Year") { ?> selected="selected" <?php } ?>>1 Year</option>
								  <option value="1 Year 6 months" <?php if($edit_arr['User']['expiration_time_periode']=="1 Year 6 months") { ?> selected="selected" <?php } ?>>1.5 Years</option>
								  <option value="2 Years" <?php if($edit_arr['User']['expiration_time_periode']=="2 Years") { ?> selected="selected" <?php } ?>>2 Years</option>
								</select>
							</div>	
							<br />
							<span style="padding-top:20px">
								<input type="checkbox" name="data[User][yes]" value="Yes" />&nbsp;Yes	
							</span>						
						</span>			
					</td>
				 </tr>	
				 <?php
				// }
				 ?>		 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Profile   Image: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($edit_arr['User']['image']!="") {
							e("<img src=".$this->webroot."img/profileimage/".$edit_arr['User']['image']." width=160 border=0 class=wrap>");
							e("<br><br>");	
						}						
						?>					
						<?php echo $form->file('User.image',array("class"=>"look")); ?>							 
					</td>
				 </tr>
				 				 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/User') ;?>'" />					</td>
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
