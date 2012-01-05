<?php
ob_start();
class StableController  extends AppController
{
	var $name		= "Stable" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination','Rsz' );
	var $components	= array('Pagination','Upload');	
	var $uses=array('Stable','Coatcolor','User','Breed','Height','Horse','Stableimage','Country','Town','State','Stablesubscription');
	function index()
	{			
		parent::adminlayout();  
		$pagetotal=$this->Stable->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Stable->findAll('','','order by id desc','',''));  
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller 
	}	
	function _paginate_leads($criteria) { 
	 	$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Stable->findAll($criteria, NULL, $order, $limit, $page);
		return $leads; 
	}			 
	function add() {
		$duplicateerr=0;
		$user_arr=$this->User->FindAll("login_stat='Y'");
		$this->set('user_arr',$user_arr);
		$this->set('userdata',$this->data['Stable']['userid']); 
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		$country_arr=$this->Country->FindAll("status='Y'");
		$this->set('country_arr',$country_arr);
		if(!empty($this->data)) {			
			if($this->Stable->validates($this->data))  {	
				$duplicatearr=$this->Stable->FindAll("stable_name='".$this->data['Stable']['stable_name']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {		
					if($this->data['Stable']['stable_image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Stable']['stable_image'], 'stable_image', '', 'stable_image'); 
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img='';
					}	
					$this->data['Stable']['stable_image']=$img;		
					$this->data['Stable']['status']="Y";	
					$this->data['Stable']['country_id']=$this->data['Horse']['countryid']	;
					$this->data['Stable']['state_id']=$this->data['Horse']['state_id']	;
					$this->data['Stable']['town_id']=$this->data['Horse']['town_id']	;
					$this->data['Stable']['posted_date']=date("Y-m-d");	
					$this->Stable->save($this->data);
					$lastid=$this->Stable->getLastInsertId();
					
					if(count(@$this->data['Stable']['horse_id'])>0) {
						$horseid='';
						foreach($this->data['Stable']['horse_id'] as $key=>$val) :
							$this->Horse->id=$val;
							$this->data['Horse']['stable_id']=$lastid ;
							$this->Horse->save($this->data);
						endforeach;				
					}					
					if(is_numeric($_POST['hiddval'])) {
						if($_POST['hiddval']>0) {
							for($i=1;$i<=$_POST['hiddval'];$i++) {
								$path=rootpth()."multiplestableimage";
								$randno=rand(4563,478962);
								if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
									$insert_sql="INSERT INTO tbl_stableimages  SET stable_id='".$lastid."',image='".$randno.$_FILES['img_'.$i]['name']."'";
									$this->Horse->query($insert_sql) ;
								}	
							}	
						}	
					}				
					if($this->Stable->save($this->data)) {
						$this->Session->setFlash('Stable successfully added.');
						$this->redirect('/Stable');
					}								
				}				
			}			 
		  else 
		  {
			return false;  
		  }		
		}
		$this->set('duplicateerr',$duplicateerr);
	}	
	function listhorse($user_id=NULL) {
		parent::adminlayout(); 
		$horse_arr=$this->Horse->Findall('ownerid='.$user_id); 
		$this->set('horse_arr',$horse_arr);
		$this->set('user_id',$user_id);
	}
	function edit($Stableid=NULL) {	
		$duplicateerr=0;
		$this->Stable->id=$Stableid;
		$edit_arr=$this->Stable->Read();
		$this->set('edit_arr',$edit_arr);
		$horse_arr=$this->Horse->Findall('ownerid='.$edit_arr['Stable']['userid']);
		$this->set('horse_arr',$horse_arr);
		$user_arr=$this->User->FindAll("login_stat='Y'");
		$country_arr=$this->Country->FindAll("status='Y'");
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y' AND id=".$edit_arr['Stable']['town_id']);
		$this->set('town_arr',$town_arr);		
		$state_arr=$this->State->FindAll("status='Y' AND id=".$edit_arr['Stable']['state_id']);
		$this->set('state_arr',$state_arr);		
		$mulimage_sql="SELECT * FROM tbl_stableimages Stableimage WHERE stable_id=".$Stableid ;
		$mulimage_arr=$this->Stable->query($mulimage_sql) ;
		$this->set('mulimage_arr',$mulimage_arr);		
		$this->set('user_arr',$user_arr);
		$this->set('userdata',$this->data['Stable']['userid']);
		$this->set('Stableid',$Stableid);
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {			
			if($this->Stable->validates($this->data))  {	
				$duplicatearr=$this->Stable->FindAll("id!=".$Stableid." AND stable_name='".$this->data['Stable']['stable_name']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {					
					if($this->data['Stable']['stable_image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Stable']['stable_image'], 'stable_image', '', 'stable_image'); 
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img=$edit_arr['Stable']['stable_image'] ;
					}	
				$this->data['Stable']['stable_image']=$img;		
				$this->data['Stable']['status']="Y";	
				$userid=$this->Session->Read("userid") ;
				$this->Stable->id=$Stableid;
				$this->data['Stable']['country_id']=$this->data['Horse']['countryid']	;
				$this->data['Stable']['state_id']=$this->data['Horse']['state_id']	;
				$this->data['Stable']['town_id']=$this->data['Horse']['town_id']	;
				$this->data['Stable']['posted_date']=date("Y-m-d");	
				$this->Stable->save($this->data);				
				$horsearr=$this->Horse->FindAll("stable_id=".$Stableid);
				if(count($horsearr)>0) {
					foreach($horsearr as $key=>$val) :
						$this->data['Horse']['stable_id']='';
						$this->Horse->id=$val;
						$this->Horse->save($this->data);
					endforeach;
				}
				if(count(@$this->data['Stable']['horse_id'])>0) {
						$horseid='';
						foreach($this->data['Stable']['horse_id'] as $key=>$val) :
							$this->Horse->id=$val;
							$this->data['Horse']['stable_id']=$Stableid ;
							$this->Horse->save($this->data);
						endforeach;				
				}
				if(is_numeric($_POST['hiddval'])) {
						if($_POST['hiddval']>0) {
							for($i=1;$i<=$_POST['hiddval'];$i++) {
								$path=rootpth()."multiplestableimage";
								$randno=rand(4563,478962);
								if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
									$insert_sql="INSERT INTO tbl_stableimages SET stable_id='".$Stableid."',image='".$randno.$_FILES['img_'.$i]['name']."'";
									$this->Horse->query($insert_sql) ;
								}	
							}	
						}	
					}				
					if($this->Stable->save($this->data)) {
						$this->Session->setFlash('Stable successfully added.');
						$this->redirect('/Stable');
					}					
				 }				
			}			 
		  else 
		  {
			return false;  
		  }		
		}
		$this->set('duplicateerr',$duplicateerr);
	}	
	function breedname($breed_id=NULL) {
		$this->Breed->id=$breed_id;
		$breednamearr=$this->Breed->Read();
		return $breednamearr['Breed']['breed'];	
	}
	function username($userid=NULL) {
		$this->User->id=$userid;
		$usernamearr=$this->User->Read();
		return $usernamearr['User']['firstname']." ".$usernamearr['User']['lastname'];	
	}	
	function stat_on($id=NULL) {
		$this->Stable->id=$id;
		$this->data['Stable']['status']="Y";
		$this->Stable->save($this->data);
		$this->Session->setFlash('Stable status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Stable->id=$id;
		$this->data['Stable']['status']="N";
		$this->Stable->save($this->data);		
		$this->Session->setFlash('Stable status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Stable->id=$productid;
		if($this->Stable->delete()) { 
			$this->Session->setFlash('Stable successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
	function deladdimage($id=NULL,$image=NULL) {
		$this->Stableimage->id=$id;
		$this->Stableimage->delete();
		if(@unlink(rootpth()."Stableadditionalimage/".$image)) {	
		}
		$this->redirect($this->referer());
	}
	function stableprofile() {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$stableexists='';	
		$userid=$this->Session->Read("userid") ;
		$this->data['Stable']['userid']=$userid;	
		$stable_arr=$this->Stable->FindAll("userid=".$userid." AND status='Y'");
		if(count($stable_arr)>0) {
			$pregpage=$_SERVER['HTTP_REFERER'] ;
			if(stristr($pregpage,'premiumuserwelcomepage')) {
				$this->redirect('/stable/editstable/'.$stable_arr[0]['Stable']['id']);
			}
			else {
				$this->redirect('/stable/mystable/'.$stable_arr[0]['Stable']['id']);
			}
		}
		else {
			$stableexists='NO';
		}
		$this->set('stableexists',$stableexists);			
		$this->set('stable_arr',$stable_arr);			
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}	
	}	
	function create() {
		error_reporting(0);
		parent::blanklayout();
		parent::chkblanksession();	
		parent::chkusertype();
		$userid=$this->Session->Read("userid") ;
		$this->data['Stable']['userid']=$userid;	
		$country_arr=$this->Country->FindAll("status='Y'");
		$this->set('country_arr',$country_arr);
		$stable_arr=$this->Stable->FindAll("userid=".$userid." AND status='Y'");
		$listhorst=$this->Horse->FindAll("approve_stat='Y' AND ownerid=".$userid);
		$this->set('listhorst',$listhorst);		
		if(count($stable_arr)>0) {
			$this->redirect('/stable/viewprofile/'.$stable_arr[0]['Stable']['id']);
		}
		else {
			$stableexists='NO';
		}		
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}		
		$horseid='';
					if(@isset($_POST['sub'])) {	
					if($this->data['Stable']['stable_image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Stable']['stable_image'], 'stable_image', '', 'stable_image'); 
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img='';
					}	
					$this->data['Stable']['stable_image']=$img;		
					$this->data['Stable']['country_id']=$this->data['Horse']['countryid']	;
					$this->data['Stable']['state_id']=$this->data['Horse']['state_id']	;
					$this->data['Stable']['town_id']=$this->data['Horse']['town_id']	;
					$this->data['Stable']['status']="Y";	
					$userid=$this->Session->Read("userid") ;
					$this->data['Stable']['userid']=$userid;	
					$this->data['Stable']['posted_date']=date("Y-m-d");	
					$this->Stable->save($this->data);
					$lastid=$this->Stable->getLastInsertId();
					
					if(count(@$this->data['Stable']['horse_id'])>0) {
						$horseid='';
						foreach($this->data['Stable']['horse_id'] as $key=>$val) :
							$this->Horse->id=$val;
							$this->data['Horse']['stable_id']=$lastid ;
							$this->Horse->save($this->data);
						endforeach;				
					}					
				if(is_numeric($_POST['hiddval'])) {
					if($_POST['hiddval']>0) {
						for($i=1;$i<=$_POST['hiddval'];$i++) {
							$path=rootpth()."multiplestableimage";
							$randno=rand(4563,478962);
							if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
								$insert_sql="INSERT INTO tbl_stableimages SET stable_id=".$lastid.",image='".$randno.$_FILES['image_'.$i]['name']."'";
								$this->Horse->query($insert_sql) ;
							}	
						}	
					}	
				}				
				$this->redirect('/stable/stableprofile');			
		  }	
	}	
	function chkstable($stablename=NULL) {
		parent::blanklayout();
		$msg='';
		$countarr=$this->Stable->FindAll("stable_name='".$stablename."'");
		if(count($countarr)>0) {
			$msg='<font color=#FF0000>Stable Aready exits </font>';
			e("1");
			exit();
		}
		else {
			$msg='<font color=#FF0000>Stable Aready exits </font>';
			e("0");
			exit();
		}
	}	
	function chkstableforedit($stablename=NULL,$stable_id=NULL) {
		parent::blanklayout();
		$msg='';
		$countarr=$this->Stable->FindAll("stable_name='".$stablename."' AND id!=".$stable_id);
		if(count($countarr)>0) {
			$msg='<font color=#FF0000>Stable Aready exits </font>';
			e("1");
			exit();
		}
		else {
			$msg='<font color=#FF0000>Stable Aready exits </font>';
			e("0");
			exit();
		}	
	}	
	function liststable($horseid=NULL) {
		return $this->Stable->FindAll("status='Y'");	
	}	
	function addimage() {
		if(is_numeric($_POST['hiddval'])) {
			if($_POST['hiddval']>0) {
				for($i=1;$i<=$_POST['hiddval'];$i++) {
					$path=rootpth()."multiplestableimage";
					$randno=rand(4563,478962);
					if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
						$insert_sql="INSERT INTO tmp_stable_image_upload SET session_id='".session_id()."',image='".$randno.$_FILES['image_'.$i]['name']."'";
						$this->Horse->query($insert_sql) ;
					}	
				}	
			}	
		}
		$this->redirect($this->referer());
	}
	function stabledelete($stable_id=NULL) {
		$horsearr=$this->Horse->FindAll("stable_id=".$stable_id);
		if(count($horsearr)>0) {
			foreach($horsearr as $key=>$val) :
				$this->data['Horse']['stable_id']='';
				$this->Horse->id=$val;
				$this->Horse->save($this->data);
			endforeach;
		}
		$this->Stable->id=$stable_id;
		$this->Stable->delete();
		$this->redirect('/stable/stableprofile');
	}
	function viewprofile($stable_id=NULL) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindByid($stable_id) ;	
		$userid=$this->Session->Read("userid") ;
		if(is_numeric($userid)) {
			$ownstable_arr=$this->Stable->FindAll('userid='.$userid.' AND id='.$stable_id) ;
			if(count($ownstable_arr)>0) {
				$this->redirect('/stable/mystable/'.$stable_id);
			}
		}
		//parent::chkusertype();
		$mulimage_sql="SELECT * FROM tbl_stableimages Stableimage WHERE stable_id=".$stable_id ;
		$mulimage_arr=$this->Stable->query($mulimage_sql) ;
		$horsearr=$this->Horse->FindAll("stable_id=".$stable_id);
		$horselistarr=$this->Horse->FindAll("stable_id=".$stable_id." LIMIT 0, 11");
		$this->set('horselistarr',$horselistarr);
		$this->set('mulimage_arr',$mulimage_arr);
		
		$horsebred_arr=$this->Horse->FindAll('bred_id='.$stable_id." LIMIT 0,5");
		$this->set('horsebred_arr',$horsebred_arr);
		
		$bredall=$this->Horse->FindAll('bred_id='.$stable_id);
		$this->set('bredall',$bredall);		
		$this->set('stablearr',$stablearr);
		$this->set('stable_id',$stable_id);
		$this->set('horsearr',$horsearr);		
		$listhorseforsale_sql="SELECT * FROM tbl_horses Horse, tbl_horsesales Sale , tbl_stables Stable ,tbl_sale_remove_horse Remove
							   WHERE Horse.stable_id=Stable.id AND Sale.horse_id=Horse.id AND Stable.id=".$stable_id." AND  Remove.horse_id!=Horse.id  GROUP BY Horse.id";
		$listhorsesalearr=$this->Stable->query($listhorseforsale_sql) ;
		$this->set('listhorsesalearr',$listhorsesalearr);		
	}	
	
	function mystable($stable_id=NULL) {		
		parent::blanklayout();
		$stablearr=$this->Stable->FindByid($stable_id) ;
		$userid=$this->Session->Read("userid") ;
		if($userid!=$stablearr['Stable']['userid']) {
			$this->redirect('/user/noaccess');
		}			
		$stablearr=$this->Stable->FindByid($stable_id) ;	
		$mulimage_sql="SELECT * FROM tbl_stableimages Stableimage WHERE stable_id=".$stable_id ;
		$mulimage_arr=$this->Stable->query($mulimage_sql) ;
		$horsearr=$this->Horse->FindAll("stable_id=".$stable_id);
		$horselistarr=$this->Horse->FindAll("stable_id=".$stable_id." LIMIT 0, 7");
		$this->set('horselistarr',$horselistarr);
		$this->set('mulimage_arr',$mulimage_arr);		
		$horsebred_arr=$this->Horse->FindAll('bred_id='.$stable_id." LIMIT 0,5");
		$this->set('horsebred_arr',$horsebred_arr);
		
		$bredall=$this->Horse->FindAll('bred_id='.$stable_id);
		$this->set('bredall',$bredall);
		
		$this->set('stablearr',$stablearr);
		$this->set('stable_id',$stable_id);
		$this->set('horsearr',$horsearr);
		$listhorseforsale_sql="SELECT * FROM tbl_horses Horse, tbl_horsesales Sale , tbl_stables Stable ,tbl_sale_remove_horse Remove
							   WHERE Horse.stable_id=Stable.id AND Sale.horse_id=Horse.id AND Stable.id=".$stable_id." AND  Remove.horse_id!=Horse.id  GROUP BY Horse.id";
		$listhorsesalearr=$this->Stable->query($listhorseforsale_sql) ;
		$this->set('listhorsesalearr',$listhorsesalearr);
	}
	function listhorseimage($stable_id) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindByid($stable_id) ;	
		$horsearr=$this->Horse->FindAll("stable_id=".$stable_id);
		$this->set('horsearr',$horsearr);
	}
	function editstable($stable_id=NULL) {
		error_reporting(0);
		parent::blanklayout();
		parent::chkblanksession();	
		parent::chkusertype();
		$country_arr=$this->Country->FindAll("status='Y'");
		$this->set('country_arr',$country_arr);		
		$userid=$this->Session->Read("userid") ;
		$usertype=$this->Session->Read("usertype") ;
		$listhorst=$this->Horse->FindAll("approve_stat='Y' AND ownerid=".$userid);
		
		$this->set('listhorst',$listhorst);
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}		
		$stablearr=$this->Stable->FindByid($stable_id) ;
		if($userid!=$stablearr['Stable']['userid']) {
			$this->redirect('/user/noaccess');
		}		
		$town_arr=$this->Town->FindAll("status='Y' AND id=".$stablearr['Stable']['town_id']);
		$this->set('town_arr',$town_arr);		
		$state_arr=$this->State->FindAll("status='Y' AND id=".$stablearr['Stable']['state_id']);
		$this->set('state_arr',$state_arr);		
		$mulimage_sql="SELECT * FROM tbl_stableimages Stableimage WHERE stable_id=".$stable_id ;
		$mulimage_arr=$this->Stable->query($mulimage_sql) ;
		$this->set('mulimage_arr',$mulimage_arr);
		$this->set('stablearr',$stablearr);
		$this->set('stable_id',$stable_id);	
		$horseid='';
			if(!empty($this->data)) {					
				if($this->data['Stable']['stable_image']['name']!="") {
					$path = $this->Upload->uploadfile($this->data['Stable']['stable_image'], 'stable_image', '', 'stable_image'); 
					$fileNameArr=explode('/',$path);
					$img=$fileName=$fileNameArr[1];
				}
				else {
					$img=$stablearr['Stable']['stable_image'] ;
				}	
				$this->data['Stable']['stable_image']=$img;		
				$this->data['Stable']['status']="Y";	
				$this->data['Stable']['country_id']=$this->data['Horse']['countryid']	;
				$this->data['Stable']['state_id']=$this->data['Horse']['state_id']	;
				$this->data['Stable']['town_id']=$this->data['Horse']['town_id']	;
				$userid=$this->Session->Read("userid") ;
				$this->Stable->id=$stable_id;
				$this->data['Stable']['userid']=$userid;	
				$this->data['Stable']['posted_date']=date("Y-m-d");	
				$this->Stable->save($this->data);				
				$horsearr=$this->Horse->FindAll("stable_id=".$stable_id);
				if(count($horsearr)>0) {
					foreach($horsearr as $key=>$val) :
						$this->data['Horse']['stable_id']='';
						$this->Horse->id=$val;
						$this->Horse->save($this->data);
					endforeach;
				}
				if(count(@$this->data['Stable']['horse_id'])>0) {
						$horseid='';
						foreach($this->data['Stable']['horse_id'] as $key=>$val) :
							$this->Horse->id=$val;
							$this->data['Horse']['stable_id']=$stable_id ;
							$this->Horse->save($this->data);
						endforeach;				
				}				
			if(is_numeric($_POST['hiddval'])) {
					if($_POST['hiddval']>0) {
						// $_POST['hiddval'] ;
						for($i=1;$i<=$_POST['hiddval'];$i++) {
							$path=rootpth()."multiplestableimage";
							$randno=rand(4563,478962);
							if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
								$insert_sql="INSERT INTO tbl_stableimages SET stable_id=".$stable_id.",image='".$randno.$_FILES['image_'.$i]['name']."'";
								$this->Horse->query($insert_sql) ;
							}	
						}	
					}	
				}
			$this->Session->setFlash('Successfully updated.');
			$this->redirect('/stable/stableprofile');			
		 }
	}	
	function addiimagedel($image=NULL,$id=NULL) {
		$this->Stableimage->id=$id;
		$this->Stableimage->delete();
		if(@unlink(rootpth()."multiplestableimage/".$image)) {	
		}
		$this->redirect($this->referer());
	}
	function viewuserstabename() {
		$userid=$this->Session->Read("userid") ; 
		return $this->Stable->FindAll('userid='.$userid); 
	}	
	
	function subscribefornotification($stable_id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$msg='';
		$chk_arr=$this->Stablesubscription->FindAll("user_id=".$userid." AND stable_id=".$stable_id);
		if(count($chk_arr)>0) {
			$msg='<font color=#FF0000>You have already subscribed for this stable </font>';
		}
		else {
			$this->data['Stablesubscription']['user_id']=$userid;
			$this->data['Stablesubscription']['stable_id']=$stable_id;
			$this->Stablesubscription->save($this->data);
			$msg='<font color=#FF0000>You have successfully subscribed for this stable </font>';
		}
		$this->set('msg',$msg);	
	}	
	function unsubscribefornotification($stable_id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$msg='';
		$chk_arr=$this->Stablesubscription->FindAll("user_id=".$userid." AND stable_id=".$stable_id);
		if(count($chk_arr)<=0) {
			$msg='<font color=#FF0000>You have not subscribed for this stable </font>';
		}
		else {
			$del_sql="DELETE FROM tbl_stablesubscriptions WHERE user_id=".$userid." AND stable_id=".$stable_id;
			$this->Stablesubscription->query($del_sql) ;
			$msg='<font color=#FF0000>You have successfully unsubscribed for this stable </font>'; 
		}
		$this->set('msg',$msg);	
	}	
	function stabledetails($id=NULL) {
		return $this->Stable->FindByid($id) ;
	}
} # end of the class
?>