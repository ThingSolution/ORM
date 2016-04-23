<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */

namespace ThingORM\DB;


use PDO;

class Query
{
    const TYPE_SELECT = "SELECT";
    const TYPE_UPDATE = "UPDATE";
    const TYPE_DELETE = "DELETE";
    const TYPE_INSERT = "INSERT";
    const TYPE_COUNT  = "COUNT";

    protected $type;
    protected $selectType = PDO::FETCH_ASSOC;

    protected $table;

    protected $distinct = false;
    protected $selectColumns =array();

    protected $orderBy=array();
    protected $limit="";
    protected $offset="";

    protected $options = array();
    protected $groupBy = array();
    protected $where =array();
    protected $whereIn = array();
    protected $whereNotIn = array();
    protected $whereBetween = array();
    protected $whereNotBetween = array();
    protected $whereNull = array();
    protected $whereNotNull = array();

    protected $leftJoins=array();
    protected $joins=array();
    protected $rightJoins=array();

    protected $attributes = array();


    public function __construct($type = null)
    {
        $this->type = $type ? $type : self::TYPE_SELECT;
    }
    public static function newInstance($type = null)
    {
        return new Query($type);
    }
    public static function insert()
    {
        return Query::newInstance(self::TYPE_INSERT);
    }
    public static function update()
    {
        return Query::newInstance(self::TYPE_UPDATE);
    }
    public static function select($selectColumns = null)
    {
        $query = new static();
        $query->selectColumns = $selectColumns;
        return $query;
    }
    public function distinct()
    {
        $this->distinct = true;
        return $this;
    }
    public static function count()
    {
        return new Query(self::TYPE_COUNT);
    }
    public static function delete()
    {
        return new Query(self::TYPE_DELETE);
    }
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }
    public function into($table)
    {
        return $this->table($table);
    }
    public function from($table)
    {
        return $this->table($table);
    }
    public function values($attributes) {
        $this->attributes = $attributes;
        return $this;
    }
    public function set($attributes) {

        $this->attributes = $attributes;
        return $this;
    }
    public function orderBy($field,$order="asc")
    {
        $this->orderBy[] = array($field,$order);
        return $this;
    }
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    public function where($first, $operator, $second)
    {
        $this->where[] = array($first,$operator,$second);
        return $this;
    }
    public function whereIn($first,array $second)
    {
        $this->whereIn[] = array($first,$second);
        return $this;
    }
    public function whereNotIn($first,array $second)
    {
        $this->whereNotIn[] = array($first,$second);
        return $this;
    }
    public function whereBetween($first,$second,$third)
    {
        $this->whereBetween[] = array($first,$second,$third);
        return $this;
    }
    public function whereNotBetween($first,$second,$third)
    {
        $this->whereNotBetween[] = array($first,$second,$third);
        return $this;
    }
    public function whereNull($first) {
        $this->whereNull[] = $first;
        return $this;
    }
    public function whereNotNull($first) {
        $this->whereNotNull[] = $first;
        return $this;
    }
    public function groupBy($groupBy)
    {
        $this->groupBy[] = $groupBy;
        return $this;
    }

    public function innerJoin($table,$first,$operator,$second) {
        $this->joins[] = array($table,$first,$operator,$second);
        return $this;
    }
    public function leftJoin($table,$first,$operator,$second) {
        $this->leftJoins[] = array($table,$first,$operator,$second);
        return $this;
    }
    public function rightJoin($table,$first,$operator,$second) {
        $this->rightJoins[] = array($table,$first,$operator,$second);
        return $this;
    }
    public function generateSQL() {

    }
}