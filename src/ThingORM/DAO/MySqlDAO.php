<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 16:21
 */

namespace ThingORM\DAO;


use Framework\Config;
use Framework\DB\DB;
use PDO;
use ThingORM\DB\Query\MySqlQuery;

class MySqlDAO extends MySqlQuery
{
    public function __construct($type)
    {
        parent::__construct($type);
        //$this->db = new DB(Config::get('database.default'));
        $this->readDBInstance = DB::connection('mysql_read');
        $this->writeDBInstance = DB::connection('mysql_write');
        $this->readDBInstance->setFetchMode(PDO::FETCH_OBJ);
        $this->writeDBInstance->setFetchMode(PDO::FETCH_OBJ);
    }
}