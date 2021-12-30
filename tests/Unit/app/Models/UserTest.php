<?php

namespace Tests\Unit\app\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserIsAdmin()
    {
        $user = new User();
        $user->role = User::ROLE_ADMIN;
        $this->assertTrue($user->isAdmin());
    }
    public function testUserIsNotAdmin()
    {
        $user = new User();
        $user->role = User::ROLE_MEMBER;
        $this->assertFalse($user->isAdmin());
    }
    public function testCreateNewUser()
    {
        $name='abcd';
        $password = '11111';
        $email = Str::random(5)."@test.com";
        $user = User::createNewUser(['name'=>$name,'password'=>$password,'email'=>$email,'role'=>User::ROLE_ADMIN]);
        $this->assertEquals($user->name,$name);
        $this->assertEquals($user->email,$email);
        $this->assertEquals($user->role,User::ROLE_MEMBER);
        $user->delete();
    }
}
