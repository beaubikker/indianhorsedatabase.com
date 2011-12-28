<?php
ob_start();
error_reporting(0);
class UserController  extends AppController
{
	var $name		= "User" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination','Rsz' );
	var $components	= array('Pagination','Upload','Email');	
	var $uses=array('User','Admin','Content','Horse','Stable','Town','Country','State','Usersubscription','Notification','Setting');
	function index($orderby=NULL)
	{
		parent::adminlayout(); 
		parent::checkAdminSession();
		
		$del_sql="DELETE FROM tbl_users WHERE email_address=' '";
		$this->User->query($del_sql) ;
		
		$pagetotal=$this->User->Find('count'); 
		$this->set('pagetotal',$pagetotal);
		if($orderby=="") {
			$order='ORDER BY id DESC' ;
		}
		if($orderby=="asc") {
			$order='ORDER BY firstname ASC' ;
		}
		if($orderby=="desc") {
			$order='ORDER BY firstname DESC' ;
		}	
		if($orderby=="lastloginasc") {
			$order='ORDER BY logoutdate ASC' ;
		}	
		if($orderby=="lastlogindesc") {
			$order='ORDER BY logoutdate DESC' ;
		}
		$this->set('listarr', $this->_paginate_leads('','',$order,'','')); //in app/app_controller  
		$this->set('orderby',$orderby);
	}		
	
	function _paginate_leads($criteria) {
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->User->findAll($criteria, NULL, $order, $limit, $page);
		return $leads;
	}	
			
