<?php

use app\Database;
use PDO;

require_once 'vendor/autoload.php';
require_once 'config/config.php';

loginCheck();

$db = new Database();
$stmt = $db->getPDO()->prepare("SELECT * FROM users");
$stmt->execute();
$allresults = $stmt->fetchAll(PDO::FETCH_ASSOC);

// dd($allresults);

require_once 'view/header.php';
?>

<div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-md text-blue-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($allresults as $result) : ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $result['name'] ?>
                </th>

                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $result['email'] ?>
                </th>
            
                <td class="px-6 py-4 text-center">
                    <a href="edit.php?id=<?= $result['id']?>" class="font-medium text-green-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="delete.php?id=<?= $result['id']?>" class="ml-4 font-medium text-red-600 dark:text-blue-500 hover:underline"
                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    <a href="detail.php?id=<?= $result['id']?>" class="ml-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                </td>
                
            </tr>
        <?php endforeach ; ?>

        </tbody>
    </table>
</div>

</body>
</html>
