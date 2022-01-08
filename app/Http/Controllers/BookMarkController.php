<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookMarkRequest;
use App\Http\Requests\UpdateBookMarkRequest;
use App\Http\Requests\DestroyBookMarkRequest;
use App\Models\BookMark;
use App\Models\Post;

class BookMarkController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookMarkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookMarkRequest $request)
    {
        $bookmark = new BookMark;
        $bookmark->user_id = \Auth::id();
        $bookmark->post_id = $request->post_id;
        $bookmark->save();

        if($bookmark)
        {
            return back()
                ->with('flash_message', 'ブックマークに追加しました');
        } else {
            return back()
                ->with('flash_message', 'ブックマークの追加に失敗しました');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyBookMarkRequest $request, int $id)
    {
        $bookmark = BookMark::where('post_id', $id);

        if($bookmark->delete())
        {
            return back()
                ->with('flash_message', 'ブックマークを解除しました');
        } else {
            return back()
                ->with('flash_message', 'ブックマークの解除に失敗しました');
        }
    }
}
