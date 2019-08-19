<?php

namespace App\Helpers;

use Collective\Html\FormFacade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppHelper {

	// get session user
    public static function get_session_user() {

    	$session_user = Session::get('user_data');

    	return $session_user;

    }
}