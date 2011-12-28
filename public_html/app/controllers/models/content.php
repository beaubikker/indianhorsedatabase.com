<?php
class Content extends AppModel
{
	var $name 		= 'Content'; 
	var $validate = array(
						  'pagename' => array('rule' => 'notEmpty','message'=>'Please enter page name'),
                                               'pagetitle' => array('rule' => 'notEmpty','message'=>'Please enter page title'),
						  					  'content' => array('rule' => 'notEmpty','message'=>'Please enter content')						  
						  ); 
						  
						 
}

?>