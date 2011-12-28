<?php
class TownController  extends AppController
{
	var $name		= "Town" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Town','Breed','State');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Town->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Town->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Town->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() { 
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		$state_arr=$this->State->FindAll("status='Y'");
		$this->set('state_arr',$state_arr);
		$this->set('state_id',$this->data['Town']['state_id']);
		if(!empty($this->data)) {
			if($this->Town->validates($this->data))  {	
				$duplicatearr=$this->Town->FindAll("town='".$this->data['Town']['town']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Town->save($this->data)) {
						$this->Session->setFlash('Town successfully added.');
						$this->redirect('/Town');
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
		$this->Town->id=$productid;
		$edit_arr=$this->Town->Read();
		$this->set('edit_arr',$edit_arr);
		$state_arr=$this->State->FindAll("status='Y'");
		$this->set('state_arr',$state_arr);	
		$this->set('duplicateerr',$duplicateerr);	
		if(!empty($this->data)) {			
			if($this->Town->validates($this->data))  {	
				$duplicatearr=$this->Town->FindAll("id!=".$productid." AND town='".$this->data['Town']['town']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
					$this->set('duplicateerr',$duplicateerr);
				}
				if($duplicateerr<=0) {
					if($this->Town->save($this->data)) {
						$this->Session->setFlash('Town successfully saved.');
						$this->redirect('/Town');
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
		$this->Town->id=$id;
		$this->data['Town']['status']="Y";
		$this->Town->save($this->data);
		$this->Session->setFlash('Town status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Town->id=$id;
		$this->data['Town']['status']="N";
		$this->Town->save($this->data);		
		$this->Session->setFlash('Town status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Town->id=$productid;
		if($this->Town->delete()) {
			$this->Session->setFlash('Town successfully deleted.');
			$this->redirect($this->referer());
		}		
	}
	function townname($town_id=NULL) {
		return $this->Town->FindByid($town_id) ;	
	}	
	function listtown($state_id=NULL) {
		parent::adminlayout(); 
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$state_id);
		$this->set('town_arr',$town_arr);
	}	
	function listtownforuser($state_id=NULL) {
		parent::adminlayout(); 
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$state_id);
		$this->set('town_arr',$town_arr);
	}	
	function listtownforsearch($state_id=NULL) {
		parent::adminlayout(); 
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$state_id);
		$this->set('town_arr',$town_arr);
	}	
	function liststabletown($state_id=NULL) {
		parent::adminlayout(); 
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$state_id);
		$this->set('town_arr',$town_arr);
	}	
	function listmemtownall($state_id=NULL) {
		parent::adminlayout(); 
		$town_arr=$this->Town->FindAll("status='Y' AND state_id=".$state_id);
		$this->set('town_arr',$town_arr);
	}	
} # end of the class
?>