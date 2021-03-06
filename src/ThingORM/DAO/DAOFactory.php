<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 18:06
 */

namespace ThingORM\DAO;


use Framework\Config;
use ThingORM\DB\Query\MongoQuery;
use ThingORM\DB\Query\Query;

class DAOFactory
{

    /**
     * @param null $selectColumns
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function select($selectColumns = null) {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::select($selectColumns);
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::select($selectColumns);
        } else {
            return MongoQuery::select($selectColumns);
        }
    }

    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function insert() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::insert();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::insert();
        } else {
            return MongoQuery::insert();
        }
    }

    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function batchInsert() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::batchInsert();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::batchInsert();
        } else {
            return MongoQuery::batchInsert();
        }
    }
    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function update() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::update();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::update();
        } else {
            return MongoQuery::update();
        }
    }
    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function delete() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::delete();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::delete();
        } else {
            return MongoQuery::delete();
        }
    }

    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function rawSelect($sql,$param=array()) {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::rawSelect($sql,$param);
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::rawSelect($sql,$param);
        } else {
            return MongoQuery::rawSelect($sql,$param);
        }
    }

    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function rawUpdate($sql,$param=array()) {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::rawQuery($sql,$param);
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::rawQuery($sql,$param);
        } else {
            return MongoQuery::rawQuery($sql,$param);
        }
    }

    /**
     * @return Query
     * @throws \Framework\Exception\FrameworkException
     * @throws null
     */
    public static function rawDelete($sql,$param=array()) {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            return MySqlDAO::rawQuery($sql,$param);
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            return MsSqlDAO::rawQuery($sql,$param);
        } else {
            return MongoQuery::rawQuery($sql,$param);
        }
    }

    public static function beginTransaction() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            MySqlDAO::beginTransaction();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            MsSqlDAO::beginTransaction();
        } else {
            MongoQuery::beginTransaction();
        }
    }
    public static function commitTransaction() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            MySqlDAO::commitTransaction();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            MsSqlDAO::commitTransaction();
        } else {
            MongoQuery::commitTransaction();
        }
    }
    public static function rollbackTransaction() {
        if(Config::get("database.db_type","MYSQL")=="MYSQL") {
            MySqlDAO::rollbackTransaction();
        } elseif(Config::get("database.db_type","MYSQL")=="MSSQL") {
            MsSqlDAO::rollbackTransaction();
        } else {
            MongoQuery::rollbackTransaction();
        }
    }
}