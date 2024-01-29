<?php 
namespace app;

use PDO;

class User{

    private $data;
    // private $pdo;

    public function __construct($post_data)
    {
    
        $this->data = $post_data;
    }

############# User Registration function ###########
    public function register(){

        if($this->data['password'] === $this->data['repeat-password']){

            $db = new Database();

            $bind_value = [
                ':name' => $this->data['username'],
                ':email' => $this->data['email'],
                ':phone' => $this->data['phone'],
                ':password' => password_hash($this->data['password'],PASSWORD_BCRYPT,['cost' => 10]),
            ];

            return $db->insert("users",":name,:email,:phone,:password",$bind_value);

        }else{
            echo "<script>
                alert('Password does not match!');
            </script>";
        }

    }

###########User Login Check function###########

    public function checkLogin(){
        $email = $this->data['email'];
        $db = new Database();
        $result = $db->select('email',$email,'users');

        if($result){
            // dd($result);
            if(password_verify($this->data['password'],$result['password'])){

                $session = new UserSession($result);
                $session->create();
                // dd($_SESSION['email']);
                header('location:dashboard.php');

            }else {
                echo "<script>
                alert('Password does not match!');
                </script>";
            }

        }else{
            echo "<script>
                alert('Email does not exist!');
            </script>";
        }
    }

}


?>