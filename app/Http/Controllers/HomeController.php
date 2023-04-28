<?php

namespace App\Http\Controllers;

//use Carbon\CarbonTimeZone;
//use DateTime;
//use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $error = $r->session()->get("error", false);
        $success = $r->session()->get("success", false);
        
        if($error != false) {
            $r->session()->forget("error");
        }
        if($success != false) {
            $r->session()->forget("success");
        }
        

        /*
        foreach($tasks as $task) {
            $due_date = $task["due_date"];
            $created_at = $task["created_at"];

            $d = DateTime::createFromFormat("Y-m-d H:i:s", $due_date);
            $due_date = $d->format("d/m/Y H:i:s");

            $c = DateTime::createFromFormat("Y-m-d H:i:s", $created_at);
            $created_at = $c->format("d/m/Y H:i:s");

            $task["due_date"] = $due_date;
            $task["created_at"] = $created_at;
        }
        */

        return view("home", ["loggedUser" => $loggedUser, "tasks" => $tasks, "error" => $error, "success" => $success]);
    }


    public function dashboard(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $error = $r->session()->get("error", false);
        $success = $r->session()->get("success", false);
        
        if($error != false) {
            $r->session()->forget("error");
        }
        if($success != false) {
            $r->session()->forget("success");
        }

        $data = [];


        $qteTasks = count($loggedUser->tasks);
        $qteDoneTasks = DB::table("tasks")->select()->where("user_id", "=", $loggedUser->id)->where("is_done", "=", true)->get()->count();
        $qtePendingTasks = $qteTasks - $qteDoneTasks;

        $pctDoneTasks = 0;

        if($qteTasks != 0) {
            $pctDoneTasks = ($qteDoneTasks / $qteTasks) * 100.0;
        } else {
            $pctDoneTasks = 100.0;
        }
        
        $pctDoneTasks = round($pctDoneTasks, 2, PHP_ROUND_HALF_UP);

        
        $data["qteTasks"] = $qteTasks;
        $data["qteDoneTasks"] = $qteDoneTasks;
        $data["pctDoneTasks"] = $pctDoneTasks;
        $data["qtePendingTasks"] = $qtePendingTasks;

        $currentPage = "dashboard";

        return view("dashboard", ["loggedUser" => $loggedUser, "error" => $error, "success" => $success, "data" => $data, "currentPage" => $currentPage]);
    }
}
