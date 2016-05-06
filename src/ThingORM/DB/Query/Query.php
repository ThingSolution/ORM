<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:20
 */

namespace ThingORM\DB\Query;


use Framework\DB\DB;
use PDO;

abstract class Query
{
    const TYPE_SELECT = "SELECT";
    const TYPE_UPDATE = "UPDATE";
    const TYPE_DELETE = "DELETE";
    const TYPE_INSERT = "INSERT";
    const TYPE_BATCH_INSERT = "BATCH_INSERT";
    const TYPE_RAW_SELECT = "RAW_SELECT";
    const TYPE_RAW_QUERY = "RAW_QUERY";

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

    protected $rawSql;
    protected $rawParams=array();

    /**
     * @var DB
     */
    protected $readDBInstance;
    /**
     * @var DB
     */
    protected $writeDBInstance;


    public function __construct($type = null)
    {
        $this->type = $type ? $type : self::TYPE_SELECT;
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

    public static function rawSelect($sql,$param=array()) {
        $query = new static(self::TYPE_RAW_SELECT);
        $query->rawSql=$sql;
        $query->rawParams=$param;
        return $query;
    }
    public static function rawQuery($sql,$param=array()) {
        $query = new static(self::TYPE_RAW_QUERY);
        $query->rawSql=$sql;
        $query->rawParams=$param;
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

    public function execute() {
        if($this->type==self::TYPE_SELECT || $this->type == self::TYPE_RAW_SELECT) {
            // use read db instance
            if($this->readDBInstance!=null) {
                //
                $query = $this->generateSQL();
                return $this->readDBInstance->select($query['sql'],$query['params']);
            }
        } else {
            // use write db instance
            if($this->writeDBInstance!=null) {
                $query = $this->generateSQL();
                if($this->type==self::TYPE_INSERT || $this->type == self::TYPE_BATCH_INSERT) {
                    return $this->writeDBInstance->insert($query['sql'],$query['params']);
                } elseif($this->type==self::TYPE_UPDATE) {
                    return $this->writeDBInstance->update($query['sql'],$query['params']);
                } elseif($this->type==self::TYPE_DELETE) {
                    return $this->writeDBInstance->delete($query['sql'],$query['params']);
                } else{
                    // raw query
                    return $this->writeDBInstance->query($query['sql'],$query['params']);
                }
            }
        }
    }

    // interface functions
    protected abstract function generateSQL();
}