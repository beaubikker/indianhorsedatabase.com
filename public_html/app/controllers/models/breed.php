<?php
class Breed extends AppModel
{
	var $name 		= 'Breed';	
	
	var $validate = array( 'breed' => array('rule' => 'notEmpty','message'=>'Please Enter Breed Name')					 
						  );
	
}
?>