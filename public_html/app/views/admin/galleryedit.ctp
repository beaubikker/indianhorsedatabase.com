<?php e($this->renderElement('header_logon'));?> 
<script language="javascript">
	function mulimage() {
		var imageno=document.getElementById("noofimage").value;
		var i;
		if(parseInt(imageno)) {
			var msg='';
			for(i=1;i<=imageno;i++) {
				msg=msg+'<input type=file name=img_'+i+'>&nbsp;&nbsp;<b>Image Caption<input type=text name=caption_'+i+'><br>';
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
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Edit Gallery</td>
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
					<td colspan="2" class="headertext"><b>&nbsp;Edit Gallery </b></td>
				  </tr>
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Enter Gallery Name <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">						
						 <?php
						 e($edit_arr['Gallery']['galleryname']);
						 ?>
						 </span>
					</td>
				 </tr>				 
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Enter Gallery Description : </td>
					<td width="70%" align="left" valign="top" class="smalltext">					
						<?php echo $form->textarea('Gallery.gallerydesc',array("class"=>"look","rows"=>"15","cols"=>"65","value"=>$edit_arr['Gallery']['gallerydesc'])); ?>
					<br>	
					</td>
				 </tr>	
				 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text" nowrap="nowrap">Gallery Images  : </td>
					<td width="70%" align="left" valign="top" class="smalltext" nowrap="nowrap">
						<?php
						if($imagearr) {							
							if(count($imagearr)>0) {
								$cntr=1;
								e("<br>");
								foreach($imagearr as $key=>$val):
									$imagedirectory="galleryimage";
									$rootdirectory=$this->webroot;
									$target=135;
									$image=$val['Galleryimage']['images'];
									//$img=thumbnail($imagedirectory,$target,$image,$rootdirectory);
									?>
									<?php
									if($val['Galleryimage']['images']!="") {
									?>
									<div style="float:left; width:250px; text-align:center; padding-bottom:10px;" ><img src="<?php e($this->webroot);?>img/galleryimage/<?php e($image);?>" width="120" height="100">
										  <a href="<?php echo $html->url('/admin/deladdimage/'.$imagearr[$key]['Galleryimage']['id'].'/'.$imagearr[$key]['Galleryimage']['images']) ;?>" class="view_link">
											<?php e($html->image('icon_delete.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Delete','title'=>'Delete','class'=>'changeStatus'))); ?>
										  </a>
										  <?php
									  }									  
									  echo "<br />";
									if($val['Galleryimage']['imagecaption']!="") {
									  		echo "<b>Img Caption :</b> ".$val['Galleryimage']['imagecaption']."";;									  
									  }
									  else {
									  	echo "<b>Image Caption :Not Given</b>";	
									  }
									  echo "</div>";
										if($cntr%2==0) {
											e("<br>");
										}
										$cntr++;						
									endforeach ;	
							}
						}					
						?>		
						<br>
						<div style="clear:both; height:20px;"></div>		
						<input type="text" name="galimage"  id="noofimage" size="3"/>
						<input type="button" value="Go" onClick="mulimage()" class="button"/>						
						<div id="gal_image"></div>		
					</td>	
			      </tr> 			 			  			 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/admin/gallery') ;?>'" />					</td>
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
