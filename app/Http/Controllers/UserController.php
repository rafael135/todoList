<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showCategories(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        //$categories = $loggedUser->categories;

        $error = $r->session()->get("error", false);
        $success = $r->session()->get("success", false);
        
        if($error != false) {
            $r->session()->forget("error");
        }
        if($success != false) {
            $r->session()->forget("success");
        }

        $currentPage = "categories";

        $pagination = [];
        $pagination["currentPage"] = 0;
        $pagination["maxPage"] = 0;
        $categoriesCount = count($loggedUser->categories);

        $pagination["categoriesCount"] = $categoriesCount;
        $page = $r->query("page", false);

        $itemsToShow = 10;
        $maxPage = floor($categoriesCount / $itemsToShow);
        $pagination["maxPage"] = $maxPage;

        $offsetPage = 0;
        $pagination["offsetItem"] = 1;
        if($categoriesCount > 10) {
            $pagination["showingItems"] = 10;
        } else {
            $pagination["showingItems"] = $categoriesCount;
        }
        

        if($page != false && is_numeric($page)) {
            $offsetPage = intval($page) * 10;

            $pagination["currentPage"] = intval($page);
            $pagination["qteItems"] = $itemsToShow;
            $pagination["offsetItem"] = $offsetPage + 1;
            $pagination["showingItems"] = $offsetPage + ($categoriesCount - $offsetPage);

            $pagination["itemsCount"] = $categoriesCount;
            
        }

        $categories = DB::table("categories")->select()->where("user_id", "=", $loggedUser->id)->offset($offsetPage)->limit(10)->get();

        return view("categories", ["loggedUser" => $loggedUser, "categories" => $categories, "error" => $error, "success" => $success, "currentPage" => $currentPage, "pagination" => $pagination]);
    }

    public function showTasks(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        //$tasks = $loggedUser->tasks;

        $error = $r->session()->get("error", false);
        $success = $r->session()->get("success", false);
        
        if($error != false) {
            $r->session()->forget("error");
        }
        if($success != false) {
            $r->session()->forget("success");
        }

        $currentPage = "tasks";

        $pagination = [];
        $pagination["currentPage"] = 0;
        $pagination["maxPage"] = 0;
        $tasksCount = count($loggedUser->tasks);

        $pagination["tasksCount"] = $tasksCount;
        $page = $r->query("page", false);

        $itemsToShow = 10;
        $maxPage = floor($tasksCount / $itemsToShow);
        $pagination["maxPage"] = $maxPage;

        $offsetPage = 0;
        $pagination["offsetItem"] = 1;
        if($tasksCount > 10) {
            $pagination["showingItems"] = 10;
        } else {
            $pagination["showingItems"] = $tasksCount;
        }

        if($page != false && is_numeric($page)) {
            $offsetPage = intval($page) * 10;

            

            $pagination["currentPage"] = intval($page);
            $pagination["qteItems"] = $itemsToShow;
            $pagination["offsetItem"] = $offsetPage + 1;
            $pagination["showingItems"] = $offsetPage + ($tasksCount - $offsetPage);

            $pagination["itemsCount"] = $tasksCount;
            
        }

        $tasks = DB::table("tasks")->select()->where("user_id", "=", $loggedUser->id)->offset($offsetPage)->limit(10)->get();


        return view("tasks", ["loggedUser" => $loggedUser, "tasks" => $tasks, "error" => $error, "success" => $success, "currentPage" => $currentPage, "pagination" => $pagination]);
    }
}
