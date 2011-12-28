<!-- REYENG HAS BEEN HERE :) -->

<?php
e($this->renderelement('topheader'));
//e($javascript->link('main'));?>
<?php e($html->css('skin1'));?>
<script language="javascript">
	function details(hornamename,horseid) {
		if(parseInt(horseid)) {
			window.location.href='<?php e($html->url('/horse/details/'));?>'+hornamename+'/'+horseid ;		
		}
	}
	$(document).ready(function(){
			$(".offsping").click(function(){
				$("#offsping").toggle("5000");
				document.getElementById("siblings").style.display="none";
			});	
		});		
		$(document).ready(function(){
			$(".siblings").click(function(){
				$("#siblings").toggle("5000");
				document.getElementById("offsping").style.display="none";
			});	 
		});
		
		function offspringshow() {
			$("#offsping").toggle("5000");
			document.getElementById("siblings").style.display="none";
		}
		
		function siblingshow() {
			$("#siblings").toggle("5000");
			document.getElementById("offsping").style.display="none";
		}
			
	function offclose() {
		document.getElementById("offsping").style.display="none";
	}	
	function sibclose() {
		document.getElementById("siblings").style.display="none";
	}	
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});
</script>
<script language="javascript">
	function gajimage() {
		document.getElementById("smaallimage").style.display="block";
	}
	function notimage() {
		document.getElementById("smaallimage").style.display="none";
	}	
	function damimage() {
		document.getElementById("smaallimagefordam").style.display="block";
	}
	function notimagefordam() {
		document.getElementById("smaallimagefordam").style.display="none"; 
	}	
	function imagereplace(image,width,height) {
		var imagedirectory="horseadditionalimage";
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/"+imagedirectory+"/"+image+" height="+height+" width="+width+"+ align=middle>";
	}	
	function mainimagereplace(imagedirectory,image,width,height) {
		document.getElementById("mainimage").innerHTML="<img src=<?php e($this->webroot);?>img/"+imagedirectory+"/"+image+" height="+height+" width="+width+"+ align=middle>";
	}	
	function listfirstsirehorseinfo() {
		document.getElementById("smaallimageforfirstsire").style.display="block";
	}	
	function notimageforfirstsire() {
		document.getElementById("smaallimageforfirstsire").style.display="none";
	}
	function listfirstdamhorseinfo() {	
		document.getElementById("smaallimageforfirstdam").style.display="block";		
	}
	function notimageforfirstdam() {
		document.getElementById("smaallimageforfirstdam").style.display="none";		
	}
	function displaysecondsire() {
		document.getElementById("smaallimageforsecondsire").style.display="block";
	}
	function notdisplaysecondsire() {
		document.getElementById("smaallimageforsecondsire").style.display="none";
	}
	function listfrstsireinfo() {
		document.getElementById("smaallimageforsecondsireview").style.display="block";		
	}
	function notlistfrstsireinfo() {
		document.getElementById("smaallimageforsecondsireview").style.display="none";
	}
	function thirddaminfo() {
		document.getElementById("smaallimageforthirdsireview").style.display="block";
	}	
	function notthirddaminfo() {
		document.getElementById("smaallimageforthirdsireview").style.display="none";
	}
	function displaysecondsirethird() {	
		document.getElementById("smaallimageforthirdsireviewthird").style.display="block";
	}
	function notdisplaysecondsirethird() {	
		document.getElementById("smaallimageforthirdsireviewthird").style.display="none";
	}	
	function firsthirerchysiredamfirst() {
		document.getElementById("hirerchyfirst").style.display="block";
	}	
	function notfirsthirerchysiredamfirst() {
		document.getElementById("hirerchyfirst").style.display="none";
	}	
	function firsthirerchysiredamsecond() {	
		document.getElementById("hirerchysecond").style.display="block";		
	}	
	function notfirsthirerchysiredamsecond() {	
		document.getElementById("hirerchysecond").style.display="none";		
	}
	function firsthirerchysiredamthird() {
		document.getElementById("hirerchythird").style.display="block"		
	}
	function notfirsthirerchysiredamthird() {
		document.getElementById("hirerchythird").style.display="none"		
	}
	function firsthirerchysiredamfourth() {
		document.getElementById("hirerchyfourth").style.display="block"	;		
	}
	function notfirsthirerchysiredamfourth() {
		document.getElementById("hirerchyfourth").style.display="none"	;		
	}
	function firsthirerchysiredamfifth() {
		document.getElementById("hirerchyfifth").style.display="block"	;		
	}
	function notfirsthirerchysiredamfifth() {
		document.getElementById("hirerchyfifth").style.display="none"	;		
	}	
	function firsthirerchysiredamsixth() {
		document.getElementById("hirerchysixth").style.display="block"	;		
	}
	function notfirsthirerchysiredamsixth() {
		document.getElementById("hirerchysixth").style.display="none"	;		
	}	
	function firsthirerchysiredamseventh() {
		document.getElementById("hirerchyseventh").style.display="block"	;		
	}
	function notfirsthirerchysiredamseventh() {
		document.getElementById("hirerchyseventh").style.display="none"	;		
	}	
	function firsthirerchysiredameight() {
		document.getElementById("hirerchyeight").style.display="block"	;		
	}
	function notfirsthirerchysiredameight() {
		document.getElementById("hirerchyeight").style.display="none"	;		
	}
	function subscribefornotification(horse_id) {
		if(horse_id) {
			//document.getElementById("subsmsg").innerHTML="";
			document.getElementById("unsub").style.display="block";
			document.getElementById("subs").style.display="none";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=processrequesnoti;
				req.open("GET","<?php echo $html->url('/horse/subscribefornotification/');?>"+horse_id,true);	
				req.send(null);					
			}
		}
	}
	function processrequesnoti() {
		if(req.readyState==4)
		{				
			if(req.status==200)
			{			
				//document.getElementById("subsmsg").innerHTML=req.responseText					
			}
		}
	}
	function unsubsubscribefornotification(horse_id) {
		if(horse_id) {
			//document.getElementById("subsmsg").innerHTML="";			
			document.getElementById("unsub").style.display="none";
			document.getElementById("subs").style.display="block";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=processrequesnoti;
				req.open("GET","<?php echo $html->url('/horse/unsubscribefornotification/');?>"+horse_id,true);	
				req.send(null);					
			}
		}	
	}
	function chkchangerequest(id) {
		if(parseInt(id)) {
			document.getElementById("chkrequestmsg").innerHTML="<br><font color=#FF0000>Checking..........</font><br>";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=chkreq;
				req.open("GET","<?php echo $html->url('/horse/chkrequest/');?>"+id,true);	
				req.send(null);					
			}		
		}
	}	
	function chkreq() {
		if(req.readyState==4)
		{				
			if(req.status==200)
			{			
				if(req.responseText=="1") {
					document.getElementById("chkrequestmsg").innerHTML="<font color=#FF0000>You have already Requested</font><br>";
				}	
				else {
					window.location.href='<?php e($html->url('/horse/changerequest/'.$horseid));?>';
				}	
			}
		}
	}
