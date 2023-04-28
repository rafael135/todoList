<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showCategories(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $categories = $loggedUser->categories;

        $error = $r->session()->get("error", false);
        $success = $r->session()->get("success", false);
        
        if($error != false) {
            $r->session()->forget("error");
        }
        if($success != false) {
            $r->session()->forget("success");
        }

        $currentPage = "categories";

        return view("categories", ["loggedUser" => $loggedUser, "categories" => $categories, "error" => $error, "success" => $success, "currentPage" => $currentPage]);
    }

    public function showTasks(Request $r) {
        $loggedUser = AuthController::checkAuth();

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

        $currentPage = "tasks";

        return view("tasks", ["loggedUser" => $loggedUser, "tasks" => $tasks, "error" => $error, "success" => $success, "currentPage" => $currentPage]);
    }
}
