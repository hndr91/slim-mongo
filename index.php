<?php
require_once '/include/dbHandler.php';
require_once '/lib/Slim/Slim/Slim.php';

Slim\Slim::registerAutoloader();

$app = new Slim\Slim();

//Get All friends
$app->get('/friends', function() {
  $db = new dbHandler();
  $cur = $db->getAllFriends();
  //Variable to store result
  $result = array();

  //Do itteration for all document in a collection
  foreach ($cur as $doc) {
    $tmp = array();
    //Set key and get value from document and store to temporary array
    $tmp["name"] = $doc["name"];
    $tmp["age"] = $doc["age"];
    //push temporary array to $result
    array_push($result,$tmp);
  }
  //show result
  response(200, $result);
});

//rest response helper
function response($status, $response) {
  $app = \Slim\Slim::getInstance();
  //Set http response code
  $app->status($status);
  //Set content type
  $app->contentType('application/json');
  //Encode result as json
  echo json_encode($response, JSON_PRETTY_PRINT);

}

//run application
$app->run();
?>
