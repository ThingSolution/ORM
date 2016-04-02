<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

class IsNotInRestriction extends Restriction
{
    private $values;

    public function __construct($values)
    {
        $this->values = $values;
    }

    public function toSql($fieldName)
    {
        if (!count($this->values) > 0) {
            return null;
        }
        $placeholders = implode(', ', array_fill(0, count($this->values), '?'));
        return $fieldName . ' NOT IN(' . $placeholders . ')';
    }

    public function getValues()
    {
        return $this->values;
    }
}
