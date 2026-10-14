<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * 投稿一覧
     */
    public function index()
    {
        $userId = auth()->id();

        // 自分がフォローしているユーザーのIDを取得
        $followingIds = DB::table('follows')
            ->where('following_id', $userId)
            ->pluck('followed_id')
            ->toArray();

        // 自分自身も一覧に含める
        $userIds = array_merge([$userId], $followingIds);

        // 自分＋フォローしているユーザーの投稿を取得
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->whereIn('posts.user_id', $userIds)
            ->select(
                'posts.id',
                'posts.user_id',
                'posts.post',
                'posts.created_at',
                'users.username as name'
            )
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }


    /**
     * 投稿登録
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'post' => 'required|string|max:150',
            ],
            [
                'post.required' => '投稿内容を入力してください。',
                'post.string' => '投稿内容が正しくありません。',
                'post.max' => '投稿は150文字以内で入力してください。',
            ]
        );

        DB::table('posts')->insert([
            'user_id' => auth()->id(),
            'post' => $request->post,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('top')
            ->with('success', '投稿しました。');
    }


    /**
     * 投稿編集
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'post' => 'required|string|max:150',
            ],
            [
                'post.required' => '投稿内容を入力してください。',
                'post.string' => '投稿内容が正しくありません。',
                'post.max' => '投稿は150文字以内で入力してください。',
            ]
        );

        // 自分の投稿だけ更新できるようにする
        $updated = DB::table('posts')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->update([
                'post' => $request->post,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            abort(403);
        }

        return redirect()
            ->route('top')
            ->with('success', '投稿を編集しました。');
    }


    /**
     * 投稿削除
     */
    public function destroy($id)
    {
        // 自分の投稿だけ削除できるようにする
        $deleted = DB::table('posts')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        if (!$deleted) {
            abort(403);
        }

        return redirect()
            ->route('top')
            ->with('success', '投稿を削除しました。');
    }
}
