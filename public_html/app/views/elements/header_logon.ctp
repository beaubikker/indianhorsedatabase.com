	<head>
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="history" content="">
		<meta name="author" content="Verdana Core, phpdoc.net Inc.">
		<title>Indian Horse Database Admin Section</title>
		<link href="<?=$this->webroot?>js/calendar/calendar-win2k-cold-1.css" rel="stylesheet" type="text/css">
		<?php e($html->css('adminStyle')); 
		?>
		<?php e($javascript->link('adminCommon')); ?>
		<?php //e($javascript->link('colorPicker')); ?>
		<?php e($javascript->link('admin_dropdown_menu')); ?>
		
		<?php e($javascript->link('mm_menu')); ?> 
		<?php //e($javascript->link('admincalendarDateInput')); ?>
		<?php //echo $javascript->link('fckeditor'); ?>
		<?php e($javascript->link('admin')); 
		
			 echo $javascript->link(array('calendar/calendar.js',
            'calendar/lang/calendar-en.js',
            'calendar/calendar-setup.js'
            )); 
   ?>
   
   <script type="text/javascript">
<!--
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 
// -->
</script>
   
   
	</head>
	<body style="background-color: #FFFFFF">		
		<table align="center" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			<!-- Top Part Start -->
			<tr>
				<td valign="top" height="80">
					<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
						<tr>
						   <td height="72" class="header_bg">
						   		<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
									<tr>
										<td width="40%">&nbsp;&nbsp;
										<h2>
											<font color="#FFFFFF">Admin Panel Of Indian Horse Database </font>
										</h2>										
										</td>
										<td width="60%" valign="bottom" align="right">
											<table width="100%" border="0" cellspacing="0" cellpadding="3">
												<tr>
													<td align="right" class="headertext" height="34"><a href="<?php echo $html->url('/admin/home') ;?>" class="top_link">Home</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a href="<?php echo $html->url('/setting/') ;?>" class="top_link">Settings</a><!--&nbsp;&nbsp;||&nbsp;&nbsp;<a href="<?php echo $html->url('/admin/edit') ;?>" class="top_link">Settings</a>-->&nbsp;&nbsp;
													
													||&nbsp;&nbsp;<a href="<?php echo $html->url('/admin/logout') ;?>" class="top_link">Logout</a>&nbsp;</td>
												</tr>
												<tr>
													<td align="right" class="header_welcome_text">Signed in as : <strong><?php e($_SESSION['admin_login_user']);?></strong>&nbsp;</td>
												</tr>
												<tr>
													<td align="right" class="header_welcome_text"><strong>Last logged out on 
													<?php
													$lastlogin=$this->requestAction('/admin/lastlogin');
													e(date('d/m/Y H:i:s', strtotime($lastlogin['adminSession']['admin_last_login']))); ?> 
													</strong>&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
						   </td>
						</tr>
						<tr>
							<td align="left" valign="top" height="8" class="horizontal_line"><?php e($html->image('blank.gif'), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1')); ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left" valign="middle" height="38" class="top_menu_portion" style="float:left">
					<a href="<?php echo $html->url('/admin/display') ;?>" class="menulink" name="link2" id="link2">ACCOUNTS</a>		
					<font color="#000000">|</font><a href="<?php echo $html->url('/content/sitenews') ;?>" class="menulink" name="link2" id="link2">SITE NEWS</a>						
					<font color="#000000">|</font><a href="<?php echo $html->url('/content/') ;?>" class="menulink" name="link2" id="link2">CMS</a>		
					<font color="#000000">|</font><a href="<?php echo $html->url('/membership/') ;?>" class="menulink" name="link2" id="link2">MEMBERSHIP ADVANTAGE</a>		
					<font color="#000000">|</font><a href="<?php echo $html->url('/horse/') ;?>" class="menulink" name="link2" id="link2">HORSE </a>
					<font color="#000000">|</font><a href="<?php echo $html->url('/stable/') ;?>" class="menulink" name="link2" id="link2">STABLE </a>
					<font color="#000000">|</font><a href="<?php echo $html->url('/user/') ;?>" class="menulink" name="link2" id="link2">USER </a>		
					<font color="#000000">|</font><a href="<?php echo $html->url('/country/') ;?>" class="menulink" name="link2" id="link2">COUNTRY </a>
					<font color="#000000">|</font><a href="<?php echo $html->url('/state/') ;?>" class="menulink" name="link2" id="link2">STATE</a>
					<font color="#000000">|</font><a href="<?php echo $html->url('/town/') ;?>" class="menulink" name="link2" id="link2">TOWN/REGION </a>			
					<font color="#000000">|</font><a href="<?php echo $html->url('/pricerange/') ;?>" class="menulink" name="link2" id="link2">PRICE RANGES </a>	
					<font color="#000000">|</font><a href="<?php echo $html->url('/advertisement/') ;?>" class="menulink" name="link2" id="link2">ADVERTISEMENT </a>
					<font color="#000000">|</font><a href="<?php echo $html->url('/help/') ;?>" class="menulink" name="link2" id="link2">HELP </a>
					<font color="#000000">|</font><a href="<?php echo $html->url('/changerequesthorse/') ;?>" class="menulink" name="link2" id="link2">EDIT RQ </a>
					<ul id="sddm">
							<li><a href="javascript:void(0)" onMouseOver="mopen('m1')" onMouseOut="mclosetime()"><font color="#FFFFFF">Horse Criteria</font></a>
								<span id="m1" onMouseOver="mcancelclosetime()" onMouseOut="mclosetime()">
								<a href="<?php echo $html->url('/breed/') ;?>" class="menulink" name="link2" id="link2">BREED</a>
								<a href="<?php echo $html->url('/gender/') ;?>" class="menulink" name="link2" id="link2">GENDER </a>	
								<a href="<?php echo $html->url('/height/') ;?>" class="menulink" name="link2" id="link2">HEIGHT</a>
								<a href="<?php echo $html->url('/coatcolor/') ;?>" class="menulink" name="link2" id="link2">COAT COLOR</a>								
								</span>
							</li>
						</ul>	
				</td>
			</tr>			
			<tr>
				<td valign="top">					