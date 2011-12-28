<?php
class AdvertisementController  extends AppController
{
	var $name		= "Advertisement" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','Upload');	
	var $uses=array('Advertisement','Breed');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Advertisement->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Advertisement->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads('','','order by id desc','','')); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); ); 
		$order='desc';
		$page='5';		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Advertisement->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}			
	function add() {	
		error_reporting(0);	
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {
			if($this->Advertisement->validates($this->data))  {					
				if($duplicateerr<=0) {
						if($this->data['Advertisement']['image']['name']!="") { 
							$path = $this->Upload->uploadfile($this->data['Advertisement']['image'], 'advertisementimage', '', 'advertisementimage'); 
							$fileNameArr=explode('/',$path);
							$img=$fileName=$fileNameArr[1];
						}
						else {
							$img='';
						}
						$this->data['Advertisement']['image']=$img;	
						
						$pagevalue='';
						if(count($this->data['Advertisement']['page'])>0) {
							foreach($this->data['Advertisement']['page'] as $key=>$val) :
								$pagevalue.=",".$val ;
							endforeach;
						}
						$this->data['Advertisement']['page']=$pagevalue;						
						if($this->Advertisement->save($this->data)) {					    						
							$this->Session->setFlash('Advertisement successfully added.');
							$this->redirect('/Advertisement');
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
		error_reporting(0);
		parent::adminlayout(); 
		$this->Advertisement->id=$productid;
		$edit_arr=$this->Advertisement->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {
			if($this->Advertisement->validates($this->data))  {					
				if($duplicateerr<=0) {
						if($this->data['Advertisement']['image']['name']!="") {
							$path = $this->Upload->uploadfile($this->data['Advertisement']['image'], 'advertisementimage', '', 'advertisementimage'); 
							$fileNameArr=explode('/',$path);
							$img=$fileName=$fileNameArr[1];
						}
						else {
							$img=$edit_arr['Advertisement']['image'];
						}
						$this->data['Advertisement']['image']=$img;						
						$pagevalue='';
						if(count($this->data['Advertisement']['page'])>0) {
							foreach($this->data['Advertisement']['page'] as $key=>$val) :
								$pagevalue.=",".$val ;
							endforeach;
						}
					$this->data['Advertisement']['page']=$pagevalue;
					if($this->Advertisement->save($this->data)) {							
					    $this->data['Advertisement']['image']=$img;								
						$this->Session->setFlash('Advertisement successfully added.');
						$this->redirect('/Advertisement');
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
		$this->Advertisement->id=$id;
		$this->data['Advertisement']['status']="Y";
		$this->Advertisement->save($this->data);
		$this->Session->setFlash('Advertisement status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->Advertisement->id=$id;
		$this->data['Advertisement']['status']="N";
		$this->Advertisement->save($this->data);		
		$this->Session->setFlash('Advertisement status successfully changed.');
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->Advertisement->id=$productid;
		if($this->Advertisement->delete()) {
			$this->Session->setFlash('Advertisement successfully deleted.');
			$this->redirect($this->referer());
		}		
	}
	function Advertisementname($Advertisement_id=NULL) {
		return $this->Advertisement->FindByid($Advertisement_id) ;	
	}	
	function listall() {
		$currentpage=$_SERVER['REQUEST_URI'] ;
		if($currentpage=="/") { 
			$pagename='home';
			$listarr=$this->Advertisement->FindAll("status='Y' AND page LIKE '%".$pagename."%'"); 
		}
		else {
			if(stristr($currentpage,'horse')) {
				$pagename='horse';
				$listarr=$this->Advertisement->FindAll("status='Y' AND page LIKE '%".$pagename."%'",'',' order by RAND()','','');
			}
			else {
				if(stristr($currentpage,'content')) {
					$pagename='content';
				}
				if(stristr($currentpage,'user')) {
					$pagename='user';
				}	
				if(stristr($currentpage,'help')) {
					$pagename='help';
				}
				if(stristr($currentpage,'stable')) {
					$pagename='stable';
				}
				$listarr=$this->Advertisement->FindAll("status='Y' AND page LIKE '%".$pagename."%'");
			}
		}		
		return $listarr;	
	}	
} # end of the class
?>