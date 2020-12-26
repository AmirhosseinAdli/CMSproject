<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AdminUser::class,'post');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.list',compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('admin.users.show')->withUser($user);
    }

    public function edit(AdminUser $adminUser)
    {
        //
    }

    public function update(Request $request, AdminUser $adminUser)
    {
        //
    }

    public function activation(User $user)
    {
        $user->activation = !$user->activation;
        $user->update();
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
