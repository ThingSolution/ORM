<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

abstract class SingleValueRestriction extends Restriction
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValues()
    {
        return array($this->value);
    }
}
