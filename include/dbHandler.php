<?php
class dbHandler {
  private $con;
  private $col;

  function __construct() {
    require_once dirname(__FILE__) . '/dbConnect.php';
    $db = new dbConnect();
    //Connect to database
    $this->con = $db->connect();
    //Select "friends" collection, already defined in config.php
    $this->col = new MongoCollection($this->con, DB_COLLECTION);
  }

  //Get All Friends
  public function getAllFriends() {
    //Find All friend in friends collection
    $cur = $this->col->find();
    return $cur;
  }

  /**
  * Insert a New friend
  * params $name, $age
  */
  public function insertFriend($name, $age) {
    //Create array document
    $document = array(
      "name" => $name,
      "age" => $age
    );

    //Insert to collection
    try {
      $cur = $this->col->insert($document);
      return INSERT_COL_SUCCESS;
    }
    catch (MongoCursorException $e) {
      return INSERT_COL_FAILED;
    }
  }

  //Still Not Work
  /*
  public function removeFriendByName($name) {
    //Remove friend from collection
    try {
      $cur = $this->col->remove(array("name"=>$name), true);
      return REMOVE_FRIEND_SUCCESS;
    }
    catch (MongoCursorException $e) {
      return REMOVE_FRIEND_FAILED;
    }
  }
  */
}
?>
