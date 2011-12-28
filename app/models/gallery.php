<?php
class Gallery extends AppModel
{
	var $name 		= 'Gallery';
	
	
	var $validate = array('galleryname' => array('rule' => 'notEmpty','message'=>'Please enter gallery name.'),						  			  
						  );
	
	
	
	
	
	
	/*var $validate = array('admin_login' => array('rule' => 'notEmpty','message'=>'Please enter first name.'),
						  'admin_pwd' => array('rule' => 'notEmpty','message'=>'Please enter your password.'),
						  'email_address'=>array('rule-1'=>array('rule'=>'notEmpty','message'=>'Please enter email address.'),'rule-2'=>array('rule'=>'email','message'=>'Please enter valid email.'),'rule-3'=>array('rule'=>'isUnique','message'=>'This email already exists.')),
						  'password' => array('rule' => 'notEmpty','message'=>'Please enter password.'),
						  'businessname' => array('rule' => 'notEmpty','message'=>'Please enter business name.'),
						  'business_address' => array('rule' => 'notEmpty','message'=>'Please enter business addrerss.'),
						  'phone' => array('rule' => 'notEmpty','message'=>'Please enter phone.'),
						  'address' => array('rule' => 'notEmpty','message'=>'Please enter address.'),
						  'fax' => array('rule' => 'notEmpty','message'=>'Please enter fax.'),
						  'website' => array('rule' => 'url','message'=>'Please enter valid website.')						  
						  ); */ 
	
	
					
					
	
}
?>