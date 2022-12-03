<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }

    public function register(Request $request): JsonResponse
    {
        $this->service->validateRegister();
        $data = $this->validateRegister($request);

        try {
            $user  = User::create($data);
            $token = auth()->login($user);
            return $this->respondWithToken('User registered', $user, $token, 201);
        }

        catch (Exception $exception) {
            return $this->respondWithError('Error occurred', $exception->getMessage(), $exception->getCode());
        }
    }

    public function me()
    {
        return $this->respondWithSuccess('User', auth()->user());
    }

    protected function validateRegister(Request $request): array
    {
        return $this->validate($request, [
            'name'     => 'required|string|max:30',
            'email'    => 'required|email|max:40|unique:users',
            'password' => 'required'
        ]);
    }

//    =======================================================================

    public function login()
    {
//        $this->validate($request, [
//            'email' => 'required|string',
//            'password' => 'required|string',
//        ]);
//
//        $credentials = $request->only(['email', 'password']);
//
//        if (! $token = Auth::attempt($credentials)) {
//            return response()->json(['message' => 'Unauthorized'], 401);
//        }
//
//        return $this->respondWithToken($token);
    }

    public function logout()
    {
//        auth()->logout();
//        return response()->json(['message' => 'Successfully logged out']);
    }

//    public function register(Request $request)
//    {
//        return $this->validate($request, [

//        ]);

//        $validator = validator($request->all(), [
////            'name'     => 'required|string|max:30',
//            'email'    => 'required|email|max:40|unique:users',
//            'password' => 'required'
//        ]);

//return response()->json([['s']]);
//        if ($validator->fails()) {
//            return response()->json([
//                'error' => true,
//                'data'  => $validator->messages()
//            ], 422);
//        }
//
//        return response()->json(['d' => 'd']);
//
//        $user  = User::create($validator->validated());
//        $token = auth()->login($user);
//        return $this->responseToken($user, $token);
//    }
}
