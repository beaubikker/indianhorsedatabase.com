<?php
class Stable extends AppModel
{
	var $name 		= 'Stable';	
	var $validate = array('userid' => array('rule' => 'notEmpty','message'=>'Please select user'),						  
						  'stable_name' => array('rule' => 'notEmpty','message'=>'Please provide stable name')
						    );
	
}
?>