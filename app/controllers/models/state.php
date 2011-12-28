<?php
class State extends AppModel
{
	var $name 		= 'State';	
	var $validate = array('country_id' => array('rule' => 'notEmpty','message'=>'Please select country'),						  
						  'statename' => array('rule' => 'notEmpty','message'=>'Please provide state name')
						    );	
}
?>