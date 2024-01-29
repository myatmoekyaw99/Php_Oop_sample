<?php 
namespace app;

use PDO;
use PDOException;

class Database{

    protected $pdo;
    public function __construct()
    {
        define('MYSQL_HOST','localhost');
        define('MYSQL_DATABASE','assignment_7');
        define('MYSQL_USER', 'root');
        define('MYSQL_PASSWORD','');

        $dsn = 'mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DATABASE;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try{
            $this->pdo = new PDO($dsn,MYSQL_USER,MYSQL_PASSWORD,$options);
        }catch(PDOException $pe){
            echo $pe->getMessage();
        }
    }

    public function getPDO(){
        return $this->pdo;
    }

/*************insert new user to database ******/
    public function insert($tname,$query,$values){
        $stmt = $this->pdo->prepare("INSERT INTO $tname(name,email,phone,password) VALUES($query)");
        $result = $stmt->execute($values);
        return $result;
    }

/*****%%% Deleting the user info **************/
    public function delete($id,$tname){

        // dd($_SESSION['user_id']);
        if($id == $_SESSION['user_id']){
            $statement = $this->pdo->prepare("DELETE FROM $tname WHERE id=$id");
            $statement->execute();

            UserSession::destroySession();
            header('location: index.php');
        }else{
            $statement = $this->pdo->prepare("DELETE FROM $tname WHERE id=$id");
            $statement->execute();

            header('location: dashboard.php');
        }
    }

/*******retrieving user info ********************/
    public function select($field,$value,$tname){
        $statement = $this->pdo->prepare("SELECT * FROM $tname WHERE $field=:$field");
        $statement->bindValue(":$field",$value);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

/************ update user function *************/
    public function update($tname,$query,$id,$value){

        $stmt = $this->pdo->prepare("UPDATE $tname SET $query WHERE id=$id");
        return $stmt->execute($value);
    }
}

?>