<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = User::orderBy('users.id', 'ASC');
            if ($request->filled('limit')) {
                $query->paginate($request->input('limit'));
            }

            if ($request->filled('fullname')) {
                $query->where('users.fullname', 'LIKE', "%{$request->input('fullname')}%");
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'user failed created',
                'data' => $e
            ], 500);
        }
        return response()->json([
            'message' => 'get user sucessfuly',
            'data' => $query->get()
        ], 200);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required|string|max:50',
                'username' => 'required|string|max:50|unique:users',
                'email' => 'required|string|email|max:100|unique:users',
                'role' =>  'required|string',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $user = User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'user created',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'user failed created',
                'data' => $e
            ], 500);
        }
    }
}
