<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

class IsNotNullRestriction extends NoValueRestriction
{
    public function toSql($fieldName)
    {
        return $fieldName . ' IS NOT NULL';
    }
}
