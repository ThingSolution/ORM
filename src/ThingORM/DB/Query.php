<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */

namespace ThingORM\DB;


class Query
{
    private $fetchType = \PDO::FETCH_OBJ;
    /**
     * @return Query
     */
    public static function select() {
        return new Query();
    }

    /**
     * @return Query
     */
    public static function update() {
        return new Query();
    }

    /**
     * @return Query
     */
    public static function delete() {
        return new Query();
    }

    /**
     * @return Query
     */
    public static function insert() {
        return new Query();
    }

    /**
     * @return Query
     */
    public function from() {

    }
    /**
     * @return Query
     */
    public function where() {

    }
    /**
     * @return Query
     */
    public function innerJoin() {

    }
    /**
     * @return Query
     */
    public function join() {

    }
    /**
     * @return Query
     */
    public function leftJoin() {

    }
    /**
     * @return Query
     */
    public function righJoin() {

    }
    /**
     * @return Query
     */
    public function groupBy() {

    }
    /**
     * @return Query
     */
    public function limit() {

    }
    /**
     * @return Query
     */
    public function offset() {

    }
    /**
     * @return Query
     */
    public function having() {

    }

    /**
     * @return Query
     */
    public function oderBy() {

    }

    public function fetchArray() {

    }

    public function fetchObject() {

    }



}