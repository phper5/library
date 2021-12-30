<?php

namespace App\Exports;

use App\Models\User;

class ExportUsers
{
    const COLUMN = [
        'user_id','username','role','email','created_at'
    ];
    public static function getMappingData():array
    {
        return [
            'user_id'=>function($user){ return $user->id;},
            'username'=>function($user){ return $user->name;},
            'role'=>function($user){ return $user->role == User::ROLE_ADMIN ? 'admin':'member';},
            'email'=>function($user){ return $user->email;},
            'created_at'=>function($user){ return $user->created_at;},
        ];
    }
}
