<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/23/16
 * Time: 15:01
 */
define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';

use ThingORM\DB\MySqlQuery;

$query = MySqlQuery::select(['id','name','address'])
    ->from("user")
    ->rightJoin('user_info','user.id','=','user_info.user_id')
    ->where('id','>','3')
    ->whereIn('id',['2','3'])
    ->whereNotIn('id',['3','4'])
    ->whereNull('address')
    ->whereNotNull('name')
    ->whereBetween('name','4444','5555')
    ->whereNotBetween('name','6666','7777')
    ->groupBy('id')
    ->groupBy('name')
    ->orderBy('id','desc')
    ->limit(10)
    ->offset(20);


$query->generateSQL();