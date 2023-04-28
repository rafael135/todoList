<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getById(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return ["success" => false];
        }

        $id = $r->input("id", false);

        if($id) {
            $category = Category::find($id);

            if($category != null) {
                $data = [];
                $data["id"] = $category->id;
                $data["title"] = $category->title;
                $data["color"] = $category->color;

                return [
                    "success" => true,
                    "category" => $data
                ];
            } else {
                return ["success" => false];
            }
        } else {
            return ["success" => false];
        }
    }

    public function create(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $title = $r->input("title", false);
        $color = $r->input("color", false);
        $user_id = $loggedUser->id;

        if($title && $color) {
            $result = Category::create([
                "title" => $title,
                "color" => $color,
                "user_id" => $user_id
            ]);

            if($result) {
                return redirect()->route("user.categories")->with("success", [
                    "msg" => "Categoria criada com sucesso!"
                ]);
            } else {
                return redirect()->route("user.categories")->with("error", [
                    "msg" => "Não foi possível criar a Categoria!"
                ]);
            }


        } else {
            return redirect()->route("user.categories")->with("error", [
                "msg" => "Não foi possível criar a Categoria!"
            ]);
        }
    }

    public function edit(Request $r) {
        $loggedUser = AuthController::checkAuth();

        if($loggedUser == false) {
            return redirect()->route("user.login");
        }

        $id = $r->input("id", false);
        $title = $r->input("title", false);
        $color = $r->input("color", false);

        if($id && $title && $color) {
            $category = Category::find($id);

            if($category != null) {
                $isValid = ($category->user_id == $loggedUser->id);

                if($isValid == true) {
                    $category->title = $title;
                    $category->color = $color;
                    
                    $category->save();

                    return redirect()->route("user.categories")->with("success", [
                        "msg" => "Categoria alterada com sucesso!"
                    ]);
                } else {
                    return redirect()->route("user.categories")->with("error", [
                        "msg" => "Você não possui permissão para alterar essa categoria!"
                    ]);
                }
            } else {
                return redirect()->route("user.categories")->with("error", [
                    "msg" => "Não foi possível editar a categoria!"
                ]);
            }

        } else {
            return redirect()->route("user.categories")->with("error", [
                "msg" => "Não foi possível editar a categoria!"
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
