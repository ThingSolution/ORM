<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/23/16
 * Time: 15:01
 */
define('__APP__', __DIR__ . '/..');
require __APP__ . '/vendor/autoload.php';

use ThingORM\DB\Query\MySqlQuery;

\ThingORM\DAO\DAOFactory::beginTransaction();
try {
    \ThingORM\DAO\DAOFactory::insert()
        ->into("test")
        ->values(["name"=>"Name","age"=>10, "adress"=>"Address", "is_active"=>1])
        ->execute();
    throw new Exception("dsdsd");
} catch (Exception $e) {
    \ThingORM\DAO\DAOFactory::rollbackTransaction();
}
