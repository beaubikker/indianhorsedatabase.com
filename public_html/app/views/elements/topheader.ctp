<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$currpage=basename($_SERVER['REQUEST_URI']);
?>

<head>
<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-20574971-1']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

</script>
	<?php
	if(stristr($_SERVER['REQUEST_URI'],'horse/details/') || stristr($_SERVER['REQUEST_URI'],'horse/horsedetailsforsale')) {
	?>
		<title>
			<?php 
			e($horsearr['Horse']['name']);?> - <?php 
			$breedname=$this->requestAction('/horse/breedname/'.$horsearr['Horse']['breed_id']);
			e($breedname.' - ');
			$gender=$this->requestAction('/horse/gendername/'.$horsearr['Horse']['gender']);
			e($gender['Gender']['gender']);
			?> - <?php e($horsearr['Horse']['year']);?> 
		</title>
	<?php		
	}
	if(stristr($_SERVER['REQUEST_URI'],'/stable/viewprofile')) {
	?>	
		<title>Indian Horse Database--<?php e($stablearr['Stable']['stable_name']);?>
			<?php										
				if($stablearr['Stable']['town_id']) {
					$townname=$this->requestAction('/town/townname/'.$stablearr['Stable']['town_id']);
					e($townname['Town']['town']);											
				}
				if($stablearr['Stable']['country_id']) {
					$countryname=$this->requestAction('/country/countryname/'.$stablearr['Stable']['country_id']);
					e(",".$countryname['Country']['country']);											
				}
			?>	
		</title>	
	<?php
	}
	else {
	?>
		<title>Indian Horse Database</title>
	<?php
	}
	?>
	<!-- meta information -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<!-- load css files -->
	<?php 
	e($html->css('style'));
	//e($html->css('stylenew'));	
	?>
	
	<?php e($javascript->link('jquery-1'));?> 
	<?php e($javascript->link('jquery'));?>
	<link rel="shortcut icon" type="image/ico" href="http://indianhorsedatabase.com/app/webroot/img/favicon.ico" />