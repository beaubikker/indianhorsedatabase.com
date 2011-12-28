<?php
class Gender extends AppModel
{
	var $name= 'Gender';	
	var $validate = array('gender' => array('rule' => 'notEmpty','message'=>'Please enter gender.')					 
						   );  
}
?>