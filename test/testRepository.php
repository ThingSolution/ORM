<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 22:27
 */

define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';


$userRepository = New \App\Repository\UserRepository();

$result = $userRepository->rawQuery();

var_dump($result);