<?php
class dbHandler {
  private $con;

  function __construct() {
    require_once dirname(__FILE__) . '/dbConnect.php';
    $db = new dbConnect();
    $this->con = $db->connect();
  }

  //Get All Friends
  public function getAllFriends() {
    //Use friends collection
    $col = new MongoCollection($this->con, 'friends');
    //Find All friend in friends collection
    $cur = $col->find();
    return $cur;
  }
}
?>
