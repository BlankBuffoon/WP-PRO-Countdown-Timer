jQuery(function() {
    jQuery( ".datepicker" ).datetimepicker({
        dateFormat	: 'dd.mm.yy',
        timeFormat	: 'HH:mm',
        minDate		: 0,
        changeMonth	: true,
        changeYear	: true,
    });
});