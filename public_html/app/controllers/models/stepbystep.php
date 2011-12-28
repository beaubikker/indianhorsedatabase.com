<?php
class Stepbystep extends AppModel
{
	var $name 		= 'Stepbystep';
	var $validate = array('stepname' => array('rule' => 'notEmpty','message'=>'Please enter stepname.'),
						  );
	
}
?>