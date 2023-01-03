<?php


namespace App\Http\Controllers;


use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $result = $this->userRepository->registerUser($data);
        return Controller::sendResponse(self::HTTP_OK,'create success',$result);
    }
}
