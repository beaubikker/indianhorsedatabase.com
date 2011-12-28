<?php
class Producttype extends AppModel
{
	var $name 		= 'Producttype';	
	
	var $validate = array( 'producttype' => array('rule' => 'notEmpty','message'=>'Please Enter Product Type')					 
						  );
	
}
?>