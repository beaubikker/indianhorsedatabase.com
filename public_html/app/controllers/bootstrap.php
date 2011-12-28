<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
 	define("PREFVAR","/tinbox/");
    define("SITE_URL","http://".$_SERVER['SERVER_NAME'].PREFVAR);
    define("ADMIN_URL","http://".$_SERVER['SERVER_NAME'].PREFVAR."admin/");
    
	define("SCROLL_COLOR","#F5F3CF");
	
	define("FCK_EDITOR_BASE_PATH",DS.'fckeditor'.DS);
	define("FCK_EDITOR_SKIN_PATH",DS.'fckeditor'.DS.'editor'.DS.'skins'.DS.'office2003'.DS);
	define("FCK_EDITOR_CLASS_PATH",WWW_ROOT.DS.'fckeditor'.DS.'fckeditor.php');
 
 		function rootpth() {
			$rootpath=$_SERVER['DOCUMENT_ROOT']."/app/webroot/img/";
			return $rootpath;
		}	
	
	function thumbnail($imagedirectory=NULL,$target=NULL,$image=NULL,$image2 = NULL,$rootdirectory=NULL,$class=NULL) {
	if($image!="") {
		if (file_exists(rootpth()."/".$imagedirectory."/".$image)) {
			$imagearr=getimagesize(rootpth()."/".$imagedirectory."/".$image);	 
			$width=$imagearr[0];
			$height=$imagearr[1];
			if($width>$height) {
				$per=$target/$width;
			}
			else {
				$per=$target/$height;
			}
			$width=round($width*$per);
			$height=round($per*$height); 
			$img="<img src=".$rootdirectory."img/".$imagedirectory."/".$image." height=".$height." width=".$width." border=0 class=".$class.">";			
		}
		else {
			$img="<img src=".rootpath()."img/noimage.jpg height=".$height." width=".$width." border = 0>";	
		}
	}
	else {
		$img="<img src=".$rootdirectory."img/noimage.jpg height=".$height." width=".$width." border = 0>";
	}
	return $img;
}
function setlimit() {
	$limit=10;
	return $limit;
}
function pagelinkname() {
		$linkname="http://indianhorses.india-web-design.com/";
		return $linkname;	
	}
	function site_url()	{
	 $site_url= "http://indianhorses.india-web-design.com/";
	 return $site_url;
	}

//EOF
?>