<?php
ob_start();
class AdminController extends AppController
{
	var $name		= "Admin" ;
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination','Rsz','Session' );	
	var $uses=array('Admin');	
	var $paginate = array(
	 'limit' => 10,
	 'order' => array(
	 'Gallery.id' => 'asc'
	)
	);
	
	
	function index()
	{
		parent::adminlayout(); 
		//if (@$_SESSION['user_id']!="")
		if($this->Session->read('user_id') !="")
		{			
			$this->redirect('/admin/home'); 
		}
		$this->set('error', false);	
		if(!empty($this->data))
		{
		  $this->Admin->set($this->data);
		  if($this->Admin->validates()) 
		  {
			 	$rs = $this->Admin->findByAdminLogin( $this->data['Admin']['admin_login'] );
				if($rs && $rs['Admin']['admin_pwd'] == md5($this->data['Admin']['admin_pwd']))
				{					
					$this->Session->write('adminSession',$rs['Admin']);
					//$_SESSION['admin_login_user'] = $this->data['Admin']['admin_login'];
					//$_SESSION['user_id'] = $rs['Admin']['id'];
					
					
					 $this->Session->write('admin_login_user',$this->data['Admin']['admin_login']);
					 $this->Session->write('user_id',$rs['Admin']['id']);
					session_register("user_id");
					parent::redirect('/admin/home');
				}
				else
				{					
					$this->set('error',true);				
				}	
		  } 
		  else 
		  {
			return false;  
		  }		
		}
		
		
	}	
	function logout()
	{	
		$this->Admin->admin_last_login = time();
		$this->Admin->id= $this->Session->read('user_id');
		$this->Admin->save();		
		
		//unset($_SESSION['admin_login_user']);
		//unset($_SESSION['user_id']);
		//session_unregister('admin_login_user');
		session_destroy();
		
		$this->redirect('/admin/index');
	} 	
	function home()
	{	
		parent::checkAdminSession();
		parent::adminlayout();
		return true;
	} 	
	function display(){
		parent::adminlayout();
		parent::checkAdminSession();		
		$arr = $this->Admin->findAll('id!=1');
		$this->set('arr', $arr);
		
		if($this->data['Admin']['mode']!="") {
			$this->tablename="tbl_admins";
			$this->stat_fileldname="status";
			$this->mode=$this->data['Admin']['mode'] ;
			$this->id="id";
			//$this->status=@$this->data['Admin']['status'];			
			$this->status_change();
		}	
	} 	
	function status_change() {
	
		 $arr = $this->Admin->findAll('id!=1');
	
		//if(isset($this->status)) {		
			if($this->mode == "delete_all"){
				$ids ="";
				
				foreach($arr as $key=>$val) {					
					if($this->data['status_'.$val['Admin']['id']]){					
					$ids.=$val['Admin']['id'].",";
					//$this->Admin->delete($id = $val,'',false);
					}
				}
				
				$ids = substr($ids,0,-1);				
				$this->Admin->deleteAll("id in(".$ids.")",'',false);				
				
			} else {
				if($this->mode=="set_active_all") {
					$stat_val=1;
				}
				if($this->mode=="set_inactive_all") {
					$stat_val=0;
				}
				
				foreach($arr as $key=>$val) {					
					if($this->data['status_'.$val['Admin']['id']]){		 
					$update_sql="UPDATE ".$this->tablename." SET ".$this->stat_fileldname."='".$stat_val."' WHERE ".$this->id."='".$val['Admin']['id']."'" ;		
					$this->Admin->query($update_sql) ;	
					
					//$this->data['Admin']['id'] = $val;
					//$this->data['Admin']['status'] = $stat_val;
					//$this->Admin->save();
					}
							
				}
			}
		//}		
		$this->redirect('/admin/display');			
	}	
	
	function gallery() {
		parent::adminlayout();
		$pagetotal=$this->Gallery->Find('count');		
		$this->set('pagetotal',$pagetotal);
		
		$data = $this->paginate('Gallery');
		$this->set('listarr', $data);		
	}
	
	
	function _paginate_leads($criteria) {
		$order='desc';
		$page='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
			$leads = $this->Gallery->findAll($criteria);	
			return $leads;
	}
	function galldelete($galleryid=NULL) {
		$this->Gallery->id=$galleryid;
		$this->Gallery->delete();		
		$del_sql="DELETE FROM tbl_galleryimages WHERE 	galleryid=".$galleryid;
		$this->Gallery->query($del_sql);
		$this->redirect($this->referer());
	}
	
