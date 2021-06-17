<?php

namespace App\Controllers;

use App\Utils\Carbon;
use MinasRouter\Http\Request;
use App\Controllers\Controller;
use App\Models\User;
use App\Requests\StoreUpdateUser;

class UserController extends Controller
{
    public function index()
    {
        return view("users.index");
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(Request $request)
    {
        $validate = StoreUpdateUser::validate($request->all());

        if(is_array($validate)) {
            return $this->json("error", $validate[0]);
        }

        if(!$user = User::store($request->all())) {
            return $this->json("error", "Usuário já existente ou ocorreu um erro ao cadastrar.");
        }

        $_SESSION["userLogged"] = $user;

        return $this->json("success", "Bem-vindo, {$user->username}!", "/home/index");
    }
}