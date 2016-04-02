<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */
namespace ThingORM\DB;

use ThingORM\DB\Restriction\Between;
use ThingORM\DB\Restriction\BetweenRestriction;
use ThingORM\DB\Restriction\EqualToRestriction;
use ThingORM\DB\Restriction\GreaterOrEqualToRestriction;
use ThingORM\DB\Restriction\GreaterThanRestriction;
use ThingORM\DB\Restriction\IsNotInRestriction;
use ThingORM\DB\Restriction\IsNotNullRestriction;
use ThingORM\DB\Restriction\IsNullRestriction;
use ThingORM\DB\Restriction\LessOrEqualToRestriction;
use ThingORM\DB\Restriction\LessThanRestriction;
use ThingORM\DB\Restriction\LikeRestriction;
use ThingORM\DB\Restriction\NotEqualToRestriction;

class Restrictions
{
    public static function equalTo($value)
    {
        return new EqualToRestriction($value);
    }

    public static function notEqualTo($value)
    {
        return new NotEqualToRestriction($value);
    }

    public static function like($value)
    {
        return new LikeRestriction($value);
    }

    public static function greaterThan($value)
    {
        return new GreaterThanRestriction($value);
    }

    public static function lessThan($value)
    {
        return new LessThanRestriction($value);
    }

    public static function greaterOrEqualTo($value)
    {
        return new GreaterOrEqualToRestriction($value);
    }

    public static function lessOrEqualTo($value)
    {
        return new LessOrEqualToRestriction($value);
    }

    public static function between($value1, $value2, $betweenMode = Between::INCLUSIVE)
    {
        return new BetweenRestriction($value1, $value2, $betweenMode);
    }

    public static function isNull()
    {
        return new IsNullRestriction();
    }

    public static function isNotNull()
    {
        return new IsNotNullRestriction();
    }

    public static function isNotIn(array $values)
    {
        return new IsNotInRestriction($values);
    }
}
