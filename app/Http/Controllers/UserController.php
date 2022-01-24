<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\BookMark;
use App\Models\Comment;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }

    public function show(int $id) {
        $user = User::findOrFail($id);
        $bookmarks = BookMark::where('user_id', $id)->get();
        $comments = Comment::where('user_id', $id)->get();

        return view('users.show', compact('user', 'bookmarks', 'comments'));
    }

    public function edit(int $id){
        $user = User::findOrFail($id);
        
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user){

        $form = $request->all();
        $path = $user->user_image;
        $image = $request->file('user_image');

        if($request->user_name)
        {
            Storage::disk('public')->delete($path);
            $form['user_image'] = Storage::disk('s3')->putFileAs('/', $image, 'public');

            // 参考　$path = Storage::disk('s3')->putFileAs('/', $filename, 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_image' => $form['user_image'],
        ]);

        return redirect()
                ->route('users.show', $user)
                ->with('flash_message', 'ユーザー情報を更新しました');
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
