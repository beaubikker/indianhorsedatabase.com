<?php
class StateController  extends AppController
{
	var $name		= "State" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('State','Country');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->State->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->State->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->State->findAll($criteria, NULL, $order, $limit, $page);	 
		return $leads;
	}			
	function add() {		
		$duplicateerr=0;
		parent::adminlayout(); 
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$this->set('duplicateerr',$duplicateerr);
		$this->set('country_id',$this->data['State']['country_id']); 
		if(!empty($this->data)) {
			if($this->State->validates($this->data))  {	
				$duplicatearr=$this->State->FindAll("statename='".$this->data['State']['statename']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->State->save($this->data)) {
						$this->Session->setFlash('State successfully added.');
						$this->redirect('/State');
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
		$this->State->id=$productid;
		$country_arr=$this->Country->FindAll("status='Y'",'',' ORDER BY country ','','');
		$this->set('country_arr',$country_arr);
		$edit_arr=$this->State->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->State->validates($this->data))  {	
				$duplicatearr=$this->State->FindAll("id!=".$productid." AND statename='".$this->data['State']['statename']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->State->save($this->data)) {
						$this->Session->setFlash('State successfully saved.');
						$this->redirect('/State');
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
		$this->State->id=$id;
		$this->data['State']['status']="Y";
		$this->State->save($this->data);
		$this->Session->setFlash('State status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->State->id=$id;
		$this->data['State']['status']="N";
		$this->State->save($this->data);		
		$this->Session->setFlash('State status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->State->id=$productid;
		if($this->State->delete()) {
			$this->Session->setFlash('State successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
	function Statename($State_id=NULL) {
		return $this->State->FindByid($State_id) ;	
	}	
	function liststate($country_id=NULL) {
		parent::adminlayout(); 
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$country_id);
		$this->set('state_arr',$state_arr);
	}	
	
	function liststateforuser($country_id=NULL) {
		parent::adminlayout(); 
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$country_id);
		$this->set('state_arr',$state_arr);
	}	
		
	function liststateforsearch($country_id=NULL) {
		parent::adminlayout(); 
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$country_id);
		$this->set('state_arr',$state_arr);
	}		
	function liststablestate($country_id=NULL) {
		parent::adminlayout(); 
		$state_arr=$this->State->FindAll(" status='Y' AND country_id=".$country_id);
		$this->set('state_arr',$state_arr);
	}	
	function listmemstate($country_id=NULL) {
		parent::adminlayout(); 
		$state_arr=$this->State->FindAll("status='Y' AND country_id=".$country_id);
		$this->set('state_arr',$state_arr);	
	}	
} # end of the class
?>