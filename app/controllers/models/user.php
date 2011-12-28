<?php
class User extends AppModel
{
	var $name= 'User';	
	var $validate = array('usertype' => array('rule' => 'notEmpty','message'=>'Please select user type.'),
						  'firstname' => array('rule' => 'notEmpty','message'=>'Please enter first name.'),
						  'lastname' => array('rule' => 'notEmpty','message'=>'Please enter last name.'),
						  'password' => array('rule-1' => array('rule'=>'notEmpty','message'=>'Please enter password.')),
						  'email_address'=>array('rule-1'=>array('rule'=>'notEmpty','message'=>'Please enter email address.'),'rule-2'=>array('rule'=>'email','message'=>'Please enter valid email.')));  
}
?>