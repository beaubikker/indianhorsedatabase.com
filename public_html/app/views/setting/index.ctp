<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Settings </td>
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
					<td colspan="2" class="headertext"><b>&nbsp;Settings</b></td>
				  </tr>			
				  <?php
					if($session->check('Message.flash')):
						?>
							<tr>
								<td width="100%"  colspan="2" align="center"><div class="messageBox" style="width: 300px;"><?php $session->flash();?></div></td>
							</tr>
						<?php						
					endif;
					?>	  
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Logo <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($settingarr['Setting']['logo']!="") {
							?>
							<img src="<?php e($this->webroot);?>img/settingimages/<?php e($settingarr['Setting']['logo']);?>" width="320"><br><br>
							<?php						
						}						
						?>
						 <?php e($form->file('Setting.logo'));?>
					</td>
				 </tr>		
				 
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Header Image <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php
						if($settingarr['Setting']['headerimage']!="") {
							?>
							<img src="<?php e($this->webroot);?>img/settingimages/<?php e($settingarr['Setting']['headerimage']);?>" width="520"><br><br>
							
							<?php						
						}						
						?>
						 <?php e($form->file('Setting.headerimage'));?>
					</td>
				 </tr>
				
		<tr  class="even_tr" style="padding:10px;">
			<td align="left" valign="top" class="bold_text">Paypal Account ID : <span class="err">*</span></td>
			
			<td  align="left" valign="top" class="smalltext">	
				<?php e($form->text('Setting.paypal_account_id',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['paypal_account_id']))); ?>
			</td>
		</tr>
		<tr  class="even_tr" style="padding:10px;">
			<td align="left" valign="top" class="bold_text">Paypal Payment Mode :</td>			
			<td  align="left" valign="top" class="smalltext">	
				<input type="radio" name="data[Setting][payment_mode]" value="0" <?php if($settingarr['Setting']['payment_mode'] == "0"){ ?> checked="checked" <?php } ?> />&nbsp;&nbsp;Test Mode
				<input type="radio" name="data[Setting][payment_mode]" value="1" <?php if($settingarr['Setting']['payment_mode'] == "1"){ ?> checked="checked" <?php } ?> />&nbsp;&nbsp;Live Mode
			</td>
		</tr>	
		
		<tr  class="even_tr" style="padding:10px;">
			<td align="left" valign="top" class="bold_text">6 Months Price : <span class="err">*</span></td>
			
			<td  align="left" valign="top" class="smalltext" nowrap="nowrap">	
				<?php e($form->text('Setting.6_months_proce',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['6_months_proce']))); ?>$
				&nbsp;&nbsp;
				<?php e($form->text('Setting.6_month_price_rs',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['6_month_price_rs']))); ?> Rs
			</td>
		</tr>
		<tr  class="even_tr" style="padding:10px;">
			<td align="left" valign="top" class="bold_text">1 Year Price : <span class="err">*</span></td>
			
			<td  align="left" valign="top" class="smalltext" nowrap="nowrap">	
				<?php e($form->text('Setting.1_year_price',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['1_year_price']))); ?>$
				&nbsp;&nbsp;
				<?php e($form->text('Setting.1_year_price_rs',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['1_year_price_rs']))); ?> Rs

			</td>
		</tr>
		<tr  class="even_tr" style="padding:10px;">
			<td align="left" valign="top" class="bold_text">1.5 Year Price : <span class="err">*</span></td>
			
			<td  align="left" valign="top" class="smalltext">	
				<?php e($form->text('Setting.1_half_year_price',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['1_half_year_price']))); ?>$
				&nbsp;&nbsp;
				<?php e($form->text('Setting.1and_half_year_price_rs',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['1and_half_year_price_rs']))); ?> Rs
			</td>
		</tr>
		
		<tr  class="even_tr" style="padding:10px;">
			<td align="left" valign="top" class="bold_text">2 Year Price : <span class="err">*</span></td>
			
			<td  align="left" valign="top" class="smalltext">	
				<?php e($form->text('Setting.2_year_price',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['2_year_price']))); ?>$
				&nbsp;&nbsp;
				<?php e($form->text('Setting.2_year_price_price_rs',array("type"=>"text","class"=>"look","size"=>"50","value"=>$settingarr['Setting']['2_year_price_price_rs']))); ?> Rs
			</td>
		</tr>
				 
				 				 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
					</td>
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
