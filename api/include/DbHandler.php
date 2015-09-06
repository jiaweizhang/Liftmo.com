<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /* ------------- `users` table method ------------------ */

  

    /* ------------- `lifts` table method ------------------ */

    /**
     * Creating new lift
     * @param (name), nickname, description, videourl, parentname
     */
    public function createLift($name, $nickname, $description, $videourl, $parentname) {
        $stmt = $this->conn->prepare("INSERT INTO lifts(name, nickname, description, videourl, parentname) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $nickname, $description, $videourl, $parentname);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            return true;
        } else {
            // lift failed to create
            return NULL;
        }
    }

    /**
     * Fetching all lifts
     * @param none
     */
    public function getLifts() {
        $stmt = $this->conn->prepare("SELECT * from lifts");
        if ($stmt->execute()) {
            $res = array();
            $stmt->bind_result($id, $name, $nickname, $videourl, $parentname);
            // TODO
            $lifts = $stmt->get_result()->fetch_assoc();
            /*$stmt->fetch();
            $res["id"] = $id;
            $res["name"] = $name;
            $res["nickname"] = $nickname;
            $res["videourl"] = $videourl;
            $res["parentname"] = $parentname;*/
            $stmt->close();
            /*return $res;*/
            return $lifts;
        } else {
            return NULL;
        }
    }
}

?>
