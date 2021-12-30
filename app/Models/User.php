<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    public const ROLE_MEMBER = 0;
    public const ROLE_ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Create new user
     * @param $data
     * @return mixed
     */
    public static function createNewUser($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => self::generatePassword($data['password']),
        ]);
    }

    /**
     * Generate a password
     * @param $password
     * @return string
     */
    public static function generatePassword($password)
    {
        return Hash::make($password);
    }

    /**
     * Determine if user is an administrator
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }
}
