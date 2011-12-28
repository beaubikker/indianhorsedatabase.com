<?php
class Height extends AppModel
{
	var $name 		= 'Height';	
	
	var $validate = array( 'height' => array('rule' => 'notEmpty','message'=>'Please Enter height')					 
						  );
	
}
?>