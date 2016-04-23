<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/23/16
 * Time: 16:56
 */

define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';

use ThingORM\DB\MySqlQuery;

$query = MySqlQuery::update()->table("user")
    ->set(['id'=>'1','name'=>'22323'])
    ->innerJoin('user_info','user.id','=','user_info.user_id')
    ->where('name','=','sdsdsd')
    ->where('id','=','2222')
    ->orderBy('name','desc')
    ->limit(10);
$query->generateSQL();