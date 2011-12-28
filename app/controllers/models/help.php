<?php
class Help extends AppModel
{
	var $name 		= 'Help';	
	var $validate = array('hlpname' => array('rule' => 'notEmpty','message'=>'Please provide helpname'),						  
						  'helptext' => array('rule' => 'notEmpty','message'=>'Please provide help content')
						    );
}
?>