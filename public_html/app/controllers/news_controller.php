<?php
class NewsController extends AppController
{
	var $name		= "News" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript', 'Fck', 'Pagination' );
	var $components	= array('Pagination','Upload');	
	var $uses=array('News','Newstype');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->News->Find('count');		
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->News->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads($criteria)); //in app/app_controller
		
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); );
		$order='desc';
		$page='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->News->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}		
	
	function add() {
		$duplicateerr=0;
		$newstypearr=self::listnewstype();
		parent::adminlayout(); 
		$this->set('newstypearr',$newstypearr);
		$this->set('duplicateerr',$duplicateerr);
		$this->set('newstype',$this->data['News']['newstype']);
		if(!empty($this->data)) {
			if($this->News->validates($this->data))  {	
				$duplicatearr=$this->News->FindAll("newstitle='".$this->data['News']['newstitle']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['News']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['News']['image'], 'newsimage', '', 'newsimage');
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img='';
					}
					$this->data['News']['image']=$img;					
					if($this->News->save($this->data)) {						
						$this->Session->setFlash('News successfully added.');
						$this->redirect('/News');
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
	function listnewstype() {
		$listnewstypearr=$this->Newstype->FindAll("status='Y'");
		return $listnewstypearr;	
	}	
	function newstype($type_id=NULL) {
		$typearr=$this->Newstype->FindAll("id=".$type_id);
		return $typearr[0]['Newstype']['newstype'];
	}
	function edit($productid=NULL) {
		$duplicateerr=0;
		$newstypearr=self::listnewstype();
		parent::adminlayout(); 
		$this->set('newstypearr',$newstypearr);
		$this->News->id=$productid;
		$edit_arr=$this->News->Read();
		$this->set('edit_arr',$edit_arr);		
		if(!empty($this->data)) {
			if($this->News->validates($this->data))  {	
				$duplicatearr=$this->News->FindAll("id!=".$productid." AND newstitle='".$this->data['News']['newstitle']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['News']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['News']['image'], 'newsimage', '', 'newsimage');
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img=$edit_arr['News']['image'];
					}
					$this->data['News']['image']=$img;					
					if($this->News->save($this->data)) {						
						$this->Session->setFlash('News successfully updated.');
						$this->redirect('/News');
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
		$this->News->id=$id;
		$this->data['News']['status']="Y";
		$this->News->save($this->data);
		$this->Session->setFlash('News status successfully changed.');
	    $this->redirect($this->referer());
	}
	function stat_off($id=NULL) {
		$this->News->id=$id;
		$this->data['News']['status']="N";
		$this->News->save($this->data);		
		$this->Session->setFlash('News status successfully changed.'); 
	    $this->redirect($this->referer());
	}	
	function delete($productid=NULL) {
		$this->News->id=$productid;
		$this->News->delete();
		$this->Session->setFlash('News successfully deleted.');
	    $this->redirect($this->referer());
	}	
} # end of the class
?>