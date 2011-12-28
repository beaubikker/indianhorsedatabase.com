<?php
class Blog extends AppModel
{
	var $name 		= 'Blog';	
	var $validate = array('blogtitle' => array('rule' => 'notEmpty','message'=>'Please enter blog title'),
						  'blogdescription' => array('rule' => 'notEmpty','message'=>'Please enter blog description')		 
						  );
	
}
?>