<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public static function checkAuth() {
        if(Auth::check() == true) {
            $id = Auth::id();
            $user = User::find($id);
            
            return $user;
        } else {
            return false;
        }
    }


    public function loginView(Request $r) {
        if(self::checkAuth() == false) {
            return view("login", ["loggedUser" => false]);
        } else {
            return redirect()->route("home");
        }
    }

    public function registerView(Request $r) {
        if(self::checkAuth() == false) {
            return view("register", ["loggedUser" => false]);
        } else {
            return redirect()->route("home");
        }
    }

    public function loginAction(Request $r) {

    }

    public function registerAction(Request $r) {

    }

    public function logout(Request $r) {

    }
}
