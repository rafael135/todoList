<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $r) {
        
    }

    public function edit(Request $r) {

    }

    public function delete(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return ["success" => false];
        }

        $id = $r->input("id", false);

        if($id) {
            $category = Category::find($id);

            $isValid = ($category->user_id == $loggedUser->id);

            if($isValid) {
                $category->delete();

                return ["success" => true];
            } else {
                return ["success" => false];
            }
        } else {
            return ["success" => false];
        }
    }
}
