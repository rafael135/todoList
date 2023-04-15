<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $r) {
        $loggedUser = AuthController::checkAuth();
        //dd($loggedUser);

        /*
        $tasks = [
            [
                "id" => 1,
                "category_id" => 1,
                "user_id" => 1,
                "title" => "Projeto",
                "description" => "dddddddddddddddddddddddddddddddddddddddddddddddddddddd",
                "created_at" => "2023-08-01 06:45:30",
                "due_date" => "2023-08-21 30:00:00",
                "is_done" => false,
                "urgency" => 1,
            ]
        ];
        */

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $tasks = $loggedUser->tasks;

        return view("home", ["loggedUser" => $loggedUser, "tasks" => $tasks]);
    }
}
