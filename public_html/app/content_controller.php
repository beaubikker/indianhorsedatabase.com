<?php
ob_start();
class ContentController extends AppController
{ 
	var $name		= "Content" ;
	var $helpers 	= array( 'Html', 'Fck', 'Javascript','Pagination' ,'Rsz');
	var $components	= array('Pagination','Upload','Email');	
	var $uses=array('Content','Admin','User','Horse','Stable','Town','Country','State','Usersubscription','Membership','Notification','Listingpaid','Listingfree');
	function index()
	{	
		parent::adminlayout(); 
		parent::checkAdminSession();
		$pagetotal=$this->Content->Find('count');		
		$this->set('pagetotal',$pagetotal);		
		$criteria=NULL;
		$this->set('listarr', $this->Content->findAll('','','order by id desc','','')); 
		$this->set('listarr', $this->_paginate_leads($criteria)); //in app/app_controller
	}	
	function _paginate_leads($criteria) {		
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Content->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}
	function Stats() {
		error_reporting(0);
		parent::adminlayout(); 
		parent::checkAdminSession();
		$horsecount=$this->Horse->FindAll("");
		$this->set('horsecount',count($horsecount));
		$usercount=$this->User->FindAll("");
		$this->set('usercount',count($usercount));	
		$premiumarr=$this->User->FindAll("usertype='P'");
		$this->set('premiumarr',count($premiumarr));	
		$stablecount=$this->Stable->FindAll("");
		$this->set('stablecount',count($stablecount));		
		$noofhorsesale_sql="SELECT * FROM tbl_horses Horse, tbl_horsesales Sale 
							WHERE Horse.id=Sale.horse_id AND Sale.salesfor='Sale'" ;
		$noofhorsesalearr=$this->User->query($noofhorsesale_sql) ;
		$this->set('noofhorsesalearr',count($noofhorsesalearr));
		
		$noofhorseforstud_sql="SELECT * FROM tbl_horses Horse, tbl_horseforstuds Sale 
							WHERE Horse.id=Sale.horse_id AND Sale.	studstatus='Y'" ;
		$noofhorsestudarr=$this->User->query($noofhorseforstud_sql) ;
		$this->set('noofhorsestudarr',count($noofhorsestudarr));		
		$durationexpiration=strtotime("- 5 days"); 
		$fivedaysbeforedate=date("Y-m-d",$durationexpiration);		
		$lstfivedaysarr=$this->User->FindAll("registered_date>='".$fivedaysbeforedate."'");
		$this->set('lstfivedaysarr',count($lstfivedaysarr));				
	}	
	function sitenews($orderby=NULL) {
		error_reporting(0) ; 
		parent::adminlayout(); 
		parent::checkAdminSession();
		$latesthorsearr=$this->Horse->FindAll('','','order by id desc',' LIMIT 0,1 ',' '); 
		$this->set('latesthorsearr',$latesthorsearr);		
		$lateststablearr=$this->Stable->FindAll('','','order by id desc',' LIMIT 0,1 ',' '); 
		$this->set('lateststablearr',$lateststablearr);
		$latestmemberar=$this->User->FindAll('','','order by id desc',' LIMIT 0,1 ',' '); 
		$this->set('latestmemberar',$latestmemberar);		
		$latesthorsesale_sql="SELECT * FROM tbl_horsesales Sale,tbl_horses Horse WHERE Horse.id=Sale.horse_id AND 
						  	  Horse.approve_stat='Y' AND Sale.salesfor='Sale' ORDER BY Sale.id DESC LIMIT 0,1 ";
		
		$latesthorsesalearr=$this->User->query($latesthorsesale_sql);
		$this->set('latesthorsesalearr',$latesthorsesalearr);	
		
		$lateststudsql="SELECT * FROM tbl_horses Horse, tbl_horseforstuds Sale 
							WHERE Horse.id=Sale.horse_id AND Sale.studstatus='Y' LIMIT 0,1 ";	 	
		$lateststudarr=$this->User->query($lateststudsql);
		$this->set('lateststudarr',$lateststudarr);	
		if($orderby=="" || $orderby=="desc") {
			$order="DESC";
		}	
		else {
			$order="ASC";
		}
		$activeuserarr=$this->User->FindAll("login_stat='Y'",'','order by logoutdate '.$order.' ',' LIMIT 0,10 ',' ');   
		$this->set('activeuserarr',$activeuserarr);
		$this->set('orderby',$orderby);
	}	
	function add(){
		parent::adminlayout(); 
		parent::checkAdminSession();
		if(!empty($this->data))
		{
		  $this->Content->set($this->data);
		    $this->data['Content']['content']= $this->data['Content']['content'];
		    if($this->data['Content']['content'] ==""){
				$err ="Please enter your content.";
				$this->set('err',$err);
				return false;					
			}
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash('Content successfully added.'); 
				//$this->Session->setFlash('Boxtype details has been updated.');
				$this->redirect('/content/'); 
			}		 	
		}
	}	
	function edit($id){
		parent::adminlayout(); 
		parent::checkAdminSession();
		$edit_arr = $this->Content->findById($id );
		$this->set('edit_arr',$edit_arr);
		$this->Content->id = $id;			
				if (empty($this->data)) {
					$this->data = $this->Content->read();
					$this->data['url'] = $this->referer();					
				} else {				
				if($this->data['Content']['content'] ==""){
					$err ="Please enter your content.";
					$this->set('err',$err);
					return false;				
				}			
				$this->Content->set($this->data);			  
				if ($this->Content->save($this->data)) {
					$this->Session->setFlash('Content successfully saved.'); 
					$this->redirect('/content');
				}						
			}		
		}	
	function delete($id){	
	    $this->Content->id=$id;
		parent::checkAdminSession();
		$this->Content->delete();
		$this->Session->setFlash('Content successfully deleted.'); 
	    $this->redirect($this->referer());
	}	
	function notification() {
		error_reporting(0);
		parent::adminlayout(); 
		parent::checkAdminSession();
		$userarr=$this->User->FindAll("login_stat='Y'");
		$this->set('userarr',$userarr);	
		if(!empty($this->data)) {
			if(count($this->data['User'])>0) {
				$adminArr = $this->Admin->FindByid(1);
				foreach($this->data['User'] as $key=>$val) :
					$paiduser_insert_sql="INSERT INTO tbl_notifications SET user_id =".$val.",posted_date=CURRENT_DATE(),
										  notification_title='".$this->data['Content']['title']."',notificationdetails='".$this->data['Content']['notification']."'";
					$this->Notification->query($paiduser_insert_sql) ;
				endforeach;				
			}	
			if(count($this->data['Freeuser'])>0) {
				$adminArr = $this->Admin->FindByid(1);
				foreach($this->data['Freeuser'] as $key=>$val) :
					$paiduser_insert_sql="INSERT INTO tbl_notifications SET user_id =".$val.",posted_date=CURRENT_DATE(),
										  notification_title='".$this->data['Content']['title']."',notificationdetails='".$this->data['Content']['notification']."'";
					$this->Notification->query($paiduser_insert_sql) ;
				endforeach;				
			}		
			if(count($this->data['Userall'])>0) {
				$adminArr = $this->Admin->FindByid(1);
				foreach($this->data['Userall'] as $key=>$val) :
					$paiduser_insert_sql="INSERT INTO tbl_notifications SET user_id =".$val.",posted_date=CURRENT_DATE(),
										  notification_title='".$this->data['Content']['title']."',notificationdetails='".$this->data['Content']['notification']."'";
					$this->Notification->query($paiduser_insert_sql) ;
				endforeach;				
			}
			$this->Session->setFlash('Notification has been sent to selected users.'); 
			$this->redirect('/content/notification');			
		}
	}	
	//////////////////////FRont End   //////////////////////////
	
	function front() {
		parent::blanklayout();
		$userid=$this->Session->Read("userid") ;
		$usertype=$this->Session->Read("usertype") ;
		if($userid=="") {
			$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Home%'");
			$this->set('homecontent_arr',$homecontent_arr);
			$userid=$this->Session->Read("userid") ;
		}
		else {
			if($usertype=="P") {
				$this->redirect('/content/homeforpaiduser');
			}
			if($usertype=="F") {
				$this->redirect('/content/homeforfreeuser');
			}
		}
	}	
	function homeforpaiduser() {
		parent::blanklayout();
		parent::chkblanksession();
		$userid=$this->Session->Read("userid") ;
		$usertype=$this->Session->Read("usertype") ;
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Premium Home%'");
		$this->set('homecontent_arr',$homecontent_arr);
		if($usertype=="F") {
			$this->redirect('/content/homeforfreeuser');
		}	
	}	
	function homeforfreeuser() {
		parent::blanklayout();
		parent::chkblanksession();
		$userid=$this->Session->Read("userid") ;
		$usertype=$this->Session->Read("usertype") ;
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Free user home%'");
		$this->set('homecontent_arr',$homecontent_arr);
		if($usertype=="P") {
			$this->redirect('/content/homeforpaiduser');
		}	
	}	
	function terms() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Terms%'");
		$this->set('homecontent_arr',$homecontent_arr);
	}
	function privacy() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Privacy Policy%'");
		$this->set('homecontent_arr',$homecontent_arr);	
	}	
	function cancellation() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%CANCELLATION POLICY%'");
		$this->set('homecontent_arr',$homecontent_arr);		 
	}		
	function sitemap() {
		parent::blanklayout();	
	}	
	function contact() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%Contact Us%'");
		$this->set('homecontent_arr',$homecontent_arr);
	}	
	function advertise() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%advertise%'");
		$this->set('homecontent_arr',$homecontent_arr);
	}
	function disclaimer() {
		parent::blanklayout();
		$homecontent_arr=$this->Content->FindAll("pagename  LIKE '%disclaimer%'");
		$this->set('homecontent_arr',$homecontent_arr);
	}	
	function listmembership() {
		$membershiparr= $this->Membership->findAll("status='Y'",'','order by id desc','',''); 
		return $membershiparr;
	}	
	function membershipdetail($membership_id=NULL) {
		parent::blanklayout();
		$membership_detail_arr=$this->Membership->FindByid($membership_id) ;
		$this->set('membership_detail_arr',$membership_detail_arr);	
	}
	
	function mailtouser($name=NULL,$email=NULL,$subject=NULL,$message=NULL) {
		parent::blanklayout();
		$sent='';
		$adminemail_arr=$this->Admin->FindAll('id=1');
		$to  = $adminemail_arr[0]['Admin']['admin_email'];
		$subject = 'New Enquiry';		
			// message
			$message = '
			<html>
			   <table>
				 <tr>
				  <td>Name</td>
				  <td>'.$name.'</td>
				</tr>   
				 <tr>
				  <td>Email Address</td>
				  <td>'.$email.'</td>
				</tr>
				 <tr>
				  <td>Subject</td>
				  <td>'.$subject.'</td>
				</tr>
				<tr>
				  <td valign=top>Message</td>
				  <td>'.$message.'</td>
				</tr>   
			  </table>
			</body>
			</html>
			';			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: www.indianhorsedatabase.com <'.$email.'>' . "\r\n";
			$sent='';
			// Mail it
			if(@mail($to, $subject, $message, $headers)) {
				$sent=1;
		    }
			self::set('sent',$sent);	
	}
	function viewdetailsforfree($title=NULL,$id=NULL) {
		parent::blanklayout();
		$detailsarr=$this->Listingfree->FindByid($id) ;
		$this->set('detailsarr',$detailsarr);
	}
	
	function viewdetailsforpaid($title=NULL,$id=NULL) {
		parent::blanklayout();
		$detailsarr=$this->Listingfree->FindByid($id) ;
		$this->set('detailsarr',$detailsarr);
	}
		
} # end of the class
?>