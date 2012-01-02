<?php
e($this->renderelement('topheader'));
?>
<?php e($html->css('skin1'));?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#mycarousel').jcarousel();
	});
	$(document).ready(function(){
		$(".viewallbred").click(function(){
			$("#viewallbred").toggle("5000");
		});	
	});	
	$(document).ready(function(){
		$(".bredhorse").click(function(){
			$("#bredhorse").toggle("5000");
		});	
	});
	function offclose1() {
		document.getElementById("viewallbred").style.display="none";
	}	
	function offclose() {
		document.getElementById("bredhorse").style.display="none";
	}
	jQuery(document).ready(function() {
		jQuery('#mycarouse2').jcarousel();
	});
	function imagereplace(image,width,height) {
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/multiplestableimage/"+image+" height="+height+" width="+width+" align=middle style=padding-left:30px>";
	}
	function mainimagereplace(imagedirectory,image,width,height) {
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/"+imagedirectory+"/"+image+" height="+height+" width="+width+"+ align=middle style=padding-left:30px>";
	}
	function showimage(id) {
		document.getElementById("ownerhorse_"+id).style.display="block";
	}
	function noimage(id) {
		document.getElementById("ownerhorse_"+id).style.display="none";
	}
	
	function showbredimage(id) {
		document.getElementById("brehhorse_"+id).style.display="block";	
	}	
	function noshowbredimage(id) {
		document.getElementById("brehhorse_"+id).style.display="none";
	}	
	function del_stable(stable_id) {
		if(stable_id) {
			if(confirm("Are you sure to delete")) {
				window.location.href='<?php e($html->url('/stable/stabledelete/'));?>'+stable_id
			}
		}
	}
</script>
</head>
<body>		
	<div id="wrapper_parrent">
		<div class="sign_in_parrent">
			<?php e($this->renderelement('search'));?>
		</div>
		<br clear="all" />	
		<div id="wrapper">		
		<?php
		e($this->renderelement('frontheader'));			
		?>			
			<div class="sub_body">			
			  <div class="upper">
			  <div>&nbsp;</div>			  	
					<?php
					$chksession=$this->requestaction('/user/chksession');
					if($chksession=="") {
						 e($this->renderElement('rightpanel'));						 
					}
					else {
						$usertype=$this->requestaction('/user/usertype');
						if($usertype=="P") {
							$chklogincounter=$this->requestaction('/user/chklogincounter');
							if($chklogincounter<=0) {
								e($this->renderElement('rightpanelpremiumfirst'));	
							}
							else {
								e($this->renderElement('pemiumuservariouslogin'));	
							}	
						}	
						else {
							e($this->renderElement('rightpanelfreeuser'));
						}					
					}
					?>
								<?php e($this->renderelement('../stable/include-stableprofile'));?>
