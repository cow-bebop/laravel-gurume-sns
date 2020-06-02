@extends('app')

@section('title', "プロフィールを編集")

@section('content')
  @include('nav')
  <div class="container">
    <form method="POST" action="{{ route('users.update', ['name' => $user->name])}}" enctype="multipart/form-data">
      @csrf
      <div class="profile-img">
        <img src="{{asset('/storage/image/' . $user->user_img )}}" class="z-depth-1 rounded-circle"
      alt="">
      </div>
      <div class="profile-img-input">
        <input type="file" name="user_img">
      </div>
      <div class="md-form">
        <label>名前</label>
        <input type="text" name="display_name" class="form-control" required value="{{ $user->display_name ? $user->display_name : $user->name }}">
      </div>
      <div class="md-form">
        <textarea id="form7" name="profile" class="md-textarea form-control" rows="5" value="{{ $user->profile }}"></textarea>
        <label for="form7">自己紹介</label>
      </div>
      <input type="submit" name="confirm" id="button" value="登録" />
    </form>
  </div>
@endsection
