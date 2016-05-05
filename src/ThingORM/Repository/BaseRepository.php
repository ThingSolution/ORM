<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 17:13
 */

namespace ThingORM\Repository;


use Exception;
use Framework\Config;
use Framework\DB\Exception\DBException;
use ThingORM\DAO\DAOFactory;

class BaseRepository
{
    protected $entityName;
    protected $tableName;
    protected $entityClass;

    /**
     * BaseRepository constructor.
     * @param $table_name
     * @param $entityName
     */
    public function __construct($table_name,$entityName)
    {
        $this->tableName = $table_name;
        $this->entityName = $entityName;

        $this->entityClass = Config::get("app.entity_namespace","App\\Models\\Entity").$entityName;
    }

    public function getOneObjectByField($field=array()) {
        $objects = $this->getObjectsByField($field);
        if(count($objects) > 0) {
            return (object)$objects[0];
        } else {
            return null;
        }
    }

    /**
     * @param array $fields
     * @return array
     */
    public function getObjectsByField($fields = array())
    {
        $query = DAOFactory::select()->from($this->tableName);

        foreach ($fields as $key => $value) {
            $query=$query->where($key,"=",$value);
        }

        $result = $query->execute();

        $response = array();

        foreach ($result as $item) {
            $response[] = new $this->entityClass($item);
        }
        return $response;
    }

    /**
     * @param array $set_Params
     * @param array $where
     * @return array
     * @throws DBException
     */
    public function update($set_Params=array(),$where=array())
    {
        try {
            if (isset($this->tableName)) {

                if ($set_Params == null || (isset($set_Params) && count($set_Params) == 0)) {
                    throw new DBException("set param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
                }

                if ($where == null || (isset($where) && count($where) == 0)) {
                    throw new DBException("where param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
                }

                $exist_in_where = array();

                foreach ($set_Params as $key => $value) {
                    if (array_key_exists($key, $where)) {
                        $exist_in_where[$key] = $value;
                    }
                }

                $query = DAOFactory::update()
                    ->table($this->tableName)
                    ->set($set_Params);

                foreach ($where as $key => $value) {
                    $query = $query->where($key,"=",$value);
                }

                $query->execute();

                // correct where clause, use when update cache object only
                foreach ($exist_in_where as $key => $value) {
                    $where[$key] = $value;
                }
                return $where;

            } else {
                throw new DBException("Table name invalid", DBException::ERROR_CODE_INTERNAL);
            }
        } catch (DBException $e) {
            throw new DBException($e->getTraceAsString(), DBException::ERROR_CODE_LACK_PARAMETER);
        }
    }


    /**
     * @param array $param
     * @return array|bool|int|string
     * @throws Exception
     */
    public function insert($param=array())
    {
        try {
            if (isset($this->tableName)) {
                if ($param == null || (isset($param) && count($param) == 0)) {
                    throw new DBException("insert param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
                }
                return DAOFactory::insert()->into($this->tableName)->values($param)->execute();
            } else {
                throw new DBException("Table name invalid", DBException::ERROR_CODE_LACK_PARAMETER);
            }
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $param
     * @return array|bool|int|string
     * @throws Exception
     */
    public function inserts($param = array()) {
        try {
            if (isset($this->tableName)) {
                if ($param == null || (isset($param) && count($param) == 0)) {
                    throw new DBException("insert param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
                }
                return DAOFactory::batchInsert()->into($this->tableName)->values($param)->execute();
            } else {
                throw new DBException("Table name invalid", DBException::ERROR_CODE_LACK_PARAMETER);
            }
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $where
     * @return array|bool|int|string
     * @throws DBException
     */
    public function delete($where=array())
    {
        if(isset($this->tableName)) {

            if($where==null || (isset($where) && count($where)==0)) {
                throw new DBException("delete param invalid",DBException::ERROR_CODE_LACK_PARAMETER);
            }
            $query = DAOFactory::delete()->from($this->tableName);
            foreach ($where as $key => $value) {
                $query= $query->where($key,"=",$value);
            }

            return $query->execute();
        }
        return false;
    }
}