<?php
//soumavo
class RszHelper extends  AppHelper {
    function imgResize($url,$x,$y) {
        if (empty($url)) {
            //if no image url received - return zero dimensions.
            return array(0,0);
        } else {
            try {
				$size = @getimagesize( $url);
				if(@array_slice($size)) {
					$imagearr=array_walk($size);
				}
                $rx = $size[0] / $x;
                $ry = $size[1] / $y;
                if ($rx<=1 and $ry<=1) {
                    //if both ratios are smaller than 1 - the image fits alright inside the designated space.
                    return array($size[0],$size[1]);
                } else {
                    //resize as per the larger ratio
                    $r = max($rx,$ry);
                    return array(ceil($size[0]/$r),ceil($size[1]/$r));
                }
            }
			catch(Exception $e) {
                return array($x,$y);
            }
        } 
    }
}
?>
