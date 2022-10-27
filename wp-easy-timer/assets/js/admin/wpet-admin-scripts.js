jQuery(function() {
    jQuery( ".datepicker" ).datetimepicker({
        dateFormat	: 'dd.mm.yy',
        timeFormat	: 'HH:mm',
        minDate		: 0,
        changeMonth	: true,
        changeYear	: true,
    });

    jQuery("#sortable").sortable({
        update: function ( event, ui ) {
            $json_send = JSON.stringify(Object.assign({}, jQuery(this).sortable("toArray", {attribute: 'value'})));
            
            //console.log($json_send);
            
            opts = {
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action: "get_new_sortable_list_order", // Tell WordPress how to handle this ajax request
					order: $json_send // Passes ID's of list items in	1,3,2 format
				},
				success: function(response) {
					return; 
				},
				error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
					alert('There was an error saving the updates');
					return; 
				}
			};
			jQuery.ajax(opts);

            // Not work
            // let convertedToJsonArray = JSON.stringify(sortableArray);
            // console.log(convertedToJsonArray);
            // jQuery.post('wpet-posttypes.php', {convertedToJsonArray: convertedToJsonArray})
        }
    });
});