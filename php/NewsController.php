<?php 
class NewsController{

    public $db = null;
    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;   
    }

    public function InsertNews($params = null, $table = "post"){
        if($this->db->con != null){
            if($params != null){
                //"INSERT INTO `cart` (`item_id`, `item_brand`, `item_name`) VALUES()"
                $colums = implode(',',array_keys($params));
                $values = implode(',',array_values($params)); 
                $query = sprintf("INSERT INTO `%s` (%s) VALUES(%s)",$table, $colums, $values);

               $result = $this->db->con->query($query);
               return $result;
            }
        }
    }
    public function addto($title , $message, $userid,$user){
        if(isset($title) && isset($message) && isset($userid) && isset($user)){
            $params = array(
                "p_title" => "'$title'",
                "p_message" => "'$message'",
                "p_uid" => "'$userid'",
                "p_poster" => "'$user'",
                "p_time" => 'curtime()'

            );
        }
        $result = $this->InsertNews($params);
        if($result){

        }
    }
    public function getData($table = 'post'){
        $result = $this->db->con->query("SELECT * FROM {$table} order by p_id desc");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    public function deleteNews($table = 'post', $userid){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE p_id = '$userid';");
            return $result;
    }
    public function getDataSingle($id, $table = 'post'){
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE p_id = '$id'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
    public function reportedNews($id,$table = "post"){

        if($this->db->con != null){
            if(isset($id)){
                $query = "UPDATE {$table} set p_reported = '1' WHERE p_id = '$id'";
                $result = $this->db->con->query($query);
                return true;
            }
        }
    }
}


?>