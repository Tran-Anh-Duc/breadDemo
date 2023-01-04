<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function loginUser($data)
    {
        $result = Auth::attempt([
           'email' => $data['email'],
           'password' => $data['password']
        ]);
        return $result;

        $bool = false;
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ])){
            $bool = true;
        }else{
            $bool = false;
        }
        return  $bool;
    }
}
