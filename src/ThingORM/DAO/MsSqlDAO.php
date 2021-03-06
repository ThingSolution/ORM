<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 17:38
 */

namespace ThingORM\DAO;


use Framework\Config;
use Framework\DB\DB;
use PDO;
use ThingORM\DB\Query\MsSqlQuery;

class MsSqlDAO extends MsSqlQuery
{
    public function __construct($type)
    {
        parent::__construct($type);
        //$this->db = new DB(Config::get('database.default'));
        $this->readDBInstance = DB::connection(Config::get('database.mssql_read'));
        $this->writeDBInstance = DB::connection(Config::get('database.mssql_write'));
        $this->readDBInstance->setFetchMode(PDO::FETCH_OBJ);
        $this->writeDBInstance->setFetchMode(PDO::FETCH_OBJ);
    }
}