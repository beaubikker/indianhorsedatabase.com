<?php
class Product extends AppModel
{
	var $name 		= 'Product';	
	var $validate = array('productname' => array('rule' => 'notEmpty','message'=>'Please select enter product name'),
						  'producttype' => array('rule' => 'notEmpty','message'=>'Please select product type'),
						  'dimensions' => array('rule' => 'notEmpty','message'=>'Please select product dimension'),
						  'length' => array('rule' => 'notEmpty','message'=>'Please select product length'),
						  'width' => array('rule' => 'notEmpty','message'=>'Please select product width'),
						  'price' => array('rule' => 'notEmpty','message'=>'Please enter product price')					 
						  );
	
}
?>