<script language="javascript">
function del(id) {
	if(confirm("Are You Sure To Delete ")) {
		window.location.href='<?php  echo $html->url('/admin/stepdelete/') ;?>'+id ;
	}
}

 function viewcomment(event_id) {
 	
 }
</script>
<?php
//if($pagination->setPaging($paging)):
	//$pagetotal=$pagination->result();
//endif;

$pagetotal =1;

?>
<?php e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp; Step By Step Manager </td>
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
                  <td align="center"><a href="<?php echo $html->url('/admin/addstep') ;?>" class="action_link"><strong>Add </strong></a></td>
                </tr>
                <!--<tr>
						<td width="100%" align="center"><div class="messageBox">{$errorMessage}</div></td>
				</tr>-->
                <tr>
                  <td align="center">
                      <table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" class="header_bordercolor" >
                        <tbody>
                          <tr class="header_bgcolor" height="26">
                            <td width="3%" align="center" class="headertext">#</td>
                            <td width="" align="center" class="headertext">Step Name </td>							
                            <td width="" align="center" class="headertext">Action</td>
                          </tr>
                          <?php 
									if(count($listarr)>0) {
										if(isset($listarr)) {
										$a=0;
										$p=1;
										$no =1;
										foreach($listarr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext"><?php echo $no++;?></td>
                            <td align="center" class="smalltext"><?php echo $val['Stepbystep']['stepname'] ;?></td>                           
                            <td align="center" class="smalltext" nowrap="nowrap">
							<a href="<?php echo $html->url('/admin/stepedit/'.$val['Stepbystep']['id']) ;?>" class="view_link">						 
							 <?php e($html->image('icon_edit.gif', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?>
                              </a> &nbsp;|&nbsp; <a href="javascript:void(0)" class="view_link" onClick="del('<?php echo $val['Stepbystep']['id'] ;?>')">
                                <?php e($html->image('delete_image.png', array('align'=>'absmiddle','border'=>'0','alt'=>'Edit','title'=>'Edit','class'=>'changeStatus'))); ?>
                              </a> </td>
                          </tr>
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "<div align=center><em><font color=red>No steps  Avaliable.</font></em></div>";
							}
							 ?>
                          
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