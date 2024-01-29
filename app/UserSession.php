<?php 
namespace app;

class UserSession{

    private $data;
    public function __construct($user_data)
    {
        $this->data = $user_data;
    }

/******* Creating the session data for login user ******/
    public function create(){
        // dd($this->data['id']);
        $_SESSION['user_id'] = $this->data['id'];
        $_SESSION['username'] = $this->data['name'];
        $_SESSION['email'] = $this->data['email'];
    }

/********* Deleting the session data **************/
    public static function destroySession(){
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }
}



?>