<?php e($this->renderElement('header'));?> 
<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center" >	
	<?php if($error){?>
		<tr>
			<td width="100%" align="center"><div class="messageBox" style="width: 300px;"><?php e("Invalid Username or Password");?></div></td>
		</tr>
	<?php } ?>
	<tr>
		<td valign="top" align="left" class="box">
			<table width="100%" border="0" cellspacing="0" cellpadding="10">
				<tr>
					<td valign="top" align="left" width="35%">
						<?php  e($html->image("icon_login.gif"), array('border'=>'0','alt'=>''));?><br><font color="#000000"><strong>Welcome to</strong><br><br><br>Use a valid username and password to gain access to the administration console.</font>
					</td>
					<td valign="top" align="left" width="65%">
						<form action="" method="post" name="form" autocomplete="off" >
							<input type="hidden" name="mode" value="checkLogin">
							<table width="95%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td valign="top" align="left" style="color:#000000; font-weight:bold" >Indian Horse Database Administrative Section</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td valign="top" align="left" class="dark_box">
										<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
											<tr>
												<td valign="top" align="left" class="login_text"><strong><u>U</u>sername</strong></td>
											</tr>
											<tr>
												<td valign="top" align="left" class="login_text">												
												 <?php echo $form->text('Admin.admin_login',array("class"=>"look","size"=>"30","maxlength"=>"16","accesskey"=>"u")); ?>
					 							 <br><span class="error"><?php echo $form->error('');?></span>												
											</tr>
											<tr>
												<td valign="top" align="left" height="2"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>''));?></td>
											</tr>
											<tr>
												<td valign="top" align="left" class="login_text"><strong><u>P</u>assword</strong></td>
											</tr>
											<tr>
												<td valign="top" align="left" class="login_text">
												
												<?php echo $form->password('Admin.admin_pwd',array("class"=>"look","size"=>"30","maxlength"=>"16","accesskey"=>"p")); ?>
												
												
												 <br><span class="error"><?php echo $form->error('');?></span>
											</tr>
											<tr>
												<td valign="top" align="left" height="2"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>''));?></td>
											</tr>
											<tr>
												<td valign="top" align="left" class="login_text">
												
												<input type="image" src="<?php e ($this->webroot."img/btn_login.gif");?>" alt="Login" border="0" align="absmiddle" />
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="<?php echo $html->url('/admin/forgotpassword') ;?>" class="action_link"><b>Forgot Password?</b></a>
												
												</td>
											</tr>											
										</table>
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
<?php e($this->renderElement('footer'));?> 
