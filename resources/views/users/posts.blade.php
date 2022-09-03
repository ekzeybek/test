@extends('layouts.userapp')

@section('content')

<div class="row">

<div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Haberler</h4>
                      <p class="card-description">
                        <a href="{{route('postscreate')}}" class="btn btn-primary">Haber Ekle</a>
                      </p>
                      @if(session('status'))
                      <p class="card-description">
                      <div class="alert alert-success">
                      {{ session('status') }}
                      </div>
                    </p>
                      @endif
                      <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>
                                #
                              </th>
                              <th>
                                Başlık
                              </th>
                              <th>
                                Yazar
                              </th>
                              <th>
                                Tarih
                              </th>
                              <th>
                                İşlem
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($posts as $post)
                              <tr>
                              <td>
                                {{ $post->id}}
                              </td>
                              <td>
                                <a target="_blank"  href="/{{ $post->slug}}"> {{ $post->title}}</a>
                               
                              </td>
                              <td>
                                {{ $post->author->name}}
                              </td>
                              <td>
                                {{ $post->created_at}}
                              </td>
                              <td>
                                
                           <a onclick="return confirm('Silmek istediğinize emin misiniz?')" href="{{route('postdelete',['id'=>$post->id])}}"> <i class="fas fa-trash"></i> </a>
                              
                           <a href="{{route('postedit',['id'=>$post->id])}}"> <i class="fas fa-edit"></i></a>
                          
                          </td>
                            </tr>
                          @endforeach

                          
                            
                         
                          
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                 </div>
                </div>
    @endsection