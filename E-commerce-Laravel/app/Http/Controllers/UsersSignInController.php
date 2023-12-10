<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSignInController extends Controller
{

    public function authenticate_user ($data) {
        $username = DB::table('users')->where('username', $data -> username) -> value('username');
        $password = DB::table('users')->where('username', $data -> username) -> value('password');

        if (!$username){
            echo "user doesn't exist";
        } else {
            if (Hash::check($data -> password, $password)){
                echo "logged in \n";
            } else {
                echo "wrong credentials \n";
                die();
            };
        }

        $user_id = DB::table('users')->where('username', $data -> username) -> value('users_id');
        $role_id = DB::table('users')->where('username', $data -> username) -> value('role_id');

        return [$username, $password, $user_id, $role_id];
    }
    

    public function create_token ($username, $password, $user_id) {
        // if signed in => store in token
    }


    public function sign_in (Request $data) {
        // verify if username and password are correct
        [$username, $password, $user_id, $role_id] = $this -> authenticate_user($data);

        echo $username . "\n" . $password . "\n" . $user_id . "\n" . $role_id;
    }

}
