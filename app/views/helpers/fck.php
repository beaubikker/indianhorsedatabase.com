<?php 
class FckHelper extends  AppHelper {
	
    var $InstanceName;
    	
    function create($instance, $Value = "", $Width = '100%', $Height = '400', $ToolbarSet = 'Default'){
		
		$instance = explode('/', $instance);
        $this->instanceName = 'data['.$instance[0].']['.$instance[1].']';
        
		require_once(FCK_EDITOR_CLASS_PATH);
							  
		$sBasePath  = FCK_EDITOR_BASE_PATH;
	    $oFCKeditor = new FCKeditor($this->instanceName) ;
	    $oFCKeditor->ToolbarSet = $ToolbarSet;
		$oFCKeditor->BasePath = $sBasePath ;
		$oFCKeditor->Config['SkinPath'] = FCK_EDITOR_SKIN_PATH;
		$oFCKeditor->Width  = $Width ;
		$oFCKeditor->Height = $Height ;					
		$oFCKeditor->Value = $Value;
		$oFCKeditor->Create() ;
	}
}
?>