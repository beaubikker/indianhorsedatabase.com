<?php
$searchval='';
if(@$_GET['search']!="") {
	$searchval=@$_GET['search'];
}
if(@$_GET['horsename']!="") {
	$searchval=@$_GET['horsename'];
}
$searchby=@$_GET['searchby'];
?>
<form action="<?php e($html->url('/horse/findahorse'));?>" name="frmsearch" method="get">
		<div class="sign_in_parrent" style="position:absolute; top:50px; left:0; margin-right: 3px; margin-top: 3px;">
				<div class="sign_in" style="top:160px; left:50px; background: #FEEFCD; border: 1px solid #EFBB7A; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
					<div class="mix1"><h3 class="sign_in3">Search</h3></div>
					<div class="mix2"><input class="sign_in1" type="text" id="search" name="search" <?php if(@$_GET['search']!="" || @$_GET['horsename']!="") { ?> value="<?php e($searchval);?>" <?php } else {?> value="Search" onFocus="if(this.value=='Search')this.value='';" onBlur="if(this.value=='')this.value='Search';" <?php } ?>/></div>
					<select name="searchby" id="searchby"  class="dropdown" style="width:auto; float: left;">
							<option value="horse" <?php if($searchby=="horse") { ?> selected="selected" <?php } ?>>Horse</option>
							<option value="stable" <?php if($searchby=="stable") { ?> selected="selected" <?php } ?>>Stable</option>
							<option value="member" <?php if($searchby=="member") { ?> selected="selected" <?php } ?>>Member</option>			
						</select>
						<div class="mix3"><input class="sign_in2" type="button" value="Go"  style="cursor:pointer" onclick="seachhrs()"/></div>					
				</div>							
		</div>		
</form>
<div>&nbsp;</div>
<div>&nbsp;</div>
<script language="javascript">
	function seachhrs() {
		var searchby=document.getElementById("searchby").value;
		var searchname=document.getElementById("search").value;
		window.location.href='<?php e($html->url('/horse/findahorse'));?>&search='+searchname+'&searchby='+searchby;	
	}
</script>