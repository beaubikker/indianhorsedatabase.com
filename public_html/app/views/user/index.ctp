<script language="javascript">
function del(id) {
	if(confirm("Are You Sure To Delete ")) {
		window.location.href='<?php  echo $html->url('/User/delete/') ;?>'+id ;
	}
}
</script>
<?php
 e($this->renderElement('header_logon'));
 ?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp; User Manager</td>
					<td></td>
				</tr>
			</table>		
	    </td>
	</tr>
	<tr>
		<td valign="top" align="left" class="box">
        	<form action="" method="post" name="frm">
        	  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td align="center"><a href="<?php echo $html->url('/User/add') ;?>" class="action_link"><strong> Add User </strong></a></td>
                </tr>
					<?php
					if($session->check('Message.flash')):
						?>
							<tr>
								<td width="100%" align="center"><div class="messageBox" style="width: 300px;"><?php $session->flash();?></div></td>
							</tr>
						<?php						
					endif;
					?>                
                <tr>
                  <td align="center">
                      <table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" class="header_bordercolor" >
                        <tbody>
                          <tr class="header_bgcolor" height="26">
                            <td width="3%" align="center" class="headertext">#</td>
                            <td width="" align="center" class="headertext">
							<?php
							 if($orderby=="asc") { ?> 
							 	<a href="<?php e($html->url('/user/index/desc'));?>">User </a>
									<img src="<?php e($this->webroot);?>img/arrow_down.gif" width="9" height="11" alt=""  title="Down"/>
							    <?php
							 }						 
							 elseif($orderby=="desc") { ?> 
							 	<a href="<?php e($html->url('/user/index/asc'));?>">User</a>
								<img src="<?php e($this->webroot);?>img/arrow_up.gif" width="9" height="11" alt=""  title="Up"/>
							 <?php
							 }		
							 else {
							 	?>
							 	<a href="<?php e($html->url('/user/index/asc'));?>">User</a>															
							 <?php
							 }							 					 
							 ?>						
							</td>
							<td width="" align="center" class="headertext">User Type</td>
							<td width="" align="center" class="headertext">Email Address</td>
							 <td width="" align="center" class="headertext">Posted On  </td>
							 <td width="" align="center" class="headertext">
							 	<?php
							 if($orderby=="lastloginasc") { ?> 
							 	<a href="<?php e($html->url('/user/index/lastlogindesc'));?>">Last login </a>
									<img src="<?php e($this->webroot);?>img/arrow_down.gif" width="9" height="11" alt=""  title="Down"/>
							    <?php
							 }						 
							 elseif($orderby=="lastlogindesc") { ?> 
							 	<a href="<?php e($html->url('/user/index/lastloginasc'));?>">Last login</a>
								<img src="<?php e($this->webroot);?>img/arrow_up.gif" width="9" height="11" alt=""  title="Up"/>
							 <?php
							 }		
							 else {
							 	?>
							 	<a href="<?php e($html->url('/user/index/lastloginasc'));?>">Last login</a>															
							 <?php
							 }							 					 
							 ?>							 
							 </td>
							  <td width="4%" align="center" class="headertext">Status</td>
                            <td width="" align="center" class="headertext">Action</td>
                          </tr>
                          <?php 
									if(count($listarr)>0) {
										if(isset($listarr)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($listarr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['User']['firstname']."  ".$val['User']['lastname'] ;?></td>
							 <td align="center" class="smalltext"><?php if($val['User']['usertype']=="P") {  e("paid User"); } if($val['User']['usertype']=="F") {  e("Free User"); } ?></td>
                             <td align="center" class="smalltext"><?php echo $val['User']['email_address'] ;?></td>
							<td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['User']['registered_date'])); ?>                  
							 </td>		
							 <td align="center" class="smalltext">
							 	<?php
								if($val['User']['logoutdate']!="") {
								 	echo date('d/m/Y', strtotime($val['User']['logoutdate'])); 
								}	
								?>                  
							 </td>
							 <td align="center" class="smalltext"><?php
								if($val['User']['login_stat']=="Y") {										   												
									?>
								<a href="<?php e($html->url('/User/stat_off/'.$val['User']['id']));?>">
								<?php
									 e($html->image('icon_active.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Inactive','title'=>'Active','class'=>'changeStatus'))); 									   
									?>
								</a>
								<?php												
								}								
								else {										   												
									?>
									<?php
									$deactivatedoranotarr=$this->requestAction('/user/chkdeactivated/'.$val['User']['id']);
									if(count($deactivatedoranotarr)<=0) {							   												
									?>
										<a href="<?php e($html->url('/User/stat_on/'.$val['User']['id']));?>">
										<?php
											 e($html->image('icon_inactive.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Inactive','title'=>'Inactive','class'=>'changeStatus'))); 									   
											?>
										</a>
										<?php	
										}		
										else {
											e("<span  style='background-color:green'><b>Deactivated due to---</b><br>".$deactivatedoranotarr[0]['Deactivated']['deactivation_reason'].'</span>');
										}																		   
										?>									
									<?php												
									}									   
								?>                            
							</td>					
                            <td align="center" class="smalltext" nowrap="nowrap">
							<a href="<?php echo $html->url('/User/edit/'.$val['User']['id']) ;?>" class="view_link">						 
							 <?php e($html->image('icon_edit.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?>
                              </a> &nbsp;|&nbsp; <a href="javascript:void(0)" class="view_link" onclick="del('<?php echo $val['User']['id'] ;?>')">
                             <?php e($html->image('delete_image.png', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?>
                              </a> 
						    </td>
                          </tr>
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "<div align=center><em><font color=red>No Members Available.</font></em></div>";
							}
							 ?>
							 
							 <tr class="header_bgcolor" height="26">
                            <td align="left" class="smalltext">&nbsp;</td>
                            <td align="left" class="headertext" colspan="8" nowrap="nowrap">
							<?php   echo $this->renderElement('pagination');?>
                           
							 </td>                         
                          </tr>	
                          							 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
        	</form>
		</td>
	</tr>
	<tr>
		<td height="4"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1'));?></td>
	</tr><?php e($this->renderElement('footer_logon'));?>
</table>