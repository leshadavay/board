<?php
/**
 * Created by PhpStorm.
 * User: Ramic
 * Date: 25.07.2019
 * Time: 19:24
 */

class DatabaseManager
{


    //use singleton
    private static $dbinstance=null;

    private $servername="localhost";
    private $username="root";
    private $password="";
    private $databasename="matchdb";
    private $connection;

    public static function getInstance(){
        if(!self::$dbinstance){
            self::$dbinstance=new DatabaseManager();

        }
        return self::$dbinstance;
    }


    function __construct(){

        $this->connection = mysqli_connect($this->servername,$this->username,$this->password,$this->databasename);
        if($this->connection->connect_error){
            die("Database connection is failed: ".$this->connection->connect_error);
        }
        /*//custom user
        $userid="ID1";$username="name1";$userpassword="psw1";$useremail="email1@example.com";$currenttime=date("Y-m-d H:i:s");
        echo "from DB: constructor, ".$currenttime."<br>";
        $this->getQueryResult("INSERT INTO accounts(USERID,USERNAME,USERPASSWORD,USEREMAIL,LASTACCESS) VALUES ('$userid','$username','$userpassword','$useremail','$currenttime')");*/

    }
    function makeConnection(){
        $this->connection = mysqli_connect($this->servername,$this->username,$this->password,$this->databasename);
        if($this->connection->connect_error){
            die("Database connection is failed: ".$this->connection->connect_error);
        }
        return $this->connection;
    }
    function getQueryResult($query){
        $result=mysqli_query($this->makeConnection(),$query);

        return $result;
    }



}