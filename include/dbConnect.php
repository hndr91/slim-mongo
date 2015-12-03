<?php
class dbConnect {
  private $con;
  private $db;

  function __construct() {}

  function connect() {
    include_once dirname(__FILE__) . '/config.php';

    try {
      //connect to Mongo with default setting
      $this->con = new MongoClient();
      //connect to database
      $this->db = $this->con->selectDB(DB_NAME);
    }
    catch (MongoConnectionException $e) {
      echo "Cannot Connect to MongoDB";
    }

    return $this->db;

  }
}
?>
