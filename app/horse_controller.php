<?php
ob_start();
error_reporting(0);
class HorseController  extends AppController
{
	var $name		= "Horse" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' ,'Rsz');
	var $components	= array('Pagination','Upload','Email');	
	var $uses=array('Horse','Coatcolor','User','Admin','Breed','Height','Horseimage','Stable','Content','Gender','Horsesale','Country','Town','Pricerange','State','Horsesubscription','Changerequesthorse','Changeeditrequestnotification','Pricerange','Horseforstud');
	function index($orderby=NULL)
	{	
		error_reporting(0);
		parent::adminlayout(); 
		parent::checkAdminSession(); 	
		$pagetotal=$this->Horse->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$list_sql="SELECT * FROM tbl_horses Horse  ";  
		if($orderby=="") {
			$list_sql.=" ORDER BY id DESC ";
		}
		if($orderby=="asc") {
			$list_sql.=" ORDER BY name ASC "; 
		}		
		if($orderby=="desc") {
			$list_sql.=" ORDER BY name DESC ";
		}			
		$listarr1=$this->Horse->query($list_sql) ;
		if($_REQUEST['dipslayperpage']=="") {
			$diplay=500;
		}
		else {
			$diplay=$_REQUEST['dipslayperpage'] ;
		}
		if($_REQUEST['page']=="" || $_REQUEST['page']==1) {
			$list_sql.=" LIMIT 0,".$diplay;
		}		
		else  {
			$page=$_REQUEST['page'];
			$limval=($page-1)*$diplay;
			$list_sql.=" LIMIT ".$limval.",".$diplay; 		
		}
		if($_REQUEST['page']=="") {
			$page=1;
		}
		else {
			$page=$_REQUEST['page'] ;
		}
		$listarr=$this->Horse->query($list_sql) ;
		$this->set('listarr',$listarr);
		$this->set('listarr1',$listarr1);
		$this->set('countval',count($listarr));
		$this->set('diplay',$diplay);
		$this->set('page',$page);
		$this->set('orderby',$orderby);
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Horse->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {
		//pr($_COOKIE);
		error_reporting(0);
		parent::adminlayout(); 
		parent::checkAdminSession(); 	
		$usertype=$this->Session->Read("usertype") ;
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);	
		$this->set('horsename',$horsename);		
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);		
		$this->set('addfor',$addfor);
		$this->set('horsename',$horsename);		
		$town_arr=$this->Town->FindAll("status='Y'");
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y'");
		$this->set('state_arr',$state_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);
		if(!empty($this->data)) {
			if($this->Horse->validates($this->data))  {
				if($this->data['Horse']['image']['name']!="") {
					$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
					$fileNameArr=explode('/',$path);
					$img=$fileName=$fileNameArr[1];
				}
				else {
					$img='';
				}	
				if($this->data['Horse']['video']['name']!="") {
					$path = $this->Upload->uploadfile($this->data['Horse']['video'], 'horsevideo', '', 'horsevideo'); 
					$fileNameArr=explode('/',$path);
					$video=$fileName=$fileNameArr[1];
				}
				else {
					$video='';
				}
				if(@$_POST['hiddownerid']) {
					$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
				}
				if(@$_POST['hiddbreederid']) {
					$this->data['Horse']['breeder_id']=@$_POST['hiddbreederid'];
				}
				$this->data['Horse']['image']=$img;
				$this->data['Horse']['approve_stat']="Y";
				
				if(isset($this->data['Horse']['deathstat'])) {
					if($this->data['Horse']['deathstat']=="Y") {
						$deathstat="Y";
					}			
					else {
						$deathstat="N";
					}
				}
				else {
					$deathstat="N";
				}
				$this->data['Horse']['deathstat']=$deathstat;			
				
				$this->data['Horse']['video']=$video;
				$this->Horse->Save($this->data);
				$lastid=$this->Horse->getLastInsertId();
				if(!empty($this->data['Horse']['stablename'])) {
					$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
					if(count($stablecountarr)>0) {
						$this->Horse->id=$lastid;
						$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
						$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];					
					}	
					else {
						$this->data['Horse']['stablename']='';
					}	
					$this->Horse->save($this->data);	
				}			
				if(!empty($this->data['Horse']['bred_name'])) {
					$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
					if(count($stablecountarr)>0) {
						$this->Horse->id=$lastid;
						$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
						$this->data['Horse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
					}	
					else {
						$this->data['Horse']['bred_name']='';
					}		
					$this->Horse->save($this->data);				
				}			
				if(is_numeric($_POST['hiddval'])) {
					if($_POST['hiddval']>0) {
						for($i=1;$i<=$_POST['hiddval'];$i++) {
							$path=rootpth()."horseadditionalimage";
							$randno=rand(4563,478962);
							if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
								$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$lastid.",image='".$randno.$_FILES['img_'.$i]['name']."'";
								$this->Horse->query($insert_sql) ;
							}	
						}	
					}	
				}	
				$namearr=$this->Horse->FindAll("name='".$this->data['Horse']['name']."'");
				if($addfor!="") {
					switch($addfor) {
						case 'addasire':
							$update_sql="UPDATE tbl_horses SET sire='".$this->data['Horse']['name']."',sireunknowoption='N' WHERE id=".$prevhorse_id ;
							$this->Horse->query($update_sql) ;
						break;
						case 'adddam':
							$update_sql="UPDATE tbl_horses SET dam='".$this->data['Horse']['name']."',damunknownoption='N' WHERE id=".$prevhorse_id ;
							$this->Horse->query($update_sql) ;
						break;
					}			
				}
				$this->redirect('/horse/');
			}
			else {
				return false;
			}			
		}
	}	
	function edit($horse_id=NULL) {
		error_reporting(0);
		parent::adminlayout(); 
		parent::checkAdminSession(); 
		$salesstatus='';
		$useridarr=$this->Horse->FindAll('id='.$horse_id);
		$tmp_sql="SELECT  * FROM tmp_horse_image_upload Tmp WHERE session_id='".session_id()."'";
		$tmp_image_arr=$this->Horse->query($tmp_sql) ;
		$this->set('tmp_image_arr',$tmp_image_arr);
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);	
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);		
		$userid=$this->Session->Read("userid") ;
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$useridarr[0]['Horse']['state_id']);
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$useridarr[0]['Horse']['countryid']);
		$this->set('state_arr',$state_arr);			
		if($useridarr['0']['Horse']['sales_status']!="S" && $useridarr['0']['Horse']['sales_status']!="Stud") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horse_id);
			if(count($salecount)<=0) {
				$salesstatus='yes';
			}		
		}
		$this->set('salesstatus',$salesstatus);	
		$additionalimagearr=$this->Horseimage->FindAll('horse_id='.$horse_id); 
		$this->set('additionalimagearr',$additionalimagearr);
		if(!empty($this->data)) {
			if($this->data['Horse']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img=$useridarr[0]['Horse']['image'] ;
			}
			if(isset($this->data['Horse']['nameunknownoption'])) {
				$nameunknownoption='Y';
			}
			else {
				$nameunknownoption='N';
			}
			$this->data['Horse']['nameunknownoption']=$nameunknownoption;
			if(isset($this->data['Horse']['sireunknowoption'])) {
				$sireunknowoption='Y';
			}
			else {
				$sireunknowoption='N';
			}
			$this->data['Horse']['sireunknowoption']=$sireunknowoption;
			
			if(isset($this->data['Horse']['damunknownoption'])) {
				$damunknownoption='Y';
			}
			else {
				$damunknownoption='N';
			}
			$this->data['Horse']['damunknownoption']=$damunknownoption;		
			
			
			if(isset($this->data['Horse']['deathstat'])) {
				if($this->data['Horse']['deathstat']=="Y") {
					$deathstat="Y";
				}			
				else {
					$deathstat="N";
				}
			}
			else {
				$deathstat="N";
			}
			$this->data['Horse']['deathstat']=$deathstat;	
			
			
							
			if($this->data['Horse']['video']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['video'], 'horsevideo', '', 'horsevideo'); 
				$fileNameArr=explode('/',$path);
				$video=$fileName=$fileNameArr[1];
			}
			else {
				$video=$useridarr[0]['Horse']['video'] ;
			}
			$userid=$this->Session->Read("userid") ;
			$this->Horse->id=$horse_id;
			$this->data['Horse']['addedby']=$userid;			
			if(@$_POST['hiddownerid']) {
				$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
			}
			if(@$_POST['hiddownerid']=="") {
				if($useridarr[0]['Horse']['ownername']!=$this->data['Horse']['ownername']) {
					$this->data['Horse']['ownerid']='';
					$this->data['Horse']['ownername']=$this->data['Horse']['ownername'];
				}			
			}
			if(@$_POST['hiddbreederid']) {
				$this->data['Horse']['breeder_id']=@$_POST['hiddbreederid'];
			}
			if(@$_POST['hiddsireval']) {
				$this->data['Horse']['sire_id']=@$_POST['hiddsireval'];
			}			
			if(@$_POST['hiddsireval']=="") {
				if($useridarr[0]['Horse']['sire']!=$this->data['Horse']['sire']) {
					$this->data['Horse']['sire_id']='';
					$this->data['Horse']['sire']=$this->data['Horse']['sire'];
				}			
			}	
			
			if(@$_POST['hidddamval']) {
				$this->data['Horse']['dam_id']=@$_POST['hidddamval'];
			}			
			if(@$_POST['hidddamval']=="") {
				if($useridarr[0]['Horse']['dam']!=$this->data['Horse']['dam']) {
					$this->data['Horse']['dam_id']='';
					$this->data['Horse']['dam']=$this->data['Horse']['dam'];
				}			
			}							
			if(@$_POST['hiddbreederid']=="") {
				if($useridarr[0]['Horse']['breeder']!=$this->data['Horse']['breeder']) {
					$this->data['Horse']['breeder_id']='';
					$this->data['Horse']['breeder']=$this->data['Horse']['breeder'];
				}			
			}			
			$this->data['Horse']['image']=$img;
			$this->data['Horse']['video']=$video;
			$this->Horse->Save($this->data);			
			if(!empty($this->data['Horse']['stablename'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']='';
				}					
			}	
			else {
				$this->data['Horse']['stable_id']='';
			}		
			$this->Horse->save($this->data);
			if(!empty($this->data['Horse']['bred_name'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']='';
				}								
			}	
				else {
					$this->data['Horse']['bred_id']='';
				}
				$this->Horse->save($this->data);
				if(is_numeric($_POST['hiddval'])) {				
				if($_POST['hiddval']>0) {
					for($i=1;$i<=$_POST['hiddval'];$i++) {
						$path=rootpth()."horseadditionalimage";
						$randno=rand(4563,478962);
						if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
							$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$horse_id.",image='".$randno.$_FILES['image_'.$i]['name']."'";
							$this->Horse->query($insert_sql) ;
						}	
					}	
				}	
			}
			
			$delsql=" UPDATE tbl_horsesubscriptions SET yesstatus='Y' WHERE horse_id=".$horse_id;
			$this->User->query($delsql) ;
			
			$this->redirect('/horse/');
		}		
		$this->set('useridarr',$useridarr);
		$this->set('horse_id',$horse_id);		
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
		$this->Horse->id=$id;
		$this->data['Horse']['approve_stat']="Y";
		$this->Horse->save($this->data);
		$this->Session->setFlash('Horse status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Horse->id=$id;
		$this->data['Horse']['approve_stat']="N";
		$this->Horse->save($this->data);		
		$this->Session->setFlash('Horse status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Horse->id=$productid;
		if($this->Horse->delete()) { 		
				////cascade delete
			$delsalesql="DELETE FROM tbl_horsesales WHERE 	horse_id=".$productid;
			$this->Horse->query($delsalesql) ;
			
			$delstudsql="DELETE FROM tbl_horseforstuds WHERE 	horse_id=".$productid;
			$this->Horse->query($delstudsql) ;
			
			$this->Session->setFlash('Horse successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
	function deladdimage($id=NULL,$image=NULL) {
		$this->Horseimage->id=$id;
		$this->Horseimage->delete();
		if(@unlink(rootpth()."horseadditionalimage/".$image)) {	
		}
		$this->redirect($this->referer());
	}
	////////// Front End ////////	
	function listlatesthorseforsale() {
		$horsearr= $this->Horse->findAll("approve_stat='Y' AND sales_status='S'",'','order by id desc','','LIMIT 0, 10'); 
		return $horsearr;
	}	
	function mylistedhorse($orderby=NULL) {
		parent::chkblanksession();
		parent::blanklayout();
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/horse/mylistedhorsefreemember');
		}
		parent::chkusertype();
		$userid=$this->Session->Read("userid") ;
		if($orderby=="") {
			$orderby=" ORDER BY id DESC ";
		}
		if($orderby=="asc") {
			$orderby=" ORDER BY name ASC ";
		}
		if($orderby=="desc") {
			$orderby=" ORDER BY name DESC ";
		}
		$userarr=$this->User->FindById($userid)	;	
		$ownername=$userarr['User']['firstname']." ".$userarr['User']['lastname'] ;	
		$mypostedhorsearr=$this->Horse->FindAll("approve_stat='Y'  AND ownerid=".$userid.$orderby); 
		$this->set('mypostedhorsearr',$mypostedhorsearr);	
		$this->set('orderby',$orderby);	
	}	
	function mylistedhorsefreemember($orderby=NULL) {
		parent::chkblanksession();
		parent::blanklayout();
		$usertype=$this->Session->Read("usertype") ;
		$userid=$this->Session->Read("userid") ;
		if($usertype!="F") {
			$this->redirect('/user/noaccess');
		}
		if($orderby=="") {
			$orderby=" ORDER BY id DESC ";
		}
		if($orderby=="asc") {
			$orderby=" ORDER BY name ASC ";
		}
		if($orderby=="desc") {
			$orderby=" ORDER BY name DESC ";
		}
		$userarr=$this->User->FindById($userid)	;	
		$ownername=$userarr['User']['firstname']." ".$userarr['User']['lastname'] ;	
		$mypostedhorsearr=$this->Horse->FindAll("approve_stat='Y' AND  ownerid=".$userid.$orderby); 
		$this->set('mypostedhorsearr',$mypostedhorsearr);	
	}
	function addhorse($addfor=NULL,$horsename=NULL,$prevhorse_id=NULL) {
		//pr($_COOKIE);
		error_reporting(0);
		parent::chkblanksession();		
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			if($addfor=="") {
				$this->redirect('/horse/addhorsebyfreemember');
			}
			else {
				$this->redirect('/horse/addhorsebyfreemember/'.$addfor.'/'.$horsename.'/'.$prevhorse_id);
			}
		}
		parent::blanklayout();
		//parent::chkusertype();	 
		$tmp_sql="SELECT  * FROM tmp_horse_image_upload Tmp WHERE session_id='".session_id()."'";
		$tmp_image_arr=$this->Horse->query($tmp_sql) ;
		$this->set('tmp_image_arr',$tmp_image_arr);
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);	
		$this->set('horsename',$horsename);		
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','',''); 
		$this->set('country_arr',$country_arr);		
		$this->set('addfor',$addfor);
		$this->set('horsename',$horsename);		
		$town_arr=$this->Town->FindAll("status='Y'");
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y'");
		$this->set('state_arr',$state_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);
		if(!empty($this->data)) {
			if($this->data['Horse']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img='';
			}	
			if($this->data['Horse']['video']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['video'], 'horsevideo', '', 'horsevideo'); 
				$fileNameArr=explode('/',$path);
				$video=$fileName=$fileNameArr[1];
			}
			else {
				$video='';
			}
			$userid=$this->Session->Read("userid") ;	
			
			$this->data['Horse']['addedby']=$userid;
			if(@$_POST['hiddownerid']) {
				$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
			}
			if(@$_POST['hiddbreederid']) {
				$this->data['Horse']['breeder_id']=@$_POST['hiddbreederid'];
			}
			if(@$_POST['hiddsireval']) {
				$this->data['Horse']['sire_id']=@$_POST['hiddsireval'];
			}
			else {
				$this->data['Horse']['sire_id']='';
			}			
			if(@$_POST['hidddamval']) {
				$this->data['Horse']['dam_id']=@$_POST['hidddamval'];
			}
			else {
				$this->data['Horse']['dam_id']='';
			}
			$this->data['Horse']['image']=$img;
			$this->data['Horse']['approve_stat']="Y";
			
			if(isset($this->data['Horse']['deathstat'])) {
				if($this->data['Horse']['deathstat']=="Y") {
					$deathstat="Y";
				}			
				else {
					$deathstat="N";
				}
			}
			else {
				$deathstat="N";
			}
			$this->data['Horse']['deathstat']=$deathstat;			
			
			$this->data['Horse']['video']=$video;
			$this->Horse->Save($this->data);
			$lastid=$this->Horse->getLastInsertId();
			if(!empty($this->data['Horse']['stablename'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$lastid;
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
				}	
				$this->Horse->save($this->data);	
			}			
			if(!empty($this->data['Horse']['bred_name'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$lastid;
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['bred_name']='';
				}		
				$this->Horse->save($this->data);				
			}			
			if(is_numeric($_POST['hiddval'])) {
				if($_POST['hiddval']>0) {
					for($i=1;$i<=$_POST['hiddval'];$i++) {
						$path=rootpth()."horseadditionalimage";
						$randno=rand(4563,478962);
						if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
							$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$lastid.",image='".$randno.$_FILES['image_'.$i]['name']."'";
							$this->Horse->query($insert_sql) ;
						}	
					}	
				}	
			}	
			$namearr=$this->Horse->FindAll("name='".$this->data['Horse']['name']."'");
			if($addfor!="") {
				switch($addfor) {
					case 'addasire':
						$update_sql="UPDATE tbl_horses SET sire='".$this->data['Horse']['name']."',sireunknowoption='N' WHERE id=".$prevhorse_id ;
						$this->Horse->query($update_sql) ;
					break;
					case 'adddam':
						$update_sql="UPDATE tbl_horses SET dam='".$this->data['Horse']['name']."',damunknownoption='N' WHERE id=".$prevhorse_id ;
						$this->Horse->query($update_sql) ;
					break;
				}			
			}
			$this->redirect('/horse/successfulladd/'.str_replace(" ", "-",$this->data['Horse']['name']).'/'.$lastid);
		}
		$this->set('horsename',$horsename);
	}	
	function successfulladd($horsename=NULL,$horseid=NULL) {
		error_reporting(0);
		parent::chkblanksession();
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/horse/addhorsebyfreemember');
		}		
		if($horseid=="") {
			$horseid=$horsename;
		}
		parent::blanklayout();
		$horsearr=$this->Horse->FindById($horseid);
		$userid=$this->Session->Read("userid") ; 
		if($userid) {
			$userdetails_arr=$this->User->FindByid($userid) ;
			$this->set('userdetails_arr',$userdetails_arr);
		}
		$usertype=$this->Session->Read("usertype") ;
		$this->set('usertype',$usertype);
		$salesstatus='';
		$salecount='';
		$this->set('userid',$userid);
		$this->set('horsearr',$horsearr);
		$offspingarr=$this->Horse->Findall("sire='".$horsearr['Horse']['name']."' OR dam ='".$horsearr['Horse']['name']."'");
		$this->set('offspingarr',$offspingarr);		
		$siblings_sql="SELECT * FROM tbl_horses Horse WHERE sire!='' AND dam!='' AND (sire='".$horsearr['Horse']['sire']."') OR (sire='".$horsearr['Horse']['dam']."' OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['dam']."')) AND id!=".$horseid;
		$siblingsarr=$this->Horse->query($siblings_sql);
		$this->set('siblingsarr',$siblingsarr);		
		$horseimagearr=$this->Horseimage->FindAll('horse_id='.$horseid); 
		$this->set('horseimagearr',$horseimagearr);	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid);
		$horseowerarr=$this->Horse->FindAll("ownername='".$userarr['User']['firstname']." ".$userarr['User']['lastname']."' AND id=".$horseid);
		$this->set('horseowerarr',$horseowerarr);	
		$pricerangearr='';
		if($horsearr['Horse']['sire']!="") {
			$horsesirearr=$this->Horse->FindAll("name='".$horsearr['Horse']['sire']."'");
		}		
		if($horsearr['Horse']['dam']!="") {
			$horsedamarr=$this->Horse->FindAll("name='".$horsearr['Horse']['dam']."'");
		}
		$this->set('horsedamarr',$horsedamarr);		
		$this->set('pricerangearr',$pricerangearr);		
		$this->set('horsesirearr',$horsesirearr);
		$this->set('salesstatus',$salesstatus);
		$this->set('salecount',$salecount);
		$this->set('horseid',$horseid);		
	}	
	function successfulladdbyfreemebber($horsename=NULL,$horseid=NULL) {
		error_reporting(0);
		parent::chkblanksession();
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="P") {
			$this->redirect('/horse/mylistedhorse');
		}
		if($horseid=="") {
			$horseid=$horsename;
		}
		parent::blanklayout();
		$horsearr=$this->Horse->FindById($horseid);
		$userid=$this->Session->Read("userid") ; 
		if($userid) {
			$userdetails_arr=$this->User->FindByid($userid) ;
			$this->set('userdetails_arr',$userdetails_arr);
		}
		$usertype=$this->Session->Read("usertype") ;
		$this->set('usertype',$usertype);
		$salesstatus='';
		$salecount='';
		$this->set('userid',$userid);
		$this->set('horsearr',$horsearr);
		$offspingarr=$this->Horse->Findall("sire='".$horsearr['Horse']['name']."' OR dam ='".$horsearr['Horse']['name']."'");
		$this->set('offspingarr',$offspingarr);		
		$siblings_sql="SELECT * FROM tbl_horses Horse WHERE sire!='' AND dam!='' AND (sire='".$horsearr['Horse']['sire']."') OR (sire='".$horsearr['Horse']['dam']."' OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['dam']."')) AND id!=".$horseid;
		$siblingsarr=$this->Horse->query($siblings_sql);
		$this->set('siblingsarr',$siblingsarr);		
		$horseimagearr=$this->Horseimage->FindAll('horse_id='.$horseid); 
		$this->set('horseimagearr',$horseimagearr);	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid);
		$horseowerarr=$this->Horse->FindAll("ownername='".$userarr['User']['firstname']." ".$userarr['User']['lastname']."' AND id=".$horseid);
		$this->set('horseowerarr',$horseowerarr);	
		$pricerangearr='';
		$horsesirearr='';
		if($horsearr['Horse']['sire']!="") {
			$horsesirearr=$this->Horse->FindAll("name='".$horsearr['Horse']['sire']."'");
		}		
		if($horsearr['Horse']['dam']!="") {
			$horsedamarr=$this->Horse->FindAll("name='".$horsearr['Horse']['dam']."'");
		}
		$this->set('horsedamarr',$horsedamarr);		
		$this->set('pricerangearr',$pricerangearr);		
		$this->set('horsesirearr',$horsesirearr);
		$this->set('salesstatus',$salesstatus);
		$this->set('salecount',$salecount);
		$this->set('horseid',$horseid);	
	}	
	function chksiredamexist($horsename=NULL) {
		$countarr=$this->Horse->FindAll("name='".$horsename."'");
		return count($countarr);	
	}
	
	function horselinkinfo($horsename=NULL) {
		$horsearr=$this->Horse->FindAll("name='".$horsename."'");
		return $horsearr;	
	}
	
	function showfirsrdam($id=NULL) {
		$horsearr=$this->Horse->FindAll("id='".$id."'");
		return $horsearr;
	}
	
	function addhorsebyfreemember($addfor=NULL,$horsename=NULL,$prevhorse_id=NULL) {
		//pr($_COOKIE);
		error_reporting(0);
		parent::chkblanksession();		
		$usertype=$this->Session->Read("usertype") ;
		parent::blanklayout();
		//parent::chkusertype();	 
		$tmp_sql="SELECT  * FROM tmp_horse_image_upload Tmp WHERE session_id='".session_id()."'";
		$tmp_image_arr=$this->Horse->query($tmp_sql) ;
		$this->set('tmp_image_arr',$tmp_image_arr);
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);	
		$this->set('horsename',$horsename);		
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);		
		$this->set('addfor',$addfor);
		$this->set('horsename',$horsename);		
		$town_arr=$this->Town->FindAll("status='Y'");
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y'");
		$this->set('state_arr',$state_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);
		if(!empty($this->data)) {
			if($this->data['Horse']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img='';
			}	
			if($this->data['Horse']['video']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['video'], 'horsevideo', '', 'horsevideo'); 
				$fileNameArr=explode('/',$path);
				$video=$fileName=$fileNameArr[1];
			}
			else {
				$video='';
			}
			$userid=$this->Session->Read("userid") ;	
			
			$this->data['Horse']['addedby']=$userid;			
			if(@$_POST['hiddownerid']) {
				$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
			}
			if(@$_POST['hiddbreederid']) {
				$this->data['Horse']['breeder_id']=@$_POST['hiddbreederid'];
			}
			if(@$_POST['hiddsireval']) {
				$this->data['Horse']['sire_id']=@$_POST['hiddsireval'];
			}
			else {
				$this->data['Horse']['sire_id']='';
			}			
			if(@$_POST['hidddamval']) {
				$this->data['Horse']['dam_id']=@$_POST['hidddamval'];
			}
			else {
				$this->data['Horse']['dam_id']='';
			}	
			$this->data['Horse']['image']=$img;
			$this->data['Horse']['approve_stat']="Y";
			
			if(isset($this->data['Horse']['deathstat'])) {
				if($this->data['Horse']['deathstat']=="Y") {
					$deathstat="Y";
				}			
				else {
					$deathstat="N";
				}
			}
			else {
				$deathstat="N";
			}
			$this->data['Horse']['deathstat']=$deathstat;			
			
			$this->data['Horse']['video']=$video;
			$this->Horse->Save($this->data);
			$lastid=$this->Horse->getLastInsertId();
			if(!empty($this->data['Horse']['stablename'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$lastid;
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
				}	
				$this->Horse->save($this->data);	
			}			
			if(!empty($this->data['Horse']['bred_name'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$lastid;
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['bred_name']='';
				}		
				$this->Horse->save($this->data);				
			}			
			if(is_numeric($_POST['hiddval'])) {
				if($_POST['hiddval']>0) {
					for($i=1;$i<=$_POST['hiddval'];$i++) {
						$path=rootpth()."horseadditionalimage";
						$randno=rand(4563,478962);
						if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
							$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$lastid.",image='".$randno.$_FILES['image_'.$i]['name']."'";
							$this->Horse->query($insert_sql) ;
						}	
					}	
				}	
			}	
			$namearr=$this->Horse->FindAll("name='".$this->data['Horse']['name']."'");
			if($addfor!="") {
				switch($addfor) {
					case 'addasire':
						$update_sql="UPDATE tbl_horses SET sire='".$this->data['Horse']['name']."',sireunknowoption='N' WHERE id=".$prevhorse_id ;
						$this->Horse->query($update_sql) ;
					break;
					case 'adddam':
						$update_sql="UPDATE tbl_horses SET dam='".$this->data['Horse']['name']."',damunknownoption='N' WHERE id=".$prevhorse_id ;
						$this->Horse->query($update_sql) ;
					break;
				}			
			}
			$this->redirect('/horse/successfulladdbyfreemebber/'.str_replace(" ", "-",$this->data['Horse']['name']).'/'.$lastid);
		}
		$this->set('horsename',$horsename);
	}
	function addimage() {
		if(is_numeric($_POST['hiddval'])) {
			if($_POST['hiddval']>0) {
				for($i=1;$i<=$_POST['hiddval'];$i++) {
					$path=rootpth()."horseadditionalimage";
					$randno=rand(4563,478962);
					if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
						$insert_sql="INSERT INTO tmp_horse_image_upload SET session_id='".session_id()."',image='".$randno.$_FILES['image_'.$i]['name']."'";
						$this->Horse->query($insert_sql) ;
					}	
				}	
			}	
		}
		$this->redirect($this->referer());
	}	
	function listhorse() {
		$listhorse_arr=$this->Horse->FindAll("approve_stat='Y'");
		return $listhorse_arr;	
	}
	function chkhorse($horname=NULL) {
		parent::blanklayout();
		$count_arr=$this->Horse->Findall("name='".$horname."'");
		if(count($count_arr)>0) {
			e("1");		
			exit();
		}	
		else {
			e("0");
			exit();
		}
	}	
	function chkhorseforedit($horseid=NULL,$horname=NULL) {
		parent::blanklayout();
		$count_arr=$this->Horse->Findall("name='".$horname."' AND id!=".$horseid);
		if(count($count_arr)>0) {
			e("1");		
			exit();
		}	
		else {
			e("0");
			exit();
		}
	}	
	function userhorsedel($horse_id=NULL) {
		$this->Horse->id=$horse_id;
		if($this->Horse->delete()) {
			$delimage_sql="DELETE FROM tbl_horseimages WHERE horse_id=".$horse_id;
			$this->Horse->query($delimage_sql);
			$this->redirect($this->referer());
		}
	}	
	function horsepossuccess() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Horsepostsuccess%'");
		$this->set('homecontent_arr',$homecontent_arr);	
	}	
	function edithorseinfo($horse_id=NULL) {
		error_reporting(0);
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$salesstatus='';
		$useridarr=$this->Horse->FindAll('id='.$horse_id);
		$tmp_sql="SELECT  * FROM tmp_horse_image_upload Tmp WHERE session_id='".session_id()."'";
		$tmp_image_arr=$this->Horse->query($tmp_sql) ;
		$this->set('tmp_image_arr',$tmp_image_arr);
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);	
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);		
		$userid=$this->Session->Read("userid") ;
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$useridarr[0]['Horse']['state_id']);
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$useridarr[0]['Horse']['countryid']);
		$this->set('state_arr',$state_arr);			
		if($useridarr['0']['Horse']['sales_status']!="S" && $useridarr['0']['Horse']['sales_status']!="Stud") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horse_id);
			if(count($salecount)<=0) {
				$salesstatus='yes';
			}		
		}
		$this->set('salesstatus',$salesstatus);	
		$additionalimagearr=$this->Horseimage->FindAll('horse_id='.$horse_id); 
		$this->set('additionalimagearr',$additionalimagearr);
		if(!empty($this->data)) {
						
			
			if($this->data['Horse']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img=$useridarr[0]['Horse']['image'] ;
			}
			if(isset($this->data['Horse']['nameunknownoption'])) {
				$nameunknownoption='Y';
			}
			else {
				$nameunknownoption='N';
			}
			$this->data['Horse']['nameunknownoption']=$nameunknownoption;
			if(isset($this->data['Horse']['sireunknowoption'])) {
				$sireunknowoption='Y';
			}
			else {
				$sireunknowoption='N';
			}
			$this->data['Horse']['sireunknowoption']=$sireunknowoption;
			
			if(isset($this->data['Horse']['damunknownoption'])) {
				$damunknownoption='Y';
			}
			else {
				$damunknownoption='N';
			}
			$this->data['Horse']['damunknownoption']=$damunknownoption;		
			
			
			if(isset($this->data['Horse']['deathstat'])) {
				if($this->data['Horse']['deathstat']=="Y") {
					$deathstat="Y";
				}			
				else {
					$deathstat="N";
				}
			}
			else {
				$deathstat="N";
			}
			$this->data['Horse']['deathstat']=$deathstat;	
			$this->data['Horse']['video']='';
			
							
			$userid=$this->Session->Read("userid") ;
			$this->Horse->id=$horse_id;
			$this->data['Horse']['addedby']=$userid;			
			if(@$_POST['hiddownerid']) {
				$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
			}
			if(@$_POST['hiddownerid']=="") {
				if($useridarr[0]['Horse']['ownername']!=$this->data['Horse']['ownername']) {
					$this->data['Horse']['ownerid']='';
					$this->data['Horse']['ownername']=$this->data['Horse']['ownername'];
				}			
			}			
			if(@$_POST['hiddbreederid']) {
				$this->data['Horse']['breeder_id']=@$_POST['hiddbreederid'];
			}
			if(@$_POST['hiddsireval']) {
				$this->data['Horse']['sire_id']=@$_POST['hiddsireval'];
			}			
			if(@$_POST['hiddsireval']=="") {
				if($useridarr[0]['Horse']['sire']!=$this->data['Horse']['sire']) {
					$this->data['Horse']['sire_id']='';
					$this->data['Horse']['sire']=$this->data['Horse']['sire'];
				}			
			}	
			
			if(@$_POST['hidddamval']) {
				$this->data['Horse']['dam_id']=@$_POST['hidddamval'];
			}			
			if(@$_POST['hidddamval']=="") {
				if($useridarr[0]['Horse']['dam']!=$this->data['Horse']['dam']) {
					$this->data['Horse']['dam_id']='';
					$this->data['Horse']['dam']=$this->data['Horse']['dam'];
				}			
			}							
			if(@$_POST['hiddbreederid']=="") {
				if($useridarr[0]['Horse']['breeder']!=$this->data['Horse']['breeder']) {
					$this->data['Horse']['breeder_id']='';
					$this->data['Horse']['breeder']=$this->data['Horse']['breeder'];
				}			
			}			
			$this->data['Horse']['image']=$img;
		
			$this->Horse->Save($this->data);			
			if(!empty($this->data['Horse']['stablename'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']='';
				}	
				$this->Horse->save($this->data);	
			}			
			if(!empty($this->data['Horse']['bred_name'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']='';
				}		
				
				$this->Horse->save($this->data);				
			}	
				if(is_numeric($_POST['hiddval'])) {				
				if($_POST['hiddval']>0) {
					for($i=1;$i<=$_POST['hiddval'];$i++) {
						$path=rootpth()."horseadditionalimage";
						$randno=rand(4563,478962);
						if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
							$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$horse_id.",image='".$randno.$_FILES['image_'.$i]['name']."'";
							$this->Horse->query($insert_sql) ;
						}	
					}	
				}	
			}
			
			$delsql=" UPDATE tbl_horsesubscriptions SET yesstatus='Y' WHERE horse_id=".$horse_id;
			$this->User->query($delsql) ;
					
			if(isset($_POST['mainimg'])) {
				foreach($_POST['mainimg'] as $key=>$value) {
					$image_id=$value;
				}			
				$path=rootpth().'/horseimage';		
				$horsearr=$this->Horse->FindAll("id=".$horse_id);
				$oldimage=$horsearr[0]['Horse']['image'] ;
				$additioimage_sql="SELECT * FROM tbl_horseimages Horseimage WHERE id=".$image_id ;
				$additionaimagearr=$this->Horse->query($additioimage_sql) ;
				$image=$additionaimagearr[0]['Horseimage']['image'] ;
				
				
				$path=rootpth().'/horseimage/';		
				@copy(rootpth().'horseadditionalimage/'.$image,$path.'/'.$image);	  
				$update_sql="UPDATE tbl_horses SET image='".$image."' WHERE id=".$horse_id ;
				$this->Horse->query($update_sql);
				
				//@copy(rootpth().'tmp_offerupload/'.$this->Session->Read('tmp_propertyupload_1'),$path.'/'.$uploadpurchase_file);
				
				$path=rootpth().'/horseadditionalimage';
				@copy(rootpth().'horseimage/'.$oldimage,$path.'/'.$oldimage);
				
				$updateadd_sql="UPDATE tbl_horseimages SET image='".$oldimage."' WHERE id=".$image_id;
				$this->Horse->query($updateadd_sql) ;
				//die();
			}		
			$this->redirect('/horse/mylistedhorse');
		}		
		$this->set('useridarr',$useridarr);
		$this->set('horse_id',$horse_id);		
	}	
	function edithorseinfobyfreeuser($horse_id=NULL) {
		error_reporting(0);
		parent::blanklayout();
		parent::chkblanksession();
		//parent::chkusertype();
		$salesstatus='';
		$useridarr=$this->Horse->FindAll('id='.$horse_id);
		$tmp_sql="SELECT  * FROM tmp_horse_image_upload Tmp WHERE session_id='".session_id()."'";
		$tmp_image_arr=$this->Horse->query($tmp_sql) ;
		$this->set('tmp_image_arr',$tmp_image_arr);
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);	
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);		
		$userid=$this->Session->Read("userid") ;
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$useridarr[0]['Horse']['state_id']);
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$useridarr[0]['Horse']['countryid']);
		$this->set('state_arr',$state_arr);			
		if($useridarr['0']['Horse']['sales_status']!="S" && $useridarr['0']['Horse']['sales_status']!="Stud") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horse_id);
			if(count($salecount)<=0) {
				$salesstatus='yes';
			}		
		}
		$this->set('salesstatus',$salesstatus);	
		$additionalimagearr=$this->Horseimage->FindAll('horse_id='.$horse_id); 
		$this->set('additionalimagearr',$additionalimagearr);
		if(!empty($this->data)) {
			if($this->data['Horse']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img=$useridarr[0]['Horse']['image'] ;
			}
			if(isset($this->data['Horse']['nameunknownoption'])) {
				$nameunknownoption='Y';
			}
			else {
				$nameunknownoption='N';
			}
			$this->data['Horse']['nameunknownoption']=$nameunknownoption;
			if(isset($this->data['Horse']['sireunknowoption'])) {
				$sireunknowoption='Y';
			}
			else {
				$sireunknowoption='N';
			}
			$this->data['Horse']['sireunknowoption']=$sireunknowoption;			
			if(isset($this->data['Horse']['damunknownoption'])) {
				$damunknownoption='Y';
			}
			else {
				$damunknownoption='N';
			}
			$this->data['Horse']['damunknownoption']=$damunknownoption;		
			if(isset($this->data['Horse']['deathstat'])) {
				if($this->data['Horse']['deathstat']=="Y") {
					$deathstat="Y";
				}			
				else {
					$deathstat="N";
				}
			}
			else {
				$deathstat="N";
			}
			$this->data['Horse']['deathstat']=$deathstat;							
			if($this->data['Horse']['video']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['video'], 'horsevideo', '', 'horsevideo'); 
				$fileNameArr=explode('/',$path);
				$video=$fileName=$fileNameArr[1];
			}
			else {
				$video=$useridarr[0]['Horse']['video'] ;
			}
			$userid=$this->Session->Read("userid") ;
			$this->Horse->id=$horse_id;
			$this->data['Horse']['addedby']=$userid;			
			if(@$_POST['hiddownerid']) {
				$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
			}
			if(@$_POST['hiddownerid']=="") {
				if($useridarr[0]['Horse']['ownername']!=$this->data['Horse']['ownername']) {
					$this->data['Horse']['ownerid']='';
					$this->data['Horse']['ownername']=$this->data['Horse']['ownername'];
				}			
			}			
			if(@$_POST['hiddbreederid']) {
				$this->data['Horse']['breeder_id']=@$_POST['hiddbreederid'];
			}
			if(@$_POST['hiddsireval']) {
				$this->data['Horse']['sire_id']=@$_POST['hiddsireval'];
			}			
			if(@$_POST['hiddsireval']=="") {
				if($useridarr[0]['Horse']['sire']!=$this->data['Horse']['sire']) {
					$this->data['Horse']['sire_id']='';
					$this->data['Horse']['sire']=$this->data['Horse']['sire'];
				}			
			}			
			if(@$_POST['hidddamval']) {
				$this->data['Horse']['dam_id']=@$_POST['hidddamval'];
			}			
			if(@$_POST['hidddamval']=="") {
				if($useridarr[0]['Horse']['dam']!=$this->data['Horse']['dam']) {
					$this->data['Horse']['dam_id']='';
					$this->data['Horse']['dam']=$this->data['Horse']['dam'];
				}			
			}							
			if(@$_POST['hiddbreederid']=="") {
				if($useridarr[0]['Horse']['breeder']!=$this->data['Horse']['breeder']) {
					$this->data['Horse']['breeder_id']='';
					$this->data['Horse']['breeder']=$this->data['Horse']['breeder'];
				}			
			}			
			$this->data['Horse']['image']=$img;
			$this->data['Horse']['video']=$video;
			$this->Horse->Save($this->data);			
			if(!empty($this->data['Horse']['stablename'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Horse']['stable_id']='';
				}	
				$this->Horse->save($this->data);	
			}			
			if(!empty($this->data['Horse']['bred_name'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->data['Horse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Horse']['bred_id']='';
				}		
				$this->Horse->save($this->data);				
			}	
				if(is_numeric($_POST['hiddval'])) {				
					if($_POST['hiddval']>0) {
						for($i=1;$i<=$_POST['hiddval'];$i++) {
							$path=rootpth()."horseadditionalimage";
							$randno=rand(4563,478962);
							if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
								$insert_sql="INSERT INTO tbl_horseimages SET horse_id=".$horse_id.",image='".$randno.$_FILES['image_'.$i]['name']."'";
								$this->Horse->query($insert_sql) ;
							}	
						}	
					}	
				}	
			$delsql=" UPDATE tbl_horsesubscriptions SET yesstatus='Y' WHERE horse_id=".$horse_id;
			$this->User->query($delsql) ;			
			
			if(isset($_POST['mainimg'])) {
				foreach($_POST['mainimg'] as $key=>$value) {
					$image_id=$value;
				}			
				$path=rootpth().'/horseimage';		
				$horsearr=$this->Horse->FindAll("id=".$horse_id);
				$oldimage=$horsearr[0]['Horse']['image'] ;
				$additioimage_sql="SELECT * FROM tbl_horseimages Horseimage WHERE id=".$image_id ;
				$additionaimagearr=$this->Horse->query($additioimage_sql) ;
				$image=$additionaimagearr[0]['Horseimage']['image'] ;
				
				
				$path=rootpth().'/horseimage/';		
				@copy(rootpth().'horseadditionalimage/'.$image,$path.'/'.$image);	  
				$update_sql="UPDATE tbl_horses SET image='".$image."' WHERE id=".$horse_id ;
				$this->Horse->query($update_sql);
				
				//@copy(rootpth().'tmp_offerupload/'.$this->Session->Read('tmp_propertyupload_1'),$path.'/'.$uploadpurchase_file);
				
				$path=rootpth().'/horseadditionalimage';
				@copy(rootpth().'horseimage/'.$oldimage,$path.'/'.$oldimage);
				
				$updateadd_sql="UPDATE tbl_horseimages SET image='".$oldimage."' WHERE id=".$image_id;
				$this->Horse->query($updateadd_sql) ;
				//die();
			}			
			$this->redirect('/horse/mylistedhorsefreemember');
		}		
		$this->set('useridarr',$useridarr);
		$this->set('horse_id',$horse_id);		
	}
	function addiimagedel($image=NULL,$id=NULL) {
		$this->Horseimage->id=$id;
		$this->Horseimage->delete();
		if(@unlink(rootpth()."horseadditionalimage/".$image)) {	
		}
		$this->redirect($this->referer());
	}	
	function stablename($stable_id=NULL) {
		return $this->Stable->FindByid($stable_id);	
	}	
	function addimageforedit() {
		if(is_numeric($_POST['hiddval'])) {
			if($_POST['hiddval']>0) {
				for($i=1;$i<=$_POST['hiddval'];$i++) {
					$path=rootpth()."horseadditionalimage";
					$randno=rand(4563,478962);
					if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
						$insert_sql="INSERT INTO tmp_horse_image_upload SET session_id='".session_id()."',image='".$randno.$_FILES['image_'.$i]['name']."'";
						$this->Horse->query($insert_sql) ;
					}	
				}	
			}	
		}
		$this->redirect($this->referer());
	}
	
	function listoffspring($horsename=NULL) {
		parent::blanklayout();
		$horselistarr=$this->Horse->FindAll("name  LIKE '".$horsename."%' AND approve_stat='Y' ");
		self::set('listhorst',$horselistarr);
	}	
	function search($searchname=NULL) {
		parent::blanklayout();
		$productlist_sql='';
		$cond='1';
		$search='';
		if(trim(@$_GET['search'])) {
			if(@$_GET['search']=="Search"){
				$search='';
			}
			else {
				$search=$_GET['search'];
				$cond.=" AND name  LIKE '%".$search."%'";
			}			
		}
		$listarr_arr=$this->Horse->FindAll($cond."  AND approve_stat='Y'"); 
		$this->set('listarr_arr',$listarr_arr);		
		$limit=setlimit();
		if(@$_GET['page']==''||@$_GET['page']==1) {
			$page=1;
			$productlist_sql.=" LIMIT 0,".$limit ;
		}
		else {
			$page=$_GET['page'];
			$limval=($page-1)*$limit;
			$productlist_sql.=" LIMIT ".$limval.",".$limit; 
		}
		$prodlist_arr_disp=$this->Horse->FindAll($cond." AND approve_stat='Y' ".$productlist_sql);
		$this->set('horslistarr',$prodlist_arr_disp);	
		$this->set('search',@$_GET['search']);	
		$pagistr='';
		$pagelink=pagelinkname();
		if(ceil(count($listarr_arr)/$limit)>1) {
			for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
				if($i==$page) {
					$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
								<li class="gap"></li>';
				}
				else {
				    	$pagistr.='<li><a href='.$pagelink.'/horse/search?page='.$i.'&search='.$search.'>'.$i.'</a></li>
									<li class="gap"></li>' ;
				}
			}
		}
		$nextpage=''; 
		$prevpage='';
		if($page<ceil(count($listarr_arr)/$limit)) {
			$nextpageval=$page+1;
			$nextpage.='<a class=text href='.$pagelink.'/horse/search?page='.$nextpageval.'&search='.$search.'>next</a>' ;
		}
		if($page>1){	
			$decrepageval=$page-1;
			$prevpage.='<a class=text href='.$pagelink.'/horse/search?page='.$decrepageval.'&search='.$search.'>previous</a>' ;
		}
		$this->set('pagistr',$pagistr);
		$this->set('nextpage',$nextpage);
		$this->set('prevpage',$prevpage);	
	}	
	function details($horsename=NULL,$horseid=NULL) {
		error_reporting(0);
		if($horseid=="") {
			$horseid=$horsename;
		}
		parent::blanklayout();
		$horsearr=$this->Horse->FindById($horseid);
		$userid=$this->Session->Read("userid") ; 
		if($userid) {
			$userdetails_arr=$this->User->FindByid($userid) ;
			$this->set('userdetails_arr',$userdetails_arr);
		}
		$usertype=$this->Session->Read("usertype") ;
		$this->set('usertype',$usertype);
		$salesstatus='';
		$salecount='';
		$this->set('userid',$userid);
		$this->set('horsearr',$horsearr);
		$offspingarr=$this->Horse->Findall("sire_id='".$horseid."' OR dam_id ='".$horseid."'");
		$this->set('offspingarr',$offspingarr);	
		if($horsearr['Horse']['sire_id']!="" && $horsearr['Horse']['dam_id']!="") {			
			$siblings_sql="SELECT * FROM tbl_horses Horse WHERE (sire!='' OR dam!='') AND (sire='".$horsearr['Horse']['sire']."') OR (sire='".$horsearr['Horse']['dam']."' OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['dam']."')) AND id!=".$horseid;
			$siblingsarr=$this->Horse->query($siblings_sql);
		}		
		if($horsearr['Horse']['sire_id']!="" && $horsearr['Horse']['dam_id']=="") {			
			$siblings_sql="SELECT * FROM tbl_horses Horse WHERE 1 AND sire_id=".$horsearr['Horse']['sire_id']." AND id!=".$horseid;
			$siblingsarr=$this->Horse->query($siblings_sql);
		}		
		if($horsearr['Horse']['sire_id']=="" && $horsearr['Horse']['dam_id']!="") {			
			$siblings_sql="SELECT * FROM tbl_horses Horse WHERE 1 AND dam_id=".$horsearr['Horse']['dam_id']." AND id!=".$horseid;
			$siblingsarr=$this->Horse->query($siblings_sql);
		}		
		$this->set('siblingsarr',$siblingsarr);		
		$horseimagearr=$this->Horseimage->FindAll('horse_id='.$horseid); 
		$this->set('horseimagearr',$horseimagearr);	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid);
		if($userid!="") {	
			$horseowerarr=$this->Horse->FindAll("ownerid=".$userid." AND id=".$horseid);
		}
		$this->set('horseowerarr',$horseowerarr);	
		$pricerangearr='';
		if($horsearr['Horse']['sales_status']!="S" || $horsearr['Horse']['sales_status']!="Stud") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horseid);
			$studcount=$this->Horseforstud->FindAll('horse_id='.$horseid);			
			if(count($salecount)>0 ||  count($studcount)>0) { 
				//$pricerangearr=$this->Pricerange->FindAll('id='.$salecount[0]['Horsesale']['pricerange_id']);
				$salesstatus='yes';
				$horsename=str_replace(" ", "-",$horsearr['Horse']['name']);
				$this->redirect('/horse/horsedetailsforsale/'.$horsename.'/'.$horseid);
			}		
		}	
		if($horsearr['Horse']['sire']!="") {
			$horsesirearr=$this->Horse->FindAll("name='".$horsearr['Horse']['sire']."'");
		}		
		if($horsearr['Horse']['dam']!="") {
			$horsedamarr=$this->Horse->FindAll("name='".$horsearr['Horse']['dam']."'");
		}	
		if($userid!="") {	
			$chk_arr=$this->Horsesubscription->FindAll("user_id=".$userid." AND horse_id=".$horseid);
		}
		else {
			$chk_arr='';		
		}
		$this->set('chk_arr',$chk_arr);		
		$this->set('horsedamarr',$horsedamarr);		
		$this->set('horsedamarr',$horsedamarr);		
		$this->set('pricerangearr',$pricerangearr);		
		$this->set('horsesirearr',$horsesirearr);
		$this->set('salesstatus',$salesstatus);
		$this->set('salecount',$salecount);
		$this->set('horseid',$horseid);
	}	
	function firsrsirenamelist($sirename=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$sirename."'");
		return $listsirearr;
	}
	function firstdamelist($damname=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$damname."' LIMIT 0,2");
		return $listsirearr;
	}
	function secondsirearr($sirename=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND sire='".$sirename."' LIMIT 0,4");
		return $listsirearr;
	}	
	function seconddamarr($damname=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND dam='".$sirename."' LIMIT 0,4");
		return $listsirearr;
	}
	function firsthirerchysiredam($name=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$name."'");
		return $listsirearr;
	}	
	function firsthirerchysiredam2($name=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$name."'");
		return $listsirearr;
	}
	function viewhorseprifile($horsename=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$horsename."'");
		return $listsirearr;
	}
	function firsthirerchysiredam3($name=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$name."'");
		return $listsirearr;
	}
	function firsthirerchysiredam4($name=NULL) {
		$listsirearr=$this->Horse->FindAll("approve_stat='Y' AND name='".$name."'");
		return $listsirearr;
	}
	function coatcolor($coarcolorid=NULL) {
		$this->Coatcolor->id=$coarcolorid;
		$coatcolorarr=$this->Coatcolor->Read();
		return $coatcolorarr['Coatcolor']['color'];		
	}	
	function heightval($heightid=NULL) {
		$this->Height->id=$heightid;
		$heightarr=$this->Height->Read();
		return $heightarr['Height']['height'];		
	}	
	function findahorse() {
		error_reporting(0);
		parent::blanklayout();	
		if($_GET['searchby']=="stable") {
			$this->redirect('/horse/findstable?searchby=stable&search='.$_GET['search']);
		}
		if($_GET['searchby']=="member") {
			$this->redirect('/horse/findamembers?searchby=member&search='.$_GET['search']);
		}
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);	
		$state_arr='';
		$town_arr='';
		$statestatearr='';
		$memberstatearr='';
		$membertownarr='';
		
		if($_GET['countrystable']!="") {
			$statestatearr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['countrystable']);
		}	
		if($_GET['stablestate']!="") {
			$stabletownarr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['stablestate']);
		}			
		if($_GET['country_id']!="") {
			$state_arr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['country_id']);
		}	
		if($_GET['membercountry']!="") {
			$memberstatearr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['membercountry']);
		}		
		if($_GET['state_id']!="") {
			$town_arr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['state_id']);
		}
		if($_GET['memberstate']!="") {
			$membertownarr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['memberstate']);
		}
		$this->set('memberstatearr',$memberstatearr);	
		$this->set('membertownarr',$membertownarr);	
		$this->set('memberstate',$_GET['memberstate']);	
		$this->set('membercountry',$_GET['membercountry']);		
		$this->set('town_arr',$town_arr);			
		$this->set('state_arr',$state_arr);
		$this->set('state_arr',$state_arr);
		$this->set('statestatearr',$statestatearr);		
		$this->set('stabletownarr',$stabletownarr);				
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);			
		$searchcondition='';
		$searchcriteria='';
		$pagelink='';
		$pagelink.=$_GET['searchby'];
		$searchcriteria='Horse';		
		if(@isset($_GET['horsesearch'])||$_GET['horsesearch']=="" || $_GET['search']!="" || $_GET['searchby']=="horse") {
			$searchcondition='yes';
			$searchcriteria='Horse';
			$searchingwith='Horse';			
			$pagelink.='&horsesearch='.$_GET['horsesearch'];
			    $sql= "SELECT * FROM tbl_horses Horse 
				LEFT JOIN tbl_stables Stable  ON Stable.id = Horse.stable_id
				LEFT JOIN tbl_users User ON User.id = Horse.ownerid
				WHERE 1 AND Horse.approve_stat='Y'"  ;				
				if($_GET['searchby']=="horse") {
					if($_GET['search']!="Search") {
						$sql.= " AND Horse.name LIKE '%".$_GET['search']."%'";	
						$pagelink.='&search='.$_GET['search'];	
					}
				}
				if(isset($_GET['horsename'])|| $_GET['search']!="Search") {					
					if($_GET['horsename']!="") {
						 $horsename=$_GET['horsename'];
					}
					else {
						$horsename=$_GET['search'];
					}					
					if($horsename!="Enter name") {
						$sql.= " AND Horse.name LIKE '%".$horsename."%' ";		
						$pagelink.='&horsename='.$horsename;	
					}	
				}	
				if(@$_GET['registeredstatus']!="") {					
					$registeredstatus=$_GET['registeredstatus'];
					$sql.= " AND Horse.registered ='".$registeredstatus."'";		
					$pagelink.='&registeredstatus='.$registeredstatus;		
				}								
				if(@$_GET['gender']!="") {					
					$gender=$_GET['gender'];
					$sql.= " AND Horse.gender ='".$gender."'";		
					$pagelink.='&gender='.$gender;		
				}
				if(@$_GET['height']!="") {					
					$height=$_GET['height'];
					$sql.= " AND Horse.height_id ='".$height."'";		
					$pagelink.='&height='.$height;		
				}
				if(@$_GET['age']!="") {		
					 $currentyear=date("Y");			
					 $findyear=$currentyear-$_GET['age'];				
					 $sql.= " AND Horse.year='".$findyear."'";		
					 $pagelink.='&age='.$_GET['age'];						
				}
				if(@$_GET['breed']!="") {					
					$breed=$_GET['breed'];
					$sql.= " AND Horse.breed_id ='".$breed."'";		
					$pagelink.='&breed='.$breed;		
				}	
				if(@$_GET['color']!="") {					
					$color=$_GET['color'];
					$sql.= " AND Horse.coatcolor_id ='".$color."'";		
					$pagelink.='&color='.$color;		
				}
				if(isset($_GET['breedname'])) {					
					$breedname=$_GET['breedname'];
					if($breedname!="Enter name") {
						$sql.= " AND Horse.breeder LIKE '%".$breedname."%'";		
						$pagelink.='&breedname='.$breedname;	
					}	
				}
				if(isset($_GET['ownername'])) {					
					$ownername=$_GET['ownername'];
					if($ownername!="Enter name") {
						$sql.= " AND Horse.ownername LIKE '%".$ownername."%'";						
						$pagelink.='&ownername='.$ownername;	
					}	
				}
				if($_GET['country_id']!="") {					
					 $country_id=$_GET['country_id'];
					if($country_id!="") {
						$sql.= " AND Horse.countryid=".$country_id;		
						$pagelink.='&country_id='.$country_id;	
					}	
				}
				if($_GET['state_id']!="") {					
					 $state_id=$_GET['state_id'];
					if($state_id!="") {
						$sql.= " AND Horse.state_id=".$state_id;		
						$pagelink.='&state_id='.$state_id;	
					}	
				}				
				if($_GET['town_id']!="") {					
					 $town_id=$_GET['town_id'];
					if($town_id!="") {
						$sql.= " AND Horse.town_id=".$town_id;		
						$pagelink.='&town_id='.$town_id;	
					}	
				}				
				if($_GET['sire']!="") {					
					 $sire=$_GET['sire'];
					if($sire!="Enter name") {
						$sql.= " AND Horse.sire LIKE '%".$sire."%'";
						$pagelink.='&sire='.$sire;	
					}	
				}				
				if($_GET['dam']!="") {					
					 $dam=$_GET['dam'];
					if($dam!="Enter name") {
						$sql.= " AND Horse.dam LIKE '%".$dam."%'";
						$pagelink.='&dam='.$dam;	
					}	
				}						
				if(@$_GET['age']!="") {		
					 $currentyear=date("Y");			
					 $findyear=$currentyear-$_GET['age'];				
					 $sql.= " AND Horse.year='".$findyear."'";		
					 $pagelink.='&age='.$_GET['age'];						
				}	
			
			$sql.=" ORDER BY Horse.id desc ";
			$listarr_arr=$this->Horse->query($sql);		
			$this->set('listarr_arr',$listarr_arr);				
			$limit=setlimit();
			if(@$_GET['page']==''||@$_GET['page']==1) {
				$page=1;
				$sql.=" LIMIT 0,".$limit ;
			}
			else {
				$page=$_GET['page'];
				$limval=($page-1)*$limit;
				$sql.=" LIMIT ".$limval.",".$limit; 
			}
			$prodlist_arr_disp=$this->Horse->query($sql);
			$this->set('horslistarr',$prodlist_arr_disp);	
			$this->set('search',@$_GET['search']);	
			$pagistr='';
			$mainlink=pagelinkname();
			if(ceil(count($listarr_arr)/$limit)>1) {
				for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
					if($i==$page) {
						$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
									<li class="gap"></li>';
					}
					else {
							$pagistr.='<li><a href='.$mainlink.'/horse/findahorse?page='.$i.$pagelink.'>'.$i.'</a></li>
										<li class="gap"></li>' ;
					}
				}
			}
			$nextpage='';
			$prevpage='';
			if($page<ceil(count($listarr_arr)/$limit)) {
				$nextpageval=$page+1;
				$nextpage.='<a class=text href='.$mainlink.'/horse/findahorse?page='.$nextpageval.$pagelink.'>next</a>' ;
			}
			if($page>1){	
				$decrepageval=$page-1;
				$prevpage.='<a class=text href='.$mainlink.'/horse/findahorse?page='.$decrepageval.$pagelink.'>previous</a><li class="gap"></li>' ;
			}
			$this->set('pagistr',$pagistr);
			$this->set('nextpage',$nextpage);
			$this->set('prevpage',$prevpage);		
		}
		if(isset($_GET['stablesearch'])|| $_GET['searchby']=="stable") {
			$searchcondition='yes';
			$searchcriteria='Stable';
			$pagelink.='&stablesearch='.$_GET['stablesearch'];
			$sql= "SELECT * FROM tbl_stables Stable WHERE 1 AND Stable.status='Y'"  ;	
			if($_GET['searchby']=="stable") {
				if($_GET['search']!="Search") {
					$sql.= " AND Stable.stable_name LIKE '%".$_GET['search']."%'";	
					$pagelink.='&search='.$_GET['search'];	
				}
			}					
			if(isset($_GET['stablename'])) {					
				$stablename=$_GET['stablename'];
				if($stablename!="enter stable name") {
					$sql.= " AND Stable.stable_name LIKE '%".$stablename."%'";		
					$pagelink.='&stablename='.$stablename;	
				}	
			}	
			if($_GET['countrystable']!="") {					
				$countrystable=$_GET['countrystable'];
				$sql.= " AND Stable.country_id=".$countrystable;		
				$pagelink.='&countrystable='.$countrystable;					
			}	
			if($_GET['stablestate']!="") {					
				$stablestate=$_GET['stablestate'];
				$sql.= " AND Stable.state_id=".$stablestate;		
				$pagelink.='&stablestate='.$stablestate;					
			}
			if($_GET['stabletownid']!="") {					
				$stabletownid=$_GET['stabletownid'];
				$sql.= " AND Stable.town_id=".$stabletownid;		
				$pagelink.='&stabletownid='.$stabletownid;					
			}			
			if($_GET['state_id']!="") {					
				$state_id=$_GET['state_id'];
				$sql.= " AND Stable.state_id=".$state_id;		
				$pagelink.='&state_id='.$state_id;					
			}
			
			if($_GET['countrystable']!="") {
				$countrystable=$_GET['countrystable'];
				$sql.= " AND Stable.country_id =".$countrystable;
				$pagelink.='&countrystable='.$countrystable;			
			}
			$listarr_arr=$this->Horse->query($sql);		
			$this->set('listarr_arr',$listarr_arr);		
			$limit=setlimit();
			if(@$_GET['page']==''||@$_GET['page']==1) {
				$page=1;
				$sql.=" LIMIT 0,".$limit ;
			}
			else {
				$page=$_GET['page'];
				$limval=($page-1)*$limit;
				$sql.=" LIMIT ".$limval.",".$limit; 
			}
			$prodlist_arr_disp=$this->Horse->query($sql);
			$this->set('horslistarr',$prodlist_arr_disp);	
			$pagistr='';
			$mainlink=pagelinkname();
			if(ceil(count($listarr_arr)/$limit)>1) {
				for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
					if($i==$page) {
						$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
									<li class="gap"></li>';
					}
					else {
						$pagistr.='<li><a href='.$mainlink.'/horse/findahorse?page='.$i.$pagelink.'>'.$i.'</a></li>
								   <li class="gap"></li>' ;
					}
				}
			}
			$nextpage='';
			$prevpage='';
			if($page<ceil(count($listarr_arr)/$limit)) {
				$nextpageval=$page+1;
				$nextpage.='<a class=text href='.$mainlink.'/horse/findahorse?page='.$nextpageval.$pagelink.'>next</a>' ;
			}
			if($page>1){	
				$decrepageval=$page-1;
				$prevpage.='<a class=text href='.$mainlink.'/horse/findahorse?page='.$decrepageval.$pagelink.'>previous</a>&nbsp;' ;
			}
			$this->set('pagistr',$pagistr);
			$this->set('nextpage',$nextpage);
			$this->set('prevpage',$prevpage);							
		}	
		if(isset($_GET['breedersearch'])||$_GET['searchby']=="member") {
			$searchcondition='yes';			
			$searchcriteria='Member';
			$pagelink.='&breedersearch='.$_GET['breedersearch'];			
			$sql= "SELECT * FROM tbl_users User WHERE 1 AND User.login_stat='Y'"  ;			
			if(isset($_GET['breedername'])) {					
				$breedername=$_GET['breedername'];
				if($breedername!="enter breeder name") {
					$sql.= " AND User.firstname LIKE '%".$breedername."%'";		
					$pagelink.='&breedername='.$breedername;	
				}	
			}	
			if($_GET['searchby']=="member") {
				if($_GET['search']!="Search") {
					$sql.= " AND CONCAT(User.firstname,' ',User.lastname) LIKE '%".str_replace("+", " ",$_GET['search'])."%'";
					$pagelink.='&search='.$_GET['search'];	
				}
			}
			if($_GET['membercountry']!="") {					
				$membercountry=$_GET['membercountry'];
				$sql.= " AND User.countryid=".$membercountry;		
				$pagelink.='&membercountry='.$membercountry;					
			}			
			if($_GET['memberstate']!="") {					
				$memberstate=$_GET['memberstate'];
				$sql.= " AND User.state_id=".$memberstate;		
				$pagelink.='&memberstate='.$memberstate;					
			}
			if($_GET['membertown']!="") {					
				$membertown=$_GET['membertown'];
				$sql.= " AND User.town_id=".$membertown;		
				$pagelink.='&membertown='.$membertown;					
			}		
			$listarr_arr=$this->Horse->query($sql);		
			$this->set('listarr_arr',$listarr_arr);		
			$limit=setlimit();
			if(@$_GET['page']==''||@$_GET['page']==1) { 
				$page=1;
				$sql.=" LIMIT 0,".$limit ;
			}
			else {
				$page=$_GET['page'];
				$limval=($page-1)*$limit;
				$sql.=" LIMIT ".$limval.",".$limit; 
			}
			$prodlist_arr_disp=$this->Horse->query($sql);
			$this->set('horslistarr',$prodlist_arr_disp);	
			$pagistr='';
			$mainlink=pagelinkname();
			if(ceil(count($listarr_arr)/$limit)>1) {
				for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
					if($i==$page) {
						$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
									<li class="gap"></li>';
					}
					else {
							$pagistr.='<li><a href='.$mainlink.'/horse/findahorse?page='.$i.$pagelink.'>'.$i.'</a></li>
										<li class="gap"></li>' ;
					}
				}
			}
			$nextpage='';
			$prevpage='';
			if($page<ceil(count($listarr_arr)/$limit)) {
				$nextpageval=$page+1;
				$nextpage.='<a class=text href='.$mainlink.'/horse/findahorse?page='.$nextpageval.$pagelink.'>next</a>' ;
			}
			if($page>1){	
				$decrepageval=$page-1;
				$prevpage.='<a class=text href='.$mainlink.'/horse/findahorse?page='.$decrepageval.$pagelink.'>previous</a>&nbsp;' ;
			}
			$this->set('pagistr',$pagistr);
			$this->set('nextpage',$nextpage);
			$this->set('prevpage',$prevpage);							
		
			//e("breedersearch");		
		}
		if($_GET['search']!="") {
			 $horsename=$_GET['search'];
		}
		else {
			 $horsename=$_GET['horsename'];
		}	
		$this->set('countrystable',$countrystable);	
		$this->set('countrymember',$countrymember);	
		$this->set('searchcondition',$searchcondition);	
		$this->set('horsename',$horsename);	
		$this->set('breed',$_GET['breed']);		
		$this->set('age',$_GET['age']);	
		$this->set('height',$_GET['height']);	
		$this->set('color',$_GET['color']);	
		$this->set('ownername',$_GET['ownername']);
		$this->set('breedname',$_GET['breedname']);
		$this->set('location',$_GET['location']);	
		$this->set('stablename',$_GET['stablename']);	
		$this->set('stablelocation',$_GET['stablelocation']);	
		$this->set('breedername',$_GET['breedername']);	
		$this->set('breederlocation',$_GET['breederlocation']);	
		$this->set('gender',$_GET['gender']);
		$this->set('sire',$_GET['sire']);	
		$this->set('dam',$_GET['dam']);	
		$this->set('searchcriteria',$searchcriteria);	
		$this->set('searchingwith',$searchingwith);	
		$this->set('country_id',$_GET['country_id']);
		$this->set('state_id',$_GET['state_id']);
		$this->set('town_id',$_GET['town_id']);
		$this->set('stablestate',$_GET['stablestate']);
		$this->set('stabletownid',$_GET['stabletownid']);
		$this->set('registeredstatus',$_GET['registeredstatus']);
		$this->set('age',$_GET['age']);
	}
	function horsesearchresult() {
	
	}
	function findamembers() {		
		error_reporting(0);
		parent::blanklayout();	
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);	
		$state_arr='';
		$town_arr='';
		$statestatearr='';
		$memberstatearr='';
		$membertownarr='';
		if($_GET['countrystable']!="") {
			$statestatearr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['countrystable']);
		}	
		if($_GET['stablestate']!="") {
			$stabletownarr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['stablestate']);
		}			
		if($_GET['country_id']!="") {
			$state_arr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['country_id']);
		}	
		if($_GET['membercountry']!="") {
			$memberstatearr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['membercountry']);
		}		
		if($_GET['state_id']!="") {
			$town_arr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['state_id']);
		}
		if($_GET['memberstate']!="") {
			$membertownarr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['memberstate']);
		}
		$this->set('memberstatearr',$memberstatearr);	
		$this->set('membertownarr',$membertownarr);	
		$this->set('memberstate',$_GET['memberstate']);	
		$this->set('membercountry',$_GET['membercountry']);		
		$this->set('town_arr',$town_arr);			
		$this->set('state_arr',$state_arr);
		$this->set('state_arr',$state_arr);
		$this->set('statestatearr',$statestatearr);		
		$this->set('stabletownarr',$stabletownarr);				
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);			
		$searchcondition='';
		$searchcriteria='';
		$pagelink='';
		$pagelink.=$_GET['searchby'];
		$searchcriteria='Member';		
		if(isset($_GET['breedersearch'])||$_GET['searchby']=="member" || $_GET['searchby']=="") {
			$searchcondition='yes';			
			$searchcriteria='Member';
			$pagelink.='&breedersearch='.$_GET['breedersearch'];			
			$sql= "SELECT * FROM tbl_users User WHERE 1 AND User.login_stat='Y'"  ;			
			if(isset($_GET['breedername'])) {					
				$breedername=$_GET['breedername'];
				if($breedername!="enter breeder name") {
					$sql.= " AND User.firstname LIKE '%".$breedername."%'";		
					$pagelink.='&breedername='.$breedername;	
				}	
			}	
			if($_GET['searchby']=="member") {
				if($_GET['search']!="Search") {
					$sql.= " AND CONCAT(User.firstname,' ',User.lastname) LIKE '%".str_replace("+", " ",$_GET['search'])."%'";
					$pagelink.='&search='.$_GET['search'];	
				}
			}
			if($_GET['membercountry']!="") {					
				$membercountry=$_GET['membercountry'];
				$sql.= " AND User.countryid=".$membercountry;		
				$pagelink.='&membercountry='.$membercountry;					
			}			
			if($_GET['memberstate']!="") {					
				$memberstate=$_GET['memberstate'];
				$sql.= " AND User.state_id=".$memberstate;		
				$pagelink.='&memberstate='.$memberstate;					
			}
			if($_GET['membertown']!="") {					
				$membertown=$_GET['membertown'];
				$sql.= " AND User.town_id=".$membertown;		
				$pagelink.='&membertown='.$membertown;					
			}		
			$listarr_arr=$this->Horse->query($sql);		
			$this->set('listarr_arr',$listarr_arr);		
			$limit=setlimit();
			if(@$_GET['page']==''||@$_GET['page']==1) {
				$page=1;
				$sql.=" LIMIT 0,".$limit ;
			}
			else {
				$page=$_GET['page'];
				$limval=($page-1)*$limit;
				$sql.=" LIMIT ".$limval.",".$limit; 
			}
			$prodlist_arr_disp=$this->Horse->query($sql);
			$this->set('horslistarr',$prodlist_arr_disp);	
			$pagistr='';
			$mainlink=pagelinkname();
			if(ceil(count($listarr_arr)/$limit)>1) {
				for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
					if($i==$page) {
						$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
									<li class="gap"></li>';
					}
					else {
							$pagistr.='<li><a href='.$mainlink.'/horse/findamembers?page='.$i.$pagelink.'>'.$i.'</a></li>
										<li class="gap"></li>' ;
					}
				}
			}
			$nextpage='';
			$prevpage='';
			if($page<ceil(count($listarr_arr)/$limit)) { 
				$nextpageval=$page+1;
				$nextpage.='<a class=text href='.$mainlink.'/horse/findamembers?page='.$nextpageval.$pagelink.'>next</a>' ;
			}
			if($page>1){	
				$decrepageval=$page-1;
				$prevpage.='<a class=text href='.$mainlink.'/horse/findamembers?page='.$decrepageval.$pagelink.'>previous</a><li class="gap"></li>' ;
			}
			$this->set('pagistr',$pagistr);
			$this->set('nextpage',$nextpage);
			$this->set('prevpage',$prevpage);		
		}
		if($_GET['search']!="") {
			 $horsename=$_GET['search'];
		}
		else {
			 $horsename=$_GET['horsename'];
		}	
		$this->set('countrystable',$countrystable);	
		$this->set('countrymember',$countrymember);	
		$this->set('searchcondition',$searchcondition);	
		$this->set('horsename',$horsename);	
		$this->set('breed',$_GET['breed']);		
		$this->set('age',$_GET['age']);	
		$this->set('height',$_GET['height']);	
		$this->set('color',$_GET['color']);	
		$this->set('ownername',$_GET['ownername']);
		$this->set('breedname',$_GET['breedname']);
		$this->set('location',$_GET['location']);	
		$this->set('stablename',$_GET['stablename']);	
		$this->set('stablelocation',$_GET['stablelocation']);	
		$this->set('breedername',$_GET['breedername']);	
		$this->set('breederlocation',$_GET['breederlocation']);	
		$this->set('gender',$_GET['gender']);
		$this->set('sire',$_GET['sire']);		
		$this->set('searchcriteria',$searchcriteria);	
		$this->set('searchingwith',$searchingwith);	
		$this->set('country_id',$_GET['country_id']);
		$this->set('state_id',$_GET['state_id']);
		$this->set('town_id',$_GET['town_id']);
		$this->set('stablestate',$_GET['stablestate']);
		$this->set('stabletownid',$_GET['stabletownid']);	
	}		
	function findstable() {
		error_reporting(0);
		parent::blanklayout();	
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);	
		$state_arr='';
		$town_arr='';
		$statestatearr='';
		$memberstatearr='';
		$membertownarr='';
		if($_GET['countrystable']!="") {
			$statestatearr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['countrystable']);
		}	
		if($_GET['stablestate']!="") {
			$stabletownarr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['stablestate']);
		}			
		if($_GET['country_id']!="") {
			$state_arr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['country_id']);
		}	
		if($_GET['membercountry']!="") {
			$memberstatearr=$this->State->FindAll("status='Y' AND  country_id=".$_GET['membercountry']);
		}		
		if($_GET['state_id']!="") {
			$town_arr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['state_id']);
		}
		if($_GET['memberstate']!="") {
			$membertownarr=$this->Town->FindAll("status='Y' AND  state_id=".$_GET['memberstate']);
		}
		$this->set('memberstatearr',$memberstatearr);	
		$this->set('membertownarr',$membertownarr);	
		$this->set('memberstate',$_GET['memberstate']);	
		$this->set('membercountry',$_GET['membercountry']);		
		$this->set('town_arr',$town_arr);			
		$this->set('state_arr',$state_arr);
		$this->set('state_arr',$state_arr);
		$this->set('statestatearr',$statestatearr);		
		$this->set('stabletownarr',$stabletownarr);				
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);			
		$searchcondition='';
		$searchcriteria='';
		$pagelink='';
		$pagelink.=$_GET['searchby'];
		$searchcriteria='Stable';		
		if($_GET['searchby']=="stable"|| $_GET['searchby']=="") {
			$searchcondition='yes';
			$searchcriteria='Stable';
			$pagelink.='&stablesearch='.$_GET['stablesearch'];
			$sql= "SELECT * FROM tbl_stables Stable, tbl_users User WHERE 1 AND Stable.status='Y' AND 
				   User.id=Stable.userid "  ;	
			if($_GET['searchby']=="stable") {
				if($_GET['search']!="Search") {
					$sql.= " AND Stable.stable_name LIKE '%".$_GET['search']."%'";	
					$pagelink.='&search='.$_GET['search'];	
				}
			}					
			if(isset($_GET['stablename'])) {					
				$stablename=$_GET['stablename'];
				if($stablename!="enter stable name") {
					$sql.= " AND Stable.stable_name LIKE '%".$stablename."%'";		
					$pagelink.='&stablename='.$stablename;	
				}	
			}	
			if($_GET['countrystable']!="") {					
				$countrystable=$_GET['countrystable'];
				$sql.= " AND Stable.country_id=".$countrystable;		
				$pagelink.='&countrystable='.$countrystable;					
			}	
			if($_GET['stablestate']!="") {					
				$stablestate=$_GET['stablestate'];
				$sql.= " AND Stable.state_id=".$stablestate;		
				$pagelink.='&stablestate='.$stablestate;					
			}
			if($_GET['stabletownid']!="") {					
				$stabletownid=$_GET['stabletownid'];
				$sql.= " AND Stable.town_id=".$stabletownid;		
				$pagelink.='&stabletownid='.$stabletownid;					
			}			
			if($_GET['state_id']!="") {					
				$state_id=$_GET['state_id'];
				$sql.= " AND Stable.state_id=".$state_id;		
				$pagelink.='&state_id='.$state_id;					
			}
			
			if($_GET['countrystable']!="") {
				$countrystable=$_GET['countrystable'];
				$sql.= " AND Stable.country_id =".$countrystable;
				$pagelink.='&countrystable='.$countrystable;			
			}
			
			$listarr_arr=$this->Horse->query($sql);		
			$this->set('listarr_arr',$listarr_arr);		
			$limit=setlimit();
			if(@$_GET['page']==''||@$_GET['page']==1) {
				$page=1;
				$sql.=" LIMIT 0,".$limit ;
			}
			else {
				$page=$_GET['page'];
				$limval=($page-1)*$limit;
				$sql.=" LIMIT ".$limval.",".$limit; 
			}
			$prodlist_arr_disp=$this->Horse->query($sql);
			$this->set('horslistarr',$prodlist_arr_disp);	
			$pagistr='';
			$mainlink=pagelinkname();
			if(ceil(count($listarr_arr)/$limit)>1) {
				for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
					if($i==$page) {
						$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
									<li class="gap"></li>';
					}
					else {
						$pagistr.='<li><a href='.$mainlink.'/horse/findstable?page='.$i.$pagelink.'>'.$i.'</a></li>
								   <li class="gap"></li>' ;
					}
				}
			}
			$nextpage='';
			$prevpage='';
			if($page<ceil(count($listarr_arr)/$limit)) {
				$nextpageval=$page+1;
				$nextpage.='<a class=text href='.$mainlink.'/horse/findstable?page='.$nextpageval.$pagelink.'>next</a>' ;
			}
			if($page>1){	
				$decrepageval=$page-1;
				$prevpage.='<a class=text href='.$mainlink.'/horse/findstable?page='.$decrepageval.$pagelink.'>previous</a>' ;
			}
			$this->set('pagistr',$pagistr);
			$this->set('nextpage',$nextpage);
			$this->set('prevpage',$prevpage);							
		}	
		$this->set('countrystable',$countrystable);	
		$this->set('countrymember',$countrymember);	
		$this->set('searchcondition',$searchcondition);	
		$this->set('horsename',$horsename);	
		$this->set('breed',$_GET['breed']);		
		$this->set('age',$_GET['age']);	
		$this->set('height',$_GET['height']);	
		$this->set('color',$_GET['color']);	
		$this->set('ownername',$_GET['ownername']);
		$this->set('breedname',$_GET['breedname']);
		$this->set('location',$_GET['location']);	
		$this->set('stablename',$_GET['stablename']);	
		$this->set('stablelocation',$_GET['stablelocation']);	
		$this->set('breedername',$_GET['breedername']);	
		$this->set('breederlocation',$_GET['breederlocation']);	
		$this->set('gender',$_GET['gender']);
		$this->set('sire',$_GET['sire']);		
		$this->set('searchcriteria',$searchcriteria);	
		$this->set('searchingwith',$searchingwith);	
		$this->set('country_id',$_GET['country_id']);
		$this->set('state_id',$_GET['state_id']);
		$this->set('town_id',$_GET['town_id']);
		$this->set('stablestate',$_GET['stablestate']);
		$this->set('stabletownid',$_GET['stabletownid']);	
	}	
	function salehorse() {
		error_reporting(0);
		parent::blanklayout();	
		$height_arr=$this->Height->FindAll("status='Y'");
		$searchcondition='';
		$countryarr=$this->Country->FindAll("status='Y'");
		$this->set('countryarr',$countryarr);	
		$this->set('height_arr',$height_arr);	
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);		
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$genderarr=$this->Gender->FindAll();
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y'");
		$this->set('town_arr',$town_arr);		
		$this->set('genderarr',$genderarr);		
		$this->set('coatcolor_arr',$coatcolor_arr);
		if($_GET['country_id']!="") {
			$state_arr=$this->State->FindAll("country_id=".$_GET['country_id']." AND status='Y'") ;
			$this->set('state_arr',$state_arr);	
		}
		if($_GET['state_id']!="") {
			$town_arr=$this->Town->FindAll("state_id=".$_GET['state_id']." AND status='Y'") ;
			$this->set('town_arr',$town_arr);	
		}		
		$this->set('country_id',$_GET['country_id']);
		$this->set('state_id',$_GET['state_id']);
		$this->set('town_id',$_GET['town_id']);
		$pricerangearr=$this->Pricerange->Findall('status');
		$this->set('pricerangearr',$pricerangearr);
		//if(isset($_GET['search'])) {
			$searchcondition='yes';
			$pagelink='&search='.$_GET['search'];
			$sql="SELECT * FROM tbl_horses Horse LEFT JOIN tbl_horsesales Sale  ON 
				  Sale.horse_id = Horse.id  LEFT JOIN tbl_horseforstuds Stud ON Stud.horse_id = Horse.id WHERE 1 AND Horse.approve_stat='Y' AND Horse.deathstat='N'" ;
			if(@$_GET['gender']!="") {					
					$gender=$_GET['gender'];
					$sql.= " AND Horse.gender ='".$gender."'";		
					$pagelink.='&gender='.$gender;		
				}	
				if(@$_GET['height']!="") {					
					$height=$_GET['height'];
					$sql.= " AND Horse.height_id ='".$height."'";		
					$pagelink.='&height='.$height;		
				}
				if(@$_GET['breed']!="") {					
					$breed=$_GET['breed'];
					$sql.= " AND Horse.breed_id ='".$breed."'";		
					$pagelink.='&breed='.$breed;		
				}	
				if(@$_GET['color']!="") {					
					$color=$_GET['color'];
					$sql.= " AND Horse.coatcolor_id ='".$color."'";		
					$pagelink.='&color='.$color;		
				}
				if(@$_GET['sire']!="") {					
					$sire=$_GET['sire'];
					$sql.= " AND Horse.sire LIKE '%".$sire."%'";
					$pagelink.='&sire='.$sire;		
				}
				if(@$_GET['dam']!="") {					
					$dam=$_GET['dam'];
					$sql.= " AND Horse.dam LIKE '%".$dam."%'";
					$pagelink.='&dam='.$dam;		
				}
				if(@$_GET['country_id']!="") {					
					$country_id=$_GET['country_id'];
					$sql.= " AND Horse.countryid =".$country_id;
					$pagelink.='&country_id='.$country_id;		
				}
				if(@$_GET['state_id']!="") {					
					$state_id=$_GET['state_id'];
					$sql.= " AND Horse.state_id =".$state_id;
					$pagelink.='&state_id='.$state_id;		
				}				
				if(@$_GET['town_id']!="") {					
					$town_id=$_GET['town_id'];
					$sql.= " AND Horse.town_id =".$town_id;
					$pagelink.='&town_id='.$town_id;		
				}
				if(@$_GET['salestaus']!="") {					
					$salestaus=$_GET['salestaus'];
					if($salestaus=="S") {
						$salestaus="Sale";
						$sql.= " AND Sale.salesfor ='".$salestaus."'";		
						$pagelink.='&salestaus='.$salestaus;
					}
					if($salestaus=="Sale") {
						$salestaus="Sale";
						$sql.= " AND Sale.salesfor ='".$salestaus."'";		
						$pagelink.='&salestaus='.$salestaus;
					}
					if($salestaus=="Stud") {
						$salestaus="Stud";
						$sql.= " AND Stud.studstatus='Y'";
						$pagelink.='&salestaus='.$salestaus;
					}							
				}
				else {
					$salestaus="Sale" ;
					$sql.= " AND Sale.salesfor ='".$salestaus."'";		
					$pagelink.='&salestaus='.$salestaus;
				}
				if(@$_GET['age']!="") {		
					 $currentyear=date("Y");			
					 $findyear=$currentyear-$_GET['age'];				
					 $sql.= " AND Horse.year='".$findyear."'";		
					 $pagelink.='&age='.$_GET['age'];						
				}
				if(trim(@$_GET['price'])!="") {
					$price=$_GET['price'];
					$sql.= " AND Sale.pricerange_id=".$price;		
					$pagelink.='&price='.$price;	
				}
				if(@$_GET['location']!="") {			
					$location=$_GET['location'];
					if($location!="Enter name") {
						$sql.= " AND Horse.town_id=".$location;		
						$pagelink.='&location='.$location;	
					}	
				}	
			if($salestaus=="Sale") {						
				if(@$_GET['orderby']!='') {	
					if($_GET['orderby']=="posted_date") {
						$sql.= ' ORDER BY Sale.posted_date';
					}
					else {		
						$sql.= ' ORDER BY '. $_GET['orderby'];
					}
				}	
			}			
			if($salestaus=="Stud") {						
				if(@$_GET['orderby']!='') {	
					if($_GET['orderby']=="posted_date") {
						$sql.= ' ORDER BY Stud.posted_date';
					}
					else {		
						$sql.= ' ORDER BY '. $_GET['orderby'];
					}
				}	
			}			
			//e($sql);
			$listarr_arr=$this->Horse->query($sql);		
			$this->set('listarr_arr',$listarr_arr);		
			$this->set('salestaus',$_GET['salestaus']);		
			$limit=setlimit();
			if(@$_GET['page']==''||@$_GET['page']==1) {
				$page=1;
				$sql.=" LIMIT 0,".$limit ;
			}
			else {
				$page=$_GET['page'];
				$limval=($page-1)*$limit;
				$sql.=" LIMIT ".$limval.",".$limit; 
			}
			//e($sql);
			$prodlist_arr_disp=$this->Horse->query($sql);
			$this->set('horslistarr',$prodlist_arr_disp);	
			$pagistr='';
			$mainlink=pagelinkname();
			if(@$_GET['orderby']!='') {
				$pagelink.='&orderby='.$_GET['orderby'];
			}	
			if(ceil(count($listarr_arr)/$limit)>1) {
				for($i=1;$i<=ceil(count($listarr_arr)/$limit);$i++) {
					if($i==$page) {
						$pagistr.='<li><a href="javascript:void(0)" class="active12">'.$i.'</a></li>
									<li class="gap"></li>';
					}
					else {
							$pagistr.='<li><a href='.$mainlink.'/horse/salehorse?page='.$i.$pagelink.'>'.$i.'</a></li>
							<li class="gap"></li>' ;
					}
				}
			}
			$nextpage='';
			$prevpage='';
			if($page<ceil(count($listarr_arr)/$limit)) {
				$nextpageval=$page+1;
				$nextpage.='<a class=text href='.$mainlink.'/horse/salehorse?page='.$nextpageval.$pagelink.'>next</a>' ;
			}
			if($page>1){	
				$decrepageval=$page-1;
				$prevpage.='<a class=text href='.$mainlink.'/horse/salehorse?page='.$decrepageval.$pagelink.'>previous</a>' ;
			}
			$this->set('pagistr',$pagistr);
			$this->set('nextpage',$nextpage);
			$this->set('prevpage',$prevpage);				
		//}
		$this->set('searchcondition',$searchcondition);
		$this->set('gender',@$_GET['gender']);
		$this->set('breed',@$_GET['breed']);
		$this->set('age',@$_GET['age']);
		$this->set('price',@$_GET['price']);
		$this->set('location',@$_GET['location']);
		$this->set('salestaus',$salestaus);
		$this->set('orderby',@$_GET['orderby']);
		$this->set('color',@$_GET['color']);
		$this->set('pagelink',@$pagelink);	
	}	
	function chksalesstatus($horse_id=NULL) {
		$salecount=$this->Horsesale->FindAll('horse_id='.$horse_id);
		return $salecount;
	}	
	function chkstudstatussstatus($horse_id=NULL) {
		$salecount=$this->Horseforstud->FindAll('horse_id='.$horse_id);
		return $salecount;
	}
	function pricerange($pricerange_id=NULL) {
		return $this->Pricerange->FindByid($pricerange_id) ;
	}	
	function putforsale($horseid=NULL) {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$pricerangearr=$this->Pricerange->Findall("status='Y'");
		$this->set('pricerangearr',$pricerangearr);
		$userid=$this->Session->Read("userid") ;
		$useridarr=$this->Horse->FindAll('id='.$horseid);
		if($userid!=$useridarr[0]['Horse']['ownerid']) {
			$this->redirect('/horse/mylistedhorse');
		}	
		if($useridarr[0]['Horse']['sales_status']=="S") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horseid);
			if(count($salecount)>0) {
				//$this->redirect('/horse/alreadyforsale');
			}
		}
		if($useridarr[0]['Horse']['deathstat']=="Y") {
			$this->redirect('/horse/mylistedhorse');			
		}		
		if($useridarr[0]['Horse']['gender']=="3" || $useridarr[0]['Horse']['gender']=="2") {
			//$this->redirect('/horse/mylistedhorse');			
		}		
		$this->set('useridarr',$useridarr);
		if(!empty($this->data)) {
			$salesstatus="S";
			$this->Horse->id=$horseid;
			$this->data['Horsesale']['salesfor']="Sale" ;
			$this->data['Horse']['sales_status']=$salesstatus ;
			$this->Horse->Save($this->data);
			$this->data['Horsesale']['user_id']=$userid;
			$this->data['Horsesale']['horse_id']=$horseid;
			$this->data['Horsesale']['sales_status']='Y';
			$this->data['Horsesale']['posted_date']=date("Y-m-d");
			$this->Horsesale->save($this->data);
			$this->redirect('/horse/horsedetailsforsale/'.str_replace(" ", "-",$useridarr[0]['Horse']['name']).'/'.$horseid);
		}
	}	
	function salepostsuccess() {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
	}
	function alreadyforsale() {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
	}
	function myhorsesforsale() {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$userid=$this->Session->Read("userid") ;
		$listhorseforsale=$this->Horsesale->FindAll('user_id='.$userid." AND salesfor='Sale'");
		$this->set('listhorseforsale',$listhorseforsale);
	}	
	function myhorsesforstud() {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$userid=$this->Session->Read("userid") ;
		$list_stud_sql="SELECT * FROM tbl_horses Horse ,tbl_horseforstuds 	Horseforstud WHERE 	Horse.id=Horseforstud.horse_id AND Horseforstud.user_id=".$userid." ORDER BY Horseforstud.id DESC " ;
		$listhorseforsale=$this->Horseforstud->query($list_stud_sql);
		$this->set('listhorseforsale',$listhorseforsale);
	}	
	function horsedetails($horse_id=NULL) {
		return $this->Horse->FindByid($horse_id);
	}
	function gendername($genderid=NULL) {
		return $this->Gender->FindByid($genderid);
	}	
	function removeforsale($horseid=NULL,$salesid=NULL) {
		$this->Horse->id=$horseid;
		$this->data['Horse']['sales_status']='';
		$this->Horse->save($this->data);
		$this->Horsesale->id=$salesid;
		$this->Horsesale->delete();
		$this->redirect($this->referer());	
	}	
	function findusername($user_id=NULL) {
		return $this->User->FindByid($user_id);	
	}	
	function edithorseforsale($saleid=NULL) {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$pricerangearr=$this->Pricerange->Findall("status='Y'");
		$this->set('pricerangearr',$pricerangearr);
		$salesarr=$this->Horsesale->FindById($saleid);
		$hornamearr=$this->Horse->FindByid($salesarr['Horsesale']['horse_id']);
		$this->set('hornamearr',$hornamearr);
		$this->set('salesarr',$salesarr);
		if(!empty($this->data)) {
			$this->Horsesale->id=$saleid;
			$salesstatus="S";
			$this->data['Horse']['sales_status']=$salesstatus ;
			$this->Horse->id=$salesarr['Horsesale']['horse_id'];
			$this->Horse->Save($this->data);
			$this->Horsesale->save($this->data);
			$this->redirect('/horse/myhorsesforsale');
		}
	}	
	function edithorseforstud($saleid=NULL) {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$pricerangearr=$this->Pricerange->Findall("status='Y'");
		$this->set('pricerangearr',$pricerangearr);
		$salearr=$this->Horseforstud->FindByid($saleid);
		$this->set('salearr',$salearr);
		$userid=$this->Session->Read("userid") ;
		$useridarr=$this->Horse->FindAll('id='.$salearr['Horseforstud']['horse_id']);
		$this->set('useridarr',$useridarr);
		if(!empty($this->data)) {
			$this->Horse->id=$salearr['Horseforstud']['horse_id'];
			$this->data['Horse']['sales_status']='Stud';
			$this->Horse->save($this->data);			
			$this->data['Horseforstud']['contact_details']=$this->data['Horsesale']['contactdetails'] ;
			$this->data['Horseforstud']['stud_details']=$this->data['Horsesale']['salesdescription'] ;
			$this->data['Horseforstud']['pricerange_fromid']=$this->data['Horsesale']['pricerange_fromid'] ;
			$this->data['Horseforstud']['pricerange_toid']=$this->data['Horsesale']['pricerange_toid'] ;
			$this->Horseforstud->id=$saleid;
			$this->Horseforstud->save($this->data);			
			$this->redirect('/horse/myhorsesforstud');			
		}
	}	
	function putahorseforstud($horseid=NULL) {
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();
		$pricerangearr=$this->Pricerange->Findall("status='Y'");
		$this->set('pricerangearr',$pricerangearr);
		$userid=$this->Session->Read("userid") ;
		$useridarr=$this->Horse->FindAll('id='.$horseid);
		$this->set('useridarr',$useridarr);
		if(!empty($this->data)) {
			$this->Horse->id=$horseid;
			$this->data['Horse']['sales_status']='Stud';
			$this->Horse->save($this->data);
			$studinsert_sql="INSERT INTO tbl_horseforstuds SET horse_id=".$horseid.",user_id=".$userid.",	
						   contact_details='".addslashes($this->data['Horsesale']['contactdetails'])."',
						   stud_details='".addslashes($this->data['Horsesale']['salesdescription'])."',
						   posted_date =CURRENT_DATE(),
						   pricerange_fromid=".$this->data['Horsesale']['pricerange_fromid'].",
						   pricerange_toid=".$this->data['Horsesale']['pricerange_toid'] ;
						    ;
			$this->Horse->query($studinsert_sql) ;
			$this->redirect('/horse/myhorsesforstud');			
		}
	}
	
	function reasonofremoving($horseid=NULL,$salesid=NULL) { 
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();	
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$userid=$this->Session->Read("userid") ;
		$this->set('country_arr',$country_arr);
		$horsearr=$this->Horse->FindAll("id=".$horseid);
		$this->set('horsearr',$horsearr);
		if(!empty($this->data)) {
			$this->Horse->id=$horseid;
			$this->data['Horse']['sales_status']='';
			if($this->data['Salereason']['type']=="Sold") {
				if(@$_POST['hiddownerid']) {
					$this->data['Horse']['ownerid']=@$_POST['hiddownerid'];
				}				
				$this->data['Horse']['ownername']=$this->data['Horse']['ownername'] ;
				if(!empty($this->data['Horse']['stablename'])) {
					$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
					if(count($stablecountarr)>0) {
						$this->data['Horse']['stablename']=$this->data['Horse']['stablename'];
						$this->data['Horse']['stable_id']=$stablecountarr[0]['Stable']['id'];						
					}	
					else {
						$this->data['Horse']['stablename']=$this->data['Horse']['stablename'] ;
						$this->data['Horse']['stable_id']='';
					}	
					$this->data['Horse']['countryid']=$this->data['Horse']['countryid'] ;
					$this->data['Horse']['state_id']=$this->data['Horse']['state_id'] ;
					$this->data['Horse']['town_id']=$this->data['Horse']['town_id'] ;
				}	
			}
			$this->Horse->save($this->data);
			$this->Horsesale->id=$salesid;
			$this->Horsesale->delete();
			$userid=$this->Session->Read("userid") ;
			$insert_sql="INSERT INTO tbl_sale_remove_horse SET user_id=".$userid.",
						 horse_id=".$horseid.",sales_id=".$salesid.",reason_remove_sale='".$this->data['Salereason']['type']."',
						 reason='".$this->data['Salereason']['otherreason']."'";
			$this->Horsesale->query($insert_sql) ;
			$this->redirect('/horse/myhorsesforsale');
		}
	}
	function soldhorse() { 
		parent::blanklayout();
		parent::chkblanksession();
		parent::chkusertype();	
		$userid=$this->Session->Read("userid") ;
		$listsold_sql="SELECT * FROM tbl_sale_remove_horse Remove WHERE user_id=".$userid." AND reason_remove_sale ='Sold'";
		$listsold_arr=$this->Horse->query($listsold_sql) ;
		$this->set('listsold_arr',$listsold_arr);
	}		
	function listhorseindatabase($horsename=NULL) {
		parent::blanklayout();
		$horselistarr=$this->Horse->FindAll("name  LIKE '".$horsename."%' AND approve_stat='Y' ");
		self::set('listhorst',$horselistarr);
	}	
	function listsirehorsedatabase($horsename=NULL) {
		parent::blanklayout();
		$horselistarr=$this->Horse->FindAll("name  LIKE '".$horsename."%' AND approve_stat='Y' AND (gender=4 OR gender=2)");
		self::set('listhorst',$horselistarr);
	}	
	function listsirehorsedatabaseadmin($horsename=NULL) {
		parent::blanklayout();
		$horselistarr=$this->Horse->FindAll("name  LIKE '".$horsename."%' AND approve_stat='Y' AND (gender=4 OR gender=2)");
		self::set('listhorst',$horselistarr);
	}	
	function listdamhorsedatabase($horsename=NULL) {
		parent::blanklayout();
		$horselistarr=$this->Horse->FindAll("name  LIKE '".$horsename."%' AND approve_stat='Y' AND gender=3");
		self::set('listhorst',$horselistarr);
	}
	function listdamhorsedatabaseadmin($horsename=NULL) {
		parent::blanklayout();
		$horselistarr=$this->Horse->FindAll("name  LIKE '".$horsename."%' AND approve_stat='Y' AND gender=3");
		self::set('listhorst',$horselistarr);
	}
		
	function horsedetailsforsale($horsename=NULL,$horseid=NULL) { 
		error_reporting(0);
		if($horseid=="") {
			$horseid=$horsename;
		}
		parent::blanklayout();
		$horsearr=$this->Horse->FindById($horseid);
		$salesstatus='';
		$salecount='';
		$this->set('horsearr',$horsearr);		
		$studcountarr=$this->Horseforstud->FindAll("horse_id=".$horseid);
		$this->set('studcountarr',$studcountarr);		
		$salecountarr=$this->Horsesale->FindAll("horse_id=".$horseid);
		$this->set('salecountarr',$salecountarr);		
		$offspingarr=$this->Horse->Findall("sire_id='".$horseid."' OR dam_id ='".$horseid."'");
		$this->set('offspingarr',$offspingarr);		
		if($horsearr['Horse']['sire_id']!="" && $horsearr['Horse']['dam_id']!="") {			
			$siblings_sql="SELECT * FROM tbl_horses Horse WHERE (sire!='' OR dam!='') AND (sire='".$horsearr['Horse']['sire']."') OR (sire='".$horsearr['Horse']['dam']."' OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['sire']."') OR (dam='".$horsearr['Horse']['dam']."')) AND id!=".$horseid;
			$siblingsarr=$this->Horse->query($siblings_sql);
		}		
		if($horsearr['Horse']['sire_id']!="" && $horsearr['Horse']['dam_id']=="") {			
			$siblings_sql="SELECT * FROM tbl_horses Horse WHERE 1 AND sire_id=".$horsearr['Horse']['sire_id']." AND id!=".$horseid;
			$siblingsarr=$this->Horse->query($siblings_sql);
		}		
		if($horsearr['Horse']['sire_id']=="" && $horsearr['Horse']['dam_id']!="") {			
			$siblings_sql="SELECT * FROM tbl_horses Horse WHERE 1 AND dam_id=".$horsearr['Horse']['dam_id']." AND id!=".$horseid;
			$siblingsarr=$this->Horse->query($siblings_sql);
		}
		$this->set('siblingsarr',$siblingsarr);		
		$pricerangearr='';
		$horseimagearr=$this->Horseimage->FindAll('horse_id='.$horseid);
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid);
		if($userid!="") {	
			$horseowerarr=$this->Horse->FindAll("ownerid=".$userid." AND id=".$horseid);
		}
		$this->set('horseowerarr',$horseowerarr);	
		$this->set('horseimagearr',$horseimagearr);	
		$userid=$this->Session->Read("userid") ;
		if($horsearr['Horse']['sales_status']!="S" || $horsearr['Horse']['sales_status']!="Stud") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horseid);
			if(count($salecount)>0) {
				$pricerangefromarr=$this->Pricerange->FindAll('id='.$salecount[0]['Horsesale']['pricerange_fromid']);
				$pricerangetoarr=$this->Pricerange->FindAll('id='.$salecount[0]['Horsesale']['pricerange_toid']);
				$salesstatus='yes';
			}		
		}	
		if($horsearr['Horse']['sire']!="") {
			$horsesirearr=$this->Horse->FindAll("name='".$horsearr['Horse']['sire']."'");
		}		
		if($horsearr['Horse']['dam']!="") {
			$horsedamarr=$this->Horse->FindAll("name='".$horsearr['Horse']['dam']."'");
		}
		$this->set('horsedamarr',$horsedamarr);		
		$this->set('horsesirearr',$horsesirearr);
		$this->set('salesstatus',$salesstatus);
		$this->set('salecount',$salecount);
		$this->set('horseid',$horseid);
		$this->set('pricerangetoarr',$pricerangetoarr);
		$this->set('pricerangefromarr',$pricerangefromarr);
	}	
	function listallmember($membername=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("(firstname  LIKE '".$membername."%' OR lastname  LIKE '".$membername."%')  AND login_stat='Y'");
		$this->set('userarr',$userarr);
	}	
	function listownerall($membername=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("(firstname  LIKE '".$membername."%' OR lastname  LIKE '".$membername."%')  AND login_stat='Y'");
		$this->set('userarr',$userarr);
	}	
	function listownerallforadmin($membername=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("(firstname  LIKE '".$membername."%' OR lastname  LIKE '".$membername."%')  AND login_stat='Y'");
		$this->set('userarr',$userarr);
	}
	function listownerallremovesale($membername=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("(firstname  LIKE '".$membername."%' OR lastname  LIKE '".$membername."%')  AND login_stat='Y'");
		$this->set('userarr',$userarr);
	}	
	function liststableall($stablename=NULL) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindAll("stable_name  LIKE '".$stablename."%'  AND status='Y'"); 
		if(count($stablearr)<=0) {
			e("0");
			exit();
		}
		$this->set('stablearr',$stablearr);	
	}
	function liststablealladmin($stablename=NULL) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindAll("stable_name  LIKE '".$stablename."%'  AND status='Y'"); 
		if(count($stablearr)<=0) {
			e("0");
			exit();
		}
		$this->set('stablearr',$stablearr);	
	}
	
	function listallmemberadmin($membername=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("(firstname  LIKE '".$membername."%' OR lastname  LIKE '".$membername."%')  AND login_stat='Y'");
		$this->set('userarr',$userarr);
	}
	function liststableallremovesale($stablename=NULL) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindAll("stable_name  LIKE '".$stablename."%'  AND status='Y'");
		if(count($stablearr)<=0) {
			e("0");
			exit();
		}
		$this->set('stablearr',$stablearr);	
	}	
	function liststableallcountrytownn($stable_id) {
		parent::blanklayout();
		$stable_arr=$this->Stable->FindAll('id='.$stable_id);
		$country_arr=$this->Country->FindAll('id='.$stable_arr[0]['Stable']['country_id']);		
		$statearr=$this->State->FindAll("country_id=".$stable_arr[0]['Stable']['country_id']);
		$this->set('statearr',$statearr);
		$townarr=$this->Town->FindAll('state_id='.$stable_arr[0]['Stable']['state_id']);
		$this->set('country_arr',$country_arr);	
		$this->set('town_arr',$townarr);	
		$this->set('stable_arr',$stable_arr);			
	}
	
	function liststableallcountrytownnadmin($stable_id) {
		parent::blanklayout();
		$stable_arr=$this->Stable->FindAll('id='.$stable_id);
		$country_arr=$this->Country->FindAll('id='.$stable_arr[0]['Stable']['country_id']);		
		$statearr=$this->State->FindAll("country_id=".$stable_arr[0]['Stable']['country_id']);
		$this->set('statearr',$statearr);
		$townarr=$this->Town->FindAll('state_id='.$stable_arr[0]['Stable']['state_id']);
		$this->set('country_arr',$country_arr);	
		$this->set('town_arr',$townarr);	
		$this->set('stable_arr',$stable_arr);			
	}
	
	
	function liststableallcountrytownnforremove($stable_id) {
		parent::blanklayout();
		$stable_arr=$this->Stable->FindAll('id='.$stable_id);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$statearr=$this->State->FindAll('country_id='.$stable_arr[0]['Stable']['country_id']);
		$townarr=$this->Town->FindAll('state_id='.$stable_arr[0]['Stable']['state_id']);
		$this->set('country_arr',$country_arr);	
		$this->set('town_arr',$townarr);	
		$this->set('statearr',$statearr);
		$this->set('stable_arr',$stable_arr);				
	}		
	function listbredall($stablename) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindAll("stable_name  LIKE '".$stablename."%'  AND status='Y'");
		$this->set('stablearr',$stablearr);			
	}
	function listbredalladmin($stablename) {
		parent::blanklayout();
		$stablearr=$this->Stable->FindAll("stable_name  LIKE '".$stablename."%'  AND status='Y'");
		$this->set('stablearr',$stablearr);			
	}
	function subscribefornotification($horse_id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$msg='';
		$chk_arr=$this->Horsesubscription->FindAll("user_id=".$userid." AND horse_id=".$horse_id);
		if(count($chk_arr)>0) {
			$msg='<font color=#FF0000>You have already subscribed  </font>';
		}
		else {
			$this->data['Horsesubscription']['user_id']=$userid;
			$this->data['Horsesubscription']['horse_id']=$horse_id;
			$this->Horsesubscription->save($this->data);
			$msg='<font color=#FF0000>You have successfully subscribed </font>';
		}
		$this->set('msg',$msg);	
	}	
	function unsubscribefornotification($horse_id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$msg='';
		$chk_arr=$this->Horsesubscription->FindAll("user_id=".$userid." AND horse_id=".$horse_id);
		if(count($chk_arr)<=0) {
			$msg='<font color=#FF0000>You have not subscribed </font>';
		}
		else {
			$del_sql="DELETE FROM tbl_horsesubscriptions WHERE user_id=".$userid." AND horse_id=".$horse_id;
			$this->Horsesubscription->query($del_sql) ;
			$msg='<font color=#FF0000>You have successfully unsubscribed </font>';
		}
		$this->set('msg',$msg);
	}	
	function changerequest($horse_id=NULL) {
		error_reporting(0);
		parent::blanklayout();
		parent::chkblanksession();
		$salesstatus='';
		$useridarr=$this->Horse->FindAll('id='.$horse_id);
		$tmp_sql="SELECT  * FROM tmp_horse_image_upload Tmp WHERE session_id='".session_id()."'";
		$tmp_image_arr=$this->Horse->query($tmp_sql) ;
		$this->set('tmp_image_arr',$tmp_image_arr);
		$stablearr=$this->Stable->FindAll("status='Y'");
		$this->set('stablearr',$stablearr);
		$breed_arr=$this->Breed->FindAll("status='Y'");
		$this->set('breed_arr',$breed_arr);
		$height_arr=$this->Height->FindAll("status='Y'");
		$this->set('height_arr',$height_arr);	
		$genderarr=$this->Gender->FindAll();
		$this->set('genderarr',$genderarr);	
		$coatcolor_arr=$this->Coatcolor->FindAll("status='Y'");
		$this->set('coatcolor_arr',$coatcolor_arr);		
		$userid=$this->Session->Read("userid") ;
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$useridarr[0]['Horse']['state_id']);
		$this->set('town_arr',$town_arr);	
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$useridarr[0]['Horse']['countryid']);
		$this->set('state_arr',$state_arr);			
		if($useridarr['0']['Horse']['sales_status']!="S" && $useridarr['0']['Horse']['sales_status']!="Stud") {
			$salecount=$this->Horsesale->FindAll('horse_id='.$horse_id);
			if(count($salecount)<=0) {
				$salesstatus='yes';
			}		
		}
		$this->set('salesstatus',$salesstatus);	
		$additionalimagearr=$this->Horseimage->FindAll('horse_id='.$horse_id); 
		$this->set('additionalimagearr',$additionalimagearr);
		if(!empty($this->data)) {
			
			if($this->data['Horse']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['image'], 'horseimage', '', 'horseimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img=$useridarr[0]['Horse']['image'] ;
			}
			if($this->data['Horse']['video']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Horse']['video'], 'horsevideo', '', 'horsevideo'); 
				$fileNameArr=explode('/',$path);
				$video=$fileName=$fileNameArr[1];
			}
			else {
				$video=$useridarr[0]['Horse']['video'] ;
			}
			$userid=$this->Session->Read("userid") ;		
			$this->Horse->id=$horse_id;
			$this->data['Horse']['ownerid']=$userid;
			$this->data['Horse']['image']=$img;
			$this->data['Horse']['video']=$video;
			$this->data['Changerequesthorse']['horse_id']=$horse_id;
			if(@$_POST['hiddownerid']) {
				$this->data['Changerequesthorse']['ownerid']=@$_POST['hiddownerid'];
				$this->data['Changerequesthorse']['ownername']=$this->data['Horse']['ownername'] ;	
			}
			if(@$_POST['hiddownerid']=="") {
				$this->data['Changerequesthorse']['ownerid']='';
				if($useridarr[0]['Horse']['ownername']!=$this->data['Horse']['ownername']) {
					$this->data['Changerequesthorse']['ownername']=$this->data['Horse']['ownername'] ;	
					$this->data['Changerequesthorse']['ownerid']="";		
				}			
			}			
			if(@$_POST['hiddbrederid']) {
				echo $this->data['Changerequesthorse']['breeder_id']=@$_POST['hiddbrederid'];
				$this->data['Changerequesthorse']['breeder']=$this->data['Horse']['breeder'] ;
			}
			if(@$_POST['hiddbrederid']=="") {
				$this->data['Changerequesthorse']['breeder_id']="";
				$this->data['Changerequesthorse']['breeder']=$this->data['Horse']['breeder'] ;
			}
			
			if(isset($this->data['Horse']['sireunknowoption'])) {
				$this->data['Changerequesthorse']['sireunknowoption']="Y";
				$this->data['Changerequesthorse']['sire_id']=''; 
			}
			else {
				$this->data['Changerequesthorse']['sireunknowoption']="N";			
			}
			if(isset($this->data['Horse']['damunknownoption'])) {
				$this->data['Changerequesthorse']['damunknownoption']="Y";
				$this->data['Changerequesthorse']['dam_id']=''; 
			}
			else {
				$this->data['Changerequesthorse']['damunknownoption']="N";			
			}								
			$this->data['Changerequesthorse']['requestedby_id']=$this->Session->Read("userid");
			$this->data['Changerequesthorse']['posted_date']=date("Y-m-d");
			$this->data['Changerequesthorse']['name']=$this->data['Horse']['name'] ;
			$this->data['Changerequesthorse']['gender']=$this->data['Horse']['gender'] ;
			$this->data['Changerequesthorse']['breed_id']=$this->data['Horse']['breed_id'] ;
			$this->data['Changerequesthorse']['year']=$this->data['Horse']['year'] ;
			$this->data['Changerequesthorse']['sire']=$this->data['Horse']['sire'] ;
			$this->data['Changerequesthorse']['dam']=$this->data['Horse']['dam'];			
			if(@$_POST['hiddsireval']) {
				$this->data['Changerequesthorse']['sire_id']=@$_POST['hiddsireval'];
			}			
			if(@$_POST['hiddsireval']=="") {
				if($useridarr[0]['Horse']['sire']!=$this->data['Horse']['sire']) {
					$this->data['Changerequesthorse']['sire_id']=''; 
					$this->data['Changerequesthorse']['sire']=$this->data['Horse']['sire'];
				}
				else {
					$this->data['Changerequesthorse']['sire_id']=$useridarr[0]['Horse']['sire_id'] ;
				}
			}		
			if(@$_POST['hidddamval']) {
				$this->data['Changerequesthorse']['dam_id']=@$_POST['hidddamval'];
				$this->data['Changerequesthorse']['dam']=$this->data['Horse']['dam'];
			}			
			if(@$_POST['hidddamval']=="") {
				if($useridarr[0]['Horse']['dam']!=$this->data['Horse']['dam']) {
					$this->data['Changerequesthorse']['dam_id']='';
					$this->data['Changerequesthorse']['dam']=$this->data['Horse']['dam'];
				}	
				else {
					$this->data['Changerequesthorse']['dam_id']=$useridarr[0]['Horse']['dam_id'] ;
				}		
			}		
			$this->data['Changerequesthorse']['height_id']=$this->data['Horse']['height_id'] ;
			$this->data['Changerequesthorse']['coatcolor_id']=$this->data['Horse']['coatcolor_id'] ;
			$this->data['Changerequesthorse']['bloodline']=$this->data['Horse']['bloodline'] ;
			$this->data['Changerequesthorse']['breeder']=$this->data['Horse']['breeder'] ;
			$this->data['Changerequesthorse']['prize_won']=$this->data['Horse']['prize_won'] ;
			$this->data['Changerequesthorse']['stablename']=$this->data['Horse']['stablename'] ;
			$this->data['Changerequesthorse']['countryid']=$this->data['Horse']['countryid'] ;
			$this->data['Changerequesthorse']['state_id']=$this->data['Horse']['state_id'] ;
			$this->data['Changerequesthorse']['town_id']=$this->data['Horse']['town_id'] ;
			$this->data['Changerequesthorse']['bred_name']=$this->data['Horse']['bred_name'] ;
			$this->data['Changerequesthorse']['other_details']=$this->data['Horse']['other_details'] ;
			$this->data['Changerequesthorse']['utube_link']=$this->data['Horse']['utube_link'] ;
			$this->data['Changerequesthorse']['deathstat']=$this->data['Horse']['deathstat'] ;
			$this->data['Changerequesthorse']['yearofdeath']=$this->data['Horse']['yearofdeath'] ;
			$this->data['Changerequesthorse']['registered']=$this->data['Horse']['registered'] ;
			$this->data['Changerequesthorse']['registration_code']=$this->data['Horse']['registration_code'] ;
			$this->data['Changerequesthorse']['image']=$img;
			$this->data['Changerequesthorse']['video']=$video;			
			if(!empty($this->data['Horse']['stablename'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['stablename']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Changerequesthorse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Changerequesthorse']['stable_id']=$stablecountarr[0]['Stable']['id'];
					
				}	
				else {
					$this->Horse->id=$horse_id;
					$this->data['Changerequesthorse']['stablename']=$this->data['Horse']['stablename'];
					$this->data['Changerequesthorse']['stable_id']="" ;
				}			
			}			
			else {
				$this->Horse->id=$horse_id;
				$this->data['Changerequesthorse']['stablename']=$this->data['Horse']['stablename'];
				$this->data['Changerequesthorse']['stable_id']="" ;
			}			
			if(!empty($this->data['Horse']['bred_name'])) {
				$stablecountarr=$this->Stable->Findall("stable_name='".$this->data['Horse']['bred_name']."'");
				if(count($stablecountarr)>0) {
					$this->Horse->id=$horse_id;
					$this->data['Changerequesthorse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Changerequesthorse']['bred_id']=$stablecountarr[0]['Stable']['id'];					
				}	
				else {
					$this->Horse->id=$horse_id;
					$this->data['Changerequesthorse']['bred_name']=$this->data['Horse']['bred_name'];
					$this->data['Changerequesthorse']['bred_id']='';
				}							
			}
			else {
				$this->Horse->id=$horse_id;
				$this->data['Changerequesthorse']['bred_name']=$this->data['Horse']['bred_name'];
				$this->data['Changerequesthorse']['bred_id']='';
			}
			
			if(is_numeric($_POST['hiddval'])) {				
				if($_POST['hiddval']>0) {
					for($i=1;$i<=$_POST['hiddval'];$i++) {
						if($_FILES['image_'.$i]['name']!="") {
							$path=rootpth()."horseadditionalimage";
							$randno=rand(4563,478962);
							if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'],$path."/".$randno.$_FILES['image_'.$i]['name'])) {
								$insert_sql="INSERT INTO tbl_changerequesthorseimages SET horse_id=".$horse_id.",image='".$randno.$_FILES['image_'.$i]['name']."'";
								$this->Horse->query($insert_sql) ;
							}	
						}
					}	
				}	
			}		
			if($this->Changerequesthorse->save($this->data)) {
				$adminArr = $this->Admin->FindBySuperAdmin(1);	
				$textContent2='';
				$textContent2='Dear,<b>Admin</b><br>Username named as '.$this->Session->Read("username").' has requested to change information for the Horse name as '.$useridarr['0']['Horse']['name'].' ;<br>
				Please Login to view the details wither to approve or reject.
				<br>
				Thanks
				Indian Horse Database';		
				$textContent2 = stripslashes($textContent2);
				$this->set("message", $textContent2);
				$this->Email->to = $adminArr['Admin']['admin_email'];
				$this->Email->subject = $this->Session->Read("username").' has requested change for '.$useridarr['0']['Horse']['name'].'-'.$horse_id ;
				$this->Email->replyTo = $adminArr['Admin']['admin_email'];
				$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
				$this->Email->template	= 'email/customer' ; // note no '.ctp'
				$this->Email->send();				
				$this->redirect('/horse/adminapprove');
			}			
		}		
		$this->set('useridarr',$useridarr);
		$this->set('horse_id',$horse_id);	
	}
	function adminapprove() {
		parent::blanklayout();
		parent::chkblanksession();	
	}	
	function reject($horse_id=NULL,$id=NULL,$type=NULL) {		
		/*$del_sql="DELETE FROM tbl_changeeditrequestnotifications WHERE horse_id=".$id;
		$this->Horse->query($del_sql);	
		$del_sql="DELETE FROM tbl_changerequesthorses WHERE horse_id=".$id;
		$this->Horse->query($del_sql);	
		$this->Session->setFlash('You have rejected the change edit request');
		$this->redirect('/user/premiumuserwelcomepage');	*/
		$this->data['Changerequesthorse']['id']=$id;
		$this->data['Changerequesthorse']['acceptedbyid']=$this->Session->Read("userid");
		$this->data['Changerequesthorse']['acceptedordeny']='Y';  
		parent::blanklayout();
		parent::chkblanksession();		
		$count_sql="SELECT * FROM tbl_horserequestreject WHERE horse_id=".$id." AND user_id=".$this->Session->Read("userid") ;
		$count_arr=$this->Horse->query($count_sql);
		$this->set('count_arr',$count_arr);		
		if(@isset($_POST['sub'])) {		
			$this->data['Changerequesthorse']['acceptedbyid']=$this->Session->Read("userid");
			$this->data['Changerequesthorse']['acceptedordeny']='N';
			$this->Changerequesthorse->save($this->data);
			$userid=$this->Session->Read("userid") ;
			$userarr=$this->User->FindByid($userid) ;
			$horsearr=$this->Horse->FindByid($horse_id);
			$insert_sql="INSERT INTO tbl_horserequestreject SET requestid=".$id.",horse_id=".$horse_id.",user_id=".$this->Session->Read("userid").",
						reason='".addslashes($_POST['message'])."',typeofuser='".$type."'";
			$this->Horse->query($insert_sql);			
			$adminArr = $this->Admin->FindBySuperAdmin(1);	
			$textContent2='';
			$textContent2='Dear,<b>Admin</b><br>user name <b>'.$userarr['User']['firstname'].'  '.$userarr['User']['lastname'].' has disagreed with change request'. $horsearr['Horse']['name'].'
			<br>
			Reason : '.$_POST['message'].'
			Thanks
			Indian Horse Database';		
			$textContent2 = stripslashes($textContent2);
			$this->set("message", $textContent2);
			$this->Email->to = $adminArr['Admin']['admin_email'];
			$this->Email->subject = $userarr['User']['firstname'].'  '.$userarr['User']['lastname'].' has disagreed with change request for '.$horsearr['Horse']['name'].'-'.$horsearr['Horse']['id'];
			$this->Email->replyTo = $adminArr['Admin']['admin_email'];
			$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
			$this->Email->template	= 'email/customer' ; // note no '.ctp'
			$this->Email->send();	
			$this->Session->setFlash('Thank you for your input.');
			$this->redirect('/user/premiumuserwelcomepage');				
		}		
	}	
	function acceptchange($horse_id=NULL,$id=NULL,$type=NULL) {
			$useridarr=$this->Changerequesthorse->FindByhorse_id($horse_id);		
			$insert_acceptsql="INSERT INTO tbl_horseinfoaccept SET request_id=".$id.",
							   user_id=".$this->Session->Read("userid").",horse_id=".$horse_id.",date=CURRENT_DATE(),typeofuser='".$type."'";			
			$this->Horse->query($insert_acceptsql);				
			$this->data['Changerequesthorse']['id']=$id;
			$this->data['Changerequesthorse']['acceptedbyid']=$this->Session->Read("userid");
			$this->data['Changerequesthorse']['acceptedordeny']='Y';
			$this->Changerequesthorse->save($this->data);
			$userid=$this->Session->Read("userid") ;
			$userarr=$this->User->FindByid($userid) ;
			$horsearr=$this->Horse->FindByid($horse_id);			
			$adminArr = $this->Admin->FindBySuperAdmin(1);	
			$textContent2='';
			$textContent2='Dear,<b>Admin</b><br>User:'.$userarr['User']['firstname'].' '.$userarr['User']['lastname'].' has agreed with change request: '.$horsearr['Horse']['name'].'
			<br>
			Thanks
			Indian Horse Database';		
			$textContent2 = stripslashes($textContent2);
			$this->set("message", $textContent2);
			$this->Email->to = $adminArr['Admin']['admin_email'];
			$this->Email->subject = $userarr['User']['firstname'].'   '.$userarr['User']['lastname'].' has agreed with change request for '.$horsearr['Horse']['name'].'-'.$horsearr['Horse']['id'];
			$this->Email->replyTo = $adminArr['Admin']['admin_email'];
			$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
			$this->Email->template	= 'email/customer' ; // note no '.ctp'
			$this->Email->send();	
			$this->Session->setFlash('Thanks you for your input!');
			$this->redirect('/user/premiumuserwelcomepage');		
	} 
	function chkrequest($horse_id=NULL) {
		$this->layout='';
		$userid=$this->Session->Read("userid") ;
		$countarr=$this->Changerequesthorse->FindAll("horse_id=".$horse_id." AND requestedby_id=".$userid); 
		if(count($countarr)>0) {
			e("1");
			exit();
		}
		else {
			e("0");
			exit();
		}
	}	
	function viewchange($horse_id=NULL) { 
		$this->layout='';
		$userid=$this->Session->Read("userid") ;
		$horsearr=$this->Horse->FindByid($horse_id);
		$this->set('horsearr',$horsearr);	
		$originalhorsearr=$this->Changerequesthorse->FindAll("horse_id=".$horse_id);		
		$this->set('originalhorsearr',$originalhorsearr);
	}
	
	function siredetails($horse_id=NULL) {
		$sirearr=$this->Horse->FindByid($horse_id);
		return $sirearr;
	}
	
	function additionaltown($country_id,$state_id,$townname=NULL){
		$this->layout='';
		$this->data['Town']['state_id']=$state_id;
		$this->data['Town']['town']=urldecode($townname);	
		$this->data['Town']['posted_date']=date("Y-m-d");
		$this->Town->save($this->data);	
	}
	
	function assignmainimage($horse_id,$image_id,$image=NULL) {
		parent::chkblanksession();
		$usertype=$this->Session->Read("usertype") ;		
		$horsearr=$this->Horse->FindAll("id=".$horse_id);
		$path=rootpth().'/horseimage';		
		@copy(rootpth().'horseadditionalimage/'.$image,$path.'/'.$image);	 
		$this->Horse->id=$horse_id ;
		$this->data['Horse']['image']=$image;
		$this->Horse->save($this->data);
		
		$path=rootpth().'/horseadditionalimage';
		@copy(rootpth().'horseimage/'.$image,$path.'/'.$horsearr[0]['Horse']['image']);
		
		$updateadd_sql="UPDATE tbl_horseimages SET image='".$horsearr[0]['Horse']['image']."' WHERE id=".$image_id;
		$this->Horse->query($updateadd_sql) ;
		if($usertype=="P") {
			$this->redirect('/horse/edithorseinfo/'.$horse_id);		
		}
		if($usertype=="F") {
			$this->redirect('/horse/edithorseinfobyfreeuser/'.$horse_id);		
		}
	}	
} # end of the class
?>