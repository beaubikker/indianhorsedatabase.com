<?php
class BlogController extends AppController
{
	var $name		= "Blog" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript', 'Fck', 'Pagination' );
	var $components	= array('Pagination','Upload');	
	var $uses=array('Blog','Blogcomment');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Blog->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Blog->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads($criteria)); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
		//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); );
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Blog->findAll($criteria, NULL, $order, $limit, $page); 	
		return $leads;
	}		
	
	function add() {
		$duplicateerr=0;
		parent::adminlayout(); 		
		$this->set('duplicateerr',$duplicateerr);		
		if(!empty($this->data)) {
			if($this->Blog->validates($this->data))  {	
				$duplicatearr=$this->Blog->FindAll("blogtitle='".$this->data['Blog']['blogtitle']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['Blog']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Blog']['image'], 'blogimage', '', 'blogimage');
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img='';
					}
					$this->data['Blog']['image']=$img;					
					if($this->Blog->save($this->data)) {						
						$this->Session->setFlash('Blog successfully added.');
						$this->redirect('/Blog');
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
		$this->Blog->id=$productid;
		$edit_arr=$this->Blog->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {
			if($this->Blog->validates($this->data))  {	
				$duplicatearr=$this->Blog->FindAll("id!=".$productid." AND blogtitle='".$this->data['Blog']['blogtitle']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['Blog']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Blog']['image'], 'blogimage', '', 'blogimage');
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img=$edit_arr['Blog']['image'];
					}
					$this->data['Blog']['image']=$img;					
					if($this->Blog->save($this->data)) {						
						$this->Session->setFlash('Blog successfully updated.');
						$this->redirect('/Blog');
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
	function viewallcomment($blogid=NULL,$action=NULL) {
		parent::adminlayout(); 
		if($action!="") {
			switch($action) {
				case "delete":
				$this->Blogcomment->id=$blogid ;
				$this->Blogcomment->Delete();
				break; 
			}
		}
		$blogcomment_arr=$this->Blogcomment->FindAll('blogid='.$blogid);
		$this->set('list_arr',$blogcomment_arr);	
	}	
	function stat_on($id=NULL) {
		$this->Blog->id=$id;
		$this->data['Blog']['status']="Y";
		if($this->Blog->save($this->data)) {
			$this->Session->setFlash('Blog status successfully changed.'); 
		}
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Blog->id=$id;
		$this->data['Blog']['status']="N"; 
		$this->Blog->save($this->data);		
		$this->Session->setFlash('Blog status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Blog->id=$productid; 
		$this->Blog->delete();
		$this->Session->setFlash('Blog successfully deleted.');
	    $this->redirect($this->referer()); 
	}	
} # end of the class
?>