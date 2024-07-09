<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Dictionaries\Users\UserTypeDictionary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserRequest;
use App\Infrastructures\Services\RoleService;
use App\Infrastructures\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
        $this->userService = new UserService();

        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-deactivate', ['only' => ['deactivate']]);
        $this->middleware('permission:user-activate', ['only' => ['activate']]);
    }

    public function index(Request $request, UsersDataTable $dataTable)
    {
        $pageTitle = 'User '. unslugWithCapitalize($request->type) .' List';
        $auth_user = Auth::user();
        $assets = ['data-table'];
        $headerAction = '';
        $type = $request->type ?? UserTypeDictionary::USER_TYPE_STAFF;
        if ($auth_user->can('user-add')) {
            $headerAction = '<a href="'.route('users.create', ['type' => $request->type]).'" class="btn btn-sm btn-primary" role="button">Add ' . unslugWithCapitalize($type) . '</a>';
        }
        return $dataTable->with(['user_type' => $type])->render('global.datatable', compact('pageTitle', 'auth_user', 'assets', 'headerAction'));
    }

    public function create(Request $request)
    {
        $user = new User();
        $type = $request->type ?? UserTypeDictionary::USER_TYPE_STAFF;
        $role = $this->roleService->getDataByName($type);
        return view('users.forms.user', compact('user', 'role', 'type'));
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->userService->craete($request->all());
            DB::commit();
            return redirect()->route('users.index', ['type' => $request->user_type])->withSuccess('User created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show(Request $request, User $user)
    {
        return $this->edit($request, $user);
    }

    public function edit(Request $request, User $user)
    {
        $type = $user->user_type;
        $role = $this->roleService->getDataByName($type);
        return view('users.forms.user', compact('user', 'role', 'type'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $this->userService->update($user, $request->all());
            $role = $user->roles()->first();
            DB::commit();
            return redirect()->route('users.index', ['type' => $role->name])->withSuccess('User updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deactivate(User $user)
    {
        try {
            $this->userService->deactivate($user);
            return redirect()->back()->withSuccess('User deactivate successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function activate(User $user)
    {
        try {
            $this->userService->activate($user);
            return redirect()->back()->withSuccess('User activate successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
