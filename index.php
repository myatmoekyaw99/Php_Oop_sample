<?php

use app\User;
use app\ValidateUser;

require_once 'vendor/autoload.php';
require_once 'config/config.php';

if($_POST){

  $validation = new ValidateUser($_POST);
  $errors = $validation->validateUserInfo();

  // var_dump($errors);
  // die();

  if(!$errors){

    $user = new User($_POST);
    $result = $user->register();

    if($result){
      echo "<script>
        alert('User Registration is successful!');
      </script>";
    }

  }

}

require_once 'view/header.php';
?>


<form class="max-w-sm mt-4 mx-auto p-4 shadow-md shadow-black bg-gray-200" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="mb-1">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
    <input type="text" id="username" name="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Enter username" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['username'] ?? ''; ?></div>
  
  <div class="mb-1">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
    <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['email'] ?? ''; ?></div>

  <div class="mb-1">
    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Phone</label>
    <input type="phone" id="phone" name="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="+959111222333" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['phone'] ?? ''; ?></div>

  <div class="mb-1">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
    <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['password'] ?? ''; ?></div>

  <div class="mb-1">
    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>
    <input type="password" id="repeat-password" name="repeat-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
  </div>
  <div class="text-red-600 mb-3"><?= $errors['repeat-password'] ?? ''; ?></div>

  <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new account</button>
</form>


</body>
</html>