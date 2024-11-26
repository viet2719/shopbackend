<?php

namespace App\Http\Controllers;

use App\Services\AuthServices;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $authServices;
    public function __construct(
        AuthServices $authServices
    ) {
        $this->authServices = $authServices;
    }
    public function login(Request $request){
        $token = $this->authServices->login($request);
        if (is_string($token)) {
            return $this->respondWithToken($token);
        }
        return $token;
    }
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    public function register(Request $request) {
        return $this->authServices->register($request);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function changePassWord(Request $request)
    {
       return $this->authServices->changePassWord($request);
    }

}
