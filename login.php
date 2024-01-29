<?php

use app\User;
use app\ValidateUser;

require_once 'config/config.php';
require_once 'vendor/autoload.php';

isLogin();

if($_POST){

  $validation = new ValidateUser($_POST);
  $validation->setFields(['email','password']);
  $errors = $validation->validateUserInfo();

  $user = new User($_POST);
  $user->checkLogin();

}


require_once 'view/header.php';
?>

<form class="max-w-sm mt-10 mx-auto p-4 shadow-md shadow-black bg-blue-200 rounded-lg" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <div class="mb-2">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
    <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com">
  </div>
  <div class="text-red-600 mb-3"><?= $errors['email'] ?? ''; ?></div>

  <div class="mb-2">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
    <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
  </div>
  <div class="text-red-600 mb-3"><?= $errors['password'] ?? ''; ?></div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
</form>


</body>
</html>
