<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
use App\Models\Comment;
use App\Models\BookMark;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(16);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $form = $request->all();

        // 画像アップロード機能
        if($request->file_name) {
            // ファイル名を元のファイル名で登録する
            $filename = $request->file('file_name');
            // 変数にファイルを元の名前で保存
            $form['file_name'] = Storage::disk('s3')->putFileAs('/', $filename, 'public');

            // 参考 $filename = request()->file('user_image');
            // $path = Storage::disk('s3')->putFileAs('/', $filename, 'public');
            // $data['user_image'] = $path; 

            // return User::create([
                // 'name' => $data['name'],
                // 'user_image' => $data['user_image'],
                // 'email' => $data['email'],
                // 'password' => Hash::make($data['password']),
            // ]);
            
        }

        $post->create($form);

        if($post){
            return redirect()
            ->route('posts.index', $post)
            ->with('flash_message','新しい投稿を登録しました');
        } else {
            return redirect()
            ->route('posts.index', $post)
            ->with('flash_message','新しい投稿の登録に失敗しました');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);
        $post_points = Post::find($id,['point1', 'point2', 'point3', 'point4', 'point5', 'content1', 'content2', 'content3', 'content4', 'content5', ])->toArray();
        $post_arrays = [['point'=>$post_points['point1'], 'content'=>$post_points['content1']],
                        ['point'=>$post_points['point2'], 'content'=>$post_points['content2']],
                        ['point'=>$post_points['point3'], 'content'=>$post_points['content3']],
                        ['point'=>$post_points['point4'], 'content'=>$post_points['content4']],
                        ['point'=>$post_points['point5'], 'content'=>$post_points['content5']]];
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $bookmark = BookMark::where('post_id', $id);
        
        return view('posts.show', compact('post','post_points', 'post_arrays','comments', 'bookmark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->update($request->all())) {
            return redirect()
                    ->route('posts.show', $post)
                    ->with('flash_message', '投稿を更新しました');
        } else {
            return redirect()
                    ->route('posts.edit', $post)
                    ->with('flash_message', '投稿の更新に失敗しました');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->bookmarks()->detach();
        
        if($post->delete()){
            return redirect()
                    ->route('posts.index')
                    ->with('flash_message', '投稿を削除しました');
        } else {
            return redirect()
                    ->route('posts.index')
                    ->with('flash_message', '投稿の削除に失敗しました');
        }
    }
}
