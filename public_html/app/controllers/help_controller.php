<?php

class HelpController  extends AppController
{
	var $name		= "Help" ;		
	var $helpers 	= array( 'Html', 'Fck', 'Javascript','Pagination' ,'Rsz');
	var $components	= array('Pagination','upload');	
	var $uses=array('Help','Breed','State');
	function index()
	{	
		parent::adminlayout(); 
		parent::checkAdminSession();
		$pagetotal=$this->Help->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Help->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Help->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		
		parent::adminlayout(); 
		parent::checkAdminSession();
		if(!empty($this->data)) {
			if($this->Help->validates($this->data))  {				
				if($this->Help->save($this->data)) {
					$this->Session->setFlash('Help successfully added.');
					$this->redirect('/Help');
				}							
			}			 
		  else 
		  {
			return false;  
		  }		
		}
	}	
	function edit($productid=NULL) {
		parent::adminlayout();
		parent::checkAdminSession();
		$this->Help->id=$productid;
		$edit_arr=$this->Help->Read();
		$this->set('edit_arr',$edit_arr);
		if(!empty($this->data)) {
			if($this->Help->validates($this->data))  {				
				if($this->Help->save($this->data)) {
					$this->Session->setFlash('Help successfully added.');
					$this->redirect('/Help');
				}							
			}			 
		  else 
		  {
			return false;  
		  }		
		}
	}	
	function stat_on($id=NULL) {
		$this->Help->id=$id;
		$this->data['Help']['status']="Y";
		$this->Help->save($this->data);
		$this->Session->setFlash('Help status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Help->id=$id;
		$this->data['Help']['status']="N";
		$this->Help->save($this->data);		
		$this->Session->setFlash('Help status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Help->id=$productid;
		if($this->Help->delete()) {
			$this->Session->setFlash('Help successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
	/////// front end/////////////
	
	function showall() {
		parent::blanklayout();	
		$listarr=$this->Help->FindAll("status='Y'");
		$this->set('listarr',$listarr);	
	}
} # end of the class
?>