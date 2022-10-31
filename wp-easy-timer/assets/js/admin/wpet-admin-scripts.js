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
        }
    });

    jQuery("#wpet_metabox_tabs").tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    jQuery("#wpet_metabox_tabs li").removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});