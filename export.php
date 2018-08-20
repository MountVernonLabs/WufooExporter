<?php

// Load wrapper and config
require_once('config.inc');
require_once('lib/wufoo-php-api-wrapper/WufooApiWrapper.php');

// If export directory isn't available create it
mkdir('./export', 0755, true);

//Connect to Wufoo
$wrapper = new WufooApiWrapper($apiKey, $subdomain);

// Grab all forms, start a count
$forms = $wrapper->getForms();
$form_count = 1;

// Loop through forms
foreach ($forms as $form){
  echo $form->{'Hash'}." | ";
  echo $form->{'Name'}."\n";
  $form_count = $form_count + 1;

  // Get entries and write them to a file
  $entries = $wrapper->getEntries($form->{'Hash'});
  file_put_contents("export/".preg_replace('/[^\w\d]+/', '-', $form->{'Name'}).".txt", json_encode($entries));
  // Sleep for a minute to prenvent hitting API rate limit
  sleep(60);
}

echo "\n\n".$form_count." total forms\n\n";
?>
