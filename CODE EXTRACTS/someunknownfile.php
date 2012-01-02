<br />
														Year :
														<?php 
														if($val['Horse']['year']) {
														e($val['Horse']['year']);
														}
														else {
														e("NA");
														}									
														?>			
														
														<div style="float: left; width: 240px; margin-left: 25px;">
														<?php 
														if($val['Horse']['countryid']) {
														$countryname=$this->requestAction('/country/countryname/'.$val['Horse']['countryid']);
														e("".$countryname['Country']['country'].",  ");											
														}
														if($val['Horse']['state_id']) {
														$statename=$this->requestAction('/state/Statename/'.$val['Horse']['state_id']);
														e("".$statename['State']['statename'].",  ");											
														}											
														if($val['Horse']['town_id']) {
														$townname=$this->requestAction('/town/townname/'.$val['Horse']['town_id']);
														e($townname['Town']['town']);											
														}											
														?>
														
														
														
														FROM HORSE PROFILE 
														
														
														<?php
														if($horsearr['Horse']['yearofdeath']!="") {
														?>
														<div class="line_para">
															<div class="same"><p>Deceased</p></div>
															<div class="same"><span class="dot">-</span></div>
															<div class="same"><p class="domen">
															<?php 
															if($horsearr['Horse']['yearofdeath']!="") {
																e($horsearr['Horse']['yearofdeath']);
															}
															else  {
																e("");
															}
															?></p></div>
														</div>
														<?php
														}
														?>