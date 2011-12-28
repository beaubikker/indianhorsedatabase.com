<?php e($this->renderElement('header_logon'));?> 
<script language="javascript">
	function mulimage() {
		var imageno=document.getElementById("noofimage").value;
		var i;
		if(parseInt(imageno)) {
			var msg='';
			for(i=1;i<=imageno;i++) {
				msg=msg+'<input type=file name=img_'+i+'><br>';
			}	
			msg=msg+'<br><div align=left><input type=button value=Cancel class=button onclick=can2()></div>';				
			document.getElementById("gal_image").innerHTML=msg;
		}
	}
	function can2() {
		document.getElementById("noofimage").value="";
		document.getElementById("gal_image").innerHTML="";	
	}	
</script>

<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add New Steps</td>
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
					<td colspan="2" class="headertext"><b>&nbsp;Add New Steps </b></td>
				  </tr>
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Enter Step Name <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Stepbystep.stepname',array("class"=>"look","size"=>"30","maxlength"=>"16")); ?>
					 	 <br><span class="error"><?php echo $form->error('');?>
						 <?php
						 if($duplicateerr>0) {
						 	e("Step name exists");
						 }
						 ?>
						 </span>					</td>
				 </tr>				 
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">Step Image  : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<input type="file" name="data[Stepbystep][mainiamge]" class="look">
					</td>	
			      </tr> 	
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">Animated Image  : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<input type="file" name="data[Stepbystep][animated_image]" class="look">
						<br>
						(Please Upload Only Gif image)
						<?php
						 if($animatederr>0) {
						 	e("<br><font color=#FF0000>Upload Only Gif Image</font>");
						 }
						 ?>
						
					</td>	
			      </tr>
				  
				  
				  
				  			 			  			 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/admin/stepbystep') ;?>'" />					</td>
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
