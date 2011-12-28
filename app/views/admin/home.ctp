<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="bottom" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp;Control Panel</td>
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
		<td valign="top" align="left" width="50%" height="310"> 
			<table width="100%" border="0" cellspacing="15" cellpadding="0">
				<tr>
					<!--<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='#';" onmouseover="javascript: changeIconColor('am');" onmouseout="javascript: restoreIconColor('am');" id="am" width="33%"><?php  e($html->image("img_network_manager.gif"), array('border'=>'0','alt'=>'Account(s)'));?><br>Account(s)</td>-->
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/admin/display') ;?>';" onmouseover="javascript: changeIconColor('cm');" onmouseout="javascript: restoreIconColor('cm');" id="cm" width="34%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'Account Manager'));?><br><font color="#000000">Account Manager</font></td>
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/content/') ;?>';" onmouseover="javascript: changeIconColor('cm1');" onmouseout="javascript: restoreIconColor('cm');" id="cm" width="34%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'Content Manager'));?><br><font color="#000000">Content Manager</font></td>
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/admin/logout') ;?>';" onmouseover="javascript: changeIconColor('logout');" onmouseout="javascript: restoreIconColor('logout');" id="logout" width="33%"><?php  e($html->image("img_logout.gif"), array('border'=>'0','alt'=>'Logout'));?><br><font color="#000000">Logout</font></td>
				</tr>
				
				<tr>
					<!--<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='#';" onmouseover="javascript: changeIconColor('am');" onmouseout="javascript: restoreIconColor('am');" id="am" width="33%"><?php  e($html->image("img_network_manager.gif"), array('border'=>'0','alt'=>'Account(s)'));?><br>Account(s)</td>-->
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/breed/') ;?>';" onmouseover="javascript: changeIconColor('type');" onmouseout="javascript: restoreIconColor('type');" id="type" width="34%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'Breed Manager'));?><br><font color="#000000">Breed</font></td>
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/height/') ;?>';" onmouseover="javascript: changeIconColor('product');" onmouseout="javascript: restoreIconColor('product');" id="product" width="34%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'Height Manager'));?><br><font color="#000000">Height Manager</font></td>
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/coatcolor/') ;?>';" onmouseover="javascript: changeIconColor('logout1');" onmouseout="javascript: restoreIconColor('Newstyype');" id="Newstyype" width="33%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'Newstyype'));?><br><font color="#000000">Coat Color </font></td>
				</tr>
				
				<tr>
					<!--<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='#';" onmouseover="javascript: changeIconColor('am');" onmouseout="javascript: restoreIconColor('am');" id="am" width="33%"><?php  e($html->image("img_network_manager.gif"), array('border'=>'0','alt'=>'Account(s)'));?><br>Account(s)</td>-->
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/horse/') ;?>';" onmouseover="javascript: changeIconColor('news');" onmouseout="javascript: restoreIconColor('news');" id="news" width="34%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'News Manager'));?><br><font color="#000000">Horse Manager</font></td>
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/stable/') ;?>';" onmouseover="javascript: changeIconColor('blog');" onmouseout="javascript: restoreIconColor('blog');" id="blog" width="34%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'Blog Manager'));?><br><font color="#000000">Stable Manager</font></td>
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/user/') ;?>';" onmouseover="javascript: changeIconColor('order');" onmouseout="javascript: restoreIconColor('order');" id="order" width="33%"><?php  e($html->image("img_change_password.gif"), array('border'=>'0','alt'=>'order'));?><br><font color="#000000">User Manager </font></td>
				</tr>				
				<tr>
					<!--<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='#';" onmouseover="javascript: changeIconColor('am');" onmouseout="javascript: restoreIconColor('am');" id="am" width="33%"><?php  e($html->image("img_network_manager.gif"), array('border'=>'0','alt'=>'Account(s)'));?><br>Account(s)</td>-->
					<td valign="top" align="center" class="icon_box" onclick="javascript: location.href='<?php echo $html->url('/content/notification') ;?>';" onmouseover="javascript: changeIconColor('notification');" onmouseout="javascript: restoreIconColor('notification');" id="notification" width="34%"><?php  e($html->image("auto_notification.png"), array('border'=>'0','alt'=>'Send Notification','height'=>60,'width'=>60));?><br><font color="#000000">Send Notification</font></td>
			    </tr>									
			</table>
		</td>
		<td valign="top" align="left" width="50%">
			<table width="100%" border="0" cellspacing="15" cellpadding="0">
				<tr>
					<td class="box_dark"><span class="page_heading_small"><font color="#000000">Currently Logged in Users</font></span><br><br><strong><font color="#000000"><?php e($_SESSION['admin_login_user']);?></font></strong><br><br><font color="#000000">Admin Instruction</font></td>
				</tr>
			</table>
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