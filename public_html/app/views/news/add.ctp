<?php e($this->renderElement('header_logon'));?> 
<?php echo $javascript->link('fckeditor'); ?>
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add News  </td>
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
			<?php e($form->hidden('News.posteddate',array("value"=>date('Y-m-d')))); ?>			
				<table width="84%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Add News</b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>					  
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">News Type <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <select name="data[News][newstype]" class="look">
						 	<option value="">Select News Type </option>
							<?php
							if(is_array($newstypearr)) {
								foreach($newstypearr as $key=>$val) :
									if($val['Newstype']['id']==$newstype) {
										$sel="selected=selected";
									}
									else {
										$sel='';
									}
									e("<option value=".$val['Newstype']['id']." $sel>".$val['Newstype']['newstype']."</option>");								
								endforeach;						
							}							
							?>				 
						 </select>
					 	 <br><span class="error"><?php echo $form->error('News.newstype');?>
						 
						 </span>
					</td>
				 </tr>				  				  			  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">News Title <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('News.newstitle',array("class"=>"look","size"=>"30")); ?>
					 	 <br><span class="error"><?php echo $form->error('News.newstitle');?>
						 <?php
						 if($duplicateerr>0) {
						 	e("This News already exists");
						 }						 
						 ?>
						 </span>
					</td>
				 </tr>	
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">News Description <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $fck->Create('News/newsdesc',' ','90%','300','Default'); ?>	
					 	 <br><span class="error"><?php echo $form->error('News.newsdesc');?>
						  </span>
					</td>
				 </tr>	
				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">News  Image <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->file('News.image',array("class"=>"look")); ?>						 
					</td>
				 </tr>				 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/news') ;?>'" />					</td>
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
