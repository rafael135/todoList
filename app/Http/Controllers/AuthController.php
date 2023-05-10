<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Filter;

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
            $currentPage = "login";

            return view("login", ["loggedUser" => false, "currentPage" => $currentPage]);
        } else {
            return redirect()->route("home");
        }
    }

    public function registerView(Request $r) {
        if(self::checkAuth() == false) {
            // Erros caso o usuario tenha tentado se logar e os dados estejam errados
            $errors = $r->input("errors", false);

            $currentPage = "register";

            return view("register", [
                "loggedUser" => false,
                "errors" => $errors,
                "currentPage" => $currentPage
            ]);
        } else {
            return redirect()->route("home");
        }
    }

    public function loginAction(Request $r) {
        $errors = [];

        $email = $r->input("email", false);
        $password = $r->input("password", false);
        
        $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if($email == false) {
            $errors[count($errors)] = [
                "input" => "email",
                "msg" => "E-mail inválido!"
            ];
            return redirect()->route("user.login", ["errors" => $errors]);
        }

        $existentEmail = DB::table("users")->select("*")->where("email", "=", $email)->get()->count();

        if($existentEmail == 0) {
            $errors[count($errors)] = [
                "input" => "email",
                "msg" => "E-mail não registrado!"
            ];

            return redirect()->route("user.login", ["errors" => $errors]);
        }

        $r->session()->regenerate();

        if(Auth::attempt([
            "email" => $email,
            "password" => $password
        ], true) == true) {
            $name = User::find(Auth::id())->name;

            return redirect()->route("home")->with("success", [
                "msg" => "Bem vindo de volta $name!"
            ]);
        }
        
    }

    public function registerAction(Request $r) {
        $errors = [];

        $name = $r->input("name", false);
        $email = $r->input("email", false);
        $password = $r->input("password", false);
        $repeat_password = $r->input("repeat-password", false);

        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        if($email == false) {
            $errors[count($errors)] = [
                "input" => "email",
                "msg" => "E-mail inválido!"
            ];

            return redirect()->route("user.register", ["errors" => $errors]);
        }

        if($password != $repeat_password) {
            $errors[count($errors)] = [
                "input" => "repeat-password",
                "msg" => "As senhas são diferentes!"
            ];

            return redirect()->route("user.register", [
                "errors" => $errors
            ]);
        }


        $registeredUser = User::create([
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password)
        ]);

        $r->session()->regenerate();

        if(Auth::attempt([
            "email" => $email,
            "password" => $password
        ], true)) {
            $name = User::find(Auth::id())->name;

            return redirect()->route("home")->with("success", [
                "msg" => "Bem vindo $name!"
            ]);
        } else {
            return redirect()->route("user.register");
        }
    }

    public function logout(Request $r) {
        Auth::logout();
        $r->session()->flush();
        $r->session()->regenerate();

        return redirect()->route("user.login");
    }
}
