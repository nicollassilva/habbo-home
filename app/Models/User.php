<?php

namespace App\Models;

use App\Utils\Carbon;
use MinasORM\Database;

class User extends Database {
    protected $fillables = [
        'username', 'password', 'created_at', 'updated_at'
    ];

    /**
     * Register a user
     * 
     * @return \App\Models\User|null|bool
     */
    public static function store(Array $data)
    {
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        return User::create($data);
    }
}