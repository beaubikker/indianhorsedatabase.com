<?php
class Country extends AppModel
{
	var $name 		= 'Country';	
	var $validate = array('country' => array('rule' => 'notEmpty','message'=>'Please enter country name')
						    );
	
}
?>