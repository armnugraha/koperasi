<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function set_user_data($user)
    {

        $getRoleName = User::select('roles.name as role')
                ->join('role_user','role_user.user_id','users.id')
                ->join('roles','role_user.role_id','roles.id')
                ->where("users.id", $user->id)
                ->first();

        Session::put('user_data', [
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'role_name' => $getRoleName->role
        ]);

    }

    protected function unset_user_data(){

        Session::put('user_data', null);

    }
}
