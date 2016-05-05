<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/23/16
 * Time: 17:16
 */

define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';

use ThingORM\DB\Query\MySqlQuery;

$query = MySqlQuery::insert()->into('user')
    ->values(['id'=>'sdsds','name'=>'sdsdsd','created_at'=>array('now()')])
    ->generateSQL();