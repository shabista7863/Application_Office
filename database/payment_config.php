<?php

define('PAYPAL_ID', 'developer.maitrix@gmail.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'https://altsols.com/application_office/success.php'); 
define('PAYPAL_CANCEL_URL', 'https://altsols.com/application_office/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'https://altsols.com/application_office/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 

define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>