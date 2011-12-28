<?php e($javascript->link('ajax/prototype')); ?>
<script language="javascript">
function del(id) {
	if(confirm("Are You Sure To Delete ")) {
		window.location.href='<?php  echo $html->url('/Changerequesthorse/delete/') ;?>'+id ;
	}
}
function can() {
	document.getElementById("viewinfo").style.display="none";
}
function view_applicants(horse_id,user_id) {
	document.getElementById("viewinfo").style.display="block";
	document.getElementById("disp").innerHTML="<font color=#FF0000>Please Wait........</font>";
	new Ajax.Updater('disp','<?php echo $html->url('/changerequesthorse/viewreason/'); ?>'+'/'+horse_id+'/'+user_id , {asynchronous:true, evalScripts:true});
}
function viewaccpte(id) {
	document.getElementById("aggre_"+id).style.display="block";
}
function canaccpt(id) {
	document.getElementById("aggre_"+id).style.display="none";
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
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp; Change Edit Request </td>
					<td></td>
				</tr>
			</table>		
	    </td>
	</tr>
	<tr>
		<td valign="top" align="left" class="box">
        	<form action="" method="post" name="frm">
        	  <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
							 <td width="" align="center" class="headertext">Horse Name </td>                           
							 <td width="" align="center" class="headertext">Requested By </td>
							 <td width="" align="center" class="headertext">View Details </td>
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
                            <td align="center" class="smalltext">
								<?php
									$horsename=$this->requestAction('/changerequesthorse/horsename/'.$val['Changerequesthorse']['horse_id']);
									e($horsename['Horse']['name']);
								?>							
							</td>							
                            <td align="center" class="smalltext">							 	
								<?php
									$usernamwe=$this->requestAction('/changerequesthorse/username/'.$val['Changerequesthorse']['requestedby_id']);
									e($usernamwe['User']['firstname']."   ".$usernamwe['User']['lastname']);
								?>								                 
							 </td>						 					
                            <td align="center" class="smalltext" nowrap="nowrap">
							<?php
							if($val['Changerequesthorse']['acceptedordeny']=="Y") {
								$horseownerpostion=$this->requestAction('/changerequesthorse/ownerpostion/'.$val['Changerequesthorse']['acceptedbyid']."/".$val['Changerequesthorse']['horse_id']);
							?>
								
							<?php
							}
							else {		
								if($val['Changerequesthorse']['requestedby_id']) {					
									$disagreewithchangearr=$this->requestAction('/changerequesthorse/disgree/'.$val['Changerequesthorse']['id'].'/'.$val['Changerequesthorse']['requestedby_id']);
									if(count($disagreewithchangearr)>0) {
										?>								
											<input type="button" onclick="view_applicants('<?php e($val['Changerequesthorse']['horse_id']);?>','<?php e($val['Changerequesthorse']['requestedby_id']);?>')" value=" <?php e($usernamwe['User']['firstname']."   ".$usernamwe['User']['lastname']) ;?> has Disagree With Change"  class="button"/>
										<?php							
									}
								}
							}
							if($val['Changerequesthorse']['approve_status']=="N") {
							?>
								<a href="<?php echo $html->url('/changerequesthorse/view/'.$val['Changerequesthorse']['id']) ;?>" class="view_link"><?php e($html->image('icon_open.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?>
                              </a>						 
							<?php
							}
							else {
								?>
								<a href="<?php echo $html->url('/changerequesthorse/view/'.$val['Changerequesthorse']['id']) ;?>" class="view_link">View Change
                                </a>	
								<?php
							}
							?>
							  &nbsp;|&nbsp; <a href="javascript:void(0)" class="view_link" onclick="del('<?php echo $val['Changerequesthorse']['id'] ;?>')">
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
								echo "<div align=center><em><font color=red>No Changerequesthorse Content Available.</font></em></div>";
							}
							?>
                          <tr class="header_bgcolor" height="26">
                            <td align="left" class="smalltext">&nbsp;</td>
                            <td align="left" class="headertext" colspan="4" nowrap="nowrap">
							<?php if($pagetotal > '0')  echo $this->renderElement('pagination');?>
                             <?php endif ;?>						 
							 </td>                         
                          </tr>						 
                       </tbody>
                      </table>
                   </td>
                </tr>
              </table>
        	</form>
		</td>
	</tr>
	<tr>
		<td height="4"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1'));?></td>
	</tr><?php e($this->renderElement('footer_logon'));?>
</table>
<span id="viewinfo" style="display:none; position:absolute;left:300px;top:300px; background-color:#FFCC66; width:470px; padding: 15px;" >	
	  		<span id="disp">				
			</span>	 
	  </span>