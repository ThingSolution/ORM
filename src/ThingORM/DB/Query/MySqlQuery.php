<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/8/16
 * Time: 20:41
 */

namespace ThingORM\DB\Query;


class MySqlQuery extends Query
{
    /**
     * @return array
     * @throws \Exception
     */
    protected function generateSQL()
    {
        $sql = "";
        $param = array();
        if ($this->type == self::TYPE_SELECT) {
            $sql = $sql . $this->generateSelectQuery();
            $sql = $sql . $this->generateJoinClause();
            $sql = $sql . $this->generateWhereClause($param);
            $sql = $sql . $this->generateGroupByQuery();
            $sql = $sql . $this->generateHavingClause($param);
            $sql = $sql . $this->generateOrderByQuery();
            $sql = $sql . $this->generateLimitOffsetQuery($param);

        } else if ($this->type == self::TYPE_UPDATE) {
            $sql = "";
            $param = array();
            $sql = $sql . $this->generateUpdateQuery();
            $sql = $sql . $this->generateJoinClause();
            $sql = $sql . $this->generateSetQuery($param);
            $sql = $sql . $this->generateWhereClause($param);

        } else if ($this->type == self::TYPE_DELETE) {
            $sql = "";
            $param = array();
            $sql = $sql . $this->generateDeleteQuery();
            $sql = $sql . $this->generateJoinClause();
            $sql = $sql . $this->generateWhereClause($param);

        } else if ($this->type == self::TYPE_INSERT) {
            $sql = "";
            $param = array();
            $sql = $sql . $this->generateInsertQuery();
            $sql = $sql . $this->generateInsertValueQuery($param);

        } else if ($this->type == self::TYPE_BATCH_INSERT) {
            $sql = "";
            $param = array();
            $sql = $sql . $this->generateInsertQuery();
            $sql = $sql . $this->generateBatchInsertValueQuery($param);
        } else if($this->type == self::TYPE_RAW_SELECT || $this->type==self::TYPE_RAW_QUERY){
            // raw query
            $sql = $this->rawSql;
            $param = $this->rawParams;
        }

        return array('sql'=>$sql,'params'=>$param);
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateSelectQuery() {
        $sql="";

        if(count($this->selectColumns)==0) {
            $sql = "select * ";
        } else {
            $sql = "select ".implode(",",$this->selectColumns);
        }

        if($this->table =="") {
            throw new \Exception("table invalid");
        }

        $sql = $sql." from ".$this->table;

        return $sql;
    }

    /**
     * @return string
     */
    private function generateJoinClause() {
        $sql = "";
        if(count($this->joins)>0) {
            $joinSqls = array();

            foreach ($this->joins as $join) {
                $joinSqls[] = " inner join ".$join[0]." on ".$join[1]." ".$join[2]." ".$join[3];
            }
            $sql = $sql . " ".implode(" ",$joinSqls);
        }
        if(count($this->leftJoins)>0) {
            $joinSqls = array();

            foreach ($this->leftJoins as $join) {
                $joinSqls[] = " left join ".$join[0]." on ".$join[1]." ".$join[2]." ".$join[3];
            }
            $sql = $sql . " ".implode(" ",$joinSqls);
        }
        if(count($this->rightJoins)>0) {
            $joinSqls = array();

            foreach ($this->rightJoins as $join) {
                $joinSqls[] = " right join ".$join[0]." on ".$join[1]." ".$join[2]." ".$join[3];
            }
            $sql = $sql . " ".implode(" ",$joinSqls);
        }

        return $sql;
    }

    /**
     * @return string
     */
    private function generateWhereClause(&$param) {
        $sql = "";
        $sqlWhere = array();
        if(count($this->where)>0) {
            $whereSqls = array();

            foreach ($this->where as $where) {
                $whereSqls[] = $where[0]." ".$where[1]." ? ";
                if(is_array($where[2])) {
                    $param[] = array_shift($where[2]);
                } else {
                    $param[] = $where[2];
                }
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($this->whereNotNull)>0) {
            $whereSqls = array();

            foreach ($this->whereNotNull as $where) {
                    $whereSqls[] = $where." is not null ";
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($this->whereNull)>0) {
            $whereSqls = array();

            foreach ($this->whereNull as $where) {
                $whereSqls[] = $where." is null ";
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($this->whereNotBetween)>0) {
            $whereSqls = array();

            foreach ($this->whereNotBetween as $where) {
                $whereSqls[] = $where[0]." not between ? and ? ";
                $param[] = $where[1];
                $param[] = $where[2];
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($this->whereBetween)>0) {
            $whereSqls = array();

            foreach ($this->whereBetween as $where) {
                $whereSqls[] = $where[0]." between ? and ? ";
                $param[] = $where[1];
                $param[] = $where[2];
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($this->whereIn)>0) {
            $whereSqls = array();

            foreach ($this->whereIn as $where) {
                $whereSqls[] = $where[0]." in ('".implode("','",$where[1])."') ";
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($this->whereNotIn)>0) {
            $whereSqls = array();

            foreach ($this->whereNotIn as $where) {
                $whereSqls[] = $where[0]." not in ('".implode("','",$where[1])."') ";
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }
        if(count($sqlWhere)>0) {
            $sql = " where ".implode(" and ",$sqlWhere);

        }
        return $sql;
    }

    private function generateHavingClause(&$param) {
        $sql = "";
        $sqlWhere = array();
        if(count($this->havings)>0) {
            $whereSqls = array();

            foreach ($this->havings as $where) {
                $whereSqls[] = " ".$where[0]." ".$where[1]." ? ";
                if(is_array($where[2])) {
                    $param[] = array_shift($where[2]);
                } else {
                    $param[] = $where[2];
                }
            }
            $sqlWhere[] = implode(" and ",$whereSqls);
        }

        if(count($sqlWhere)>0) {
            $sql = " having ".implode(" and ",$sqlWhere);

        }
        return $sql;
    }

    /**
     * @return string
     */
    private function generateGroupByQuery() {
        $part =array();
        foreach ($this->groupBy as $item) {
            $part[] = $item;
        }
        if(count($part)>0) {
            return " group by ".implode(",",$part);
        } else {
            return "";
        }
    }
    private function generateOrderByQuery() {
        $part =array();
        foreach ($this->orderBy as $item) {
            $part[] = $item[0]." ".$item[1];
        }
        if(count($part)>0) {
            return " order by ".implode(",",$part);
        } else {
            return "";
        }
    }

    /**
     * @param $param
     * @return string
     */
    private function generateLimitOffsetQuery(&$param) {
        $sql = "";
        if($this->limit!="") {
            $param[] = $this->limit;
            $sql= " limit ? ";
        }
        if($this->offset!="") {
            $param[] = $this->offset;
            $sql= $sql ." offset ? ";
        }

        return $sql;

    }

    /**
     * @return string
     */
    private function generateUpdateQuery() {
        $sql = "update ".$this->table." ";

        return $sql;
    }

    /**
     * @param $param
     * @return string
     */
    private function generateSetQuery(&$param) {
        $sql = "";
        $sqlUpdate = array();

        foreach ($this->setValues as $field => $setValue) {
            if(is_array($setValue)) {
                $sqlUpdate[] = $field." = ".array_shift($setValue);
            } else {
                $sqlUpdate[] = $field." = ? ";
                $param[] = $setValue;
            }
        }

        if(count($sqlUpdate)>0) {
            $sql = " set ".implode(",",$sqlUpdate);
        }

        return $sql;
    }

    /**
     * @return string
     */
    private function generateDeleteQuery() {
        return "delete from ".$this->table." ";
    }

    private function generateInsertQuery() {
        return "insert into ".$this->table." ";
    }

    private function generateInsertValueQuery(&$param) {
        $fields = array();
        $values = array();
        foreach ($this->insertValues as $field => $value) {
            $fields[] = $field;
            if(is_array($value)) {
                $values[] = array_shift($value);
            } else {
                $values[] = "?";
                $param[] = $value;
            }
        }
        $sql = " (`".implode("`,`",$fields)."`) values (".implode(",",$values).")";

        return $sql;
    }
    private function generateBatchInsertValueQuery(&$param) {
        $fields = array();

        $finalValues = array();
        foreach ($this->insertValues as $row) {
            if(is_array($row)) {
                $values = array();
                foreach ($row as $field => $value) {
                    $fields[$field] = $field;
                    if(is_array($value)) {
                        $values[] = array_shift($value);
                    } else {
                        $values[] = "?";
                        $param[] = $value;
                    }
                }
                $finalValues[] = "(".implode(",",$values).")";
            }
        }
        $sql = " (`".implode("`,`",array_values($fields))."`) values ".implode(",",$finalValues);

        return $sql;
    }

    protected function startTransaction()
    {
        if($this->writeDBInstance != null) {
            $this->writeDBInstance->getPdo()->beginTransaction();
        }
    }

    protected function commit()
    {
        if($this->writeDBInstance != null) {
            $this->writeDBInstance->getPdo()->commit();
        }
    }

    protected function rollBack()
    {
        if($this->writeDBInstance != null) {
            $this->writeDBInstance->getPdo()->rollBack();
        }
    }
}