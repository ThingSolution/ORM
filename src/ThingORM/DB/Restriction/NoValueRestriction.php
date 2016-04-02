<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

abstract class NoValueRestriction extends Restriction
{
    public function getValues()
    {
        return array();
    }
}
