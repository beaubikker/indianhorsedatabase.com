<?php
class News extends AppModel
{
	var $name 		= 'News';	
	var $validate = array('newstype' => array('rule' => 'notEmpty','message'=>'Please select newstype'),
						  'newstitle' => array('rule' => 'notEmpty','message'=>'Please enter news title'),
						  'newsdesc' => array('rule' => 'notEmpty','message'=>'Please enter news description')				 
						  );
	
}
?>