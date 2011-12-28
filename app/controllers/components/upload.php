<?php 
/***************************************************
* Soumavo 
*/
class UploadComponent extends Object
{
	function uploadfile($fieldName, $path, $id, $fileName="") {	
	 $up_dir = WWW_ROOT."/img/". $fileName;
	 
/*	
	pr($fieldName);
	die;
*/	
	if(is_uploaded_file($fieldName['tmp_name'])) {
		$upload=true;
	}else{
		$upload=false;
	}
	if($upload==true) {
		if($fileName==""){
			$fileName = "uploaded_file_";
		}
		if($id!=""){
			$ext = strtolower(end(explode('.', $fieldName['name'])));
			$file=$fileName.$id.".".$ext;
		}
		else{
			$file=time()."_".$fieldName['name'];
		}
		@chmod($up_dir, 0777);
		$newpath=$up_dir."/".$file;
		$newpathString = $fileName.'/'.$file;
		
		$up=move_uploaded_file($fieldName['tmp_name'], $newpath);
		@chmod($newpath , 0777);
		return str_replace('./', '', str_replace('../', '', $newpathString));
	}
	else{
		return "";
	}
}


function uploadFiles($folder, $file, $itemId = null) {	
		//echo $file;
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder; 
		$rel_url = $folder;
		
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}
			
		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId;  
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		} 
		
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		
		// loop through and deal with the files
		//foreach($formdata as $file) {
			//echo $file['name'];
			//exit;
			// replace spaces with underscores 
			
			$filename = str_replace(' ', '_', $file['name']); 
			// assume filetype is false
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}
			//echo $typeOK."<br>".$file['error']."aaa";exit;
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
						} else {
							$result['errors'][] = "Error uploaded $filename. Please try again.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error uploading $filename. Please try again.";
						break;
					default:
						// an error occured
						$result['errors'][] = "System error uploading $filename. Contact webmaster.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No file Selected";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";		}
		//}
		return $result;
	}
}
?>
