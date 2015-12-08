<?php
require_once '/include/dbHandler.php';
require_once '/lib/Slim/Slim/Slim.php';

Slim\Slim::registerAutoloader();

$app = new Slim\Slim();

//Get All friends end point
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

//Post Friends end point
$app->post('/friends', function() use($app){
  $res = array();
  $name = $app->request()->post('name');
  $age = $app->request()->post('age');

  $db = new dbHandler();
  $cur = $db->insertFriend($name,$age);

  if($cur == INSERT_COL_SUCCESS) {
    $res["error"] = FALSE;
    $res["message"] = "Success to insert a new friend";
    response(201, $res);
  } else {
    $res["error"] = TRUE;
    $res["message"] = "Failed to add a new friend";
    response(200, $res);
  }
});

//Delete friend end point
/*
$app->delete('/friends/:name', function($name){
  $res = array();
  $db = new dbHandler();
  echo $name;


  $cur = $db->removeFriendByName($name);
  echo $cur;
  if($cur == REMOVE_FRIEND_SUCCESS) {
    $res["error"] = FALSE;
    $res["message"] = "Success to remove a friend";
    $res["id"] = $name;
    response(201, $res);
  } else {
    $res["error"] = TRUE;
    $res["message"] = "Failed to remove a friend";
    $res["id"] = $name;
    response(200, $res);
  }
});
*/

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
