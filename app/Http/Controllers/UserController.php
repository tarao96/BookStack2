<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }

    public function show(int $id) {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function edit(int $id){
        $user = User::findOrFail($id);
        
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user){
        if($user->update($request->all())){
            return redirect()
                ->route('users.index', $user)
                ->with('flash_message', 'ユーザー情報を更新しました');
        } else {
            return redirect()
                ->route('users.index', $user)
                ->with('flash_message', 'ユーザー情報の更新に失敗しました');
        }
    }

    public function destroy(User $user){
        if($user->delete()){
            return redirect()
                ->route('users.index', $user)
                ->with('flash_message', 'ユーザー情報を更新しました');
        } else {
            return redirect()
                ->route('users.index', $user)
                ->with('flash_message', 'ユーザー情報の更新に失敗しました');
        }
    }
}
