<?php
e($this->renderelement('topheader'));
?>
</head>
<body>		
	<div id="wrapper_parrent">		
		<?php e($this->renderelement('search'));?>
		<br clear="all" />
		<div id="wrapper">
		<?php
		e($this->renderelement('frontheader'));			
		?>		
		<div class="sub_body">			
				<div class="upper">	
				<div>&nbsp;</div>
					<div style="float: left; width: 762px;">			
					<img class="line" src="<?php e($this->webroot);?>img/line.jpg" alt="" />
					<h1 class="top">Welcome <?php e($userarr['User']['firstname']);?></h1>
						<div class="profile_info">
							<div class="po_inf_up">&nbsp;</div>
							<div class="po_inf_mid">
								<h3>Notifications</h3>
								<ul>
									<li><a href="">Isa Stewart has requested an information change for Takoda.</a></li>
									<li><a href="">Majix Marwari farm has put up 2 horses for sale.</a></li>
									<li><a href="">Kumar has added asire for Majura.</a></li>
									<li><a href="">Seabiscuit’s information has been updated.</a></li>
									<li><a href="">An offspring has been added to Divina</a></li>
								</ul>
							</div>
							<div class="po_inf_btm">&nbsp;</div>						
						</div>	
						<div class="profile_info">
							<div class="po_inf_up">&nbsp;</div>
							<div class="po_inf_mid">
								<h3>What would you like to do ?</h3>
								<ul>
									<li><a href="<?php e($html->url('/horse/mylistedhorse'));?>">View your added Horses</a></li>
									<li><a href="<?php e($html->url('/horse/addhorse'));?>">Add a new Horse</a></li>
									<li><a href="<?php e($html->url('/horse/myhorsesforsale'));?>">Put up a Horse for sale</a></li>
									<li><a href="<?php e($html->url('/horse/myhorsesforstud'));?>">Put up a Horse for stud</a></li>
									<li><a href="<?php e($html->url('/stable/stableprofile'));?>">Create / Edit a breeding farm profile page</a></li>
									<li><a href="<?php e($html->url('/user/userpaiduseaccount'));?>">Edit your personal profile page.</a></li>									
								</ul>
							</div>
							<div class="po_inf_btm">&nbsp;</div>						
						</div>					
					<?php
						e($this->renderElement('rightpanelpremiumfirst'));					
					?>
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>										
			  </div>				
				<div class="bottom"><img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" /></div>
				
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>		
</body>
</html>

