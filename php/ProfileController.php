<?php
class ProfileController{
    public $db = null;

    public function __construct(DBController $db){

         if(!isset($db->con)) return null;
            $this->db = $db;
        
    }
    //UPDATE Users SET weight=160, desiredWeight= 145 WHERE id = 1;

    public function setupProfile($table = "users",$firstname,$lastname,$website,$phone,$profilepic, $id){

        if($this->db->con != null){
            if(isset($firstname) && isset($lastname) && isset($website) && isset($phone) && isset($profilepic) && isset($id)){
                $query = "UPDATE users set u_firstname = '$firstname', u_lastname = '$lastname', u_website = '$website', u_phone = '$phone', u_profilepic = '$profilepic' WHERE u_id = '$id'";
                $result = $this->db->con->query($query);
                return true;
            }
        }
    }
    public function changePassword($oldpassword,$newpassword, $id,$table = "users"){

        if($this->db->con != null){
            if(isset($oldpassword) && isset($newpassword) && isset($id)){
                foreach($this->getProfile($id) as $item);
                if($item['u_password'] == $oldpassword){
                $query = "UPDATE {$table} set u_password = '$newpassword' WHERE u_id = '$id'";
                $result = $this->db->con->query($query);
                return true;
                }
            }
        }
    }
    public function getProfile($id,$table = 'users'){
        if(isset($id)){
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE u_id = '$id'");
        }
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    
    }
}

?>