<?php
class PricerangeController  extends AppController
{
	var $name		= "Pricerange" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Pricerange','Breed');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Pricerange->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Pricerange->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	 
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Pricerange->findAll($criteria, NULL, $order, $limit, $page);
		return $leads;
	}			
	function add() {		
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {
			if($this->Pricerange->validates($this->data))  {	
				if($duplicateerr<=0) {
					if($this->Pricerange->save($this->data)) {
						$this->Session->setFlash('Pricerange successfully added.');
						$this->redirect('/Pricerange');
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
		$this->Pricerange->id=$productid;
		$edit_arr=$this->Pricerange->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Pricerange->validates($this->data))  {	
				if($duplicateerr<=0) {
					if($this->Pricerange->save($this->data)) {
						$this->Session->setFlash('Pricerange successfully saved.');
						$this->redirect('/Pricerange');
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
	function stat_on($id=NULL) {
		$this->Pricerange->id=$id;
		$this->data['Pricerange']['status']="Y";
		$this->Pricerange->save($this->data);
		$this->Session->setFlash('Pricerange status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Pricerange->id=$id;
		$this->data['Pricerange']['status']="N";
		$this->Pricerange->save($this->data);		
		$this->Session->setFlash('Pricerange status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Pricerange->id=$productid;
		if($this->Pricerange->delete()) {
			$this->Session->setFlash('Pricerange successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
	function pricerangename($range_id=NULL) {
		return $this->Pricerange->FindByid($range_id);	
	}
} # end of the class
?>