<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 5/5/16
 * Time: 22:31
 */

namespace App\Repository;


use ThingORM\DAO\DAOFactory;
use ThingORM\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("user", "UserEntity");
    }
    public function getAllUserLike() {
        return DAOFactory::select()->from("user")->where("id",">",3)->execute();
    }
    public function deleteUser() {
        return DAOFactory::delete()->from("user")->where("id",">=",3)->execute();
    }
    public function newUser() {
        return DAOFactory::insert()->into("user")->values(['name'=>'new name','address'=>'new add'])->execute();
    }
    public function updateUser() {
        return DAOFactory::update()->table("user")->set(['name'=>"sdasdasda"])->where("id","=",4)->execute();
    }
    public function rawQuery() {
        return DAOFactory::rawSelect("select * from user",[])->execute();
    }
}