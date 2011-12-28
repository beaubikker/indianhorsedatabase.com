<?php
class ProductController  extends AppController
{
	var $name		= "Product" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','Upload');	
	var $uses=array('Product','Producttype');
	function index()
	{	
		parent::adminlayout(); 
		$pagetotal=$this->Product->Find('count');	 	
		$this->set('pagetotal',$pagetotal);
		$criteria=NULL;
		$this->set('listarr', $this->Product->findAll('','','order by id desc','',''));
		$this->set('listarr', $this->_paginate_leads($criteria)); //in app/app_controller
	}	
	function _paginate_leads($criteria) {
	//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); );
		$order='desc';
		$page='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Product->findAll($criteria, NULL, $order, $limit, $page);	
		return $leads;
	}		
	
	function add() {
		$prodtypearr=self::listproducttype();
		$this->set('prodtypearr',$prodtypearr);
		$duplicateerr=0;
		parent::adminlayout(); 
		$this->set('duplicateerr',$duplicateerr);
		if(!empty($this->data)) {			
			if($this->Product->validates($this->data))  {	
				$duplicatearr=$this->Product->FindAll("productname='".$this->data['Product']['productname']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['Product']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Product']['image'], 'productimage', '', 'productimage'); 
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img='';
					}
					$this->data['Product']['image']=$img;				
					if($this->Product->save($this->data)) {
					$lastid=$this->Product->getLastInsertId();					
					if(is_numeric($_POST['hiddval'])){
						if($_POST['hiddval']>0) {
							for($i=1;$i<=$_POST['hiddval'];$i++) {
								$path=rootpth()."additionalproimage";
								$randno=rand(4563,478962);
								if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
									$insert_image_sql="INSERT INTO tbl_additionalproductimages SET productid=".$lastid.",image='".$randno.$_FILES['img_'.$i]['name']."'";
									$this->Product->query($insert_image_sql);
								}	
							}
						}
					}						
					$this->Session->setFlash('Product successfully added.');  
					$this->redirect('/product');
					}				
				}				
			}			 
		  else 
		  {
			return false;  
		  }	
		}
		$this->set('prodtype',$this->data['Product']['producttype']);
		$this->set('duplicateerr',$duplicateerr);
	}	
	
	function listproducttype() {
		$prodtypearr=$this->Producttype->FindAll("status='Y'");
		return $prodtypearr;		
	}	
	function edit($productid=NULL) {
		$duplicateerr=0;
		parent::adminlayout(); 		
		$list_image_sql="SELECT * FROM tbl_additionalproductimages WHERE productid=".$productid ;
		$listimage_arr=$this->Product->query($list_image_sql);
		$this->set('imagearr',$listimage_arr);		
		$prodtypearr=self::listproducttype();
		$this->set('prodtypearr',$prodtypearr);
		$this->Product->id=$productid;
		$edit_arr=$this->Product->Read();
		$this->set('edit_arr',$edit_arr);
		if(!empty($this->data)) {			
			if($this->Product->validates($this->data))  {	
				$duplicatearr=$this->Product->FindAll("id!=".$productid." AND productname='".$this->data['Product']['productname']."'");
				if(count($duplicatearr)>0) {
					$duplicateerr++;
				}
				if($duplicateerr<=0) {
					if($this->data['Product']['image']['name']!="") {
						$path = $this->Upload->uploadfile($this->data['Product']['image'], 'productimage', '', 'productimage');
						$fileNameArr=explode('/',$path);
						$img=$fileName=$fileNameArr[1];
					}
					else {
						$img=$edit_arr['Product']['image'] ;
					}
					$this->data['Product']['image']=$img;				
					if($this->Product->save($this->data)) {
					$lastid=$this->Product->getLastInsertId();					
					if(is_numeric($_POST['hiddval'])){
						if($_POST['hiddval']>0) {
							for($i=1;$i<=$_POST['hiddval'];$i++) {
								$path=rootpth()."additionalproimage";
								$randno=rand(4563,478962);
								if(move_uploaded_file($_FILES['img_'.$i]['tmp_name'],$path."/".$randno.$_FILES['img_'.$i]['name'])) {
									$insert_image_sql="INSERT INTO tbl_additionalproductimages SET productid=".$productid.",image='".$randno.$_FILES['img_'.$i]['name']."'";
									$this->Product->query($insert_image_sql);
								}	
							}
						}
					}						
						$this->Session->setFlash('Product successfully updated.');
						$this->redirect('/product');
					}				
				}				
			}			 
		  else 
		  {
		  	$this->set('duplicateerr',$duplicateerr);
			return false;  
		  }	
		}
		$this->set('duplicateerr',$duplicateerr);
	}	
	function stat_on($id=NULL) {
		$this->Product->id=$id;
		$this->data['Product']['status']="Y";
		$this->Product->save($this->data);
		$this->Session->setFlash('Product status successfully changed.');
	    $this->redirect($this->referer());
	}
	function deladdimage($id=NULL,$image=NULL) {
		$del_sql="DELETE FROM tbl_additionalproductimages WHERE id=".$id; 
		$this->Product->Query($del_sql);
		if(@unlink(rootpth()."additionalproimage/".$image)) {	
		}
		$this->redirect($this->referer());
	}		
	function stat_off($id=NULL) {
		$this->Product->id=$id;
		$this->data['Product']['status']="N";
		$this->Product->save($this->data);		
		$this->Session->setFlash('Product status successfully changed.'); 
	    $this->redirect($this->referer());
	}	
	function producttype($typeid=NULL) {
		$this->Producttype->id=$typeid;
		$readarr=$this->Producttype->Read();
		return $readarr['Producttype']['producttype'];	
	}
	function delete($productid=NULL) {
		$this->Product->id=$productid;
		$this->Product->delete();
		$this->Session->setFlash('Product type successfully deleted.');
	    $this->redirect($this->referer());
	}	
} # end of the class
?>