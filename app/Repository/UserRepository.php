<?php


namespace App\Repository;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
       return User::class;
    }
}
