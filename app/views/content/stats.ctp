<?php
 e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp; Stats feature</td>
					<td></td>
				</tr>
			</table>		
	    </td>
	</tr>
	<tr>
		<td valign="top" align="left" class="box">
			<form action="" method="post" name="frm">
        	  <table width="54%" border="1" cellspacing="0" cellpadding="2" align="center">			  	
                <tr>
                  <td align="left"><font color="#000000"><strong> <?php e($horsecount);?> total horses in DB </strong></font></td>
                </tr>    
				 <tr>
                  	<td align="left"><font color="#000000"><strong> <?php e($usercount);?> total members in DB </strong></font></td>
                </tr> 
				<tr>
                  	<td align="left"><font color="#000000"><strong> <?php e($premiumarr);?>of total premium members in DB </strong></font></td>
                </tr> 
				<tr>
                  	<td align="left"><font color="#000000"><strong> <?php e($stablecount);?> of total stables in DB </strong></font></td>
                </tr> 
				<tr>
                  	<td align="left"><font color="#000000"><strong> <?php e($noofhorsesalearr);?> of total horses for sale in DB </strong></font></td>
                </tr>	  
				<tr>
                  	<td align="left"><font color="#000000"><strong> <?php e($noofhorsestudarr);?> of total horses for stud in DB </strong></font></td>
                </tr>     
				<tr>
                  	<td align="left"><font color="#000000"><strong> <?php e($lstfivedaysarr);?> of total active member of the last 5 days </strong></font></td>
                </tr>    
              </table>					  
        	</form>
		</td>
	</tr>
	<tr>
		<td height="4"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1'));?></td>
	</tr><?php e($this->renderElement('footer_logon'));?>
</table>