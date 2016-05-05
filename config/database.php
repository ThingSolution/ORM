<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 22:06
 */

return array(
    "mysql_read" => array(
        "driver"    => "mysql",
        "host"      => "localhost",
        "db"        => "test",
        "user"      => "root",
        "pass"      => "",
        "port"      => 3306,
        'write'     => "write"
    ),

    "mysql_write" => array(
        "driver"    => "mysql",
        "host"      => "localhost",
        "db"        => "test",
        "user"      => "root",
        "pass"      => "",
        "port"      => 3306
    ),
    "mssql_read" => array(
        "driver"    => "mssql",
        "host"      => "localhost",
        "db"        => "test",
        "user"      => "root",
        "pass"      => "",
        "port"      => 3306,
        'write'     => "write"
    ),

    "mssql_write" => array(
        "driver"    => "mssql",
        "host"      => "localhost",
        "db"        => "test",
        "user"      => "root",
        "pass"      => "",
        "port"      => 3306
    ),
    "db_type"=>"MYSQL"
);