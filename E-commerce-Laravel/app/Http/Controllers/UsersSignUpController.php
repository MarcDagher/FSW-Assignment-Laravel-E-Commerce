<?php

namespace App\Http\Controllers;

use App\Models\UserSignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersSignUpController extends Controller
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
}