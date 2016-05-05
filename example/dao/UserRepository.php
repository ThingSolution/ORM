<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 17:05
 */
class UserRepository extends \ThingORM\Repository\BaseRepository
{
    /**
     * UserDAO constructor.
     */
    public function __construct()
    {
        parent::__construct("user");
        $this->daoObject = new \ThingORM\DAO\MySqlDAO("user");
    }
}