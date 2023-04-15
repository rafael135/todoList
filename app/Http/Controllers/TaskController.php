<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $r) {
        
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
        
    }

    public function delete(Request $r) {

    }
} 
