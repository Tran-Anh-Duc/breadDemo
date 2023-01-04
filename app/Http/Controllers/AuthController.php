<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function viewRegister()
    {
        return view('loginAndRegister.login');
    }

    public function viewLogin()
    {
        return view('loginAndRegister.login');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $result = $this->userRepository->registerUser($data);
        return Controller::sendResponse(self::HTTP_OK,'create success',$result);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $result = $this->userRepository->loginUser($data);
        if (!empty($result) &&  $result == 1 ){
            return Controller::sendResponse(self::HTTP_OK,'login success',$result);
        }else{
            return Controller::sendResponse(self::HTTP_BAD_REQUEST,'login error');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('bread.viewLogin');
    }


}
