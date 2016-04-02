<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

class LessOrEqualToRestriction extends SingleValueRestriction
{
    public function toSql($fieldName)
    {
        return $fieldName . ' <= ?';
    }
}
