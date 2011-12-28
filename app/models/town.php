<?php
class Town extends AppModel
{
	var $name 		= 'Town';	
	var $validate = array('state_id' => array('rule' => 'notEmpty','message'=>'Please select state'),						  
						  'town' => array('rule' => 'notEmpty','message'=>'Please provide town name')
						    );
}
?>