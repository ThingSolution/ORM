<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/23/16
 * Time: 17:08
 */

define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';

use ThingORM\DB\MySqlQuery;

$query = MySqlQuery::update()->delete()
    ->from('user')
    ->innerJoin('user_info','user_id','=','id')
    ->where('id','=','ssd')
    ->where('name','=','sdsds');
$query->generateSQL();