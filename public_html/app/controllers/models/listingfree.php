<?php
class Listingfree extends AppModel
{
	var $name 		= 'Listingfree';	
	var $validate = array('contentname' => array('rule' => 'notEmpty','message'=>'Please provide name'),						  
						  'content' => array('rule' => 'notEmpty','message'=>'Please provide content')
						    );
}
?>