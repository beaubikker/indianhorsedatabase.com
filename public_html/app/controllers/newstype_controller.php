<?php
class NewstypeController extends AppController
{
	var $name		= "Newstype" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','upload');	
	var $uses=array('Newstype','News');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Newstype->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Newstype->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
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
			if($this->Newstype->validates($this->data))  {	
				$duplicatearr=$this->Newstype->FindAll("Newstype='".$this->data['Newstype']['newstype']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Newstype->save($this->data)) {
						$this->Session->setFlash('News type successfully added.');
						$this->redirect('/newstype');
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
		$this->Newstype->id=$productid;
		$edit_arr=$this->Newstype->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {			
			if($this->Newstype->validates($this->data))  {	
				$duplicatearr=$this->Newstype->FindAll("id!=".$productid." AND Newstype='".$this->data['Newstype']['newstype']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->Newstype->save($this->data)) {
						$this->Session->setFlash('News type successfully saved.');
						$this->redirect('/newstype');
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
		$this->Newstype->id=$id;
		$this->data['Newstype']['status']="Y";
		$this->Newstype->save($this->data);
		$this->Session->setFlash('News type status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Newstype->id=$id;
		$this->data['Newstype']['status']="N";
		$this->Newstype->save($this->data);		
		$this->Session->setFlash('News type status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Newstype->id=$productid;
		$newsexists_arr=$this->News->FindAll('newstype='.$productid);
		if(count($newsexists_arr)>0) {
			$this->Session->setFlash('Sorry! this news type has alrteady assigned to a News.Cannot be deleted');
			$this->redirect($this->referer());
		}
		else {		
			$this->Newstype->delete();
			$this->Session->setFlash('News type successfully deleted.');
			$this->redirect($this->referer());
		}
	}	
} # end of the class
?>