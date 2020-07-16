<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

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
                'message' => 'Get user not sucessfuly',
                'data' =>  $e->getMessage()
            ], 400);
        }
        return response()->json([
            'message' => 'Get user sucessfuly',
            'data' => $query->get()
        ], 200);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                    'data' => []
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Could not create token',
                'data' => $e->getMessage()
            ], 500);
        }
        $user = JWTAuth::user();
        return response()->json([
            'message' => 'Login sucessfuly',
            'data' => compact('user','token')
        ], 200);
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
                return response()->json($validator->errors(), 422);
            }

            $user = User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'User created',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User failed created',
                'data' =>  $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out',
            'data' => []
        ], 200);
    }

    public function show($id)
    {
        try {
            $data =  User::findOrFail($id);
            return response()->json([
                'message' => 'Get data sucessfuly',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Get data unsucessfuly',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = User::findOrFail($id);
            $model->fill($request->input());
            $model->save();
            return response()->json([
                'message' => 'Update data sucessfuly',
                'data' => $model
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Update data unsucessfuly',
                'data' => $e->getMessage()
            ], 500);
        }
    }

}
