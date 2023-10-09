<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $checkLogin = [
            'email' => $data['email'],
            'password' => $data['password']
        ];
        $bool = false;
        if (Auth::attempt($checkLogin)){
            $user = DB::table('users')->where('email','=',$data['email'])->first();
            $a  = session()->put('user',$user);
            $bool = true;
        }else{
            $bool = false;
        }
        return  [$bool,$a];
    }
}
