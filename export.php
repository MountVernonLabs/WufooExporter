<?php

require_once('config.inc');
require_once('lib/wufoo-php-api-wrapper/WufooApiWrapper.php');

$wrapper = new WufooApiWrapper($apiKey, $subdomain);

$forms = $wrapper->getForms();

$form_count = 1;

foreach ($forms as $form){
  echo $form->{'Hash'}." | ";
  echo $form->{'Name'}."\n";
  $form_count = $form_count + 1;

  $entries = $wrapper->getEntries($form->{'Hash'});
  file_put_contents("export/".preg_replace('/[^\w\d]+/', '-', $form->{'Name'}).".txt", json_encode($entries));
  sleep(60);
}

echo "\n\n".$form_count." total forms\n\n";
?>
