<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Exports\ExportUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class UserController extends Controller
{
    /**
     * Get rules for edit a user detail
     * @param $id
     * @return \string[][]
     */
    public static function getUpdateRules($id): array
    {
        return  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['string', 'min:8', 'confirmed','nullable'],
        ];
    }

    /**
     * get rules for add a new user
     * @return \string[][]
     */
    public static function getCreateRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = config('user.book_per_page', 15);
        $where = [];
        if ($keyword = trim($request->input('keyword'))) {
            $where[] = ['name','like','%'.$keyword.'%'];
        }
        $role = $request->input('role', -1);
        if ($role === null) {
            $role = -1;
        }
        if ($role!=-1) {
            $where[] = ['role' ,'=',$role];
        }
        $query = User::query();
        if ($where) {
            $query = $query->where($where);
        }
        $users = $query->orderBy('id', 'desc')->paginate($per_page);
        $columns = ExportUsers::COLUMN;
        return view('users.index', compact('users', 'columns', 'role', 'keyword'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidatorFacade::make(self::getCreateRules());
        return view('users.create', compact('validator'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(self::getCreateRules());
        $user = User::createNewUser($request->all());
        $user->role = $request->input('role', 0);
        $user->save();
        return redirect()->route('users.index')
            ->with('success', __('user.add_success'));
    }

    /**
     * Display the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $validator = JsValidatorFacade::make(self::getUpdateRules($id));
        return view('users.edit', compact('user', 'validator'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::getUpdateRules($id));
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($password = $request->input('password')) {
            $user->password = User::generatePassword($password);
        }
        $currentUser = Auth::user();
        if ($currentUser->id != $id) {
            $user->role = $request->input('role', 0);
        }
        $user->save();
        return redirect()->route('users.index')
            ->with('success', __('user.update_success'));
    }

    /**
     * Remove the specified user from storage.
     * @deprecated
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where("id", $id)->delete();
        return redirect()->route('users.index')
            ->with('success', __('user.delete_success'));
    }
}
