<?php

namespace App\Http\Controllers;

use App\Models\Task;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function create(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $user_id = $loggedUser->id;
        $category_id = $r->input("category", false);
        $title = $r->input("title", false);
        $description = $r->input("description", false);
        $due_date = $r->input("due_date", false);
        $urgency = 1;


        if($category_id && $title && $description && $due_date) {
            $d = DateTime::createFromFormat("d/m/Y", $due_date);
            $due_date = $d->format("Y-m-d");


            $result = Task::create([
                "user_id" => $user_id,
                "category_id" => $category_id,
                "title" => $title,
                "description" => $description,
                "due_date" => $due_date,
                "urgency" => $urgency,
                "is_done" => false
            ]);

            if($result != false) {
                return redirect()->route("home")->with("success", [
                    "msg" => "Tarefa criada com sucesso!"
                ]);
            } else {
                return redirect()->route("home")->with("error", [
                    "msg" => "Não foi possível criar a Tarefa!"
                ]);
            }
        }

        return redirect()->route("home")->with("error", [
            "msg" => "Não foi possível criar a Tarefa!"
        ]);
    }

    public function getById(Request $r) {
        $id = $r->input("id", false);

        if($id == false) {
            return [
                "success" => false
            ];
        }

        $task = Task::find($id);

        if($task != null) {
            $due_date = $task["due_date"];
            //$created_at = $task["created_at"];

            $d = DateTime::createFromFormat("Y-m-d H:i:s", $due_date);
            $due_date = $d->format("d/m/Y");

            //$c = DateTime::createFromFormat("Y-m-d H:i:s", $created_at);
            //$created_at = $c->format("d/m/Y");

            $task["due_date"] = $due_date;
            //$task["created_at"] = $created_at;
            
            return [
                "success" => true,
                "task" => $task
            ];
        } else {
            return [
                "success" => false
            ];
        }
    }

    public function edit(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $id = $r->input("id", false);
        $title = $r->input("title", false);
        $description = $r->input("description", false);
        $due_date = $r->input("due_date", false);
        $category_id = $r->input("category", false);

        if($id && $title && $description && $due_date && $category_id) {
            $task = Task::find($id);

            $isValid = ($task->user_id == $loggedUser->id);

            /*
            $isValid = DB::table("tasks")
                ->select()
                ->where("user_id", "=", $loggedUser->id)
            ->get();
            */

            if($isValid) {
                //$task = Task::find($id);

                $d = DateTime::createFromFormat("d/m/Y", $due_date);
                $due_date = $d->format("Y-m-d H:i:s");

                $task->category_id = $category_id;
                $task->title = $title;
                $task->description = $description;
                $task->due_date = $due_date;
                
                $task->save();

                return redirect()->route("home")->with("success", [
                    "msg" => "A tarefa foi alterada com sucesso!"
                ]);

            } else {
                return redirect()->route("home")->with("error", [
                    "msg" => "Você não possui permissão para alterar essa tarefa!"
                ]);
            }
        } else {
            return redirect()->route("home")->with("error", [
                "msg" => "Não foi possível alterar a tarefa!"
            ]);
        }
    }

    public function delete(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return ["success" => false];
        }

        $id = $r->input("id", false);

        if($id) {
            $task = Task::find($id);

            $isValid = ($task->user_id == $loggedUser->id);

            if($isValid) {
                $task->delete();

                return ["success" => true];
            } else {
                return ["success" => false];
            }
        } else {
            return ["success" => false];
        }
    }



    public function updateStatus(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return ["success" => false];
        }

        $id = $r->input("id", false);
        $status = $r->input("status", null);

        if($id) {
            $task = Task::find($id);

            if($task != null) {
                $isValid = ($task->user_id == $loggedUser->id);

                if($isValid == false) {
                    return ["success" => false];
                }
                $task->is_done = $status;
                $task->save();

                return ["success" => true];
            } else {
                return ["success" => false];
            }
        } else {
            return ["success" => false];
        }
    }
} 
