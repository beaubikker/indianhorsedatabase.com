<?php
class Coatcolor extends AppModel
{
	var $name 		= 'Coatcolor';	
	
	var $validate = array( 'color' => array('rule' => 'notEmpty','message'=>'Please Enter color Name')					 
						  );
	
}
?>