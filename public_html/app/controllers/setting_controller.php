<?php
class SettingController  extends AppController
{
	var $name		= "Setting" ;		
	var $helpers 	= array( 'Html', 'Form', 'Javascript','Pagination' );
	var $components	= array('Pagination','Upload');	
	var $uses=array('Setting','Breed');
	function index()
	{	
		parent::adminlayout(); 
		parent::checkAdminSession(); 
		$id=1;
		$settingarr=$this->Setting->FindByid($id);
		$this->set('settingarr',$settingarr);
		if(!empty($this->data)) {
			if($this->data['Setting']['logo']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Setting']['logo'], 'settingimages', '', 'settingimages'); 
				$fileNameArr=explode('/',$path);
				$logo=$fileName=$fileNameArr[1];
			}
			else {
				$logo=$settingarr['Setting']['logo'] ;
			}			
			if($this->data['Setting']['headerimage']['name']!="") {
				$path = $this->Upload->uploadfile($this->data['Setting']['headerimage'], 'settingimages', '', 'settingimages'); 
				$fileNameArr=explode('/',$path);
				$img=$fileName=$fileNameArr[1];
			}
			else {
				$img=$settingarr['Setting']['headerimage'] ;
			}		
			$this->Setting->id=1;
			$this->data['Setting']['logo']=$logo;
			$this->data['Setting']['headerimage']=$img;
			$this->Setting->save($this->data);
			$this->Session->setFlash('Successfully Updated.');
			$this->redirect('/setting');
		}
	}	
	function allimage() {
		$id=1;
		$settingarr=$this->Setting->FindByid($id);
		return $settingarr;	
	}	
	function fetchsettings()
	{
	  $this->Setting->set('id',1);
	  $setArr = $this->Setting->find('first');
	  return $setArr;
	}
} # end of the class
?>