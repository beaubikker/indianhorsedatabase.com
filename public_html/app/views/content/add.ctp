<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add New Content Type</td>
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
			<?php e($html->input('Blog/posted_date',array("type"=>"hidden","value"=>date('Y-m-d',time())))); ?>			
				<table width="84%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Add Content </b></td>
				  </tr>
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>
					 <tr class="even_tr">				
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">&nbsp </td>
					<td   width="70%" align="left" class="err"></td>
				 </tr> 
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text"><?php echo $form->label("Enter page name ");?> <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Content.pagename',array("class"=>"look","size"=>"30")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?></span>
					</td>
				 </tr>				 
			
			    <tr class="even_tr" style="padding:10px;">
				<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap"><?php echo $form->label("Enter page content ");?>  <span class="err">*</span> : </td>
				<td width="70%" align="left" valign="top" class="smalltext">
					
					<span class="error"><?php if(isset($err)){echo $err;}?></span><br>											
					<?php echo $fck->Create('Content/content',' ','90%','300','Default'); ?>	
					<br>	 <span class="error"><?php echo $form->error('');?></span>						
				 </td>	
			    </tr>
						 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/content') ;?>'" />					</td>
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
