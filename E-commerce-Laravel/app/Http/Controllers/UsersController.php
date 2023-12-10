<?php

namespace App\Http\Controllers;

use App\Models\UserSignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    // select username, email, and password  to check if already found
    public function check_users ($data){
        $username = DB::table('users')->where('username', $data -> username) -> value('username');
        $email = DB::table('users')->where('email', $data -> email) -> value('email');
        return [$username, $email];
    }

    public function insert_data ($data) {
        DB::table('users')->insert(
            ["username" => $data -> username,
             "email" => $data -> email,
             "password" => bcrypt($data -> password),
             "role_id" => $data -> role_id,]);
            }

    public function sign_up (Request $data) {
        $user = $this -> check_users($data);

        if ($user[0]) {
            echo "$user[0] : username alredy exists";

        } elseif ($user[1]){
            echo "$user[1] : username alredy exists";

        } else {
            $this -> insert_data($data);
            $name = $data->username;
            echo "Welcome $name";
        }
    }

     //          //
    // SIGN IN //
    //        //

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

    public function sign_in (Request $data) {
        // verify if username and password are correct
        [$username, $password, $user_id, $role_id] = $this -> authenticate_user($data);

        echo $username . "\n" . $password . "\n" . $user_id . "\n" . $role_id;
    }

}