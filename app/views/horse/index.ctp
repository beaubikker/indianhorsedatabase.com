<script language="javascript">
function del(id) {
	if(confirm("Are You Sure To Delete ")) {
		window.location.href='<?php  echo $html->url('/horse/delete/') ;?>'+id ;
	}
}
function pagelist() {
	var showval=document.getElementById("showpage").value;
	if(parseInt(showval)) {
		window.location.href='<?php e($html->url('/horse/index/?dipslayperpage='));?>'+showval ;
	}
}
</script>
<?php
 e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp; Horse Manager</td>
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
                  <td align="center"><a href="<?php echo $html->url('/horse/add') ;?>" class="action_link"><strong> Add Horse </strong></a></td>
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
                <!--<tr>
						<td width="100%" align="center"><div class="messageBox">{$errorMessage}</div></td>
				</tr>-->
                <tr>
                  <td align="center"><?php if($pagetotal>'0'): ?>
                      <table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" class="header_bordercolor" >
                        <tbody>
                          <tr class="header_bgcolor" height="26">
                            <td width="3%" align="center" class="headertext">#</td>
                            <td width="" align="center" class="headertext">
							<?php
							 if($orderby=="asc") { ?> 
							 	<a href="<?php e($html->url('/horse/index/desc'));?>">Horse </a>
									<img src="<?php e($this->webroot);?>img/arrow_down.gif" width="9" height="11" alt=""  title="Down"/>
							    <?php
							 }						 
							 elseif($orderby=="desc") { ?> 
							 	<a href="<?php e($html->url('/horse/index/asc'));?>">Horse</a>
								<img src="<?php e($this->webroot);?>img/arrow_up.gif" width="9" height="11" alt=""  title="Up"/>
							 <?php
							 }		
							 else {
							 	?>
							 	<a href="<?php e($html->url('/horse/index/asc'));?>">Horse</a>															
							 <?php
							 }							 					 
							 ?>			
							</td>
							<td width="" align="center" class="headertext">Breed Name</td>
							<td width="" align="center" class="headertext">Added By </td>
							<td width="" align="center" class="headertext">Owner Name </td>
							 <td width="" align="center" class="headertext">Posted On  </td>
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
                            <td align="center" class="smalltext"><?php echo $val['Horse']['name'] ;?></td>
							<td align="center" class="smalltext">
							<?php 
							$breedname=$html->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
							e($breedname);
							?>
							</td>
							<td align="center" class="smalltext">
							<?php 
							$username=$html->requestAction('/horse/username/'.$val['Horse']['addedby']);
							e($username);
							?>
							</td>
							<td align="center" class="smalltext">
							<?php 
							e($val['Horse']['ownername'])
							?>
							</td>
                            <td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['Horse']['posted_date'])); ?>                  
							 </td>		
							 <td align="center" class="smalltext"><?php
								if($val['Horse']['approve_stat']=="Y") {										   												
									?>
								<a href="<?php e($html->url('/Horse/stat_off/'.$val['Horse']['id']));?>">
								<?php
									 e($html->image('icon_active.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Inactive','title'=>'Active','class'=>'changeStatus'))); 									   
									?>
								</a>
								<?php												
								}									   
								?>
								<?php
								if($val['Horse']['approve_stat']=="N") {										   												
									?>
									<a href="<?php e($html->url('/horse/stat_on/'.$val['Horse']['id']));?>">
									<?php
										 e($html->image('icon_inactive.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Inactive','title'=>'Inactive','class'=>'changeStatus'))); 									   
										?>
									</a>
									<?php												
									}									   
								?>                            
							</td>					
                            <td align="center" class="smalltext" nowrap="nowrap">
							<a href="<?php echo $html->url('/horse/edit/'.$val['Horse']['id']) ;?>" class="view_link">						 
							 <?php e($html->image('icon_edit.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?>
                              </a> &nbsp;|&nbsp; <a href="javascript:void(0)" class="view_link" onclick="del('<?php echo $val['Horse']['id'] ;?>')">
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
								echo "<div align=center><em><font color=red>No horse Available.</font></em></div>";
							}
							 ?>
                          <tr class="header_bgcolor" height="26">
                            <td align="left" class="smalltext">&nbsp;</td>
                            <td align="right" class="headertext" colspan="7" nowrap="nowrap">
							<?php
								if(count($listarr1)>$diplay) {
									for($i=1;$i<=ceil(count($listarr1)/$diplay);$i++) {
										if($i==$page) {
											e("<b>".$i."</b>");
										}
										else {
									?>
											<a href="<?php e($html->url('/horse/index/?dipslayperpage='.$diplay.'&page='.$i));?>"><?php e($i);?></a>
									<?php
										}
									}
									?>
															
									<?php							
									
								}					
							?>	
									<select onchange="pagelist()" id="showpage"  name="dipslayperpage" class="look">
										<?php
										for($i=10;$i<=500;$i+=10) {
											if($i==$diplay) {
												$sel='selected=selected';
											}
											else {
												$sel='';
											}
										?>
											<option value="<?php e($i);?>" <?php e($sel);?>><?php e($i);?></option>
										<?php
										}								
										?>	
									</select>						
                             <?php endif ;?> 
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