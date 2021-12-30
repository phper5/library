<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing profile
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update user data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['string', 'min:8', 'confirmed','nullable'],
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($password = $request->input('password')) {
            $user->password = User::generatePassword($password);
        }
        $user->save();
        return redirect(url()->previous())->with('success', __('user.update_profile_success'));
    }
}
