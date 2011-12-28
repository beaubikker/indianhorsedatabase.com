<?php
class Newstype extends AppModel
{
	var $name 		= 'Newstype';	
	
	var $validate = array( 'newstype' => array('rule' => 'notEmpty','message'=>'Please Enter News Type')					 
						  );
	
}
?>