	function add() {		 
		$duplicateerr=0;
		parent::adminlayout(); 
		parent::checkAdminSession();
		$this->set('duplicateerr',$duplicateerr); 
		$this->set('usertype',$this->data['User']['usertype']);
		if(!empty($this->data)) {
			if($this->User->validates($this->data))  {	
				$duplicatearr=$this->User->FindAll("email_address='".$this->data['User']['email_address']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['User']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['User']['image'], 'profileimage', '', 'profileimage'); 
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img='';
					}	
					$this->data['User']['image']=$img;	
					$this->data['User']['password']=base64_encode($this->data['User']['password']);		
					$this->data['User']['login_stat']='Y';
					if($this->User->save($this->data)) {
						$this->Session->setFlash('User successfully added.');
						$this->redirect('/user'); 
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
	function edit($userid=NULL) {
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->User->id=$userid;
		$edit_arr=$this->User->Read();
		$this->set('edit_arr',$edit_arr);	
		if(!empty($this->data)) {
			if($this->User->validates($this->data))  {	
				$duplicatearr=$this->User->FindAll("id!=".$userid." AND email_address='".$this->data['User']['email_address']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
					$this->set('duplicateerr',$duplicateerr);
				}
				if($duplicateerr<=0) {
					if($this->data['User']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['User']['image'], 'profileimage', '', 'profileimage'); 
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img=$edit_arr['User']['image'];
					}	
					if(isset($this->data['User']['yes'])) {
						$curreexpiration=$edit_arr['User']['membership_exipre_date'] ;
						$durationexpiration=strtotime(" $curreexpiration + ".$this->data['User']['expiration_time_periode']);
						$membershipexpiration=date("Y-m-d",$durationexpiration);
						$this->data['User']['membership_exipre_date']=$membershipexpiration;
					}					
					$this->data['User']['image']=$img;	
					$this->data['User']['password']=base64_encode($this->data['User']['password']);		
					$this->data['User']['login_stat']='Y';
					
					$this->data['User']['edited_date']=date("Y-m-d");
					$notisubscriptionsqlupdate="UPDATE tbl_usersubscriptions SET  yesstatus='Y' WHERE usrid=".$userid ;
					$this->User->query($notisubscriptionsqlupdate) ;					
					
					if($this->User->save($this->data)) {
						$this->Session->setFlash('User successfully saved.');
						$this->redirect('/user');
					}				
				}				
			}			 
		  else 
		  {
		  	$this->set('duplicateerr',$duplicateerr);
			return false;  
		  }		
		}
		$this->set('duplicateerr',$duplicateerr);
	}	
	function stat_on($id=NULL) {
		$this->User->id=$id;
		$this->data['User']['login_stat']="Y";
		$this->User->save($this->data);
		$this->Session->setFlash('User status successfully changed.');
	    $this->redirect($this->referer()); 
	}
	function stat_off($id=NULL) {
		$this->User->id=$id;
		$this->data['User']['login_stat']="N";
		$this->User->save($this->data);		
		$this->Session->setFlash('User status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($userid=NULL) {
		$this->User->id=$userid;
		$this->User->delete();
		$this->Session->setFlash('User successfully deleted.');
		$this->redirect('/user/index/'); 
				
	}	
	//////////// Front end///////////////////////////
	function login($username=NULL,$password=NULL) {
		parent::blanklayout(); 
		$msg='';
		$count_arr=$this->User->FindAll("email_address ='".$username."' AND password='".base64_encode($password)."' AND login_stat ='Y' AND usertype='P' AND membership_exipre_date>=CURRENT_DATE");
		if(count($count_arr)<=0) {
			$msg='<font color=#FF0000>Invalid login </font>';		
		}
		else {
			$usertype=$count_arr[0]['User']['usertype'];
			$userid=$count_arr[0]['User']['id'];
			$username=$count_arr[0]['User']['firstname'];
			$email_address=$count_arr[0]['User']['email_address'];
			$login_counter=$count_arr[0]['User']['login_counter'];
			$this->Session->write('usertype',$usertype);
			$this->Session->write('userid',$userid);
			$this->Session->write('username',$username);
			$this->Session->write('email_address',$email_address);
			$this->Session->write('login_counter',$login_counter);
			$this->Session->Read("usertype") ;			
			$this->data['User']['login_counter']=$login_counter+1;
			$this->User->id=$userid;
			$this->User->save($this->data);
			if($login_counter<=0) {
				e("0");
			}
			else {
				e("1");
			}			
			exit();			
		}
		
		$this->set('msg',$msg);
	}	
	function userpaiduseaccount() {
		error_reporting(0);
		parent::blanklayout();
		parent::chkblanksession();	
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}
		$userid=$this->Session->Read("userid") ;
		parent::chkusertype();
		$userdetailarr=$this->User->FindByid($userid);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);		
		$town_arr='';
		$state_arr='';
		if(is_numeric($userdetailarr['User']['countryid'])) {
			$state_arr=$this->State->FindAll("country_id=".$userdetailarr['User']['countryid']." AND status='Y'");
			$town_arr=$this->Town->FindAll("status='Y'");
		}
		$this->set('state_arr',$state_arr);
		$this->set('town_arr',$town_arr);	
		$liststablechange_sql="SELECT * FROM tbl_stables Stable ,tbl_stablesubscriptions Stablesubscribtion WHERE Stable.status='Y' AND 
							   Stable.id=Stablesubscribtion.stable_id AND Stablesubscribtion.user_id=".$userid." 
							   AND Stable.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$liststablearr=$this->Usersubscription->query($liststablechange_sql) ;
		$this->set('liststablearr',$liststablearr);		
		$listuserchane_sql="SELECT * FROM tbl_users User ,tbl_usersubscriptions Usersubscription WHERE User.login_stat='Y' AND 
							   User.id=Usersubscription.usrid AND Usersubscription.user_id=".$userid." 
							   AND User.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$listuserarr=$this->Usersubscription->query($listuserchane_sql) ;
		$this->set('listuserarr',$listuserarr);		
		$lishorsechange_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id AND Horsesubscribtion.user_id=".$userid." 
							   AND Horse.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$listhorsearr=$this->Usersubscription->query($lishorsechange_sql) ;
		$this->set('listhorsearr',$listhorsearr);		
		$addedhorsenew_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id AND Horsesubscribtion.user_id=".$userid." 
							   AND Horse.posted_date>='".$userdetailarr['User']['logoutdate']."' ";
		$newuserhorsepostarr=$this->Usersubscription->query($addedhorsenew_sql) ;
		$this->set('newuserhorsepostarr',$newuserhorsepostarr);				
	}	
	
	
	function notificationlisting($action=NULL,$id=NULL) {
		$userid=$this->Session->Read("userid") ;
		if($action!="") {
			switch($action) {
				case 'stalenotification':
					$delstablenotisql="DELETE FROM tbl_stablesubscriptions WHERE user_id=".$userid." AND stable_id=".$id;
					$this->User->query($delstablenotisql);
				break;					
				case 'horsenotification':
					$delstablenotisql="DELETE FROM tbl_horsesubscriptions WHERE user_id=".$userid." AND horse_id=".$id;
					$this->User->query($delstablenotisql);
				break;									
				case 'usernotification':
					$delstablenotisql="DELETE FROM tbl_usersubscriptions WHERE user_id=".$userid." AND usrid=".$id;
					$this->User->query($delstablenotisql);
				break;
					
			}		
		}
		$this->layout='';
		
		$userdetailarr=$this->User->FindByid($userid);
		$liststablechange_sql="SELECT * FROM tbl_stables Stable ,tbl_stablesubscriptions Stablesubscribtion WHERE Stable.status='Y' AND 
							   Stable.id=Stablesubscribtion.stable_id AND Stablesubscribtion.user_id=".$userid;
							  
		$liststablearr=$this->Usersubscription->query($liststablechange_sql) ;
		$this->set('liststablearr',$liststablearr);		
		$listuserchane_sql="SELECT * FROM tbl_users User ,tbl_usersubscriptions Usersubscription WHERE User.login_stat='Y' AND 
							   User.id=Usersubscription.usrid AND Usersubscription.user_id=".$userid;
		$listuserarr=$this->Usersubscription->query($listuserchane_sql) ;
		$this->set('listuserarr',$listuserarr);		
		$lishorsechange_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id AND Horsesubscribtion.user_id=".$userid;
		$listhorsearr=$this->Usersubscription->query($lishorsechange_sql) ;
		$this->set('listhorsearr',$listhorsearr);				
	}
	
	
	
	function changeloc($country=NULL,$state_id=NULL,$town=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$this->User->id=$userid;
		$this->data['User']['town_id']=$town;
		$this->data['User']['countryid']=$country;
		$this->data['User']['state_id']=$state_id;
		if($this->User->save($this->data)) {
			e("1");
			exit();
		}
		else {
			e("<font colo=#FF0000>Sorry!Unable to update </font>");
		}	
	}
	
	function freeuserlogin($username=NULL,$password=NULL) {
		parent::blanklayout();
		$msg='';
		$count_arr=$this->User->FindAll("email_address ='".$username."' AND password='".base64_encode($password)."' AND login_stat ='Y' AND usertype='F'");
		if(count($count_arr)<=0) {
			$msg='<font color=#FF0000>Invalid login </font>';	
			e("0");	
			exit();
		}
		else {
			$usertype=$count_arr[0]['User']['usertype'];
			$userid=$count_arr[0]['User']['id'];
			$username=$count_arr[0]['User']['firstname'];
			$email_address=$count_arr[0]['User']['email_address'];
			$login_counter=$count_arr[0]['User']['login_counter'];
			$this->Session->write('usertype',$usertype);
			$this->Session->write('userid',$userid);
			$this->Session->write('username',$username);
			$this->Session->write('email_address',$email_address);
			$this->Session->write('login_counter',$login_counter);
			$this->Session->Read("usertype") ;			
			$this->data['User']['login_counter']=$login_counter+1;
			$this->User->id=$userid;
			$this->User->save($this->data);
			e("1");	
			exit();		
		}	
	}
	function premiumuserfirstlogin() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindById($userid)	;
		$this->set('userarr',$userarr);
		$logincounter=self::chklogincounter();
		if($logincounter>0) {
			$this->redirect('/user/premiumuserwelcomepage');
		}
	}
	function freeuserwelcomepage() {
		error_reporting(0);
		parent::blanklayout();
		$usertype=$this->Session->Read("usertype") ;	
		if($usertype=="P") {
			$this->redirect('/user/premiumuserwelcomepage');
		}
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindById($userid)	;
		$this->set('userarr',$userarr);
		
		$userdetailarr=$this->User->FindByid($userid);
		$liststablechange_sql="SELECT * FROM tbl_stables Stable ,tbl_stablesubscriptions Stablesubscribtion WHERE Stable.status='Y' AND 
							   Stable.id=Stablesubscribtion.stable_id AND Stablesubscribtion.user_id=".$userid." 
							   AND Stable.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$liststablearr=$this->Usersubscription->query($liststablechange_sql) ;
		$this->set('liststablearr',$liststablearr);		
		$listuserchane_sql="SELECT * FROM tbl_users User ,tbl_usersubscriptions Usersubscription WHERE User.login_stat='Y' AND 
							   User.id=Usersubscription.usrid AND Usersubscription.yesstatus='Y' AND Usersubscription.user_id=".$userid." 
							   AND User.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$listuserarr=$this->Usersubscription->query($listuserchane_sql) ;
		$this->set('listuserarr',$listuserarr);		
		$lishorsechange_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id  AND Horsesubscribtion.yesstatus='Y' AND Horsesubscribtion.user_id=".$userid." 
							   AND Horse.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$listhorsearr=$this->Usersubscription->query($lishorsechange_sql) ;
		$this->set('listhorsearr',$listhorsearr);		
		$addedhorsenew_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id AND Horsesubscribtion.user_id=".$userid." 
							   AND Horse.posted_date>='".$userdetailarr['User']['logoutdate']."' Group By Horse.id"; 
		$newuserhorsepostarr=$this->Usersubscription->query($addedhorsenew_sql) ;
		$this->set('newuserhorsepostarr',$newuserhorsepostarr);	
		$userarr=$this->User->FindByid($userid);
		$changeeditnotofication_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Horse.ownerid=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
											
		$changenotiarr=$this->Horse->query($changeeditnotofication_sql) ;
		$this->set('changenotiarr',$changenotiarr);		
			
		$breedernotification_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Horse.breeder_id=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
		$breederarr=$this->Horse->query($breedernotification_sql) ;
			
		$addernotification_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Horse.addedby=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."'  ORDER BY Changerequest.id DESC "; 
		$adderarr=$this->Horse->query($addernotification_sql) ;
		$this->set('adderarr',$adderarr);	
		$this->set('breederarr',$breederarr);	
		$notificationarr=$this->Notification->FindAll("user_id=".$userid,'','ORDER BY id desc','','');
		$this->set('notificationarr',$notificationarr);		
		
		$oldownernotification_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Changerequest.ownerid=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
											
		$oldownerarr=$this->Horse->query($oldownernotification_sql) ;
		$this->set('oldownerarr',$oldownerarr);		
		
		
		$oldbreeder_notification="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Changerequest.breeder_id=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
		$oldbrederarr=$this->Horse->query($oldbreeder_notification) ;
		$this->set('oldbrederarr',$oldbrederarr);		
		$this->set('userid',$userid);	
	}	
	function userfreeuseaccount() {
		parent::blanklayout();
		parent::chkblanksession();	
		$usertype=$this->Session->Read("usertype") ;
		$userid=$this->Session->Read("userid") ;
		$userdetailarr=$this->User->FindByid($userid);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);	
		$state_arr='';
		$town_arr='';
		if(is_numeric($userdetailarr['User']['countryid']))	 {
			$state_arr=$this->State->FindAll("country_id=".$userdetailarr['User']['countryid']." AND status='Y'");
			$town_arr=$this->Town->FindAll("status='Y'");
		}
		$this->set('state_arr',$state_arr);
		$this->set('town_arr',$town_arr);	
		if($usertype=="P") {
			$this->redirect('/user/noaccess');
		}
	}	
	function changepassword() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;	
		$userarr=$this->User->FindById($userid)	;
		$this->set('userarr',$userarr);
	}
	function changepasswordvalid($oldpassword,$newpassword=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$passexists_arr=$this->User->FindAll("password='".base64_encode($oldpassword)."' AND id=".$userid);
		if(count($passexists_arr)<=0) {
			$msg='<font color=#FF0000><em>Your old password is incorrect</em></font>';
		}
		else {
			$this->User->id=$userid;
			$this->data['User']['password']=base64_encode($newpassword) ;
			$this->User->save($this->data);
			$msg='<font color=#FF0000><em>Your password has been changed</em></font>';
		}
		$this->set('msg',$msg);	
	}
	function noaccess() {
		self::redirect('/user/newuser');
	}	
	function deactivateaccountsuccess() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Deactivate Account%'");
		$this->set('homecontent_arr',$homecontent_arr);	
	}	
	function paiduserlogout() {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$this->data['User']['logoutdate']=date("Y-m-d");
		$this->User->id=$userid;
		$this->User->save($this->data);
		$this->Session->destroy("usertype") ;		
		$this->Session->destroy("userid") ;	
		$this->Session->destroy("username") ;	
		$this->Session->destroy("email_address") ;	
		$this->Session->setFlash('You have successfully been logged out.');
		$this->redirect('/content/front');
	}
	function changename($firsrname=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$this->User->id=$userid;
		$this->data['User']['firstname']=$firsrname;
		if($this->User->save($this->data)) {
			e("1");
			exit();
		}
	}
	function chaneemail($email=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$emailexistsarr=$this->User->FindAll("id!=".$userid." AND  email_address='".$email."'");
		if(count($emailexistsarr)>0) {
			e("<font color=#FF0000><em>Email Aready Exists </em></font>");
			//e("0");
			exit();
		}
		else {
			$this->User->id=$userid;
			$this->data['User']['email_address']=$email;
			if($this->User->save($this->data)) {
				e("1");
				exit();
			}
		}	
	}	
	function deactivateaccount($reason=NULL) {
		parent::blanklayout();
		if($reason) {
			$userid=$this->Session->Read("userid") ;
			$this->User->id=$userid;
			$this->data['User']['login_stat']="Deactive";
			$update_sql="UPDATE tbl_users SET login_stat='N' WHERE id=".$userid;
			$this->User->query($update_sql);
			$insert_sql="INSERT INTO tbl_user_accountdeactivate SET user_id=".$userid.",deactivation_reason='".$reason."'";
			$insert_query=$this->User->query($insert_sql) ;
			$this->Session->destroy("usertype") ;		
			$this->Session->destroy("userid") ;	
			$this->Session->destroy("username") ;	
			$this->Session->destroy("email_address") ;
			e("1");
			exit();					
		}
	}	
	function updatemembership() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid) ;
		$usertype=$this->Session->Read("usertype") ;
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);	
		$this->set('userarr',$userarr);	
		if($usertype=="P") {
			$this->redirect('/user/noaccess');
		}	
	}	
	function confirmupdatemembership() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid) ;
		$this->set('userarr',$userarr);
		$this->set('userid',$userid);
		$_SESSION['updatenewid']=$userid ;
		$usertype=$this->Session->Read("usertype") ;		
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);		
		$this->User->id=$userid;
		$price='';		
		$dur='' ;
		$paymemtoption='';
		if($this->data['User']['expiration_time_periode']=='6 months') {
			$dur='6 Months' ;
			$price=$seetingarr['Setting']['6_months_proce'];
		}
		if($this->data['User']['expiration_time_periode']=='1 Year') {
			$price=$seetingarr['Setting']['1_year_price'];
			$dur='1 Year' ;
		}
		if($this->data['User']['expiration_time_periode']=='1 Year 6 months') {
			$price=$seetingarr['Setting']['1_half_year_price'];
			$dur='1 Year 6 months' ;
		}
		if($this->data['User']['expiration_time_periode']=='2 Years') {
			$dur='2 Years' ;
			$price=$seetingarr['Setting']['2_year_price'];
		}		
		$this->Session->write('expiration_time_periode',$this->data['User']['expiration_time_periode']);	
		$this->set('expiration_time_periode',$this->data['User']['expiration_time_periode']);		
		$this->set('price',$price);	
		$this->set('dur',$dur);	
	}	
	function extendmembership() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid) ;
		$this->set('userarr',$userarr);
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}	
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);		
	}	
	function membershipexpire() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid) ;
		$this->set('userarr',$userarr);
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}	
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);		
	}
	
	
	function paymentformemshipextension() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid) ;
		$this->set('userarr',$userarr);
		$this->set('userid',$userid);
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}		
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);		
		$this->User->id=$userid;
		$price='';		
		$dur='' ;
		$paymemtoption='';
		if($this->data['User']['expiration_time_periode']=='6 months') {
			$dur='6 Months' ;
			$price=$seetingarr['Setting']['6_months_proce'];
		}
		if($this->data['User']['expiration_time_periode']=='1 Year') {
			$price=$seetingarr['Setting']['1_year_price'];
			$dur='1 Year' ;
		}
		if($this->data['User']['expiration_time_periode']=='1 Year 6 months') {
			$price=$seetingarr['Setting']['1_half_year_price'];
			$dur='1 Year 6 months' ;
		}
		if($this->data['User']['expiration_time_periode']=='2 Years') {
			$dur='2 Years' ;
			$price=$seetingarr['Setting']['2_year_price'];
		}		
		$this->Session->write('expiration_time_periode',$this->data['User']['expiration_time_periode']);		
		$this->set('price',$price);	
		$this->set('dur',$dur);	
	}	
	function paymentformemshipexpiration() {
		parent::blanklayout();
		parent::chkblanksession();	
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindByid($userid) ;
		$this->set('userarr',$userarr);
		$this->set('userid',$userid);
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}		
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);		
		$this->User->id=$userid;
		$dur='' ;
		$paymemtoption='';
		if($this->data['User']['expiration_time_periode']=='6 months') {
			$dur='6 Months' ;
			$price=$seetingarr['Setting']['6_months_proce'];
		}
		if($this->data['User']['expiration_time_periode']=='1 Year') {
			$price=$seetingarr['Setting']['1_year_price'];
			$dur='1 Year' ;
		}
		if($this->data['User']['expiration_time_periode']=='1 Year 6 months') {
			$price=$seetingarr['Setting']['1_half_year_price'];
			$dur='1 Year 6 months' ;
		}
		if($this->data['User']['expiration_time_periode']=='2 Years') {
			$dur='2 Years' ;
			$price=$seetingarr['Setting']['2_year_price'];
		}		
		$this->Session->write('expiration_time_periode',$this->data['User']['expiration_time_periode']);		
		$this->set('price',$price);	
		$this->set('dur',$dur);	
	}	
	
	function extendsuccess() {
		parent::blanklayout();
		parent::chkblanksession();	
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/noaccess');
		}
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%extendsuccess%'");
		$this->set('homecontent_arr',$homecontent_arr);	
	}	
	function updatesucess() {
		error_reporting(0);
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%updatesucess%'");
		$this->set('homecontent_arr',$homecontent_arr);
	}	
	function signup($paidmember=NULL,$login=NULL)  {
		error_reporting(0);
		parent::blanklayout();
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);	
		if(!empty($this->data)) {
			if($this->data['User']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['User']['image'], 'profileimage', '', 'profileimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img='';
			}
			$this->Session->write('profileimage',$img); 
		}
		else {
			$profileimage=$this->Session->Read("profileimage");
			if(@unlink(rootpth()."profileimage/".$profileimage)) {	
			}
			$this->Session->Destroy("profileimage");
		}
		$profileimage=$this->Session->Read("profileimage");
		$this->set('profileimage',$profileimage);
		$this->set('login',$login);
		$this->set('paidmember',$paidmember);
		$this->set('emailconfirm',$_REQUEST['emailconfirm']);		
	}	
	function adduser($firstname=NULL,$lastname=NULL,$email=NULL,$password=NULL) {
		parent::blanklayout();
		$msg='';
		$userarr=$this->User->FindAll("email_address='".$email."'");
		if(count($userarr)>0) {
			$msg='<font color=#FF0000>Email already exists </font>';
		}
		else {
			$this->Session->write('firstname',$firstname);
			$this->Session->write('lastname',$lastname);
			$this->Session->write('email',$email);
			$this->Session->write('password',$password);
			echo "1";
			exit();
		}
		$this->set('msg',$msg);
	}
	function forgotpassword($emailaddress=NULL) {
		parent::blanklayout();
		$msg='';
		$userarr=$this->User->FindAll("email_address='".$emailaddress."'");
		if(count($userarr)<=0) {
			$msg='<br><font color=#FF0000>Sorry!This email address does not exist</font>';
		}
		else {
			$adminArr = $this->Admin->FindByid(1);	
			$textContent2='';
			$textContent2='Dear <b>'.$userarr[0]['User']['firstname'].' '.$userarr[0]['User']['lastname'].',</b><br>You have requested for your password with Indian  Horse database account<br>
			Here is your password to login: <br>
			Password      :<b>'.base64_decode($userarr[0]['User']['password']).'</b>
			<br>
			Thanks
			Indian Horse Database';		
			$textContent2 = stripslashes($textContent2);						
			$this->set("message", $textContent2);
			$this->Email->to = $emailaddress ;
			$this->Email->subject = 'Forgot Password in your Indian Horse Database account';
			$this->Email->replyTo = $adminArr['Admin']['admin_email'];
			$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
			$this->Email->template	= 'email/customer' ; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$msg='<br><font color=#FF0000>Password has been sent your mail account. Please check your mail.</font>'; 
			$this->Email->send();					
		}
		$this->set('msg',$msg);
	}
	
	
	function forgotpasswordfront($emailaddress=NULL) {
		parent::blanklayout();
		$msg='';
		$userarr=$this->User->FindAll("email_address='".$emailaddress."'");
		if(count($userarr)<=0) {
			$msg='<br><font color=#FF0000>Email does not exit</font>';
		}
		else {
			$adminArr = $this->Admin->FindByid(1);	
			$textContent2='';
			$textContent2='Dear <b>'.$userarr[0]['User']['firstname'].' '.$userarr[0]['User']['lastname'].',</b><br>You have requested for your password with Indian  Horse database account<br>
			Here is your password to login: <br>
			Password      :<b>'.base64_decode($userarr[0]['User']['password']).'</b>
			<br>
			Thanks
			Indian Horse Database';		
			$textContent2 = stripslashes($textContent2);						
			$this->set("message", $textContent2);
			$this->Email->to = $emailaddress ;
			$this->Email->subject = 'Forgot Password in your Indian Horse Database account';
			$this->Email->replyTo = $adminArr['Admin']['admin_email'];
			$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
			$this->Email->template	= 'email/customer' ; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$msg='<br><font color=#FF0000>Password has been sent.</font>'; 
			$this->Email->send();					
		}
		$this->set('msg',$msg);
	}
	
	
	
	function chklogin($username=NULL,$password=NULL,$chk=NULL) {
		parent::blanklayout();		
		$count_arr=$this->User->FindAll("email_address ='".$username."' AND password='".base64_encode($password)."' AND login_stat ='Y'");
		if(count($count_arr)<=0) {
			e("0");
			exit();
		}
		else {
			if($count_arr['0']['User']['usertype']=="F") {				
				$usertype=$count_arr[0]['User']['usertype'];
				$userid=$count_arr[0]['User']['id'];
				$username=$count_arr[0]['User']['firstname'];
				$email_address=$count_arr[0]['User']['email_address'];
				$login_counter=$count_arr[0]['User']['login_counter'];
				$this->Session->write('usertype',$usertype);
				$this->Session->write('userid',$userid);
				$this->Session->write('username',$username);
				$this->Session->write('email_address',$email_address);
				$this->Session->write('login_counter',$login_counter);
				$this->Session->Read("usertype") ;			
				$this->data['User']['login_counter']=$login_counter+1;
				$this->data['User']['logoutdate']=date("Y-m-d");
				$this->User->id=$userid;				
				if($chk=='yes') {
					setcookie('cookemail',$email_address,time()+36000) ;
					setcookie('pass',$password,time()+360000) ;
					setcookie('rem',$chk,time()+360000) ;	
					$chkipsql="SELECT * FROM tbl_rems WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
					$chkiparr=$this->User->query($chkipsql) ;
					if(count($chkiparr)<=0) {
						$ipinsert="INSERT INTO tbl_rems SET ip='".$_SERVER['REMOTE_ADDR']."',username='".$count_arr[0]['User']['email_address']."',password='".$password."'";
						$this->User->query($ipinsert);
					}	
					else {
						$ipinsert="UPDATE tbl_rems SET username='".$count_arr[0]['User']['email_address']."',password='".$password."' WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
						$this->User->query($ipinsert);
					}									
				}
				else {
					$del_sql="DELETE FROM tbl_rems WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
					$this->User->query($del_sql);
					setcookie('cookemail','') ;
					setcookie('pass','') ;
					setcookie('remember','') ; 
				}				
				$this->User->save($this->data);
				e("F");
				exit();
			}
			else {			
				$count_arr=$this->User->FindAll("email_address ='".$username."' AND password='".base64_encode($password)."' AND login_stat ='Y' AND usertype='P'");
				if(count($count_arr)<=0) {
					e("Invalid Login");
					exit();
				}
				else {
					$usertype=$count_arr[0]['User']['usertype'];
					$userid=$count_arr[0]['User']['id'];
					$username=$count_arr[0]['User']['firstname'];
					$email_address=$count_arr[0]['User']['email_address'];
					$login_counter=$count_arr[0]['User']['login_counter'];
					$this->Session->write('usertype',$usertype);
					$this->Session->write('userid',$userid);
					$this->Session->write('username',$username);
					$this->Session->write('email_address',$email_address);
					$this->Session->write('login_counter',$login_counter);
					$this->Session->Read("usertype") ;			
					$this->data['User']['login_counter']=$login_counter+1;
					$this->data['User']['logoutdate']=date("Y-m-d");
					$this->User->id=$userid;
					$this->User->save($this->data);
					if($chk=='yes') {
						setcookie('cookemail',$email_address,time()+36000) ;
						setcookie('pass',$password,time()+360000) ;
						setcookie('rem',$chk,time()+360000) ;	
						$chkipsql="SELECT * FROM tbl_rems WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
						$chkiparr=$this->User->query($chkipsql) ;
						if(count($chkiparr)<=0) {
							$ipinsert="INSERT INTO tbl_rems SET ip='".$_SERVER['REMOTE_ADDR']."',username='".$count_arr[0]['User']['email_address']."',password='".$password."'";
							$this->User->query($ipinsert); 
						}	
						else {
							$ipinsert="UPDATE tbl_rems SET username='".$count_arr[0]['User']['email_address']."',password='".$password."' WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
							$this->User->query($ipinsert);
						}									
				}
				else {
						$del_sql="DELETE FROM tbl_rems WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
						$this->User->query($del_sql);
						setcookie('pass','') ;
						setcookie('remember','') ;
						//pr()
					}
					if($login_counter<=0) {
						e("premiumvariouslogin");
					}
					else {
						e("premiumvariouslogin");
					}			
					exit();		
				}		
			}
		}
	}
	
	function chkcookarr() {
		$cooksql="SELECT * FROM tbl_rems WHERE ip ='".$_SERVER['REMOTE_ADDR']."'";
		$cookarr=$this->User->query($cooksql) ;	
		return $cookarr;
	}	
	function selectmembership() {
		parent::blanklayout();	
	}
	function userdetails() {
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindById($userid)	;
		return $userarr;	
	}
	function profile($msg=NULL) {
		parent::chkblanksession();
		error_reporting(0);
		$userid=$this->Session->Read("userid") ;
		parent::blanklayout();	
		$userarr=$this->User->FindById($userid)	;	
		$ownerhorse_arr=$this->Horse->FindAll("approve_stat='Y' AND ownerid=".$userid." LIMIT 0,7 "); 
		$this->set('ownerhorse_arr',$ownerhorse_arr);
		if($userarr['User']['usertype']=="P") {
			parent::chkusertype();
			$stablenamearr=$this->Stable->FindAll('userid='.$userid); 
			$this->set('stablenamearr',$stablenamearr);
		}
		if(count($ownerhorse_arr)>0) {
			$ownerhorse_allarr=$this->Horse->FindAll("approve_stat='Y'AND ownerid=".$userid); 
			$this->set('ownerhorse_allarr',$ownerhorse_allarr);
		}
		
		$listhorseforsale_sql="SELECT * FROM tbl_horses Horse, tbl_horsesales Sale , tbl_users User ,tbl_sale_remove_horse Remove
							   WHERE Horse.ownerid=User.id AND Sale.horse_id=Horse.id AND User.id=".$userid." AND  Remove.horse_id!=Horse.id  GROUP BY Horse.id";
		$listhorsesalearr=$this->User->query($listhorseforsale_sql) ;
		$this->set('listhorsesalearr',$listhorsesalearr);	
		
		
		
		$breddnamearr1=$this->Horse->FindAll("approve_stat='Y' AND breeder_id=".$userid." LIMIT 0,7 "); 
		$this->set('breddnamearr',$breddnamearr1);
		if(count($breddnamearr)>0) {
			$allbreddnamearr=$this->Horse->FindAll("approve_stat='Y' AND breeder_id=".$this->Session->Read("userid")); 
			$this->set('allbreddnamearr',$allbreddnamearr);
		}
		$this->set('userarr',$userarr);
		$this->set('msg',$msg);
	}
	function viewaccount($user_id=NULL) {
		error_reporting(0);
		$userid=base64_decode($user_id) ;
		$sessuserid=$this->Session->Read("userid") ;
		$usertype=$this->Session->Read("usertype") ;
		if($userid==$sessuserid) {
			if($usertype=="P") {
				$this->redirect('/user/profile');
			}
			if($usertype=="F") {
				$this->redirect('/user/freeuserprofile');
			}
		}
		parent::blanklayout();	
		$userarr=$this->User->FindById($userid)	;	
		$breedname=$userarr['User']['firstname']." ".$userarr['User']['lastname'] ;	
		$ownerhorse_arr=$this->Horse->FindAll("approve_stat='Y' AND ownerid='".$userid."' LIMIT 0,7 "); 
		$this->set('ownerhorse_arr',$ownerhorse_arr);
		if($userarr['User']['usertype']=="P") {
			$stablenamearr=$this->Stable->FindAll('userid='.$userid);
			$this->set('stablenamearr',$stablenamearr);
		}
		if(count($ownerhorse_arr)>0) {
			$ownerhorse_allarr=$this->Horse->FindAll("approve_stat='Y'AND ownerid='".$userid."'"); 
			$this->set('ownerhorse_allarr',$ownerhorse_allarr);
		}		
		$breddnamearr=$this->Horse->FindAll("approve_stat='Y' AND breeder_id='".$userid."' LIMIT 0,7 "); 
		$this->set('breddnamearr',$breddnamearr);
		if(count($breddnamearr)>0) {
			$allbreddnamearr=$this->Horse->FindAll("approve_stat='Y' AND breeder_id='".$userid."'"); 
			$this->set('allbreddnamearr',$allbreddnamearr);
		}
		$this->set('userarr',$userarr);
		$this->set('userid',$userid);
		
		
		$listhorseforsale_sql="SELECT * FROM tbl_horses Horse, tbl_horsesales Sale , tbl_users User ,tbl_sale_remove_horse Remove
							   WHERE Horse.ownerid=User.id AND Sale.horse_id=Horse.id AND User.id=".$userid." AND  Remove.horse_id!=Horse.id  GROUP BY Horse.id";
		$listhorsesalearr=$this->User->query($listhorseforsale_sql) ;
		$this->set('listhorsesalearr',$listhorsesalearr);
				
		if($sessuserid) {	
			$chk_arr=$this->Usersubscription->FindAll("user_id=".$sessuserid." AND usrid=".$userid);
		}
		else {
			$chk_arr='';		
		}
		$this->set('chk_arr',$chk_arr);	
	}	
	
	
	function freeuserprofile($msg=NULL) { 
		parent::chkblanksession();
		error_reporting(0);		
		$userid=$this->Session->Read("userid") ;
		parent::blanklayout();	
		$userarr=$this->User->FindById($userid)	;	
		$ownerhorse_arr=$this->Horse->FindAll("approve_stat='Y' AND ownerid=".$userid." LIMIT 0,7 "); 
		$this->set('ownerhorse_arr',$ownerhorse_arr);
		if($userarr['User']['usertype']=="P") {
			parent::chkusertype();
			$stablenamearr=$this->Stable->FindAll('userid='.$userid); 
			$this->set('stablenamearr',$stablenamearr);
		}
		if(count($ownerhorse_arr)>0) {
			$ownerhorse_allarr=$this->Horse->FindAll("approve_stat='Y'AND ownerid=".$userid); 
			$this->set('ownerhorse_allarr',$ownerhorse_allarr);
		}		
		$breddnamearr1=$this->Horse->FindAll("approve_stat='Y' AND breeder_id=".$userid." LIMIT 0,7 "); 
		$this->set('breddnamearr',$breddnamearr1);
		if(count($breddnamearr)>0) {
			$allbreddnamearr=$this->Horse->FindAll("approve_stat='Y' AND breeder_id=".$this->Session->Read("userid")); 
			$this->set('allbreddnamearr',$allbreddnamearr);
		}
		$this->set('userarr',$userarr);
		$this->set('msg',$msg);		
	}	
	
	function freeuserlogout() {
		parent::blanklayout();	
		$userid=$this->Session->Read("userid") ;
		$this->data['User']['logoutdate']=date("Y-m-d");
		$this->User->id=$userid;
		$this->User->save($this->data);
		$this->Session->destroy("usertype") ;		
		$this->Session->destroy("userid") ;	
		$this->Session->destroy("username") ;	
		$this->Session->destroy("email_address") ;
		$this->Session->setFlash('You have successfully been logged out.');
		$this->redirect('/content/front');
	}	
	function account($msg=NULL) {
		parent::chkblanksession();
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindById($userid);
		parent::blanklayout();
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$admin_arr=$this->Admin->FindByid(1);
		$this->set('admin_arr',$admin_arr);
		$state_arr='';
		if(is_numeric($userarr['User']['countryid'])) {
			$state_arr=$this->State->FindAll("status='Y' AND country_id=".$userarr['User']['countryid']);
		}
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y'");
		$this->set('town_arr',$town_arr);	
		$this->set('state_arr',$state_arr);	
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/useraccount');
		}
		if(!empty($this->data)) {
			$userarr=$this->User->FindByid($userid) ;
			if($this->data['User']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['User']['image'], 'profileimage', '', 'profileimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
				$this->data['User']['image']=$img;
				$this->User->id=$userid;				
				$this->User->save($this->data);
				$this->redirect('/user/account/succ');
			}
			$this->data['User']['image']=$userarr['User']['image'] ;
			$this->User->id=$userid;
		    $this->data['User']['countryid']=$this->data['Horse']['countryid']	;
			$this->data['User']['state_id']=$this->data['Horse']['state_id']	;
			$this->data['User']['town_id']=$this->data['Horse']['town_id']	;
			$this->data['User']['edited_date']=date("Y-m-d");
			
			
			$notisubscriptionsqlupdate="UPDATE tbl_usersubscriptions SET  yesstatus='Y' WHERE usrid=".$userid ;
			$this->User->query($notisubscriptionsqlupdate) ;
			
			$this->User->save($this->data);
			
			
			
			
			$this->redirect('/user/profile/succ');
		}	
		$this->set('userarr',$userarr);
		$this->set('msg',$msg);
	}	
	
	function useraccount($msg=NULL) {
		parent::chkblanksession();
		$userid=$this->Session->Read("userid") ;
		$userarr=$this->User->FindById($userid);
		parent::blanklayout();
		$admin_arr=$this->Admin->FindByid(1);
		$this->set('admin_arr',$admin_arr);
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$state_arr='';
		if(is_numeric($userarr['User']['countryid'])) {
			$state_arr=$this->State->FindAll("status='Y' AND country_id=".$userarr['User']['countryid']);
		}
		$this->set('country_arr',$country_arr);
		$town_arr=$this->Town->FindAll("status='Y'");
		$this->set('town_arr',$town_arr);	
		$this->set('state_arr',$state_arr);	
		if(!empty($this->data)) {
			$userarr=$this->User->FindByid($userid) ;
			$this->data['User']['edited_date']=date("Y-m-d");
			$notisubscriptionsqlupdate="UPDATE tbl_usersubscriptions SET  yesstatus='Y' WHERE usrid=".$userid ;
			$this->User->query($notisubscriptionsqlupdate) ;
			
			
			if($this->data['User']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['User']['image'], 'profileimage', '', 'profileimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
				$this->data['User']['image']=$img;
				$this->User->id=$userid;				
				$this->User->save($this->data);
				$this->redirect('/user/useraccount');
			}
			else {
				$this->data['User']['image']=$userarr['User']['image'] ;
				$this->User->id=$userid;
				$this->data['User']['countryid']=$this->data['Horse']['countryid']	;
				$this->data['User']['state_id']=$this->data['Horse']['state_id']	;
				$this->data['User']['town_id']=$this->data['Horse']['town_id']	;
				$this->User->save($this->data);
				$this->redirect('/user/freeuserprofile/succ');
			}
		}	
		$this->set('userarr',$userarr);
		$this->set('msg',$msg);
	}	
	function chksession() {
		$userid=$this->Session->Read("userid") ;
		return $userid;
	}	
	function confirmpayment() {
		parent::blanklayout();		
		$email=$this->Session->Read("email") ;
		if($email=="") {
			$this->redirect('/user/newuser');		
		}
		$userarr=$this->User->FindByemail_address($email);
		$this->set('userarr',$userarr);
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);
	}
	function payment($price=NULL) {
		parent::blanklayout();
		$email=$this->Session->Read("email") ;
		if($email=="") {
			$this->redirect('/user/newuser');		
		}
		$userarr=$this->User->FindByemail_address($email);
		$this->set('userarr',$userarr);
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);	
		$dur='';
		$price='';
		$paymemtoption='';
		if($this->data['User']['expiration_time_periode']=='6 months') {
			$dur='6 Months' ;
			$price=$seetingarr['Setting']['6_months_proce'];
		}
		if($this->data['User']['expiration_time_periode']=='1 Year') {
			$price=$seetingarr['Setting']['1_year_price'];
			$dur='1 Year' ;
		}
		if($this->data['User']['expiration_time_periode']=='1 Year 6 months') {
			$price=$seetingarr['Setting']['1_half_year_price'];
			$dur='1 Year 6 months' ;
		}
		if($this->data['User']['expiration_time_periode']=='2 Years') {
			$dur='2 Years' ;
			$price=$seetingarr['Setting']['2_year_price'];
		}		
		$this->Session->write('expiration_time_periode',$this->data['User']['expiration_time_periode']);		
		$this->set('price',$price);	
		$this->set('dur',$dur);	
		$this->set('email',$email);	
	}
	
	function paymodeuser($duration=NULL,$payoption=NULL) {
		$firstname=$this->Session->Read("firstname");
		$durationexpiration=strtotime("+ ".$duration);
		$membershipexpiration=date("Y-m-d",$durationexpiration);
		$this->data['User']['usertype']='P';
		$this->data['User']['login_stat']='N';
		$this->data['User']['firstname']=$this->Session->Read("firstname") ;
		$this->data['User']['lastname']=$this->Session->Read("lastname") ;
		$this->data['User']['email_address']=$this->Session->Read("email") ;
		$this->data['User']['image']=$this->Session->Read("profileimage") ;
		$this->data['User']['password']=base64_encode($this->Session->Read("password")) ;
		$this->data['User']['registered_date']=date("Y-m-d");
		$this->data['User']['expiration_time_periode']=$duration ;
		$this->data['User']['membership_exipre_date']=$membershipexpiration ;
		$this->data['User']['payment_option']=$payoption ;
		if($this->User->save($this->data)) {
			echo "1" ;
			$userid=$lastid=$this->User->getLastInsertId();	
			$adminArr = $this->Admin->FindByid(1);	
			$textContent2='';
			$textContent2='Dear,<b>'.$this->Session->Read("firstname").' '.$this->Session->Read("lastname").'</b><br>You have registered as paid user with Indian  Horse database<br>
			<a href=http://www.indianhorsedatabase.com/user/confirmlink/'.base64_encode($userid).'>Click Here </a> To activate your account <br>
			This is your login information: <br>
			Email Address : <b>'.$this->Session->Read("email").'</b><br>
			Password      :'.$this->Session->Read("password").'</b> 
			<br>
			Thanks
			Indian Horse Database';		
			$textContent2 = stripslashes($textContent2);						
			$this->set("message", $textContent2);
			$this->Email->to = $this->Session->Read("email") ;
			$this->Email->subject = 'Indian Horse Data base';
			$this->Email->replyTo = $adminArr['Admin']['admin_email'];
			$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
			$this->Email->template	= 'email/customer' ; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$this->Email->send();		
			exit() ;
		}
		else {
			e("0");
			exit();
		}
	}	
	function freemembersignup($login=NULL){
		parent::blanklayout();	
		if(!empty($this->data)) {
			if($this->data['User']['image']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['User']['image'], 'profileimage', '', 'profileimage'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img='';
			}
			$this->Session->write('profileimage',$img);
		}
		else {
			$profileimage=$this->Session->Read("profileimage");
			if(@unlink(rootpth()."profileimage/".$profileimage)) {	
			}
			$this->Session->Destroy("profileimage");
		}		
		$profileimage=$this->Session->Read("profileimage");
		$this->set('profileimage',$profileimage);
		$this->set('login',$login);
	}
	function addfreeuser($firstname=NULL,$lastname=NULL,$email=NULL,$password=NULL) {
		parent::blanklayout();	
		$msg='';
		$userarr=$this->User->FindAll("email_address='".$email."'");
		if(count($userarr)>0) {
			$msg='<font color=#FF0000>Email already exists </font>';
		}
		else {
			$this->data['User']['usertype']='F';
			$this->data['User']['firstname']=$firstname ;
			$this->data['User']['lastname']=$lastname ;
			$this->data['User']['email_address']=$email ;
			$this->data['User']['login_stat']="N";
			$this->data['User']['image']=$this->Session->Read("profileimage") ;
			$this->data['User']['password']=base64_encode($password);
			$this->data['User']['registered_date']=date("Y-m-d");
			$this->User->save($this->data);
			$userid=$lastid=$this->User->getLastInsertId();		
			$adminArr = $this->Admin->FindByid(1);	
			$textContent2='';
			$textContent2='Dear,<b>'.$firstname.' '.$lastname.'</b><br>You have registered as free user with Indian  Horse database<br>
			<a href=http://www.indianhorsedatabase.com/user/confirmlink/'.base64_encode($userid).'>Click Here </a> To activate your account <br>
			This is your login information: <br>
			Email Address : <b>'.$email.'</b><br>
			Password      :'.$password.'</b> 
			<br>
			Thanks
			Indian Horse Database';		
			$textContent2 = stripslashes($textContent2);						
			$this->set("message", $textContent2);
			$this->Email->to = $email ;
			$this->Email->subject = 'Indian Horse Data base';
			$this->Email->replyTo = $adminArr['Admin']['admin_email'];
			$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
			$this->Email->template	= 'email/customer' ; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$this->Email->send();
			echo "1" ; 
			exit() ;
		}
		$this->set('msg',$msg);
	}	
	function resend($email=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("email_address='".$email."' AND 	usertype='F'");	
		$userid=$userarr[0]['User']['id'];		
		$firstname=$userarr[0]['User']['firstname'];
		$lastname=$userarr[0]['User']['lastname'];
		$password=base64_decode($userarr[0]['User']['password']);
		
		$adminArr = $this->Admin->FindByid(1);	
		$textContent2='';
		$textContent2='Dear,<b>'.$firstname.' '.$lastname.'</b><br>You have registered as free user with Indian  Horse database<br>
		<a href=http://www.indianhorsedatabase.com/user/confirmlink/'.base64_encode($userid).'>Click Here </a> To activate your account <br>
		This is your login information: <br>
		Email Address : <b>'.$email.'</b><br>
		Password      :'.$password.'</b> 
		<br>
		Thanks
		Indian Horse Database';		
		$textContent2 = stripslashes($textContent2);						
		$this->set("message", $textContent2);
		$this->Email->to = $email ;
		$this->Email->subject = 'Indian Horse Data base';
		$this->Email->replyTo = $adminArr['Admin']['admin_email'];
		$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
		$this->Email->template	= 'email/customer' ; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->send();
		$msg=" Email has been sent to your account ";
		$this->set('msg',$msg);
		echo $msg ;
		exit() ;	
	}
	
	
	
	function resendpaid($email=NULL) {
		parent::blanklayout();
		$userarr=$this->User->FindAll("email_address='".$email."'");	
		$userid=$userarr[0]['User']['id'];		
		$firstname=$userarr[0]['User']['firstname'];
		$lastname=$userarr[0]['User']['lastname'];
		$password=base64_decode($userarr[0]['User']['password']);
		
		$adminArr = $this->Admin->FindByid(1);	
		$textContent2='';
		$textContent2='Dear,<b>'.$firstname.' '.$lastname.'</b><br>You have registered as paid user with Indian  Horse database<br>
		<a href=http://www.indianhorsedatabase.com/user/confirmlink/'.base64_encode($userid).'>Click Here </a> To activate your account <br>
		This is your login information: <br>
		Email Address : <b>'.$email.'</b><br>
		Password      :'.$password.'</b> 
		<br>
		Thanks
		Indian Horse Database';		
		$textContent2 = stripslashes($textContent2);						
		$this->set("message", $textContent2);
		$this->Email->to = $email ;
		$this->Email->subject = 'Indian Horse Data base';
		$this->Email->replyTo = $adminArr['Admin']['admin_email'];
		$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
		$this->Email->template	= 'email/customer' ; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->send();
		$msg=" Email has been sent to your account ";
		$this->set('msg',$msg);
		echo $msg ;
		exit() ;	
	}	
	function premiumuserwelcomepage($chk=NULL) { 
		$userid=$this->Session->Read("userid") ;
		parent::blanklayout();
		parent::chkblanksession();	
		parent::chklogincounter();	
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/freeuserwelcomepage');
		}
		$userdetailarr=$this->User->FindByid($userid);
		$liststablechange_sql="SELECT * FROM tbl_stables Stable ,tbl_stablesubscriptions Stablesubscribtion WHERE Stable.status='Y' AND 
							   Stable.id=Stablesubscribtion.stable_id AND Stablesubscribtion.user_id=".$userid." 
							   AND Stable.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$liststablearr=$this->Usersubscription->query($liststablechange_sql) ;
		$this->set('liststablearr',$liststablearr);		
		$listuserchane_sql="SELECT * FROM tbl_users User ,tbl_usersubscriptions Usersubscription WHERE User.login_stat='Y' AND 
							   User.id=Usersubscription.usrid AND Usersubscription.yesstatus='Y' AND Usersubscription.user_id=".$userid." 
							   AND User.edited_date>='".$userdetailarr['User']['logoutdate']."' ";
		$listuserarr=$this->Usersubscription->query($listuserchane_sql) ;
		$this->set('listuserarr',$listuserarr);		
		$lishorsechange_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id  AND Horsesubscribtion.yesstatus='Y' AND Horsesubscribtion.user_id=".$userid." 
							   AND Horse.edited_date>='".$userdetailarr['User']['logoutdate']."'";
		$listhorsearr=$this->Usersubscription->query($lishorsechange_sql) ;
		$this->set('listhorsearr',$listhorsearr);		
		$addedhorsenew_sql="SELECT * FROM tbl_horses Horse ,tbl_horsesubscriptions Horsesubscribtion WHERE Horse.approve_stat='Y' AND 
							   Horse.id=Horsesubscribtion.horse_id AND Horsesubscribtion.user_id=".$userid." 
							   AND Horse.posted_date>='".$userdetailarr['User']['logoutdate']."' Group By Horse.id"; 
		$newuserhorsepostarr=$this->Usersubscription->query($addedhorsenew_sql) ;
		$this->set('newuserhorsepostarr',$newuserhorsepostarr);	
		$userarr=$this->User->FindByid($userid);
		$changeeditnotofication_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Horse.ownerid=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
											
		$changenotiarr=$this->Horse->query($changeeditnotofication_sql) ;
		$this->set('changenotiarr',$changenotiarr);			
		$breedernotification_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Horse.breeder_id=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."'  ORDER BY Changerequest.id DESC "; 
		$breederarr=$this->Horse->query($breedernotification_sql) ;
		
		$addernotification_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Horse.addedby=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
		$adderarr=$this->Horse->query($addernotification_sql) ;
		$this->set('adderarr',$adderarr);	
		$this->set('breederarr',$breederarr);	
		$notificationarr=$this->Notification->FindAll("user_id=".$userid,'','ORDER BY id desc','','');
		$this->set('notificationarr',$notificationarr);	
		
		
		$oldownernotification_sql="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Changerequest.ownerid=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
											
		$oldownerarr=$this->Horse->query($oldownernotification_sql) ;
		$this->set('oldownerarr',$oldownerarr);		
		
		
		$oldbreeder_notification="SELECT * FROM tbl_horses Horse, tbl_changerequesthorses Changerequest 
									WHERE Horse.id=Changerequest.horse_id AND Changerequest.approve_status='Y' AND 
									Changerequest.breeder_id=".$userid." AND Changerequest.changed_date>='".$userdetailarr['User']['logoutdate']."' ORDER BY Changerequest.id DESC "; 
		$oldbrederarr=$this->Horse->query($oldbreeder_notification) ;
		$this->set('oldbrederarr',$oldbrederarr);
			
		$this->set('userid',$userid);		
	}	
	function chklogincounter() {
		$login_counter=$this->Session->Read("login_counter") ;
		return $login_counter;
	}
	function newuser() {
		$userid=$this->Session->Read("userid") ;
		if($userid!="") {
			$this->redirect('/content/front');
		}
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Log In%'");
		$this->set('homecontent_arr',$homecontent_arr);
		parent::blanklayout();	
	}	
	function usertype() {
		$usertype=$this->Session->Read("usertype") ;
		return $usertype;	
	}	
	function confirmlink($userid=NULL) {
		parent::blanklayout();
		$userid=base64_decode($userid);
		$this->User->id=$userid;
		$useridarr=$this->User->Read();
		$this->set('useridarr',$useridarr);
		$this->data['User']['login_stat']="Y";
		$this->User->save($this->data);			
		$adminArr = $this->Admin->FindByid(1);	
		$textContent2='';
		$textContent2='Dear,<b>'.$useridarr['User']['firstname'].' '.$useridarr['User']['lastname'].'</b><br>You have successfully activated your account with Indian  Horse database<br>
		This is your login information: <br>
		Email Address : <b>'.$useridarr['User']['email_address'].'</b><br>
		Password      :'.base64_decode($useridarr['User']['password']).'</b> 
		<br>
		<a href=http://www.indianhorsedatabase.com/user/signup/paidmember/loginhere>Click Here </a> To Login 
		<br>
		Thanks
		Indian Horse Database';		
		$textContent2 = stripslashes($textContent2);						
		$this->set("message", $textContent2);
		$this->Email->to = $useridarr['User']['email_address'] ;
		$this->Email->subject = 'Indian Horse Data base';
		$this->Email->replyTo = $adminArr['Admin']['admin_email'];
		$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
		$this->Email->template	= 'email/customer' ; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->send();		
		if($useridarr['User']['usertype']=="F") {
			$this->redirect('/user/freemembersignup/login'); 
		}
		if($useridarr['User']['usertype']=="P") {
			$this->redirect('/user/signup/paidmember/login');
		}
	}	
	function username($user_id=NULL) {
		return $this->User->FindByid($user_id) ;
	}	
	function subscribefornotification($user_id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$msg='';
		$chk_arr=$this->Usersubscription->FindAll("user_id=".$userid." AND usrid=".$user_id);
		if(count($chk_arr)>0) {
			$msg='<font color=#FF0000>You have already subscribed for this user </font>';
		}
		else {
			$this->data['Usersubscription']['user_id']=$userid;
			$this->data['Usersubscription']['usrid']=$user_id; 
			$this->Usersubscription->save($this->data);
			$msg='<font color=#FF0000>You have successfully subscribed for this user </font>';
		}
		$this->set('msg',$msg);	
	} 
	function unsubscribefornotification($user_id=NULL) { 
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ; 
		$msg='';
		$chk_arr=$this->Usersubscription->FindAll("user_id=".$userid." AND usrid=".$user_id);
		if(count($chk_arr)<=0) {
			$msg='<font color=#FF0000>You have not subscribed for this user </font>';
		}
		else {
			$del_sql="DELETE FROM tbl_usersubscriptions WHERE user_id=".$userid." AND usrid=".$user_id; 
			$this->Usersubscription->query($del_sql) ;
			$msg='<font color=#FF0000>You have successfully unsubscribed for this user </font>'; 
		}
		$this->set('msg',$msg);	
	}	
	
	function chkdeactivated($user_id=NULL) {
		$deactivate_sql="SELECT * FROM tbl_user_accountdeactivate Deactivated WHERE Deactivated.user_id=".$user_id;
		$deactivatearr= $this->User->query($deactivate_sql) ;
		return $deactivatearr;
		
	}
		function thankuforpayment() {
			$email=$this->Session->Read("email") ;
			if($email=="") {
				$this->redirect('/user/signup/paidmember');
			}
			if(isset($_REQUEST['tx'])) {
				$arrConfirm = $this->process_pdt($_REQUEST['tx'] , $_REQUEST['cm']);			
				if(!empty($arrConfirm)) {			
				/**not for total company payment**/
				$arrReply = explode('+', $_REQUEST['cm']);		
				$id =  $arrReply[0] ;
				
				if(isset($arrReply[1])){
					$type = $arrReply[1] ;
					
				}else{
					$type = '' ;				
				}		
				if($type != ''){
					if($type=="premuim") {
						$email=$this->Session->Read("email") ;
						$update_sql="UPDATE tbl_users SET payment_status='Y',login_stat='Y' WHERE 	email_address='".$email."'";
						$useridarr=$this->User->FindByemail_address($email) ;
						$this->Horse->query($update_sql);
						$adminArr = $this->Admin->FindByid(1);	
						$textContent2='';
						$textContent2='Dear,<b>'.$useridarr['User']['firstname'].' '.$useridarr['User']['lastname'].'</b><br>You have successfully  purchased premuim membership service
						<br>
						Your service is for <b>'.$useridarr['User']['expiration_time_periode'].'</b><br>
						And expiration of your service is <b>'.$useridarr['User']['membership_exipre_date'].'</b>
						<br>
						Thanks
						Indian Horse Database';		
						$textContent2 = stripslashes($textContent2);						
						$this->set("message", $textContent2);
						$this->Email->to = $useridarr['User']['email_address'] ;
						$this->Email->subject = 'Purchase Of Premium membership service';
						$this->Email->replyTo = $adminArr['Admin']['admin_email'];
						$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
						$this->Email->template	= 'email/customer' ; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')
						if($this->Email->send()) {
							$this->redirect('/user/purchasesuccessformembershipaccess');
						}					
					}			
				}
			}	
		}
	}	
	function thankuforpaymentforupgrate() {
			$userid=$this->Session->Read("userid") ;
			//die();
			if($userid=="") {
				//$this->redirect('/user/signup/paidmember');
			}
			if(isset($_REQUEST['tx'])) {
				$arrConfirm = $this->process_pdt($_REQUEST['tx'] , $_REQUEST['cm']);			
				if(!empty($arrConfirm)) {			
				/**not for total company payment**/
				$arrReply = explode('+', $_REQUEST['cm']);		
				$id =  $arrReply[0] ;
				if(isset($arrReply[1])){
					$type = $arrReply[1] ;
					
				}else{
					$type = '' ;				
				}
				if($type != ''){
					if($type=="upgradepremuim") {
						$userid =$id ;					
						$this->User->id=$userid ;
						$this->data['User']['usertype']='P';	
						$useridarr=$this->User->FindByid($userid) ;	
						$curreexpiration=$useridarr['User']['membership_exipre_date'] ;
						$membershipexpiration=strtotime("+".$arrReply[2]);						
						$membershipexpiredate=date("Y-m-d",$membershipexpiration);
						$this->data['User']['membership_exipre_date']=$membershipexpiredate;
						$this->data['User']['payment_status']='Y';
						$this->data['User']['expiration_time_periode']=$arrReply[2] ;
						$this->User->save($this->data);						
						$update_sql="UPDATE tbl_users SET payment_status='Y',login_stat='Y' WHERE 	id='".$userid."'";
						$useridarr=$this->User->FindByid($userid) ;						
						$this->Horse->query($update_sql);
						$adminArr = $this->Admin->FindByid(1);	
						$textContent2='';
						$textContent2='Dear,<b>'.$useridarr['User']['firstname'].' '.$useridarr['User']['lastname'].'</b><br>You have successfully  purchased premuim membership service
						<br>
						Your service is for <b>'.$useridarr['User']['expiration_time_periode'].'</b><br>
						And expiration of your service is <b>'.$membershipexpiredate.'</b>
						<br>
						Thanks
						<br>
						Indian Horse Database';		
						$textContent2 = stripslashes($textContent2);						
						$this->set("message", $textContent2);
						$this->Email->to = $useridarr['User']['email_address'] ;
						$this->Email->subject = 'Purchase Of Premium membership service';
						$this->Email->replyTo = $adminArr['Admin']['admin_email'];
						$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
						$this->Email->template	= 'email/customer' ; // note no '.ctp'
						$this->Email->send() ;
						$this->redirect('/user/purchaseextensionsuccess/'.base64_encode($id));						
					}			
				}
			}	
		}		
	}
	function thankyouforextension() {
			$userid=$this->Session->Read("userid") ;
			if($userid=="") {
				//$this->redirect('/user/signup/paidmember');
			}
			if(isset($_REQUEST['tx'])) {
				$arrConfirm = $this->process_pdt($_REQUEST['tx'] , $_REQUEST['cm']);			
				if(!empty($arrConfirm)) {			
				/**not for total company payment**/
				$arrReply = explode('+', $_REQUEST['cm']);		
				$id =  $arrReply[0] ;
				
				if(isset($arrReply[1])){
					$type = $arrReply[1] ;
					
				}else{
					$type = '' ;				
				}		
				if($type != ''){
					if($type=="membershipextension") {
						$this->User->id=$userid ;
						$this->data['User']['usertype']='P';
						
						$useridarr=$this->User->FindByid($userid) ;		
						$curreexpiration=$useridarr['User']['membership_exipre_date'] ;
						$this->Session->Read("expiration_time_periode");
						$durationexpiration=strtotime(" $curreexpiration + ".$this->Session->Read("expiration_time_periode"));
						$membershipexpiration=date("Y-m-d",$durationexpiration);
						$this->data['User']['membership_exipre_date']=$membershipexpiration;
						$this->data['User']['payment_status']='Y';
						$this->data['User']['expiration_time_periode']=$this->Session->Read("expiration_time_periode") ;
						$this->User->save($this->data);					
						
						$update_sql="UPDATE tbl_users SET payment_status='Y',login_stat='Y' WHERE  id='".$userid."'";										
						$this->Horse->query($update_sql);
						$adminArr = $this->Admin->FindByid(1);	
						$textContent2='';
						$textContent2='Dear,<b>'.$useridarr['User']['firstname'].' '.$useridarr['User']['lastname'].'</b><br>You have successfully  purchased premuim membership service
						<br>
						Your service is for <b>'.$useridarr['User']['expiration_time_periode'].'</b><br>
						And expiration of your service is <b>'.$membershipexpiration.'</b>
						<br>
						Thanks
						<br>
						Indian Horse Database';		
						$textContent2 = stripslashes($textContent2);						
						$this->set("message", $textContent2);
						$this->Email->to = $useridarr['User']['email_address'] ;
						$this->Email->subject = 'Extension Of Premium membership service';
						$this->Email->replyTo = $adminArr['Admin']['admin_email'];
						$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
						$this->Email->template	= 'email/customer' ; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')						
						$usertype='P';
						$this->Email->send() ;
						$this->Session->setFlash('You have successfully completed the payment. Please check your membership status');
						$this->redirect('/user/purchasesuccessformembershipaccess');											
					}	
					if($type=="membershipexpiration") {
						$this->User->id=$userid ;
						$this->data['User']['usertype']='P';						
						$useridarr=$this->User->FindByid($userid) ;		
						$curreexpiration=$useridarr['User']['membership_exipre_date'] ;
						$this->Session->Read("expiration_time_periode");
						$membershipexpiration=strtotime("+".$this->Session->Read("expiration_time_periode"));						
						$membershipexpiredate=date("Y-m-d",$membershipexpiration);
						$this->data['User']['membership_exipre_date']=$membershipexpiredate;
						$this->data['User']['payment_status']='Y';
						$this->data['User']['expiration_time_periode']=$this->Session->Read("expiration_time_periode") ;
						$this->User->save($this->data);						
						$update_sql="UPDATE tbl_users SET payment_status='Y',login_stat='Y' WHERE 	id='".$userid."'";
						$useridarr=$this->User->FindByid($userid) ;						
						$this->Horse->query($update_sql);
						
						$adminArr = $this->Admin->FindByid(1);	
						$textContent2='';
						$textContent2='Dear,<b>'.$useridarr['User']['firstname'].' '.$useridarr['User']['lastname'].'</b><br>You have successfully  activated your premuim membership service
						<br>
						Your service is for <b>'.$useridarr['User']['expiration_time_periode'].'</b><br>
						And expiration of your service is <b>'.$useridarr['User']['membership_exipre_date'].'</b>
						<br>
						Thanks
						<br>
						Indian Horse Database';		
						$textContent2 = stripslashes($textContent2);						
						$this->set("message", $textContent2);
						$this->Email->to = $useridarr['User']['email_address'] ;
						$this->Email->subject = 'Activation Of Premium membership service';
						$this->Email->replyTo = $adminArr['Admin']['admin_email'];
						$this->Email->from = 'Indian Horse Data base <'.$adminArr['Admin']['admin_email'].'>';
						$this->Email->template	= 'email/customer' ; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')						
						$usertype='P';
						$this->Email->send() ;
						$this->Session->write('usertype',$usertype);
						$this->redirect('/user/purchasesuccessformembership');					
					}							
				}
			}	
		}
	}	
	function purchasesuccessformembership() {
		parent::blanklayout();
		$userid =$_SESSION['updatenewid'] ;				
		if($userid=="") {
			//$this->redirect('/user/signup/paidmember');
		}
		$userarr=$this->User->FindByid($userid) ;
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);
		$this->set('userarr',$userarr);
	}	
	
	function purchasesuccessformembershipaccess($id) {
		parent::blanklayout();
		$useridarr=$this->User->FindByid(base64_decode($id)) ;	
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);
		$this->set('userarr',$useridarr);
	}	
	
	
	function purchaseextensionsuccess() {
		parent::blanklayout();
		$email=$this->Session->Read("email") ;
		if($email=="") {
			//$this->redirect('/user/signup/paidmember');
		}
		$userid=$this->Session->Read("userid") ;
		$useridarr=$this->User->FindByid($userid) ;	
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);
		$this->set('userarr',$useridarr);	
	}	
	function purchasesuccess() {
		parent::blanklayout();
		$email=$this->Session->Read("email") ;
		if($email=="") {
			//$this->redirect('/user/signup/paidmember');
		}
		$userarr=$this->User->FindByemail_address($email) ;
		$seetingarr=$this->Setting->FindByid(1);
		$this->set('seetingarr',$seetingarr);
		$this->set('userarr',$userarr);
	}
	
	
	function cancelpremiummembership() {
		parent::chkblanksession();
		$userid=$this->Session->Read("userid") ;		
		$update_sql="UPDATE tbl_users SET usertype='F',payment_status='N' , expiration_time_periode='' , 
					membership_exipre_date='' , payment_option=''  WHERE id=".$userid ;
		$this->User->query($update_sql);
		//$this->Session->setFlash('Your Premium membership has been cancelled. Now you can login as free user');	
		$this->Session->destroy("usertype") ;		
		$this->Session->destroy("userid") ;	
		$this->Session->destroy("username") ;	
		$this->Session->destroy("email_address") ;						
		$this->redirect('/user/newuser');			
	}
	
		
	function process_pdt($tx,$custom)
	{ 
		$request = curl_init();
	
		curl_setopt_array($request,array(
			//CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr' ,
			CURLOPT_URL => 'https://www.paypal.com/cgi-bin/webscr' ,
			CURLOPT_POST => TRUE,
			CURLOPT_POSTFIELDS => http_build_query(array
			(
				'cmd' => '_notify-synch',
				'tx' => $tx,
				'custom' => $custom,			
				'at' => 'WlaU8cGrjVVnvr5OpMtjhDWR4Pejd9VGaqnjgJ-1M7FB5QOz_P7slESiui0',////////////////////////////////////////////LIVE 
			    //'at' => 'Kxan0MqyG5JF6sJKLSIoXclp9pgjEgOzIYeJugzjQZN_IRTMc2VgfjQ4VWO',////////////////////////////////SANBOX
			)),
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HEADER => FALSE,
			CURLOPT_SSL_VERIFYPEER => FALSE,
			CURLOPT_CAINFO => 'cacert.pem',
		));
		// Execute request and get response and status code
		$response = curl_exec($request);
		$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);	
		// Close connection
		curl_close($request);
		// Validate response	
		if($status == 200 AND strpos($response, 'SUCCESS') === 0)
		{	
			// Remove SUCCESS part (7 characters long)
			$response = substr($response, 7);
	
			// Urldecode it
			$response = urldecode($response);
	
			// Turn it into associative array
			preg_match_all('/^([^=\r\n]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);
			$response = array_combine($m[1], $m[2]);
	
			// Fix character encoding if needed
			if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')
			{
				foreach($response as $key => &$value)
				{
					$value = mb_convert_encoding($value, 'UTF-8', $response['charset']);
				}	
				$response['charset_original'] = $response['charset'];
				$response['charset'] = 'UTF-8';
			}
	
			// Sort on keys
			ksort($response);	
			// Done! pr
			return $response;
		}
		return false;
	}	
	function deletenotification($id=NULL) {
		$this->Notification->id=$id;
		$this->Notification->delete();
		$usertype=$this->Session->Read("usertype") ;
		if($usertype=="F") {
			$this->redirect('/user/freeuserwelcomepage');
		}
		if($usertype=="P") {
			$this->redirect('/user/premiumuserwelcomepage');
		}	
	}	
	
	function delusersubscribtion($id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		if($userid=="") {
			$this->redirect('/user/signup/paidmember');
		}
		$delsql=" DELETE FROM tbl_usersubscriptions WHERE id=".$id;
		$this->User->query($delsql) ;
		$this->redirect('/user/premiumuserwelcomepage');	
	}
	function stabledelsubscribtion($id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		if($userid=="") {
			$this->redirect('/user/signup/paidmember');
		}
		$delsql=" DELETE FROM tbl_stablesubscriptions WHERE id=".$id;
		$this->User->query($delsql) ;
		$this->redirect('/user/premiumuserwelcomepage');	
	}	
	function stabledelsubscribtionfront($id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		if($userid=="") {
			$this->redirect('/user/signup/paidmember');
		}
		$delsql=" DELETE FROM tbl_stablesubscriptions WHERE id=".$id;
		$this->User->query($delsql) ;
		$this->redirect('/user/premiumuserwelcomepage');	
	}	
	function usersubscriptiondel($id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		if($userid=="") {
			$this->redirect('/user/signup/paidmember');
		}
		$delsql=" UPDATE tbl_usersubscriptions  SET yesstatus='N' WHERE id=".$id;
		$this->User->query($delsql) ;
		$this->redirect('/user/premiumuserwelcomepage');	
	}	
	
	
	function horsedeletesubscription($id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		if($userid=="") {
			$this->redirect('/user/signup/paidmember');
		}
		$delsql=" UPDATE tbl_horsesubscriptions SET yesstatus='N' WHERE id=".$id;
		$this->User->query($delsql) ;
		$this->redirect('/user/premiumuserwelcomepage');	
	}
	
	
	function delhorsesubsnoti($id=NULL) {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		if($userid=="") {
			$this->redirect('/user/signup/paidmember'); 
		}
		$delsql=" DELETE FROM tbl_horsesubscriptions WHERE id=".$id;
		$this->User->query($delsql) ;
		$this->redirect('/user/premiumuserwelcomepage');	
	}
	function cancel() {
		parent::blanklayout();
	}
	
} # end of the class
?>