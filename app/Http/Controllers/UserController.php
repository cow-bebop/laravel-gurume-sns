<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $user_image = $request->file->store('public');
        User::insert([
            "user_img" => $user_image,
            "display_name" => $display_name,
            "profile" => $profile
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    // フォローしている人の一覧を返すメソッド
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings',[
            'user' => $user,
            'followings' => $followings
        ]);
    }

    // フォローされている人の一覧を返すメソッド
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers',[
            'user' => $user,
            'followers' => $followers
        ]);
    }

    // フォローまだの場合にフォローボタンを押した時の処理
    // $nameにはURIの{name}の中身が入ってくる
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        // アクションメソッドで配列や連想配列を返すとJSON形式に変換されてレスポンスされる
        return ['name' => $name];
    }

    // フォロー済みの場合にフォローボタンを押した時の処理
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            // abort関数は、第一引数にステータスコードを渡す
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        // アクションメソッドで配列や連想配列を返すとJSON形式に変換されてレスポンスされる
        return ['name' => $name];
    }
}
