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

    protected function startTransaction()
    {
        // TODO: Implement startTransaction() method.
    }

    protected function commit()
    {
        // TODO: Implement commit() method.
    }

    protected function rollBack()
    {
        // TODO: Implement rollBack() method.
    }
}