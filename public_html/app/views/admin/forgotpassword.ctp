<?php e($this->renderElement('header'));?> 
        <table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
        
		<tr>
			<td width="100%" align="center"><div class="login_text" style="width: 300px;font-weight:bold;">			
			 <?php
				if(isset($err)) {
					echo "<br><font color=red>".$err."</font><br>";
				}							  
			?>
			</div></td>
		</tr>
	
		  <tr>
            <td valign="top" align="left" class="box">
			 <form action="" name="frm" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                  
                  <td valign="top" align="left" width="35%" >
				  <?php echo $html->image('icon_login.gif', array('alt'=>'')); ?>
				  <br>
                      <span style="page_heading"><strong><font color="#000000">Welcome to</strong><br>
                    Build a Box<br></span>
                    <br>
                    Enter Your Valid Email Address
					</font>
					</td>
                  <td valign="top" align="left" width="65%"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top" align="left" class="page_heading">Forgot Password</td>
                      </tr>
                      <tr>
                        <td valign="top" align="left" class="dark_box"><table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
                            <tr>
                              <td valign="top" align="left" class="login_text"><strong>Email Address</strong></td>
                            </tr>
                            <tr>
                              <td valign="top" align="left" class="login_text" >
							  
							  <?php echo $form->text('Admin.admin_email',array("class"=>"look","size"=>"30","accesskey"=>"u")); ?>
					 		  <br><span class="error" ><?php echo $form->error('');?></span>
							  
							  </td>
                            </tr>                             
                            <tr>
                              <td valign="top" align="left" height="2"><?php echo $html->image('blank.gif', array('alt'=>'')); ?></td>
                            </tr>
                            <tr>
                              <td valign="top" align="left" class="login_text">
							 <input type="submit" value="Go" name="sub" class="button">&nbsp;&nbsp;
							 <input type="button" class="button" onClick="location.href='<?php echo $html->url('/admin/') ;?>'" value="Back"> 
							 </a>
							  
							  </td>
                            </tr>
                            <tr>
                              <td valign="top" align="left" height="2"><?php echo $html->image('blank.gif', array('alt'=>'')); ?></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
            </table></form></td>
          </tr>
        </table>
<?php e($this->renderElement('footer'));?> 
