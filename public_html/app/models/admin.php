<?php
class Admin extends AppModel
{
	var $name 		= 'Admin';
	
	
	var $validate = array('admin_login' => array('rule' => 'notEmpty','message'=>'Please enter your username.'),
						  'admin_pwd' => array('rule' => 'notEmpty','message'=>'Please enter your password.'),
						  'admin_pwd_ori' => array('rule' => 'notEmpty','message'=>'Please enter your password.'),
						   'newpass1' => array('rule' => 'notEmpty','message'=>'Please enter your  new password.'),
						   'newpass2' => array('rule' => 'notEmpty','message'=>'Please enter re - your  new password.'),
						   'admin_first_name' => array('rule' => 'notEmpty','message'=>'Please enter your first name.'),
						   'admin_middle_name' => array('rule' => 'notEmpty','message'=>'Please enter your middle name.'),
						   'admin_last_name' => array('rule' => 'notEmpty','message'=>'Please enter your last name.'),					  
						  'admin_email' => array(
						  'rule-1'=>array('rule'=>'notEmpty','message'=>'Please enter email address.'),
						  'rule-2'=>array('rule'=>'email','message'=>'Please enter valid email.'),
						  'rule-3'=>array('rule'=>'isUnique','message'=>'This email already exists.'))						  
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