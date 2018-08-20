<?php

require_once('config.inc');
require_once('lib/wufoo-php-api-wrapper/WufooApiWrapper.php');

$wrapper = new WufooApiWrapper($apiKey, $subdomain);
print_r($wrapper->getUsers());

?>
