<?php
class NewstypeController extends AppController
{
	var $name		= "Newstype" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Newstype->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Newstype->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads($criteria)); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); );
		$order='desc';
		$page='5';	
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Newstype->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}		
	function add() {
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {
			if($this->Producttype->validates($this->data))  {	
				$duplicatearr=$this->Producttype->FindAll("producttype='".$this->data['Producttype']['producttype']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Producttype->save($this->data)) {
						$this->Session->setFlash('Product type successfully added.');
						$this->redirect('/producttype');
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
		$this->Producttype->id=$productid;
		$edit_arr=$this->Producttype->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Producttype->validates($this->data))  {	
				$duplicatearr=$this->Producttype->FindAll("id!=".$productid." AND producttype='".$this->data['Producttype']['producttype']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Producttype->save($this->data)) {
						$this->Session->setFlash('Product type successfully saved.');
						$this->redirect('/producttype');
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
		$this->Producttype->id=$id;
		$this->data['Producttype']['status']="Y";
		$this->Producttype->save($this->data);
		$this->Session->setFlash('Product type status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Producttype->id=$id;
		$this->data['Producttype']['status']="N";
		$this->Producttype->save($this->data);		
		$this->Session->setFlash('Product type status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Producttype->id=$productid;
		$this->Producttype->delete();
		$this->Session->setFlash('Product type successfully deleted.');
	    $this->redirect($this->referer());
	}	
} # end of the class
?>