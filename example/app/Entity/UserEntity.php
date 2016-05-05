<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 22:31
 */

namespace App\Entity;


use ThingORM\Entities\BaseEntity;

class UserEntity extends BaseEntity
{
    public $id=-1;
    public $name="";
    public $address="";
    public $created_at;

    public function __construct($table_object)
    {
        parent::__construct($table_object);
    }
}