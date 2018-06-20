(function($){
	$(document).ready(function(){

/*		// der index gibt position im array an, damit die Interaktion im richtigen Feld statt findet. 
		var index = 0;
		
		//eventlistener for reloading the script when additional rows are created.
		$( '.cmb-add-group-row' ).on( 'click', function() {
  			alert ("new row added");
			index++;
		});
		
		$( '.cmb-add-group-row' ).on( 'click', function() {
  			alert ("row removed");
			index--;
		});		
*/		
		$('#sf_repeat_group_0_sf_image').hide();
		$('#sf_repeat_group_0_sf_embed').hide();

		//lets add the interactivity by adding an event listener
		$('.cmb2-option').live('change',function(){
			alert ("changed made. in: "+ $(this).attr('id'));
			if ($(this).val() == 'standard'){
				// iamge
				$('#sf_repeat_group_0_sf_image').show();
				$('#sf_repeat_group_0_sf_embed').hide();
			}else if ($(this).val() == 'custom'){
				//movie
				$('#sf_repeat_group_0_sf_image').hide();
				$('#sf_repeat_group_0_sf_embed').show();
			} else {
				//still confused, hasn’t selected any
				$('#sf_repeat_group_0_sf_image').hide();
				$('#sf_repeat_group_0_sf_embed').hide();
			}
		});
		
		//make sure that these metaboxes appear properly in post edit screen		
		if($('.cmb2-option').val() == 'standard'){
			// iamge
			$('#sf_repeat_group_0_sf_image').show();
		}
		
		else if ($('.cmb2-option').val() == 'custom') {
			//movie
			$('#sf_repeat_group_0_sf_embed').show();
		}
	});
})(jQuery);