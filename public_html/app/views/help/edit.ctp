<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Edit Help </td>
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
			<?php e($form->hidden('Help.posted_date',array("value"=>date('Y-m-d')))); ?>			
				<table width="84%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Edit  Help</b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>		
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Help Name  <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						  <?php echo $form->text('Help.hlpname',array("class"=>"look","size"=>"30","value"=>$edit_arr['Help']['hlpname'])); ?>
					 	 <br><span class="error"><?php echo $form->error('Help.hlpname');?></span>					 
						 </span>
					</td>
				 </tr>				  			  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Help Content <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $fck->Create('Help/helptext',$edit_arr['Help']['helptext'],'90%','300','Default'); ?>	
						<br>	 <span class="error"><?php echo $form->error('Help.helptext');?></span>	
					 </span>
					</td>
				 </tr>						 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/help') ;?>'" />					</td>
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