	function galleryadd() {
		parent::adminlayout();
		$duplicateerr=0;
		if(!empty($this->data))
		{
		  if($this->Gallery->validates()) 
		  {	 
		  	$gallnamearr=$this->Gallery->FindAll("galleryname='".$this->data['Gallery']['galleryname']."'") ;
			if (count($gallnamearr)>0)
			{ 
				$duplicateerr++;
			}		
			if($duplicateerr==0) {	 
			  		$this->Gallery->save($this->data);
					$lastid=$this->Gallery->getLastInsertId();
					if(is_numeric($_POST['galimage'])) {
						for($i=1;$i<=$_POST['galimage'];$i++) {
							$path=rootpth()."galleryimage"; 
							$randno="";
							if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
								$insert_image_sql="INSERT INTO tbl_galleryimages SET galleryid=".$lastid.",images='".$randno.$_FILES['img_'.$i]['name']."',
												   imagecaption='".$randno.$_POST['caption_'.$i]."'";
								$this->Gallery->query($insert_image_sql);
							}	
						}							 				
					$this->redirect('/admin/gallery');
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
	
	function galleryedit($galleryid=NULL) {
		parent::adminlayout();
		$edit_arr=$this->Gallery->FindByid($galleryid);
		self::set('edit_arr',$edit_arr);	
		$imagearr=$this->Galleryimage->FindAll('galleryid='.$galleryid);
		self::set('imagearr',$imagearr);	
		if(!empty($this->data)) {			
		  if($this->Gallery->validates()) 
		  {	 
		  	$this->Gallery->id=$galleryid;
		  	 if ($this->Gallery->save($this->data)) {			 		
			 		if(is_numeric($_POST['galimage'])) {
						for($i=1;$i<=$_POST['galimage'];$i++) {
							$path=rootpth()."galleryimage";
							$randno="";
							if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
								$insert_image_sql="INSERT INTO tbl_galleryimages SET galleryid=".$galleryid.",images='".$randno.$_FILES['img_'.$i]['name']."',
												   imagecaption='".$randno.$_POST['caption_'.$i]."'";
								$this->Gallery->query($insert_image_sql);
							}	
						}							
					}			 				
					$this->redirect('/admin/gallery');
				}		 	
		  } 
		  else 
		  {
			return false;  
		  }	
		}		
	}
	
	function deladdimage($imageid=NULL,$image=NULL) {
		$this->Galleryimage->id=$imageid;
		$this->Galleryimage->delete();
		if(@unlink(rootpth()."galleryimage/".$image)) {	
		
		}
		$this->redirect($this->referer());	
	}	
	function noofimage($galleryid=NULL) {
		$noofimagearr=$this->Galleryimage->FindAll('galleryid='.$galleryid);
		return count($noofimagearr);
	}	
	function stepbystep() {
		parent::adminlayout();
		$listarr=$this->Stepbystep->FindAll();
		self::set('listarr',$listarr);
	}	
	function stepdelete($stepid=NULL) {
		$this->Stepbystep->id=$stepid;
		$this->Stepbystep->delete();
		$this->redirect($this->referer());	 
	}
	
	function stepedit($stepid=NULL) {
		parent::adminlayout();
		$duplicateerr=0;
		$animatederr=0;
		$animated_image='';
		$this->Stepbystep->id=$stepid;
		$edit_arr=$this->Stepbystep->Read();
		self::set('edit_arr',$edit_arr);
		
		if(!empty($this->data)) {						
		  if($this->Stepbystep->validates()) 
		  {	 
		  	$gallnamearr=$this->Stepbystep->FindBystepname($this->data['Stepbystep']['stepname']) ;
			//e(count($gallnamearr));
			if (count($gallnamearr)>0)
			{ 
				//$duplicateerr++;
			}		
				if($duplicateerr==0) {					
					if($this->data['Stepbystep']['mainiamge']['name']!="") {
						$path=rootpth()."stepimages";
						$randno=rand(4563,478962);
						if(move_uploaded_file($this->data['Stepbystep']['mainiamge']['tmp_name'],$path."/".$randno.$this->data['Stepbystep']['mainiamge']['name'])) {
							$img=$randno.$this->data['Stepbystep']['mainiamge']['name'] ;
						}	
						else {
							$img=$edit_arr['Stepbystep']['mainiamge'];
						}				
					}
					else {
						$img=$edit_arr['Stepbystep']['mainiamge'];
					}		
					$this->data['Stepbystep']['mainiamge']=$img;	
					if($this->data['Stepbystep']['animated_image']['name']!="") {
						if(!stristr($this->data['Stepbystep']['animated_image']['name'],".gif")) {
							$animatederr++;
						}
						else {
							$path=rootpth()."animatedimated";
							$randno=rand(4563,478962);
							if(move_uploaded_file($this->data['Stepbystep']['animated_image']['tmp_name'],$path."/".$randno.$this->data['Stepbystep']['animated_image']['name'])) {
								$animated_image=$randno.$this->data['Stepbystep']['animated_image']['name'] ;
							}	
							else {
								$animated_image=$edit_arr['Stepbystep']['animated_image'];
							}	
						}			
					}
					else {
						$animated_image=$edit_arr['Stepbystep']['animated_image'];
					}		
					$this->data['Stepbystep']['animated_image']=$animated_image;
					if($animatederr==0) {
						$this->Stepbystep->save($this->data); 
						$this->redirect('/admin/stepbystep');						 
					 }	
				}	 	
		  } 
		  else 
		  {
			return false;  
		  }	
		}
		self::set('duplicateerr',$duplicateerr);
		self::set('animatederr',$animatederr);
		self::set('animated_image',$animated_image);
	}	
	function addstep() {
		parent::adminlayout();
		$duplicateerr=0;
		$animatederr=0;
		$animated_image='';
		if(!empty($this->data)) {			
		  if($this->Stepbystep->validates()) 
		  {	 
		  	$gallnamearr=$this->Stepbystep->FindAll("stepname='".$this->data['Stepbystep']['stepname']."'") ;
			//e(count($gallnamearr));
			if (count($gallnamearr)>0)
			{ 
				$duplicateerr++;
			}		
				if($duplicateerr==0) {					
					if($this->data['Stepbystep']['mainiamge']['name']!="") {
						$path=rootpth()."stepimages";
						$randno=rand(4563,478962);
						if(move_uploaded_file($this->data['Stepbystep']['mainiamge']['tmp_name'],$path."/".$randno.$this->data['Stepbystep']['mainiamge']['name'])) {
							$img=$randno.$this->data['Stepbystep']['mainiamge']['name'] ;
						}	
						else {
							$img='';
						}				
					}
					else {
						$img='';
					}		
					$this->data['Stepbystep']['mainiamge']=$img;	
					if($this->data['Stepbystep']['animated_image']['name']!="") {
						if(!stristr($this->data['Stepbystep']['animated_image']['name'],".gif")) {
							$animatederr++;
						}
						else {
							$path=rootpth()."animatedimated";
							$randno=rand(4563,478962);
							if(move_uploaded_file($this->data['Stepbystep']['animated_image']['tmp_name'],$path."/".$randno.$this->data['Stepbystep']['animated_image']['name'])) {
								$animated_image=$randno.$this->data['Stepbystep']['animated_image']['name'] ;
							}	
							else {
								$animated_image='';
							}	
						}			
					}
					else {
						$animated_image='';
					}		
					$this->data['Stepbystep']['animated_image']=$animated_image;
					if($animatederr==0) {
						$this->Stepbystep->save($this->data); 
						$this->redirect('/admin/stepbystep');						 
					 }	
				}	 	
		  } 
		  else 
		  {
			return false;  
		  }	
		}			
		$this->set('animatederr',$animatederr);
		$this->set('duplicateerr',$duplicateerr);
	}
	
	function change_status($action=NULL, $id=NULL)
	{
		switch($action) 
		{
			case 'stat_off':
				//$stat_off_sql="UPDATE tbl_admins SET status='0' WHERE id='".$id."'" ;				
				//$stat_off_query=$this->Admin->query($stat_off_sql) ;
				
				$this->Admin->id = $id;
				$this->data['Admin']['status']=0;
				$this->Admin->save($this->data);
				
				$this->set('id', $id) ;
				$this->set('val', 'stat_off') ;
			    $this->render('status_change', 'ajax');
			break;			
			case 'stat_on':
				//$stat_on_sql="UPDATE tbl_admins SET status='1' WHERE id='".$id."'" ;
				//$stat_on_query=$this->Admin->query($stat_on_sql) ;
				$this->Admin->id = $id;
				$this->data['Admin']['status']=1;
				$this->Admin->save($this->data);
				
				$this->set('id', $id) ;
				$this->set('val', 'stat_on') ;
				$this->render('status_change', 'ajax');
			break;
		}
	}	
	function add()
	{
		parent::checkAdminSession();	
		parent::adminlayout();
		if(!empty($this->data)) 
		{	
		    $this->Admin->set($this->data);	
			if ($this->Admin->validates())
			{	
				if($this->data['Admin']['admin_pwd'] != $this->data['Admin']['newpass1']){
				
					$err = "Both passwords are not same.";
					$this->set('err',$err);
					return false;
				}
					
					$this->data['Admin']['admin_pwd']= md5($this->data['Admin']['admin_pwd']);
					$this->Admin->save($this->data);
					$this->redirect('/admin/display');
				
			} 
			else
			{
				return false;
			}
	  	}
	} #End of function add()
	
	function delete($id=NULL){
		$this->Admin->del($id);
		$this->redirect('/admin/display');
	}	
	
	
	function edit($id=NULL, $retPage=NULL)
	{
		parent::checkAdminSession();		
		parent::adminlayout();		
		if (empty($this->data))
		{
			$this->Admin->id = $id;
			$this->data = $this->Admin->read();
		}
		else
		{	
			$this->Admin->id = $id;
			 $this->Admin->set($this->data);	
			if ($this->Admin->validates())
			{			
				$this->Admin->save($this->data);
				$this->redirect('/admin/display');
			} 
			else
			{
				return false;
			}
	  	}
	} #End of function edit()
	
	function changepassword($id=NULL) {
		parent::adminlayout();
   		parent::checkAdminSession();
		$this->set('errorOldPass', false);	
		$this->set('errorNewPass', false);
		$this->Admin->id = $id;
		if(!empty($this->data)) 
		{	
			if ($this->Admin->validates($this->data))
			{	
				if($this->data['Admin']['admin_pwd'] != $this->data['Admin']['admin_pwd_con']){					
					$this->set('errorNewPass',true);
				}				
				$rsPassword = $this->Admin->findCount("id = '".$id."' AND 
							  admin_pwd = '".md5($this->data['Admin']['admin_pwd_old'])."'");
				if($rsPassword == 0){
					$this->set('errorOldPass', true);
				}
				if(($rsPassword > 0) && ($this->data['Admin']['admin_pwd'] == $this->data['Admin']['admin_pwd_con'])){
					$this->data['Admin']['admin_pwd'] = md5($this->data['Admin']['admin_pwd']);
					$this->Admin->id = $id;
					$this->Admin->admin_pwd = $this->data['Admin']['admin_pwd']; 
					$this->Admin->save($this->data);					
					$this->redirect('/admin/display');
				}
			} 
			else
			{
				$this->validateErrors($this->Admin);
			}
	  	}		
   	}
	function lastlogin() {
		parent::checkAdminSession();
		$SessionID = $this->Session->Read();
		return $SessionID;	
	}
	function change_profile($id="", $retPage=NULL)
	{
		parent::adminlayout();
		parent::checkAdminSession();		
		$this->Admin->id=$_SESSION['user_id'] ;
		$admin_arr=$this->Admin->Read();
		//self::set('admin_arr',$admin_arr);
		$this->set('admin_arr',$admin_arr);
		
		if (empty($this->data))
		{
			$this->Admin->id = $_SESSION['user_id'];
			$this->data = $this->Admin->read();
		}
		else
		{	
			$this->Admin->set($this->data);	
			if ($this->Admin->validates())
			{			
								
				 /*if($this->data['Admin']['admin_email'] == 0 && $this->data['Admin']['admin_email'] == "")
			  	{			  	
			  		$err="Please enter your email id.";
					$this->set('err',$err);
					return false;	
			  	}*/
					  
				if ($this->Admin->save($this->data)) {
					//$this->Session->setFlash('Boxtype details has been updated.');
					$this->redirect('/admin/change_profile/');
				}		
				
				
				
			} 
			else
			{
				return false ;
			}
	  	}
		
	} #End of function change_profile()
	
	#########################################################################################
	
	function makeRandomWord($size) {
		$salt = "ABCHEFGHJKMNPQRSTUVWXYZ0123456789abchefghjkmnpqrstuvwxyz";
		srand((double)microtime()*1000000);
		$word = '';
		$i = 0;
		while (strlen($word)<$size) {
			$num = rand() % 59;
			$tmp = substr($salt, $num, 1);
			$word = $word . $tmp;
			$i++;
		}
		return $word;
	}
	
	function forgotpassword() {
		parent::adminlayout();
		$count=0;
		if(!empty($this->data))
		{
		  $this->Admin->set($this->data);			 
			  	
				if(trim($this->data['Admin']['admin_email'])=="") {		
					
				$err="Provide Email Address";
				$this->set("err",$err);	
				return false;		
				}
				
				if(trim($this->data['Admin']['admin_email'])!="") {
				$count++;
					if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $this->data['Admin']['admin_email']))
					{						
						$err="Provide Valid Email Address";
						$this->set("err",$err);
						return false;	
					}
				}
					
				
				$checkemail = $this->Admin->find('count', array('conditions' => array('Admin.admin_email' =>$this->data['Admin']['admin_email'] )));
				
				if($checkemail <=0){
					$err="This email does not exists.";
					$this->set("err",$err);
				}else{				
					//$adminArr = $this->Admin->find('first', array('conditions' => array('Admin.admin_email' =>$this->data['Admin']['admin_email'] )));
					$adminArr =  $this->Admin->findByAdminEmail($this->data['Admin']['admin_email']);
					
					$adminPassword = AdminController::makeRandomWord(8);
					$password = $adminPassword;
					$username =$adminArr['Admin']['admin_login'];
					$message='Hello '.$username.'<br>' ;
					$message.='Your Password is <b>'.$password.'</b>';
					$to=$adminArr['Admin']['admin_login'];
					$subject="Your Password";
					
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
					// More headers
					$headers .= 'From: <webmaster@example.com>' . "\r\n";
					$headers .= 'Cc: myboss@example.com' . "\r\n";
					@mail($to,$subject,$message,$headers);
					
					$sql_update = "UPDATE tbl_admins SET admin_pwd = '".md5($password)."' WHERE admin_email = '".$this->data['Admin']['admin_email']."'";	
					$this->Admin->query($sql_update);
					
					/*$this->Admin->read(null, 1);
					$this->Admin->set(array(
						'admin_pwd' =>md5($password),
						'id' => $adminArr['Admin']['id']
					 ));
						$this->Admin->save();
				*/
					$err="Your Password Has been sent to your mail account ".$this->data['Admin']['admin_email'];	
					$this->set("err",$err);	
				
				}
				
			}	
	}
	
	
	function account()
	{
		parent::adminlayout();
		parent::checkAdminSession();
		$SessionID = $this->Session->Read();
		//echo $SessionID['adminSession']['id'];
		$this->set("type","");
		/*if($SessionID['adminSession']['id'] == 1)
		{
			$this->mygrid->ini(200, 980, 'single-row', "AddDelConfirm") ;
			$dataSet 		= array() ;		
			$strHeader	= array() ;
			$this->set("type","admin");
			$qry = "SELECT userid,userpassword,useremail,
						CASE WHEN status='1' THEN 'Active' ELSE 'Inactive' END as status,
						id FROM tbl_admins"  ;	
			//echo $qry ;
			$dataSet 	= $this->Admin->findBySql($qry) ;	
			$strHeader 	= array(
								"userid" 	=> "Admin ID", 
								"userpassword"	=> "Admin Password",
								"useremail"	=> "Admin Email",
								"status"	=> "Status",
								//"1" 			=> "Set Subscribed",
								"id"			=> ""
							) ;
			$links 		= array("Update"=>array("edit/","edit.jpg" ),"Delete"=>array("delete/","delete.jpg") ) ;
			$primaryKey = "id" ;
				
			$this->set('recSetDiv' , $this->mygrid->grid( $dataSet, $strHeader, $links, $primaryKey  ));
		}
		else
		{
			$this->mygrid->ini(200, 980, 'single-row', "AddDelConfirm") ;
			$dataSet 	= array() ;		
			$strHeader	= array() ;
			$ID = $SessionID['adminSession']['id'];
			$qry = "SELECT userid,userpassword,useremail,
						CASE WHEN status='1' THEN 'Active' ELSE 'Inactive' END as status,
						id FROM tbl_admins where id=$ID"  ;	
			//echo $qry ;
			$dataSet 		= $this->Admin->findBySql($qry) ;	
			$strHeader 	= array(
								"userid" 	=> "Admin ID", 
								"userpassword"	=> "Admin Password",
								"useremail"	=> "Admin Email",
								"status"	=> "Status",
								//"1" 			=> "Set Subscribed",
								"id"		=> ""
							) ;
			$links 		= array("Update"=>array("edit/","edit.jpg" )) ;
			$primaryKey = "id" ;
				
			$this->set('recSetDiv' , $this->mygrid->grid( $dataSet, $strHeader, $links, $primaryKey  ));		
		}*/
		
		
		
		$criteria = "" ;
		$this->Pagination->init(); 		
		$this->Pagination->controller = &$this;
		$strshow = $this->Pagination->show;
		$strpage = ($this->Pagination->page-1)*$this->Pagination->show;
		$rs = $this->Admin->findAll('', '', '', $strshow, $strpage) ;		
		$this->set('rs', $rs) ;		
	} #end of function
	function settings() 
	{	
		parent::checkAdminSession();
		if (file_exists($_SERVER['DOCUMENT_ROOT'].$this->webroot.'settings.xml')) 
		{
			$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$this->webroot.'settings.xml');
			$this->set('xml', $xml) ;
		} 
		else 
		{
			exit('Failed to open settings.xml.');
		}
		if(count($_POST) > 0)
		{
			$str = '<?xml version="1.0" encoding="iso-8859-1"?>
				<settings>'."\n" ;
			foreach($_POST  as $k=>$v)
			{
				if($k == "Submit")
				{	
					# Do nothing
				}
				else
				{
					$str .= "\t"."<".$k.">".$v."</".$k.">\n" ;
				}
			}
			$str .= "</settings>" ;
			
			$filename = $_SERVER['DOCUMENT_ROOT'].$this->webroot.'settings.xml' ;
			$somecontent = $str;

			if (is_writable($filename)) 
			{
				if (!$handle = fopen($filename, 'w+')) 
				{
					echo "Cannot open file ($filename)";
					exit;
				}
				if (fwrite($handle, $somecontent) === FALSE) 
				{
					echo "Cannot write to file ($filename)";
					exit;
				}
				//echo "Success, wrote ($somecontent) to file ($filename)";
				fclose($handle);
			} 
			else 
			{
				echo "The file $filename is not writable";
			}
		}
	}#end of method
	
	function dbexport() 
	{		
		$db = new DATABASE_CONFIG ;
		$arr = $db->default ;
		$this->set('arr_db', $arr) ;
	} #end of method
	
	
	
	
	function createMenu()
	{	
		$filename = $_SERVER['DOCUMENT_ROOT']."/".CURRENT_URL."/app/webroot/js/menu_data.js" ;
		
		
		####################################
		$sql1 = "SELECT * FROM tbl_contents AS Content WHERE header=1" ;
		$pages1 = $this->Admin->findBySql($sql1) ;
		
		$strpages1 = '' ;
		foreach($pages1 as $v1)
		{
			$strpages1 .= "aI('text=".$v1['Content']['pagetitle'].";url='+ _path +'content/contentmanagement/".$v1['Content']['id']."');\n" ;
		}
		########################################
		
		$sql2 = "SELECT * FROM tbl_contents AS Content WHERE header=2" ;
		$pages2 = $this->Admin->findBySql($sql2) ;
		
		$strpages2 = '' ;
		foreach($pages2 as $v2)
		{
			$strpages2 .= "aI('text=".$v2['Content']['pagetitle'].";url='+ _path +'content/contentmanagement/".$v2['Content']['id']."');\n" ;
		}
		#########################################
		$sql3 = "SELECT * FROM tbl_contents AS Content WHERE header=3" ;
		$pages3 = $this->Admin->findBySql($sql3) ;
		
		$strpages3 = '' ;
		foreach($pages3 as $v3)
		{
			$strpages3 .= "aI('text=".$v3['Content']['pagetitle'].";url='+ _path +'content/contentmanagement/".$v3['Content']['id']."');\n" ;
		}
		#######################################
		
				
		$cats = "SELECT id, category_name FROM tbl_categories ";
		$rsCat = $this->Admin->query($cats) ;
		
		############################################
		$cats = "\nwith(milonic=new menuname('Products'))
					{
						style=menuStyle;\n" ;
		foreach($rsCat as $v)
		{
			foreach($v as $v1)
			{
				$cats .= "aI('showmenu=". $v1['category_name'] .";text=". $v1['category_name'] ."');\n" ;
			}
		}
		$cats .= "}" ;
		##############################
		
		############################################
		
		$subcats = '' ;
		foreach($rsCat as $v)
		{
			foreach($v as $v1)
			{			
				$qrySubCat = "SELECT id, subcat_name FROM tbl_subcategories WHERE category_id = $v1[id] " ;
				$rssubCat = $this->Admin->query($qrySubCat) ;				
				$subcats .= "with(milonic=new menuname('". $v1['category_name'] ."'))
							{
								style=menuStyle;\n" ;				
				foreach($rssubCat as $i)
				{
					foreach($i as $i1)
					{
						$subcats .= "aI('showmenu=". $i1['subcat_name'] .";text=". $i1['subcat_name'] ."');\n" ;				
					}
				}
				$qry_with_no_subCat = "SELECT id, product_name FROM tbl_products WHERE subcat_id=0 AND category_id = $v1[id] " ;
				$rspro_with_no_subCat = $this->Admin->query($qry_with_no_subCat) ;
				
				foreach($rspro_with_no_subCat as $k)
				{
					foreach($k as $k1)
					{
						$subcats .= "aI('text=". $k1['product_name'] .";url='+ _path +'product/productdetails/".$k1['id']."');\n" ;
					}
				}				
				$subcats .= "}" ;								
			}
		}
		##############################		
		
		############################################		
		$prodts = '' ;
		foreach($rsCat as $v)
		{
			foreach($v as $v1)
			{			
				$qrySubCat = "SELECT id, subcat_name FROM tbl_subcategories WHERE category_id = $v1[id] " ;
				$rssubCat = $this->Admin->query($qrySubCat) ;				
				
				foreach($rssubCat as $i)
				{
					foreach($i as $i1)
					{
						$product = "SELECT id, product_name FROM tbl_products WHERE subcat_id =".$i1['id'] ;
						$rs1 = $this->Admin->query($product) ;						
						$prodts .= "\n	
							with(milonic=new menuname('". $i1['subcat_name'] ."'))
							{
								style=menuStyle;\n" ;
						foreach($rs1 as $j)
						{
							foreach($j as $j1)
							{
								$prodts .= "aI('text=". $j1['product_name'] .";url='+ _path +'product/productdetails/".$j1['id']."');\n" ;
							}
						}
						$qry_with_no_subCat = "SELECT id, product_name FROM tbl_products WHERE subcat_id=0 AND category_id = $v1[id] " ;
						$rspro_with_no_subCat = $this->Admin->query($qry_with_no_subCat) ;
						
						foreach($rspro_with_no_subCat as $k)
						{
							foreach($k as $k1)
							{
								$prodts .= "aI('text=". $j1['product_name'] .";url='+ _path +'product/productdetails/".$j1['id']."');\n" ;
							}
						}						
						$prodts .= "}" ;
					}
				}																						
			}
		}
		##############################
				
				
		
		
		
		
		$str = "
fixMozillaZIndex=true; 
_menuCloseDelay = 500;
_menuOpenDelay = 150;
_subOffsetTop = 2;
_subOffsetLeft = -2;

_path = '/envyorganica/index.php/' ;


with(menuStyle=new mm_style())
{
	bordercolor='';
	borderstyle='';
	borderwidth=0;
	fontfamily='Tahoma, Verdana, Georgia, Arial';
	fontsize='11px';
	fontstyle='normal';
	fontweight='bold';
	headerbgcolor='';
	headerbgimages='';
	headercolor='';
	offbgcolor='#4e0204';
	offcolor='#e5e0e0';
	onbgcolor='';
	oncolor='#a69077';	
	
	padding=2;
	pagebgcolor='';
	pagecolor='';
	separatorcolor='';
	separatorsize=1;
	subimagepadding=2;
}

with(milonic=new menuname('Main Menu'))
{
	alwaysvisible=1;
	orientation='horizontal';
	style=menuStyle;
	aI('text=Home;text=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;url='+ _path +'user/index');
	aI('showmenu=Organic;text=The Secret of Simply Organic&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;');
	aI('showmenu=Products;text=Our Products&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;');
	aI('showmenu=Media;text=Media &amp; Awards&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;');
	aI('showmenu=ContentManager;text=Company Info&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;');
	aI('showmenu=ProfitLossReports;text=Contact Us&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;;url='+ _path +'customer/contactus');
}

with(milonic=new menuname('Home'))
{
	style=menuStyle;	
}

with(milonic=new menuname('Organic'))
{
	style=menuStyle;
	".$strpages1."
}

".$cats . $subcats . $prodts."

with(milonic=new menuname('Settings'))
{
	style=menuStyle;	
	aI('text=Mail Settings;url='+ _path + 'mailcontent/index');
	aI('text=Payment Methods;url='+ _path + 'paymentmethod/index');
	aI('showmenu=Shipping;text=Shipping;');
	aI('text=Tax Managemant;url='+ _path + 'tax/index');
	aI('text=Database Export;url='+ _path + 'admin/dbexport');
	aI('text=My Account;url='+ _path + 'admin/account');
	aI('text=Software settings;url='+ _path + 'admin/settings');
}

with(milonic=new menuname('Media'))
{
	style=menuStyle;
	".$strpages2."
}


with(milonic=new menuname('ContentManager'))
{
	style=menuStyle;
	".$strpages3."
	
}

drawMenus();
";

		if (is_writable($filename)) 
		{
			if (!$handle = fopen($filename, 'w+')) 
			{
				echo "Cannot open file ($filename)";
				exit;
			}
			if (fwrite($handle, $str) === FALSE) 
			{
			   echo "Cannot write to file ($filename)";
			   exit;
			}	
			fclose($handle);	
		} 
		else 
		{
			echo "The file $filename is not writable";
			exit;
		}	 
	}#end of method
	
	function menutext()
	{
		$cats = "SELECT id, category_name FROM tbl_categories";
		$rsCat = $this->Admin->query($cats) ;
		echo "<ul>" ;
		foreach($rsCat as $v)
		{
			foreach($v as $v1)
			{
				echo "<li>".$v1['category_name']."</li><ul>" ;			
				$qrySubCat = "SELECT id, subcat_name FROM tbl_subcategories WHERE category_id = $v1[id] " ;
				$rssubCat = $this->Admin->query($qrySubCat) ;				
				foreach($rssubCat as $i)
				{
					foreach($i as $i1)
					{
						e( "<li>".$i1['subcat_name']."</li>") ;
						$product = "SELECT id, product_name FROM tbl_products WHERE subcat_id =".$i1['id'] ;
						$rs1 = $this->Admin->query($product) ;						
						echo "<ul>" ;
						foreach($rs1 as $j)
						{
							foreach($j as $j1)
							{
								e( "<li>".$j1['product_name']."</li>") ;
							}
						}
						echo "</ul>" ;
					}
				}								
				$qry_with_no_subCat = "SELECT id, product_name FROM tbl_products WHERE subcat_id=0 AND category_id = $v1[id] " ;
				$rspro_with_no_subCat = $this->Admin->query($qry_with_no_subCat) ;
				
				foreach($rspro_with_no_subCat as $k)
				{
					foreach($k as $k1)
					{
						e( "<li>".$k1['product_name']."</li>") ;
					}
				}
				e("</ul>") ;
			}
		}
		e("</ul>") ;
		exit ;
	} #end method test	
	
	
	function change_pasword() {
		parent::adminlayout();
		parent::checkAdminSession() ;
		$admin_id=$_SESSION['user_id'];
		//$arr=$this->Session->read('adminSession');
		
		$arr=$this->Admin->FindById($admin_id);
		
		
		
		$count=0;
		$pas_err="";
		$pas_err1="";
		$incorrect_err="";
		$success="";
		if(!empty($this->data)) {
		  $this->Admin->set($this->data);	
			
			
			/*if($this->data['Admin']['password1']=="") { 
				$pas_err="<font color=red>Please enter your new password.</font>";
				$count++;
			}
			if($this->data['Admin']['password2']!=$this->data['Admin']['password1']) { 
				$pas_err1="<font color=red>Please Confirm your new password in confirm box.</font>";
				$count++;
			}	*/
			if ($this->Admin->validates())
			{	
				
				if($this->data['Admin']['newpass1'] != $this->data['Admin']['newpass2']){
					$err ="Confirm password is not same .";
					$this->set('err',$err);
					return false;
				
				}
				
				$conditions =    array( "AND" => 
				array ("Admin.id" => $admin_id),
  				 "Admin.admin_pwd " => md5($this->data['Admin']['admin_pwd_ori'])
    			);   

				$countPass = $this->Admin->find('count', array('conditions' =>$conditions ));
				
				if($countPass ==0){
				
					$err ="Current password is incorrect .";
					$this->set('err',$err);
					return false;
				
				}else{	
				
				
						$update_password_sql="UPDATE tbl_admins SET admin_pwd='".md5($this->data['Admin']['newpass1'])."' WHERE id='".$admin_id."'";
						$this->Admin->query($update_password_sql);
				}				
			} 
			else
			{
				return false;
			}	
		}
		$this->set('pas_err',$pas_err);
		$this->set('success',$success);
		$this->set('pas_err1',$pas_err1);
		$this->set('incorrect_err',$incorrect_err);	
	}	
} # end of the class
?>