<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email"=> "required|email|exists:users,email",
            "password" => "required"
        ]);
        if(!Auth::attempt($credentials)){
            return $this->errorResponse("email atau password salah",Response::HTTP_UNAUTHORIZED);
        }
        $user = User::where("email","=",$credentials["email"])->first();
        $token = $user->createToken("auth_token")->plainTextToken;
        $data = [
            "token" => $token,
            "detail" => new UserResource($user),
        ];
        return $this->successResponse($data,"Login berhasil",Response::HTTP_OK);
    }

    public function profile(){
        $data = new UserResource(Auth::user());
        return $this->successResponse($data);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse(message:"Logout berhasil");
    }
}

