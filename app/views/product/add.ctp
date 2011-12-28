<?php e($this->renderElement('header_logon'));?> 
<script language="javascript">
function moreimg() {
		var hiddval=document.getElementById("hiddval").value;
		hiddval++;
		var i;
		var msg='';
		msg='<br>'
		if(hiddval) {
			for(i=1;i<=hiddval;i++) {
				msg=msg+"<span id=imagsh_"+i+"><input type=file class=button1 name=img_"+i+" class=look id=img_"+i+">&nbsp&nbsp;<input type=button value=Cancel class=button onclick=can('"+i+"') id=can_"+i+" style=cursor:pointer><br></span>";			
			}	
			document.getElementById("imgval").innerHTML=msg;
		}
		document.getElementById("hiddval").value=hiddval;
	}	
	function can(no) {
		if(no) {
			document.getElementById("img_"+no).style.display="none";
			document.getElementById("can_"+no).style.display="none";
			document.getElementById("imagsh_"+no).style.display="none";			
			no--;
			document.getElementById("hiddval").value=no ;
		}
	}
	</script>
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add Product Type </td>
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
			<?php e($form->hidden('Product.posted_date',array("value"=>date('Y-m-d')))); ?>			
				<table width="84%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Add Product Type </b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>		
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product Type <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
							<select name="data[Product][producttype]" class="look">
								<option value="">Select Product Type </option>
								<?php
								if(is_array($prodtypearr)) {
									foreach($prodtypearr as $key=>$val) :
										if($val['Producttype']['id']==$prodtype) {
											$sel="selected=selected";
										}
										else {
											$sel='';
										}
										e("<option value=".$val['Producttype']['id']." $sel>".$val['Producttype']['producttype']."</option>");									
									endforeach;							
								}	
								?>						
							</select>
						  <br><span class="error"><?php echo $form->error('Product.producttype');?>
						 </span>
					</td>
				 </tr>			  			  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Name <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Product.productname',array("class"=>"look","size"=>"60")); ?>
					 	 <br><span class="error"><?php echo $form->error('Product.productname');?>
						 <?php
						 if($duplicateerr>0) {
						 	e("This Product type already exists");
						 }						 
						 ?>
						 </span>
					</td>
				 </tr>				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Price <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Product.price',array("class"=>"look","size"=>"60")); ?>
					 	 <br><span class="error"><?php echo $form->error('Product.price');?>						 
						 </span>
					</td>
				 </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Image <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->file('Product.image',array("class"=>"look")); ?>
						 <input name="button" type="button" class="button" onclick="moreimg()" value="More"/>
               			 <br />
                      <span id="imgval"> </span>
                      <input type="hidden" id="hiddval" value="" name="hiddval" />
					</td>
				 </tr>		
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Dimension <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Product.dimensions',array("class"=>"look","size"=>"60")); ?>
					 	 <br><span class="error"><?php echo $form->error('Product.dimensions');?>						 
						 </span>
					</td>
				 </tr>			
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Length <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Product.length',array("class"=>"look","size"=>"60")); ?>
					 	 <br><span class="error"><?php echo $form->error('Product.length');?>						 
						 </span>
					</td>
				 </tr>	 	
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Width <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Product.width',array("class"=>"look","size"=>"60")); ?>
					 	 <br><span class="error"><?php echo $form->error('Product.width');?>						 
						 </span>
					</td>
				 </tr>
				 
				 	 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Product  Description : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->textarea('Product.productdesc',array("class"=>"look","rows"=>"15","cols"=>65)); ?>
					</td>
				 </tr>		 	    				  			 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/product') ;?>'" />					</td>
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
