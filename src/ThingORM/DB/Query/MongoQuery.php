<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 17:39
 */

namespace ThingORM\DB\Query;


class MongoQuery extends Query
{

    protected function generateSQL()
    {
        return array("sql"=>"","params"=>array());
    }
}