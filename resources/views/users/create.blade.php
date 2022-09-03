@extends('layouts.userapp')

@section('content')
<div class="row">
<div class="col-8 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Kullanıcı Ekle</h4>
                        {{-- <p class="card-description">
                          Basic form elements
                        </p> --}}
                        <form method="POST" action="{{route('userstore')}}" class="forms-sample" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="adsoyad">Ad Soyad</label>
                            <input name="name" value="{{old('name')}}" type="text" class="@error('name') is-invalid @enderror form-control" id="name" >
                            @error('name')
                                 <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" value="{{old('email')}}" value="" type="email" class="@error('name') is-invalid @enderror form-control" id="email" required>
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                       @enderror
                          </div>
                          <div class="form-group">
                            <label for="sifre">Şifre</label>
                            <input name="password" type="password" class="@error('name') is-invalid @enderror form-control" id="password" required>
                            @error('password')
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
                                <option value="erkek" >Erkek</option>
                                <option value="kadın">Kadın</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Role</label>
                                  <select class="form-control" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                    <option value="user">User</option>
                                  </select>
                                </div>
                          <div class="form-group">
                            <label>Fotoğraf</label>
                            
                            <div class="input-group col-xs-12">
                              <input type="file" name="photo" class="form-control file-upload-info" >
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary me-2">Kaydet</button>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
@endsection