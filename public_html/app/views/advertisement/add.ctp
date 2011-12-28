<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add Advertisement </td>
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
			<?php e($form->hidden('Advertisement.posted_date',array("value"=>date('Y-m-d')))); ?>
			<table width="84%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
              <tr class="header_bgcolor" height="26">
                <td colspan="2" class="headertext"><b>&nbsp;Add Advertisement</b></td>
              </tr>
              <tr class="even_tr">
                <td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
              </tr>
              <tr class="even_tr" style="padding:10px;">
                <td width="30%" align="left" valign="top" class="bold_text">Advertisement Name <span class="err">*</span> : </td>
                <td width="70%" align="left" valign="top" class="smalltext"><?php echo $form->text('Advertisement.name',array("class"=>"look","size"=>"30")); ?> <br />
                    <span class="error"><?php echo $form->error('Advertisement.name');?> </span> </td>
              </tr>
              <tr class="even_tr" style="padding:10px;">
                <td width="30%" align="left" valign="top" class="bold_text">Advertisement URL : </td>
                <td width="70%" align="left" valign="top" class="smalltext"><?php echo $form->text('Advertisement.url',array("class"=>"look","size"=>"30")); ?> </td>
              </tr>
              <tr class="even_tr" style="padding:10px;">
                <td width="30%" align="left" valign="top" class="bold_text">Advertisement Shortdescription <span class="err">*</span> : </td>
                <td width="70%" align="left" valign="top" class="smalltext"><?php echo $form->textarea('Advertisement.shortdescription',array("rows"=>"8","cols"=>"55","class"=>"look")); ?> <br />
                    <span class="error"><?php echo $form->error('Advertisement.shortdescription');?> </span> </td>
              </tr>
              <tr class="even_tr" style="padding:10px;">
                <td width="30%" align="left" valign="top" class="bold_text">Advertisement Image  : </td>
                <td width="70%" align="left" valign="top" class="smalltext"><?php e($form->file('Advertisement.image'));?>                </td>
              </tr>
              <tr class="even_tr" style="padding:10px;">
                <td  height="0" align="left" valign="top" class="bold_text">Page : </td>               
                <td height="0" align="left" valign="top" class="smalltext"><select name="data[Advertisement][page][]" multiple="multiple"  style="width:250px; height:100px;">
                    <option value="home">Home Page</option>
                    <option value="content">Content Page</option>
                    <option value="horse">Horse Page</option>
                    <option value="User">User Page</option>
                    <option value="Help">Help Page</option>
					<option value="Stable">Stable Page</option>
                  </select>               
			    </td>
              </tr>
              <tr class="even_tr">
                <td>&nbsp;</td>
                <td align="left" class="bold_text" valign="top"><input name="submit" type="submit" class="button" value="Save" />
                  &nbsp;&nbsp;&nbsp;
                  <input name="button" type="button" class="button" onclick="javascript: location.href='<?php echo $html->url('/Advertisement') ;?>'" value="Cancel" />                </td>
              </tr>
            </table>
			</form>		</td>
	</tr>		
</table>
</td>
</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 
