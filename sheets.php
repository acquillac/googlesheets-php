<?php 
  // following --> https://www.youtube.com/watch?v=iTZyuszEkxI

  require __DIR__ . '/vendor/autoload.php';

  $client = new \Google_Client();
  $client->setApplicationName('Google Shees and PHP');
  $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
  $client->setAccessType('offline');
  $client->setAuthConfig(__DIR__ . './credentials.json');
  $service = new Google_Service_Sheets($client);
  $spreadsheetID = "1unYVVvZcSbDFbZjTQYyCrMsC7mlnV0kPBODVcfVMjl4";

  $sheetData = [];

  $range = "congress!D2:F8";
  $response = $service->spreadsheets_values->get($spreadsheetID, $range);
  $values = $response->getValues();
  if(empty($values)){
    print "No data found \n";
  } else {
    
    $mask = "%10s %-10s %s \n";

    foreach ($values as $row) {
      echo sprintf($mask, $row[2], $row[1], $row[0]);
      echo "<br>";
      array_push($sheetData, [$row[2], $row[1], $row[0]]);
    }
    
    $jsonData = json_encode(array('data'=>$sheetData));

    file_put_contents("data.json", $jsonData);
  }
    
?>