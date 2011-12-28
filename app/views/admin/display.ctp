<script language="javascript">
function stat_off(id) {

	var div = 'change_status_'+id ;
	new Ajax.Updater(div,'<?php echo $html->url('/admin/change_status/stat_off'); ?>'+'/'+id, {asynchronous:true, evalScripts:true});
}

function stat_on(id) {
	var div = 'change_status_'+id ;
	new Ajax.Updater(div,'<?php echo $html->url('/admin/change_status/stat_on'); ?>'+'/'+id, {asynchronous:true, evalScripts:true});
}
</script>
<?php e($this->renderElement('header_logon'));?> 

<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp;Account Manager Section</td>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" align="left" class="box">
		<!-- content portion start -->
<form action="" method="post" name="frm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%">
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td align="center"><a href="<?php echo $html->url('/admin/add') ;?>" class="action_link"><strong>Add New Administrator</strong></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo $html->url('/admin/change_profile') ;?>" class="action_link"><strong>Update Profile</strong></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo $html->url('/admin/change_pasword') ;?>" class="action_link"><strong>Change Password</strong></a></td>
				</tr>				
					<tr>
						<td align="center">
							<table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" class="header_bordercolor" >
								<tbody>
									<tr class="header_bgcolor" height="26">
										<td width="5%" align="center" class="headertext"></td>
										<td width="" align="center" class="headertext">Administrator's Name</td>
										<td width="20%" align="center" class="headertext">Administrator's Email</td>
										<td width="20%" align="center" class="headertext">Administrator's Status</td>
										<td width="20%" align="center" class="headertext">Action</td>
									</tr>
									<?php 
										$total = 0;
										foreach($arr as $key=>$val):
									?>
										<tr <?php if($total%2 == 0){?>class="even_tr"<?php } else {?>class="odd_tr" <?php  } ?>>
											<td align="center" class="smalltext">
											<!--<input type="checkbox" name="data[Admin][status][<?php echo $key ;?>]" value="<?php echo $val['Admin']['id'] ;?>" id="<?php echo $val['Admin']['id'] ;?>" />-->
											<?php echo $form->checkbox('status_'.$val['Admin']['id'] ,array("class"=>"look","size"=>"30","maxlength"=>"16","value"=>$val['Admin']['id'] ));   ?>									
											
											</td>
											<td align="center" class="smalltext"><?php e(stripslashes($val['Admin']['admin_first_name']));?>&nbsp;<?php e(stripslashes($val['Admin']['admin_middle_name']));?>&nbsp;<?php e(stripslashes($val['Admin']['admin_last_name'])); ?></td>
											<td align="center" class="smalltext"><?php e(stripslashes($val['Admin']['admin_email'])); ?></td>
											<td align="center" class="smalltext">
											<div id="change_status_<?php e($val['Admin']['id']) ?>">
											<?php
											if($val['Admin']['status']==1) {
												 e($html->image('icon_active.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus','onclick'=>'stat_off('.$val['Admin']['id'].')'))); 
											}
											else {
												e($html->image('icon_inactive.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus','onclick'=>'stat_on('.$val['Admin']['id'].')'))); 												
											}												
											?> 
											</div>
											</td>							
											<td align="center" class="bold_text">
											<a href="<?php echo $html->url('/admin/edit/'.$val['Admin']['id']) ;?>" class="view_link"><?php e($html->image('icon_edit.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?></a>
												&nbsp;|&nbsp;
												<a href="#" class="view_link" onclick="javascript: deleteConfirmRecord('<?php echo $html->url('/admin/delete/'.$val['Admin']['id']) ;?>', 'Administrator'); return false;"><?php e($html->image('delete_image.png', array('align'=>'absmiddle','border'=>'0','alt'=>'Delete','title'=>'Delete','class'=>'changeStatus'))); ?></a>
											</td>
										</tr>
										<?php $total++; ?>
										<?php  endforeach;  ?>
								</tbody>
							</table>
							<table width="100%" border="0" cellspacing="1" cellpadding="2" class="">
							
							
							<tr>
								<td >
	    
      <?php  //echo $html->link('Text', array('controller'=>'_controller', 'action'=>'_action', $model['Model']['id']), array('class'=>'_class', 'id'=>'_id')); ?>
								</td>
							</tr>
									<tr>
										<td width="6%" align="center">
                                         <?php
                                         e($html->image('arrow_ltr.png', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); 
										 ?>
                                        </td>
										<td class="smalltext">
											<a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

											<select name="data[Admin][mode]" class="look" onchange="document.frm.submit();" >
												<option value="" selected="selected">With Selected</option>
													<option value="set_active_all">Set Active</option>
													<option value="set_inactive_all">Set Inactive</option>
													<option value="delete_all">Delete All</option>
													
											</select>
                                            
										</td>
									</tr>
									

								</table>
						</td>
					</tr>
			</table>
		</td>
	</tr>		
</table>
</form>
<!-- content portion end -->
		</td>
	</tr>
	<tr>
		<td height="4"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1'));?></td>
	</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 