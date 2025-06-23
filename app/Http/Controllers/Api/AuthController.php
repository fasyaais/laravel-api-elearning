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
            "nim_nip"=> "required|exists:users,nim_nip",
            "password" => "required"
        ]);
        if(!Auth::attempt($credentials)){
            return $this->errorResponse("NIM NIP atau password salah",Response::HTTP_UNAUTHORIZED);
        }
        $user = User::where("nim_nip","=",$credentials["nim_nip"])->first();
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

