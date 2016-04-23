<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/8/16
 * Time: 18:25
 */

namespace ThingORM\DB\Clauses;


class JoinClause
{
    private $table;
    private $on;

    /**
     * JoinClause constructor.
     * @param $on
     * @param $table
     */
    public function __construct($on, $table)
    {
        $this->on = $on;
        $this->table = $table;
    }

    public function on() {

    }
}