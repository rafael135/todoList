<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        /*
        if($categoriesCount >= 10) {
            $pagination["showingItems"] = 10;
        } else {
            $pagination["showingItems"] = $categoriesCount;
        }
        */
        $pagination["showingItems"] = 10;

        if($page != false && is_numeric($page)) {
            $offsetPage = intval($page) * 10;

            $pagination["currentPage"] = intval($page);
            $pagination["qteItems"] = $itemsToShow;
            $pagination["offsetItem"] = $offsetPage + 1;
            $pagination["showingItems"] = $offsetPage + ($itemsToShow);

            $pagination["itemsCount"] = $categoriesCount;
            
        }

        $categories = [];

        $search = $r->query("search", false);

        if($search) {
            $pagination["categoriesCount"] = DB::table("categories")->select()->where("user_id", "=", $loggedUser->id, "and")->where("title", "like", "%$search%")->offset($offsetPage)->limit(10)->get()->count();
            $pagination["maxPage"] = floor(intval($pagination["categoriesCount"]) / $itemsToShow);

            $categories = DB::table("categories")->select()->where("user_id", "=", $loggedUser->id, "and")->where("title", "like", "%$search%")->offset($offsetPage)->limit(10)->get();
        } else {
            $categories = DB::table("categories")->select()->where("user_id", "=", $loggedUser->id)->offset($offsetPage)->limit(10)->get();
        }


        // Variaveis que armazenam as rotas dos botões "anterior" e "próximo" da paginação
        $routePrev = ($pagination["currentPage"] > 0) 
            ? route("user.categories", ["page" => $pagination["currentPage"] - 1, "search" => ($search != false) ? $search : ""])
        : "";

        $routeNext = ($pagination["currentPage"] < $pagination["maxPage"]) 
            ? route("user.categories", ["page" => $pagination["currentPage"] + 1 , "search" => ($search != false) ? $search : ""])
        : "";
        

        return view("categories", [
            "loggedUser" => $loggedUser,
            "categories" => $categories,
            "error" => $error,
            "success" => $success,
            "currentPage" => $currentPage,
            "pagination" => $pagination,
            "search" => $search,
            "routePrev" => $routePrev,
            "routeNext" => $routeNext
        ]);
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
        /*
        if($tasksCount >= 10) {
            $pagination["showingItems"] = 10;
        } else {
            $pagination["showingItems"] = $tasksCount;
        }
        */
        $pagination["showingItems"] = 10;

        if($page != false && is_numeric($page)) {
            $offsetPage = intval($page) * 10;

            $pagination["currentPage"] = intval($page);
            $pagination["qteItems"] = $itemsToShow;
            $pagination["offsetItem"] = $offsetPage + 1;
            $pagination["showingItems"] = $offsetPage + ($itemsToShow);

            $pagination["itemsCount"] = $tasksCount;   
        }

        $search = $r->query("search", false);

        if($search) {
            $pagination["tasksCount"] = DB::table("tasks")->select()->where("user_id", "=", $loggedUser->id, "and")->where("title", "like", "%$search%")->offset($offsetPage)->limit(10)->get()->count();
            $pagination["maxPage"] = floor(intval($pagination["tasksCount"]) / $itemsToShow);

            $tasks = DB::table("tasks")->select()->where("user_id", "=", $loggedUser->id, "and")->where("title", "like", "%$search%")->offset($offsetPage)->limit(10)->get();
        } else {
            $tasks = DB::table("tasks")->select()->where("user_id", "=", $loggedUser->id)->offset($offsetPage)->limit(10)->get();
        }

        foreach($tasks as $task) {
            $createdDate = $task->created_at;
            $dueDate = $task->due_date;

            $createdDate = new Carbon($createdDate);
            $dueDate = new Carbon($dueDate);

            $task->created_at = $createdDate->format("d/m/Y");
            $task->due_date = $dueDate->format("d/m/Y");
        }


        // Variaveis que armazenam as rotas dos botões "anterior" e "próximo"
        $routePrev = ($pagination["currentPage"] > 0)
            ? route("user.tasks", ["page" => $pagination["currentPage"] - 1, "search" => ($search != false) ? $search : ""])
        : "";

        $routeNext = ($pagination["currentPage"] < $pagination["maxPage"])
            ? route("user.tasks", ["page" => $pagination["currentPage"] + 1, "search" => ($search != false) ? $search : ""]) 
        : "";


        return view("tasks",[
            "loggedUser" => $loggedUser,
            "tasks" => $tasks,
            "error" => $error,
            "success" => $success,
            "currentPage" => $currentPage,
            "pagination" => $pagination,
            "search" => $search,
            "routePrev" => $routePrev,
            "routeNext" => $routeNext
        ]);
    }
}
