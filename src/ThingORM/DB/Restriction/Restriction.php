<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB\Restriction;

abstract class Restriction
{
    abstract public function toSql($fieldName);

    abstract public function getValues();
}
