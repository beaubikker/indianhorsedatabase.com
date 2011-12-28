<?php
 e($this->renderElement('header_logon'));?> 
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align="left" height="50" class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array("border"=>"0",'alt'=>'','align'=>'absmiddle'))); ?>&nbsp;&nbsp; Site News</td>
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
                  <td align="center"><a href="<?php echo $html->url('/content/Stats') ;?>" class="action_link"><strong> Stats feature.</strong></a></td>
                </tr>				
				<tr>
					<td>&nbsp;</td>
				</tr>
                <tr>
                  <td align="center"><font color="#000000"><strong> Latest Horse </strong></font></td>
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
                            <td width="" align="center" class="headertext">Horse</td>
							<td width="" align="center" class="headertext">Breed Name</td>
							<td width="" align="center" class="headertext">Link </td>
							<td width="" align="center" class="headertext">Owner Name </td>
							 <td width="" align="center" class="headertext">Posted On  </td>							
                          </tr>
                          <?php 
									if(count($latesthorsearr)>0) {
										if(isset($latesthorsearr)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($latesthorsearr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['Horse']['name'] ;?></td>
							<td align="center" class="smalltext">
							<?php 
							$breedname=$html->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
							e($breedname);
							?>
							</td>
							<td align="center" class="smalltext">
								<a href="http://<?php e($_SERVER['HTTP_HOST']);?>/horse/details/<?php e(str_replace(" ", "-",$val['Horse']['name']));?>/<?php e($val['Horse']['id']);?>" target="_blank"><font color="#000000"><?php e($_SERVER['HTTP_HOST']);?>/horse/details/<?php e(str_replace(" ", "-",$val['Horse']['name']));?>/<?php e($val['Horse']['id']);?></font></a>
							</td>
							<td align="center" class="smalltext">
							<?php 
							e($val['Horse']['ownername'])
							?>
							</td>
                            <td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['Horse']['posted_date'])); ?>                  
							 </td>                    
                          </tr> 
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "";
							}
							?>                          					 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
			  <br />
			  <br />
			  
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td align="center"><font color="#000000"><strong> Latest Stable </strong></font></td>
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
                            <td width="" align="center" class="headertext">Stable</td>
							<td width="" align="center" class="headertext">Owner Name</td>
							<td width="" align="center" class="headertext">Link </td>						
							 <td width="" align="center" class="headertext">Posted On  </td>                     
                          </tr>
                          <?php 
									if(count($lateststablearr)>0) {
										if(isset($lateststablearr)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($lateststablearr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['Stable']['stable_name'] ;?></td>
							<td align="center" class="smalltext">
							<?php 
							$breedname=$html->requestAction('/horse/username/'.$val['Stable']['userid']);
							e($breedname);
							?>
							</td>
							<td align="center" class="smalltext">
								<a href="http://<?php e($_SERVER['HTTP_HOST']);?>/<?php e($html->url('/stable/viewprofile/'.$val['Stable']['id']));?>" target="_blank"><font color="#000000"><?php e($_SERVER['HTTP_HOST']);?>/<?php e($html->url('/stable/viewprofile/'.$val['Stable']['id']));?></font></a>
							</td>							
                            <td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['Stable']['posted_date'])); ?>                  
							 </td>                      
                          </tr> 
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "";
							}
							?>
                          					 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
			  <br />
			  <br />
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td align="center"><font color="#000000"><strong> Latest Member </strong></font></td>
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
                            <td width="" align="center" class="headertext">Name</td>
							<td width="" align="center" class="headertext">Email Addess</td>
							<td width="" align="center" class="headertext">Link </td>						
							 <td width="" align="center" class="headertext">Registered On </td>                     
                          </tr>
                          <?php 
									if(count($latestmemberar)>0) {
										if(isset($latestmemberar)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($latestmemberar as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['User']['firstname'] ;?>&nbsp;&nbsp;<?php echo $val['User']['lastname'] ;?></td>
							<td align="center" class="smalltext">
							<?php echo $val['User']['email_address'] ;?>
							</td>
							<td align="center" class="smalltext">
								<a href="http://<?php e($_SERVER['HTTP_HOST']);?>/<?php e($html->url('/user/viewaccount/'.base64_encode($val['User']['id'])));?>" target="_blank"><font color="#000000"><?php e($_SERVER['HTTP_HOST']);?>/<?php e($html->url('/user/viewaccount/'.base64_encode($val['User']['id'])));?></font></a>
							</td>							
                            <td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['User']['registered_date'])); ?>                  
							 </td>                      
                          </tr> 
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "";
							}
							?>
                          					 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
			  <br />
			  <br />
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td align="center"><font color="#000000"><strong> Latest Horse For Sale</strong></font></td>
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
                            <td width="" align="center" class="headertext">Horse</td>
							<td width="" align="center" class="headertext">Breed Name</td>
							<td width="" align="center" class="headertext">Link </td>
							<td width="" align="center" class="headertext">Owner Name </td>
							 <td width="" align="center" class="headertext">Posted On  </td>							
                          </tr>
                          <?php 
									if(count($latesthorsesalearr)>0) {
										if(isset($latesthorsesalearr)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($latesthorsesalearr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['Horse']['name'] ;?></td>
							<td align="center" class="smalltext">
							<?php 
							$breedname=$html->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
							e($breedname);
							?>
							</td>
							<td align="center" class="smalltext">
							<a href="http://<?php e($_SERVER['HTTP_HOST']);?>/horse/details/<?php e(str_replace(" ", "-",$val['Horse']['name']));?>/<?php e($val['Horse']['id']);?>" target="_blank"><font color="#000000"><?php e($_SERVER['HTTP_HOST']);?>/horse/details/<?php e(str_replace(" ", "-",$val['Horse']['name']));?>/<?php e($val['Horse']['id']);?></font></a>
							</td>
							<td align="center" class="smalltext">
							<?php 
							e($val['Horse']['ownername'])
							?>
							</td>
                            <td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['Horse']['posted_date'])); ?>                  
							 </td>                    
                          </tr> 
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "";
							}
							?>
                          					 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
			  <br />
			  <br />
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td align="center"><font color="#000000"><strong> Latest Horse For Stud</strong></font></td>
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
                            <td width="" align="center" class="headertext">Horse</td>
							<td width="" align="center" class="headertext">Breed Name</td>
							<td width="" align="center" class="headertext">Link </td>
							<td width="" align="center" class="headertext">Owner Name </td>
							 <td width="" align="center" class="headertext">Posted On  </td>							
                          </tr>
                          <?php 
									if(count($lateststudarr)>0) {
										if(isset($lateststudarr)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($lateststudarr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['Horse']['name'] ;?></td>
							<td align="center" class="smalltext">
							<?php 
							$breedname=$html->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
							e($breedname);
							?>
							</td>
							<td align="center" class="smalltext">
							<a href="http://<?php e($_SERVER['HTTP_HOST']);?>/horse/details/<?php e(str_replace(" ", "-",$val['Horse']['name']));?>/<?php e($val['Horse']['id']);?>" target="_blank"><font color="#000000"><?php e($_SERVER['HTTP_HOST']);?>/horse/details/<?php e(str_replace(" ", "-",$val['Horse']['name']));?>/<?php e($val['Horse']['id']);?></font></a>
							</td>
							<td align="center" class="smalltext">
							<?php 
							e($val['Horse']['ownername'])
							?>
							</td>
                            <td align="center" class="smalltext">
							 	<?php echo date('d/m/Y', strtotime($val['Horse']['posted_date'])); ?>                  
							 </td>                    
                          </tr> 
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "";
							}
							?>
                          					 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
			  
			  
			  <br />
			  <br />
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td align="center"><font color="#000000"><strong> Lists Of Active User </strong></font></td>
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
                            <td width="" align="center" class="headertext">Name</td>
							<td width="" align="center" class="headertext">Email Addess</td>
							<td width="" align="center" class="headertext">Link </td>						
							 <td width="" align="center" class="headertext">
							 <?php
							 if($orderby=="asc") { ?> 
							 	<a href="<?php e($html->url('/content/sitenews/desc'));?>">Last Login Date </a>
									<img src="<?php e($this->webroot);?>img/arrow_down.gif" width="9" height="11" alt=""  title="Down"/>
							    <?php 
							 }						 
							 elseif($orderby=="desc") { ?> 
							 	<a href="<?php e($html->url('/content/sitenews/asc'));?>">Last Login Date </a>
								<img src="<?php e($this->webroot);?>img/arrow_up.gif" width="9" height="11" alt=""  title="Up"/>
							 <?php
							 }		
							 else {
							 	?>
							 		<a href="<?php e($html->url('/content/sitenews/asc'));?>">Last Login Date </a>	
									<img src="<?php e($this->webroot);?>img/arrow_up.gif" width="9" height="11" alt=""  title="Up"/>							
							 	<?php
							 }							 					 
							 ?>							 
							 </td>                     
                          </tr>
                          <?php 
									if(count($activeuserarr)>0) {
										if(isset($activeuserarr)) {
										$a=0;
										$p=1;
										$no = 1;
										foreach($activeuserarr as $key=>$val):
										 ?>
                          <tr <?php if($a%2==0) { echo "class=even_tr"; } else {  echo "class=odd_tr"; } ?>>
                            <td align="center" class="smalltext">
							<?php echo $no++;?>
							</td>
                            <td align="center" class="smalltext"><?php echo $val['User']['firstname'] ;?>&nbsp;&nbsp;<?php echo $val['User']['lastname'] ;?></td>
							<td align="center" class="smalltext">
							<?php echo $val['User']['email_address'] ;?>
							</td>
							<td align="center" class="smalltext">
								<a href="http://<?php e($_SERVER['HTTP_HOST']);?>/<?php e($html->url('/user/viewaccount/'.base64_encode($val['User']['id'])));?>" target="_blank"><font color="#000000"><?php e($_SERVER['HTTP_HOST']);?>/<?php e($html->url('/user/viewaccount/'.base64_encode($val['User']['id'])));?></font></a>
							</td>							
                            <td align="center" class="smalltext">
							 	<?php 
								if($val['User']['logoutdate']!="") {
									echo date('d/m/Y', strtotime($val['User']['logoutdate'])); 
								}
								?>                  
							 </td>                      
                          </tr> 
                          <?php  
							$a++;
							$p++;
							endforeach; 
							}
							}
							else {
								echo "";
							}
							?>
                          					 
                       </tbody>
                      </table>
                    <!--<table width="96%" border="0" cellspacing="1" cellpadding="2" class="">
                        <tr>
                          <td width="8%" align="center"></td>
                          <td class="smalltext"><a href="#" onclick="checkAll();" class="new_link">Check All</a> / <a href="#" onclick="uncheckAll()" class="new_link">Uncheck All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="data[Event][mode]" class="look" onchange="document.frm.submit();" >
                                <option value="" selected="selected">With Selected</option>
                                <option value="set_active_all">Set Active</option>
                                <option value="set_inactive_all">Set Inactive</option>
                              </select>                          </td>
                        </tr>
                    </table>--></td>
                </tr>
              </table>
			  
			  
			  
			  
        	</form>
		</td>
	</tr>
	<tr>
		<td height="4"><?php  e($html->image("blank.gif"), array('border'=>'0','alt'=>'','width'=>'1','height'=>'1'));?></td>
	</tr><?php e($this->renderElement('footer_logon'));?>
</table>