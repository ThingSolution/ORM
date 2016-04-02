<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:41
 */

namespace ThingORM\DB;


class Operators
{
    public static function equalTo($value)
    {
        return "=?";
    }
    public static function notEqualTo($value)
    {
        return "!=";
    }
    public static function like($value)
    {
        return "like";
    }
    public static function greaterThan($value)
    {
        return ">";
    }
    public static function lessThan($value)
    {
        return "<";
    }
    public static function greaterOrEqualTo($value)
    {
        return ">=";
    }
    public static function lessOrEqualTo($value)
    {
        return "<=";
    }
    public static function isNull()
    {
        return "is null";
    }
    public static function isNotNull()
    {
        return "is not null";
    }
    public static function isNotIn(array $values)
    {
        return "not in";
    }
}