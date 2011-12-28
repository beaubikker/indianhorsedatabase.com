<?php e($html->css('style'));
e($javascript->link('jquery-1'));?> 
<?php e($javascript->link('jquery'));
e($html->css('skin2'));?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycarouse2').jcarousel();
});
</script>
<?php
	if(count($horsearr)>0) {
	?>	
	<div class=" jcarousel-skin-tango" style="width:900px;">
	<div class="jcarousel-container jcarousel-container-horizontal"  style="display: block; background:none transparent;  width:850px;" >
	<div class="jcarousel-clip jcarousel-clip-horizontal"  style="width:800px; margin:0 auto; overflow: hidden;">
	
	<ul id="mycarouse2"	style="overflow: hidden; width:850px; margin: 0px auto; padding: 0px;">
	<?php
	if(is_array($horsearr)){ 
		foreach($horsearr as $key=>$val) :
		//e($val);
		$imagedirectory="horseimage";
		$image=$val['Horse']['image'];
		if($image!="") {
		if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
		$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],177,135);
	?>	
		
	<li jcarouselindex="1" style="float: left; height:120px;">
		<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image); ?>" height="80" width="80" alt="" />
		<span style="font:normal 13px Arial, Helvetica, sans-serif; color:#A1612F; text-align:left; display:block; padding:3px 3px 2px 0;"><?php e($val['Horse']['name']);?></span>
	</li>
	<?php
		}
		}
		else { ?>
			<li jcarouselindex="1" style="float: left; height:120px;">
			<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="80" height="80">
			<span style="font:normal 13px Arial, Helvetica, sans-serif; color:#A1612F; text-align:left; display:block; padding:3px 3px 2px 0;"><?php e($val['Horse']['name']);?></span>
			</li>
		<?php	
		}	
		endforeach;
	}
	?>   
	</ul>
	</div>	
	<div disabled="false" style="display: block; float:left;" class="jcarousel-prev jcarousel-prev-horizontal"></div>
	<div disabled="false" style="display: block; float:right;" class="jcarousel-next jcarousel-next-horizontal"></div>
	</div>
	</div>					
	<?php
	}
	?>
	