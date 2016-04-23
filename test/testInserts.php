<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/23/16
 * Time: 17:16
 */

define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';

use ThingORM\DB\MySqlQuery;

$query = MySqlQuery::batchInsert()->into('user')
    ->values([
        ['name'=>'sdsds','address'=>'wewew','created_at'=>array('now()')],
        ['name'=>'asasa','address'=>'dfdfdf','created_at'=>array('now()')],
        ['name'=>'gggdg','address'=>'sddfsf','created_at'=>array('now()')]
        ])
    ->generateSQL();