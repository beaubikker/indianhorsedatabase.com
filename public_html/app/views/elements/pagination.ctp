<?php 
if($pagination->setPaging($paging)): 
$prev = $pagination->prevPage('PREV'); 
$next = $pagination->nextPage('NEXT'); 
$pages = $pagination->pageNumbers(" "); 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	  <tr>
		<td width="40%" align="left" ><?php echo $pagination->result();?></td>
		<td width="60%" align="right" class="textblack">
		<?php if($paging['pageCount']>1){echo $prev." &nbsp; ".$pages." &nbsp; ".$next."";}?></td>
	  </tr>
  </table>
  <?php
  endif; 
?> 