</script>
</head>
<?php
	e($javascript->link('jquery1'));
?>
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
					<div style="float: left; width: 762px;">	
					<h1 class="top"> This horse has been successfully added</h1>
					<h3 class="horse_salehead"><strong><?php e($horsearr['Horse']['name']);?>'s Sire Dam And Stable Information</strong></h3>
					<div class="profile_info">						
					<div class="po_inf_up">&nbsp;</div>
					<div class="po_inf_mid">
						<div class="form_box10" style="float: left; width: 200px;">
							<label><strong>Sire :</strong></label>
									<?php											
											if($horsearr['Horse']['sire']!="") {												
												$sirechk=$this->requestAction('/horse/horselinkinfo/'.$horsearr['Horse']['sire']);
												if(count($sirechk)>0) {
												?>
													<h3 class="toxic1" style="padding:10px 2px;"><?php e($sirechk[0]['Horse']['name']);?></h3>
													<?php
													$imagedirectory="horseimage" ;
													$image=$sirechk[0]['Horse']['image'];
													if($image!="") {
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,60,60);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
														}	
													else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
													<?php
													}			
													?>
													<h4 class="toxic3" style="padding:5px 2px">
														<?php e($breedname=$this->requestaction('/horse/breedname/'.$sirechk[0]['Horse']['breed_id']));?><br /><?php e($sirechk[0]['Horse']['year']);?>
													</h4>
													<p class="toxic4"></p>
												<?php
												}
												else {
													?>
													Sire : <?php e($horsearr['Horse']['sire']);?> is not in the database <a href="<?php e($html->url('/horse/addhorse/horse/'.$horsearr['Horse']['sire']));?>" style="color:#994F26">Add this horse</a>
													<?php
												}
											}
											else {
												e("<div align=left><em>You did not select a sire.</em></div>");
											}
											?>
									
									
									
							<div class="clear"></div>
						</div>	
						<div class="form_box10" style="float: left; width: 200px;">
							<label><strong>Dam :</strong></label>
							<?php
											e($horsearr['Horse']['dam']);
											if($horsearr['Horse']['dam']!="") {
												$damchk=$this->requestAction('/horse/horselinkinfo/'.$horsearr['Horse']['dam']);
												if(count($damchk)>0) {
												?>
													<h3 class="toxic1" style="padding:10px 2px;"><?php e($damchk[0]['Horse']['name']);?></h3>
													<?php
													$image=$damchk[0]['Horse']['image'];
													if($image!="") {
														$imagedirectory="horseimage" ;
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,60,60);
																?>
																<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
																<?php
															}	
														}	
													else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" onClick="details('<?php e(str_replace(" ", "-",$sirechk[0]['Horse']['name']));?>','<?php e($sirechk[0]['Horse']['id']);?>')" style="cursor:pointer">
													<?php
													}			
													?>
													<h4 class="toxic3" style="padding:5px 2px">
														<?php e($breedname=$this->requestaction('/horse/breedname/'.$damchk[0]['Horse']['breed_id']));?><br /><?php e($damchk[0]['Horse']['year']);?>
													</h4>
													<p class="toxic4"></p>
												<?php
												}
												else {
													?>
														Dam : <?php e($horsearr['Horse']['dam']);?> is not in the database <a href="<?php e($html->url('/horse/addhorse/horse/'.$horsearr['Horse']['dam']));?>" style="color:#994F26">Add this horse</a>
													<?php
												}
											}
											else {
												e("<div align=left><em>You did not select a dam.</em></div>");
											}
											?>						
							<div class="clear"></div>
						</div>
						<div class="form_box10" style="float: left; width: 200px;">
							<label><strong>Stable :</strong></label> <?php
											    if($horsearr['Horse']['stable_id']!="") {
												$stablearr=$this->requestAction('/stable/stabledetails/'.$horsearr['Horse']['stable_id']);
												if(count($stablearr)>0) {
												?>
													<h3 class="toxic1" align="left" style="padding:10px 2px;"><?php e($stablearr['Stable']['stable_name']);?></h3>
													<?php
													$stable_image=$stablearr['Stable']['stable_image'];
													if($stable_image!="") {
														$imagedirectory="stable_image" ;
														if(file_exists(rootpth()."/".$imagedirectory."/".$stable_image)) {
																$xy = $rsz->imgResize(rootpth()."stable_image/".$stable_image,60,60);
																?>
																<img src="<?php e($this->webroot);?>img/stable_image/<?php e($stable_image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" >
																<?php
															}	
															else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" >
																<?php
															}	
														}	
													else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="60" height="60" >
													<?php
													}			
													?>													
													<p class="toxic4"></p>
												<?php
												}
												else {
													e("<div align=left><em>No Info</em></div>");
												}
											}
											else {
												?>
												This horse is not listed in a stable listed in the IHD<?php /*?>,  <a href="<?php e($html->url('/stable/create/'))?>" style="color:#994F26">create a stable page</a><?php */?>
												<?php
												
											}
											?>								
							<div class="clear"></div>
						</div>
						<div class="clear"></div>					
					</div>

					<div class="po_inf_btm">&nbsp;</div>						
				</div>
				
