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
  echo $form->{'Name'}." | ";
  $form_count = $form_count + 1;

  // Look up how many entries there are so we can determine how much pagination is needed
  $entries_count = $wrapper->getEntryCount($form->{'Hash'});
  $pages = ceil($entries_count/100);
  echo "Entries: ".$entries_count." (".$pages.") | Getting Page: ";

  // Get entries and write them to a file
  $entries_data = "";
  $start_count = 0;
  $loop_count = 0;

  while($loop_count < $pages){
    echo " ".($loop_count+1)." ";
    $entries = $wrapper->getEntries($form->{'Hash'},"forms","?pageStart=".$start_count."&pageSize=100");
    $entries_data = $entries_data.json_encode($entries);
    $start_count = $start_count + 100;
    $loop_count++;
    // Sleep for a minute to prevent hitting API rate limit
    sleep(5);
  }
  echo "\n";
  file_put_contents("export/".preg_replace('/[^\w\d]+/', '-', $form->{'Name'}).".txt", $entries_data);
}

echo "\n\n".$form_count." total forms\n\n";
?>
