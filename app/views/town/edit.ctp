<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Edit town </td>
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
					<td colspan="2" class="headertext"><b>&nbsp;Edit town</b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>	
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select state <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <select name="data[Town][state_id]" class="look">
						 	<option value="">Select state </option>
							<?php
							if(count($state_arr)>0) {
								if(is_array($state_arr)) {
									foreach($state_arr as $key=>$val) :
										if($val['State']['id']==$edit_arr['Town']['state_id']) {
											$sel='selected=selected';
										}	
										else {
											$sel='';
										}
										e("<option value=".$val['State']['id']." $sel>".$val['State']['statename']."</option>");								
									endforeach;								
								}							
							}						
							?> 
						 </select>
					 	 <br><span class="error"><?php echo $form->error('Town.state_id');?>
						 
						 </span>
					</td>
				 </tr>					  			  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Town Name <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Town.town',array("class"=>"look","size"=>"30","value"=>$edit_arr['Town']['town'])); ?>
					 	 <br><span class="error"><?php echo $form->error('Town.town');?>
						 <?php
						 if($duplicateerr>0) {
						 	e("Town already exists");
						 }						 
						 ?>
						 </span>
					</td>
				 </tr>						 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/Town') ;?>'" />					</td>
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
