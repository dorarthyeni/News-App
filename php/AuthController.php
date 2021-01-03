<?php 
session_start();
class AuthController{
    
    
    public $db = null;
    
    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    
    }
    public function InsertUser($params = null, $table = "users"){
        if($this->db->con != null){
            if($params != null){
                //"INSERT INTO `cart` (`item_id`, `item_brand`, `item_name`) VALUES()"
                $colums = implode(',',array_keys($params));
                $values = implode(',',array_values($params)); 
                $query = sprintf("INSERT INTO `%s` (%s) VALUES(%s)",$table, $colums, $values);
                $result = $this->db->con->query($query);
                echo $query;
               return $result;
            }
        }
    }
    public function addto($email , $username, $password){
        if(isset($email) && isset($username) && isset($password)){
            $params = array(
                "u_email" => "'$email'",
                "u_username" => "'$username'",
                "u_password" => "'$password'",
                "u_time" => "now()"

            );
        }
        $result = $this->InsertUser($params);
        if($result){
        }
    }
    public function login($email,$password){
        if($this->db->con != null){
            $query = "SELECT * FROM users WHERE u_email = '$email'";
            $result = $this->db->con->query($query);
            $resultArray = array();
            if($result->num_rows == 1){
                while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    if($password == $item['u_password']){
                        $_SESSION['username'] = $item['u_username'];
                        $_SESSION['email'] = $item['u_email']; 
                        $_SESSION['id'] = $item['u_id']; 

                        return true;
                    }
                }
              
            }

           
        }
        return false;
               
    }
  
    public function validateUser($username){
         if($this->db->con != null){
             $query = "SELECT * FROM users WHERE u_username = '$username'";
             $result = $this->db->con->query($query);
             if($result->num_rows == 1){
               return true;
        }
          }
         else
         return false;
     }
     public function validateEmail($email){
        if($this->db->con != null){
            $query = "SELECT * FROM users WHERE u_username = '$email'";
            $result = $this->db->con->query($query);
            if($result->num_rows == 1){
              return true;
       }
         }
        else
        return false;
    }
    public function getData($table = 'users'){
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
}
?>