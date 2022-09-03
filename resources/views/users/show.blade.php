@extends('layouts.userapp')

@section('content')

<div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        {{-- <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <div>
            <div class="btn-wrapper">
              <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
              <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
              <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
            </div>
          </div>
        </div> --}}
        <div class="tab-content tab-content-basic">
          <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
      
            <div class="row">
              
                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Kullanıcılar</h4>
                      <p class="card-description">
                        <a href="{{route('usercreate')}}" class="btn btn-primary">Kullanıcı Ekle</a>
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
                                Ad Soyad
                              </th>
                              <th>
                                Email
                              </th>
                              <th>
                                Rol
                              </th>
                              <th>
                                Haber Sayısı
                              </th>
                              <th>
                                Yorum Sayısı
                              </th>
                              <th>
                                İşlem
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($users as $user)
                              <tr>
                              <td>
                                {{ $user->id}}
                              </td>
                              <td>
                                {{ $user->name}}
                              </td>
                              <td>
                                {{ $user->email}}
                              </td>
                              <td>
                                {{ $user->role}}
                              </td>
                              <td>
                                {{ count($user->posts)}}
                              </td>
                              <td>
                                {{ count($user->comments)}}
                              </td>

                              <td>
                                
                           <a onclick="return confirm('Silmek istediğinize emin misiniz?')" href="{{route('userdelete',['id'=>$user->id])}}"> <i class="fas fa-trash"></i> </a>
                              
                           <a href="{{route('useredit',['id'=>$user->id])}}"> <i class="fas fa-edit"></i></a>
                          
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor',{
  uiColor: '#CCEAEE',
  removeButtons: 'PasteFromWord',
  removePlugins: 'about',
 language:'tr',
 filebrowserUploadUrl :  "{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
 filebrowserUploadMethod:'form'
 });
</script>
@endsection