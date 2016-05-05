<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 17:40
 */

namespace ThingORM\DAO;


use Framework\Config;
use Framework\DB\DB;
use PDO;
use ThingORM\DB\Query\MongoQuery;

class MongoDBDAO extends MongoQuery
{
    public function __construct($type)
    {
        parent::__construct($type);
        //$this->db = new DB(Config::get('database.default'));
        $this->readDBInstance = DB::connection(Config::get('database.mongodb_read'));
        $this->writeDBInstance = DB::connection(Config::get('database.mongodb_write'));
        $this->readDBInstance->setFetchMode(PDO::FETCH_OBJ);
        $this->writeDBInstance->setFetchMode(PDO::FETCH_OBJ);
    }
}