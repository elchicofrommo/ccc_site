jQuery(document).on( 'click', '.ccc-error-update .notice-dismiss', function() {

    jQuery.ajax({
        url: ajaxurl,
        method: "POST",
        data: {
            action: 'ccc_remove_upate_notice'
        }
    })

})