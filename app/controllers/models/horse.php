<?php
class Horse extends AppModel
{
	var $name 		= 'Horse';	
	var $validate = array(
						  'gender' => array('rule' => 'notEmpty','message'=>'Please select gender'),
						  'height_id' => array('rule' => 'notEmpty','message'=>'Please select height'),
						  'coatcolor_id' => array('rule' => 'notEmpty','message'=>'Please select coat color'),
						  'other_details' => array('rule' => 'notEmpty','message'=>'Please provide some information about horse'),	
						  );
	
}
?>

