<?php
class SellersController  extends AppController 
{	
	var $name 		= 'Seller' ;
	var $uses=array('Seller','Offersubmission','Property','Agent','State','User','Broker','Brokerofficeinformation','Document','Property','Seller','Propertydocument','Propertysellerinformation','Fastsubmitpropertysellerinformation','Statusmaster'); 
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination','Rsz');
	var $components	= array('Pagination','Upload','Email','Paginationall');	
	function sellerdetails($seller_id) {
		return $this->Seller->FindAll('seller_id='.$seller_id) ;
	}
	function seller_id($property_id=NULL) {	
		return $this->Propertysellerinformation->FindAll("property_id=".$property_id);
	}
	function seller_id1($property_id=NULL) {	 
		return $this->Fastsubmitpropertysellerinformation->FindAll("property_id=".$property_id);
	}	
	function userdetails($seller_id=NULL) {
		return $this->User->FindAll("id=".$seller_id);
	}	
	function listamc($amc_id=NULL) {
		return $this->Seller->FindAll("parent_id=".$amc_id);	
	}	
	function register() {
		include("SmsInterface.inc");	
		parent::frontendlayout() ;
		$statearr=self::showallstate() ;
		$this->set('statearr',$statearr);
		$this->set('state_id',$this->data['Seller']['state_id']);	
		$usertype=$this->Session->Read('usertype');
		if($usertype=="S") {
			$this->redirect('/sellers/sellerwelcome/');		
		}
		if(!empty($this->data)) {
			if($this->data['Agent']['valid']!=$_POST['result']) {
				$this->Session->setFlash('Your inputted captcha result is incorrect.');
			}
			else {		
				$countarr=$this->User->FindAll("email_address='".$this->data['User']['email_address']."' AND  user_type!='S'");
				if(count($countarr)<=0) {		
					$chkselleremail=$this->User->FindAll("email_address='".trim($this->data['User']['email_address'])."' AND user_type='S'");
					if(count($chkselleremail)>0) {
						$this->User->id=$chkselleremail[0]['User']['id'] ;	
						$agent_id=	$chkselleremail[0]['User']['id'] ;		
					}					
					$this->data['User']['name']=addslashes($this->data['User']['name']);
					$this->data['User']['email_address']=$this->data['User']['email_address'] ;
					$this->data['User']['password']=base64_encode($this->data['User']['password']);
					$this->data['User']['user_type']='S' ;
					$this->data['User']['registered']=1 ;	
					$this->User->save($this->data);
					if(count($chkselleremail)<=0) {
						$agent_id=$this->User->getLastInsertId();
						$this->data['Seller']['seller_id']=$agent_id;		
					}
					if(count($chkselleremail)>0) {
						$selleridarr=$this->Seller->FindAll("seller_id=".$chkselleremail[0]['User']['id']);
						$this->Seller->id=$selleridarr[0]['Seller']['id'];
					}	
					$this->data['Seller']['office_phone']=convert($this->data['Seller']['office_phone']);
					$this->data['Seller']['cell_phone']=convert($this->data['Seller']['cell_phone']);	
											
					$this->data['Seller']['registered_date']=date("Y-m-d");
					$this->Seller->save($this->data);
					$this->Session->write('userid', $agent_id);
					$this->Session->write('usertype','S');
					$usertype=$this->Session->Read('usertype');
					$userid= $this->Session->Read('userid');	
					$userarr=$this->User->FindByid($userid) ;	
					$content=file_get_contents("emailcontent/sellerregister.txt");
					$mailcontent='';
					$content=str_replace("{password}",base64_decode($this->data['User']['password']),$content) ;			
					$textContent2 = stripslashes($content); 	
					$this->set("message", $textContent2);		
					$this->Email->to = stripslashes($this->data['User']['email_address']);	
					$this->Email->subject = " Welcome to Offer Assurance as Seller";
					$this->Email->from = ' Offer Assurance <'.ADMINEMAIL.'>';
					$this->Email->template	= 'email/customer' ;
					$this->Email->send();				
					
					
					
					/////////////////////////sms for seller registration/////////////////////////
					/*$smscontent=file_get_contents("smscontent/sellersms.txt");
					$smscontent=str_replace("{xxxxxxxxxx}",base64_decode($userarr['User']['password']),$smscontent) ;
					$si = new SmsInterface (false, false);
					$si->addMessage ($this->data['Seller']['cell_phone'],$smscontent);
				
					if (!$si->connect (SMSUSERNAME, SMSPASSWORD, true, false)) {
						//echo "failed. Could not contact server.\n";					
					}
					elseif (!$si->sendMessages ()) {
						//echo "failed. Could not send message to server.\n";
						if ($si->getResponseMessage () !== NULL) {
							//echo "<BR>Reason: " . $si->getResponseMessage () . "\n";
						}
					} else {
						//echo "OK.\n";
					}*/
					/////////////////sms for seller registration ends here////////////////////////								
					$this->redirect('/sellers/sellerwelcome/');		
				}
				else {
					$this->Session->setFlash('This Email address already exists.');
				}
			}		
		}		
	}
	function showallstate() {
		return $this->State->find("all",array( 'order'=>array('State.statename ASC')));	
	}	
	function sellerwelcome() {
		parent::frontendlayout() ;
		$statearr=self::showallstate() ;
		parent::chkblanksession();
		$userid=$this->Session->Read('userid') ;
		parent::chksellertype();
	}	
	function registered_property() {
		parent::frontendlayout() ;
		parent::chksellertype();
		$statearr=self::showallstate() ;
		parent::chkblanksession();
		$userid=$this->Session->Read('userid') ;
		$statearr=self::showallstate() ;
		$this->set('statearr',$statearr);		
	}	
	function property_search_in() {		
		parent::frontendlayout() ;
		parent::chkblanksession() ;
		parent::chksellertype();
		$userid=$this->Session->Read('userid') ;	
		$searchcriteria='';
		$parametre='';
		$properyid='';
		$state_id='';
		$streetnumber='';
		$city='';
		$zipcode ='';
		$streetname='';
		$statearr=self::showallstate() ;
		$this->set('statearr',$statearr);	
		$searchcriteria="SELECT * FROM  tbl_propertysellerinformations Propertysellerinformation , tbl_properties Property LEFT JOIN tbl_states State  ON State.id = Property.state_id 
					   LEFT JOIN tbl_offersubmissions Offersubmisson  ON Offersubmisson.property_id = Property.id WHERE 
					   Property.payment_status='Y' AND  Property.property_status=1 AND (Propertysellerinformation.seller_id=".$userid."  OR Propertysellerinformation.amc_id=".$userid.") AND Propertysellerinformation.property_id=Property.id "   ;					   			   				    
		if($this->data['Property']['properyid']!="" || @$_REQUEST['propertyid']!="") {
			if($this->data['Property']['properyid']) {
				$properyid=$this->data['Property']['properyid'] ;
			}
			else {
				$properyid=$_REQUEST['propertyid'];
			}
			$searchcriteria.=' AND Property.id='.$properyid ;
			$parametre='&propertyid='.$properyid ;		
		}	
		else {	
			if($this->data['Property']['state_id']!="" || @$_REQUEST['state_id']!="") {
				if($this->data['Property']['state_id']) {
					$state_id=$this->data['Property']['state_id'] ;
				}
				else {
					$state_id=$_REQUEST['state_id'];
				}
				$searchcriteria.=' AND Property.state_id='.$state_id ;
				$parametre='&state_id='.$state_id ;		
			}		
			if($this->data['Property']['streetnumber']!="" || @$_REQUEST['streetnumber']!="") {
				if($this->data['Property']['streetnumber']) {
					$streetnumber=$this->data['Property']['streetnumber'] ;
				}
				else {
					$streetnumber=$_REQUEST['streetnumber'];
				}
				$searchcriteria.=" AND Property.street_no='".$streetnumber."'" ;
				$parametre='&streetnumber='.$streetnumber ;		
			}		
			if($this->data['Property']['city']!="" || @$_REQUEST['city']!="") {
				if($this->data['Property']['city']) {
					$city=$this->data['Property']['city'] ;
				}
				else {
					$city=$_REQUEST['city'];
				}
				$searchcriteria.=" AND Property.city LIKE '%".$city."%'" ;
				$parametre='&city='.$city ;		
			}		
			if($this->data['Property']['zipcode']!="" || @$_REQUEST['zipcode']!="") {
				if($this->data['Property']['zipcode']) {
					$zipcode=$this->data['Property']['zipcode'] ;
				}
				else {
					$zipcode=$_REQUEST['zipcode'];
				}
				$searchcriteria.= " AND  Property.zipcode='".$zipcode."'" ;
				$parametre='&zipcode='.$zipcode ;		
			}					
			if($this->data['Property']['streetname']!="" || @$_REQUEST['streetname']!="") {
				if($this->data['Property']['streetname']) {
					$streetname=$this->data['Property']['streetname'] ;
				}
				else {
					$streetname=$_REQUEST['streetname'];
				}
				$searchcriteria.=" AND Property.street_name LIKE '%".$streetname."%'" ;
				$parametre='&streetname='.$streetname ;		
			}		
		}	
		$searchcriteria.=' GROUP BY Property.id ' ;	
		if(isset($this->data['Property']['odering']) || @$_REQUEST['orderby']) {
			if($this->data['Property']['odering']) {
				$sortcriteria=$this->data['Property']['odering'] ;	
			}
			else {
				$sortcriteria=@$_REQUEST['orderby'];
			}
			if($sortcriteria) {
				switch($sortcriteria)	{
					case 'STATE':
						$searchcriteria.=" ORDER BY State.statename ASC " ;	
						$parametre="&orderby=".$sortcriteria ;			
					break;					
					case 'LISTPRICE':
						$searchcriteria.=" ORDER BY Property.least_price ASC " ;	
						$parametre="&orderby=".$sortcriteria ;					
					break;					
					case 'HIGHESTOFFERPRICE':
						$parametre="&orderby=".$sortcriteria ;				
					break;									
				}
			}
			else {
				$searchcriteria.=' ORDER BY Property.id DESC ' ;
			}
		}		
		else {
			$searchcriteria.=' ORDER BY Property.id DESC ' ;		
		}
		$propertyarr=$this->Property->query($searchcriteria);
		$this->Paginationall->countval=count($propertyarr);
		$this->Paginationall->additionalparametre=$parametre ;
		$paginationstr=$this->Paginationall->pagination() ;
		$this->set('paginationstr',$paginationstr);		
		$limit=$this->Paginationall->limitreturn() ;
		$listall=$this->Property->query($searchcriteria.$limit);
		$this->set('listall',$listall);	
		$this->set('propertyarr',$propertyarr);	
		$this->set('properyid',$properyid);	
		$this->set('state_id',$state_id);	
		$this->set('streetnumber',$streetnumber);	
		$this->set('streetname',$streetname);	
		$this->set('zipcode',$zipcode);	
		$this->set('zipcode',$zipcode);	
		$this->set('city',$city);	
		$this->set('odering',@$sortcriteria);	
	}	
	function editagentprofile() {
		parent::frontendlayout() ;
		parent::chksellertype();
		$statearr=self::showallstate() ;
		parent::chkblanksession();
		$userid=$this->Session->Read('userid') ;
		$userarr=$this->Seller->FindAll("seller_id=".$userid) ;
		$this->set('statearr',$statearr);	
		$this->set('userarr',$userarr);
		$sellertouserarr=$this->User->FindAll("id=".$userid);
		$this->set('sellertouserarr',$sellertouserarr);
		if(!empty($this->data)) {
			$this->data['User']['name']=addslashes($this->data['User']['name']);
			$this->User->id=$userid ;			
			$this->User->save($this->data);
			$this->Seller->id=$userarr[0]['Seller']['id'];			
			$this->data['Seller']['office_phone']=convert($this->data['Seller']['office_phone']);
			$this->data['Seller']['cell_phone']=convert($this->data['Seller']['cell_phone']);			
			$this->data['Seller']['seller_id']=$userid;
			$this->Seller->save($this->data) ;
			$this->Session->setFlash('Information updated successfully');
			$this->User->id=$userid;
			$this->User->save($this->data);			
			$this->redirect('/sellers/editagentprofile/');		
		}
	}	
	function acceptedoffers() {
		parent::frontendlayout() ;
		parent::chksellertype();
		$statearr=self::showallstate() ;
		parent::chkblanksession();
		$userid=$this->Session->Read('userid') ;
		$statearr=self::showallstate() ;
		$this->set('statearr',$statearr);	
	}	
	function acceptedofferssearch() {		
		parent::frontendlayout() ;
		parent::chkblanksession() ;
		parent::chksellertype();
		$userid=$this->Session->Read('userid') ;	
		$searchcriteria='';
		$parametre='';
		$properyid='';
		$state_id='';
		$streetnumber='';
		$city='';
		$zipcode ='';
		$streetname='';
		$statearr=self::showallstate() ;
		$this->set('statearr',$statearr);	
		$searchcriteria="SELECT * FROM  tbl_propertysellerinformations Propertysellerinformation , tbl_offersubmissions Offersubmisson ,tbl_properties Property  LEFT JOIN tbl_states State  ON State.id = Property.state_id 
					    WHERE   Property.payment_status='Y' AND  Property.property_status=1 AND (Propertysellerinformation.seller_id=".$userid."  OR Propertysellerinformation.amc_id=".$userid.") AND Propertysellerinformation.property_id=Property.id AND Offersubmisson.property_id = Property.id AND  Offersubmisson.status_id=2 "   ;					   			   				    
		if($this->data['Property']['properyid']!="" || @$_REQUEST['propertyid']!="") {
			if($this->data['Property']['properyid']) {
				$properyid=$this->data['Property']['properyid'] ;
			}
			else {
				$properyid=$_REQUEST['propertyid'];
			}
			$searchcriteria.=' AND Property.id='.$properyid ;
			$parametre='&propertyid='.$properyid ;		
		}	
		else {	
			if($this->data['Property']['state_id']!="" || @$_REQUEST['state_id']!="") {
				if($this->data['Property']['state_id']) {
					$state_id=$this->data['Property']['state_id'] ;
				}
				else {
					$state_id=$_REQUEST['state_id'];
				}
				$searchcriteria.=' AND Property.state_id='.$state_id ;
				$parametre='&state_id='.$state_id ;		
			}		
			if($this->data['Property']['streetnumber']!="" || @$_REQUEST['streetnumber']!="") {
				if($this->data['Property']['streetnumber']) {
					$streetnumber=$this->data['Property']['streetnumber'] ;
				}
				else {
					$streetnumber=$_REQUEST['streetnumber'];
				}
				$searchcriteria.=" AND Property.street_no='".$streetnumber."'" ;
				$parametre='&streetnumber='.$streetnumber ;		
			}		
			if($this->data['Property']['city']!="" || @$_REQUEST['city']!="") {
				if($this->data['Property']['city']) {
					$city=$this->data['Property']['city'] ;
				}
				else {
					$city=$_REQUEST['city'];
				}
				$searchcriteria.=" AND Property.city LIKE '%".$city."%'" ;
				$parametre='&city='.$city ;		
			}		
			if($this->data['Property']['zipcode']!="" || @$_REQUEST['zipcode']!="") {
				if($this->data['Property']['zipcode']) {
					$zipcode=$this->data['Property']['zipcode'] ;
				}
				else {
					$zipcode=$_REQUEST['zipcode'];
				}
				$searchcriteria.= " AND  Property.zipcode='".$zipcode."'" ;
				$parametre='&zipcode='.$zipcode ;		
			}					
			if($this->data['Property']['streetname']!="" || @$_REQUEST['streetname']!="") {
				if($this->data['Property']['streetname']) {
					$streetname=$this->data['Property']['streetname'] ;
				}
				else {
					$streetname=$_REQUEST['streetname'];
				}
				$searchcriteria.=" AND Property.street_name LIKE '%".$streetname."%'" ;
				$parametre='&streetname='.$streetname ;		
			}		
		}	
		$searchcriteria.=' GROUP BY Property.id ' ;	
		if(isset($this->data['Property']['odering']) || @$_REQUEST['orderby']) {
			if($this->data['Property']['odering']) {
				$sortcriteria=$this->data['Property']['odering'] ;	
			}
			else {
				$sortcriteria=@$_REQUEST['orderby'];
			}
			if($sortcriteria) {
				switch($sortcriteria)	{
					case 'STATE':
						$searchcriteria.=" ORDER BY State.statename ASC " ;	
						$parametre="&orderby=".$sortcriteria ;			
					break;					
					case 'LISTPRICE':
						$searchcriteria.=" ORDER BY Property.least_price ASC " ;	
						$parametre="&orderby=".$sortcriteria ;					
					break;					
					case 'HIGHESTOFFERPRICE':
						$parametre="&orderby=".$sortcriteria ;				
					break;									
				}
			}
			else {
				$searchcriteria.=' ORDER BY Property.id DESC ' ;
			}
		}		
		else {
			$searchcriteria.=' ORDER BY Property.id DESC ' ;		
		}
		$propertyarr=$this->Property->query($searchcriteria);
		$this->Paginationall->countval=count($propertyarr);
		$this->Paginationall->additionalparametre=$parametre ;
		$paginationstr=$this->Paginationall->pagination() ;
		$this->set('paginationstr',$paginationstr);		
		$limit=$this->Paginationall->limitreturn() ;
		$listall=$this->Property->query($searchcriteria.$limit);
		$this->set('listall',$listall);	
		$this->set('propertyarr',$propertyarr);	
		$this->set('properyid',$properyid);	
		$this->set('state_id',$state_id);	
		$this->set('streetnumber',$streetnumber);	
		$this->set('streetname',$streetname);	
		$this->set('zipcode',$zipcode);	
		$this->set('zipcode',$zipcode);	
		$this->set('city',$city);	
		$this->set('odering',@$sortcriteria);	
	}
	function acceptofferdetails($property_id) {		
		parent::frontendlayout() ;
		parent::chkblanksession() ;
		parent::chksellertype();
		$userid=$this->Session->Read('userid') ;	
		$Statusmasterarr=$this->Statusmaster->FindAll();
		$this->set('Statusmasterarr',$Statusmasterarr);
		$propertyarr=$this->Property->FindByid(base64_decode($property_id));
		$this->set('propertyarr',$propertyarr);
		$this->set('property_id',base64_decode($property_id));		
		$sllerview_offer_sql="SELECT * FROM tbl_properties Property ,tbl_propertysellerinformations Sellerinfo,tbl_offersubmissions Offersubmission
							  WHERE Property.id=Offersubmission.property_id AND Property.id=".base64_decode($property_id)." AND  Property.property_status=1 AND (Sellerinfo.seller_id=".$userid." OR Sellerinfo.amc_id=".$userid.") AND 
							  Sellerinfo.property_id=Property.id AND Offersubmission.status_id=2 GROUP BY Offersubmission.id ";
		$offerarr=$this->Offersubmission->query($sllerview_offer_sql);
		$this->set('offerarr',$offerarr);
		$this->set('sortoption',$this->data['Offer']['sortoption']);
		$userid=$this->Session->Read('userid') ;
		$agentarr=$this->Agent->FindAll("agent_id=".$propertyarr['Property']['agent_id']);
		$this->set('agentarr',$agentarr);		
		$this->set('userid',$userid);
		$laemailarr=$this->User->FindAll("id=".$propertyarr['Property']['agent_id']);
		$this->set('laemailarr',$laemailarr);		
	}
	
	function archiveoffers() {
		("test");	
	}	
}
?>