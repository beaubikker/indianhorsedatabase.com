<?php
class Pricerange extends AppModel
{
	var $name 		= 'Pricerange';	
	var $validate = array('pricefrom' => array('rule' => 'notEmpty','message'=>'Please enter from price'),
						   'pricetoo' => array('rule' => 'notEmpty','message'=>'Please enter too price'),
						    );
	
}
?>