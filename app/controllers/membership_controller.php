<?php
class MembershipController  extends AppController
{
	var $name		= "Membership" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Membership','Listingpaid','Listingfree');
	function index()
	{	
		parent::adminlayout(); 
		parent::checkAdminSession();
		$pagetotal=$this->Membership->Find('count');		
		$this->set('pagetotal',$pagetotal); 
		$criteria=NULL;
		$this->set('listarr', $this->Membership->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); );  
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Membership->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		 
		$duplicateerr=0;
		parent::adminlayout();
		parent::checkAdminSession(); 
		$this->set('duplicateerr',$duplicateerr); 
		if(!empty($this->data)) {
			if($this->Membership->validates($this->data))  {	
				$duplicatearr=$this->Membership->FindAll("advantagename='".$this->data['Membership']['advantagename']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					$this->data['Membership']['status']="Y";
					if($this->Membership->save($this->data)) {
						$this->Session->setFlash('Membership successfully added.');
						$this->redirect('/Membership');
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
	function edit($productid=NULL) {
		$duplicateerr=0;
		parent::adminlayout(); 
		parent::checkAdminSession();
		$this->Membership->id=$productid;
		$edit_arr=$this->Membership->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Membership->validates($this->data))  {	
				$duplicatearr=$this->Membership->FindAll("id!=".$productid." AND advantagename='".$this->data['Membership']['advantagename']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Membership->save($this->data)) {
						$this->Session->setFlash('Membership successfully saved.');
						$this->redirect('/Membership');
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
	function delete($productid=NULL) {
		$this->Membership->id=$productid;
		if($this->Membership->delete()) {
			$this->Session->setFlash('Membership successfully deleted.');
			$this->redirect($this->referer()); 
		}		
	}
	function listfree() {
		parent::adminlayout(); 
		parent::checkAdminSession();
		$this->set('listarr', $this->Listingfree->findAll('','','order by id desc','',''));
	}	
	
	function listpaid() {
		parent::adminlayout(); 
		parent::checkAdminSession();
		$this->set('listarr', $this->Listingpaid->findAll('','','order by id desc','',''));
	}
	
		
	function addlistfree() {		
		parent::adminlayout();
		parent::checkAdminSession(); 
		if(!empty($this->data)) {
			if($this->Listingfree->validates($this->data))  {				
				if($this->Listingfree->save($this->data)) {
					$this->Session->setFlash('Content successfully added.');
					$this->redirect('/Membership/listfree');								
				}				
			}			 
		  else 
		  {
			return false;  
		  }		
		}		
	}	
	
	
	function addlistpaid() {		
		parent::adminlayout();
		parent::checkAdminSession(); 
		if(!empty($this->data)) {
			if($this->Listingpaid->validates($this->data))  {				
				if($this->Listingpaid->save($this->data)) {
					$this->Session->setFlash('Content successfully added.');
					$this->redirect('/Membership/listpaid');
								
				}				
			}			 
		  else 
		  {
			return false;  
		  }		
		}		
	}	
	function listpaideditedit($id=NULL) {
		parent::adminlayout();
		parent::checkAdminSession(); 
		$editarr=$this->Listingpaid->FindByid($id) ;
		$this->set('editarr',$editarr);
		if(!empty($this->data)) {
			if($this->Listingpaid->validates($this->data))  {	
				$this->Listingpaid->id=$id;	
				if($this->Listingpaid->save($this->data)) {
					$this->Session->setFlash('Content successfully updated.');
					$this->redirect('/Membership/listpaid');
								
				}				
			}			 
		  else 
		  {
			return false;  
		  }		
		}	
	}
	
	
	
	function listfreeeditedit($id=NULL) {
		parent::adminlayout();
		parent::checkAdminSession(); 
		$editarr=$this->Listingfree->FindByid($id) ;
		$this->set('editarr',$editarr);
		if(!empty($this->data)) {
			if($this->Listingfree->validates($this->data))  {	
				$this->Listingfree->id=$id;	
				if($this->Listingfree->save($this->data)) {
					$this->Session->setFlash('Content successfully updated.');
					$this->redirect('/Membership/listfree');
								
				}				
			}			 
		  else 
		  {
			return false;  
		  }		
		}	
	}	
	function delfreecontent($id=NULL) {
		$this->Listingfree->id=$id;
		$this->Listingfree->delete();
		$this->Session->setFlash('Content successfully deleted.');
		$this->redirect('/Membership/listfree');	
	}
	
	function delpaidcontent($id=NULL) {
		$this->Listingpaid->id=$id;
		$this->Listingpaid->delete();
		$this->Session->setFlash('Content successfully deleted.');
		$this->redirect('/Membership/listpaid');	
	}
	
	function stat_on($id=NULL) {
		$this->Membership->id=$id;
		$this->data['Membership']['status']="Y";
		$this->Membership->save($this->data);
		$this->Session->setFlash('Membership status successfully changed.');
	    $this->redirect($this->referer()); 
	}
	function stat_off($id=NULL) {
		$this->Membership->id=$id;
		$this->data['Membership']['status']="N";
		$this->Membership->save($this->data);		
		$this->Session->setFlash('Membership status successfully changed.');
	    $this->redirect($this->referer());
	}
	
	function listfreeall() {
		return $this->Listingfree->FindAll();
	}	
	function listpaidall() {
		return $this->Listingpaid->FindAll();	
	}	

	
	
	
} # end of the class
?>