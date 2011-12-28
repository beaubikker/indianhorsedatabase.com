<?php
class BreedController  extends AppController
{
	var $name		= "Breed" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	//var $uses=array('Breed','News');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Breed->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Breed->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Breed->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		 
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr); 
		if(!empty($this->data)) {
			if($this->Breed->validates($this->data))  {	
				$duplicatearr=$this->Breed->FindAll("Breed='".$this->data['Breed']['breed']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Breed->save($this->data)) {
						$this->Session->setFlash('Breed successfully added.');
						$this->redirect('/Breed');
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
		$this->Breed->id=$productid;
		$edit_arr=$this->Breed->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Breed->validates($this->data))  {	
				$duplicatearr=$this->Breed->FindAll("id!=".$productid." AND Breed='".$this->data['Breed']['breed']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Breed->save($this->data)) {
						$this->Session->setFlash('Breed successfully saved.');
						$this->redirect('/Breed');
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
		$this->Breed->id=$id;
		$this->data['Breed']['status']="Y";
		$this->Breed->save($this->data);
		$this->Session->setFlash('Breed status successfully changed.');
	    $this->redirect($this->referer()); 
	}
	function stat_off($id=NULL) {
		$this->Breed->id=$id;
		$this->data['Breed']['status']="N";
		$this->Breed->save($this->data);		
		$this->Session->setFlash('Breed status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Breed->id=$productid;
		if($this->Breed->delete()) {
			$this->Session->setFlash('Breed successfully deleted.');
			$this->redirect($this->referer()); 
		}		
	}	
} # end of the class
?>