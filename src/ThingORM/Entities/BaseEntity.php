<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 4/2/16
 * Time: 23:55
 */

namespace ThingORM\Entities;


class BaseEntity
{
    /**
     * BaseEntity constructor.
     * @param $table_object
     */
    public function __construct($table_object)
    {
        if(!is_object($table_object)) {
            $table_object=(object)$table_object;
        }

        $this->mapData($table_object);
    }

    public function mapData($table_object) {
        $properties = get_object_vars($this);

        foreach ($properties as $property => $value) {
            if (isset($table_object->{$property})) {
                $this->{$property} = $table_object->{$property};
            } else {
                $this->{$property} = null;
            }

        }
    }
    public function asArray() {
        return (array)$this;
    }

}