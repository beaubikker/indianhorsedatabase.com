<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">	
	function toggleview(id) {
		$("#changeemail_"+id).toggle("slow");
	}
	function assignhidval(id) {
		document.getElementById("hidval").value=id;	
	}
	function changeemailclose(id) {
		document.getElementById("changeemail_"+id).style.display="none";
	}
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery(".content6").hide();
  //toggle the componenet with class msg_body
  jQuery(".heading").click(function()
  {
    jQuery(this).next(".content6").slideToggle(300);
  });
});
</script>
<style type="text/css"> 
.layer1 {
margin: 20px 0;
padding: 0;
width: 760px;
background:#FCE7B9;
border:1px solid #EDB965;
float: left;

}
 
.heading {
margin: 2px;
color: #842400;
padding: 7px 10px;
cursor: pointer;
position: relative;
background-color:#FCD89D;
border-bottom:1px solid #EDB965;
text-transform:uppercase;

}
.content6 {
padding: 5px 10px;

}
p { padding: 5px 0; color:#994F26; }
</style> 
</head>
<body>		
	<div id="wrapper_parrent">		
		<?php e($this->renderelement('search'));?>
		<div id="wrapper">
		<?php
		e($this->renderelement('frontheader'));			
		?>		
		
		<div class="sub_body">			
				<div class="upper">
					<div>&nbsp;</div>
					<!--<h2 class="header2" style="padding: 0;">Help</h2>-->	
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
					<div style="float: left; width: 762px; min-height: 550px;">		
					<h2 class="header2" style="padding: 0;">Help</h2>	
								<div class="layer1"> 
										<?php
										if(count($listarr)>0) {
										foreach($listarr as $key=>$val) :
										?>
										<p class="heading"><?php e($val['Help']['hlpname']);?> </p> 
										<div style="display: block;" class="content6"> 
											<?php e($val['Help']['helptext']);?>
										</div>	
										<?php
										endforeach;
									   }
									   ?>																
								</div>	
								</div>									
								<div style="clear: both; line-height: 0; font-size: 0;"></div>											
				</div>				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>				
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>		
</body>
</html>