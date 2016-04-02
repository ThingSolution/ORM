<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

class NotEqualToRestriction extends SingleValueRestriction
{
    public function toSql($fieldName)
    {
        return $fieldName . ' <> ?';
    }
}
