@extends('app')

@section('title', "プロフィールを編集")

@section('content')
  @include('nav')
  <div class="container">
    <form method="post" action="{{ route('users.update', ['name' => $user->name])}}" enctype="multipart/form-data">
      @csrf
      <div class="profile-img">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img(31).jpg" class="z-depth-1 rounded-circle"
      alt="Responsive image">
        <input type="file" name="user_image" class="" style="">
      </div>
      <div class="md-form">
        <label>名前</label>
        <input type="text" name="display_name" class="form-control" required value="">
      </div>
      <div class="md-form">
        <textarea id="form7" name="profile" class="md-textarea form-control" rows="5"></textarea>
        <label for="form7">自己紹介</label>
      </div>
      <input type="submit" name="confirm" id="button" value="確認" />
    </form>
  </div>
@endsection