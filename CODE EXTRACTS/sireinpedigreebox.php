	<?php
									if($horsearr['Horse']['sireunknowoption']!="Y") {
										if($horsearr['Horse']['sire']) {
											if($horsearr['Horse']['sire_id']=="") {
										?>
										
												<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$sirename));?>','<?php e($sireid);?>')"><?php echo $sirename ?><?php echo $sireid ?>
												</p>
										<?php
											}
											else {
												$siredetailsarr=$this->requestAction('/horse/siredetails/'.$horsearr['Horse']['sire_id']);
											?>
												<p class="domen"  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$sirename));?>','<?php e($sireid);?>')"><?php echo $sirename ?>
												</p>
											<?php
											}											
										}
										else {
											?>
											<p class="domen">
												
											</p>
										<?php
										}
									}
									else {
										?>
										<p class="domen">
											<a style="text-decoration:underline; color:#C7AB4C" href ="<?php e($html->url('/horse/addhorse/addasire/'.str_replace(" ", "-",$horsearr['Horse']['name']).'/'.$horsearr['Horse']['id']));?>"><font size="-1">Add this horse </font></a>
										</p>
										<?php
									}
									?>
										