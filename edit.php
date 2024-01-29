<?php

use app\Database;
use app\ValidateUser;

require_once 'config/config.php';
require_once 'vendor/autoload.php';

loginCheck();

$id = $_GET['id'] ?? '';
$db = new Database();
$reuslt = $db->select('id',$id,'users');
// dd($reuslt);
if($_POST){

  $validation = new ValidateUser($_POST);
  $validation->setFields(['username','email','phone']);
  $errors = $validation->validateUserInfo();
  // dd($_POST);
  
  if($_POST['password'] === $reuslt['password']){
    $bind_value = array(
      ':name' => $_POST['username'],
      ':email' => $_POST['email'],
      ':phone' => $_POST['phone']
    );
    $query = 'name=:name,email=:email,phone=:phone';

  }else{
    $bind_value = array(
      ':name' => $_POST['username'],
      ':email' => $_POST['email'],
      ':phone' => $_POST['phone'],
      ':password' => password_hash($_POST['password'],PASSWORD_BCRYPT,['cost'=>10]) 
    );
    $query = 'name=:name,email=:email,phone=:phone,password=:password';
    
  }

  if(!$errors){

    $reuslt = $db->update('users',$query,$_POST['id'],$bind_value);

    if($reuslt){
      echo "<script>
          alert('User update is successful!'); window.location = 'dashboard.php';
        </script>";
    }

  }
  // else{
  //   header('Location: ' . $_SERVER['HTTP_REFERER']);
  // }

}

require_once 'view/header.php';
?>


<form class="max-w-sm mt-4 mx-auto p-4 shadow-md shadow-black bg-gray-200" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <input type="hidden" name="id" value="<?= $reuslt['id']?>">
  <div class="mb-1">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
    <input type="text" id="username" name="username" value="<?= $reuslt['name'] ?? '' ;?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Enter username" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['username'] ?? ''; ?></div>
  
  <div class="mb-1">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
    <input type="email" id="email" name="email" value="<?= $reuslt['email'] ?? '' ;?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['email'] ?? ''; ?></div>

  <div class="mb-1">
    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your phone</label>
    <input type="phone" id="phone" name="phone" value="<?= $reuslt['phone'] ?? '' ;?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['phone'] ?? ''; ?></div>

  <div class="mb-1">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
    <input type="password" id="password" name="password" value="<?= $reuslt['password'] ?? '' ;?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['password'] ?? ''; ?></div>

  <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Information</button>
</form>


</body>
</html>