<?php
class GenderController  extends AppController
{
	var $name		= "Gender" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	//var $uses=array('Gender','News');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Gender->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Gender->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Gender->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		 
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr); 
		if(!empty($this->data)) {
			if($this->Gender->validates($this->data))  {	
				$duplicatearr=$this->Gender->FindAll("Gender='".$this->data['Gender']['gender']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Gender->save($this->data)) {
						$this->Session->setFlash('Gender successfully added.');
						$this->redirect('/Gender');
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
		$this->Gender->id=$productid;
		$edit_arr=$this->Gender->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Gender->validates($this->data))  {	
				$duplicatearr=$this->Gender->FindAll("id!=".$productid." AND Gender='".$this->data['Gender']['gender']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Gender->save($this->data)) {
						$this->Session->setFlash('Gender successfully saved.');
						$this->redirect('/Gender');
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
		$this->Gender->id=$productid;
		if($this->Gender->delete()) {
			$this->Session->setFlash('Gender successfully deleted.');
			$this->redirect($this->referer()); 
		}		
	}	
} # end of the class
?>