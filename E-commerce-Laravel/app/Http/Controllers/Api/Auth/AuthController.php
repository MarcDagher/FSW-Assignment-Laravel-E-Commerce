<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        echo $request -> email . "\n";
        echo $request -> password . "\n";
            
            // $token = auth()->attempt($request -> validated()); // when validated, receive an array of the validated input (email and pass)
            $credentials = $request->only('email', 'password');
            $token = Auth::attempt($credentials);
            echo " hello";
            echo $token;
            if ($token){
                // echo json_encode($token);
                return $this -> responseWithToken($token, auth()->user());
            } else {
                // echo json_encode($token);
                return response() -> json([
                    'status' => 'failed',
                    'message' => 'Invalid credentials'
                ], 401); // status code
            }
        }

    // validate user input. Create a form request class that will handle the validation for us on the registration method
    // php artisan make:request RegistrationRequest. See the file in requests folder
    public function register(RegistrationRequest $request){
        // uses the User model to create new user (create()) in db and retrieves the validated forms from the request object
        $user = User::create($request -> validated());  
        if ($user){
            // auth => login is used to log in a user. The new user is the argument.
            // auth()->login($user) method authenticates the user by associating them with the authentication system.
            // After successful authentication, Laravel generates an authentication token for the user.
            $token = auth()->login($user); 
            return $this -> responseWithToken($token, $user);
        } else {
            return response() -> json([
                'status' => 'failed',
                'message' => 'An error occured while trying to create user'
            ], 500);
        }
    }

    // Return JWT access token
    public function responseWithToken($token, $user){
        return response()->json([ // response is a laravel helper function that creates JSON responses similar to json_encode() in php
            'status' => 'success',
            'user' => $user, // $user will contain details about the user
            'access_token' => $token, // $token is the JWT from the response which will access authenticated routes
            'type' => 'bearer'
        ]);
    }
}
