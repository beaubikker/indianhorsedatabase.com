jQuery(document).ready(function(){jQuery('#s2bcc_2').hide();jQuery('#s2page_2').hide();jQuery('#s2entries_2').hide()});function s2_show(id){jQuery('#s2'+id+'_2').show();jQuery('#s2'+id+'_1').hide();return false};function s2_hide(id){jQuery('#s2'+id+'_1').show();jQuery('#s2'+id+'_2').hide();return false};function s2_update(id){var input=jQuery('input[name="'+id+'"]').val();jQuery('input[name="'+id+'"]').val(input);jQuery('#s2'+id).html(input);s2_hide(id)};function s2_revert(id){var option=jQuery('#js'+id).val();jQuery('input[name="'+id+'"]').val(option);jQuery('#s2'+id).html(option);s2_hide(id)};