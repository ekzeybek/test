@extends('layouts.userapp')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Kullanıcı Düzenle</h4>
            {{-- <p class="card-description">
              Basic form elements
            </p> --}}
            <form method="POST" action="{{route('userupdate')}}" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" name="userid" value="{{$user->id}}">
              @csrf
              
              <div class="form-group">
                <label for="adsoyad">Ad Soyad</label>
                <input name="name" value="{{$user->name}}" type="text" class="@error('name') is-invalid @enderror form-control" id="name" >
                @error('name')
                     <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input name="email" value="{{$user->email}}" value="" type="email" class="@error('name') is-invalid @enderror form-control" id="email" required>
                @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
           @enderror
              </div>
             
              {{-- <div class="form-group">
                <label for="exampleInputPassword4">Url</label>
                <input type="text" name="slug" class="form-control" id="exampleInputPassword4" placeholder="Slug">
              </div> --}}
              <div class="form-group">
                <label for="exampleSelectGender">Cinsiyet</label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="erkek" @if($user->gender=='erkek') selected @endif>Erkek</option>
                    <option value="kadın" @if($user->gender=='kadın') selected @endif>Kadın</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">Role</label>
                      <select class="form-control" name="role" id="role">
                        <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                        <option value="editor"  @if($user->role=='editor') selected @endif>Editor</option>
                        <option value="user" @if($user->role=='user') selected @endif>User</option>
                      </select>
                    </div>
              <div class="form-group">
                <label>Fotoğraf</label>
                
                <div class="input-group col-xs-12">
                  <input type="file" name="photo" class="form-control file-upload-info" >
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Kaydet</button>
              <button class="btn btn-light">İptal</button>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection