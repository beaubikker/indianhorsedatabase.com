<?php
class Advertisement extends AppModel
{
	var $name 		= 'Advertisement';	
	var $validate = array('name' => array('rule' => 'notEmpty','message'=>'Please advertisement name'),
						  
						  );
	
}
?>