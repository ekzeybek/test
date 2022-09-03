@extends('layouts.app')

@section('right')
  @parent
@endsection

@section('css')
<style>
.be-comment-block {
  margin-bottom: 50px !important;
  border: 1px solid #edeff2;
  border-radius: 2px;
  padding: 20px 30px;
  border:1px solid #ffffff;
}

.comments-title {
  font-size: 16px;
  color: #262626;
  margin-bottom: 15px;
  font-family: 'Conv_helveticaneuecyr-bold';
}

.be-img-comment {
  width: 60px;
  height: 60px;
  float: left;
  margin-bottom: 15px;
}

.be-ava-comment {
  width: 60px;
  height: 60px;
  border-radius: 50%;
}

.be-comment-content {
  margin-left: 80px;
}

.be-comment-content span {
  display: inline-block;
  width: 49%;
  margin-bottom: 15px;
}

.be-comment-name {
  font-size: 13px;
  font-family: 'Conv_helveticaneuecyr-bold';
}

.be-comment-content a {
  color: #383b43;
}

.be-comment-content span {
  display: inline-block;
  width: 49%;
  margin-bottom: 15px;
}

.be-comment-time {
  text-align: right;
}

.be-comment-time {
  font-size: 11px;
  color: #b4b7c1;
}

.be-comment-text {
  font-size: 13px;
  line-height: 18px;
  color: #7a8192;
  display: block;
  background: #f6f6f7;
  border: 1px solid #edeff2;
  padding: 15px 20px 20px 20px;
}

.form-group.fl_icon .icon {
  position: absolute;
  top: 1px;
  left: 16px;
  width: 48px;
  height: 48px;
  background: #f6f6f7;
  color: #b5b8c2;
  text-align: center;
  line-height: 50px;
  -webkit-border-top-left-radius: 2px;
  -webkit-border-bottom-left-radius: 2px;
  -moz-border-radius-topleft: 2px;
  -moz-border-radius-bottomleft: 2px;
  border-top-left-radius: 2px;
  border-bottom-left-radius: 2px;
}

.form-group .form-input {
  font-size: 13px;
  line-height: 50px;
  font-weight: 400;
  color: #b4b7c1;
  width: 100%;
  height: 50px;
  padding-left: 20px;
  padding-right: 20px;
  border: 1px solid #edeff2;
  border-radius: 3px;
}

.form-group.fl_icon .form-input {
  padding-left: 70px;
}

.form-group textarea.form-input {
  height: 150px;
}
</style>
@endsection

@section('content')

    <!-- Blog entries -->
    <div class="w3-col l8 s12">

        <div class="w3-card-4 w3-margin w3-white">
          <h3><b>{{ $post->title }}</b></h3>
            <img src="{{asset('storage/images/'.$post->photo)}}" alt="Nature" style="width:100%">
            <div class="w3-container">
          
              <h5> {{ $post->author->name }} <span class="w3-opacity"> {{ $post->created_at->diffForHumans() }}</span></h5>
            </div>
        
            <div class="w3-container">
              <p> {!! $post->body !!}</p>
             
              
            </div>
          </div>

          
    </div>



@endsection


@section('comment')
<form class="form-block" method="POST" action="{{route('yorumyap')}}">
  <input type="hidden" name="postid" value="{{ $post->id }}">
  @csrf
  <div class="row">
    <div class="col-xs-12">									
      <div class="form-group">
        <textarea class="form-input" required="" name="comment" placeholder="Yorumunuz"></textarea>
      </div>
    </div>
    <button class="btn btn-primary" type="submit">Gönder </button>
    
  </div>
</form>
  <div class="be-comment-block">
    <h1 class="comments-title">Yorumlar ({{count($post->comments)}})</h1>

    @foreach ($post->comments as $comment)
      <div class="be-comment">
      <div class="be-img-comment">	
        <a href="blog-detail-2.html">
          <img src="{{asset('storage/images/'.$comment->author->photo)}}" alt="" class="be-ava-comment">
        </a>
      </div>
      <div class="be-comment-content">
        
          <span class="be-comment-name">
            <a href="blog-detail-2.html"> {{ $comment->author->name}}</a>
           @if (@Auth::user()->id== $comment->from_user)
             <a href="{{route('yorumsil',['id'=>$comment->id])}}" class="btn btn-danger">Sil </a>
           @endif
            
            
          </span>
          <span class="be-comment-time">
            <i class="fa fa-clock-o"></i>
            {{ $comment->created_at->format('d-m-Y')}}
          </span>
  
        <p class="be-comment-text">
         {{ $comment->body}}
        </p>
      </div>
    </div>
   
    @endforeach
    
 
  
  </div>


@endsection