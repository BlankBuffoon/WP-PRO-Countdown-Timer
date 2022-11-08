jQuery(function() {
    jQuery( ".datepicker" ).datetimepicker({
        dateFormat	: 'dd.mm.yy',
        timeFormat	: 'HH:mm',
        minDate		: 0,
        changeMonth	: true,
        changeYear	: true,
        onSelect: function(date) {
            jQuery( "#wppct_gl_settings_datetime" ).val(date);
        }
    });

    jQuery("#wppct_metabox_tabs").tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    jQuery("#wppct_metabox_tabs li").removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});