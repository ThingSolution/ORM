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
    const TYPE_SELECT = "SELECT";
    const TYPE_UPDATE = "UPDATE";
    const TYPE_DELETE = "DELETE";
    const TYPE_INSERT = "INSERT";


    private $fetchType = \PDO::FETCH_OBJ;
    /**
     * @var string
     */
    private $query="";
    /**
     * @var string
     */
    private $table_name="";

    private $query_type="SELECT";

    private $fields = array();

    /**
     * Query constructor.
     * @param string $query_type
     * @param string $table_name
     */
    public function __construct($query_type, $table_name)
    {
        $this->query_type = $query_type;
        $this->table_name = $table_name;
    }


    /**
     * @param array $fields
     * @param string $table_name
     * @return Query
     */
    public static function select($fields,$table_name) {
        $instance= new Query(self::TYPE_SELECT,$table_name);
        if(!is_array($fields)) {
            $fields = array($fields);
        }
        if(count($fields)==0) {
            $fields = array("*");
        }

        $instance->fields = $fields;

        return $instance;
    }

    /**
     * @param $table_name
     * @return Query
     */
    public static function update($table_name) {
        return new Query(self::TYPE_UPDATE,$table_name);
    }

    /**
     * @param $table_name
     * @return Query
     */
    public static function delete($table_name) {
        return new Query(self::TYPE_DELETE,$table_name);
    }

    /**
     * @param $table_name
     * @return Query
     */
    public static function insert($table_name) {
        return new Query(self::TYPE_INSERT,$table_name);
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