<!-- */ code below moved to seperate file (trying to use include tag instead) by reyeng on 27th dec 2011 - and put back as it was unsuccessful :( /* -->
				
					<h1 class="top"><?php e($horsearr['Horse']['name']);?></h1>
					<div class="pannel" style="position: relative;">
					
					
					
<!-- REYENG DEC 27th 2011 - added: display: none; below = this code hides the subscribe buttons -->

<div style="display: none; position: absolute; width: 400px; right: -25px; top: 40px;">
							<?php 
								if(is_numeric($chksession)) {
								if($usertype=="P") {
									if(count($chk_arr)>0) {
								?>	
										<span id="unsub" style="display:block;"><img src="<?php e($this->webroot);?>img/submit_btndn.png" border="0" onClick="unsubsubscribefornotification('<?php e($horseid);?>')" style="cursor:pointer"></span>
										<span id="subs" style="display:none;">
											<img src="<?php e($this->webroot);?>img/submit_btnup.png" border="0" onClick="subscribefornotification('<?php e($horseid);?>')" style="cursor:pointer">
										</span>
									<?php
									}
									else {
									?>
										<span id="unsub" style="display:none;"><img src="<?php e($this->webroot);?>img/submit_btndn.png" border="0" onClick="unsubsubscribefornotification('<?php e($horseid);?>')" style="cursor:pointer"></span>
										<span id="subs" style="display:block;">
											<img src="<?php e($this->webroot);?>img/submit_btnup.png" border="0" onClick="subscribefornotification('<?php e($horseid);?>')" style="cursor:pointer">
										</span>
									<?php
									
									}
								 ?>		

								<?php
								}
								if(count($horseowerarr)<=0) {
								?>
									&nbsp;&nbsp;<img src="<?php e($this->webroot);?>img/edit-horse.png" border="0"   onClick="chkchangerequest('<?php e($horseid);?>')" style="cursor:pointer"/>
									
								<?php
								}
								else {
									if($usertype=="P") {
								?>
										&nbsp;&nbsp;<img src="<?php e($this->webroot);?>img/edit-horse.png" border="0"  onClick="window.location.href='<?php e($html->url('/horse/edithorseinfo/'.$horseid));?>'" style="cursor:pointer"/>
								<?php	
									}
									if($usertype=="F") {
									?>
										&nbsp;&nbsp;<img src="<?php e($this->webroot);?>img/edit-horse.png" border="0"   onClick="window.location.href='<?php e($html->url('/horse/edithorseinfobyfreeuser/'.$horseid));?>'" style="cursor:pointer"/>
									<?php
									}		
								}														
								}
								?>
						</div>		
						<div style="position: absolute; width: 400px; right: -25px; top: 70px;">							
								<?php	
								$mainimage='';						
								if($horsearr['Horse']['image']!="") {
									$imagedirectory="horseimage";
									$mainimage=$horsearr['Horse']['image'] ;
								}
								else {
									if($horseimagearr[0]['Horseimage']['image']) {
										$imagedirectory="horseadditionalimage";
										$mainimage=$horseimagearr[0]['Horseimage']['image'] ;	
									}						
								}
								?>	
								<span id="shmainimage" style="display:none">
									<input  type="button"  value="Back To Main Image" onClick="mainimagereplace('<?php e($imagedirectory);?>','<?php e($image);?>')"  style="background:url(http://indianhorses.india-web-design.com/app/webroot/img/sub_big_btn.png) no-repeat 0 1px; border: medium none; color: #FFFFFF;font-family: verdana; font-size: 14px; font-weight: bold; width:183px; height:25px; text-align:center; cursor:pointer" />
								</span>			
								<div class="pic5" style="margin-top: 0; background: #FEEFCD; text-align: center; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;">
									<div id="mainimage" style="float: none;">
										<?php
										if($mainimage!="") {
											if(file_exists(rootpth()."/".$imagedirectory."/".$mainimage)) {
												$xy = $rsz->imgResize(rootpth().$imagedirectory."/".$mainimage,320,320);
											?>
												<img src="<?php e($this->webroot);?>img/<?php e($imagedirectory);?>/<?php e($mainimage);?>" alt="" width="<?php e($xy[0]) ;?>" height="<?php e($xy[1]) ;?>">
											<?php
											}
										}
										?>										
										
									</div>
								</div>
							<?php
							if(count($horseimagearr)>0) {								
							?>
							<div class="photo" style="width: auto; margin-left: 12px;">
								<ul>
									<div class=" jcarousel-skin-tango">						
									<ul 
									style="overflow: hidden; position: relative; top: 0px; margin: 0px; 
									padding: 0px; left: -255px; width: 750px;" id="mycarousel" 
									class="jcarousel-list jcarousel-list-horizontal">
									 <li jcarouselindex="1" style="float: left; height:150px; list-style: none outside 
									none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 
									jcarousel-item-1-horizontal"> <a href="javascript:void(0)"  onClick="mainimagereplace('<?php e($imagedirectory);?>','<?php e($mainimage);?>','<?php e($xy[0]) ;?>','<?php e($xy[1]) ;?>')" onMouseOver="mainimagereplace('<?php e($imagedirectory);?>','<?php e($mainimage);?>','<?php e($xy[0]) ;?>','<?php e($xy[1]) ;?>')"> 
									<?php
										if($mainimage!="") {
											if(file_exists(rootpth()."/".$imagedirectory."/".$mainimage)) {
												?>
												<img src="<?php e($this->webroot);?>img/<?php e($imagedirectory);?>/<?php e($mainimage);?>" width="77" height="69">
											<?php
											}
										}
										?> </a> 
										</li>									
                          <?php						
						if(is_array($horseimagearr)){ 
							foreach($horseimagearr as $key=>$val) :
							$imagedirectory="horseadditionalimage";
							$image=$val['Horseimage']['image'];
							if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseadditionalimage/".$val['Horseimage']['image'],320,320);
						?>
                          <li jcarouselindex="1" style="float: left; height:120px; list-style: none outside 
						none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 
						jcarousel-item-1-horizontal"> <a href="javascript:void(0)"  onClick="imagereplace('<?php e($image);?>','<?php e($xy[0]) ;?>','<?php e($xy[1]) ;?>')"  onMouseOver="imagereplace('<?php e($image);?>','<?php e($xy[0]) ;?>','<?php e($xy[1]) ;?>')"> <img src="<?php e($this->webroot);?>img/horseadditionalimage/<?php e($image);?>" alt="" width="77" height="69"> </a> </li>
						  <?php
							}
							endforeach;
						}
						?>
                        </ul>
								  </div>								
								</ul>
							</div>	
					   <?php
					   }
					   ?>
						</div>
									
							<div class="line_para">
								<div class="same"><p>Gender</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								$gender=$this->requestAction('/horse/gendername/'.$horsearr['Horse']['gender']);
								e($gender['Gender']['gender']);
								?>
								</div>
							</div>								
							<div class="line_para">
								<div class="same"><p>Breed</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								$breedname=$this->requestAction('/horse/breedname/'.$horsearr['Horse']['breed_id']);
								e($breedname);
								?>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Year</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen"><?php e($horsearr['Horse']['year']);?></p></div>
							</div>
							
							<div class="line_para">
								<div class="same"><p>Deceased</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								if($horsearr['Horse']['yearofdeath']!="") {
									e($horsearr['Horse']['yearofdeath']);
								}
								else  {
									e("NA");
								}
								?></p></div>
							</div>
							<div class="line_para">
								<div class="same"><p style="padding-left: 15px; width: 100px;">Sire</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same" style="position: relative;">
									<?php
									if($horsearr['Horse']['sireunknowoption']!="Y") {
										if($horsearr['Horse']['sire']) {
										?>
											<p class="domen" onMouseMove="gajimage()"  onMouseOut="notimage()" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$horsesirearr[0]['Horse']['name']));?>','<?php e($horsesirearr[0]['Horse']['id']);?>')"><?php e($horsearr['Horse']['sire']);?>
											</p>
										<?php
										}
										else {
											?>
											<p class="domen">
												NA
											</p>
										<?php
										}
									}
									else {
										?>
										<p class="domen">
											<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/addasire/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add This Horse </font></a>
										</p>
										<?php
									}
									?>
								</div>
								<div class="small_box" id="smaallimage" style="position: absolute; left: 200px; top: 210px; display: none;" >
								<?php
								if(count($horsesirearr)>0) {
								?>	
									<h3 class="toxic1"><?php e($horsesirearr[0]['Horse']['name']);?></h3>
										<?php
										$imagedirectory="horseimage";
										$image=$horsesirearr[0]['Horse']['image'] ;
										if($image!="") {
											if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
											?>
												<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
											<?php
											}
											else {
												?>
													<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
												<?php
											}
										}
										else {
											?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
											<?php
										}
										?>			
									<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horsesirearr[0]['Horse']['breed_id']));?><br /><?php e($horsesirearr[0]['Horse']['year']);?></h4>
									<p class="toxic4"></p>			
								<?php
								}
								?>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p style="padding-left: 15px; width: 100px;">Dam</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<?php
								if($horsearr['Horse']['damunknownoption']!="Y") {
									if($horsearr['Horse']['dam']) {
									?>
										<p class="domen" onMouseMove="damimage()"  onMouseOut="notimagefordam()"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$horsedamarr[0]['Horse']['name']));?>','<?php e($horsedamarr[0]['Horse']['id']);?>')">
											<?php
												e($horsearr['Horse']['dam']) ;										
											?>								
										</p>
									<?php
									}
									else {
										?>
										<p class="domen">
											NA
										</p>
										<?php
									}
								}
								else {
									?>
										<p class="domen">
											<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/adddam/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add This Horse</font> </a>
										</p>
										<?php
								}
								?>
								</div>
								<div class="small_boxsire" id="smaallimagefordam" style="position: absolute; left: 200px; top: 253px; display: none;" >
								<?php
								if(count($horsedamarr)>0) {
								?>	
									<h3 class="toxic1"><?php e($horsedamarr[0]['Horse']['name']);?></h3>
										<?php
										$imagedirectory="horseimage";
										$image=$horsedamarr[0]['Horse']['image'] ;
										if($image!="") {
											if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
											?>
												<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
											<?php
											}
											else {
												?>
													<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
												<?php
											}
										}
										else {
											?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
											<?php
										}
										?>			
									<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horsedamarr[0]['Horse']['breed_id']));?><br /><?php e($horsedamarr[0]['Horse']['year']);?></h4>
									<p class="toxic4"></p>			
								<?php
								}
								?>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Height</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen">
										<?php 
										$heightval=$this->requestAction('/horse/heightval/'.$horsearr['Horse']['height_id']);
										e($heightval);
										?>
									</p>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Coat Colour</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen">
								<?php 
								$colorname=$this->requestAction('/horse/coatcolor/'.$horsearr['Horse']['coatcolor_id']);
								e($colorname);
								?>
								</p></div>
							</div>
							<?php
							if($horsearr['Horse']['registered']=='Y') {
							?>
							<div class="line_para">
								<div class="same"><p>Registered</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php 
								if($horsearr['Horse']['registration_code']!="") {
									e($horsearr['Horse']['registration_code']);
								}
								else  {
									e("NA");
								}
								?>
								</p></div>
							</div>
							<?php
							}
							?>					
							<div class="line_para">
								<div class="same"><p>Bloodline</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><p class="domen">
								<?php
								if($horsearr['Horse']['bloodline']!="") {
									e($horsearr['Horse']['bloodline']) ;
								}
								else {
									e("NA");
								}
								?>								
								</p>
								</div>
							</div>
							<div class="line_para">
								<div class="same"><p>Breeder</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen">
									<?php
									if($horsearr['Horse']['breeder_id']!="") {
										$username=$this->requestAction('/horse/findusername/'.$horsearr['Horse']['breeder_id']);
										?>
										<span style="cursor:pointer" onClick="javascript:window.location.href='<?php e($html->url('/user/viewaccount/'.base64_encode($username['User']['id'])));?>'"><?php e($username['User']['firstname']."   ".$username['User']['lastname']);?></span>
										<?php
									}
									if($horsearr['Horse']['breeder_id']=="") {
										if($horsearr['Horse']['breeder']!="") {
											e($horsearr['Horse']['breeder']);
										}
										else {
											e("NA");
										}
									}
									?>								
								</p></div>
							</div>
							<?php
							if(is_numeric($horsearr['Horse']['bred_id'])) {
							?>
							<div class="line_para">
								<div class="same"><p>Born At</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<a href="<?php e($html->url('/stable/viewprofile/'.$horsearr['Horse']['bred_id']));?>" style="text-decoration:none">
									<p class="domen">
										<?php
										$stablenamearr=$this->requestAction('/horse/stablename/'.$horsearr['Horse']['bred_id']);
										?>
										<?php e($stablenamearr['Stable']['stable_name']);?>				
									</p>
									</a>	
								</div>
							</div>
							<?php
							}
							else {
							?>		
							<div class="line_para">
								<div class="same">
								  <p>Born At</p>
								</div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen">
									<?php 
									if($horsearr['Horse']['bred_name']) {
										e($horsearr['Horse']['bred_name']);
										
									}
									else {
										e("");
									}
									?>	
									</p>								
								</div>
							</div>						
							<?php
							}
							?>
							<div class="line_para">
								<div class="same"><p>Owner</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen">
										<?php
										if($horsearr['Horse']['ownerid']!="") {
											$username=$this->requestAction('/horse/findusername/'.$horsearr['Horse']['ownerid']);
											?>
											<span style="cursor:pointer" onClick="javascript:window.location.href='<?php e($html->url('/user/viewaccount/'.base64_encode($username['User']['id'])));?>'"><?php e($username['User']['firstname']."   ".$username['User']['lastname']);?></span>
											<?php
										}
										if($horsearr['Horse']['ownerid']=="") {
											if($horsearr['Horse']['ownername']!="") {
												e($horsearr['Horse']['ownername']);
											}
											else {
												e("NA");
											}
										}
										?>								
									</p>
								</div>
							</div>
							<?php
							if(is_numeric($horsearr['Horse']['stable_id'])) {
							?>
							<div class="line_para">
								<div class="same"><p>Stable</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<a href="<?php e($html->url('/stable/viewprofile/'.$horsearr['Horse']['stable_id']));?>" style="text-decoration:none">
									<p class="domen" style="width: 520px">
										<?php
										$stablenamearr=$this->requestAction('/horse/stablename/'.$horsearr['Horse']['stable_id']);
										?>
										<?php e($stablenamearr['Stable']['stable_name']);?>				
									</p>
									</a>	
								</div>
							</div>
							<?php
							}
							else {
							?>		
							<div class="line_para">
								<div class="same"><p>Stable</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<p class="domen" style="width: 520px">
									<?php 
									if($horsearr['Horse']['stablename']) {
										e($horsearr['Horse']['stablename']);
										
									}
									else {
										e("");
									}
									?>	
									</p>								
								</div>
							</div>							
							<?php
							}
							?>
							<div class="line_para">
								<div class="same"><p>Location</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same"><h4 class="">
								<?php 
											if($horsearr['Horse']['countryid']) {
												$countryname=$this->requestAction('/country/countryname/'.$horsearr['Horse']['countryid']);
												e("".$countryname['Country']['country'].",  ");											
											}
											if($horsearr['Horse']['state_id']) {
												$statename=$this->requestAction('/state/Statename/'.$horsearr['Horse']['state_id']);
												e("".$statename['State']['statename'].",  ");											
											}											
											if($horsearr['Horse']['town_id']) {
												$townname=$this->requestAction('/town/townname/'.$horsearr['Horse']['town_id']);
												e($townname['Town']['town']);											
											}
											
											?>								
								</h4></div>
							</div>
							<!--<?php
							//if(is_numeric($horsearr['Horse']['bred_id'])) {
							?>
							<div class="line_para">
								<div class="same"><p>Bred</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
									<a href="<?php //e($html->url('/stable/viewprofile/'.$horsearr['Horse']['bred_id']));?>" style="text-decoration:none">
									<p class="domen">
										<?php
										//$stablenamearr=$this->requestAction('/horse/stablename/'.$horsearr['Horse']['bred_id']);
										?>
										<?php //e($stablenamearr['Stable']['stable_name']);?>				
									</p>
									</a>	
								</div>
							</div>
							<?php
							//}
							?>-->
							<div class="line_para">
								<div class="same"><p>Prize won</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen">
								<?php
								if($horsearr['Horse']['prize_won']!="") {
									e($horsearr['Horse']['prize_won']) ;
								}
								else {
									e("NA");
								}
								?>								
								</p></div>
							</div>	
							<div class="line_para">
								<div class="same"><p>Other Details</p></div>
								<div class="same"><span class="dot">-</span></div>
								<div class="same">
								<p class="domen" style="width: 520px"><?php e($horsearr['Horse']['other_details']);?></p>
								</div>
							</div>						
						</div>
						
					<div class="pannel0" style="margin-left: 0;">
							 <a linkindex="1" href="#?w=500" rel="offsping" class="poplight" style="text-decoration:none">
								<input  type="button"  value="Offspring"   class="newbutton" />
							</a>
							<a linkindex="1" href="#?w=500" rel="siblings" class="poplight" style="text-decoration:none">
								<input  type="button" value="Siblings"   class="newbutton" />
							</a>									
						</div>	
					<div class="panne25" style="height: 218px;">
									<?php
									if($firsthirerchysiredam[0]['Horse']['sire']!="") {
										$horprifilesire5=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam[0]['Horse']['dam']!="") {
										$horprifilesire6=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam[0]['Horse']['dam']);
									}
									if($firsthirerchysiredam2[0]['Horse']['sire']!="") {
										$horprifilesire7=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam2[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam2[0]['Horse']['dam']!="") {
										//e($firsthirerchysiredam2[0]['Horse']['dam']
										$horprifilesire8=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam2[0]['Horse']['dam']);
									}
									if($firsthirerchysiredam3[0]['Horse']['sire']!="") {
										$horprifilesire9=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam3[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam3[0]['Horse']['dam']!="") {
										$horprifilesire10=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam3[0]['Horse']['dam']);
									}
									if($firsthirerchysiredam4[0]['Horse']['sire']!="") {
										$horprifilesire11=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam4[0]['Horse']['sire']);
									}
									if($firsthirerchysiredam4[0]['Horse']['dam']!="") {
										$horprifilesire12=$this->requestaction('/horse/viewhorseprifile/'.$firsthirerchysiredam4[0]['Horse']['dam']);
									}
									?>
						
						
							<div class="magic21" style="background-color:#feefcd; border-bottom: 1px solid #E7D5A3;"><h3>Pedigree</h3></div>
							<div>
								<div class="poll" style="text-align: center; line-height: 167px; height: 167px;"><h3 style="padding: 0;"><?php e($horsearr['Horse']['name']);?></h3></div>
								<div class="poll1" style="height: 167px;">
									<div class="magic" style="height: 83px; line-height: 83px; text-align: center; color: #CBB056; position: relative;">
										<div>
										  <?php
										  //e($horsearr['Horse']['sire']."test");
										   if($horsearr['Horse']['sire']!="") {
												$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['sire_id']);
												//pr($chksirearr) ;
												$frststendsire=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['sire_id']);
												//pr($chksirearr);
												if(count($chksirearr)>0) {
													?>
										<a href="javascript:void(0)" style="color:#994F26; text-decoration:none" onMouseOver="listfirstsirehorseinfo()" onMouseOut="notimageforfirstsire()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
										<?php
												}	
												else {
													 e($horsearr['Horse']['sire']);
												}
										  }
										  ?>
										</div>
										<div class="small_boxsirefirstsire" id="smaallimageforfirstsire" style="display: none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
								<?php			
								$firstsirenamearr=$this->requestaction('/horse/firsrsirenamelist/'.$horsearr['Horse']['sire']);	
								$firstdamnamearr=$this->requestaction('/horse/firstdamelist/'.$horsearr['Horse']['dam']);
								if(count($chksirearr)>0) {
								?>	
									<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
										<?php
										$imagedirectory="horseimage";
										$image=$chksirearr[0]['Horse']['image'] ;
										if($image!="") {
											if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
											?>
												<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
											<?php
											}
											else {
												?>
													<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
												<?php
											}
										}
										else {
											?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
											<?php
										}
										?>			
									<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?>
									<br />
									<?php e($chksirearr[0]['Horse']['year']);?></div>
									<div class="clear"></div>			
								<?php
								}
								?>
								</div>
									</div>
									
									<div class="magic1" style="height: 83px; line-height: 83px; text-align: center; color: #CBB056; position: relative;">
										<div>
										  <?php
										  if($horsearr['Horse']['dam']!="") {
												$horsedamarr=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['dam_id']);
												$seconddam=$this->requestAction('/horse/showfirsrdam/'.$horsearr['Horse']['dam_id']);
												//pr($chksirearr);
												if(count($horsedamarr)>0) {
													?>
													<a href="javascript:void(0)" style="color:#994F26; text-decoration:none" onMouseOver="listfirstdamhorseinfo()" onMouseOut="notimageforfirstdam()" onClick="details('<?php e(str_replace(" ", "-",$horsedamarr[0]['Horse']['name']));?>','<?php e($horsedamarr[0]['Horse']['id']);?>')"><?php e($horsedamarr[0]['Horse']['name']);?></a>
												<?php
												}	
												else {
													 e($horsearr['Horse']['dam']);
												}
										  }
										  ?>
										  </div>
									  <div class="small_boxsirefirstdam" id="smaallimageforfirstdam" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
										<?php
										if(count($horsedamarr)>0) {
										?>	
											<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($horsedamarr[0]['Horse']['name']);?></div>
												<?php
												$imagedirectory="horseimage";
												$image=$horsedamarr[0]['Horse']['image'] ;
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
													?>
														<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
													<?php
													}
													else {
														?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
													<?php
												}
												?>			
											<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;">
											<?php e($breedname=$this->requestaction('/horse/breedname/'.$horsedamarr[0]['Horse']['breed_id']));?>
											<br />
											<?php e($horsedamarr[0]['Horse']['year']);?></div>
											<div class="clear"></div>			
										<?php
										}
										else {
											e("<div align=center><em>No Info </em></div>");
										}
										?>
										</div>
									</div>
								</div>
								<div class="poll2">
									<?php									
									//if(count($firstsirenamearr)>0) {		
									?>									
										<div class="doom0" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($frststendsire[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['sire_id']);
													$hierchsire=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="listfrstsireinfo()" onMouseOut="notlistfrstsireinfo()" onClick="details('<?php e(str_replace(" ", "-",$firstsirenamearr[0]['Horse']['sire']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($frststendsire[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsirefirst" id="smaallimageforsecondsireview" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
											<?php
											if(count($chksirearr)>0) {
											?>	
												<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
													<?php
													$imagedirectory="horseimage";
													$image=$chksirearr[0]['Horse']['image'] ;
													if($image!="") {
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
															$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
														?>
															<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
														<?php
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
													}
													else {
														?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
														<?php
													}
													?>			
												<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
												<div class="clear"></div>			
											<?php
											}
											else {
												e("<div align=center><em>No Info </em></div>");
											}
											?>
											</div>									
											</div>
											
										<div class="doom1" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>											
											<?php
											  if($frststendsire[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['dam_id']);
													$fifthheirh=$this->requestAction('/horse/showfirsrdam/'.$frststendsire[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="thirddaminfo()" onMouseOut="notthirddaminfo()" onClick="details('<?php e(str_replace(" ", "-",$firstsirenamearr[0]['Horse']['dam']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($frststendsire[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsire" id="smaallimageforthirdsireview" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
										</div>
									<?php										
									//}
									?>
									<?php
									//if(count($firstdamnamearr)>0) {
										$cntr=1;
									?>									
										<div class="doom0" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($seconddam[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['sire_id']);
													$fourthdam=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="displaysecondsire()" onMouseOut="notdisplaysecondsire()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($seconddam[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsirefirst" id="smaallimageforsecondsire" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img  src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
										</div>
										
										<div class="doom1" style="height: 41px; line-height: 41px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($seconddam[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['dam_id']);
													$fourthdam1=$this->requestAction('/horse/showfirsrdam/'.$seconddam[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="displaysecondsirethird()" onMouseOut="notdisplaysecondsirethird()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($seconddam[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_boxsiresecondsire" id="smaallimageforthirdsireviewthird" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
										  </div>
											  
										</div>
									<?php										
									//}
									?>									
								</div>
								<div class="poll3">
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
										<?php
										  if($hierchsire[0]['Horse']['sire']!="") {
												$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$hierchsire[0]['Horse']['sire_id']);
												if(count($chksirearr)>0) {
													?>
													<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamfirst()" onMouseOut="notfirsthirerchysiredamfirst()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
												<?php
												}	
												else {
													 e($chksirearr[0]['Horse']['sire']);
												}
										  }
										  ?>
										  </div>
										  
										  <div class="small_hirerchyfirst" id="hirerchyfirst" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
											<?php
											if(count($chksirearr)>0) {
											?>	
												<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
													<?php
													$imagedirectory="horseimage";
													$image=$chksirearr[0]['Horse']['image'] ;
													if($image!="") {
														if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
															$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
														?>
															<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
														<?php
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
													}
													else {
														?>
															<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
														<?php
													}
													?>			
												<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
												<div class="clear"></div>			
											<?php
											}
											else {
												e("<div align=center><em>No Info </em></div>");
											}
											?>
									  </div>
									</div>
																	
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($hierchsire[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$hierchsire[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamsecond()" onMouseOut="notfirsthirerchysiredamsecond()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($hierchsire[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchysecond" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>																						
											<?php
											  if($fifthheirh[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fifthheirh[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamthird()" onMouseOut="notfirsthirerchysiredamthird()" onClick="details('<?php e(str_replace(" ", "-",$firsthirerchysiredam2[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fifthheirh[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchythird" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>											  
									</div>
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($fifthheirh[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fifthheirh[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamfourth()" onMouseOut="notfirsthirerchysiredamfourth()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['sire']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fifthheirh[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyfourth" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
											<?php
											  if($fourthdam[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamfifth()" onMouseOut="notfirsthirerchysiredamfifth()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	 
													else {
														 e($fourthdam[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyfifth" style="display:none; position: absolute; left: 30px; top: -190px; z-index: 100;" >
												<?php
												
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<br>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
											<div>
											<?php
											  if($fourthdam[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamsixth()" onMouseOut="notfirsthirerchysiredamsixth()" onClick="details('<?php e(str_replace(" ", "-",$firsthirerchysiredam3[0]['Horse']['dam']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fourthdam[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchysixth" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  										
								  </div>
									<div class="doom55" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
										<?php
											 if($fourthdam1[0]['Horse']['sire']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam1[0]['Horse']['sire_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredamseventh()" onMouseOut="notfirsthirerchysiredamseventh()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fourthdam1[0]['Horse']['sire']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyseventh" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>
									<div class="doom50" style="height: 20px; line-height: 20px; text-align: center; color: #CBB056; position: relative;">
										<div>
										<?php
											  if($fourthdam1[0]['Horse']['dam']!="") {
													$chksirearr=$this->requestAction('/horse/showfirsrdam/'.$fourthdam1[0]['Horse']['dam_id']);
													if(count($chksirearr)>0) {
														?>
														<a href="javascript:void(0)" style="color: #CBB056;font-family:verdana;font-size: 12px;" onMouseOver="firsthirerchysiredameight()" onMouseOut="notfirsthirerchysiredameight()" onClick="details('<?php e(str_replace(" ", "-",$chksirearr[0]['Horse']['name']));?>','<?php e($chksirearr[0]['Horse']['id']);?>')"><?php e($chksirearr[0]['Horse']['name']);?></a>
													<?php
													}	
													else {
														 e($fourthdam1[0]['Horse']['dam']);
													}
											  }
											  ?>
											  </div>
											  <div class="small_hirerchyfirst" id="hirerchyeight" style="display:none; position: absolute; left: 30px; top: -160px; z-index: 100;" >
												<?php
												if(count($chksirearr)>0) {
												?>	
													<div style="padding: 0; margin: 0; height: 20px; line-height: 20px; color:#994F26; font-size: 16px; padding: 5px 0;"><?php e($chksirearr[0]['Horse']['name']);?></div>
														<?php
														$imagedirectory="horseimage";
														$image=$chksirearr[0]['Horse']['image'] ;
														if($image!="") {
															if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
																$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
															?>
																<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" style="text-align: center;" ></a>
															<?php
															}
															else {
																?>
																	<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
																<?php
															}
														}
														else {
															?>
																<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" style="text-align: center;">
															<?php
														}
														?>			
													<div style="padding: 0; margin: 0; text-align: center; line-height: 20px; padding: 5px 0;"><?php e($breedname=$this->requestaction('/horse/breedname/'.$chksirearr[0]['Horse']['breed_id']));?><br /><?php e($chksirearr[0]['Horse']['year']);?></div>
													<div class="clear"></div>			
												<?php
												}
												else {
													e("<div align=center><em>No Info </em></div>");
												}
												?>
												</div>
											  
									</div>									
								</div>
							</div>						
						</div>																	
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

	<div class="small_boxsirefirstdam" id="smaallimageforfirstdam" style="display:none" >
			<?php
			if(count($horsedamarr)>0) {
			?>	
				<h3 class="toxic1"><?php e($horsedamarr[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horsedamarr[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horsedamarr[0]['Horse']['breed_id']));?><br /><?php e($horsedamarr[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_boxsiresecondsirefirst" id="smaallimageforsecondsire" style="display:none" >
			<?php
			if(count($horprifilesire1)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire1[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire1[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire1[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire1[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_boxsiresecondsire" id="smaallimageforsecondsireview" style="display:none" >
			<?php
			if(count($horprifilesire2)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire2[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire2[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire2[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire2[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>			
	<div class="small_boxsiresecondsire" id="smaallimageforthirdsireview" style="display:none" >
			<?php
			if(count($horprifilesire3)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire3[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire3[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire3[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire3[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_boxsiresecondsire" id="smaallimageforthirdsireviewthird" style="display:none" >
			<?php
			if(count($horprifilesire4)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire4[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire4[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire4[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire4[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchyfirst" style="display:none" >
			<?php
			if(count($horprifilesire5)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire5[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire5[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire5[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire5[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchysecond" style="display:none" >
			<?php
			if(count($horprifilesire6)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire6[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire6[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire6[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire6[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchythird" style="display:none" >
			<?php
			if(count($horprifilesire7)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire7[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire7[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire7[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire7[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchyfourth" style="display:none" >
			<?php
			if(count($horprifilesire8)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire8[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire8[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire8[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire8[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchyfifth" style="display:none" >
			<?php
			if(count($horprifilesire9)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire9[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire9[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire9[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire9[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchysixth" style="display:none" >
			<?php
			if(count($horprifilesire10)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire10[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire10[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire10[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire10[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchyseventh" style="display:none" >
			<?php
			if(count($horprifilesire11)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire11[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire12[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire11[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire11[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div class="small_hirerchyfirst" id="hirerchyeight" style="display:none" >
			<?php
			if(count($horprifilesire12)>0) {
			?>	
				<h3 class="toxic1"><?php e($horprifilesire12[0]['Horse']['name']);?></h3>
					<?php
					$imagedirectory="horseimage";
					$image=$horprifilesire11[0]['Horse']['image'] ;
					if($image!="") {
						if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$image,78,83);
						?>
							<br>
							<a href="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>"><img   class="toxic2" src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" ></a>
						<?php
						}
						else {
							?>
								<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
							<?php
						}
					}
					else {
						?>
							<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="78" height="83" class="toxic2">
						<?php
					}
					?>			
				<h4 class="toxic3"><?php e($breedname=$this->requestaction('/horse/breedname/'.$horprifilesire12[0]['Horse']['breed_id']));?><br /><?php e($horprifilesire12[0]['Horse']['year']);?></h4>
				<p class="toxic4"></p>			
			<?php
			}
			else {
				e("<div align=center><em>No Info </em></div>");
			}
			?>
			</div>
	<div style="display: none; width: 450px !important; padding-right: 0; margin-top: -160px; margin-left: -290px;" id="offsping" class="popup_block">
			<div style="overflow-y: scroll; overflow-x: hidden; height: 400px;">					
			<h3 class="dilraj" style="border-bottom: 1px solid #666; width: 430px; padding-bottom: 10px;"><?php e($horsearr['Horse']['name']);?> Offspring </h3>			
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>	
				<?php
				if(count($offspingarr)>0) {
				$total = count($offspingarr);
				$cntr=1;
					if(is_array($offspingarr)) {	
					foreach($offspingarr as $key=>$val) :	
					if($val['Horse']['id']!=$horseid) {		
						?>					
						<td style="padding: 10px 0;">
							<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
							<?php
								$imagedirectory="horseimage";						
								$image=$val['Horse']['image'] ;
								if($image!="") {
									if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
										$xy = $rsz->imgResize(rootpth()."horseimage/".$image,187,182);
									?>
										<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
									<?php
									}	
									else {
										?>
											<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
										<?php
									}	
								}	
								else {
								?>
									<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
								<?php
								}			
							?>						
							<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
						</td>
						<?php
						if($cntr%2!=0) {?>
							<td style=" float:left; padding: 10px 0;"></td>
						<?php
						}
						else {
						?>
						<td style=" float:left; padding: 10px 0;"></td>
						<?php
						}
						if($cntr%2==0) {
							e("</tr><tr>");
						}
						?>
						<?php
						$cntr++;
					}
					endforeach;
					}		
				}
				else {
					e("<div align=center><font color=#FF0000><em>There is no offspring of this horse in the IHD </em></font></div>"); 
				}
				?>			
			</table>			
			</div>
		</div>
	<div style="display: none; width: 450px !important; padding-right: 0; margin-top: -160px; margin-left: -290px;" id="siblings" class="popup_block">
		<div style="overflow-y: scroll; overflow-x: hidden; height: 400px;">
		<h3 class="dilraj" style="border-bottom: 1px solid #666; width: 430px; padding-bottom: 10px;"><?php e($horsearr['Horse']['name']);?> Siblings</h3>
		<table style="overflow:hidden"; width="100%" cellpadding="0" cellspacing="0">
				<tr>	
				<?php
				if($horsearr['Horse']['sire']!="" && $horsearr['Horse']['dam']!="") {
				if(count($siblingsarr)>0) {
					$total = count($siblingsarr);
					$cntr=1;
						if(is_array($siblingsarr)) {					
						foreach($siblingsarr as $key=>$val) :	
						if($val['Horse']['id']!=$horseid) {		
							?>					
							<td style="padding: 10px 0;">
								<h3 style="font-family: verdana; font-size: 15px; padding-bottom: 10px;"><?php e($val['Horse']['name']);?></h3>
								<?php
									$imagedirectory="horseimage";						
									$image=$val['Horse']['image'] ;
									if($image!="") {
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."horseimage/".$image,187,182);
										?>
											<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>" align="middle" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
										<?php
										}	
										else {
												?>
													<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
												<?php
											}	
									}	
									else {
									?>
										<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="187" height="182" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')" style="cursor:pointer">
									<?php
									}			
								?>										
								<p style=" padding: 4px 43px;"><?php e($val['Horse']['sire']);?> x <?php e($val['Horse']['dam']);?></p>
							</td>
							<?php
							if($cntr%2!=0) {?>
								<td style=" float:left; padding: 10px 0;"></td>
							<?php
							}
							else {
							?>
							<td style=" float:left; padding: 10px 0;"></td>
							<?php
							}
							if($cntr%2==0) {
								e("</tr><tr>");
							}
							?>
							<?php
							$cntr++;
							}
						endforeach;
						}		
					}
					else {
						e("<div align=center><font color=#FF0000><em>There are no siblings of this horse in the IHD</em></font></div>"); 
					}
				}
				else {
					e("<div align=center><font color=#FF0000><em>There are no siblings of this horse in the IHD</em></font></div>");
				}
				?>			
			</table>
		</div>
	</div>
</body>
</html>
								

