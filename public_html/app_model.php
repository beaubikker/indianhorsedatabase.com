<?php
// file: /app/app_model.php 
define('VALID_WORD', '/^\\w+$/'); 
define('VALID_UNIQUE', 'isUnique'); 
define('VALID_LENGTH_WITHIN', 'isLengthWithin'); 
define('VALID_CONFIRMED', 'isConfirmed'); 
  
class AppModel extends Model 
{ 
  
  // If you need to disable validation for particular columns, you may populate this variable like so: 
  // $this->User->disabledValidate = array('email', 'password'); // disables validation on email and password columns 
  // $this->User->disabledValidate = array( 
  //   'email', 
  //   'password' => array('confirmed', 'required') 
  // ); // disables validation on email column, and password['confirmed'] && password['required'] 
	var $disabledValidate; 
   
	function loadValidation() 
	{ 
		// placeholder for overloading 
	} 
      
	function invalidFields($data = array()) 
  	{ 
    	$this->loadValidation(); 
    	if (!$this->beforeValidate()) 
		{ 
        	return false; 
    	}
		if (is_array($this->disabledValidate)) 
		{ 
			foreach($this->disabledValidate as $field => $params) 
			{ 
				if (is_string($field) && is_array($params)) 
				{ 
					foreach($params as $param) 
					{ 
						if (is_string($param)) 
						{ 
							$this->validate[$field][$param] = false; 
						} 
					} 
				} 
				else if (is_int($field) && is_string($params)) 
				{ 
					$this->validate[$params] = false; 
				} 
			} 
		} 
    /*debug($this->validate); 
	exit ;*/
	
		if (!isset($this->validate) || !empty($this->validationErrors)) 
		{ 
			if (!isset($this->validate)) 
			{ 
				return true; 
			} 
			else 
			{ 
				return $this->validationErrors; 
			} 
		}  
		if (isset($this->data)) 
		{ 
			$data = array_merge($data, $this->data); 
		}   
		$errors = array(); 
		$this->set($data);   
		
		foreach ($data as $table => $field) 
		{ 
			foreach ($this->validate as $field_name => $validators) 
			{	
				if ($validators) 
				{       
					foreach($validators as $validator) 
					{ 
						if (isset($validator['method'])) 
						{ 
							if (method_exists($this, $validator['method'])) 
							{ 
								$parameters = (isset($validator['parameters'])) ? $validator['parameters'] : array(); 
								$parameters['var'] = $field_name; 
								if (isset($data[$table][$field_name]) && !call_user_func_array(array(&$this, $validator['method']),array($parameters))) 
								{ 
									if (!isset($errors[$field_name])) 
									{ 
										$errors[$field_name] = isset($validator['message']) ? $validator['message'] : 1; 										
										//echo "error = " . $errors[$field_name] ;										
									} 
								} 
							} 
							else 
							{ 
								if (isset($data[$table][$field_name]) && !preg_match($validator['method'], $data[$table][$field_name])) 
								{ 
									if (!isset($errors[$field_name])) 
									{ 
										$errors[$field_name] = isset($validator['message']) ? $validator['message'] : 1; 
										//echo "error(Else) = " . $errors[$field_name] ;
									} 
								} 
							} 
						} 
					} 
				} 
			} 
		} 
		$this->validationErrors = $errors; 
		return $errors; 
	} 
	
  // validation methods 
     
	function isUnique($params) 
	{ 
		$val = $this->data[$this->name][$params['var']]; 
		$db = $this->name . '.' . $params['var']; 
		$id = $this->name . '.id'; 
		if($this->id == null ) 
		{ 
			return(!$this->hasAny(array($db => $val ) )); 
		} 
		else 
		{ 
			return(!$this->hasAny(array($db => $val, $id => '!='.$this->data[$this->name]['id'] ) ) ); 
		} 
	} 
  
	function isLengthWithin($params) 
	{ 
		$val = $this->data[$this->name][$params['var']]; 
		$length = strlen($val); 		
		if (array_key_exists('min', $params) && array_key_exists('max', $params)) 
		{ 
			return $length >= $params['min'] && $length <= $params['max']; 
		} 
		else if (array_key_exists('min', $params)) 
		{ 
			return $length >= $params['min']; 
		} 
		else if (array_key_exists('max', $params)) 
		{ 
			return $length <= $params['max']; 
		} 
	} 
  
	function isConfirmed($params) 
	{ 
		$val 	= $this->data[$this->name][$params['var']]; 
		$val_confirmation 	= array_key_exists('confirm_var', $params) ? 
		$this->data[$this->name][$params['confirm_var']] : 
		$this->data[$this->name][$params['var'].'_confirmation']; 
		return $val == $val_confirmation; 
	} 
} #END OF APP_MODEL

?>