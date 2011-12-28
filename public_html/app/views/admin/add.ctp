<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp;Account Manager Section</td>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" align="left" class="box">
		<!-- content portion start -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="center">
			<form name="user_add_trainer" id="user_add_trainer" method="post" action="">
				
				<?php e($html->text('Admin.post_date',array("type"=>"hidden","value"=>date('Y-m-d',time())))); ?>
				<?php e($html->text('Admin.status',array("type"=>"hidden","value"=>'1'))); ?>
				<?php e($html->text('Admin.post_ip',array("type"=>"hidden","value"=>$_SERVER['REMOTE_ADDR']))); ?>
				
				<table width="60%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Create Profile</b></td>
				  </tr>
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.
					
					<br><span class="error"><?php if(isset($err))echo $err; ?></span>	
					</td>
				  </tr>
				   <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text">Username <span class="err">*</span> : </td>
					<td align="left" valign="top" class="smalltext">
					
					 <?php echo $form->text('Admin.admin_login',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				   
				  <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text">Password  <span class="err">*</span> : </td>
					<td align="left" valign="top" class="err">
						<?php echo $form->password('Admin.admin_pwd',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text">Confirm Password <span class="err">*</span> : </td>
					<td align="left" valign="top" class="err">
						<?php echo $form->password('Admin.newpass1',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text">First Name <span class="err">*</span> : </td>
					<td align="left" valign="top" class="err">
					<?php echo $form->text('Admin.admin_first_name',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				  
				  <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text">Middle Name: </td>
					<td align="left" valign="top" class="err">
					<?php echo $form->text('Admin.admin_middle_name',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				   <tr class="even_tr" style="padding:10px;">
					<td align="left" valign="top" class="bold_text">Last Name <span class="err">*</span> : </td>
					<td align="left" valign="top" class="err">
					<?php echo $form->text('Admin.admin_last_name',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Email Address <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
					<?php echo $form->text('Admin.admin_email',array("class"=>"look","size"=>"30")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				  </tr>
				 
				 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onclick="javascript: location.href='<?php echo $html->url('/admin/display') ;?>'" />
					</td>
				  </tr>
  			  </table>
			</form>
		</td>
	</tr>		
</table>
<!-- content portion end -->
		</td>
	</tr>
	<tr>
		<td height="4"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1'));?></td>
	</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 