function chkData(name, email, comments){
    if (name == '' || name == 'Name') {
        jQuery('#nameerrcrt').next('.error').remove();
        jQuery('#nameerrcrt').next('.correct').remove();
        jQuery('#nameerrcrt').after('<span class=error></span>');
        return chkEmail(email, comments, name);
    }
    else {
    
        if (name.match(/^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$/)) {
            jQuery('#nameerrcrt').next('.correct').remove();
            jQuery('#nameerrcrt').next('.error').remove();
            jQuery('#nameerrcrt').after('<span class=correct></span>');
            return chkEmail(email, comments, name);
        }
        else {
            jQuery('#nameerrcrt').next('.error').remove();
            jQuery('#nameerrcrt').next('.correct').remove();
            jQuery('#nameerrcrt').after('<span class=error></span>');
        }
    }
}

function chkEmail(email, comments, name){
	
    if (email == '' || email == 'Email') {
        jQuery('#emailerrcrt').next('.error').remove();
        jQuery('#emailerrcrt').next('.correct').remove();
        jQuery('#emailerrcrt').after('<span class=error></span>');
        return chkComments(comments, email, name)
    }
    else {
        if (email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*([,;]\s*\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)*$/)) {
            jQuery('#emailerrcrt').next('.correct').remove();
            jQuery('#emailerrcrt').next('.error').remove();
            jQuery('#emailerrcrt').after('<span class=correct></span>');
            return chkComments(comments, email, name);
        }
        else {
            jQuery('#emailerrcrt').next('.error').remove();
            jQuery('#emailerrcrt').next('.correct').remove();
            jQuery('#emailerrcrt').after('<span class=error></span>');
            return false;
        }
    }
}

function chkComments(comments, email, name){
    if (comments == '' || comments == 'Comments') {
        jQuery('#commentserrcrt').next('.error').remove();
        jQuery('#commentserrcrt').next('.correct').remove();
        jQuery('#commentserrcrt').after('<span class=error></span>');
        return false;
    }
    else {
        jQuery('#commentserrcrt').next('.correct').remove();
        jQuery('#commentserrcrt').next('.error').remove();
        jQuery('#commentserrcrt').after('<span class=correct></span>');
        if (email == '' || email == 'Email' || name == '' || name == 'Name') {
            return false;
        }		
        return true;
    }
}
