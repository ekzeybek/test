@extends('layouts.app')



@section('right')
   @parent
@endsection

@section('content')

    <!-- Blog entries -->
    <div class="w3-col l8 s12">
<!-- Blog entry -->
      @foreach ($posts as $post)
      <div class="w3-card-4 w3-margin w3-white">
       <a href="/{{$post->slug}}"><img src="{{asset('storage/images/'.$post->photo)}}" alt="Nature" style="width:100%"></a> 
        <div class="w3-container">
          <h3><b><a href="/{{$post->slug}}">{{ $post->title }}</a></b></h3>
          <h5> {{ $post->author->name }} <span class="w3-opacity"> {{ $post->created_at->diffForHumans() }}</span></h5>
        </div>
    
        <div class="w3-container">
          <p> {!!  
          Str::substr($post->body,0,300)
          
          
          !!} ... 
          
          
          </p>
          <div class="w3-row">
            <div class="w3-col m8 s12">
              <p><button class="w3-button w3-padding-large w3-white w3-border"><b><a href="/{{$post->slug}}">Devamı »</a> </b></button></p>
            </div>
            <div class="w3-col m4 w3-hide-small">
              <p><span class="w3-padding-large w3-right"><b>Yorumlar  </b> <span class="w3-tag">{{count($post->comments)}}</span></span></p>
            </div>
          </div>
        </div>
      </div>

      <hr>
      @endforeach
      
    <!-- END BLOG ENTRIES -->
    </div>

@endsection

