<?php
class CoatcolorController  extends AppController
{
	var $name		= "Coatcolor" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Coatcolor','Breed');
	function index()
	{	
		parent::adminlayout(); 
		parent::checkAdminSession(); 
		$pagetotal=$this->Coatcolor->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Coatcolor->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Coatcolor->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {		
		$duplicateerr=0;
		parent::checkAdminSession(); 
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {
			if($this->Coatcolor->validates($this->data))  {	
				$duplicatearr=$this->Coatcolor->FindAll("color='".$this->data['Coatcolor']['color']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Coatcolor->save($this->data)) {
						$this->Session->setFlash('Coatcolor successfully added.');
						$this->redirect('/Coatcolor');
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
		$this->Coatcolor->id=$productid;
		$edit_arr=$this->Coatcolor->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Coatcolor->validates($this->data))  {	
				$duplicatearr=$this->Coatcolor->FindAll("id!=".$productid." AND color='".$this->data['Coatcolor']['color']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Coatcolor->save($this->data)) {
						$this->Session->setFlash('Coatcolor successfully saved.');
						$this->redirect('/Coatcolor');
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
		$this->Coatcolor->id=$id;
		$this->data['Coatcolor']['status']="Y";
		$this->Coatcolor->save($this->data);
		$this->Session->setFlash('Coatcolor status successfully changed.'); 
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Coatcolor->id=$id;
		$this->data['Coatcolor']['status']="N";
		$this->Coatcolor->save($this->data);		
		$this->Session->setFlash('Coatcolor status successfully changed.');
		$this->redirect($this->referer());
	}	 
	function delete($productid=NULL) {
		$this->Coatcolor->id=$productid;
		if($this->Coatcolor->delete()) {
			$this->Session->setFlash('Coatcolor successfully deleted.');
			$this->redirect($this->referer());
		}		
	}	
} # end of the class
?>