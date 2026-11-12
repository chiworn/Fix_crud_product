<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => 'Welcome to api ',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string|min:6'
            ]);
            $User =  User::create($user);
            $token = $User->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Create Account success',
                'data'  => $User,
                'token' => $token,
            ]);
    }

    public function login(Request $request){
            $validated = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if($validated->fails()){
                return response()->json([
                    'success' => false,
                    'errors' => $validated->errors(),
                ]);
            }
            $user = User::where('email',$request->email)->first();

            if(!$user || !Hash::check($request->password,$user->password)){
                    return response()->json([
                        'succes' => false,
                        'message' => 'invalid password or emial',
                    ]);
            }
             $token = $user->createToken('auth_token')->plainTextToken;

             return response()->json([
                'success' => true,
                'message' => 'login success ',
                'user'    =>  $user,
                'token'   =>  $token,
             ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
