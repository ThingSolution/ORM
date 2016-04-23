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
    const TYPE_BATCH_INSERT = "BATCH_INSERT";

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
    protected $havings = array();

    protected $leftJoins=array();
    protected $joins=array();
    protected $rightJoins=array();
    protected $setValues = array();

    protected $insertValues = array();


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
        $query = new static(self::TYPE_INSERT);
        return $query;
    }
    public static function batchInsert()
    {
        $query = new static(self::TYPE_BATCH_INSERT);
        return $query;
    }
    public static function update()
    {
        $query = new static(self::TYPE_UPDATE);
        return $query;
    }
    public static function select($selectColumns = null)
    {
        $query = new static(self::TYPE_SELECT);
        $query->selectColumns = $selectColumns;
        return $query;
    }
    public function distinct()
    {
        $this->distinct = true;
        return $this;
    }
    public static function delete()
    {
        $query = new static(self::TYPE_DELETE);
        return $query;
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
    public function values($insertValues) {
        $this->insertValues = $insertValues;
        return $this;
    }
    public function set(array $attributes) {

        $this->setValues = $attributes;
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

    public function having($field, $operator, $value)
    {
        $this->havings[] = array($field,$operator,$value);
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