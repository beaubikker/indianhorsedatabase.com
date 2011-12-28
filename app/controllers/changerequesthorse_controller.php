<?php
ob_start();
class ChangerequesthorseController  extends AppController
{
	var $name		= "Changerequesthorse" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination','Rsz' );
	var $components	= array('Pagination','Upload','Email');	
	var $uses=array('Changerequesthorse','User','Admin','Content','Horse','Stable','Town','Country','State','Changeeditrequestnotification');
	function index()
	{	
		parent::adminlayout(); 
		parent::checkAdminSession();
		$pagetotal=$this->Changerequesthorse->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Changerequesthorse->findAll('','','order by id desc','',''));
		$this->set('listarr1', $this->_paginate_leads('','','order by id desc','','')); 	 //in app/app_controller
	}	
	function _paginate_leads($criteria) {
		//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Changerequesthorse->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}
	function horsename($horse_id=NULL) {
		return $this->Horse->FindByid($horse_id) ;	
	}
	function username($user_id=NULL) {
		return $this->User->FindByid($user_id) ;	
	}
	function view($horse_id=NULL,$id=NULL) {
		parent::adminlayout(); 
		parent::checkAdminSession();
		$Changerequesthorsehorsearr=$this->Changerequesthorse->FindByid($horse_id) ;
		$this->set('Changerequesthorsehorsearr',$Changerequesthorsehorsearr);
		$horsearr=$this->Horse->FindByid($Changerequesthorsehorsearr['Changerequesthorse']['horse_id']) ;
		$this->set('horsearr',$horsearr);
		$add_sql="SELECT  * FROM tbl_horseimages Horseimage WHERE horse_id=".$horse_id ;
		$add_image_arr=$this->Changerequesthorse->query($add_sql) ;
		$this->set('additionalimagearr',$add_image_arr);		
		$add_sql="SELECT  * FROM tbl_horseimages Horseimage WHERE horse_id=".$Changerequesthorsehorsearr['Changerequesthorse']['horse_id'] ;
		$add_image_arr=$this->Changerequesthorse->query($add_sql) ;
		$this->set('additionalimagearr',$add_image_arr);		
		$changeimage_sql="SELECT  * FROM tbl_changerequesthorseimages Horseimage WHERE horse_id=".$Changerequesthorsehorsearr['Changerequesthorse']['horse_id'] ;
		$change_image_ar=$this->Changerequesthorse->query($changeimage_sql) ;
		$this->set('change_image_ar',$change_image_ar);
		$this->set('horse_id',$Changerequesthorsehorsearr['Changerequesthorse']['horse_id']);	
		$this->set('id',$Changerequesthorsehorsearr['Changerequesthorse']['id']);	
		
		$reject_sql="SELECT * FROM tbl_horserequestreject Reject , tbl_users User WHERE Reject.user_id=User.id AND 
					 Reject.requestid=".$horse_id ;
		$reject_arr=$this->Changerequesthorse->query($reject_sql) ;
		$this->set('reject_arr',$reject_arr);
		
		$accept_sql="SELECT * FROM tbl_horseinfoaccept Accept , tbl_users User WHERE Accept.user_id=User.id AND 
					 Accept.request_id=".$horse_id ;
		$accept_arr=$this->Changerequesthorse->query($accept_sql) ;
		$this->set('accept_arr',$accept_arr);	
	}
	function reject($horse_id) {
		$this->Changerequesthorse->id=$horse_id ;
		$this->Changerequesthorse->delete();
		$addimage_del_sql="DELETE FROM tbl_changerequesthorseimages WHERE horse_id=".$horse_id;
		$this->Changerequesthorse->query($addimage_del_sql) ;
		$this->Session->setFlash('Edit Request Successfully rejected.');
		$this->redirect('/changerequesthorse');
	}
	function delete($id=NULL) {
		$this->Changerequesthorse->id=$id ;
		$this->Changerequesthorse->delete();
		$this->Session->setFlash('Edit Request Successfully delete.');
		$this->redirect($this->referer());					
	}
	function approve($id=NULL) {
		$this->Changerequesthorse->id=$id;
		$this->data['Changerequesthorse']['approve_status']='Y';
		$useridarr=$this->Changerequesthorse->FindByid($id);		
		$originahorsearr=$this->Horse->FindByid($useridarr['Changerequesthorse']['horse_id']);		
		$this->data['Changeeditrequestnotification']['horse_id']=$useridarr['Changerequesthorse']['horse_id'];
		$this->data['Changeeditrequestnotification']['notified_date']=date("Y-m-d");
		$this->data['Changeeditrequestnotification']['accept_stat']='N';		
		if($this->Changeeditrequestnotification->save($this->data)) {
			$originalhorsedataarr=$this->Horse->FindByid($useridarr['Changerequesthorse']['horse_id']) ;
			$this->data['Horse']['ownerid']=$useridarr['Changerequesthorse']['ownerid'] ;
			$this->data['Horse']['name']=$useridarr['Changerequesthorse']['name'] ;
			$this->data['Horse']['gender']=$useridarr['Changerequesthorse']['gender'] ;
			$this->data['Horse']['breed_id']=$useridarr['Changerequesthorse']['breed_id'] ;
			$this->data['Horse']['year']=$useridarr['Changerequesthorse']['year'] ;
			$this->data['Horse']['sire']=$useridarr['Changerequesthorse']['sire'] ;
			$this->data['Horse']['dam']=$useridarr['Changerequesthorse']['dam'] ;			
			$this->data['Horse']['sireunknowoption']=$useridarr['Changerequesthorse']['sireunknowoption'] ;
			$this->data['Horse']['damunknownoption']=$useridarr['Changerequesthorse']['damunknownoption'] ;			
			$this->data['Horse']['ownername']=$useridarr['Changerequesthorse']['ownername'] ;
			$this->data['Horse']['height_id']=$useridarr['Changerequesthorse']['height_id'] ;
			$this->data['Horse']['coatcolor_id']=$useridarr['Changerequesthorse']['coatcolor_id'] ;
			$this->data['Horse']['bloodline']=$useridarr['Changerequesthorse']['bloodline'] ;
			$this->data['Horse']['breeder']=$useridarr['Changerequesthorse']['breeder'] ;
			$this->data['Horse']['prize_won']=$useridarr['Changerequesthorse']['prize_won'] ;
			$this->data['Horse']['stablename']=$useridarr['Changerequesthorse']['stablename'] ;
			$this->data['Horse']['breeder_id']=$useridarr['Changerequesthorse']['breeder_id'] ;
			$this->data['Horse']['stable_id']=$useridarr['Changerequesthorse']['stable_id'] ;
			$this->data['Horse']['countryid']=$useridarr['Changerequesthorse']['countryid'] ;
			$this->data['Horse']['state_id']=$useridarr['Changerequesthorse']['state_id'] ;
			$this->data['Horse']['town_id']=$useridarr['Changerequesthorse']['town_id'] ;
			$this->data['Horse']['bred_name']=$useridarr['Changerequesthorse']['bred_name'] ;
			$this->data['Horse']['bred_id']=$useridarr['Changerequesthorse']['bred_id'] ;
			$this->data['Horse']['other_details']=$useridarr['Changerequesthorse']['other_details'] ;
			$this->data['Horse']['utube_link']=$useridarr['Changerequesthorse']['utube_link'] ;
			$this->data['Horse']['image']=$useridarr['Changerequesthorse']['image'] ;
			$this->data['Horse']['video']=$useridarr['Changerequesthorse']['video'] ;
			$this->data['Horse']['sire_id']=$useridarr['Changerequesthorse']['sire_id'] ;	
			$this->data['Horse']['dam_id']=$useridarr['Changerequesthorse']['dam_id'] ;	
			$this->data['Horse']['yearofdeath']=$useridarr['Changerequesthorse']['yearofdeath'] ;	
			$this->data['Horse']['deathstat']=$useridarr['Changerequesthorse']['deathstat'] ;	
			$this->data['Horse']['registration_code']=$useridarr['Changerequesthorse']['registration_code'] ;	
			$this->data['Horse']['registered']=$useridarr['Changerequesthorse']['registered'] ;		
			$this->data['Horse']['edited_date']	=date("Y-m-d");
			$this->Horse->id=$useridarr['Changerequesthorse']['horse_id'];
			$this->Horse->save($this->data);			
			
			$delsql=" UPDATE tbl_horsesubscriptions SET yesstatus='Y' WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'];
			$this->User->query($delsql) ;
			
			
			
			$this->data['Changerequesthorse']['ownerid']=$originahorsearr['Horse']['ownerid'] ;
			$this->data['Changerequesthorse']['name']=$originahorsearr['Horse']['name'] ;
			$this->data['Changerequesthorse']['gender']=$originahorsearr['Horse']['gender'] ;
			$this->data['Changerequesthorse']['breed_id']=$originahorsearr['Horse']['breed_id'] ;
			
			$this->data['Changerequesthorse']['year']=$originahorsearr['Horse']['year'] ;
			$this->data['Changerequesthorse']['sire']=$originahorsearr['Horse']['sire'] ;
			$this->data['Changerequesthorse']['sire_id']=$originahorsearr['Horse']['sire_id'] ;
			$this->data['Changerequesthorse']['dam']=$originahorsearr['Horse']['dam'] ;
			$this->data['Changerequesthorse']['dam_id']=$originahorsearr['Horse']['dam_id'] ;
			$this->data['Changerequesthorse']['sireunknowoption']=$originahorsearr['Horse']['sireunknowoption'] ;
			$this->data['Changerequesthorse']['damunknownoption']=$originahorsearr['Horse']['damunknownoption'] ;			
			$this->data['Changerequesthorse']['ownername']=$originahorsearr['Horse']['ownername'] ;
			$this->data['Changerequesthorse']['height_id']=$originahorsearr['Horse']['height_id'] ;
			$this->data['Changerequesthorse']['coatcolor_id']=$originahorsearr['Horse']['coatcolor_id'] ;
			$this->data['Changerequesthorse']['bloodline']=$originahorsearr['Horse']['bloodline'] ;
			$this->data['Changerequesthorse']['breeder']=$originahorsearr['Horse']['breeder'] ;
			$this->data['Changerequesthorse']['prize_won']=$originahorsearr['Horse']['prize_won'] ;
			$this->data['Changerequesthorse']['stablename']=$originahorsearr['Horse']['stablename'] ;
			$this->data['Changerequesthorse']['countryid']=$originahorsearr['Horse']['countryid'] ;
			$this->data['Changerequesthorse']['state_id']=$originahorsearr['Horse']['state_id'] ;
			$this->data['Changerequesthorse']['town_id']=$originahorsearr['Horse']['town_id'] ;
			$this->data['Changerequesthorse']['bred_name']=$originahorsearr['Horse']['bred_name'] ;
			$this->data['Changerequesthorse']['bred_id']=$originahorsearr['Horse']['bred_id'] ;			
			$this->data['Changerequesthorse']['other_details']=$originahorsearr['Horse']['other_details'] ;
			$this->data['Changerequesthorse']['utube_link']=$originahorsearr['Horse']['utube_link'] ;
			$this->data['Changerequesthorse']['image']=$originahorsearr['Horse']['image'] ; 
			$this->data['Changerequesthorse']['video']=$originahorsearr['Horse']['video'] ;	
			$this->data['Changerequesthorse']['yearofdeath']=$originahorsearr['Horse']['yearofdeath'] ;	
			$this->data['Changerequesthorse']['deathstat']=$originahorsearr['Horse']['deathstat'] ;	
			$this->data['Changerequesthorse']['registration_code']=$originahorsearr['Horse']['registration_code'] ;	
			$this->data['Changerequesthorse']['registered']=$originahorsearr['Horse']['registered'] ;	
			$this->data['Changerequesthorse']['breeder_id']=$useridarr['Horse']['breeder_id'] ;
			$this->data['Changerequesthorse']['stable_id']=$useridarr['Horse']['stable_id'] ;
				
			
			
			$this->data['Changerequesthorse']['changed_date']=date("Y-m-d");
			$this->Changerequesthorse->id=$id;
			$this->Changerequesthorse->save($this->data);				
			$addiimage_sql="SELECT * FROM tbl_changerequesthorseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'] ;
			$additiimagearr=$this->Horse->query($addiimage_sql);
			
			$originaladditionalimage_sql="SELECT * FROM tbl_horseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'];
			$originaladditionaliamge_arr=$this->Horse->query($originaladditionalimage_sql) ;	
			
			if(count($additiimagearr)>0) {
				$del_sql="DELETE FROM tbl_horseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'];
				$this->Horse->query($del_sql);
				if(is_array($additiimagearr)) {
					foreach($additiimagearr as $key=>$val) :
						$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$useridarr['Changerequesthorse']['horse_id'].",image='".$val['tbl_changerequesthorseimages']['image']."',changed_from='N'";
						$this->Horse->query($insert_sql);
						
						$showimage_sql="INSERT INTO tbl_showaddiotionalimage SET horse_id=".$useridarr['Changerequesthorse']['horse_id'].",image='".$val['tbl_changerequesthorseimages']['image']."'";
						$this->Horse->query($showimage_sql);						
					endforeach;
					
					
					
					$del_sql="DELETE FROM tbl_changerequesthorseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'] ;
					$this->Horse->query($del_sql);
				}
			}			
			if(count($originaladditionaliamge_arr)>0) {
				if(is_array($originaladditionaliamge_arr)) {
					foreach($originaladditionaliamge_arr as $key=>$val) :
						$insert_sql="INSERT INTO tbl_changerequesthorseimages SET horse_id=".$useridarr['Changerequesthorse']['horse_id'].",image='".$val['tbl_horseimages']['image']."'";
						$this->Horse->query($insert_sql);
					endforeach;
				}		
			}			
			if($originalhorsedataarr['Horse']['ownername']!="") {
				$usernameemail_sql="SELECT * FROM tbl_users User WHERE CONCAT(User.firstname,' ',User.lastname)='".$originalhorsedataarr['Horse']['ownername']."'";
				$adminArr = $this->Admin->FindBySuperAdmin(1);	
				$textContent2='';
				$textContent2='Dear,<b>'.$originalhorsedataarr['Horse']['ownername'].'</b><br> A change Edit request has been approved by the site admiminstrator of the Indian Horse Database.
				You will get an notification after you log in at the site.
				<br>
				Thanks
				Indian Horse Database';		
				$textContent2 = stripslashes($textContent2);
				$this->set("message", $textContent2);
				$this->Email->to = $adminArr['Admin']['admin_email'];
				$this->Email->subject = 'Admin Approval For Change Edit Request For Horse';
				$this->Email->replyTo = $adminArr['Admin']['admin_email'];
				$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
				$this->Email->template	= 'email/customer' ; // note no '.ctp'
				//$this->Email->send();			
			}			
			if($originalhorsedataarr['Horse']['breeder']!="") {
				$usernameemail_sql="SELECT * FROM tbl_users User WHERE CONCAT(User.firstname,' ',User.lastname)='".$originalhorsedataarr['Horse']['breeder']."'";
				$adminArr = $this->Admin->FindBySuperAdmin(1);	
				$textContent2='';
				$textContent2='Dear,<b>'.$originalhorsedataarr['Horse']['breeder'].'</b><br> A change Edit request has been approved by the site admiminstrator of the Indian Horse Database.
				You will get an notification after you log in at the site.
				<br>
				If you want to accept the change then you click yes .
				<br>
				Thanks
				Indian Horse Database';		
				$textContent2 = stripslashes($textContent2);
				$this->set("message", $textContent2);
				$this->Email->to = $adminArr['Admin']['admin_email'];
				$this->Email->subject = 'Admin Approval For Change Edit Request For Horse';
				$this->Email->replyTo = $adminArr['Admin']['admin_email'];
				$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
				$this->Email->template	= 'email/customer' ; // note no '.ctp'
				//$this->Email->send();			
			}	
			$this->Session->setFlash('Edit Request Successfully approved.');
			$this->redirect('/changerequesthorse');					
		}	
	}
	function disgree($requset_id=NULL,$requestedby_id=NULL) {
		$disgree_sql="SELECT * FROM tbl_horserequestreject WHERE requestid=".$requset_id." AND user_id=".$requestedby_id;
		return $this->Horse->query($disgree_sql) ;
	}
	function viewreason($horse_id=NULL,$user_id=NULL) {
		$this->layout='';
		$disgree_sql="SELECT * FROM tbl_horserequestreject WHERE horse_id=".$horse_id." AND user_id=".$user_id; 
		$this->set('disagreearr',$this->Horse->query($disgree_sql));
	}
	function ownerpostion($user_id=NULL,$horse_id=NULL) {
		$horsearr=$this->Horse->FindAll("ownerid=".$user_id." AND id=".$horse_id);
		return $horsearr;	
	}
	function revert($id=NULL) {
			$useridarr=$this->Changerequesthorse->FindByid($id);
			$originahorsearr=$this->Horse->FindByid($useridarr['Changerequesthorse']['horse_id']) ;
			$this->data['Horse']['ownerid']=$useridarr['Changerequesthorse']['ownerid'] ;
			$this->data['Horse']['name']=$useridarr['Changerequesthorse']['name'] ;
			$this->data['Horse']['gender']=$useridarr['Changerequesthorse']['gender'] ;
			$this->data['Horse']['breed_id']=$useridarr['Changerequesthorse']['breed_id'] ;
			$this->data['Horse']['year']=$useridarr['Changerequesthorse']['year'] ;
			$this->data['Horse']['sire']=$useridarr['Changerequesthorse']['sire'] ;
			$this->data['Horse']['dam']=$useridarr['Changerequesthorse']['dam'] ;
			
			$this->data['Horse']['sire_id']=$useridarr['Changerequesthorse']['sire_id'] ;
			$this->data['Horse']['dam_id']=$useridarr['Changerequesthorse']['dam_id'] ;
			
			
			$this->data['Horse']['ownername']=$useridarr['Changerequesthorse']['ownername'] ;
			$this->data['Horse']['breeder']=$useridarr['Changerequesthorse']['breeder'] ;
			$this->data['Horse']['height_id']=$useridarr['Changerequesthorse']['height_id'] ;
			$this->data['Horse']['coatcolor_id']=$useridarr['Changerequesthorse']['coatcolor_id'] ;
			$this->data['Horse']['bloodline']=$useridarr['Changerequesthorse']['bloodline'] ;
			$this->data['Horse']['breeder']=$useridarr['Changerequesthorse']['breeder'] ;
			$this->data['Horse']['breeder_id']=$useridarr['Changerequesthorse']['breeder_id'] ;
			$this->data['Horse']['prize_won']=$useridarr['Changerequesthorse']['prize_won'] ;
			$this->data['Horse']['stablename']=$useridarr['Changerequesthorse']['stablename'] ;
			$this->data['Horse']['countryid']=$useridarr['Changerequesthorse']['countryid'] ;
			$this->data['Horse']['state_id']=$useridarr['Changerequesthorse']['state_id'] ;
			$this->data['Horse']['town_id']=$useridarr['Changerequesthorse']['town_id'] ;
			$this->data['Horse']['bred_name']=$useridarr['Changerequesthorse']['bred_name'] ;
			$this->data['Horse']['bred_id']=$useridarr['Changerequesthorse']['bred_id'] ;
			$this->data['Horse']['other_details']=$useridarr['Changerequesthorse']['other_details'] ;
			$this->data['Horse']['utube_link']=$useridarr['Changerequesthorse']['utube_link'] ;
			$this->data['Horse']['image']=$useridarr['Changerequesthorse']['image'] ;
			$this->data['Horse']['video']=$useridarr['Changerequesthorse']['video'] ;	
			
			$this->data['Horse']['yearofdeath']=$useridarr['Changerequesthorse']['yearofdeath'] ;	
			$this->data['Horse']['deathstat']=$useridarr['Changerequesthorse']['deathstat'] ;	
			$this->data['Horse']['registration_code']=$useridarr['Changerequesthorse']['registration_code'] ;	
			$this->data['Horse']['registered']=$useridarr['Changerequesthorse']['registered'] ;	
					
			$this->Horse->id=$useridarr['Changerequesthorse']['horse_id'];
			$this->Horse->save($this->data);		
			
			$this->data['Changerequesthorse']['ownerid']=$originahorsearr['Horse']['ownerid'] ;
			$this->data['Changerequesthorse']['name']=$originahorsearr['Horse']['name'] ;
			$this->data['Changerequesthorse']['gender']=$originahorsearr['Horse']['gender'] ;
			$this->data['Changerequesthorse']['breed_id']=$originahorsearr['Horse']['breed_id'] ;
			$this->data['Changerequesthorse']['year']=$originahorsearr['Horse']['year'] ;
			$this->data['Changerequesthorse']['sire']=$originahorsearr['Horse']['sire'] ;
			$this->data['Changerequesthorse']['dam']=$originahorsearr['Horse']['dam'] ;
			
			$this->data['Changerequesthorse']['sire_id']=$originahorsearr['Horse']['sire_id'] ;
			$this->data['Changerequesthorse']['dam_id']=$originahorsearr['Horse']['dam_id'] ;			
			
			$this->data['Changerequesthorse']['ownername']=$originahorsearr['Horse']['ownername'] ;
			$this->data['Changerequesthorse']['breeder']=$originahorsearr['Horse']['breeder'] ;
			$this->data['Changerequesthorse']['breeder_id']=$originahorsearr['Horse']['breeder_id'] ;
			$this->data['Changerequesthorse']['height_id']=$originahorsearr['Horse']['height_id'] ;
			$this->data['Changerequesthorse']['coatcolor_id']=$originahorsearr['Horse']['coatcolor_id'] ;
			$this->data['Changerequesthorse']['bloodline']=$originahorsearr['Horse']['bloodline'] ;
			$this->data['Changerequesthorse']['breeder']=$originahorsearr['Horse']['breeder'] ;
			$this->data['Changerequesthorse']['prize_won']=$originahorsearr['Horse']['prize_won'] ;
			$this->data['Changerequesthorse']['stablename']=$originahorsearr['Horse']['stablename'] ;
			$this->data['Changerequesthorse']['countryid']=$originahorsearr['Horse']['countryid'] ;
			$this->data['Changerequesthorse']['state_id']=$originahorsearr['Horse']['state_id'] ;
			$this->data['Changerequesthorse']['town_id']=$originahorsearr['Horse']['town_id'] ;
			$this->data['Changerequesthorse']['bred_name']=$originahorsearr['Horse']['bred_name'] ;
			$this->data['Changerequesthorse']['other_details']=$originahorsearr['Horse']['other_details'] ;
			$this->data['Changerequesthorse']['utube_link']=$originahorsearr['Horse']['utube_link'] ;
			$this->data['Changerequesthorse']['image']=$originahorsearr['Horse']['image'] ;
			$this->data['Changerequesthorse']['video']=$originahorsearr['Horse']['video'] ;	
			$this->data['Changerequesthorse']['changed_date']=date("Y-m-d");
			
			$this->data['Changerequesthorse']['yearofdeath']=$originahorsearr['Horse']['yearofdeath'] ;	
			$this->data['Changerequesthorse']['deathstat']=$originahorsearr['Horse']['deathstat'] ;	
			$this->data['Changerequesthorse']['registration_code']=$originahorsearr['Horse']['registration_code'] ;	
			$this->data['Changerequesthorse']['registered']=$originahorsearr['Horse']['registered'] ;	
			
			$this->Changerequesthorse->id=$id;
			$this->Changerequesthorse->save($this->data);	 
			
			$originaladditionalimage_sql="SELECT * FROM tbl_horseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'];
			$originaladditionaliamge_arr=$this->Horse->query($originaladditionalimage_sql) ;
			
			$addiimage_sql="SELECT * FROM tbl_changerequesthorseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'] ;
			$additiimagearr=$this->Horse->query($addiimage_sql);						
			if(count($additiimagearr)>0) {
				$del_sql="DELETE FROM tbl_horseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'];
				$this->Horse->query($del_sql);
				if(is_array($additiimagearr)) {
					foreach($additiimagearr as $key=>$val) :
						$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$useridarr['Changerequesthorse']['horse_id'].",image='".$val['tbl_changerequesthorseimages']['image']."'";
						$this->Horse->query($insert_sql);
					endforeach;
					$del_sql="DELETE FROM tbl_changerequesthorseimages WHERE horse_id=".$useridarr['Changerequesthorse']['horse_id'] ;
					$this->Horse->query($del_sql);
				}
			}			
			if(count($originaladditionaliamge_arr)>0) {
				if(is_array($originaladditionaliamge_arr)) {
					foreach($originaladditionaliamge_arr as $key=>$val) :
						$insert_sql="INSERT INTO tbl_changerequesthorseimages SET horse_id=".$useridarr['Changerequesthorse']['horse_id'].",image='".$val['tbl_horseimages']['image']."'";
						$this->Horse->query($insert_sql);
					endforeach;
				}		
			}	
			$this->Changerequesthorse->id=$id;
			$this->data['Changerequesthorse']['revert_status']='Y';
			$this->Changerequesthorse->save($this->data);
			$this->redirect($this->referer());
	}		
}
?>