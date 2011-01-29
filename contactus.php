<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>contact form inline validation using jquery, ajax, php</title>
<link rel="icon" href="favicon.ico" type="image/x-icon" media="all">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" media="all">
<script type="text/javascript" src="prototype.js"></script>
<script type="text/javascript" src="jquery-1.3.2.js"></script>
<script type="text/javascript" src="validation.js"></script>
<script type="text/javascript">$.noConflict();</script>
<style>

.contactinput, .commenttext
{
-moz-border-radius: 5px 5px 5px 5px;
    background-color: #EEEEEE;
    border: medium none;
    color: SeaGreen;
    padding: 5px;
    width: 267px;
}

span.error, span.correct {
	display:block;
	height:23px;
	width:25px;
	margin-left:2px;
	margin-top:5px;
	float:left;
	text-indent:-5000px;
}
span.error {
	background:url(../images/failure.png) no-repeat;
}
span.correct {
	background:url(../images/success.png) no-repeat;
}
</style>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#contactsubmit').click(function(){
            var name = jQuery("#Name").val();
            var email = jQuery("#Email").val();
            var comments = jQuery("#comments").val();
			
			var error = chkData(name, email, comments)
			
            
            if ( error == true) {
                var datastring = 'name=' + name + '&email=' + email + '&comments=' + comments
                jQuery.ajax({
                    type: 'POST',
                    url: '/send_mail',
                    data: datastring,
                 });
            }
			else
			return false;
        });
		
		jQuery("#Name").blur(function(){
    if (jQuery(this).val() != "" && jQuery(this).val() != "Name") {
        if (jQuery(this).val().match(/^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$/)) {
            jQuery('#nameerrcrt').next('.correct').remove();
            jQuery('#nameerrcrt').next('.error').remove();
            jQuery('#nameerrcrt').after('<span class=correct></span>');
        }
        else {
            jQuery('#nameerrcrt').next('.error').remove();
            jQuery('#nameerrcrt').next('.correct').remove();
            jQuery('#nameerrcrt').after('<span class=error></span>');
        }
    }
    else {
        jQuery('#nameerrcrt').next('.error').remove();
        jQuery('#nameerrcrt').next('.correct').remove();
        jQuery('#nameerrcrt').after('<span class=error></span>');
    }
});

jQuery("#Email").blur(function(){
    if (jQuery(this).val() != "" && jQuery(this).val() != "Email") {
    
        if (jQuery(this).val().match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*([,;]\s*\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)*$/)) {
            jQuery('#emailerrcrt').next('.correct').remove();
            jQuery('#emailerrcrt').next('.error').remove();
            jQuery('#emailerrcrt').after('<span class=correct></span>');
        }
        else {
            jQuery('#emailerrcrt').next('.error').remove();
            jQuery('#emailerrcrt').next('.correct').remove();
            jQuery('#emailerrcrt').after('<span class=error></span>');
        }
    }
    else {
        jQuery('#emailerrcrt').next('.error').remove();
        jQuery('#emailerrcrt').next('.correct').remove();
        jQuery('#emailerrcrt').after('<span class=error></span>');
    }
});

jQuery("#comments").blur(function(){
    if (jQuery(this).val() != "" && jQuery(this).val() != "Comments") {
        jQuery('#commentserrcrt').next('.correct').remove();
        jQuery('#commentserrcrt').next('.error').remove();
        jQuery('#commentserrcrt').after('<span class=correct></span>');
    }
    else {
        jQuery('#commentserrcrt').next('.error').remove();
        jQuery('#commentserrcrt').next('.correct').remove();
        jQuery('#commentserrcrt').after('<span class=error></span>');
    }
});

    });
	
</script>

</head>

<body>		
<?php
if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "thiyagarajannv@gmail.com";
    $email_subject = "contact subject goes here...";
     
    $first_name = $_POST['first_name']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
 
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 <div class="flashnotice">Thanks for your message, we will get back to soon.</div>
 <?
}
?>
<div id="contactus">
<h2>Contact Us</h2>
<form name="contactform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<table width="450px">
<tr>
 <td width="277">
 <input type="text" name="first_name" id="Name" class="contactinput" value="Name" onfocus="if (this.value == 'Name') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Name'; }"/>
 </td>
 <td id="nameerrcrt"></td>
</tr>
<tr>
 <td width="277">
 <input type="text" name="email"class="contactinput" id = "Email" value="Email" onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email'; }"/>
 </td>
 <td id="emailerrcrt"></td>
<tr>
 <td width="277">
 <textarea name="comments" cols="25" rows="6" class="commenttext" id = "comments" onfocus="if (this.value == 'Comments') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Comments'; }">Comments</textarea>
 </td> 
 <td id="commentserrcrt"></td>
</tr>
  <td width="277"><input type="submit" value="Submit" id="contactsubmit" class="contactsubmit">
                    All fields are required
 </td><td></td>
</tr>
</table>
</form>
</div>
</body>
</html>