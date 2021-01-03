<?php

class DBController{
    protected $dbhost = "localhost";
    protected $dbusername = "root";
    protected $dbpassword = "";
    protected $dbname = "news";

    public $con = null;

    public function __construct()
    {
        $this->con = mysqli_connect($this->dbhost, $this->dbusername, $this->dbpassword, $this->dbname);
        if($this->con->connect_error){
            echo "error" . $this->connect_error;
        }
    }
    public function __destruct()
    {
        if($this->con != null)
        $this->closeConnection();
    }
    public function closeConnection(){
        if($this->con != null){
            $this->con->close();
        }
    }
    
}