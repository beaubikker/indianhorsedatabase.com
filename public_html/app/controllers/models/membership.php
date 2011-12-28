<?php
class Membership extends AppModel
{
	var $name= 'Membership';	
	var $validate = array('advantagename' => array('rule' => 'notEmpty','message'=>'Please Provide Advantage name'),
						  'advantagedescription' => array('rule' => 'notEmpty','message'=>'Please Provide Advantage description.'));  
}
?>