<?php


namespace App\Repository;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
       return User::class;
    }

    public function registerUser($data)
    {
        $data1 = [
           'name'  => $data['name'] ?? null,
           'email' => $data['email'] ?? null,
           'password' =>  !empty($data['password']) ? bcrypt($data['password']) : null
        ];
        $user = $this->model->create($data1);
    }
}
