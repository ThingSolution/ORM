<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 22:31
 */

namespace App\Repository;


use ThingORM\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("user", "UserEntity");
    }
}