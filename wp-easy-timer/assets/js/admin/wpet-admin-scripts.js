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
            let json_send = JSON.stringify(Object.assign({}, jQuery(this).sortable("toArray", {attribute: 'value'})));

            jQuery("#wpet_sortable_list_order").val(json_send)

            // let post_id = window.location.search.replace('?', '').split('&');
            // post_id = post_id[0].replace('post=', '');
            
            // let data = {
            //     action: "get_new_sortable_list_order", // Tell WordPress how to handle this ajax request
			//     order: json_send, // Passes ID's of list items in	1,3,2 format
            //     post_id: jQuery("#wpet_post_id").val()
            // };

            // jQuery.post( ajaxurl, data, function ( response ) {
            //     alert( 'Response: ' + response );
            // });
        }
    });
});