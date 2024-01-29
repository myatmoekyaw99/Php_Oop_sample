<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

function dd($val){
    echo "<pre>";
    var_dump($val);
    die();
}

function loginCheck(){

    if(empty($_SESSION['user_id'])){

        header('location: login.php');
    }
}

function isLogin(){
    if(! empty($_SESSION['user_id'])){

        header('location: index.php');
    }
}

?>