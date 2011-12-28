<?php
class HeightController  extends AppController
{
	var $name		= "Height" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Height','Coatcolor');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Height->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Height->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Height->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {
			if($this->Height->validates($this->data))  {	
				$duplicatearr=$this->Height->FindAll("height='".$this->data['Height']['height']."'"); 
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Height->save($this->data)) {
						$this->Session->setFlash('Height successfully added.');
						$this->redirect('/Height');
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
		$this->Height->id=$productid;
		$edit_arr=$this->Height->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Height->validates($this->data))  {	
				$duplicatearr=$this->Height->FindAll("id!=".$productid." AND height='".$this->data['Height']['height']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Height->save($this->data)) {
						$this->Session->setFlash('Height successfully saved.');
						$this->redirect('/Height');
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
		$this->Height->id=$id;
		$this->data['Height']['status']="Y";
		$this->Height->save($this->data);
		$this->Session->setFlash('Height status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Height->id=$id;
		$this->data['Height']['status']="N";
		$this->Height->save($this->data);		
		$this->Session->setFlash('Height status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Height->id=$productid;
		if($this->Height->delete()) { 
			$this->Session->setFlash('Height successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
} # end of the class
?>