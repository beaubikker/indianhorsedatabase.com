<script language="javascript">
	function subtopayment() {
		document.sendtopaypalForm.submit();
	}	
</script>
			<?php
		    $fetcharr=$this->requestaction('/setting/fetchsettings');
			if($fetcharr['Setting']['payment_mode']=='0'){			
				$action_url="https://www.sandbox.paypal.com/cgi-bin/webscr";
			}
			else{			 
				$action_url="https://www.paypal.com/cgi-bin/webscr";
			}
			$settingarr=$this->requestAction('/setting/allimage');
			if(count($settingarr)>0) {
				if($settingarr['Setting']['logo']!="") { 
					$logo=$settingarr['Setting']['logo'];
				}
				if($settingarr['Setting']['headerimage']!="") {
					$headerimage=$settingarr['Setting']['headerimage'];
				}
			}
		?>
<div class="header" style="background:url(http://indianhorsedatabase.com/img/settingimages/<?php e($headerimage);?>) no-repeat; height:183px;"><a href="<?php echo $html->url(array("controller" => "content","action" => "front"));?>"><img src="<?php e($this->webroot);?>img/settingimages/<?php e($logo);?>" alt=""  width="343" height="117" border="0"/></a></div>
			
		  <body onLoad="subtopayment()">
				<div align="center"><b>Please wait...............</b></div>
			   <form action="<?php echo $action_url;?>" method="post" name="sendtopaypalForm">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="<?=$fetcharr['Setting']['paypal_account_id'];?>"> 	
					<input type="hidden" name="item_name" value="Premium Member Subscription For <?php e($dur);?>">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="amount" id="amount" value="<?php e($price);?>">
					<input type="hidden" name="rm" value="2">
					<input type="hidden" name="lc" value="US"> 
					<input type="hidden" name="custom" value="<?php echo $userarr['User']['email_address'] ;?>+premuim">
					<input type="hidden" name="return" value="<?=site_url();?>user/thankuforpayment">
					<!--<input type="hidden" name="return" value="<?=site_url();?>/imports/success/">-->	
					<input type="hidden" name="cancel_return" value="<?=site_url();?>/user/cancel/">
					<input type="hidden" name="cbt" value="Confirm Payment and Return to <?=site_url();?>">		
					<input type="image" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" width="0" height="0">
				</form>
			