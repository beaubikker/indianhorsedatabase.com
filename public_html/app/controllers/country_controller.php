<?php
class CountryController  extends AppController
{
	var $name		= "Country" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Country','Breed');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Country->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Country->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Country->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {
			if($this->Country->validates($this->data))  {	
				$duplicatearr=$this->Country->FindAll("country='".$this->data['Country']['country']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Country->save($this->data)) {
						$this->Session->setFlash('Country successfully added.');
						$this->redirect('/Country');
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
		$this->Country->id=$productid;
		$edit_arr=$this->Country->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Country->validates($this->data))  {	
				$duplicatearr=$this->Country->FindAll("id!=".$productid." AND country='".$this->data['Country']['country']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Country->save($this->data)) {
						$this->Session->setFlash('Country successfully saved.');
						$this->redirect('/Country');
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
		$this->Country->id=$id;
		$this->data['Country']['status']="Y";
		$this->Country->save($this->data);
		$this->Session->setFlash('Country status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Country->id=$id;
		$this->data['Country']['status']="N";
		$this->Country->save($this->data);		
		$this->Session->setFlash('Country status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Country->id=$productid;
		if($this->Country->delete()) {
			$this->Session->setFlash('Country successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
	function countryname($country_id=NULL) {
		return $this->Country->FindByid($country_id) ;	
	}	
} # end of the class
?>